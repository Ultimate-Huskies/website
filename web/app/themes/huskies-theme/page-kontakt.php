<?php
$context = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render('page/contact.twig', $context);
