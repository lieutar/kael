
package KaeL::Registory::Reader;
use Moose;
use MooseX::Types::Path::Class qw( File );
use KaeL::Registory::Node;
use Path::Class;
use KaeL::Registory::Node::Stub;
use YAML::Syck;

has decoder =>
  ( is      => 'ro',
    isa     => 'HashRef[CodeRef]',
    default => sub{
      my $yaml = sub{ scalar YAML::Syck::Load( $_ ) };
      return { '.raw'  => sub{ $_ },
               '.txt'  => sub{ Encode::decode( $_ , 'utf8' ) },
               '.yaml' => $yaml,
               '.yml'  => $yaml }
    },
  );

sub suffixes {
  my $self = shift;
  keys %{ $self->decoder };
}

sub set_decoder{
  my ($self, $suffix, $code) = @_;
  $self->decoder->{$suffix} = $code;
}

sub stub {
  my ($self, %opt) = @_;

  (exists $opt{path}) and do{

    my $path = Path::Class::File->new( @{$opt{path}} );
    my $name = $path->basename;

    foreach my $suffix ( $self->suffixes ){
      my $file = $path . $suffix;
      next unless -f $file;
      return KaeL::Registory::Node::Stub
        ->new( %opt,
               decoder => $self->decoder->{$suffix},
               name    => $name,
               file    => Path::Class::File->new($file) );
    }

    return undef unless -d $path;
    $opt{file} = $path;
  };


  ( exists $opt{file} ) and do{

    my $file = Path::Class::File->new( $opt{file} );
    my $name = $file->basename;

    return KaeL::Registory::Node::Stub
      ->new( %opt,
             decoder => sub{{}},
             name    => $name,
             file    => $file ) if -d $file;

    return undef unless -f $file;

    my $pat = sprintf '(?:%s)\Z', join '|', map quotemeta $_, $self->suffixes;
    return undef unless $name =~ s/($pat)//;
    return KaeL::Registory::Node::Stub
      ->new( %opt,
             decoder => $self->decoder->{$1},
             name    => $name,
             file    => Path::Class::File->new($file) );
  };

  confess "essential argument file or path was not found"

}

1;
__END__

