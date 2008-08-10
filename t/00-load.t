#!perl -T

use Test::More tests => 1;

BEGIN { use_ok( 'KaeL::CORE' ); }

diag( "Testing KaeL $KaeL::CORE::VERSION, Perl $], $^X" );
