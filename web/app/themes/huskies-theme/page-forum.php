<?php
$context = Timber::get_context();
require_once('forum.php');

if (!bbp_has_forums(array('orderby' => 'title'))) {
  abort($context, __('No Forums', 'huskies'));
}

$query = array(
  'post_type' => bbp_get_topic_post_type(),
  'post_parent' => 'any',
  'meta_key' => 'bbppu_read_by',
  'meta_value' => 'i:'.bbp_get_current_user_id(),
  'meta_compare' => 'NOT LIKE',
  'orderby' => 'title',
  'order' => 'DESC',
  'nopaging' => true
);

$context['unread_topics'] = Timber::get_posts(new WP_Query($query), 'Topic');
$context['forums'] = Timber::get_posts(bbpress()->forum_query, 'Forum');
Timber::render('forum/forums.twig', $context);
