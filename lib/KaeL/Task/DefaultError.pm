
package KaeL::Task::DefaultError;
use Moose; with qw( KaeL::Task );

sub run{
  my $self           = shift;
  my ( $code, $msg ) = $self->args;
  warn $code;
  my $res            = $self->core->res;
  $res->header(-status       => $code,
               -content_type => 'text/html');
  $res->content
    ( join
      ("\n",
       '<html lang="en">',
       '<head>',
       "<title>".( $res->status_line )."</title>",
       '</head>',
       '<body>',
       "<h1>".( $res->status_line )."</h1>",
       "<pre>",
       $self->core->escapeHTML( $msg ),
       "</pre>",
       '</body>',
       '</html>'
      ));
  return;
}

1;
__END__
