<?php
if ( !function_exists( 'shortcode_vc_events_venue_locations' ) ):

function shortcode_vc_events_venue_locations( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title'				 => '',
		'limit'				 => '',
		'service_time'		 => '',
		'no_upcoming_events' => '',
		'el_class'			 => '',
    ), $atts));

    $args = array(
    	'title'					=> $title,
    	'limit'					=> $limit,
    	'service_time'		 	=> $service_time,
    	'no_upcoming_events'	=> $no_upcoming_events,
		'el_class'				=> $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_events_venue_locations' ) ) {
        $html = shortcode_bethlehem_events_venue_locations( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_events_venue_locations' , 'shortcode_vc_events_venue_locations' );

endif;