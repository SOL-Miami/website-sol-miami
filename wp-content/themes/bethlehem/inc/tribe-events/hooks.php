<?php
/**
 * Bethlehem Events hooks
 *
 * @package bethlehem
 */

/**
 * Post Types Override
 * @see  bethlehem_events_post_type_args()
 */
add_filter( 'tribe_events_register_venue_type_args', 			'bethlehem_events_post_type_args',		10 );

/**
 * Layouts
 */
add_filter( 'tribe_events_view_before_html_data_wrapper',		'bethlehem_events_wrapper_before', 		10 );
add_filter( 'tribe_events_view_after_html_data_wrapper',		'bethlehem_events_wrapper_after',		10 );
add_filter( 'tribe_events_view_after_html_data_wrapper', 		'bethlehem_events_sidebar',				20 );

/**
 * Events Month
 * @see  bethlehem_get_events_title()
 * @see  bethlehem_get_events_month_prev_link()
 * @see  bethlehem_get_events_month_next_link()
 */
add_filter( 'tribe_events_title', 								'bethlehem_get_events_title', 			10, 1 );
add_filter( 'tribe_events_the_previous_month_link', 			'bethlehem_get_events_month_prev_link',	10, 1 );
add_filter( 'tribe_events_the_next_month_link', 				'bethlehem_get_events_month_next_link',	10, 1 );

/**
 * Events List
 */
add_filter( 'tribe_events_list_show_date_headers', 				'__return_false' );
add_action( 'tribe_events_after_the_meta', 						'bethlehem_events_social_share_icons',	10 );

/**
 * Events Pagination
 * @see  bethlehem_paging_nav()
 */
add_filter( 'bethlehem_events_nav', 							'bethlehem_paging_nav',					10 );

/**
 * Events Single Page
 */
add_action( 'tribe_events_single_event_before_the_meta', 		'bethlehem_events_social_share_icons', 	10 );

/**
 * Events List Widget
 */
add_action( 'tribe_events_list_widget_before_the_event_title',	'bethlehem_events_widget_date_meta',	10 );
add_action( 'tribe_events_list_widget_before_the_event_title',	'bethlehem_get_event_categories',		20 );
add_action( 'tribe_events_list_widget_meta',					'bethlehem_events_widget_meta', 		10 );
add_action( 'tribe_events_list_widget_after_the_meta',			'bethlehem_events_social_share_icons', 	10 );
add_action( 'tribe_events_list_widget_after',					'bethlehem_get_events_link', 			10 );