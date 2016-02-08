<?php
require_once('forum_before.php');

if (!bbp_user_can_view_forum())
  return Timber::render('forum/no_access.twig', $context);

if (!bbp_has_topics(array('orderby' => '_bbp_last_active_time', 'show_stickies' => false)))
  return Timber::render('forum/no_topics.twig', $context);

$context['pagination'] = Timber::get_pagination(bbpress()->topic_query->pagination_args);
$context['topic_count'] = !empty(bbpress()->topic_query->found_posts) ? bbpress()->topic_query->found_posts : bbpress()->topic_query->post_count;
$context['topics'] = Timber::get_posts(bbpress()->topic_query, 'Topic');

$stickies = bbp_get_super_stickies();
$forum_id = $context['topics'][0]->_bbp_forum_id;
if (!empty($forum_id)) {
  $stickies = array_merge($stickies, bbp_get_stickies($forum_id));
}

$stickies = array_unique($stickies);
$sticky_query = array(
  'post_type'   => bbpress()->topic_query->query['post_type'],
  'post_parent' => 'any',
  'meta_key'    => '_bbp_last_active_time',
  'orderby'     => 'meta_value',
  'order'       => 'DESC',
  'post_status' => bbp_get_view_all() ? bbpress()->topic_query->query['post_status'] : bbpress()->topic_query->query['perm'],
  'include'     => $stickies
);

$context['sticky_topics'] = Timber::get_posts(get_posts($sticky_query), 'Topic');
$context['forum'] = Timber::get_post(false, 'Forum');
Timber::render('forum/topics.twig', $context);
