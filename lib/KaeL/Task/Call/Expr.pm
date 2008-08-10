
package KaeL::Task::Call::Expr;
use Moose; with qw(KaeL::Task);

has parent => ( is      => 'ro',
                is_weak => 1,
                isa     => 'KaeL::Task',
                reuired => 1 );

has child => ( is       => 'ro',
               is_weak  => 1,
               isa      => 'KaeL::Task',
               requierd => 1 );

sub run{
  my $self = shift;
  my $ret = $self->child->run;
  $ret = KaeL::Task::CODE->new( code => $ret ) if ref($ret) eq 'CODE';
  return
    __PACKAGE__->new( parent => $self->parent,
                      child  => $ret ) if does_role( $ret, 'KaeL::Task' );
  my $parent = $self->parent;
  $parent->push_arg( $ret );
  $parent;
}


1
__END__
