<?php
function forgot() {
  // First check the nonce, if it fails the function will break
  check_ajax_referer('ajax-forgot-nonce', 'forgot_security');

  # $_POST['user_login'] = 'username or password'
  //if we're not on wp-login.php, we need to load it since retrieve_password() is located there
  if( !function_exists('retrieve_password') ){
    ob_start(); # start new output buffer
    include_once(ABSPATH.'wp-login.php');
    ob_end_clean();
  }

  $retrieved = retrieve_password();
  if (is_wp_error($retrieved)) {
    finish(false, clean_error_message($retrieved));
  } else {
    finish(true, __('Send a email with instructions to reset your password', 'huskies'));
  }
}

function clean_error_message($errorObj) {
  return str_replace('<strong>ERROR</strong>: ', '', $errorObj->get_error_message());
}
