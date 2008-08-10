my ($self, $code, $msg) = @_;
header
  -status       => $code,
  -content_type => 'text/html;charset=utf-8';


my $status_msg = res->status_line;

warn $msg;

my %description =
  (
   '500' =>  'Following error is occured.',
  );

my @bg = (
          '#000000',
          '#336699',
          '#224466',
          '#226644',
          '#993344'
          );

content join
  ("\n",
   '<html lang="ja">',
   '<head>',
   '<title>'.escapeHTML($status_msg).'</title>',
   '<style type="text/css">',
   '',
   '  body { margin: 0px; } ',
   '',
   '  h1  { ',
   '    background: '.$bg[int($code / 100)-1].';',
   '         color: white;',
   '     font-size: 1em;',
   '       padding: 3px 5px;',
   ' }',
   '',
   ' p {',
   '   margin: 1ex;',
   ' }',
   '',
   ' pre {',
   '  color: #C33;',
   '  font-size: 14px;',
   '  margin: 1ex;',
   '  padding: 1ex;',
   '  background: #F8F8CC;',
   '  border: #c33 solid 1px;',
   '  -moz-border-radius: 10px;',
   '  border-radius: 10px;',
   ' }',
   '',
   '</style>',
   '</head>',
   '<body>',
   '<h1>'.escapeHTML($status_msg).'</h1>',
   '<p>',
   escapeHTML( $description{$code} or '' ),
   '</p>',
   '<pre>',
   escapeHTML( $msg ),
   '</pre>',
   '</body>',
   '</html>'
  );
