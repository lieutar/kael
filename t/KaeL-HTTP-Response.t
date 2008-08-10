# Before `make install' is performed this script should be runnable with
# `make test'. After `make install' it should work as `perl KaeL-HTTP-Response.t'

#########################

# change 'tests => 1' to 'tests => last_test_to_print';
my $tests;

use Test::More tests => 4;
BEGIN { use_ok('KaeL::HTTP::Response') };

#########################

# Insert your test code below, the Test::More module is use()ed here so read
# its man page ( perldoc Test::More ) for help writing this test script.

my $o = KaeL::HTTP::Response->new;
is($o->endl , "\x0d\x0a");
is($o->code , 200);
$o->header( -status => 300 );
is($o->code , 300);

