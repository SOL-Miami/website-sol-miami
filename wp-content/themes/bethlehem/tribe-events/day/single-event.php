<?php
/**
 * Day View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

$venue_details = array();

if ( $venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
	$venue_details[] = $venue_name;
}

if ( $venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
	$venue_details[] = $venue_address;
}
// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( $venue_address ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

$event_id = get_the_ID();

$eventurl = tribe_get_event_website_url();

?>

<!-- Event Date -->
<div class="tribe-events-date">
	<?php echo tribe_get_start_date( $event_id, false, 'd' ); ?>
	<span><?php echo tribe_get_start_date( $event_id, false, 'M' ); ?></span>
</div>

<div class="tribe-events-content">
	<!-- Event Categories -->
	<?php echo get_the_term_list( $event_id, 'tribe_events_cat','',',',''); ?>

	<!-- Event Title -->
	<?php do_action( 'tribe_events_before_the_event_title' ) ?>
	<h2 class="tribe-events-list-event-title entry-title summary">
		<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
			<?php the_title() ?>
		</a>
	</h2>
	<?php do_action( 'tribe_events_after_the_event_title' ) ?>

	<!-- Event Meta -->
	<?php do_action( 'tribe_events_before_the_meta' ) ?>
	<div class="tribe-events-event-meta vcard">
		<div class="author <?php echo esc_attr( $has_venue_address ); ?>">

			<!-- Schedule & Recurrence Details -->
			<div class="updated published time-details">
				<?php echo tribe_get_start_time( $event_id ); ?>
			</div>

			<?php if ( $venue_details ) : ?>
				<!-- Venue Display Info -->
				<div class="tribe-events-venue-details">
					<?php echo tribe_get_meta( 'tribe_event_venue_name' ); ?>
				</div> <!-- .tribe-events-venue-details -->
			<?php endif; ?>

		</div>
	</div><!-- .tribe-events-event-meta -->
	<?php do_action( 'tribe_events_after_the_meta' ) ?>
</div>
