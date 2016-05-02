<?php
$context = Timber::get_context();
require_once('forum.php');

if (!bbp_user_can_view_forum()) {
  abort($context, __('No Access', 'huskies'));
}

$forum_id = bbp_get_forum_id();
$stickies = array(
  'super_sticky_topics' => array_unique(bbp_get_super_stickies()),
  'sticky_topics' => array_unique(!empty($forum_id) ? bbp_get_stickies($forum_id) : array())
);

$query = array(
  'orderby' => 'post_status meta_value',
  'order' => 'DESC',
  'show_stickies' => false,
  'post__not_in' => array_merge($stickies['super_sticky_topics'], $stickies['sticky_topics'])
);

if (!bbp_has_topics($query)) {
  abort($context, __('No Topics', 'huskies'));
}

$context['pagination'] = Timber::get_pagination(bbpress()->topic_query->pagination_args);
$context['topic_count'] = !empty(bbpress()->topic_query->found_posts) ? bbpress()->topic_query->found_posts : bbpress()->topic_query->post_count;
$context['topics'] = Timber::get_posts(bbpress()->topic_query, 'Topic');

foreach ($stickies as $name => $sticky) {
  if (count($sticky) > 0) {
    $sticky_query = array(
      'post_type'   => bbpress()->topic_query->query['post_type'],
      'post_parent' => 'any',
      'meta_key'    => '_bbp_last_active_time',
      'orderby'     => 'meta_value',
      'order'       => 'DESC',
      'post_status' => bbp_get_view_all() ? bbpress()->topic_query->query['post_status'] : bbpress()->topic_query->query['perm'],
      'include'     => $sticky
    );
    $context[$name] = Timber::get_posts(get_posts($sticky_query), 'Topic');
  } else {
    $context[$name] = array();
  }
}

$context['forum'] = Timber::get_post(false, 'Forum');
Timber::render('forum/topics.twig', $context);
