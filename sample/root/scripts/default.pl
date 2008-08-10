header content_type => 'text/html;charset=utf-8';
content join
  ( "\n",
    '<html lang="ja">',
    '<head>',
    '<title>default</title>',
    '<style>',
    'th, td { font-size: 12px; padding: 3px; }',
    '</style>',
    '</head>',
    '<body>',
    '<h1>default</h1>',
    date,
    '<hr>',
    req->uri,
    '<table rules="all" frame="border">',
    ( map{
      ( '<tr>'.
        '<th style="vertical-align:top;">'. escapeHTML($_).
        '<td>'. escapeHTML( $ENV{$_} ) )
    } sort keys %ENV ),
        '</table>',
    '</body>',
    '</html>',
  );

