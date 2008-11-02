
use strict;
use warnings;
package KaeL::CMD;
use Path::Class;
use Sub::Exporter;

sub import{

  my %export = ();

  foreach my $path ( @INC ){
    next unless -d ( my $dir =  dir($path , 'KaeL', 'CMD' ) );
    foreach my $child ( $dir->children ) {
      my $name = $child->relative( $dir );
      $name =~ s/\.pm\Z//;
      require "KaeL/CMD/${name}.pm";
      my $sub = do{ no strict 'refs'; \&{"KaeL::CMD::${name}::$name"}; };
      $export{$name} = sub{ sub{ $sub->(@ARGV) } };
    }
  }

  my $exporter =  Sub::Exporter::build_exporter
    ( { exports => \%export,
        groups  => { default => [':all'] }
      } );

  goto $exporter;
}

1;
__END__
