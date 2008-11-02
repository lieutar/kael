
package KaeL::Component::Factory::Class;

use Moose;

has class => ( is       => 'ro',
               required => 1 );


has factory => ( is      => 'ro',
                 isa     => 'Str',
                 default => 'new' );

has args    => ( is     => 'ro',
                 isa    => 'ArrayRef' );


sub _factory_args {
  my $self = shift;
  @{ $self->args };
}

sub create {
  my $self    = shift;
  my $class   = $self->class;
  my $factory = $self->factory;
  my @args    = $self->_factory_args;
  $class->$factory( @args );
}

1;
__END__
