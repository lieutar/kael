
package KaeL::Driver::CGI;
use Moose; with qw( KaeL::Driver );

sub run {
  my $self = shift;
  my $res  = $self->core->run;
  print $res->as_string;
}

1;
__END__
