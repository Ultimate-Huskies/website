<?php
require_once('forum_before.php');

if (!bbp_has_forums(array('orderby' => 'title'))) {
  abort($context, __('No Forums', 'huskies'));
}

$context['forums'] = Timber::get_posts(bbpress()->forum_query, 'Forum');
Timber::render('forum/forums.twig', $context);
