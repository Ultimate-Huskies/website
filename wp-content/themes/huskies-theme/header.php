<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php bloginfo('description') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if (is_page('impressum') || is_page('imprint')) { ?>
      <meta name="robots" content="noindex,follow" />
    <?php } else { ?>
      <meta name="robots" content="index,follow" />
    <?php } ?>

    <title><?php 
      bloginfo('name');
      wp_title();
    ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> feed" href="<?php bloginfo('rss2_url'); ?>" />

    <link rel="shortcut icon" href="<?php print IMAGES_PATH ?>/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php print IMAGES_PATH ?>/apple-touch-icon.png"/>

    <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="container" id="content-wrapper">
      <header id="topHeader" class="container">
        <div class="navbar">
          <div class="navbar-inner">
            <a class="btn btn-navbar icon-reorder pull-left" data-toggle="collapse" data-target=".nav-collapse"><?php _e('toggle menu', 'huskies-theme'); ?></a>
            <?php wp_nav_menu(array(
                    'theme_location' => 'main_menu',
                    'container'      => 'div',
                    'container_class'=> 'nav-collapse collapse',
                    'menu_class'     => 'nav nav-pills',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">'.
                                          '<li class="home_link">'.
                                            '<a href="'.home_url().'" title="'.__('home', 'huskies-theme').'"><i class="icon-home"></i></a>'.
                                          '</li>%3$s</ul>',
                    'walker'         => new bootstrap_nav_walker()
            )); ?>
          </div>
        </div>
        <?php get_search_form(); ?>
      </header>
      <img id="logo-disc" class="hidden-phone" src="<?php print IMAGES_PATH ?>/disc.png" alt="<?php _e('disc', 'huskies-theme'); ?>" />
      <img id="logo-head" class="hidden-phone" src="<?php print IMAGES_PATH ?>/head.png" alt="<?php _e('head', 'huskies-theme'); ?>" />
      <img id="logo-body" class="hidden-phone" src="<?php print IMAGES_PATH ?>/body.png" alt="<?php _e('body', 'huskies-theme'); ?>" />
      <div id="user_info">
        <?php if (is_user_logged_in()) : ?>
          <?php bbp_current_user_avatar(72); ?>
          <p>
            <?php _e('Logged in as', 'huskies-theme'); ?> 
            <a href="<?php echo bbp_get_user_profile_url(bbp_get_current_user_id()); ?>" title="<?php _e('See your profile', 'huskies-theme'); ?>">
              <?php bbp_current_user_name(); ?>
            </a>
          </p>
          <hr>
          <p>
            <a href="<?php echo wp_logout_url(); ?>"><?php _e('Logout', 'huskies-theme'); ?> <i class="icon-signout"></i></a>
          </p>
        <?php else : ?>
          <?php //82x82 ?>
          <div class="avatar_anonym"><i class="icon-user"></i></div>
          <p><a href="<?php echo wp_login_url(); ?>"><?php _e('Login', 'huskies-theme'); ?> <i class="icon-signin"></i></a></p>
          <hr>
          <p><a href="<?php echo home_url(); ?>/wp-login.php?action=register"><?php _e('Register','huskies-theme'); ?> <i class="icon-share"></i></a></p>
        <?php endif; ?>
      </div>

      <a id="siteName" href="<?php echo home_url(); ?>">
        <h1><?php bloginfo('name'); ?></h1>
      </a> 

      <section id="content" class="clearfix">