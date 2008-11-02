
package KaeL::ScriptSubs::CORE;
use Moose; with qw( KaeL::ScriptSubs );
use PerlDSL::Perl;
use KaeL::Util;
use KaeL::Task::Call;
use KaeL::Task::Script;
use KaeL::Cache::Script;

has _script_cache => ( is      => 'ro',
                       lazy    => 1,
                       default => sub{
                         my $self = shift;
                         KaeL::Cache::Script->new( core => $self->core );
                       } );

sub subs {
  my $self = shift;
  my $core = $self->core;

  (
   PROJECT_ROOT => sub{ $core->root },

   lazy         => \&KaeL::Util::lazy,

   delay        => \&KaeL::Util::delay,

   core         => sub { $core },

   cfg          => sub { $core->cfg },

   date         => sub { return DateTime->now unless @_;
                         DateTime->new( @_ ) },

   req          => sub { $core->req; },

   res          => sub { $core->res; },

   header       => sub { $core->res->header(@_) },

   log          => sub { $core->log( process_log(@_) ) },

   body         => sub { $core->res->content(@_) },

   content      => sub { $core->res->content(@_) },

   script       => sub { my $script = shift;
                         $self->_script_cache->get( $script ); },

   call         => sub { KaeL::Task::Call->new( callee => shift,
                                                exprs  => [ @_ ] ) },
   blessed      => \&blessed,

   with         => sub(&@) {@_},

   error        => sub { $core->error(@_) },

   PerlDSL::Subs::FileUtil->subs,

   ( map{
     my $m = $_;
     ( $m , sub{ $core->$m(@_) } )
   } qw(escapeHTML) ),

   ( map{
     /\ARC_[A-Z_]+\Z/ ? ( $_ , HTTP::Status->can($_) ) : ();
   } @HTTP::Status::EXPORT ),

   ( map {
     my $m = $_;
     ( $m , sub{ $core->req->$m(@_) ; } )
   } ( @KaeL::HTTP::Request::CGIMETHODS,
       qw( user ) ),
   ),
  )
}

1;
__END__
