
package KaeL::Registory::Node::Sequence;

use KaeL::Registory;
use Moose; extends qw( KaeL::Registory::Node );

has _children => ( is      => 'ro',
                   isa     => 'ArrayRef',
                   default => sub{ [] });

sub is_sequende{ 1 }

sub new{
  my ($self, %opt) = @_;
  my $data = delete $opt{data};
  $self = $self->SUPER::new(%opt);
  my $n = scalar @$data;
  for( my $i = 0; $i < $n; $i++ ) {
    push @{$self->_children},
      $self->gen( name          => $i,
                  data          => $data->[$i],
                  file          => $self->file,
                  parent        => $self,
                  root          => $self->root,
                  is_array_item => 1);
  }
  $self;
}

sub get {
  my $self = shift;
  return $self unless @_;
  my $head = shift;
  return undef unless $head =~ /[1-9]\d+|0/;
  my $children = $self->_children;
  my $child = $children->[$head];
  return $child->get(@_) if $child;
  undef;
}

sub children {
  my $self = shift;
  my @ret = @{$self->_children};
  wantarray ? @ret : \@ret;
}

sub length {
  my $self = shift;
  scalar @{$self->_children};
}

sub keys {  ( 0 ... ( shift->length - 1 ) ) }

sub value {
  my $self = shift;
  my @ret = ();
  foreach my $child ( $self->children ){
    push @ret, scalar $child->value;
  }
  wantarray ? @ret : \@ret;
}


1;
__END__
