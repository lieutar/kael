
package KaeL::User;
use Moose; extends qw( KaeL::CGI::User );
use Sub::Name;

use KaeL::Util qw( gensym );

has core => ( is       => 'ro',
              required => 1   );

has id =>
  ( is      => 'ro',
    lazy    => 1,
    default => sub{
      my $self   = shift;
      my $core   = $self->core;
      my $req    = $core->req;
      my $field  = $core->cfg('SESSION_NAME');
      my $id     = ( $req->cookie( $field ) or
                     $req->param( $field ) );
      my $db     = $core->session_db;
      return undef unless defined $db;
      $id = undef unless $db->exists( $id );
      $id = gensym unless defined $id;
      $req->cookie( $field => $id );
      $id;
    });

has session =>
  ( is   => 'ro',
    lazy => 1,
    default => sub{
      my $self = shift;
      my $core   = $self->core;
      my $db     = $core->session_db;
      return unless $db;
      return unless defined( my $id = $self->id );
      my $sess = $db->thaw( $id ) || KaeL::User::Session->new;
      $core->add_hook( session_close => sub{ $db->freeze( $id, $sess ); } );
      $sess;
    }
  );

has 'lock' => ( is      => 'rw',
                default => 0 );

my $lock = __PACKAGE__->can( 'lock' );

around lock => sub{
  my $orig = shift;
  my $self = shift;
  return unless $orig->($self);
  $orig->( $self , 1 );
};

do{
  my $attr = $_;
  my $orig = KaeL::CGI::User->can( $_ );
  __PACKAGE__->meta->add_method( $attr => subname( $attr => sub {
    my $self = shift;
    return $orig->( $self ) unless @_;
    confess "this property is locked" if $lock->( $self );
    $orig->( $self , @_  );
  } ) );
} foreach KaeL::CGI::User->meta->get_attribute_list;


sub new {
  my $self   = shift;
  my %param  = @_;
  $self = $self->SUPER::new( %param  );
  $self->lock;
  $self;
}

1
__END__
