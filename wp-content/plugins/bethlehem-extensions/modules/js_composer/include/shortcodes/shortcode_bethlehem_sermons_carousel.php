<?php
if ( !function_exists( 'shortcode_vc_sermons_carousel' ) ):

function shortcode_vc_sermons_carousel( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title'				=> '',
		'limit' 			=> '',
		'archive_link_text'	=> '',
		'type'				=> '',
		'bg_img'			=> '',
		'orderby'			=> '',
		'order'				=> '',
		'category'			=> '',
		'el_class'			=> '',
    ), $atts));

    if( empty( $type ) ) {
    	$type = 'type-1';
    }

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
    	'title'					=> $title,
    	'limit'					=> $limit,
    	'archive_link_text'		=> $archive_link_text,
    	'type'					=> $type,
    	'bg_img'				=> $bg_img,
		'orderby'				=> $orderby,
		'order'					=> $order,
		'category'				=> $category,
		'el_class'				=> $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_sermons_carousel' ) ) {
        $html = shortcode_bethlehem_sermons_carousel( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_sermons_carousel' , 'shortcode_vc_sermons_carousel' );

endif;