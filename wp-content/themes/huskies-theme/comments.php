<?php if (post_password_required()) return; ?>

<div id="comments" class="comments_area">
  <?php if(have_comments()) : ?>
    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <ul id="comment-nav-below" class="pager">
        <li class="previous"><?php previous_comments_link(__('&larr; Older Comments', 'huskies-theme')); ?></li>
        <li class="next"><?php next_comments_link(__('Newer Comments &rarr;', 'twentytwelve')); ?></li>
      </ul>
    <?php endif; ?>

    <div class="tabbable">
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#tab1" data-toggle="tab"><h3><?php echo count($wp_query->comments_by_type['comment']); ?> <?php _e('Comments', 'huskies-theme'); ?></h3></a>
        </li>
        <li><h3>&</h3></li>
        <li>
          <a href="#tab2" data-toggle="tab"><h3><?php echo count($wp_query->comments_by_type['pings']); ?> <?php _e('Ping- & Trackbacks', 'huskies-theme'); ?></h3></a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab1">
          <ul class="commentlist media-list">
            <?php wp_list_comments(array(
                    'callback' => 'bootstrap_wp_comments', 
                    'type'     => 'comment',
                    'style'    => 'ul'
            )); ?>
          </ul>
        </div>
        <div class="tab-pane" id="tab2">
          <ul class="commentlist media-list">
            <?php wp_list_comments(array(
                    'callback' => 'bootstrap_wp_pings', 
                    'type'     => 'pings',
                    'style'    => 'ul'
            )); ?>
          </ul>
        </div>
      </div>
    </div>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <ul id="comment-nav-below" class="pager">
        <li class="previous"><?php previous_comments_link(__('&larr; Older Comments', 'huskies-theme')); ?></li>
        <li class="next"><?php next_comments_link(__('Newer Comments &rarr;', 'twentytwelve')); ?></li>
      </ul>
    <?php endif; ?>

  <?php else : ?>
    <?php if (comments_open()) : ?>
      <h3 class="comments_title label label-info"><?php _e('No comments so far', 'huskies-theme'); ?></h3>
    <?php endif; ?>
  <?php endif; ?>

  <?php if (comments_open()) : ?>
    <hr class="fancy" />

    <?php bootstrap_custom_comments_form(); ?>

    <hr class="fancy" />

  <?php else :?>
    <h3 class="comments_title nocomments label label-info"><?php _e('Comments are closed' , 'huskies-theme'); ?></h3>
    <hr class="fancy" />
  <?php endif; ?>
</div>
