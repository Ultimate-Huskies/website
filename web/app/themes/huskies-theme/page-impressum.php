<?php
$context = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render('page/bare.twig', $context);
