package KaeL::Driver;
use Moose::Role;
has core => ( is       => 'ro',
              required => 1 );
requires qw( run );

1;
__END__
