<?php get_header(); ?>

  <?php 
    while(have_posts()) : the_post(); 
      get_template_part('content', get_post_format());
    endwhile;
  ?>

  <?php comments_template('', true); ?>

  <hr class="fancy" />

  <ul class="pager">
    <li class="previous"><?php previous_post_link('%link', '&larr; %title'); ?></li>
    <li class="next"><?php next_post_link('%link', '%title &rarr;'); ?></li>
  </ul>

<?php get_footer(); ?>