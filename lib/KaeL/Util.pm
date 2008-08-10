
use strict;
use warnings;
package KaeL::Util;
use Carp;
use Sub::Install;
use Sub::Name;
use UNIVERSAL qw( isa can );
use PerlDSL::Perl;
require Data::Thunk;

require Path::Class;
my @Exports = ();
my %Groups  = ();

BEGIN {
  sub def {
    my ( $name, $sub , @groups ) = @_;
    my $glob = do{ no strict 'refs'; \*{$name} };
    *{$glob} = subname __PACKAGE__."::$name" => $sub;
    push @Exports , $name;
    foreach my $group ( @groups ) {
      push @{ $Groups{$group} ||= [] }, $name;
    }
  }
}

BEGIN{
  my $count = 0;
  def gensym => sub(){
    require Time::HiRes;
    join ( "_",
           map sprintf( '%X',$_ ), ( $$,
                                     Time::HiRes::gettimeofday() ,
                                     int ( 0xFFFFFFFF *  rand ),
                                     $count++ ) )
  } , qw( default );
}

BEGIN{
  def lazy  => \&Data::Thunk::lazy , qw( script_convenience );
  def delay => \&Data::Thunk::lazy , qw( script_convenience );
  def  uri => sub{
    require URI;
    URI->new(@_);
  } , qw( default );
};

use Sub::Exporter -setup => { exports => \@Exports,
                              groups  => \%Groups };

1;
__END__

