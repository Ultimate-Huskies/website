<?php
#show all logged in users the admin bar
function admin_bar_visibility() {
  return false;
  // if (is_user_logged_in()) return true;
  // else return false;
}
add_filter('show_admin_bar', 'admin_bar_visibility');

#add contact infos
function custom_user_contactmethods($methods) {
  $methods['phone'] = __('Phone', 'huskies-theme');
  return $methods;
}
add_filter('user_contactmethods', 'custom_user_contactmethods');

# add theme supports
function add_theme_supports() {
  // load_theme_textdomain('huskies-theme', get_stylesheet_directory().'/languages');

  add_theme_support('automatic-feed-links');
  add_theme_support('post-formats', array('gallery', 'image', 'status', 'video'));
  add_theme_support('post-thumbnails');

  set_post_thumbnail_size(250, 250); // Unlimited height, soft crop
}
add_action('after_setup_theme', 'add_theme_supports');

# add styles to theme
function enqueue_styles() {
  wp_register_style('normalize', VENDOR_PATH.'/normalize.css/normalize.css');
  wp_register_style('gallery', VENDOR_PATH.'/photobox/photobox/photobox.css', array('normalize'));
  wp_register_style('main_style', THEMEROOT.'/styles/compiled.css', array('gallery'));

  wp_enqueue_style('main_style');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

# add js scripts to theme
function enqueue_scripts() {
  wp_deregister_script('jquery');
  wp_register_script('jquery', VENDOR_PATH.'/jquery/dist/jquery.min.js');
  wp_register_script('gallery', VENDOR_PATH.'/photobox/photobox/jquery.photobox.js', array('jquery'));
  wp_register_script('skrollr', VENDOR_PATH.'/skrollr/dist/skrollr.min.js');
  wp_register_script('main_script', THEMEROOT.'/app.js', array('gallery', 'skrollr'));

  wp_enqueue_script('main_script');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

# register custom menus (in admin interface available)
function register_menus() {
  register_nav_menus(array(
    'main_menu' => __('Main Menu - Only 3 entries on first level!', 'huskies-theme')
  ));
}
add_action('init', 'register_menus');
