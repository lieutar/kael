my ( $self, $root, $dir ) = @_;

$dir = dir( $dir );


content
  join
  ("\n",

   "<html>",
   "<head><title>$dir</title></head>",
   "<body>",
   "<ul>",
   "<li><a href="..">..</a></li>",
   (map{
     sprintf "<li><a href=\"/%s\">%s%s</a></li>",
       $_->relative( $root ),
         $_->relative( $dir ),
           $_->is_dir ? '/' : ''
         }( $dir->children )),
   "</ul>",
   "</body>",
   "</html>"
  );
