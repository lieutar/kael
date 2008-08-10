
use strict;
use warnings;

use Test::More tests => 2;
BEGIN{ use_ok('KaeL') }
use KaeL::CGI::Runner::Cmd;
use Path::Class;
use UNIVERSAL qw( isa );

sub case ($){
  my $case     = shift;
  my $base     = dir( file(__FILE__)->parent , 'KaeL-CORE' )->absolute;
  my $doc_root = dir( $base , sprintf('case%02d', $case ) , 'doc' );
  my $runner =
    KaeL::CGI::Runner::Cmd->new( document_root => $doc_root,
                                 script        =>
                                 file($doc_root, 'kael.cgi') );
  $runner->interpreter( $^X  );
  $runner;
}


sub cgitest ($@){
  my $runner = shift;
  my %opt = @_;
  my $name = '';
  if( $opt{GET} ){
    $runner->GET( @{ $opt{GET}} );
    $name .= 'GET '. $runner->uri;
  } elsif ( $opt{POST} ){
    $runner->POST( @{ $opt{POST}});
    $name .= 'POST '. $runner->uri;
  }

  my @errors = ();
  my $res = $runner->run;

  while( @_ ){
    my $key = shift;
    my $val = shift;

    next if(
            $key eq 'GET'  or
            $key eq 'POST' or
            0 ) ;

    my $resval = ( ( lc $key eq 'content' ) ? $res->content :
                   ( lc $key eq 'status' )  ? $res->status_line :
                   ( lc $key eq 'code'   )  ? $res->code :
                   $res->header($key) );

    if ( isa($val, 'Regexp') ) {
      unless ( $resval =~ /$val/ ) {
        push @errors, sprintf("%s(%s) is not like /%s/ .",
                              $key,
                              ((defined $resval) ? $resval : 'undef'),
                              $val);
      }
    }
    elsif ( isa($val, 'CODE') ) {
      unless ( eval{ $val->($resval) } ) {
        push @errors, sprintf("Test by predicate for %s failure...\n%s",
                              $key,
                              $@);
      }
    }
    else {
      unless ( $val eq $resval ) {
        push @errors, sprintf("%s(%s) is not %s .",
                              $key,
                             ((defined $resval) ? $resval : 'undef'),
                             $val);
      }
    }
  }

  unless (@errors) {
    ok(1, $name);
  }
  else {
    push @errors , sprintf ("RESPONSE:\n%s",
                           $res->as_string);
    ok(0, $name);
    local $| = 1;
    print join  "\n#----\n" ,  map { s/^/#  /mg; $_ } @errors;
  }
  $runner;
}


$ENV{PERL5LIB} = join( ":", map { dir($_)->absolute } @INC );
#print join "\n", split /:/,$ENV{PERL5LIB}; exit;

cgitest case(0)
  => GET          => [ 'http://foo.bar.com/kael.cgi/test.html' ]
  => code         => 200
  => content_type => qr{\btext/html\b}
  => content      => qr{<title>&lt;title&gt;</title>}
  => content      => qr(<h1>&lt;title&gt;</h1>);

