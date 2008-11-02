
package KaeL::Registory;
use Moose;
use MooseX::Types::Path::Class qw( Dir File );
use YAML::Syck;
use KaeL::Registory::Node::Leaf;
use KaeL::Registory::Node::Sequence;
use KaeL::Registory::Node::Map;
use KaeL::Registory::Node::Stub;
use Path::Class;
use Carp;

has base   => (
               is        => 'ro',
               required  => 1,
              );

has root   =>
  (
   is      => 'ro',
   isa     => 'KaeL::Registory::Node',
   lazy    => 1,
   default => sub{
     my $self = shift;
     my $root = $self->read;
     confess "cannot read root of configuration from (".$self->base.")"
       unless defined $root;
     $root;
   },
   handles => qr{\A(?!
                   (?:
                     new|
                     root|
                     file|
                     _.*
                   )\Z
                 )}x,
  );

has _decoder =>
  ( is      => 'ro',
    isa     => 'HashRef[CodeRef]',
    default => sub{
      return { '.raw'  => sub{ $_ },
               '.txt'  => sub{ Encode::decode( $_ , 'utf8' ) },
               '.yaml' => sub{ scalar YAML::Syck::Load( $_ ) } }
    },
  );

sub decoder{
  my $self = shift;
  my $data = $self->_decoder;
  return %{{ %$data }} unless @_;
  my $key = shift;
  $key =~ s/\A(?!\.)/./;
  if( @_ ) {
    my $code = shift;
    if( defined $code ){
      $data->{$key} = $code;
    }
    else {
      delete $data->{$key};
    }
  }
  $data->{$key};
};

sub read {
  my $self     = shift;
  my $path     = Path::Class::File->new( $self->base, @_ );
  my $name     = $path->basename;
  my $decoders = $self->decoder;
  my $file     = undef;
  my $decoder  = undef;

  foreach my $suffix ( keys %$decoders ){
    my $tmp = $path . $suffix;
    next unless -f $tmp; 
    $decoder = $decoders->{$suffix};
    $file    = Path::Class::File->new($tmp);
    last;
  }

  unless( defined $file ){
    return undef unless -d $path;
    $file = $path;
    $decoder = sub{ {} }
  }

  KaeL::Registory::Node::Stub->new( root    => $self,
                                    decoder => $decoder,
                                    name    => $name,
                                    file    => $file )->gen;
}

1;
__END__
