<?php
$context = Timber::get_context();
require_once('forum.php');

if (!bbp_has_forums(array('orderby' => 'title'))) {
  abort($context, __('No Forums', 'huskies'));
}

$query = get_unread_topic_query_args();
$query['posts_per_page'] = 5;
$query['orderby'] = 'last_modified_clause';
$query['order'] = 'DESC';
$query['nopaging'] = false;

$context['unread_topics'] = Timber::get_posts(new WP_Query($query), 'Topic');
$context['forums'] = Timber::get_posts(bbpress()->forum_query, 'Forum');
Timber::render('forum/forums.twig', $context);
