<?php
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['last_posts'] = Timber::get_posts(new WP_Query("posts_per_page=5"));

Timber::render('page/front.twig', $context);