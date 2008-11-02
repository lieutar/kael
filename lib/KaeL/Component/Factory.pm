
package KaeL::Component::Factory;

use Moose::Role;


has _singleton  => ( is  => 'ro',
                     isa => 'Object',
                   );

has role        => ( is       => 'ro',
                     isa      => 'Moose::Role',
                   );

has singleton   => ( is      => 'ro',
                     isa     => 'Bool',
                     default => 0,
                   );

has initializer => ( is        => 'rw',
                     isa       => 'CodeRef',
                     default   => sub{ sub{} }
                   );

sub get{
  my $self = shift;
  my @args = @_;

  my $is_singleton = $self->singleton;
  if( $is_singleton ){
    my $instance = $self->_singleton;
    return $instance if defined $instance;
  }

  my $instance = $self->create;
  $self->_initialize( $instance );
  $self->_singleton( $instance ) if $is_singleton;
  $instance;
}


sub _initialize {
  my $self = shift;
  my $instance = shift;
  my $initializer = $self->initializer;
  $initializer->( $instance );
}


1;
__END__

