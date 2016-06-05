<?php
function password() {
  global $wpdb;

  // First check the nonce, if it fails the function will break
  check_ajax_referer('ajax-password-nonce', 'password_security');

  $info = array(
    'key' => sanitize_text_field($_POST['password_key']),
    'user' => sanitize_text_field($_POST['password_user']),
    'pass1' => sanitize_text_field($_POST['password_password1']),
    'pass2' => sanitize_text_field($_POST['password_password2'])
  );

  $user = check_password_reset_key($info['key'], $info['user']);
  if (is_wp_error($user)) {
    finish(false, $user->get_error_message());
  }

  check_passwords($info['user'], $info['pass1'], $info['pass2']);

  reset_password($user, $info['pass1']);
  finish(true, __('Successfully set new password', 'huskies'));
}
