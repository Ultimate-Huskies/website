<?php
function login() {
  // First check the nonce, if it fails the function will break
  check_ajax_referer('ajax-login-nonce', 'login_security');

  // Nonce is checked, get the POST data and sign user on
  $info = array(
    'user_login' => sanitize_text_field($_POST['login_user']),
    'user_password' => sanitize_text_field($_POST['login_password']),
    'remember' => $_POST['login_rememberme']
  );

  $user_signon = wp_signon($info, false);
  if (is_wp_error($user_signon)) {
    finish(false, $user_signon->get_error_code() == 'error' ? __('Your account has to be confirmed by an administrator before you can login', 'huskies') : __('Wrong username or password.', 'huskies'));
  } else {
    wp_set_current_user($user_signon->ID);
    finish(true, __('Login successful, redirecting...', 'huskies'));
  }
}
