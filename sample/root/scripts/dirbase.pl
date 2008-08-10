use File::MimeInfo qw/ globs /;

my $root = dir( PROJECT_ROOT, 'doc' );
my $file = Path::Class::file( $root, req->uri->path );
my $stat = $file->stat;

header( -status       => RC_OK,
        -content_type => 'text/html' );


error 404 unless $stat;
return call( script(file( PROJECT_ROOT, 'scripts', 'dirlist.pl')),
             $root,
             $file) if -d $file;

if (my $ims = req->headers->if_modified_since ) {
  if ( $ims >= $stat->mtime ) {
    header( -code    => RC_NOT_MODIFIED );
    content( undef );
    return;
  }
}

my $type = ( $file =~ /\.php\Z/ ? 'text/html' :
             undef );

header( -content_type  => ( $type        or
                            globs($file) or
                            'application/octet-stream' ),
        -last_modified => $stat->mtime );
content( scalar $file->slurp );
