<article <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">
  <header>
    <div class="page-header">
      <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <small class="article_meta_extra"><?php echo get_the_date(); ?>, by <?php the_author_posts_link(); ?></small>
      <?php 
        if (comments_open() && !post_password_required()) {
          comments_popup_link('0', '1', '%', 'article_meta_comments icon-comments-alt');
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
      <a href="<?php the_permalink(); ?>" title="<?php _e('Go to full post', 'huskies-theme'); ?> <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'img-rounded img-polaroid')); ?></a>
    </figure>
  <?php endif; ?>

  <?php the_excerpt(); ?>
</article>

<hr class="fancy" />