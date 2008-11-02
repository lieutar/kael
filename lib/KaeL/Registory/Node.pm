package KaeL::Registory::Node;
use Moose;
use MooseX::Types::Path::Class qw( Dir File );
use KaeL::Registory;

has name   =>
  (
   is       => 'ro',
   isa      => 'Str',
   coerce   => 1,
   required => 1,
  );

has root =>
  (
   is       => 'ro',
   isa      => 'KaeL::Registory',
   weak_ref => 1,
   required => 1,
  );

has file   =>
  (
   is       => 'ro',
   required => 1,
  );

has parent =>
  (
   is       => 'ro',
   weak_ref => 1,
   isa      => 'Maybe[KaeL::Registory::Node]',
  );

has is_array_item =>
  (
   is      => 'ro',
   isa     => 'Bool',
   default => 0,
  );

sub path {
  my $self = shift;
  my $parent = $self->parent;
  return ( @_ ) unless $parent;
  $parent->path( $self->name , @_ );
}

sub get{}

sub is_leaf{ 0 }
sub is_map{ 0 }
sub is_sequende{ 0 }
sub append_child{}

sub gen {
  my $self  = shift;
  my %opt   = @_;
  my $data  = $opt{data};
  ( ( ref $data ) eq 'HASH'  ? 'KaeL::Registory::Node::Map' :
    ( ref $data ) eq 'ARRAY' ? 'KaeL::Registory::Node::Sequence' :
    'KaeL::Registory::Node::Leaf'  )->new( %opt ) ;
}

sub exists {
  my $self = shift;
  defined $self->get( @_ );
}

sub value  { () }
sub keys   { () }
sub length { 1  }

1;
__END__
