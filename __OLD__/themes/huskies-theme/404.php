<?php get_header(); ?>

  <header class="archive_header well well-small">
    <h1 class="archive_title">
      <?php _e('Ooops ... 404', 'huskies-theme'); ?>
      <small><?php _e('error happens', 'huskies-theme'); ?></small>
    </h1>
  </header>

 <?php get_template_part('content', 'none'); ?>

<?php get_footer(); ?>