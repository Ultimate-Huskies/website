<?php
require_once('forum_before.php');

if (!bbp_user_can_view_forum(array('forum_id' => bbp_get_topic_forum_id())))
  return Timber::render('forum/no.twig', array('reason' => __('No Access', 'huskies'), 'context' => $context));

$context['topic'] = Timber::get_post(false, 'Topic');
$context['forum'] = Timber::get_post(new WP_Query(array('post_type' => bbp_get_forum_post_type(), 'p' => $context['topic']->_bbp_forum_id)), 'Forum');
Timber::render('forum/topic_edit.twig', $context);
