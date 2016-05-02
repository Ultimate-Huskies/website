<?php
class Reply extends Base {

  function date($date_format = '') {
    return bbp_get_reply_post_date($this->id);
  }

  function content($page = 0) {
    return bbp_get_reply_content($this->id);
  }

  function admin_links() {
    if (!is_super_admin()) return '';

    if (bbp_is_topic($this->id)) {
      $topic = new Topic(array('id' => $this->_bbp_topic_id));
      return $topic->admin_links();
    }

    $links = array(
      bbp_get_reply_edit_link(array('id' => $this->id)),
      bbp_get_reply_trash_link(array('id' => $this->id)),
    );

    return join(' | ', $links);
  }

  function author_link() {
    return bbp_reply_author_url($this->id);
  }

  function author_avatar($size = 100) {
    return get_avatar(bbp_get_reply_author_id($this->id), $size, '', '', array('class' => 'reply__author-image'));
  }

  function author_role() {
    return bbp_get_user_display_role(bbp_get_reply_author_id($this->id));
  }

  function author_topic_count() {
    return bbp_get_user_topic_count_raw($this->post_author);
  }

  function author_reply_count() {
    return bbp_get_user_reply_count_raw($this->post_author);
  }
}
