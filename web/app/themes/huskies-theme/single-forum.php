<?php
require_once('forum_before.php');

if (!bbp_user_can_view_forum())
  return Timber::render('forum/no.twig', array('reason' => __('No Access', 'huskies'), 'context' => $context));

if (!bbp_has_topics(array('orderby' => 'post_status meta_value', 'order' => 'DESC', 'show_stickies' => false)))
  return Timber::render('forum/no.twig', array('reason' => __('No Topics', 'huskies'), 'context' => $context));

$context['pagination'] = Timber::get_pagination(bbpress()->topic_query->pagination_args);
$context['topic_count'] = !empty(bbpress()->topic_query->found_posts) ? bbpress()->topic_query->found_posts : bbpress()->topic_query->post_count;
$context['topics'] = Timber::get_posts(bbpress()->topic_query, 'Topic');

$forum_id = $context['topics'][0]->_bbp_forum_id;
$sticky_ids = bbp_get_super_stickies();
if (!empty($forum_id)) {
  $sticky_ids = array_merge($sticky_ids, bbp_get_stickies($forum_id));
}

$sticky_ids = array_unique($sticky_ids);
if (count($sticky_ids) > 0) {
  $sticky_query = array(
    'post_type'   => bbpress()->topic_query->query['post_type'],
    'post_parent' => 'any',
    'meta_key'    => '_bbp_last_active_time',
    'orderby'     => 'meta_value',
    'order'       => 'DESC',
    'post_status' => bbp_get_view_all() ? bbpress()->topic_query->query['post_status'] : bbpress()->topic_query->query['perm'],
    'include'     => $sticky_ids
  );
  $stickies = Timber::get_posts(get_posts($sticky_query), 'Topic');
} else {
  $stickies = array();
}

$context['sticky_topics'] = $stickies;
$context['forum'] = Timber::get_post(false, 'Forum');
Timber::render('forum/topics.twig', $context);
