
package KaeL::Task;
use Moose::Role;

=head2 C<container>

Contains its container.

=head1 DESCRIPTION

C<KaeL::Task> is a role of running context in KaeL, 
It knows its behavior and its data and its continuation.

=head1 ATTRIBUTES

=cut
 
has core =>
  ( is       => 'rw',
    isa      => 'KaeL::CORE',
    weak_ref => 1,
    handles  => qr{\A
                   (?!
                     (?: _.*
                     | run
                     | slot
                     | core
                     )
                     \Z
                   )}x);

has session_db =>
  ( is         => 'rw',
    does       => 'KaeL::Session',
    weak_ref   => 1,
    handles    => {
                   session        => 'slot',
                   session_exists => 'has_slot',
                  });

has args => ( is      => 'rw',
              does    => 'ArrayRef',
              default => sub{[]},
             );

around args => sub{
  my $orig = shift;
  my $self = shift;
  my $ret  = $orig->( $self, @_ );
  return [ @$ret ] unless wantarray;
  @{ $ret };
};


=head1 METHODS

=head2 C<process>

Subclass of the class defines main process of it to this method.
The C<run> method triggers this method.

If it needs to execute other task, the return value of this is
the instance of this class which will execute. So container of 
this object receives it and runs it.

=head2 C<put>

Puts property for current enviroment.

=head2 C<get>

Get property from current enviroment.

=cut

requires qw( run );

1;
__END__
