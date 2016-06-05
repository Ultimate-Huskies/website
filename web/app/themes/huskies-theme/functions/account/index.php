<?php
require_once(FUNCTIONS_PATH.'/account/login.php');
require_once(FUNCTIONS_PATH.'/account/register.php');
require_once(FUNCTIONS_PATH.'/account/forgot_password.php');
require_once(FUNCTIONS_PATH.'/account/set_new_password.php');

function finish($state, $return_data) {
  $data = array(
    'successful' => $state,
    $state ? 'data' : 'error' => $return_data
  );

  status_header($state ? 200 : 500);
  echo json_encode($data);
  die();
}

function check_passwords($user, $pass1, $pass2) {
  $strength = Minimum_Password_Strength::get_password_strength($user, $pass1, $pass2);
  $required_strength = get_option(Minimum_Password_Strength::STRENGTH_KEY, 3);

  if (Minimum_Password_Strength::MISMATCH == $strength) {
    finish(false, __('The passwords you entered do not match', 'huskies'));
  } elseif ($strength < $required_strength) {
    finish(false, __('You must choose a strong password', 'huskies'));
  }
}

function ajax_auth_init() {
  // Enable the user with no privileges to run the ajax functions
  add_action('wp_ajax_nopriv_login', 'login');
  add_action('wp_ajax_nopriv_register', 'register');
  add_action('wp_ajax_nopriv_forgot', 'forgot');
  add_action('wp_ajax_nopriv_password', 'password');
}
add_action('init', 'ajax_auth_init');
