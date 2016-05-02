<?php
$context = Timber::get_context();
require_once('logged_in.php');

$administrators = new WP_User_Query(array('role' => array('administrator', 'bbp_keymaster'), 'orderby' => 'display_name'));
$context['administrators'] = Timber::get_posts($administrators->get_results(), 'User');

$users = new WP_User_Query(array('role' => 'bbp_participant', 'orderby' => 'display_name'));
$context['users'] = Timber::get_posts($users->get_results(), 'User');

Timber::render('page/members.twig', $context);
