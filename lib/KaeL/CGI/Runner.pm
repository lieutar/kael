
package KaeL::CGI::Runner;

use Moose::Role;
use MooseX::Types::Path::Class qw( File Dir );
use Path::Class;
require HTTP::Response;
require KaeL::CGI::Env;

has script_filename => ( is       => 'rw',
                         isa      => File,
                         coerce   => 1 );

has script_name => ( is      => 'rw',
                     isa     => 'Str',
                     default => '/' );

has document_root => ( is       => 'rw',
                       isa      => Dir,
                       default  => sub{ dir(".")->absolute },
                       coerce   => 1 );

has env => (
            is      => 'ro',
            isa     => 'KaeL::CGI::Env',
            default => sub{
              KaeL::CGI::Env->new( runner => shift );
            },
            handles => qr{^(?!_
                             |document_root
                             |script_filename
                             |script_name
                             |run_cgi
                             )}x,
           );

requires qw( code );

sub run {
  my ($self ) = @_;
  $self->env->script_name(     $self->script_name );
  $self->env->script_filename( $self->script_filename );
  $self->env->document_root(   $self->document_root );
  my $ret = $self->env->with_env( $self->code );
  blessed( $ret ) ? $ret :  HTTP::Response->parse( $ret );
}

1;
__END__
