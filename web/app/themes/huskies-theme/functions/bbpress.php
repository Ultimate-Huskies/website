<?php
require_once(FUNCTIONS_PATH.'/bbpress/base.php');
require_once(FUNCTIONS_PATH.'/bbpress/forum.php');
require_once(FUNCTIONS_PATH.'/bbpress/topic.php');
require_once(FUNCTIONS_PATH.'/bbpress/reply.php');

function custom_bbp_get_breadcrumb($trail, $crumbs) {
  $data = array(
    'items' => $crumbs,
    'overview' => !bbp_is_single_forum() && !bbp_is_single_topic()
  );
  return Timber::compile('forum/breadcrumb.twig', $data);
}
add_filter('bbp_get_breadcrumb', 'custom_bbp_get_breadcrumb', 1, 2);

function custom_forum_title($title) {
  return str_replace('Privat: ', '', $title);
}
add_filter('bbp_get_forum_title', 'custom_forum_title');

function no_edit_lock() {
  return false;
}
add_filter('bbp_past_edit_lock', 'no_edit_lock');

function enable_visual_editor($args = array()) {
  $args['tinymce'] = true;
  return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'enable_visual_editor');

function topic_pagination($args = array()) {
  bbpress()->topic_query->pagination_args = $args;
  return $args;
}
add_filter('bbp_topic_pagination', 'topic_pagination');

function reply_pagination($args = array()) {
  bbpress()->reply_query->pagination_args = $args;
  return $args;
}
add_filter('bbp_replies_pagination', 'reply_pagination');
