
package KaeL::Resource;
use Moose::Role;

requires qw( type
             ctime
             mtime
             atime
             content );

1
__END__
