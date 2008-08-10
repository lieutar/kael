
use strict;
use warnings;
use Path::Class;
use Test::More tests => 9;
BEGIN{ use_ok('KaeL::CGI::Env') }

my $dir = dir( file(__FILE__)->parent . '/KaeL-CGI-Runner' )->absolute;
my $e   =  KaeL::CGI::Env->new( script_filename => "$dir/env.pl",
                                        document_root   => $dir );

$e->GET('http://foo.bar.com/env.pl/foo/bar?aaabbb');

is( $e->document_root , $dir       );
is( $e->script_name   , '/env.pl'  );
is( $e->path_info     , '/foo/bar' );

my %e = $e->as_hash;
is( $e{REQUEST_METHOD} , 'GET' );
is( $e{DOCUMENT_ROOT}  , $dir);
is( $e{SERVER_NAME}    , 'foo.bar.com');
is( $e{PATH_INFO}      , '/foo/bar' );
is( $e{QUERY_STRING}   , 'aaabbb' );
