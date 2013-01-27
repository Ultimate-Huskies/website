<article <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">
  <header>
    <div class="page-header">
      <div class="media">
        <div class="pull-left">
          <?php echo get_avatar(get_the_author_meta('ID'), 64); ?>
        </div>
        <div class="media-body">
          <h1>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
            <small><?php the_author(); ?></small>
          </h1>
          <?php if (is_sticky() && !is_single() && !is_paged()) : ?>
            <div class="featured-post label label-info"> <?php _e('Featured post', 'huskies-theme'); ?> </div>
          <?php endif; ?>
          <small class="article_meta_extra"><?php echo get_the_date(); ?></small>
          <?php edit_post_link(__('Edit this post', 'huskies-theme'), ' | <span class="article_meta_edit_link">', '</span>' ); ?>
          <span class="post_format icon-coffee" data-placement="left" title="<?php _e('status post', 'huskies-theme'); ?>"></span>
        </div>
      </div>
    </div>
    <div class="row-fluid hidden-phone">
      <dl class="article_meta_categories dl-horizontal span6"><dt><?php _e('Categories', 'huskies-theme'); ?>:</dt><dd><?php the_category(' | '); ?></dd></dl>
      <dl class="article_meta_tags dl-horizontal span6"><?php the_tags(__('<dt>Tags', 'huskies-theme').': </dt><dd>', ' | ', '</dd>'); ?></dl>
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
