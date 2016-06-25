<?php
add_filter('get_twig', 'add_to_twig');

function add_to_twig($twig) {
  $twig->addFilter('humanize_type', new Twig_Filter_Function('humanize_type'));
  $twig->addFunction('ajax_security', new Twig_SimpleFunction('ajax_security', 'ajax_security'));
  return $twig;
}

function humanize_type($text) {
  switch (strtolower($text)) {
    case 'gallery':
      return 'photos';
    case false:
    case 'standard':
      return 'report';
    default:
      return $text;
  }
}

function ajax_security($type, $security) {
  return wp_nonce_field('ajax-'.$type.'-nonce', $security);
}
