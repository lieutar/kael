
package KaeL::Cache::Script;
use Moose;
use Path::Class;

has core => ( is       => 'rw',
              type     => 'KaeL::Core',
              required => 1,
            );

has scripts => ( is      => 'rw',
                 isa     => 'HashRef[KaeL::Task::Script]',
                 default => sub{ {} }
               );
sub get{
  my $self = shift;
  my $file = shift;
  my $abs = file($file)->absolute;
  my $scripts = $self->scripts;
  if( -f $abs ) {
    unless ( exists $scripts->{$abs} ) {
      $scripts->{$abs} =  KaeL::Task::Script->new( script => $abs,
                                                   core   => $self->core );
    }
    return $scripts->{$abs};
  }
  delete $scripts->{$abs} if exists $scripts->{$abs};
  return;
}


1;
__END__

