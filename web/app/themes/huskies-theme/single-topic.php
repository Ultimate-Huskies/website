<?php
require_once('forum_before.php');

if (!bbp_user_can_view_forum(array('forum_id' => bbp_get_topic_forum_id()))) {
  abort($context, __('No Access', 'huskies'));
}

if (!bbp_has_replies()) {
  abort($context, __('No Replies', 'huskies'));
}

$context['replies'] = Timber::get_posts(bbpress()->reply_query, 'Reply');
$context['reply_count'] = !empty(bbpress()->reply_query->found_posts) ? bbpress()->reply_query->found_posts : bbpress()->reply_query->post_count;
$context['topic'] = Timber::get_post(false, 'Topic');
$context['pagination'] = Timber::get_pagination(bbpress()->reply_query->pagination_args);
Timber::render('forum/replies.twig', $context);
