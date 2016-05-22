<?php
if ( !function_exists( 'shortcode_vc_events_calendar' ) ):

function shortcode_vc_events_calendar( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title'				 => '',
		'limit'				 => '',
		'no_upcoming_events' => '',
		'el_class'			 => '',
    ), $atts));

    $args = array(
    	'title'					=> $title,
    	'limit'					=> $limit,
    	'no_upcoming_events'	=> $no_upcoming_events,
		'el_class'				=> $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_events_calendar' ) ) {
        $html = shortcode_bethlehem_events_calendar( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_events_calendar' , 'shortcode_vc_events_calendar' );

endif;