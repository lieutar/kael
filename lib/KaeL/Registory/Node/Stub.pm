
package KaeL::Registory::Node::Stub;
use Moose; extends qw( KaeL::Registory::Node );

has decoder => ( is       => 'ro',
                 isa      => 'CodeRef',
                 required => 1 );


sub gen{
  my $self = shift;
  local $_ = $self->file->slurp;
  KaeL::Registory::Node->gen(
                             root   => $self->root,
                             name   => $self->name,
                             file   => $self->file,
                             parent => $self->parent,
                             data   => $self->decoder->(),
                            );
}


1;
__END__
