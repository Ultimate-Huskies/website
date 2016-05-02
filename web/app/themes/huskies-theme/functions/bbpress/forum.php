<?php
class Forum extends Base {
  function topic_count() {
    return $this->_bbp_topic_count;
  }

  function max_file_size() {
    return $this->_gdbbatt_settings['max_file_size'];
  }

  function max_to_upload() {
    return $this->_gdbbatt_settings['max_to_upload'];
  }

  function freshness_time() {
    return bbp_get_forum_last_active_time($this->id);
  }

  function subscribe_link($args = array()) {
    return parent::subscribe_link(array('forum_id' => $this->id));
  }

  function is_unread() {
    $query = array(
      'post_type' => bbp_get_topic_post_type(),
      'post_parent' => $this->id,
      'meta_key' => 'bbppu_read_by',
      'meta_value' => 'i:'.bbp_get_current_user_id(),
      'meta_compare' => 'NOT LIKE',
      'orderby' => 'title',
      'order' => 'DESC',
      'nopaging' => true
    );

    $topics = new WP_Query($query);
    return count($topics->posts) > 0;
  }
}
