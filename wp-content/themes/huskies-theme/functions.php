<?php
require_once('utility/bootstrap_nav_walker.php');

# remove meta tag generation and do not show he current wp version
remove_action('wp_head', 'wp_generator');

# define some constants
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

# add theme supports 
function add_theme_supports() {
  load_theme_textdomain('huskies-theme', THEMEROOT.'/languages');

  add_theme_support('automatic-feed-links');
  add_theme_support('post-formats', array('gallery', 'image', 'status', 'video'));
  add_theme_support('post-thumbnails');

  set_post_thumbnail_size(250, 250); // Unlimited height, soft crop
}
add_action('after_setup_theme', 'add_theme_supports');

# add styles to theme
function enqueue_styles() {
  wp_register_style('font_lobster', 'http://fonts.googleapis.com/css?family=Lobster', false, '1.0.0', 'all');
  wp_register_style('font_muli', 'http://fonts.googleapis.com/css?family=Muli:300,400,400italic,300italic', false, '1.0.0', 'all');
  wp_register_style('main_style', THEMEROOT.'/style.css', array('font_lobster', 'font_muli'), '1.0.0', 'screen');

  wp_enqueue_style('main_style');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

# add js scripts to theme
function enqueue_scripts() {
  $bootstrap_path = THEMEROOT.'/bootstrap/js/';
  wp_register_script('bootstrap_dropdown', $bootstrap_path.'bootstrap-dropdown.js', array( 'jquery' ), '1', false);
  wp_register_script('bootstrap_tooltip', $bootstrap_path.'bootstrap-tooltip.js', array( 'jquery' ), '1', false);
  wp_register_script('bootstrap_collapse', $bootstrap_path.'bootstrap-collapse.js', array( 'jquery' ), '1', false);
  wp_register_script('bootstrap_affix', $bootstrap_path.'bootstrap-affix.js', array( 'jquery' ), '1', false);
  wp_register_script('main_script', THEMEROOT.'/javascript/main.js', array('bootstrap_dropdown', 'bootstrap_tooltip', 'bootstrap_collapse', 'bootstrap_affix'), '1.0.0', false);

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

# register custom widgets (in admin interface available)
function register_widgets() {
  $before_widget = '<fieldset class="span4 %2$s" id="%1$s">';
  $after_widget  = '</fieldset>';
  $before_title  = '<legend class="widget-title">';
  $after_title   = '</legend>';

  register_sidebar(array(
    'name'          => __('first footer widget', 'huskies-theme'),
    'id'            => 'first_footer_widget',
    'description'   => __('The first footer widget', 'huskies-theme'),
    'before_widget' => $before_widget,
    'after_widget'  => $after_widget,
    'before_title'  => $before_title,
    'after_title'   => $after_title,
  ));

  register_sidebar(array(
    'name'          => __('second footer widget', 'huskies-theme'),
    'id'            => 'second_footer_widget',
    'description'   => __('The second footer widget', 'huskies-theme'),
    'before_widget' => $before_widget,
    'after_widget'  => $after_widget,
    'before_title'  => $before_title,
    'after_title'   => $after_title,
  ));

  register_sidebar(array(
    'name'          => __('third footer widget', 'huskies-theme'),
    'id'            => 'third_footer_widget',
    'description'   => __('The third footer widget', 'huskies-theme'),
    'before_widget' => $before_widget,
    'after_widget'  => $after_widget,
    'before_title'  => $before_title,
    'after_title'   => $after_title,
  ));
}
add_action('widgets_init', 'register_widgets');

function new_excerpt_more($more) {
       global $post;
       // return ' <a href="'. get_permalink($post->ID) . '">Read the Rest...</a>';
  return ' [<a href="'.get_permalink($post->ID).'" title="'.__("Read the rest of", "huskies-theme").' '.get_the_title($post->ID).'" class="more-link">'.__("read the complete post", "huskies-theme").'</a>]';
}
add_filter('excerpt_more', 'new_excerpt_more');
?>
