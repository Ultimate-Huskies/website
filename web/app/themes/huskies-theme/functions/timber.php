<?php
add_filter('timber_context', 'add_to_context');
function add_to_context($data){
  $data['menu'] = new TimberMenu('main_menu'); // This is where you can also send a Wordpress menu slug or ID

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
      'name' => TimberHelper::function_wrapper('bbp_current_user_name'),
      'profile_url' => TimberHelper::function_wrapper('bbp_get_user_profile_url', array(bbp_get_current_user_id())),
      'profile_image_url' => TimberHelper::function_wrapper('bbp_get_current_user_avatar', array(50)),
    ),
  );

  return $data;
}
