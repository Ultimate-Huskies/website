<?php
add_filter('timber_context', 'add_to_context');
function add_to_context($data){
  $data['menu'] = new TimberMenu('main_menu'); // This is where you can also send a Wordpress menu slug or ID
  return $data;
}
