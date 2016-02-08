<?php
class Reply extends TimberPost {

  function date($date_format = '') {
    return bbp_reply_post_date($this->id);
  }

  function content($page = 0) {
    return bbp_reply_content($this->id);
  }

  function admin_links() {
    if (!is_super_admin()) return '';

    return bbp_get_reply_admin_links(array('id' => $this->id, 'before' => '', 'after' => ''));
  }

  function author_link() {
    return bbp_reply_author_url($this->id);
  }

  function author_avatar() {
    return bbp_get_reply_author_avatar($this->id, 100);
  }

  function author_role() {
    return bbp_get_reply_author_role(array('reply_id' => $this->id));
  }

  function author_topic_count() {
    return bbp_get_user_topic_count_raw($this->post_author);
  }

  function author_reply_count() {
    return bbp_get_user_reply_count_raw($this->post_author);
  }

  function is_author_current_user() {
    return $this->post_author === bbp_get_current_user_id();
  }
}
