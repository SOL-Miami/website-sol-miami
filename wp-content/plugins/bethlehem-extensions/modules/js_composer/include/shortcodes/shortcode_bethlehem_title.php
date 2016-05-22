<?php
if ( !function_exists( 'shortcode_bethlehem_title' ) ):

function shortcode_bethlehem_title( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title' => '',
		'is_title_link' => '',
		'title_link' => '',
		'desc' => '',
		'desc_class' => '',
		'text_position' => '',
		'heading_size' => '',
		'el_class' => '',
    ), $atts));

    if( empty( $text_position ) ) {
    	$text_position = 'text-left';
    }

    if( empty( $heading_size ) ) {
    	$heading_size = 'h1';
    }

    $css_class = trim( 'vc-title ' . $text_position . ' ' . $el_class );

	$output = '';
	$output .= "\n\t" . '<div class="' . esc_attr( $css_class ) . '">';
	
	if( $is_title_link == true ) {
		$output .= "\n\t\t" . '<' . ( !empty( $heading_size ) ? $heading_size : 'h1') . '><a href="' .esc_url( $title_link ). '">'.$title.'</a></' . ( !empty( $heading_size ) ? $heading_size : 'h1') . '>';
	} else {
		$output .= "\n\t\t" . '<' . ( !empty( $heading_size ) ? $heading_size : 'h1') . '>'.$title.'</' . ( !empty( $heading_size ) ? $heading_size : 'h1') . '>';
	}
	
	if( !empty($desc) ) {
		if( !empty($desc_class) ) {
			$output .= "\n\t\t" . '<p class="' . esc_attr( $desc_class ) . '"">'.$desc.'</p>';
		} else {
			$output .= "\n\t\t" . '<p>'.$desc.'</p>';
		}
	}
	
	$output .= "\n\t" . '</div>';

	return $output;
}

add_shortcode( 'bethlehem_title' , 'shortcode_bethlehem_title' );

endif;