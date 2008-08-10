
package KaeL::HTTP::Response;
use Moose;
use MooseX::Method;
use HTTP::Response;
use Carp::Assert;
use Carp;
use Clone;
use Encode;


has _core => ( is      => 'ro',
               isa     => 'HTTP::Response',
               default => sub{
                 my $o = HTTP::Response->new;
                 $o->code(200);
                 $o->header('Content-Type' =>
                            'text/html');
                 $o->header('Server'       =>
                            defined($ENV{SERVER_SIGNATURE})
                            ? $ENV{SERVER_SIGNATURE} : 'cmdline');
                 $o;
               },
               handles =>  qr{\A
                              (?!
                                (?:
                                  header    |
                                  as_string |
                                  content   |
                                  _.*
                                )
                                \Z
                              )}x );

has endl => ( is         => 'ro',
              default => "\x0d\x0a",
            );

has cookies => ( is      => 'ro',
                 default => sub{{}},
               );

has _resource => ( is       => 'rw',
                   isa      => 'Maybe[KaeL::Resource]',
                   init_arg => 1,
                 );

{
  my %HANDLE =
    (
     status => sub{
       my $self = shift;
       my $key  = shift;
       return $self->_core->status_line unless @_;
       my $mess = shift;
       return $self->_core->code($mess - 0) if $mess =~ /^\d+$/;
       $self->_core->status_line($mess);
     },
    );

  sub _header {
    my $self = shift;
    my $key  = shift;
    assert( defined $key );
    my $handler = $HANDLE{ lc $key };
    $handler
      ? $handler->($self, $key, @_)
        : $self->_core->header( $key , @_ );
  }
}


{
  my %ALIAS = ( Type   => 'Content-Type' );
  my $unalias = sub  {
    my ( $str) = @_;
    $str =~ s/^-//;
    $str =  join "-" , map ucfirst $_ , split /[-_]/, $str;
    return $ALIAS{$str} if exists $ALIAS{$str};
    $str;
  };

  sub header {
    my $self = shift;

    !@_ and return $self->headers;
    my $first = 1;
    while( @_ ){
      my $opt = shift;
      my $value = undef;

      $opt =~ /^([^:]+):\s*/ and do{
        $self->_header( $1 => $' );
        next;
      };

      $opt =~ m#^[^/\s]+/[^/\s]+(?:;.*)?$# and do{
        $self->_header('Content-Type' => shift );
        next;
      };

      my $field = $unalias->( $opt );
      return $self->_header( $field ) if $first and !@_;
      $self->_header( $field , shift );
      $first = 0;
    }
  }
}


sub resource {
  my $self = shift;

  if( @_ ){

    my $rsc = shift;
    $rsc = KaeL::Resource::File->new
      if UNIVERSAL::isa( $rsc, 'Path::Class::File' );

    unless( does_role('KaeL::Resource::File') ){
      $self->_resource( undef );
    }
    else {
      my $charset = $self->charset;
      $self->_resource( $rsc );
    }
  }

  my $retval = $self->_resource;
  return $retval if $retval;

  my $content = $self->content;
  return undef unless defined $content;

  $retval = KaeL::Resource::Simple->new( content => $self->content );

  if( my $mtime = $self->last_modified ) {
    $retval->mtime( $mtime );
  }

  $retval;
}

sub last_modified {
  my $self = shift;
  my $rsc  = $self->_resource;
  if( @_ ){
    if( $rsc ){
      $rsc->mtime( @_ );
    }
    else {
      $self->_core->last_modified( @_ );
    }
  }
  return $rsc->mtime if $rsc;
  return $self->_core->last_modified;
}

sub content {
  my $self = shift;
  if( @_ ){
    $self->_resource( undef );
    $self->_core->content( @_ );
  }
  my $rsc  = $self->_resource;
  return $rsc->content if $rsc;
  $self->_core->content;
}


sub cookie {
  my $self = shift;
  unless ( @_ ) {
    my %ret = %{ $self->cookies };
    return wantarray ? %ret : \%ret;
  }
  my $name = shift;
  return $self->cookies->{$name} unless @_ ;
  my $cookie = CGI::Simple::Cookie->new( name => $name, @_ );
  $self->cookies->{$name} = $cookie;
}

sub charset {
  my ( $self ) = @_;
  my $type = $self->header('-type');
  $type =~ /charset=([^;]+)/ ? $1 : 'utf-8';
}

sub as_http_response {
  my ( $self ) = @_;
  my $res      = Clone::clone( $self->_core );
  my $content  = $self->content;

  if(defined $content) {
    my $body = ( utf8::is_utf8($content)
                 ? encode( $self->charset, $content )
                 : $content );
    $res->header( content_length => length $body );
    $res->content( $body );
  }
  else {
    $res->remove_content_headers;
    $res->content( '' );
  }

  foreach my $cookie ( values  %{$self->cookies} ){
    $res->push_header( "Set-Cookie" => "$cookie" );
  }

  $res;
}

sub as_string {
  my ( $self ) = @_;
  my $res = $self->as_http_response;
  $res->as_string( $self->endl );
}



use overload ( '""' => \&as_string );


1;
__END__
