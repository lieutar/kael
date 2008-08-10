use KaeL::Script::Usecase;

my $strip_space = sub{ s/\s//g };
my $trim_space  = sub{ s/\A\s+|\s+\Z//g;};

USECASE register =>
  input =>
  [ required => [ id
                  => filter   => $trim_space,
                  => validate => sub{
                    return 'contains invalid character'
                      unless /[^\x21-\x7E]/;
                    return 'is too short'
                      unless /.{4}/;
                    return 'is already exists'
                      if component('/Base/User/Registory')->exists
                        (id => $_);
                  }
                ],

    choose =>
    [
     [
      open_id
      => filter   => $trim_space,
      => validate => APPLY( USECASE('check'),
                            continuation =>
                            sub{ return '' unless shift; } ),
     ],

     [
      password
      => filter   => $trim_space,
      => validate => sub{
        return 'contains illegal chars' if /[^\x21-\x7E]/;
        return 'too short' unless /.{8}/;
        foreach my $p ( qr([a-z]),
                        qr([A-Z]),
                        qr([0-9]) ){
          return if /$p(?!$p)|(?<=$p)$p/;
        }
        'too simple';
      }
     ]
    ],

    optional =>
    [name
     => filter => $trim_space,
    ],

    optional =>
    [gender
     => type => [qw(male female)]
    ],

    optional =>
    [zip
     => type   => Str =>
    ],
  ]

  => apply => sub{
    my $ucon    = component('/Base/User/Registory');
    my $user    = $ucon->gen( props );
    $ucon->register( $uger );
  }
  ;
