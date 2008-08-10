
package KaeL::CGI::Runner::CODE;
use Moose;
has _code => ( is  => 'rw',
               isa => 'CodeRef',
               init_arg => 'code',
               default => sub{
                 join( "\x0d\x0a",
                       "HTTP/1.1 200 OK",
                       "Connection: close",
                       "Content-Type: text/plain",
                       "",
                       "default" )
               }
             );

sub code { _code(@_); }


with qw( KaeL::CGI::Runner );

1;
__END__
