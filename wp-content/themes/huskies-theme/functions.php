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

function boostrap_wp_link_pages($args = array()) {
  $defaults = array(
    'before'          => '<p class="post-navigation">',
    'after'           => '</p>',
    'link_before'     => '',
    'link_after'      => '',
    'current_before'  => '<span class="current_page">',
    'current_after'   => '</span>',
    'next_or_number'  => 'number',
    'nextpagelink'    => __('Next page', 'huskies-theme'),
    'previouspagelink'=> __('Previous page', 'huskies-theme'),
    'pagelink'        => '%',
    'echo'            => true
  );

  $r = wp_parse_args($args, $defaults);
  $r = apply_filters('boostrap_wp_link_pages_args', $r);
  extract($r, EXTR_SKIP);

  global $page, $numpages, $multipage, $more, $pagenow;

  $output = '';
  if ($multipage) {
    if ('number' === $next_or_number) {
      $output .= $before;
      for ($i = 1; $i < ($numpages + 1); $i++) {
        $j = str_replace('%', $i, $pagelink);
        if (($i != $page) || ((!$more) && ($page!=1))) {
          $output .= $link_before._wp_link_page($i).$j.$link_after;
        } else {
          $output .= $current_before.$j.$current_after;
        }
      }
      $output .= $after;
    } else {
      if ($more) {
        $output .= $before;
        $i = $page - 1;
        if ($i && $more) {
          $output .= $link_before._wp_link_page($i).$previouspagelink.$link_after;
        }
        $i = $page + 1;
        if ($i <= $numpages && $more) {
          $output .= $link_before._wp_link_page($i).$nextpagelink.$link_after;
        }
        $output .= $after;
      }
    }
  }

  if ($echo) echo $output;

  return $output;
}

function bootstrap_wp_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;

  switch ($comment->comment_type) :
    case 'pingback' :
    case 'trackback' :
    // Display trackbacks differently than normal comments.
  ?>
  <li <?php comment_class('media'); ?> id="comment-<?php comment_ID(); ?>">
    <div class="media-body">
      <h4 class="media-heading"><?php _e('Pingback: ', 'huskies-theme' ); ?></h4>
      <p><?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
  <?php
      break;

    default :
    // Proceed with normal comments.
    global $post;
  ?>
  <?php 
    $comment_classes = 'media';
    if ($comment->user_id === $post->post_author) $comment_classes .= 'comment_by_author'; 
  ?>
  <li <?php comment_class($comment_classes); ?> id="li-comment-<?php comment_ID(); ?>">
    <a class="pull-left" href="<?php comment_author_url(); ?>"><?php echo get_avatar($comment, 64); ?></a>

    <div class="media-body">
      <div class="page-header">
         <h4>
          <a href="<?php comment_author_url(); ?>">
            <?php comment_author(); ?>
          </a>
          <small>
            <?php
              printf( '<time datetime="%1$s">%2$s</time>',
                get_comment_time('c'),
                /* translators: 1: date, 2: time */
                sprintf(__('%1$s at %2$s', 'huskies-theme'), get_comment_date(), get_comment_time())
              );

              edit_comment_link(__('Edit comment', 'huskies-theme'), '<small class="edit-comment"> | ', '</small>');
            ?>
          </small>
        </h4>
        <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply &darr;', 'huskies-theme'), 'before' => '<span class="pull-right">', 'after' => '</span>', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
      </div>
     
      <?php if ('0' == $comment->comment_approved) : ?>
        <p class="comment_awaiting_moderation"><?php _e('Your comment is awaiting moderation.', 'huskies-theme'); ?></p>
      <?php endif; ?>

      <section class="comment_content comment">
        <?php comment_text(); ?>
      </section>
    </div>
  <?php
    break;
  endswitch;
}

function change_avatar_css($class) {
  $class = str_replace("class='avatar", "class='comments-avatar media-object img-rounded img-polaroid", $class);
  return $class;
}
add_filter('get_avatar','change_avatar_css');

?>
