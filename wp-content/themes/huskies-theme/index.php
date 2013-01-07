<?php get_header(); ?>

<?php 
  if (have_posts()) : while(have_posts()) : the_post(); 
    get_template_part('content', get_post_format());
  endwhile;
?>
  <ul class="pager">
    <li class="previous"><?php next_posts_link(__('&larr; Older posts ', 'huskies-theme')); ?></li>
    <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'huskies-theme')); ?></li>
  </ul>
<?php else : ?>
  <article class="post no-results not-found" id="post-0">
    <header>
      <div class="page-header">
        <h1><?php _e('No posts were found!', 'huskies-theme'); ?></h1>
      </div>
    </header>

    <div class="article_content clearfix">
      <blockquote>
        <p><?php _e('Apologies, but no results were found. Perhaps searching will help find a related post.', 'huskies-theme'); ?></p>
        <small><cite><?php _e('The Admin', 'huskies-theme'); ?></cite></small>
      </blockquote>
      <?php get_search_form(); ?>
    </div>
  </article>
<?php endif; ?>



<?php get_footer(); ?>