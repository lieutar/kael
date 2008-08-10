
package KaeL::Resource::Simple;
use Moose;  with qw( KaeL::Resource );

do{
  my ($meth, @opts) = @$_;
  my $attr = "_$meth";
  has $attr => ( is => 'rw' ,  @opts );
  __PACKAGE__->meta->add_method( $meth => sub{
    my $self = shift;
    $self->$attr(@_);
  });
} foreach  ( [ mtime   => default  => sub{ time } ],
             [ ctime   => default  => sub{ time } ],
             [ atime   => default  => sub{ time } ],
             [ type    => default  => 'application/octet-stream'  ],
             [ content => required => 1 ]
           );

1;
__END__
