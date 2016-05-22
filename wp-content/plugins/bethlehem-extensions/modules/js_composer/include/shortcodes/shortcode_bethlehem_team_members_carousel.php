<?php
if ( !function_exists( 'shortcode_vc_team_members_carousel' ) ):

function shortcode_vc_team_members_carousel( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title'             => '',
        'pre_title'         => '',
        'limit'             => '',
        'orderby'           => '',
        'order'             => '',
        'category'          => '',
        'el_class'          => '',
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
    	'title' 				=> $title,
    	'pre_title' 			=> $pre_title,
    	'limit'					=> $limit,
    	'orderby'				=> $orderby,
		'order'					=> $order, 	
    	'category'				=> $category,
		'el_class'				=> $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_our_team_carousel' ) ) {
        $html = shortcode_bethlehem_our_team_carousel( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_team_members_carousel' , 'shortcode_vc_team_members_carousel' );

endif;