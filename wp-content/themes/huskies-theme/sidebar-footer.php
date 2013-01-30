<?php 
  if (!is_active_sidebar('left_footer_widget') &&
      !is_active_sidebar('right_footer_widget'))
    return; ?>

<footer id="secondFooter" class="hidden-phone">
  <div class="container">
    <div class="row">
      <?php 
        if (is_active_sidebar('left_footer_widget'))
          dynamic_sidebar('left_footer_widget');
        ?>

        <fieldset class="span4" id="test user">
          <div id="user_info">
            <?php if (is_user_logged_in()) : ?>
              <?php bbp_current_user_avatar(94); ?>
              <p>
                <?php _e('Logged in as', 'huskies-theme'); ?> 
                <a href="<?php echo bbp_get_user_profile_url(bbp_get_current_user_id()); ?>" title="<?php _e('See your profile', 'huskies-theme'); ?>">
                  <?php bbp_current_user_name(); ?>
                </a>
              </p>
              <hr>
              <p>
                <a href="<?php echo wp_logout_url(); ?>"><?php _e('Logout', 'huskies-theme'); ?> <i class="icon-signout"></i></a>
              </p>
            <?php else : ?>
              <div class="avatar_anonym"><i class="icon-user"></i></div>
              <p><a href="<?php echo wp_login_url(); ?>"><?php _e('Login', 'huskies-theme'); ?> <i class="icon-signin"></i></a></p>
              <hr>
              <p><a href="<?php echo home_url(); ?>/wp-login.php?action=register"><?php _e('Register','huskies-theme'); ?> <i class="icon-share"></i></a></p>
            <?php endif; ?>
          </div>
        </fieldset>

        <?php
        if (is_active_sidebar('right_footer_widget'))
          dynamic_sidebar('right_footer_widget');
      ?>
    </div>
  </div>
<footer>