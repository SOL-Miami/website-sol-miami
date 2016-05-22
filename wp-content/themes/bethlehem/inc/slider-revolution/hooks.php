<?php

function add_slider_rev_action_on_home_page() {

	$home_page_slider_alias = get_home_page_slider_alias();

	if( is_page_template( array( 'template-homepage.php', 'template-homepage-v2.php' ) ) || is_front_page() && checkRevSliderExists( $home_page_slider_alias ) ) {
		$header = bethlehem_get_header();

		if( $header == 'header-6' ) {
			add_action( 'bethlehem_before_header',		'bethlehem_home_page_slider',	10 );
		} else {
			add_action( 'bethlehem_before_content',		'bethlehem_home_page_slider',	20 );
		}
		
		add_action( 'bethlehem_before_header',		'bethlehem_header_wrap_start',	20 );

		add_action( 'bethlehem_before_content',		'bethlehem_header_wrap_end',	1 );
	}

}

add_action( 'wp_head',		'add_slider_rev_action_on_home_page' );

set_revslider_as_theme();