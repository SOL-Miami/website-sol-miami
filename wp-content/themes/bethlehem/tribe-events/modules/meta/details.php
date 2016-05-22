<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */
?>

<div class="tribe-events-meta-group tribe-events-meta-group-details">
	<h3 class="tribe-events-single-section-title"> <?php _e( 'Details', 'bethlehem' ) ?> </h3>
	<dl>

		<?php
		do_action( 'tribe_events_single_meta_details_section_start' );

		if( Tribe__Events__Main::VERSION >= '4.0' ) {
			$date_utils_class = 'Tribe__Date_Utils';
		} else {
			$date_utils_class = 'Tribe__Events__Date_Utils';
		}

		$time_format = get_option( 'time_format', $date_utils_class::TIMEFORMAT );
		$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

		$start_datetime = tribe_get_start_date();
		$start_date = tribe_get_start_date( null, false );
		$start_time = tribe_get_start_date( null, false, $time_format );
		$start_ts = tribe_get_start_date( null, false, $date_utils_class::DBDATEFORMAT );

		$end_datetime = tribe_get_end_date();
		$end_date = tribe_get_end_date( null, false );
		$end_time = tribe_get_end_date( null, false, $time_format );
		$end_ts = tribe_get_end_date( null, false, $date_utils_class::DBDATEFORMAT );

		// All day (multiday) events
		if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
			?>

			<dt> <?php _e( 'Start:', 'bethlehem' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $start_ts ) ?>"> <?php echo esc_html( $start_date ) ?> </abbr>
			</dd>

			<dt> <?php _e( 'End:', 'bethlehem' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr dtend" title="<?php echo esc_attr( $end_ts ) ?>"> <?php echo esc_html( $end_date ) ?> </abbr>
			</dd>

		<?php
		// All day (single day) events
		elseif ( tribe_event_is_all_day() ):
			?>

			<dt> <?php _e( 'Date:', 'bethlehem' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $start_ts ) ?>"> <?php echo esc_html( $start_date ) ?> </abbr>
			</dd>

		<?php
		// Multiday events
		elseif ( tribe_event_is_multiday() ) :
			?>

			<dt> <?php _e( 'Start:', 'bethlehem' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $start_ts ) ?>"> <?php echo esc_html( $start_datetime ) ?> </abbr>
			</dd>

			<dt> <?php _e( 'End:', 'bethlehem' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr dtend" title="<?php echo esc_attr( $end_ts ) ?>"> <?php echo esc_html( $end_datetime ) ?> </abbr>
			</dd>

		<?php
		// Single day events
		else :
			?>

			<dt> <?php _e( 'Date:', 'bethlehem' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $start_ts ) ?>"> <?php echo esc_html( $start_date ) ?> </abbr>
			</dd>

			<dt> <?php _e( 'Time:', 'bethlehem' ) ?> </dt>
			<dd><abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $end_ts ) ?>">
					<?php if ( $start_time == $end_time ) {
						echo esc_html( $start_time );
					} else {
						echo esc_html( $start_time . $time_range_separator . $end_time );
					} ?>
				</abbr></dd>

		<?php endif ?>

		<?php
		$cost = tribe_get_formatted_cost();
		if ( ! empty( $cost ) ):
			?>
			<dt> <?php _e( 'Cost:', 'bethlehem' ) ?> </dt>
			<dd class="tribe-events-event-cost"> <?php echo esc_html( tribe_get_formatted_cost() ) ?> </dd>
		<?php endif ?>

		<?php
		$website = tribe_get_event_website_link();
		if ( ! empty( $website ) ):
			?>
			<dt> <?php _e( 'Website:', 'bethlehem' ) ?> </dt>
			<dd class="tribe-events-event-url"> <?php echo $website ?> </dd>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>
	</dl>
</div>