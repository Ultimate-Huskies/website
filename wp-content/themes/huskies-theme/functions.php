<?php
require_once('utility/bootstrap_nav_walker.php');

# remove meta tag generation and do not show he current wp version
remove_action('wp_head', 'wp_generator');

########################################################################################################
#               constant definition                                                                           
########################################################################################################
  
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

########################################################################################################
#               setup theme                                                                           
########################################################################################################
  

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
  wp_register_script('bootstrap_collapse', $bootstrap_path.'bootstrap-collapse.js', array( 'jquery' ), '1', false);
  wp_register_script('bootstrap_tooltip', $bootstrap_path.'bootstrap-tooltip.js', array( 'jquery' ), '1', false);
  wp_register_script('bootstrap_popover', $bootstrap_path.'bootstrap-popover.js', array( 'jquery' ), '1', false);
  wp_register_script('bootstrap_tab', $bootstrap_path.'bootstrap-tab.js', array( 'jquery' ), '1', false);
  wp_register_script('bootstrap_alert', $bootstrap_path.'bootstrap-alert.js', array( 'jquery' ), '1', false);
  wp_register_script('gallery', THEMEROOT.'/javascript/photobox.min.js', array( 'jquery' ), '1', false);
  wp_register_script('main_script', THEMEROOT.'/javascript/main.js', array('bootstrap_dropdown', 'bootstrap_collapse', 'bootstrap_tooltip', 'bootstrap_popover', 'bootstrap_tab', 'bootstrap_alert', 'gallery'), '1.0.0', false);

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

########################################################################################################
#               filter functions                                                                           
########################################################################################################
  
 # filter function to display a custom gallery with boostrap markup
function bootstrap_post_gallery($fist, $attr) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'wrappertag' => 'ul',
    'itemtag'    => 'li',
    'icontag'    => 'a',
    'captiontag' => 'h5',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
  ), $attr));

  $id = intval($id);
  if ('RAND' == $order) $orderby = 'none';

  if (!empty($include)) {
    $_attachments = get_posts(array(
      'include'         => $include, 
      'post_status'     => 'inherit', 
      'post_type'       => 'attachment', 
      'post_mime_type'  => 'image', 
      'order'           => $order, 
      'orderby'         => $orderby
    ));

    $attachments = array();
    foreach ($_attachments as $key => $val) $attachments[$val->ID] = $_attachments[$key];
  } elseif (!empty($exclude)) {
    $attachments = get_children(array(
      'post_parent' => $id, 
      'exclude'         => $exclude, 
      'post_status'     => 'inherit', 
      'post_type'       => 'attachment', 
      'post_mime_type'  => 'image', 
      'order'           => $order, 
      'orderby'         => $orderby
    ));
  } else {
    $attachments = get_children(array(
      'post_parent'     => $id, 
      'post_status'     => 'inherit', 
      'post_type'       => 'attachment', 
      'post_mime_type'  => 'image', 
      'order'           => $order, 
      'orderby'         => $orderby
    ));
  }

  # return here, if no images in the gallery
  if (empty($attachments)) return '';

  # return with custom markup, if gallery should display on not single view
  if (!is_single()) {
    $amount = count($attachments);
    $keys = array_keys($attachments);
    $key = $keys[rand(0, $amount-1)];
    $image = $attachments[$key];
    $displayImage = wp_get_attachment_image($image->ID, 'full');

    # add bootstrap img classes, if not existing
    if (strpos($displayImage, 'img-rounded img-polaroid') === false) $displayImage = str_replace('class="', 'class="img-rounded img-polaroid ', $displayImage);
  
    return  '<div>'.
              '<a href="'.get_permalink().'">'.$displayImage.'</a>'.
            '</div>'.
            '<div>'.
              '<a href="'.get_permalink().'" title="'.__("Look at the complete gallery", "huskies-theme").' <strong>'.get_the_title().'</strong>" class="more-link btn btn-block">'.sprintf(_n("This gallery contains %s photo", "This gallery contains %s photos", $amount ,"huskies-theme"), $amount).'</a>'.
            '</div>';
  }

  # return here for custom feed output
  if (is_feed()) {
    $output = "\n";
    foreach ($attachments as $att_id => $attachment) $output .= wp_get_attachment_link($att_id, $size, true)."\n";
    return $output;
  }

  $wrappertag = tag_escape($wrappertag);
  $itemtag = tag_escape($itemtag);
  $captiontag = tag_escape($captiontag);
  $columns = intval($columns);
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = is_rtl() ? 'right' : 'left';

  $selector = "gallery-{$instance}";

  $size_class = sanitize_html_class($size);
  $output = "<{$wrappertag} id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} thumbnails row-fluid'>";;

  $i = 0;
  foreach ($attachments as $id => $attachment) {
    $image = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, $size, false, false) : wp_get_attachment_image($id, $size, true, false);
    $link  = $icontag === 'a' ? 'href="'.wp_get_attachment_url($id).'"' : '';
    $title = ($captiontag && trim($attachment->post_excerpt)) ? 'rel="popover" data-title="'.$attachment->post_title.'" data-content="'.wptexturize($attachment->post_excerpt).'"' : '';

    $output .= "<{$itemtag} class='gallery-item'>";
    $output .= "<{$icontag} {$link} {$title} class='gallery-icon thumbnail'>";
    $output .= str_replace('alt="', 'alt="'.wptexturize($attachment->post_excerpt).' - ', $image);
    $output .= "</{$icontag}>";
    $output .= "</{$itemtag}>";
  }

  $output .= "</{$wrappertag}>";

  return $output;
}
add_filter('post_gallery', 'bootstrap_post_gallery', 20, 2);

