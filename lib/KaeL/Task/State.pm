
package KaeL::Task::State;
use Moose::Role; with( KaeL::Task::Runnable );

has _dic  => ( is  => 'ro', isa => 'Num' );
has value => ( is => 'rw' ),
has task  => ( is       => 'rw'
               does     => 'KaeL::Task',
               required => 1 );

requires qw(
             req
             res
             user
             log
             cfg
          );


sub run {
  my ( $self ) = @_;
  undef $@;
  my $cont = $self->task;
  for(;;){
    if ( UNIVERSAL::isa($cont , 'CODE') ){
      require KaeL::Task::Code;
      $cont = KaeL::Task::Code->new( $cont );
    }
    last unless does_role($cont, 'KaeL::Task' ) ;
    last if $cont == $self;
    $cont = $self->task( $cont->run );
  }
}

package KaeL::Task::State::Simple;
use Moose; with qw( KaeL::Task::State );

do{
  my $meth = $_;
  __PACKAGE__->meta->add_method( $meth => sub{ shift->app->$meth(@_) } );
} foreach qw( req res user cfg );

sub log{
  my $self = shift;
  $self->app->log( preprocess_log( @_) );
}

1;
__END__
