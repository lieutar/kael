
package KaeL::Cfg;
use Moose::Role;
use Carp;

requires qw( additional_functions );

has core  => ( is       => 'ro',
               required => 1 );

has file  => ( is       => 'ro',
               required => 1 );

sub load{
  my ($self, $core, $file) = @_;

  my $root = $core->root;
  my $meta = $self->meta;
  my $meta_instance = $meta->get_meta_instance;
  my $new = $meta_instance->create_instance;

  my %rest = ();
  $meta->get_attribute('core')->initialize_instance_slot( $meta_instance,
                                                          $new,
                                                          { core => $core });

  $meta->get_attribute('file')->initialize_instance_slot( $meta_instance,
                                                          $new,
                                                          { file => $file });

  $core->runscript
    (
     $file ,
     PROJECT_ROOT   => sub(){ $root } ,
     $self->additional_functions,
     map {
       my $attr     = $_;
       my $name     = $attr->name;
       my $init_arg = $attr->init_arg;
       my $func     = uc $init_arg;
       my $reader   = $attr->has_reader ? $attr->reader : $attr->accessor;
       my $writer   = $attr->has_writer ? $attr->writer : $attr->accessor;

       $func =~ s/\W/_/g;
       $rest{$name} = $attr;
       ( $func => sub{

           if( @_ ){
             my $v = shift;
             if( delete $rest{$name} ){
               $attr->initialize_instance_slot
                 ( $meta_instance,  $new, { $init_arg => $v });
             }
             else {
               $new->$writer($v);
             }
           }

           if( $rest{$name} ){
             delete $rest{$name};
             $attr->initialize_instance_slot( $meta_instance, $new, {} );
           }

           $new->$reader();
         } );
     } $meta->compute_all_applicable_attributes
    );
  delete $rest{core};
  delete $rest{file};
  $_->initialize_instance_slot($meta_instance, $new, {}) foreach values %rest;
  $new;
}

1
__END__
