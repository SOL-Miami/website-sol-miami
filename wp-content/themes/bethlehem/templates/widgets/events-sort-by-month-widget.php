<?php

extract( $args );

$title = apply_filters( 'widget_title', $instance['title'] );

echo $before_widget;

echo $before_title . $title . $after_title;

$number_of_month = (intval($instance['number_of_month']) ? intval($instance['number_of_month']) : 12 );
$year = date('Y');
$month = date('m');

echo '<ul>';
$i = 1;
for ( ; ;) {
	if ($i > $number_of_month) {
        break;
    }
    if ($month > 12) {
		$month = 01;
		$year++;
	}
	echo '<li><a href="'.esc_url(add_query_arg( array( 'post_type' => 'tribe_events', 'tribe-bar-date' => ''.$year.'-'.$month.'' ) )).'">'. date("F", mktime(0, 0, 0, $month, 10)) . ' ' .$year. '</a></li>';
	$month++;
	$i++;
}
echo '</ul>';

echo $after_widget;