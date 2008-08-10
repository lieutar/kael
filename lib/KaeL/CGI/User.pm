
package KaeL::CGI::User;

use Moose;

foreach my $f ( [ addr  => '127.0.0.1' ],
                [ host  => 'localhost' ],
                [ ident => '' ],
                [ user  => '' ], ) {
  {
    my ( $name, $default ) = @$f;
    my $key = 'REMOTE_'. uc $name;
    has $name => ( is      => 'rw',
                   default =>
                   sub{ defined( $ENV{$key} ) ? $ENV{$key} : $default } );
  }
}


1;
__END__
