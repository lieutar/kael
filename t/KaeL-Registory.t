
use strict;
use warnings;
use Test::More qw( no_plan );
use Data::Dumper;

BEGIN{
  sub die_like (&$;$){
    my $block = shift;
    my $regex = shift;
    if( eval{ $block->() ; 1 } ) {
      &fail(@_);
    }
    else {
      &like( $@, $regex, @_ );
    }
  }
}

sub dmp ($){
  my $val = shift;
  diag Dumper $val;
  $val;
}


use KaeL::Registory;
use Path::Class;
use Test::Deep;

TODO:
{
  my $reg = KaeL::Registory->new( base => "". file( file( __FILE__ )->parent,
                                                    'KaeL-Registory/case00') );
  cmp_deeply( dmp $reg->value  ,
             {
              '00' => 'xxx',
              '01' => 'yyy',
              '02' => [qw( a b c )]
             });
}


TODO:
{
  my $reg = KaeL::Registory->new( base => "". file( file( __FILE__ )->parent,
                                                    'KaeL-Registory/case01') );
  my $val =  $reg->value;
  cmp_deeply( dmp $val  ,
             {
              abc => 'xxx',
              def => {
                      ghi => 'yyy',
                      jkl => {
                              mno => 'zzz',
                             },
                      pqr => 'AAA',
                     }
             });
}
