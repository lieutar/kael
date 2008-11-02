
package KaeL::CORE;
use Moose;
use Moose::Util  qw( does_role );
use KaeL::Cfg::CORE;
use KaeL::CONSTANTS;
use KaeL::Types qw( Dir File URI );
use CGI::Simple;
use DateTime;
use KaeL::HTTP::Response;
use KaeL::HTTP::Request;
use KaeL::User;
use KaeL::Util;
use Path::Class;
use HTTP::Status;
use KaeL::Task::CODE;
use KaeL::Task::DefaultError;

has root => ( is       => 'ro',
              isa      => Dir,
              required => 1,
              coerce   => 1,
             ) ;

has cfg => ( is    => 'ro' ,
             lazy => 1 ,
             default => sub{
               my $self = shift;
               KaeL::Cfg::CORE->load(  $self,
                                       file($self->root, ROOT_CFG) );
             } );

has error_handler => ( is   => 'rw',
                       isa  => 'KaeL::Task',
                     );

has _cgi   => ( is => 'ro',
                lazy => 1 ,
                default => sub{ CGI::Simple->new; },
                handles => [qw(
                                escapeHTML
                             )] );

has req    =>( is      => 'ro',
               lazy    => 1,
               default => sub{
                 my ($self) = @_;
                 KaeL::HTTP::Request->new( _cgi => shift->_cgi );
               }
             );

has res    => ( is      => 'ro',
                lazy    => 1,
                default => sub{
                  my ( $self ) = @_;
                  KaeL::HTTP::Response->new;
                } );

has user   => ( is      => 'ro',
                lazy    => 1,
                default => sub{
                  my ($self) = @_;
                  KaeL::User->new( app => $self );
                } );



sub initial_task {
  my $self = shift;
  $self->cfg->task;
}

sub _restore_error_handler{
  my $self = shift;
  my $ret  = $self->cfg->error_handler;
  $self->error_handler( $ret || KaeL::Task::DefaultError->new );
}


sub run {

  my ( $self ) = @_;
  my $task = $self->initial_task;
  $self->_restore_error_handler;

  while ( does_role( $task , 'KaeL::Task' ) ) {
    $task->core( $self );
    eval { $task = $task->run };
    if( $@ ){
      if( does_role( $@ , 'KaeL::Task' ) ){
        $task = $@;
      }
      else {
        until( does_role( $@ , 'KaeL::Task' ) ){
          my $err = $@;
          eval { $self->error( 500 => $err ) };
        }
        $task = $@;
      }
    }
    else {
      $task = KaeL::Task::CODE->new( $task ) if ref( $task ) eq  'CODE' ;
    }
  }

  my $res = $self->res->as_http_response;
  $res->request( $self->req );
  $res->date( time );
  $res;
}


sub error {
  my $self = shift;
  my $code = shift || 500;
  my $msg  = shift || $@;
  my $task = $self->error_handler;
  $self->error_handler( KaeL::Task::DefaultError->new );
  $task->args([ $code, $msg ]);
  die $task;
}


sub log {
  my ( $self, @opt ) = @_;
  my $logger = $self->cfg->logger;
  return unless $logger;
  $logger->log( @opt );
}


{

  sub _script_subs{
    my $self = shift;
    use KaeL::ScriptSubs::CORE;
    KaeL::ScriptSubs::CORE->new( core => $self )->subs;
  }

  sub _prepare_script_args{
    my $self = shift;
    my @head = @_ % 2 ? ( shift @_ ) : ();
    (
     @head,
     -no_safe => 1,
     $self->_script_subs,
     @_
    )
  };

  sub compilescript {
    PerlDSL::Perl::compilescript( _prepare_script_args( @_ ) );
  }

  sub runscript {
    PerlDSL::Perl::runscript( _prepare_script_args( @_ ) );
  }

}

1;
__END__

