
package KaeL::ScriptSubs;
use Moose::Role;

has core => ( is       => 'ro',
              isa      => 'KaeL::CORE',
              required => 1
            );

requires qw( subs );

1
__END__
