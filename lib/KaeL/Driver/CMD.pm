
package KaeL::Driver::CMD;
use Moose; with qw( KaeL::Driver );
use KaeL::CGI::Runner::CODE;

sub run {
  my $self   = shift;
  my $core   = $self->core;
  my $res;
  my $runner = KaeL::CGI::Runner::CODE->new( code => sub{
                                               $res = $core->run;
                                             });
  my $env = $runner->env;
  $runner->run;
  print $res->as_string;
}

1;
__END__
