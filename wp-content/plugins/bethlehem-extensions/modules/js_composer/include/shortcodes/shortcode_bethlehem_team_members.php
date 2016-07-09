<?php
if ( !function_exists( 'shortcode_vc_team_members' ) ):

function shortcode_vc_team_members( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title' => '',
		'type' => '',
		'limit' => '',
		'orderby' => '',
		'order' => '',
		'category' => '',
        'columns' => '',
		'el_class' => '',
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

    if( $type == 'large' ) {
        $title = '';
    }

    if( ! empty( $columns ) ) {
        $el_class = $columns . ' ' . $el_class;
    }

    $args = array(
    	'title' 				=> $title,
    	'type' 					=> $type,
    	'limit'					=> $limit,
    	'orderby'				=> $orderby,
		'order'					=> $order, 	
    	'category'				=> $category,
		'el_class'				=> $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_team_members' ) ) {
        $html = shortcode_bethlehem_team_members( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_team_members' , 'shortcode_vc_team_members' );

endif;