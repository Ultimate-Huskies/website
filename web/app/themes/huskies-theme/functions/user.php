<?php
class User extends TimberPost {
  private $metadata = null;
  private $userdata = null;

  function avatar($size = 100, $class = '') {
    return get_avatar($this->ID, $size, '', '');
  }

  function profile_link() {
    return bbp_get_user_profile_url($this->ID);
  }

  function name() {
    return $this->userdata()->display_name;
  }

  function email() {
    return $this->userdata()->user_email;
  }

  function phone() {
    return $this->metadata('phone');
  }

  function first_name() {
    return $this->metadata('first_name');
  }

  function last_name() {
    return $this->metadata('last_name');
  }

  function nickname() {
    return $this->metadata('nickname');
  }

  function can_edit() {
    return bbp_is_user_home($this->ID); # || current_user_can('edit_users');
  }

  function favorites_link() {
    return bbp_favorites_permalink($this->ID);
  }

  function subscriptions_link() {
    return bbp_subscriptions_permalink($this->ID);
  }

  function edit_link() {
    return bbp_user_profile_edit_url($this->ID);
  }

  function topic_count() {
    return bbp_get_user_topic_count_raw($this->ID);
  }

  function reply_count() {
    return bbp_get_user_reply_count_raw($this->ID);
  }

  function forum_role() {
    return bbp_user_display_role($this->ID);
  }

  private function metadata($field = null) {
    if (!isset($this->metadata)) {
      $this->metadata = get_user_meta($this->ID);
    }

    if (!isset($field)) {
      return $this->metadata;
    }

    if (isset($this->metadata()[$field])) {
      return $this->metadata()[$field][0];
    } else {
      return '';
    }
  }

  private function userdata() {
    if (!isset($this->userdata)) {
      $this->userdata = get_userdata($this->ID)->data;
    }

    return $this->userdata;
  }
}
