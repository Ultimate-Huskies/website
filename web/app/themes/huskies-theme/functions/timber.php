<?php
add_filter('timber_context', 'add_to_context');
function add_to_context($data){
  $data['menu'] = new TimberMenu('main_menu');

  $data['page'] = array(
    'permalink' => get_permalink(),
    'home_url' => home_url(),
    'login_url' => TimberHelper::function_wrapper('wp_login_url', array(get_permalink())),
    'logout_url' => TimberHelper::function_wrapper('wp_logout_url', array(home_url())),
    'register_url' => TimberHelper::function_wrapper('wp_registration_url'),
    'date_format' => get_option('date_format'),
    'time_format' => get_option('time_format'),

    'user' => array(
      'logged_in' => is_user_logged_in(),
      'profile' => array(
        'url' => TimberHelper::function_wrapper('bbp_get_user_profile_url', array(bbp_get_current_user_id())),
        'image' => TimberHelper::function_wrapper('bbp_get_current_user_avatar', array(50)),
        'id' => TimberHelper::function_wrapper('bbp_get_current_user_id'),
        'name' => TimberHelper::function_wrapper('bbp_current_user_name')
      ),
      'can' => array(
        'access_topic_form' => TimberHelper::function_wrapper('bbp_current_user_can_access_create_topic_form'),
        'access_reply_form' => TimberHelper::function_wrapper('bbp_current_user_can_access_create_reply_form'),
        'unfiltered_html' => TimberHelper::function_wrapper('current_user_can', array('unfiltered_html')),
        'moderate' => TimberHelper::function_wrapper('current_user_can', array('moderate')),
      )
    ),
  );

  return $data;
}
