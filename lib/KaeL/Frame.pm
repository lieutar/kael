
package KaeL::Frame;
use Moose::Role;
use KaeL::Frame::Slot;

has dic => ( is      => 'ro',
             isa     => 'HashRef',
             default => sub{ sub{} });

has parent => ( is  => 'rw',
                   weak_ref => 1,
                   isa => 'KaeL::Session' );

sub has_slot {
  my $self = shift;
  my ($name, %opt) = _prepare_args(@_);
  $self->_has_slot( $name );
}

sub _slot {
  my $self = shift;
  my ($name) = @_;
  return $self->dic->{$name} if exists $self->dic->{$name};
  throw KaeL::Session::NoSuchSlot unless my $parent = $self->parent;
  unshift @_, $parent;
  goto $parent->can('_slot');
}

sub _define {
  my ( $self, $name , %opt ) = @_;
  return $self->dic->{$name} if exists $self->dic->{$name};
  my $new = KaeL::Session::Slot->new( %opt, session => $self );
  $self->dic->{$name} = $new;
  $new;
}

sub _prepare_args {
  my %args;
  if ( @_ % 2 ) {
    my $name = shift;
    %args = @_;
    $args{name} = $name;
  }
  else {
    %args = @_;
  }

  $args{ns}    = __PACKAGE__ unless exists $args{ns};
  $args{scope} = 'current';

  (KaeL::Session::Slot->fully_name(%args), %args);
}

sub slot {
  my $self = shift;
  my ($name, %opt) = _prepare_args(@_);
  return $self->_define( $name , %opt )  if $opt{define};
  $self->_slot( $name )
}

sub _has_slot {
  my $self = shift;
  my ($name) = @_;
  return 1 if exists $self->dic->{$name};
  return 0 unless my $parent =  $self->parent;
  unshift @_, $parent;
  goto $parent->can('_has_slot');
}

sub drop {
  my $self = shift;
  my $slot = shift;
  delete $self->dic->{$self->$slot->fully_name};
}



1;
__END__
