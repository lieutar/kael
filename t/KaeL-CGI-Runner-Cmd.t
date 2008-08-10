
use strict;
use warnings;
use Path::Class;
use Test::More tests => 11;
BEGIN{ use_ok('KaeL::CGI::Runner::Cmd') }

my $dir    = dir( file(__FILE__)->parent . '/KaeL-CGI-Runner' )->absolute;
my $r =  KaeL::CGI::Runner::Cmd->new( script_filename => "$dir/env.pl",
                                      document_root   => $dir );


is( $r->document_root , $dir       );
is( $r->script_name   , '/env.pl'  );



$r->GET('http://foo.bar.com/env.pl/foo/bar?aaabbb');
is( $r->path_info     , '/foo/bar' );

$r->interpreter($^X);
like( $r->command_line ,
      do{ my $script = $r->script_filename;
          qr{$^X\s+$script}; });

my $res = $r->run;
is( $res->code, 200 );

my %e = do{ no strict;  %{ eval $res->content }};
is( $e{REQUEST_METHOD} , 'GET' );
is( $e{DOCUMENT_ROOT}  , $dir);
is( $e{SERVER_NAME}    , 'foo.bar.com');
is( $e{PATH_INFO}      , '/foo/bar' );
is( $e{QUERY_STRING}   , 'aaabbb' );
