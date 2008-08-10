
package KaeL::Resource::File;

use Moose;
use Sub::Name;
use File::MimeInfo qw( globs );

has file => ( is       => 'ro',
              isa      => File,
              required => 1 );

do{
  my $meth = $_;
  __PACKAGE__->meta->add_method( $meth =>  sub{
    my $self = shift;
    $self->file->stat->$meth;
  } );
} foreach qw( ctime mtime atime );

 with qw( KaeL::Resource );

sub type {
  my $self = shift;
  globs($self->file) or 'application/octet-stream';
}

sub content {
  scalar shift->file->slurp;
}


1
__END__
