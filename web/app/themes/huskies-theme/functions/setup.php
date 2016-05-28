<?php
#show all logged in users the admin bar
function admin_bar_visibility() {
  return false;
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
  wp_register_style('gallery', VENDOR_PATH.'/photobox/photobox/photobox.css');
  wp_register_style('main_style', THEMEROOT.'/styles/compiled.css', array('gallery', 'normalize'));

  wp_enqueue_style('main_style');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

# add js scripts to theme
function enqueue_scripts() {
  wp_deregister_script('jquery');
  wp_register_script('jquery', VENDOR_PATH.'/jquery/dist/jquery.min.js');
  wp_register_script('gallery', VENDOR_PATH.'/photobox/photobox/jquery.photobox.js', array('jquery'));
  wp_register_script('main_script', THEMEROOT.'/app.js', array('gallery'));

  wp_enqueue_script('main_script');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

# register custom menus (in admin interface available)
function register_menus() {
  register_nav_menus(array(
    'main_menu' => __('Main Menu', 'huskies-theme')
  ));
}
add_action('init', 'register_menus');

function widgets_init() {
  register_sidebar(
    array(
      'name'          => 'Footer Map',
      'id'            => 'footer_map',
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '',
      'after_title'   => '',
    )
  );
}
add_action('widgets_init', 'widgets_init');

function new_mail_from($email) {
  return 'notifications@ultimate-huskies.de';
}
add_filter('wp_mail_from', 'new_mail_from');

function new_mail_from_name($name) {
  return 'Wordpress - Ultimate Huskies';
}
add_filter('wp_mail_from_name', 'new_mail_from_name');

function fix_busted_mailgun_options_logic_in_wp_mail($options, $option_name) {
  unset($options['campaign-id']);
  unset($options['tag']);
  return $options;
}
add_filter('option_mailgun', 'fix_busted_mailgun_options_logic_in_wp_mail', 10, 2);
