
use strict;
use warnings;
package KaeL::Types;

=pod

=head1 NAME

KaeL::Types - defindes Moose types and convertion for KaeL

=head1 Types

=head2 Path::Class::File

=head2 Path::Dlass::Dir

=head2 URI

=cut


use Carp;
use Path::Class;
use URI;
use MooseX::Types -declare => [qw(
                                   WritableDir
                                   URI
                                )];

use MooseX::Types::Path::Class qw( Dir File );
__PACKAGE__->type_storage->{Dir}  = Dir;
__PACKAGE__->type_storage->{File} = File;

use Moose::Util qw( does_role );

subtype URI, as   Object => where{ $_->isa('URI')   };
coerce  URI, from Str    =>   via{ 'URI'->new( $_ ) };

subtype WritableDir, as Dir => where{ -w $_ };


subtype 'KaeL::Task'
  => as Object
  => where {
    does_role( $_ , 'KaeL::Task');
  };

coerce 'KaeL::Task'
  => from CodeRef
  => via {
    require KaeL::Task::CODE;
    KaeL::Task::CODE->new( code => $_ );
  };



1;
__END__
