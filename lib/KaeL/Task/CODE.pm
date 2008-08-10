
package KaeL::Task::CODE;
use Moose; with qw( KaeL::Task );

has code => ( is       => 'ro',
              type     => 'CodeRef',
              required => 1,
            );

sub run {
  my $self = shift;
  $self->code->( $self, ( $self->args ) );
};

1;
__END__
