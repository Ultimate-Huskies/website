<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php bloginfo('description') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php 
      bloginfo('name');
      wp_title();
    ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="<?php print IMAGES_PATH ?>/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php print IMAGES_PATH ?>/apple-touch-icon.png"/>

    <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="container">