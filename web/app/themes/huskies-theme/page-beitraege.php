<?php
$context = Timber::get_context();

$args = array(
  'tax_query' => array(
    array(
      'taxonomy' => 'post_format',
      'field' => 'slug',
      'terms' => 'post-format-gallery',
      'operator' => 'NOT IN'
    )
  )
);
$context['last_posts'] = Timber::get_posts(new WP_Query($args));

Timber::render('page/blog.twig', $context);
