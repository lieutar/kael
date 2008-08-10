
package KaeL::Task::Interrupt;
use Moose; extends qw( KaeL::Task::Exception );

has test  =>
  (
   is     => ro ,
   isa    => KaeLTask ,
   coerce => 1
  );

has continuation =>
  (
   is     => ro ,
   isa    => KaeLTask ,
   coerce => 1
  );

sub run {
  my $self = shift;
  my $app = $self->app;
  $self->app->reserve
    (
     sub{
       return $self->continuation if $self->test->($self) ;
       return $self->app->default_task;
     }
    );
}

1;
__END__
