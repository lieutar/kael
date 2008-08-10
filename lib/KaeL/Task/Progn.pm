
package KaeL::Task::Progn;
use Moose; with qw( KaeL::Task::Simple );
use Moose::Util qw( does_role );

has _pc       => ( is      => 'rw' ,
                   isa     => 'Num',
                   default => 0 );

has _children => ( is      => 'rw',
                   isa     => 'ArrayRef'
                   default => sub{[]} );

sub add_task {
  my ($self , $child) = @_;
  $child->contaienr( $self );
  push @{$self->_children}, $child;
}

sub set_task {
  my ($self , $child) = @_;
  $child->contaienr( $self );
  $self->_children->[$self->_pc] = $child;
  next;
}

sub run {

  my ($self) = @_;
  my $child  = $self->_children->[$self->_pc];
  $self->_pc->(1 + $self->_pc);
  return  unless defined $child;

  sub{
    my $next = $child->run;
    return $next if does_role $next , 'KaeL::Task';
    $selr->value($next) if $next;
    $self;
  };

}

1;
__END__
