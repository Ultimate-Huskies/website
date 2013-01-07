<?php get_header(); ?>

<section id="content" class="articles">
  <?php 
    if (have_posts()) : while(have_posts()) : the_post(); 
      get_template_part('content', get_post_format());
    endwhile; else :
  ?>
    <h1><?php _e('No posts were found!', 'huskies-theme'); ?></h1>
  <?php endif; ?>

  <div class="articles_nav">
    <p class="articles_nav_prev"><?php previous_posts_link(__('Next posts', 'huskies-theme')); ?></p>
    <p class="articles_nav_next"><?php next_posts_link(__('Previous posts', 'huskies-theme')); ?></p>
  </div>

</section>

<?php get_footer(); ?>