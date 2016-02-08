<?php
$context = Timber::get_context();

if (!$context['page']['user']['logged_in']) {
  Timber::render('forum/not_logged_in.twig', $context);
  die();
}

$context['page']['bbpress'] = array(
  'tab_index' => TimberHelper::function_wrapper('bbp_tab_index'),
  'title_max_length' => TimberHelper::function_wrapper('bbp_get_title_max_length'),
  'content_topic' => TimberHelper::function_wrapper('bbp_the_content', array(array('context' => 'topic', 'before' => '', 'after' => ''))),
  'content_reply' => TimberHelper::function_wrapper('bbp_the_content', array(array('context' => 'reply', 'before' => '', 'after' => ''))),
  'allowed_tags' => TimberHelper::function_wrapper('bbp_allowed_tags'),
  'topic_types' => TimberHelper::function_wrapper('bbp_topic_type_select'),
  'subscription_active' => TimberHelper::function_wrapper('bbp_is_subscriptions_active'),
  'topic_subscribed' => TimberHelper::function_wrapper('bbp_form_topic_subscribed'),
  'topic_additional_fields' => TimberHelper::function_wrapper('bbp_topic_form_fields'),
  'reply_additional_fields' => TimberHelper::function_wrapper('bbp_reply_form_fields'),
  'breadcrumb' => bbp_get_breadcrumb(array(
    'include_home' => false,
    'include_root' => false,
    'current_before' => '',
    'current_after' => '',
  )),
  'current_user' => array(
    'can' => array(
      'access_topic_form' => TimberHelper::function_wrapper('bbp_current_user_can_access_create_topic_form'),
      'unfiltered_html' => TimberHelper::function_wrapper('current_user_can', array('unfiltered_html')),
      'moderate' => TimberHelper::function_wrapper('current_user_can', array('moderate')),
    ),
    'id' => TimberHelper::function_wrapper('bbp_get_current_user_id'),
  ),
);