# filter function to add custom markup to caption shortcode
function bootstrap_img_caption($first, $attr, $content) {
  extract(shortcode_atts(array(
    'id'  => '',
    'align'  => 'alignnone',
    'width'  => '',
    'caption' => ''
  ), $attr));

  if (1 > (int) $width || empty($caption)) return $content;
  if ($id) $id = 'id="'.esc_attr($id).'"';

  $content = str_replace(' img-rounded img-polaroid', '', $content);
  return  '<div '.$id.' class="caption '.esc_attr($align).'" >'.
            '<ul class="thumbnails">'.
              '<li>'.
                '<div class="thumbnail">'.
                  do_shortcode($content).
                  '<h5>'.$caption.'</h5>'.
                '</div>'.
              '</li>'.
            '</ul>'.
          '</div>';
}
add_filter('img_caption_shortcode', 'bootstrap_img_caption', 20, 3);

# filter function to add classes to every image import in the editor
function bootstrap_get_image_class($class) {
  return $class .= ' img-rounded img-polaroid';
}
add_filter('get_image_tag_class', 'bootstrap_get_image_class');

# filter template to show own form for password protection
function custom_password_form($output) {
  $post = get_post();

  $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
  $output = '<form action="'.esc_url(site_url('wp-login.php?action=postpass', 'login_post')).'" method="post" class="form-inline">'.
              '<span class="help-block">'.__("This post is password protected. Please enter the correct password:", "huskies-theme").'</span>'.
              '<input name="post_password" id="'.$label.'" type="password" placeholder="'.__("password", "huskies-theme").'"/>'.
              '<input type="submit" name="Submit" class="btn btn-success" value="'.esc_attr__("Enter password", "huskies-theme").'"/>'.
            '</form>';

  return $output;
}
add_filter('the_password_form', 'custom_password_form');

# filter function to add custom classes to avatar image
function change_avatar_css($class) {
  $class = str_replace("class='avatar", "class='comments-avatar media-object img-rounded img-polaroid", $class);
  return $class;
}
add_filter('get_avatar', 'change_avatar_css');

########################################################################################################
#               template functions                                                                           
########################################################################################################

