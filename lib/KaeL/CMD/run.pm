
use strict;
use warnings;
package KaeL::CMD::run;

use Path::Class;
use KaeL::CORE;

sub usage {
  my $err = shift;
  print "$err\n" if $err;
  print "usage:\n";
  exit;
}

sub run {
  my $driver_name = shift;
  usage unless $driver_name;
  my $driver_class = "KaeL::Driver::$driver_name";
  eval "require $driver_class;";
  usage $@ if $@;
  my $core = KaeL::CORE->new( @_ );
  my $driver = $driver_class->new( @_ ,
                                   core => $core );
  $driver->run;
}

1;
__END__
