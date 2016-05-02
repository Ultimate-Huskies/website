<?php
add_action('forum_dropdown', 'forum_dropdown', 10, 1);
function forum_dropdown($context) {
  bbp_dropdown(array('selected' => $context['forum']->id));
}

add_action('bbpress_content', 'bbpress_content', 10, 1);
function bbpress_content($context) {
  bbp_the_content(array(
    'context' => $context,
    'before' => '',
    'after' => ''
  ));
}

add_action('bbpress_additional_fields', 'bbpress_additional_fields', 10, 1);
function bbpress_additional_fields($context) {
  if ($context === 'topic') {
    bbp_topic_form_fields();
  }

  if ($context === 'reply') {
    bbp_reply_form_fields();
  }
}
