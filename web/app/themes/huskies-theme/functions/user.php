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
    if (isset($this->metadata()['phone'])) {
      return $this->metadata()['phone'][0];
    } else {
      return '';
    }
  }

  private function metadata() {
    if (!isset($this->metadata)) {
      $this->metadata = get_user_meta($this->ID);
    }

    return $this->metadata;
  }

  private function userdata() {
    if (!isset($this->userdata)) {
      $this->userdata = get_userdata($this->ID)->data;
    }

    return $this->userdata;
  }
}
