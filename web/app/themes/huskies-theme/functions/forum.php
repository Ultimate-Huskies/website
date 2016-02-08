<?php
class Forum extends TimberPost {
  var $_last_active_id;

  function topic_count() {
    return $this->_bbp_topic_count;
  }

  function reply_count() {
    return $this->_bbp_reply_count;
  }

  function freshness_time() {
    return bbp_get_forum_last_active_time($this->id);
  }

  function freshness_link() {
    // $active_id = $this->get_last_active_id();
    $link_url = bbp_get_forum_last_topic_permalink($this->id);

    return $link_url;
  }

  function freshness_topic() {
    return bbp_get_forum_last_topic_title($this->id);
  }

  function freshness_author() {
    $post_id = get_post_field('post_author', $this->get_last_active_id());
    return get_the_author_meta('display_name', $post_id);
  }

  function is_closed() {
    return $this->post_status === 'closed';
  }

  function max_file_size() {
    return $this->_gdbbatt_settings['max_file_size'];
  }

  function max_to_upload() {
    return $this->_gdbbatt_settings['max_to_upload'];
  }

  function subscribe_link() {
    $args = array(
      'user_id' => bbp_get_current_user_id(),
      'forum_id' => $this->id,
      'before' => '',
      'subscribe' => __('Subscribe', 'huskies'),
      'unsubscribe' => __('Unsubscribe', 'huskies')
    );

    return bbp_get_user_subscribe_link($args, 0, false);
  }

  private function get_last_active_id() {
    if (!$this->_last_active_id)
      $this->_last_active_id = bbp_get_forum_last_active_id($this->id);

    return $this->_last_active_id;
  }
}
