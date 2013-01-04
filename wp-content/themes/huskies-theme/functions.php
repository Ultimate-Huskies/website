<?php
require_once('utility/bootstrap_nav_walker.php');

#remove meta tag generation to not showing the current wp version
remove_action('wp_head', 'wp_generator');
# Define some constants
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES_PATH',    THEMEROOT.'/images');

function enqueue_styles() {
  wp_register_style('font_lobster', 'http://fonts.googleapis.com/css?family=Lobster', false, '1.0.0', 'all');
  wp_register_style('font_muli', 'http://fonts.googleapis.com/css?family=Muli:300,400,400italic,300italic', false, '1.0.0', 'all');
  wp_register_style('main_style', THEMEROOT.'/style.css', array('font_lobster', 'font_muli'), '1.0.0', 'screen');

  wp_enqueue_style('main_style');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

function enqueue_scripts() {
  $bootstrap_path = THEMEROOT.'/bootstrap/js/';
  wp_register_script('bootstrap-dropdown', $bootstrap_path.'bootstrap-dropdown.js', array( 'jquery' ), '1', false);

  wp_enqueue_script('bootstrap-dropdown'); 
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');  

function register_menus() {
  register_nav_menus(array(
    'main_menu' => __('Main Menu', 'huskies-theme')
  ));
}
add_action('init', 'register_menus');

?>
