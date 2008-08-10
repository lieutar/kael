
package KaeL::HTTP::Request;
use Moose;
use Carp;
use CGI::Simple;
use CGI::Simple::Cookie;
use URI;
use HTTP::Headers;
use Sub::Name;

use constant BUFFER_SIZE => 4096;
our @CGIMETHODS = qw( param
                      url_param
                      keywords
                      upload
                      upload_fields
                      upload_fieldnames
                      upload_info
                      http
                      https
                      protocol
                      url
                      self_url
                      query_string
                      path_info
                      );

has headers => ( is      => 'ro',
                 isa     => 'HTTP::Headers',
                 handles => qr{\A
                               (?!
                                 _|
                                 (?:
                                   as_string
                                 )\Z
                               )}x,
                 default => sub{
                   my $o = HTTP::Headers->new;
                   while ( my ($key , $value) = each %ENV ) {
                     $key =~ /^CONTENT_/ and do{
                       $o->header( $key => $value );
                       next;
                     };
                     $key =~ /^HTTP_/ and do{
                       $o->header( $' => $value );
                       next;
                     };
                   }
                   $o;
                 },
               );

has cookies => ( is      => 'ro',
                 default => sub{ my $cooks = CGI::Simple::Cookie->fetch;
                                 \%{ defined($cooks)
                                       ? $cooks : {} } }
               );

has _cgi => ( is      => 'ro' ,
              isa     => 'CGI::Simple',
              handles => \@CGIMETHODS
            );

has app => ( is   => 'ro',
             weak => 1 );

sub cookie($$){
  my ($self, $name) = @_;
  return undef unless exists $self->cookies->{$name};
  $self->cookies->{$name}->value;
}


sub uri {
  my $self = shift;
  return URI->new( $ENV{REQUEST_URI}
                   ? $ENV{REQUEST_URI}
                   : $self->_cfg->url);
}

1;
__END__
