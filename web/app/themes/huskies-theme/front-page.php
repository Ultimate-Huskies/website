<?php
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
  wp_logout();

  if (!empty( $_REQUEST['redirect_to'])) {
    wp_redirect($_REQUEST['redirect_to']);
  } else {
    wp_redirect(home_url());
  }
  die();
}

$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['last_posts'] = Timber::get_posts(new WP_Query("posts_per_page=5"));

$calendar = new SimpleCalendar\Calendars\Default_Calendar(3940);

$feed = simcal_get_feed($calendar);
date_default_timezone_set(get_post_meta($feed->post_id, '_feed_timezone', true));

$context['calendar'] = $calendar;
$context['appointments'] = $calendar->get_events()->get_events(5);

Timber::render('page/front.twig', $context);
