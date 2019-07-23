<?php
add_filter('timber_context', 'add_to_context');
function add_to_context($data){
  $data['menu'] = new TimberMenu('main_menu');
  $data['footer_map'] = Timber::get_widgets('footer_map');

  $data['page'] = array(
    'set_new_password' => array(
      'show' => (!is_user_logged_in() && isset($_GET['action']) && $_GET['action'] === 'snp'),
      'key' => isset($_GET['snpkey']) ? $_GET['snpkey'] : null,
      'login' => isset($_GET['snplogin']) ? $_GET['snplogin'] : null
    ),
    'ajax_url' => admin_url('admin-ajax.php'),
    'permalink' => get_permalink(),
    'home_url' => home_url(),
    'login_url' => TimberHelper::function_wrapper('wp_login_url', array(get_permalink())),
    'logout_url' => TimberHelper::function_wrapper('wp_logout_url', array(home_url())),
    'register_url' => TimberHelper::function_wrapper('wp_registration_url'),
    'date_format' => get_option('date_format'),
    'time_format' => get_option('time_format'),

    'user' => array(
      'logged_in' => is_user_logged_in(),
      'profile' => array(
        'url' => TimberHelper::function_wrapper('bbp_get_user_profile_url', array(bbp_get_current_user_id())),
        'image' => TimberHelper::function_wrapper('bbp_get_current_user_avatar', array(50)),
        'id' => TimberHelper::function_wrapper('bbp_get_current_user_id'),
        'name' => TimberHelper::function_wrapper('bbp_current_user_name'),
        'unread_topics' => get_unread_counts()
      ),
      'can' => array(
        'access_topic_form' => TimberHelper::function_wrapper('bbp_current_user_can_access_create_topic_form'),
        'access_reply_form' => TimberHelper::function_wrapper('bbp_current_user_can_access_create_reply_form'),
        'unfiltered_html' => TimberHelper::function_wrapper('current_user_can', array('unfiltered_html')),
        'moderate' => TimberHelper::function_wrapper('current_user_can', array('moderate')),
      )
    ),
  );

  return $data;
}

function get_unread_topic_query_args($parent_id='any') {
  if (!is_user_logged_in()) {
    return 0 ;
  }
  $user = wp_get_current_user();

  // get all read topics and
  // all topics that where created before the user has registered
  $read_topic_args = array(
    'post_type' => bbp_get_topic_post_type(),
    'post_parent' => $parent_id,
    'nopaging' => true,
    'meta_query' => array(
      array( # add inner array (bbpress adds additional meta query args that need to be combined with relation "AND")
        'relation' => 'OR',
        'read_clause' => array(
            'key' => 'bbppu_read_by',
            'value' => $user->ID,
            'compare' => '='
        ),
        'older_than_registered_clause' => array(
            'key' => '_bbp_last_active_time',
            'value' => $user->user_registered,
            'compare' => '<'
        )
      )
    )
  );
  $read_topic_query = new WP_Query( $read_topic_args );
  
  // put all read topic ids in an array
  $read_topic_ids = array_map( function( $v ) {
		return $v->ID;
  }, $read_topic_query->posts );

  // create query for all forum topics except the read topics
  return array(
    'post_type' => bbp_get_topic_post_type(),
    'post_parent' => $parent_id,
    'post__not_in' => $read_topic_ids
  );
};

function get_unread_counts() {
  if (!is_user_logged_in()) {
    return 0 ;
  }

  $topics = new WP_Query(get_unread_topic_query_args());
  return $topics->found_posts;
}
