<?php
$context = Timber::get_context();
$context['page'] = new TimberPost();

Timber::render('page/single.twig', $context);
