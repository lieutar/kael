
suffix qw(.html )
  => handle( class => 'KaeL::Handler::MicroMason',
             args  => [ mason => '-SafeServerPages'  ] , );
