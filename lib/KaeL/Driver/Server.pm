
package KaeL::Driver::Server;
use Moose ; with qw( KaeL::Driver );
use Socket;
use IO::Handle;
use KaeL::Driver::Server::Connection;
use KaeL::CGI::Runner::CODE;

use POE qw( Sugar::Args
            Wheel::SocketFactory
            Wheel::ReadWrite
            Filter::Stream
            Filter::HTTPD );


has port => ( is      => 'ro',
              isa     => 'Num',
              default => 80,
            );

sub msg {
  my $self = shift;
  my $msg  = shift;
  printf "MSG: %s\n", $msg;
  $self->core->log( SERVER => $msg ,
                    level  => 1 );
}


sub run {
  my $self = shift;

  POE::Session->create
      (
       inline_states =>
       {
        _start => sub {
          my ( $kernel, $heap ) = @_[KERNEL, HEAP];
          $kernel->alias_set('main_thread');
          my $port = $self->port;
          $heap->{server} = POE::Wheel::SocketFactory->new
            (
             BindAddress  => INADDR_ANY,
             BindPort     => $port,
             SuccessEvent => 'server_accepted',
             FailureEvent => 'server_error',
             Reuse        => 'on',
            );
          $self->msg
            ( "Server bind to port $port, ready to accept new connection." );
        },
       },

       object_states => [ $self => [qw( server_accepted
                                        server_error

                                        client_input
                                        client_close

                                        client_error
                                        client_flushed
                                     )],
                        ], );

  POE::Kernel->sig( INT => sub { POE::Kernel->stop; } );
  POE::Kernel->run;
}

sub server_accepted {
  my ( $self , $socket, $heap ) = @_[0, ARG0 , HEAP];
  my $con =
    KaeL::Driver::Server::Connection->new
        ( socket => $socket,
          wheel  => POE::Wheel::ReadWrite->new
          (
           Handle       => $socket,
           InputEvent   => 'client_input',
           FlushedEvent => 'client_flushed',
           ErrorEvent   => 'client_error',
           Filter       => POE::Filter::HTTPD->new,
          )
        );
  $heap->{connection}->{$con->id} = $con;
}

sub client_input {
  my ( $self , $req, $id , $heap ) = @_[0, ARG0, ARG1, HEAP];
  my $con    = $heap->{connection}->{$id};
  my $res;
  {
    local $@ = undef;
    my $runner = KaeL::CGI::Runner::CODE->new( code =>
                                               sub{ $self->core->run } );
    my $uri  = $self->core->cfg->url_root->clone;
    $uri->path( $req->uri->path );
    $req->uri($uri);
    $runner->env->req( $req );
    $runner->env->user->addr( $con->peer_addr );
    $runner->env->user->host( $con->peer_host );
    $self->msg("connection from ". $con->peer_addr);

    $res = eval{ $runner->run; };
    $self->msg( $@ ) if $@;
  }

  $res->protocol('HTTP/1.0'); # yet

  ## Handle Keep-Alive
  my $conn_h = $req->header('Connection') || '';

  if ($conn_h =~ m/keep-alive/i) {
    $res->header('Connection' => 'keep-alive');
    $res->header('Keep-Alive' => 'timeout=10');
  }
  elsif( $conn_h =~ /close/i ){
    $res->header('Connection' => 'close')
  }

  {
    my $keepalive = $con->keepalive;
    if ( $req->protocol eq 'HTTP/1.1' ) {
      $keepalive++ if $conn_h !~ /close/i;
    }
    else {
      $keepalive++ if $conn_h =~ /keep-alive/i;
    }
    $con->keepalive( $keepalive );
  }

  my $content = $res->content;
  $res->content('');
  $con->wheel->put( $res );
  $con->outbuf( $content ) if $content;
}

sub client_flushed {
  my ($self, $kernel, $id, $heap) = @_[0, KERNEL, ARG0, HEAP];
  my $con = $heap->{connection}->{$id};
  $con->flush if $con->outbuf;
  $con->keepalive
    ? do { $kernel->delay(client_close => 10 => $id);
           $con->keepalive(0) }
    : $kernel->yield(client_close => $id);
}

sub client_close {
  my ( $self , $id , $heap ) = @_[0, ARG0, HEAP];
  delete $heap->{connection}->{$id};
}

sub client_error {
  my ( $self , $id , $kernel ) = @_[0, ARG3, KERNEL];
  $kernel->yield(client_close => $id);
}

sub server_error {
  my ( $self , $heap , @args ) = @_[0, HEAP, ARG0, ARG2, ARG1];
  $self->msg( sprintf 'Server error: operation \'%s\' failed: %s (%s)',
              @args );
  delete $heap->{server};
}

1;
__END__
