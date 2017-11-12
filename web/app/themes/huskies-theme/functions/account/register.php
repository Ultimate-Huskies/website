<?php
function register() {
  // First check the nonce, if it fails the function will break
  check_ajax_referer('ajax-register-nonce', 'register_security');

  // Nonce is checked, get the POST data and sign user on
  $info = array(
    'user' => sanitize_user($_POST['register_user']),
    'password1' => sanitize_text_field($_POST['register_password1']),
    'password2' => sanitize_text_field($_POST['register_password2']),
    'email' => sanitize_email($_POST['register_email'])
  );

  if (!is_email($info['email'])) {
    finish(false, __('Not a valid email address', 'huskies'));
  }

  check_passwords($info['user'], $info['password1'], $info['password2']);

  $user = wp_create_user($info['user'], $info['password1'], $info['email']);
  if (is_wp_error($user)) {
    finish(false, $user->get_error_message());
  } else {
    finish(true, __('Register successfully. You will receive a email when a admin verified your registration.', 'huskies'));
  }
}
