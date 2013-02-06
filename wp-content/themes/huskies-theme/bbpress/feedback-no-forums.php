<div class="alert alert-info alert-block">
  <?php if (!is_user_logged_in()): ?>
    <h3>
      <?php _e('You need to', 'huskies-theme'); ?> <a href="<?php echo wp_login_url(); ?>"><?php _e('login', 'huskies-theme'); ?></a>
      <?php _e('or', 'huskies-theme'); ?> <a href="<?php echo home_url(); ?>/wp-login.php?action=register"><?php _e('register', 'huskies-theme'); ?></a>
      <?php _e('if you are new here', 'huskies-theme'); ?>
    </h3>
  <?php else : ?>
    <h3><?php _e('No forums found!', 'huskies-theme'); ?></h3>
  <?php endif; ?>
</div>
