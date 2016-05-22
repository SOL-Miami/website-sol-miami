<?php
if ( !function_exists( 'shortcode_vc_testimonials_carousel' ) ):

function shortcode_vc_testimonials_carousel( $atts, $content = null ){

	extract(shortcode_atts(array(
		'limit' => '',
		'orderby' => '',
		'order' => '',
		'category' => '',
		'el_class' => '',
    ), $atts));

    if( empty( $orderby ) ) {
    	$orderby = 'none';
    }

    if( empty( $order ) ) {
    	$order = 'ASC';
    }

    if( empty($category) ) {
    	$category = 0;
    }

    $args = array(
    	'limit'					=> $limit,
    	'orderby'				=> $orderby,
		'order'					=> $order, 	
    	'category'				=> $category,
		'el_class'				=> $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_testimonials_carousel' ) ) {
        $html = shortcode_bethlehem_testimonials_carousel( $args );
    }

    return $html;

}

add_shortcode( 'bethlehem_testimonials' , 'shortcode_vc_testimonials_carousel' );

endif;