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
}
