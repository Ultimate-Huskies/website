<?php get_header(); ?>

<header class="archive_header well well-small">
  <h1 class="archive_title">
    <?php echo get_search_query(); ?>
    <small><?php _e('search results', 'huskies-theme'); ?></small>
  </h1>
</header>

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