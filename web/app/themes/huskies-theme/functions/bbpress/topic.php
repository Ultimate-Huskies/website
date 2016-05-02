<?php
class Topic extends Base {

  function max_file_size() {
    global $gdbbpress_attachments;
    return $gdbbpress_attachments->get_file_size(false, $this->_bbp_forum_id);
  }

  function max_to_upload() {
    global $gdbbpress_attachments;
    return $gdbbpress_attachments->get_max_files(false, $this->_bbp_forum_id);
  }

  function reply_count() {
    return $this->_bbp_reply_count;
  }

  function freshness_time() {
    return bbp_get_topic_last_active_time($this->id);
  }

  function is_unread() {
    if (!is_array($this->bbppu_read_by)) {
      return true;
    }

    return !in_array(bbp_get_current_user_id(), $this->bbppu_read_by);
  }

  function is_sticky() {
    return bbp_is_topic_sticky($this->id, false);
  }

  function is_super_sticky() {
    return bbp_is_topic_super_sticky($this->id);
  }

  function freshness_author($id = 0) {
    return parent::freshness_author($this->_bbp_last_active_id);
  }

  function author_avatar($size = 50) {
    $post_id = get_post_field('post_author', $this->id);
    return get_avatar(get_the_author_meta('ID', $post_id), $size);
  }

  function pagination() {
    global $wp_rewrite;
    if ($wp_rewrite->using_permalinks()) {
      $base = trailingslashit(get_permalink($this->id)).user_trailingslashit($wp_rewrite->pagination_base.'/%#%/');
    } else {
      $base = add_query_arg('paged', '%#%', get_permalink($this->id));
    }

    $total = $this->reply_count();
    if (!bbp_show_lead_topic())
      $total++;

    $pagination = array(
      'base'      => $base,
      'format'    => '',
      'total'     => ceil( (int) $total / (int) bbp_get_replies_per_page() ),
      'current'   => 0,
      'prev_next' => false,
      'mid_size'  => 2,
      'end_size'  => 3,
      'add_args'  => ( bbp_get_view_all() ) ? array( 'view' => 'all' ) : false
    );

    return TimberHelper::paginate_links($pagination);
  }

  function admin_links() {
    if (!is_super_admin()) return '';

    $links = array(
      bbp_get_topic_edit_link(array('id' => $this->id)),
      bbp_get_topic_close_link(array('id' => $this->id)),
      bbp_get_topic_stick_link(array('id' => $this->id)),
      bbp_get_topic_trash_link(array('id' => $this->id))
    );

    return join(' | ', $links);
  }

  function subscribe_link($args = array()) {
    return parent::subscribe_link(array('topic_id' => $this->id));
  }

  function favorite_link() {
    $args = array(
      'user_id' => parent::current_user(),
      'topic_id' => $this->id,
      'favorite' => __('Favorite', 'huskies'),
      'favorited' => __('Favorited', 'huskies')
    );

    return bbp_get_user_favorites_link($args, 0, false);
  }
}
