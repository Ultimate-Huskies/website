<?php
require_once(FUNCTIONS_PATH.'/account/login.php');
require_once(FUNCTIONS_PATH.'/account/register.php');
require_once(FUNCTIONS_PATH.'/account/forgot_password.php');

function finish($state, $return_data) {
  $data = array(
    'successful' => $state,
    $state ? 'data' : 'error' => $return_data
  );

  status_header($state ? 200 : 500);
  echo json_encode($data);
  die();
}

function ajax_auth_init() {
  // Enable the user with no privileges to run the ajax functions
  add_action('wp_ajax_nopriv_login', 'login');
  add_action('wp_ajax_nopriv_register', 'register');
  add_action('wp_ajax_nopriv_forgot', 'forgot');
}
add_action('init', 'ajax_auth_init');
