<?php

if( ! function_exists( 'bethlehem_home_page_slider' ) ) {
	function bethlehem_home_page_slider() {
		if( apply_filters( 'bethlehem_enable_home_page_slider', TRUE ) ) {
			$home_page_slider_alias = get_home_page_slider_alias();
			
			echo '<div class="home-page-slider">';
			putRevSlider( $home_page_slider_alias );
			echo '</div>';
		}
	}
}

if( ! function_exists( 'bethlehem_header_wrap_start' ) ) {
	function bethlehem_header_wrap_start() {
		echo '<div class="header-wrap">' ;
	}
}

if( ! function_exists( 'bethlehem_header_wrap_end' ) ) {
	function bethlehem_header_wrap_end() {
		echo '</div><!-- /.header-wrap -->';
	}
}

if( ! function_exists( 'get_home_page_slider_alias' ) ) {
	function get_home_page_slider_alias() {
		return apply_filters( 'bethlehem_get_home_page_slider', 'home-page-slider' );
	}
}