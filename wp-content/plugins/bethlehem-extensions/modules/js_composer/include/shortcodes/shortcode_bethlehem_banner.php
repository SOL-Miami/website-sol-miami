<?php

if ( !function_exists( 'shortcode_vc_banner' ) ):

function shortcode_vc_banner( $atts, $content = null ){

	extract(shortcode_atts(array(
		'banner_image'           => '',
		'bg_color'				 => '',
		'type'					 => '',
		'title'                  => '',
		'subtitle'               => '',
		'el_class'               => ''
    ), $atts));

    if( empty( $type ) ) {
    	$type = 'type-1';
    }

    $element = 'bethlehem_banner';

    $css_class = esc_attr( trim( $element . ' banner ' . $el_class ) );

	$style = '';

    if ( !empty($banner_image) ) {
		$img_src_arr = wp_get_attachment_image_src( $banner_image, 'full', false );
		$img_src = $img_src_arr[0];
		$background_style = 'background:rgba(0, 0, 0, 0) url(' . esc_url( $img_src ) . ') no-repeat fixed center center; background-size: cover;';
		$style = ' style="' . esc_attr( $background_style ) . '"';
	} elseif( !empty( $bg_color ) ) {
		$background_color = 'background-color: ' . esc_attr( $bg_color ) . ';';
		$style = ' style="' . esc_attr( $background_color ) . '"';
	}

	$banner = '';
	$banner .= "\n\t" . '<div class="' . $css_class . '"'.$style.'>';

	if( $type == 'type-1' ) {
		if( !empty( $title ) || !empty( $subtitle ) ) :
			$banner .= "\n\t\t\t" . '<div class="banner-text">';

				if ( !empty( $title ) ){
					$banner .= "\n\t\t\t\t" . '<h3 class="banner-title">' . $title . '</h3>';
				}
				if ( !empty( $subtitle ) ){
					$banner .= "\n\t\t\t\t" . '<span class="tagline">' . $subtitle . '</span>';
				}

			$banner .= "\n\t\t\t" . '</div>';
		endif;
	} else {
		if( !empty( $content ) ) :
			$banner .= '<div class="widget_text"><div class="textwidget">' . wpb_js_remove_wpautop( $content, true ) . '</div></div>';
		endif;
	}

	$banner .= "\n\t" . '</div>';

	return $banner;
}

add_shortcode( 'bethlehem_banner' , 'shortcode_vc_banner' );
endif;
