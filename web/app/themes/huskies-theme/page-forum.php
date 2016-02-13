<?php
require_once('forum_before.php');

if (!bbp_has_forums(array('orderby' => 'title')))
  return Timber::render('forum/no.twig', array('reason' => __('No Forums', 'huskies'), 'context' => $context));

$context['forums'] = Timber::get_posts(bbpress()->forum_query, 'Forum');
Timber::render('forum/forums.twig', $context);
