<article <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">
  <header>
    <div class="page-header">
      <?php if (is_single()) : ?>
        <h1><?php the_title(); ?></h1>
      <?php else : ?>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <?php endif;?>

      <?php if (is_sticky() && !is_single() && !is_paged()) : ?>
        <div class="featured-post label label-info"> <?php _e('Featured post', 'huskies-theme'); ?> </div>
      <?php endif; ?>
      <small class="article_meta_extra"><?php echo get_the_date(); ?>, by <?php the_author_posts_link(); ?></small>
      <?php edit_post_link(__('Edit this post', 'huskies-theme'), ' | <span class="article_meta_edit_link">', '</span>' ); ?>
      <?php 
        if ((comments_open() || wp_count_comments(get_the_ID())->approved > 0) && !post_password_required()) {
          comments_popup_link(__('No comments', 'huskies-theme'),  __('1 comment', 'huskies-theme'), __('% comments', 'huskies-theme'), 'label label-success article_meta_comments');
        }
      ?>
    </div>
    <div class="row-fluid hidden-phone">
      <dl class="article_meta_categories dl-horizontal span6"><dt><?php _e('Categories', 'huskies-theme'); ?>:</dt><dd><?php the_category(' | '); ?></dd></dl>
      <dl class="article_meta_tags dl-horizontal span6"><?php the_tags(__('<dt>Tags', 'huskies-theme').': </dt><dd>', ' | ', '</dd>'); ?></dl>
    </div>
  </header>

  <?php if(has_post_thumbnail()) : ?>
    <figure class="article_preview_image">
      <?php if (is_single()) : ?>
        <?php the_post_thumbnail('thumbnail', array('class' => 'img-rounded img-polaroid')); ?>
      <?php else : ?>
        <a href="<?php the_permalink(); ?>" title="<?php _e('Go to full post', 'huskies-theme'); ?> <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'img-rounded img-polaroid')); ?></a>
      <?php endif;?>
    </figure>
  <?php endif; ?>

  <div class="article_content clearfix">
    <?php 
      if(is_single() || post_password_required()) {
        the_content(); 
      } else {
        the_excerpt();
      }
    ?>
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
    elseif(!post_password_required()):
  ?>
    <div>
      <a href="<?php the_permalink(); ?>" title="<?php _e("Read the rest of", "huskies-theme") ?> <strong><?php the_title(); ?></strong>" class="more-link btn btn-block"><?php _e("read the complete post", "huskies-theme"); ?></a>
    </div>
  <?php 
    if (!is_single()) { do_quickshare_output(); }
    endif; 
  ?>
</article>

<hr class="fancy" />
