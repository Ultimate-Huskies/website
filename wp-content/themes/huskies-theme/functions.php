<?php
require_once('utility/bootstrap_nav_walker.php');

#remove meta tag generation to not showing the current wp version
remove_action('wp_head', 'wp_generator');
# Define some constants
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES_PATH',    THEMEROOT.'/images');

#extract page url for imprint site
foreach (get_pages(array('parent' => 0)) as $page) {
  $name = strtolower($page->post_name);
  if ($name === 'impressum' || $name === 'imprint') {
    define('IMPRINT_URL', get_page_link($page->ID));
    break;
  }
}

function enqueue_styles() {
  wp_register_style('font_lobster', 'http://fonts.googleapis.com/css?family=Lobster', false, '1.0.0', 'all');
  wp_register_style('font_muli', 'http://fonts.googleapis.com/css?family=Muli:300,400,400italic,300italic', false, '1.0.0', 'all');
  wp_register_style('main_style', THEMEROOT.'/style.css', array('font_lobster', 'font_muli'), '1.0.0', 'screen');

  wp_enqueue_style('main_style');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

function enqueue_scripts() {
  $bootstrap_path = THEMEROOT.'/bootstrap/js/';
  wp_register_script('bootstrap_dropdown', $bootstrap_path.'bootstrap-dropdown.js', array( 'jquery' ), '1', false);
  wp_register_script('bootstrap_tooltip', $bootstrap_path.'bootstrap-tooltip.js', array( 'jquery' ), '1', false);
  wp_register_script('bootstrap_collapse', $bootstrap_path.'bootstrap-collapse.js', array( 'jquery' ), '1', false);
  wp_register_script('main_script', THEMEROOT.'/javascript/main.js', array('bootstrap_dropdown', 'bootstrap_tooltip', 'bootstrap_collapse'), '1.0.0', false);

  wp_enqueue_script('main_script'); 
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');  

function register_menus() {
  register_nav_menus(array(
    'main_menu' => __('Main Menu - Only 3 entries on first level!', 'huskies-theme')
  ));
}
add_action('init', 'register_menus');

function register_widgets() {
  $before_widget = '<fieldset class="span4 %2$s" id="%1$s">';
  $after_widget  = '</fieldset>';
  $before_title  = '<legend class="widget-title">';
  $after_title   = '</legend>';

  register_sidebar(array(
    'name'          => __('first footer widget', 'huskies-theme' ),
    'id'            => 'first_footer_widget',
    'description'   => __('The first footer widget', 'huskies-theme' ),
    'before_widget' => $before_widget,
    'after_widget'  => $after_widget,
    'before_title'  => $before_title,
    'after_title'   => $after_title,
  ));

  // Area 4, located in the footer. Empty by default.
  register_sidebar(array(
    'name'          => __( 'second footer widget', 'huskies-theme' ),
    'id'            => 'second_footer_widget',
    'description'   => __( 'The second footer widget', 'huskies-theme' ),
    'before_widget' => $before_widget,
    'after_widget'  => $after_widget,
    'before_title'  => $before_title,
    'after_title'   => $after_title,
  ));

  // Area 5, located in the footer. Empty by default.
  register_sidebar(array(
    'name'          => __( 'third footer widget', 'huskies-theme' ),
    'id'            => 'third_footer_widget',
    'description'   => __( 'The third footer widget', 'huskies-theme' ),
    'before_widget' => $before_widget,
    'after_widget'  => $after_widget,
    'before_title'  => $before_title,
    'after_title'   => $after_title,
  ));
}
add_action( 'widgets_init', 'register_widgets' );

?>
