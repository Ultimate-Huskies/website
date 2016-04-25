<?php
$context = Timber::get_context();
require_once('forum.php');

if (bbp_is_subscriptions() && bbp_get_user_topic_subscriptions(bbp_get_current_user_id())) {
  $context['subscriptions'] = Timber::get_posts(bbpress()->topic_query, 'Topic');
}

if (bbp_is_favorites() && bbp_get_user_favorites(bbp_get_current_user_id())) {
  $context['favorites'] = Timber::get_posts(bbpress()->topic_query, 'Topic');
}

$context['user'] = Timber::get_post(bbpress()->displayed_user, 'User');
Timber::render('forum/user.twig', $context);
