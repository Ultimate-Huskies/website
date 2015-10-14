<?php
add_filter('get_twig', 'add_to_twig');

function add_to_twig($twig) {
  $twig->addFilter('humanize_type', new Twig_Filter_Function('humanize_type'));
  return $twig;
}

function humanize_type($text) {
  switch (strtolower($text)) {
    case 'gallery':
      return  __('PHOTOS', 'huskies');
    case false:
    case 'standard':
      return __('POST', 'huskies');
    default:
      return $text;
  }
}
