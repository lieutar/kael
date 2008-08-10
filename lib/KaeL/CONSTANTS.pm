
package KaeL::CONSTANTS;

use strict;
use warnings;

my @Exports;
my %Groups;

BEGIN{
  sub const {
    my ($name, @val) = @_;
    {
      no strict 'refs';
      *{$name} =  sub(){  wantarray ? @val : $val[0];  }
    }
    push @Exports , $name;
  }
}

BEGIN{
  const ROOT_CFG   => 'ROOT.cfg';
  const MODULE_CFG => 'MODULE.cfg';
}

use Sub::Exporter -setup => { exports => \@Exports,
                              groups  => { default => [':all'] } };

1
__END__
