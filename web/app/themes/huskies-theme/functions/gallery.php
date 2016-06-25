<?php
function gallery($fist, $attr) {
  $post = get_post();

  extract(shortcode_atts(array(
    'order'      => 'DESC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => '',
    'type'       => 'grid'
  ), $attr));

  $id = intval($id);
  if ('RAND' == $order) $orderby = 'none';
  $search = array(
    'post_status'     => 'inherit',
    'post_type'       => 'attachment',
    'post_mime_type'  => 'image',
    'order'           => $order,
    'orderby'         => $orderby
  );

  if (!empty($include)) {
    $search['include'] = $include;
    $_attachments = get_posts($search);

    $attachments = array();
    foreach ($_attachments as $key => $val) $attachments[$val->ID] = $_attachments[$key];
  } else {
    $search['post_parent'] = $id;

    if (!empty($exclude)) {
      $search['exclude'] = $exclude;
      $attachments = get_children($search);
    } else {
      $attachments = get_children($search);
    }
  }

  # return here, if no images in the gallery
  if (empty($attachments)) return '';

  # return here for custom feed output
  if (is_feed()) {
    $output = "\n";
    foreach ($attachments as $att_id => $attachment) $output .= wp_get_attachment_link($att_id, $size, true)."\n";
    return $output;
  }

  $items = array();
  foreach ($attachments as $idAttachment => $attachment) {
    $items[] = array(
      'image' => wp_get_attachment_image($idAttachment, (is_page_template("page-front.php") ? 'full' : $size)),
      'title' => $attachment->post_title,
      'excerpt' => $attachment->post_excerpt,
      'url' => array(
        'original' => wp_get_attachment_url($idAttachment),
        'thumbnail' => wp_get_attachment_image_src($idAttachment, 'thumbnail')[0],
        'medium' => wp_get_attachment_image_src($idAttachment, 'medium')[0],
        'large' => wp_get_attachment_image_src($idAttachment, 'large')[0]
      )
    );
  }

  $template = 'gallery/'.(is_front_page() ? 'front'  : 'general').'.twig';
  return Timber::compile($template, array('items' => $items));
}
add_filter('post_gallery', 'gallery', 20, 2);
