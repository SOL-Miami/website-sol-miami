<?php
if ( !function_exists( 'shortcode_vc_stories_carousel' ) ):

function shortcode_vc_stories_carousel( $atts, $content = null ){

	extract(shortcode_atts(array(
		'limit' => '',
		'orderby' => '',
		'order' => '',
		'archive_link_text' => '',
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
    	'limit'					=> $limit,
    	'orderby'				=> $orderby,
		'order'					=> $order,
    	'archive_link_text'		=> $archive_link_text,   	
    	'bg_img'				=> $bg_img,
		'el_class'				=> $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_stories_carousel' ) ) {
        $html = shortcode_bethlehem_stories_carousel( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_stories_carousel' , 'shortcode_vc_stories_carousel' );

endif;