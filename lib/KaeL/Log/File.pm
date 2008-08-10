
package KaeL::Log::File;
use Moose; with qw( KaeL::Log );
use KaeL::Types qw( WritableDir );

has logdir => ( is  => 'ro',
                isa => WritableDir,
              );

sub _log {
  my $self = shift;
  my %info = @_;
}


1;
__END__
