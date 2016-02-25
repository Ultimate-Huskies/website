<?php
require_once('forum_before.php');

if (!bbp_user_can_view_forum(array('forum_id' => bbp_get_topic_forum_id()))) {
  abort($context, __('No Access', 'huskies'));
}

$context['reply'] = Timber::get_post(false, 'Reply');
$context['topic'] = Timber::get_post(new WP_Query(array('post_type' => bbp_get_topic_post_type(), 'p' => $context['reply']->_bbp_topic_id)), 'Topic');
Timber::render('forum/reply_edit.twig', $context);
