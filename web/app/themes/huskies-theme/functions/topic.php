<?php
class Topic extends TimberPost {

  function voice_count() {
    return $this->_bbp_voice_count;
  }

  function reply_count() {
    return $this->_bbp_reply_count;
  }

  function pagination() {
    global $wp_rewrite;
    if ( $wp_rewrite->using_permalinks() ) {
      $base = trailingslashit( get_permalink( $this->id ) ) . user_trailingslashit( $wp_rewrite->pagination_base . '/%#%/' );
    } else {
      $base = add_query_arg( 'paged', '%#%', get_permalink( $this->id ) );
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

  function freshness_link() {
    return bbp_get_topic_last_reply_permalink($this->id);
  }

  function freshness_time() {
    return bbp_get_topic_last_active_time($this->id);
  }

  function freshness_author() {
    $post_id = get_post_field('post_author', $this->_bbp_last_active_id);
    return get_the_author_meta('display_name', $post_id);
  }

  function is_sticky() {
    return bbp_is_topic_sticky($this->id);
  }

  function admin_links() {
    if (!is_super_admin()) return '';

    $links = array(
      bbp_get_topic_edit_link(array('id' => $this->id)),
      bbp_get_topic_close_link(array('id' => $this->id)),
      bbp_get_topic_stick_link(array('id' => $this->id)),
      bbp_get_topic_merge_link(array('id' => $this->id)),
      bbp_get_topic_trash_link(array('id' => $this->id))
    );

    return join(' | ', $links);
  }

  function is_closed() {
    return $this->post_status === 'closed';
  }

  function is_author_current_user() {
    return $this->post_author === bbp_get_current_user_id();
  }

  function subscribe_link() {
    $args = array(
      'user_id' => bbp_get_current_user_id(),
      'topic_id' => $this->id,
      'before' => '',
      'subscribe' => __('Subscribe', 'huskies'),
      'unsubscribe' => __('Unsubscribe', 'huskies')
    );

    return bbp_get_user_subscribe_link($args, 0, false);
  }

  function favorite_link() {
    $args = array(
      'user_id' => bbp_get_current_user_id(),
      'topic_id' => $this->id,
      'favorite' => __('Favorite', 'huskies'),
      'favorited' => __('Favorited', 'huskies')
    );

    return bbp_get_user_favorites_link($args, 0, false);
  }
}
