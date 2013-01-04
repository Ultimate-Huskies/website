<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php bloginfo('description') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        <?php wp_nav_menu(array(
                'theme_location' => 'main_menu',
                'container'      => false,
                'menu_class'     => 'nav nav-pills',
                'walker'         => new bootstrap_nav_walker()
              )); ?>
      </header>
      <img id="disc" src="<?php print IMAGES_PATH ?>/disc.png" alt="<?php _e('disc', 'huskies-theme'); ?>" />
      <img id="head" src="<?php print IMAGES_PATH ?>/head.png" alt="<?php _e('head', 'huskies-theme'); ?>" />
      <img id="body" src="<?php print IMAGES_PATH ?>/body.png" alt="<?php _e('body', 'huskies-theme'); ?>" />
      <a id="siteName" href="<?php echo home_url(); ?>">
        <h1><?php _e('Ultimate Huskies', 'huskies-theme'); ?></h1>
      </a>

      <section id="content">