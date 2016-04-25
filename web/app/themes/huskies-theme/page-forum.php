<?php
$context = Timber::get_context();
require_once('forum.php');

if (!bbp_has_forums(array('orderby' => 'title'))) {
  abort($context, __('No Forums', 'huskies'));
}

$context['forums'] = Timber::get_posts(bbpress()->forum_query, 'Forum');
Timber::render('forum/forums.twig', $context);
