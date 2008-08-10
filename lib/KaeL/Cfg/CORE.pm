
package KaeL::Cfg::CORE;
use Moose; with qw( KaeL::Cfg );
use KaeL::Types qw( URI );
use Data::Thunk;
use PerlDSL::Subs::FileUtil ':all';
use KaeL::Log;

has name     => ( is       => 'ro',
                  isa      => 'Str',
                  requried => 1 );

has url_root => ( is       => 'rw',
                  isa      => URI,
                  coerce   => 1,
                  required => 1 );

has ssl_mapper => ( is      => 'rw',
                    isa     => 'CodeRef',
                    default => sub{ sub{$_} } );

has core_prefix => ( is      => 'rw',
                     isa     => 'Str',
                     default => '!!' );

has session_name => ( is      => 'rw',
                      isa     => 'Str',
                      default => 'sess' );

has logger => ( is      => 'rw',
                isa     => 'KaeL::Log',
                default => undef );

has task =>
  ( is      => 'rw',
    lazy    => 1,
    isa     => 'KaeL::Task' ,
    coerce  => 1,
    default => sub{
      sub{
        my $self = shift;
        $self->core->res->content('default');
      }
    }
  );

has error_handler => ( is      => 'rw',
                       isa     => 'KaeL::Task',
                       coerce  => 1 );

has session_db =>
  ( is      => 'rw',
    lazy    => 1,
    default => sub{
      sub {
        my $self = shift;
        require Data::Rebuilder;
        Cache::File->new
            ( cache_root => DIR( $self->core->root , "var" , "sess"  ));
      }
    } );

sub additional_functions {}

1
__END__
