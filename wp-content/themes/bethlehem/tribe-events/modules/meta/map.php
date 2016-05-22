<?php
/**
 * Single Event Meta (Map) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/map.php
 *
 * @package TribeEventsCalendar
 */

$map = apply_filters( 'tribe_event_meta_venue_map', tribe_get_embedded_map() );
if ( empty( $map ) ) {
	return;
}
// Do we have a Google Map link to display?
$gmap_link = tribe_show_google_map_link() ? tribe_get_map_link() : '';
$gmap_link = apply_filters( 'tribe_event_meta_venue_address_gmap', $gmap_link );
?>

<div class="tribe-events-venue-map">
	<?php
	do_action( 'tribe_events_single_meta_map_section_start' );
	echo $map;
	echo sprintf('<a href="%s">%s</a>',$gmap_link, __('View Full Map', 'bethlehem'));
	do_action( 'tribe_events_single_meta_map_section_end' );
	?>
</div>