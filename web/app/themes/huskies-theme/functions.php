<?php
# do not show he current wp version
remove_action('wp_head', 'wp_generator');

define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES_PATH', THEMEROOT.'/images');
define('VENDOR_PATH', THEMEROOT.'/vendor');

define('FUNCTIONS_PATH', get_stylesheet_directory().'/functions');
require_once(FUNCTIONS_PATH.'/setup.php');
require_once(FUNCTIONS_PATH.'/gallery.php');