# custom navigation to display on each post page (i.e. index.php)
function boostrap_content_nav() {
  global $wp_query;

  if ( $wp_query->max_num_pages > 1 ) : ?>
  <ul class="pager">
    <li class="previous"><?php next_posts_link(__('&larr; Older posts ', 'huskies-theme')); ?></li>
    <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'huskies-theme')); ?></li>
  </ul>
  <?php endif;
}
  
# function to build custom pagination bases on wp_link_pages function from wordpress
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
          $output .= $link_before._wp_link_page($i).$j.'</a>'.$link_after;
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
          $output .= $link_before._wp_link_page($i).'</a>'.$previouspagelink.$link_after;
        }
        $i = $page + 1;
        if ($i <= $numpages && $more) {
          $output .= $link_before._wp_link_page($i).'</a>'.$nextpagelink.$link_after;
        }
        $output .= $after;
      }
    }
  }

  if ($echo) echo $output;

  return $output;
}

# custom function to build ping- & trackback comments separately
function bootstrap_wp_pings($comment) {
  ?>
  <li <?php comment_class('media'); ?> id="comment-<?php comment_ID(); ?>">
    <div class="media-body">
      <h4 class="media-heading">
        <?php 
          if($comment->comment_type == 'pingback')
            _e('Pingback: ', 'huskies-theme'); 
          else
            _e('Trackback: ', 'huskies-theme');
        ?>
      </h4>
      <p><?php comment_author_link(); ?> <?php edit_comment_link(__('Edit comment', 'huskies-theme'), '<span class="edit-link"> | ', '</span>'); ?></p>
  <?php
}

# custom function to build normal comments 
function bootstrap_wp_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  global $post;

  $comment_classes = 'media';
  if ($comment->user_id === $post->post_author) $comment_classes .= 'comment_by_author'; 
  ?>
  <li <?php comment_class($comment_classes); ?> id="comment-<?php comment_ID(); ?>">
    <a class="pull-left" href="<?php comment_author_url(); ?>"><?php echo get_avatar($comment, 80); ?></a>

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
        <p class="comment_awaiting_moderation label label-info"><?php _e('Your comment is awaiting moderation.', 'huskies-theme'); ?></p>
      <?php endif; ?>

      <section class="comment_content">
        <?php comment_text(); ?>
      </section>
    </div>
  <?php
}

