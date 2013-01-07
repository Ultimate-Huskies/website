<?php if (post_password_required()) return; ?>

<div id="comments" class="comments_area">
  <?php if(have_comments()) : ?>
    <h3 class="comments_title">
      <?php
        printf(
          _n('One comment', '%1$s comments', get_comments_number(), 'huskies-theme'),
          number_format_i18n(get_comments_number())
        );
      ?>
    </h3>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <ul id="comment-nav-below" class="pager">
        <li class="previous"><?php previous_comments_link(__('&larr; Older Comments', 'huskies-theme')); ?></li>
        <li class="next"><?php next_comments_link(__('Newer Comments &rarr;', 'twentytwelve')); ?></li>
      </ul>
    <?php endif; ?>

    <ul class="commentlist media-list">
      <?php wp_list_comments(array(
              'callback' => 'bootstrap_wp_comment', 
              'style' => 'ul'
      )); ?>
    </ul>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <ul id="comment-nav-below" class="pager">
        <li class="previous"><?php previous_comments_link(__('&larr; Older Comments', 'huskies-theme')); ?></li>
        <li class="next"><?php next_comments_link(__('Newer Comments &rarr;', 'twentytwelve')); ?></li>
      </ul>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number()) : ?>
      <h3 class="comments_title nocomments"><?php _e('Comments are closed' , 'huskies-theme'); ?></h3>
    <?php endif; ?>

  <?php else : ?>
    <h3 class="comments_title"><?php _e('No comments so far', 'huskies-theme'); ?></h3>
  <?php endif; ?>

  <?php comment_form(); ?>
</div>
