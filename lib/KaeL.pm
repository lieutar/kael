package KaeL;

=pod

=head1 NAME

KaeL - Yet Another extensible web resource handler framework.

=head1 DESCRIPTION

KaeL has below features.

=over 4

=item KaeL can wrok standalone or with Apache (1.3 or later)  + mod_rewrite.

This framework is designed as a CGI script that work with a
rewriting of mod_rewrite.


=item KaeL is extends web resource handler by perl modules and simple perl scripts.

=item KaeL can work as CGI Handler of any script of any languages.

=head1 What is KaeL

KaeL means frog or toad in Japanese. 
But the spell of it is not regular spelling in Japanese roma-ji .


=back


=cut



our $VERSION = '0.01';

use strict;
use warnings;

sub import {
  my $pkg = shift;
  if( $0 eq '-e' or ( $_[0] and $_[0] eq '-cmd' ) ){
    require KaeL::CMD;
    goto \&KaeL::CMD::import;
  }
}

1; # End of KaeL::CORE
__END__
