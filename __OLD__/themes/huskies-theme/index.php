<?php get_header(); ?>

<?php 
  if (have_posts()) : while(have_posts()) : the_post(); 
    get_template_part('content', get_post_format());
  endwhile;

  boostrap_content_nav();

  else :
    get_template_part('content', 'none');
  endif; 
?>

<?php get_footer(); ?>