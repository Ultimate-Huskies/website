<?php
$context = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render('page/single.twig', $context);
