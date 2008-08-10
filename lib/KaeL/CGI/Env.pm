
use strict;
use warnings;
package KaeL::CGI::Env;

=pod

=head1 NAME

KaeL::CGI::Runner - Runs cgi script under specified environment.

=head1 SYNOPSYS

  my $r = KaeL::CGI::Runner->new( script => "path/to/script.cgi" );
  
  # set new request that is built  with HTTP::Request::Common methods
  $r->GET("http://localhost/path/to/script.cgi/with/path/info?query=string");
  
  print $res->as_string;

=cut

use Moose;
require KaeL::CGI::User;
require HTTP::Response;
require HTTP::Request;
require HTTP::Request::Common;
use MooseX::Types::Path::Class qw( Dir File );
use Path::Class;

=pod

=head1 ATTRIBUTES

=head2 C<req>

a L<HTTP::Request> object.

=head2 C<document_root>

a L<Path::Class::Dir> object.

=head2 C<script>

a L<Path::Class::Dir> object.

=head2 C<path_info>

If it was specified the runner uses this value, otherwise the value
of this property is delivered from C<document_root> , C<script> and
the url of C<req>.

=head2 C<protocol>

It describe protocol name. The default value of it is "HTTP/1.1"

=cut


has req           => ( is       => 'rw',
                       isa      => 'HTTP::Request' );

has user          => ( is       => 'rw',
                       isa      => 'KaeL::CGI::User',
                       default  => sub{  KaeL::CGI::User->new  });

has path_info     => ( is       => 'rw' );

around 'path_info' => sub {
  my $orig = shift;
  my $self = shift;
  my $val  = $orig->( $self );
  return $val if defined $val;
  my $path   = $self->uri->path;
  my $script = quotemeta $self->script_name;
  return '' unless $path =~  s#^$script##;
  $path;
};


has protocol      => ( is       => 'rw',
                       default  => 'HTTP/1.1' );

has server_software => ( is     => 'rw',
                         default => __PACKAGE__ );

has gateway_interface => ( is      => 'rw',
                           default => __PACKAGE__ );

has script_name => ( is      => 'rw', );

around 'script_name' => sub{
  my $orig = shift;
  my $self = shift;
  unless (@_) {
    my $script_name     = $orig->($self);
    return $script_name if defined $script_name;
    $script_name = $self->script_filename;
    my $document_root   = $self->document_root;
    return '' unless ( defined($script_name) and
                       defined($document_root));
    my $qdr = quotemeta $document_root;
    return '' unless $script_name =~ s/^$qdr//;
    return $script_name;
  }
  $orig->($self, @_);
};


has script_filename => ( is      => 'rw',
                         default => '',
                       );

has document_root => ( is       => 'rw',
                       isa      => Dir,
                       coerce   => 1,
                       default  => sub{ dir(".")->absolute },
                     );


=pod

=head1 METHODS

=head2 C<port>

Returns port number from the request.

=head2 C<script_filename>

Returns absolute path to the script.

=head2 C<script_name>

Returns script name from the request.

=head2 C<uri>

Returns url from the request.

=head2 C<path_transrated>

Returns path of the url if the path was transrated.

=cut

sub port {
  my $self = shift;
  my $port = $self->uri->port;
  ( defined $port          ) ? $port :
    ( $self->uri->scheme eq 'https') ? 443   : 80;
}

sub uri{
  my $self = shift;
  my $req  = $self->req;
  return URI->new("file://". $self->script_name) unless defined $req;
  return URI->new($req->uri);
};

sub path_transrated {
  my $self      = shift;
  return '' if $self->path_info eq '';
  $self->uri->path;
}

=pod

=head2 C<with_env>


=cut

sub as_hash {
  my ( $self ) = @_;
  my $user  = $self->user;
  my $req   = $self->req;
  my $uri   = $self->uri;

  my %e = ( REMOTE_ADDR       => $user->addr,
            REMOTE_HOST       => $user->host,
            REMOTE_IDENT      => $user->ident,
            REMOTE_USER       => $user->user,

            SERVER_SOFTWARE   => $self->server_software,
            GATEWAY_INTERFACE => $self->gateway_interface,

            SERVER_PROTOCOL   => $self->protocol,
            REQUEST_METHOD    => $req->method,
            REQUEST_URI       => $uri->as_string,
            SERVER_NAME       => $uri->host,

            SCRIPT_NAME       => $self->script_name,
            SCRIPT_FILENAME   => $self->script_filename,
            SERVER_PORT       => $self->port,

            PATH_INFO         => $self->path_info,
            PATH_TRANSLATED   => $self->path_transrated,
            QUERY_STRING      => $uri->query,

            CONTENT_LENGTH    => $req->header('Content-Length'),
            CONTENT_TYPE      => $req->header('Content-Type'),
            DOCUMENT_ROOT     => $self->document_root,
            do{
              my @o = ();
              $req->headers->scan(sub{
                                    my ($f, $v) = @_;
                                    return if $f =~ /^Content-/i;
                                    push( @o,
                                          join( '',
                                                'HTTP_',
                                                map uc $_ , split /[-_]/, $f ),
                                          $v );
                                  });
              @o;
            }
          );
  wantarray ? %e : \%e;
}


sub with_env {
  my ($self, $code ) = @_;
  local %ENV = %ENV;
  my %e = $self->as_hash;
  while ( my ($key, $val) = each %e ) {
    $ENV{ $key } =  ( defined $val ) ? $val : '';
  }
  $code->($self->req);
}

=pod

=head2 C<GET> , C<POST>, C<PUT> , C<HEAD>

Functions of these four methods is building new HTTP::Request object and 
setting it to a object.

Interfaces of theses is same to HTTP::Request::Common functions.

=cut

__PACKAGE__->meta->add_method( $_ => do{
  my $m = HTTP::Request::Common->can( $_ );
  sub{
    my $self = shift;
    my $first = shift;
    $self->req( $m->( ($first =~ m#^(?:https?|file)://# )
                      ? ( $first, @_ )
                      : ( $self->uri , $first, @_ )) );
  }
} ) foreach  (qw(GET POST PUT HEAD));


=pod

=head1 AUTHOR

lieutar <lieutar@1dk.jp>

=cut

1;
__END__
