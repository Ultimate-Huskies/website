<article <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">
  <header>
    <div class="page-header">
      <h1>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
      </h1>
      <?php if (is_sticky() && !is_single() && !is_paged()) : ?>
        <div class="featured-post label label-info"> <?php _e('Featured post', 'huskies-theme'); ?> </div>
      <?php endif; ?>
      <small class="article_meta_extra"><?php echo get_the_date(); ?>, by <?php the_author_posts_link(); ?></small>
      <?php edit_post_link(__('Edit this post', 'huskies-theme'), ' | <span class="article_meta_edit_link">', '</span>' ); ?>
      <span class="post_format icon-facetime-video" data-placement="left" title="<?php _e('video post', 'huskies-theme'); ?>"></span>
    </div>
  </header>

  <div class="article_content clearfix">
    <?php the_content(); ?>
  </div>

  <?php 
    if(is_single()) : 
      boostrap_wp_link_pages(array(
        'before' => '<nav class="pagination pagination-centered"><ul>',
        'after' => '</ul></nav>',
        'link_before' => '<li>',
        'link_after' => '</li>',
        'current_before' => '<li class="active"><a>',
        'current_after' => '</a></li>',
      ));
    endif;
  ?>
</article>