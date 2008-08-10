
package KaeL::Log;
use Moose::Role;

has core => ( is       => 'ro',
              required => 1,
              isa      => 'KaeL::CORE'  );

requires qw( _log );

sub log {

  my $self = shift;
  my %dat  = ( facility => 'trace' );

  if ( scalar( @_ ) % 2 ){
    $dat{data}  = shift;
  }
  else {
    $dat{facility} = shift;
    $dat{data}     = shift;
  }

  my $level = 0;
  while( @_ ){
    my $key = shift;
    my $val = shift;
    if( $key eq 'level' ){
      $level += $val;
    }
    else {
      $dat{$key} = @_;
    }
  }

  $self->_log( %dat );

}

1;
__END__

