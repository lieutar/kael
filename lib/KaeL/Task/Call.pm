
package KaeL::Task::Call;
use Moose; with qw(KaeL::Task);
use Moose::Util qw( does_role );

has callee => ( is      => 'ro',
               isa     => 'KaeL::Task',
               reuired => 1 );

has exprs => ( is       => 'ro',
               default  => sub{[]},
               required => 1 );

has _args => ( is      => 'ro',
               isa     => 'ArrayRef',
               default => sub{[]} );

has _pc  => ( is      => 'rw',
              isa     => 'Int',
              default => 0 );

sub push_arg {
  my $self = shift;
  my $arg  = shift;
  push @{$self->_args} , $arg;
}

sub run {
  my $self = shift;
  my $exprs  = $self->exprs;
  my $len    = @{$exprs};
  for(my $pc = $self->_pc; $pc < $len ; $pc = $self->_pc( $pc + 1)){
    my $expr = $exprs->[$pc];
    if( does_role($expr, 'KaeL::Task') ){
      return KaeL::Task::Call::Child->new( parent => $self,
                                           child  => $expr );
    }
    else {
      $self->push_arg( $expr );
    }
  }
  my $callee = $self->callee;
  $callee->args( $self->_args );
  return $callee;
}

1;
__END__
