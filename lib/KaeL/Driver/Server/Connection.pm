
package KaeL::Driver::Server::Connection;
use Moose;
use Socket;
has wheel     => ( is => 'ro' );
has socket    => ( is => 'ro' );
has keepalive => ( is      => 'rw',
                   default => 0 );
has outbuf    => ( is => 'rw' );

has _info => ( is => 'ro',
               lazy => 1,
               default => sub{
                 my $self = shift;
                 my ($port, $iaddr) = sockaddr_in(getpeername($self->socket));
                 my $peer_host = gethostbyaddr($iaddr, AF_INET);
                 my $peer_addr = inet_ntoa($iaddr);
                 return { port  => $port,
                          iaddr => $iaddr,
                          host  => $peer_host,
                          addr  => $peer_addr, }
               }
             );

has peer_host => ( is      => 'ro',
                   lazy    => 1,
                   default => sub{ shift->_info->{host}; });

has peer_addr => ( is      => 'ro',
                   lazy    => 1,
                   default => sub{ shift->_info->{addr}; });


sub id {
  shift->wheel->ID;
}

sub flush {
  my $self = shift;
  $self->wheel->set_output_filter(POE::Filter::Stream->new);
  $self->wheel->put($self->outbuf);
  $self->outbuf(undef);
}

1;
__END__
