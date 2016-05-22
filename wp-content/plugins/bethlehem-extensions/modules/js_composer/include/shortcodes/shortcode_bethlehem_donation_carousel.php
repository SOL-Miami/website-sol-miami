<?php
if ( !function_exists( 'shortcode_vc_donation_carousel' ) ):

function shortcode_vc_donation_carousel( $atts, $content = null ){

	extract(shortcode_atts(array(
		'limit' => '',
		'orderby' => '',
		'order' => '',
		'bg_img' => '',
		'el_class' => '',
    ), $atts));

    if( empty( $orderby ) ) {
    	$orderby = 'none';
    }

    if( empty( $order ) ) {
    	$order = 'ASC';
    }

    $args = array(
    	'limit'		=> $limit,
    	'orderby'	=> $orderby,
    	'order'		=> $order,
		'bg_img'	=> $bg_img,
		'el_class'	=> $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_donation_carousel' ) ) {
        $html = shortcode_bethlehem_donation_carousel( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_donation_carousel' , 'shortcode_vc_donation_carousel' );

endif;