# custom function to build own comment form
function bootstrap_custom_comments_form($post_id = null) {
  global $id;

  if ( null === $post_id )
    $post_id = $id;
  else
    $id = $post_id;

  $commenter = wp_get_current_commenter();
  $user = wp_get_current_user();
  $user_identity = $user->exists() ? $user->display_name : '';

  $req = get_option('require_name_email');
  $aria_req = ($req ? " aria-required='true'" : '');
  ?>

  <?php if (comments_open($post_id)) : ?>
    <?php do_action( 'comment_form_before' ); ?>
    <div id="respond" class="well well-small">
      <div class="page-header">
        <h3 id="comment_reply_title">
          <?php comment_form_title(__('Leave a Reply', 'huskies-theme'), __('Leave a Reply to %s', 'huskies-theme')); ?> 
          <small><?php cancel_comment_reply_link(__('Cancel reply', 'huskies-theme')); ?></small>
        </h3>

    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
      </div>
      <p class="comment_must_log_in">
        <span class="label label-warning"><?php _e('You must be logged in to post a comment', 'huskies-theme'); ?></span> -> 
        <a href="<?php wp_login_url(apply_filters('the_permalink', get_permalink($post_id))); ?>"><?php _e('Log in', 'huskies-theme'); ?></a>
      <?php do_action( 'comment_form_must_log_in_after' ); ?>
      </p>

    <?php else : ?>
        <?php if (is_user_logged_in()) : ?>
          <p class="comment_logged_in_as">
            <?php _e('Logged in as', 'huskies-theme'); ?> <a href="<?php echo get_edit_user_link(); ?>"><?php echo $user_identity; ?></a>
             | 
            <a href="<?php echo wp_logout_url(apply_filters('the_permalink', get_permalink($post_id))); ?>" title="<?php _e('Log out of this account', 'huskies-theme'); ?>"><?php _e('Log out?', 'huskies-theme'); ?></a>
          </p>
          <?php do_action('comment_form_logged_in_after', $commenter, $user_identity ); ?>

        <?php else : ?>
          <p class="comment_notes">
            <?php _e('Your email address will not be published.', 'huskies-theme'); ?>
            <?php if($req) : ?>
              <span class="comment_mark_required_fields"><?php _e('Required fields are marked with', 'huskies-theme'); ?> <code><i class="icon-asterisk"></i></code></span>
            <?php endif; ?>
          </p>
        <?php endif; ?>
      </div>

      <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="commentform">
        <?php do_action('comment_form_top'); ?>

        <?php if (!is_user_logged_in()) : ?>
          <?php do_action('comment_form_before_fields'); ?>
          <div class="row-fluid">
            <div class="input-prepend span4 <?php if($req) echo 'input-append'; ?>">
              <span class="add-on" title="<?php _e('Your Name', 'huskies-theme'); ?>"><i class="icon-user"></i></span>
              <input id="author" name="author" type="text" value="<?php esc_attr($commenter['comment_author']); ?>" placeholder="<?php _e('name', 'huskies-theme'); ?>" <?php echo $aria_req; ?>/>
              <?php if($req) : ?>
                <span class="add-on" title="<?php _e('required field', 'huskies-theme'); ?>"><i class="icon-asterisk"></i></span>
              <?php endif; ?>
            </div>

            <div class="input-prepend span4 <?php if($req) echo 'input-append'; ?>">
              <span class="add-on" title="<?php _e('Your email address<br />(will not be published)', 'huskies-theme'); ?>"><i class="icon-envelope-alt"></i></span>
              <input id="email" name="email" type="text" value="<?php esc_attr($commenter['comment_author_email']); ?>" placeholder="<?php _e('email', 'huskies-theme'); ?>" <?php echo $aria_req; ?>/>
              <?php if($req) : ?>
                <span class="add-on" title="<?php _e('required field', 'huskies-theme'); ?>"><i class="icon-asterisk"></i></span>
              <?php endif; ?>
            </div>

            <div class="input-prepend span4">
              <span class="add-on" title="<?php _e('Your website', 'huskies-theme'); ?>"><i class="icon-globe"></i></span>
              <input id="url" name="url" type="text" value="<?php esc_attr($commenter['comment_author_url']); ?>" placeholder="<?php _e('website', 'huskies-theme'); ?>" />
            </div>
          </div>
          <?php do_action('comment_form_after_fields'); ?>
        <?php endif; ?>

        <div class="comment_form_comment input-block-level row-fluid">
          <textarea id="comment" name="comment" class="span12" aria-required="true" placeholder="<?php _e('your great comment', 'huskies-theme'); ?>"></textarea>
        </div>

        <dl class="comment_form_allowed_tags dl-horizontal hidden-phone">
          <dt>
            <?php _e('You may use these', 'huskies-theme'); ?>
            <abbr title="HyperText Markup Language">HTML</abbr>
            <?php _e('tags and attributes', 'huskies-theme'); ?>:
          </dt>
          <dd><code><?php echo allowed_tags(); ?></code></dd>
        </dl>
       
        <div class="comment_form_submit form-actions">
          <input name="submit" type="submit" id="submit" class="btn btn-success" value="<?php _e('Post', 'huskies-theme'); ?>" />
          <input type="reset" class="btn" value="<?php _e('Clear', 'huskies-theme'); ?>">
          <?php comment_id_fields($post_id); ?>
        </div>
        <?php do_action('comment_form', $post_id); ?>
      </form>
    <?php endif; ?>
  </div>
  <?php do_action('comment_form_after'); ?>

  <?php else :
    do_action('comment_form_comments_closed');
  endif; 
}
?>
