<?php
require_once('logged_in.php');

$context['page']['bbpress'] = array(
  'user_pages' => array(
    'is_favorites' => bbp_is_favorites(),
    'is_subscriptions' => bbp_is_subscriptions(),
    'is_edit' => bbp_is_single_user_edit(),
  ),
  'form' => array(
    'tab_index' => TimberHelper::function_wrapper('bbp_tab_index'),
    'title_max_length' => TimberHelper::function_wrapper('bbp_get_title_max_length'),
    'allowed_tags' => TimberHelper::function_wrapper('bbp_allowed_tags'),
    'topic_types' => TimberHelper::function_wrapper('bbp_topic_type_select'),
    'subscriptions_active' => TimberHelper::function_wrapper('bbp_is_subscriptions_active'),
    'favorites_active' => TimberHelper::function_wrapper('bbp_is_favorites_active'),
    'topic_subscribed' => TimberHelper::function_wrapper('bbp_form_topic_subscribed'),
  ),
  'breadcrumb' => bbp_get_breadcrumb(array(
    'include_home' => false,
    'include_root' => false,
    'current_before' => '',
    'current_after' => '',
  )),
);
