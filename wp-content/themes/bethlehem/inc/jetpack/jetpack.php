<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package bethlehem
 */

if( ! function_exists( 'bethlehem_jetpack_setup' ) ) {
	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	function bethlehem_jetpack_setup() {
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'footer'    => 'page',
		) );
	}
}

add_action( 'after_setup_theme', 'bethlehem_jetpack_setup' );
