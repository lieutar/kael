
package KaeL::Frame::Slot;
use Moose;

has container => ( is       => 'rw',
                   weak_ref => 1 );

has naem => ( is       => 'ro',
              isa      => 'Str',
              required => 1 );

has ns => ( is       => 'ro',
            isa      => 'Str',
            required => 1 );

has name => ( is       => 'ro',
              isa      => 'Str',
              required => 1);

has value => ( is => 'rw' );


sub fully_name {
  my $self = shift;
  join( "\t", ( (blessed $self)
                ? ( $self->ns , $self->name )
                : @{{@_}}{qw(ns name)} ) );
}

sub drop {
  my $self = shift;
  $self->container->drop($self);
}

1;
__END__
