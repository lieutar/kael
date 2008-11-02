package KaeL::Registory::Node::Map;
use KaeL::Registory;
use Moose; extends qw( KaeL::Registory::Node );


has _children => ( is      => 'ro',
                   isa     => 'HashRef',
                   default => sub{ {} } );


has _dir =>
  ( is      => 'rw',
    lazy    => 1,
    isa     => 'HashRef',
    default => sub{
      my $self = shift;
      my $root = $self->root;
      my $base = $root->base;
      my $dir  = Path::Class::Dir->new( $base , $self->path );
      return {} unless -d $dir;

      my $ret  = {};
      foreach my $child ( $dir->children ){

        my $decoders = $root->decoder;
        my $name     = Path::Class::File->new( $child )->basename;
        my $decoder  = undef;
        if( -d $child ){
          $decoder = sub{{}};
        }
        else {
          my $pat = sprintf( '(?:%s)\Z',
                             join '|', map quotemeta $_,
                             CORE::keys %$decoders );
          next unless $name =~ s/($pat)//;
          $decoder = $decoders->{$1};
        }

        $ret->{$name} = KaeL::Registory::Node::Stub
          ->new( parent        => $self,
                 is_array_item => 0,
                 decoder       => $decoder,
                 name          => $name,
                 file          => $child,
                 root          => $root,
               );
      }
      $ret;
    } );



sub new{
  my ($self, %opt) = @_;
  my $data = delete $opt{data};
  $self = $self->SUPER::new(%opt);
  my $children = $self->_children;

  foreach my $key ( CORE::keys %$data ){
    $children->{$key} = $self->gen( name          => $key,
                                    data          => $data->{$key},
                                    file          => $self->file,
                                    parent        => $self,
                                    root          => $self->root,
                                    is_array_item => 0);
  }
  $self;
}



sub is_map{ 1 }


sub keys {
  my $self = shift;
  my @keys = CORE::keys %{ { %{$self->_children} ,  %{$self->_dir}}};
  return @keys;
}


sub length {
  my $self = shift;
  scalar @{[$self->keys]};
}


sub value {
  my $self = shift;
  my %ret = ();

  foreach my $key ( $self->keys ){
    my $child = $self->get($key);
    $ret{$key} = $child->value;
  }

  wantarray ? %ret : \%ret;
}



sub get {
  my $self = shift;
  return $self unless @_;

  my $head = shift;
  my $children = $self->_children;
  my $child = $children->{$head};

  unless( $child ) {
    my $dir = $self->_dir;
    return undef unless exists $dir->{$head};
    $child = $children->{$head} = $dir->{$head}->gen;
  }

  $child->get( @_ );
}


1;
__END__
