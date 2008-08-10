
package KaeL::Task::DirHook;
use Moose; with qw( KaeL::Task );
use KaeL::Types qw( Dir );

has dir     => ( is       => 'rw',
                 isa      => Dir,
                 required => 1 );


sub run {
}

1
__END__
