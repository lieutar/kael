
use strict;
use warnings;

use Test::More tests => 2;
BEGIN{ use_ok('KaeL::Script::DirHook') }
use KaeL;
{
  package KaeL::Stub;
  use Moose;

  extends qw( KaeL );
  around $_ => sub{} foreach keys %{KaeL->meta->get_method_map};
  around new => sub{
    shift;
    my $self = shift;
    bless {};
  };

  around carp => sub{
    shift;
    shift;
    use Carp;
    confess @_;
  }
}

use Path::Class;

sub case ($@){
  my $case     = shift;
  my $base     =
    dir( file(__FILE__)->parent , 'KaeL-Script-DirHook' )->absolute;
  my $doc_root = dir( $base , sprintf('case%02d', $case ) , 'doc' );
  my $path     = dir( $doc_root, @_ );
  KaeL::Script::DirHook->new( app      => KaeL::Stub->new,
                              root     => $doc_root,
                              path     => $path,
                              filename => 'test.pl' );
}

####################
{
  my $c0   = case 0 => qw( foo bar bazz hoge hemo fuga piyo );
  my $root = $c0->root;
  my @files= ( file( $root, qw(test.pl) )->absolute,
               file( $root, qw(foo bar test.pl))->absolute,
               file( $root, qw(foo bar bazz hoge hemo test.pl))->absolute );

  my @result = ();
  while (my $file = $c0->find) {
    unshift @result, $file;
    $c0->run;
  }
  is(join("\n",@result), join("\n",@files));
}


####################
# {
#   use IO::String;
#   my $buf = IO::String->new;
#   my $c1  = case 1 =>  qw( foo bar bazz hoge hemo fuga piyo );
#   {
#     local *STDOUT = $buf;
#   }
#   my $str
#     = ( file( $root, qw(test.pl) )->absolute,
#         file( $root, qw(foo bar test.pl))->absolute,
#         file( $root, qw(foo bar bazz hoge hemo test.pl))->absolute );
# }
