<?php
if ( !function_exists( 'shortcode_vc_images_carousel' ) ):

function shortcode_vc_images_carousel( $atts, $content = null ){

	extract(   shortcode_atts( array(
		'title'           => '',
        'pre_title'       => '',
		'carousel_images' => '',
        'link_button'     => '',
		'el_class'        => '',
    ), $atts ) );

    $link = array();
    $params_pairs = explode( '|', $link_button );
    if ( ! empty( $params_pairs ) ) {
        foreach ( $params_pairs as $pair ) {
            $param = preg_split( '/\:/', $pair );
            if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
                $link[ $param[0] ] = rawurldecode( $param[1] );
            }
        }
    }

    $image_ids = explode( ",", $carousel_images );

    $args = array(
    	'title'					=> $title,
    	'pre_title'				=> $pre_title,
        'link'                  => $link,
		'el_class'				=> $el_class,
        'image_ids'             => $image_ids
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_images_carousel' ) ) {
        $html = shortcode_bethlehem_images_carousel( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_images_carousel' , 'shortcode_vc_images_carousel' );

endif;