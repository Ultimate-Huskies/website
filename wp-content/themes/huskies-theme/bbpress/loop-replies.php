<?php do_action('bbp_template_before_replies_loop'); ?>

<div id="topic-<?php bbp_topic_id(); ?>-replies" class="topic-replies-wrapper">
  <header>
    <?php 
      if (!bbp_show_lead_topic()) :
        bbp_user_subscribe_link(array(
                    'subscribe'   => __( 'Subscribe',   'huskies-theme' ),
                    'unsubscribe' => __( 'Unsubscribe', 'huskies-theme' ),
          'before' => ''
        ));
        bbp_user_favorites_link(
          array(
            'mid'  => __('Add to your favorites', 'huskies-theme'),
            'post' => ''
          ),
          array(
            'pre'  => '',
            'mid'  => __('Remove from your favorites', 'huskies-theme'),
            'post' => ''
          )
        );
      endif;
    ?>
  </header>

  <section>
    <?php 
      while (bbp_replies()) : bbp_the_reply();
        bbp_get_template_part('loop', 'single-reply');
      endwhile;
    ?>
  </section>

  <footer>
    <?php 
      if (!bbp_show_lead_topic()) :
        bbp_user_subscribe_link(array(
                    'subscribe'   => __( 'Subscribe',   'huskies-theme' ),
                    'unsubscribe' => __( 'Unsubscribe', 'huskies-theme' ),
          'before' => ''
        ));
        bbp_user_favorites_link(
          array(
            'mid'  => __('Add to your favorites', 'huskies-theme'),
            'post' => ''
          ),
          array(
            'pre'  => '',
            'mid'  => __( 'Remove from your favorites', 'huskies-theme' ),
            'post' => ''
          )
        );
      endif;
    ?>
  </footer>
</div>
<?php do_action('bbp_template_after_replies_loop'); ?>
