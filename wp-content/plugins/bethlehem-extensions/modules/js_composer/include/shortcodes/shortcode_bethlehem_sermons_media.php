<?php
if ( !function_exists( 'shortcode_vc_sermons_media' ) ):

function shortcode_vc_sermons_media( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title'				 => '',
		'pre_title'			 => '',
		'embeded_content'	 => '',
		'link_button'		 => '',
		'el_class'			 => '',
    ), $atts));

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

    $embeded_content = preg_match( '/^#E\-8_/', $embeded_content ) ? rawurldecode( base64_decode( preg_replace( '/^#E\-8_/', '', $embeded_content ) ) ) : $embeded_content;

    $content = '';
    if ( preg_match( '/^\<iframe/', $embeded_content ) ) {
        $content = $embeded_content;
    } else {
        $content = '<iframe width="560" height="510" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/111921842&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>';
    }

    $args = array(
    	'title'				 => $title,
		'pre_title'			 => $pre_title,
		'embeded_content'	 => $content,
		'link'				 => $link,
		'el_class'			 => $el_class,
    );

    $html = '';
    if( function_exists( 'shortcode_bethlehem_sermons_media' ) ) {
        $html = shortcode_bethlehem_sermons_media( $args );
    }

    return $html;
}

add_shortcode( 'bethlehem_sermons_media' , 'shortcode_vc_sermons_media' );

endif;