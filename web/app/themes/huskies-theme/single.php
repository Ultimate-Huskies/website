<?php
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render('page/single.twig', $context);
