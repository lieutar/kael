package KaeL::Registory::Node::Leaf;
use KaeL::Registory;
use Moose; extends qw( KaeL::Registory::Node );

has value => ( is => 'ro' );

sub new{
  my ($self, %opt) = @_;
  $self->SUPER::new( %opt, value => $opt{data} );
}

sub is_leaf { 1 }

sub get {
  my $self = shift;
  return $self unless @_;
  undef;
}

1;
__END__
