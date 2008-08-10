package KaeL;

=pod

=head1 NAME

KaeL - Yet Another extensible web resource handler framework.

=head1 DESCRIPTION

KaeL has below features.

=over 4

=item KaeL can wrok standalone or with Apache (1.3 or later)  + mod_rewrite.

This framework is designed as a CGI script that work with a
rewriting of mod_rewrite.


=item KaeL is extends web resource handler by perl modules and simple perl scripts.

=item KaeL can work as CGI Handler of any script of any languages.

=head1 What is KaeL

KaeL means frog or toad in Japanese. 
But the spell of it is not regular spelling in Japanese roma-ji .


=back


=cut



our $VERSION = '0.01';

use Moose;
use UNIVERSAL::require;
use KaeL::CORE;
use Sub::Exporter
  -setup => { exports => [qw( run )],
              groups  => { default => [qw( :all )]}};

sub usage {
  my $err = shift;
  print "$err\n" if $err;
  print "usage:\n";
  exit;
}


sub run {
  my $driver_name = shift @ARGV;
  usage unless $driver_name;
  my $driver_class = "KaeL::Driver::$driver_name";
  local $@ = undef;
  eval "require $driver_class;";
  usage $@ if $@;
  my $core = KaeL::CORE->new( @ARGV );
  my $driver = $driver_class->new( @ARGV,
                                   core => $core );
  $driver->run;
}

1; # End of KaeL::CORE
__END__
