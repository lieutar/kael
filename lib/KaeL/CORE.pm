
package KaeL::CORE;
use Moose;
use Moose::Util  qw( does_role );
use KaeL::Cfg::CORE;
use KaeL::CONSTANTS;
use KaeL::Types qw( Dir File URI );
use CGI::Simple;
use PerlDSL::Perl;
use DateTime;
use KaeL::HTTP::Response;
use KaeL::HTTP::Request;
use KaeL::User;
use KaeL::Util;
use Path::Class;
use HTTP::Status;
use KaeL::Task::Script;
use KaeL::Task::Call;
use KaeL::Task::CODE;
use KaeL::Task::DefaultError;
use KaeL::Cache::Script;

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

has _script_cache => ( is      => 'ro',
                       lazy    => 1,
                       default => sub{
                         my $self = shift;
                         KaeL::Cache::Script->new( core => $self );
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
  my $prepare = sub{
    my $self = shift;
    my @head = @_ % 2 ? ( shift @_ ) : ();
    (
     @head,
     #-permit  => [ ':all' ],
     #-deny    => [ 'exit' ],
     -no_safe => 1,
     PROJECT_ROOT => sub{ $self->root },
     lazy    => \&KaeL::Util::lazy,
     delay   => \&KaeL::Util::delay,
     core    => sub { $self },
     cfg     => sub { $self->cfg },
     date    => sub { return DateTime->now unless @_;
                      DateTime->new( @_ ) },
     req     => sub { $self->req; },
     res     => sub { $self->res; },
     header  => sub { $self->res->header(@_) },
     log     => sub { $self->log( process_log(@_) ) },
     body    => sub { $self->res->content(@_) },
     content => sub { $self->res->content(@_) },
     script  => sub { $self->script(@_) },,
     call    => sub { KaeL::Task::Call->new( callee => shift,
                                             exprs  => [ @_ ] ) },
     blessed => \&blessed,
     with    => sub(&@) {@_},
     error   => sub { $self->error(@_) },

     PerlDSL::Subs::FileUtil->subs,

     ( map{
       my $m = $_;
       ( $m , sub{ $self->$m(@_) } )
     } qw(escapeHTML) ),

     ( map{
       /\ARC_[A-Z_]+\Z/ ? ( $_ , HTTP::Status->can($_) ) : ();
     } @HTTP::Status::EXPORT ),

     ( map {
       my $m = $_;
       ( $m , sub{ $self->req->$m(@_) ; } )
     } ( @KaeL::HTTP::Request::CGIMETHODS,
         qw( user ) ),
     ),
     @_
    )
  };

  sub compilescript {
    PerlDSL::Perl::compilescript( $prepare->( @_ ) );
  }

  sub runscript {
    PerlDSL::Perl::runscript( $prepare->( @_ ) );
  }

  sub script{
    my $self = shift;
    my $script = shift;
    $self->_script_cache->get( $script );
  }
}



1;
__END__

