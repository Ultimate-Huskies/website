<?php
class Base extends TimberPost {
  function is_closed() {
    return $this->post_status === 'closed';
  }

  function max_file_size() {
    return $this->_gdbbatt_settings['max_file_size'];
  }

  function max_to_upload() {
    return $this->_gdbbatt_settings['max_to_upload'];
  }

  function subscribe_link($args = array()) {
    $defaults = array(
      'user_id' => $this->current_user(),
      'before' => '',
      'subscribe' => __('Subscribe', 'huskies'),
      'unsubscribe' => __('Unsubscribe', 'huskies')
    );

    return bbp_get_user_subscribe_link(array_merge($defaults, $args), 0, false);
  }

  function freshness_author($id = 0) {
    $post_id = get_post_field('post_author', $id);
    return get_the_author_meta('display_name', $post_id);
  }

  function is_author_current_user() {
    return $this->post_author === parent::current_user();
  }

  protected function current_user() {
    return bbp_get_current_user_id();
  }
}
