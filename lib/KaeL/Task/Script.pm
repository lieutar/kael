
package KaeL::Task::Script;
use Moose; extends qw( KaeL::Task::CODE );
use KaeL::Types qw( File );

has script => ( is       => 'rw',
                type     => File,
                required => 1,
              );

has code => ( is       => 'rw',
              type     => 'CodeRef',
             );

has _mtime => ( is   => 'rw',
                type => 'Num');

sub run {
  my $self = shift;
  my $file = $self->script;
  my $stat = $file->stat;
  my $mtime = $self->_mtime;
  unless( defined( $mtime ) &&
          $stat->mtime <= $mtime ) {
    $self->code( $self->core->compilescript( $file ) );
    $self->_mtime( $stat->mtime );
  }
  $self->SUPER::run;
};

1;
__END__
