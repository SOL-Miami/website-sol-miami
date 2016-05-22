<?php
if ( !function_exists( 'shortcode_vc_recent_posts_widget' ) ):

function shortcode_vc_recent_posts_widget( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title'				 => '',
        'pre_title'          => '',
		'type'				 => '',
		'limit'				 => '',
		'el_class'			 => '',
    ), $atts));

    if( empty( $type ) ) {
        $type = 'type-1';
    }

    $args = array(
    	'title'					=> $title,
    	'type'					=> $type,
        'pre_title'             => $pre_title,
    	'limit'					=> $limit,
		'el_class'				=> $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_recent_posts_widget' ) ) {
        $html = shortcode_bethlehem_recent_posts_widget( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_recent_posts_widget' , 'shortcode_vc_recent_posts_widget' );

endif;