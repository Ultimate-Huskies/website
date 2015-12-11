<?php
$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['last_posts'] = Timber::get_posts(new WP_Query("posts_per_page=5"));

$calendar = new SimpleCalendar\Calendars\Default_Calendar(3940);
$context['calendar'] = $calendar;
$context['appointments'] = $calendar->get_events()->get_events(5);

Timber::render('page/front.twig', $context);
