<?php
if ( !function_exists( 'shortcode_vc_events_list_widget' ) ):

function shortcode_vc_events_list_widget( $atts, $content = null ){

	extract(shortcode_atts(array(
        'title'              => '',
        'limit'              => '',
        'categories'         => '',
        'no_upcoming_events' => '',
        'el_class'           => '',
    ), $atts));

    $args = array(
        'title'                 => $title,
        'limit'                 => $limit,
        'categories'            => $categories,
        'no_upcoming_events'    => $no_upcoming_events,
        'el_class'              => $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_events_list_widget' ) ) {
        $html = shortcode_bethlehem_events_list_widget( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_events_list_widget' , 'shortcode_vc_events_list_widget' );

endif;