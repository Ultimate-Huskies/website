<?php
class Forum extends Base {
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
    return get_permalink(bbp_get_forum_last_reply_id($this->id));
  }

  function freshness_topic() {
    return bbp_get_forum_last_topic_title($this->id);
  }

  function subscribe_link($args = array()) {
    return parent::subscribe_link(array('forum_id' => $this->id));
  }

  function freshness_author($id = 0) {
    return parent::freshness_author(bbp_get_forum_last_reply_id($this->id));
  }
}
