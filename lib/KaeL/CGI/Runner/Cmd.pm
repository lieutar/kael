
package KaeL::CGI::Runner::Cmd;


use Moose; extends qw( KaeL::CGI::Runner );
use MooseX::Types::Path::Class;
use IPC::Run;
use Time::HiRes qw( usleep );

=pod

=head1 NAME

KaeL::CGI::Runner::Cmd - external cgi script launcher

=head1 DESCRIPTION

This module runs external script.

=head1 ATTRIBUTES

=over 4

=item C<script>

it specifies path to the cgi.

=item C<document_root>

it specifies path to the document root.

=item C<interpreter>

it specifies interpretr and its options.

=item C<read_shebang>

If it is true and C<interpreter> is undefined. The object will build
dommand line of the script with its shebang.

=back

=cut

use constants BUFFER_SIZE => 4096;

sub _buffer ($\$){
  my $size = shift;
  my $var  = shift;
  $$var = "x" x $size;
  $$var = "";
}


has script_filename => ( is       => 'ro',
                         isa      => File,
                         coerce   => 1,
                         required => 1 );

has interpreter   => ( is       => 'rw' );

has timeout       => ( is       => 'rw',
                       default  => 30 );

has error_handler => ( is => 'rw',
                       isa => 'CodeRef',
                       default => sub{
                         sub{
                           my ($self, $status, $out, $err) = shift;
                           confess "";
                         }});

has timeout_handler => ( isa => 'CodeRef',
                         default => sub{
                           sub{
                             my ($self, $out, $err) = shift;
                             warn "child process was timeout."
                           }});

has read_shebang => ( is        => 'rw',
                      isa       => 'Bool',
                      default   => 1 );

sub code {
  sub{
      my $orig = shift;
      my $self = shift;
      my $req  = shift;
      _buffer BUFFER_SIZE , my $raw;
      _buffer BUFFER_SIZE , my $err;
      my $h   = start( $self->command_line
                       => '<'  => \undef
                       => '>'  => \$raw
                       => '2>' => \$err
                       => my $t = timer($self->timeout) );
      die "creation of subprocess is failed" unless $h;
      usleep 1000 until $t->is_expired;
      if( $t->is_expired ){
        $h->kill_kill;
        die "subprocess was timeout";
      }
      else {
        my $status = $h->finish;
        die "caught illegal status" if $status;
      }
      $raw;
    }
}

sub script_name {
  my $self   = shift;
  my $script = $self->script_filename;
  my $root   = quotemeta $self->document_root;
  $script =~ s#^$root##;
  $script;
}

sub command_line {
  my $self = shift;
  my $interpreter = $self->interpreter;
  unless ( defined $interpreter && $self->read_shebang ){
    my $fh = $self->script_filename->openr;
    my $first = <$fh>;
    $fh->close;
    $interpreter = $first if $first =~ s/^#!//;
  }
  [ (($interpreter) ? "$interpreter " : ()), $self->script_filename  ];
}


1;
__END__
