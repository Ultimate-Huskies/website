<?php
$context = Timber::get_context();

if (!$context['page']['user']['logged_in']) {
  Timber::render('forum/no.twig', array('reason' => __('Not logged In', 'huskies'), 'context' => $context));
  die();
}

$context['page']['bbpress'] = array(
  'form' => array(
    'tab_index' => TimberHelper::function_wrapper('bbp_tab_index'),
    'title_max_length' => TimberHelper::function_wrapper('bbp_get_title_max_length'),
    'allowed_tags' => TimberHelper::function_wrapper('bbp_allowed_tags'),
    'topic_types' => TimberHelper::function_wrapper('bbp_topic_type_select'),
    'subscriptions_active' => TimberHelper::function_wrapper('bbp_is_subscriptions_active'),
    'topic_subscribed' => TimberHelper::function_wrapper('bbp_form_topic_subscribed'),
  ),
  'breadcrumb' => bbp_get_breadcrumb(array(
    'include_home' => false,
    'include_root' => false,
    'current_before' => '',
    'current_after' => '',
  )),
);
