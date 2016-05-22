<?php
/**
 * Bethlehem Layout functions
 *
 * @package bethlehem
 */

if( ! function_exists( 'bethlehem_get_layout_args' ) ) {
	/**
	 * Gets all arguments for a given page
	 * @since 1.0.0
	 * @return array of arguments
	 */
	function bethlehem_get_layout_args() {
		
		$layout_args = array();

		$give_taxonomies = get_object_taxonomies( 'give_forms' );

		if ( is_front_page() && is_home() ) {
		  // Default homepage
		} elseif ( is_front_page() ) {
		  // static homepage
		} elseif ( is_woocommerce() ) {
  			$page_title = __( 'Shop', 'bethlehem' );
		} elseif( is_post_type_archive( 'ministries' ) || is_singular( 'ministries' ) || is_tax( get_object_taxonomies( 'ministries' ) ) ) {
  			$page_title = __( 'Ministries', 'bethlehem' );
  		} elseif( is_post_type_archive( 'sermons' ) || is_singular( 'sermons' ) || is_tax( get_object_taxonomies( 'sermons' ) ) ) {
  			$page_title = __( 'Sermons', 'bethlehem' );
  		} elseif( is_post_type_archive( 'give_forms' ) || is_singular( 'give_forms' ) || ( !empty( $give_taxonomies ) && is_tax( $give_taxonomies ) ) ) {
  			$page_title = __( 'Causes', 'bethlehem' );
  		} elseif( is_post_type_archive( 'stories' ) || is_singular( 'stories' ) || is_tax( get_object_taxonomies( 'stories' ) ) ) {
  			$page_title = __( 'Stories', 'bethlehem' );
  		} elseif( is_post_type_archive( 'team-member' ) || is_singular( 'team-member' ) || is_tax( get_object_taxonomies( 'team-member' ) ) ) {
  			$page_title = __( 'Peoples', 'bethlehem' );
  		} elseif( tribe_is_event() || tribe_is_event_category() || tribe_is_view() || is_singular( 'tribe_events' ) ) {
  			$page_title = __( 'Events', 'bethlehem' );
  		} elseif ( is_page() ) {
	  		$page_title = '';
  		} elseif ( is_home() ) {
	  		$page_title = __( 'Blog', 'bethlehem' );
  		} elseif ( is_category() ) {
	  		$page_title = __( 'Blog', 'bethlehem' );
  		} elseif ( is_singular() ) {
	  		$page_title = __( 'Blog', 'bethlehem' );
  		}

		return apply_filters( 'bethlehem_layout_args', $layout_args );
	}
}