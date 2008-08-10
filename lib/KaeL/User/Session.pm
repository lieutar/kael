
package KaeL::User::Session;
use Moose;

has id
  => is => ro
  => isa => Str
  => ;

has lifetime
  => is => rw
  => isa => Num
  => default => -1
  => ;

has generated
  => is => rw
  => default => sub{ time }
  => ;

has modified
  => is => rw
  => default => sub{ time }
  => ;

has data
  => is => rw
  => ;

1;
__END__

