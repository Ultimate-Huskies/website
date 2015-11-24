<?php
$context = Timber::get_context();
$context['page'] = new TimberPost();
$context['last_posts'] = Timber::get_posts(new WP_Query("posts_per_page=5"));
$context['appointments'] = array_slice((new GCE_Display(['3940']))->merged_feeds, 0, 5);

Timber::render('page/front.twig', $context);
