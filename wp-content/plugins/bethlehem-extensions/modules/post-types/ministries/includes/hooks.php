<?php
/**
 * The hooks for ministries.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Archive Page
 */
add_action( 'ministries_before_archive_content','ministries_head',					10 );
add_action( 'ministries_before_archive_content','ministries_tab_pane_wrapper_start',20 );
add_action( 'ministries_archive_content',	 	'ministries_grid_content',			10 );
add_action( 'ministries_archive_content',	 	'ministries_list_content',			20 );
add_action( 'ministries_after_archive_content',	'ministries_div_wrapper_end',		10 );
add_action( 'ministries_after_archive_content',	'bethlehem_paging_nav',				10 );

add_action( 'ministries_before_grid_loop', 		'ministries_grid_tab_wrapper_start',10 );
add_action( 'ministries_grid_loop_content', 	'ministries_loop_thumbnail',		10 );
add_action( 'ministries_grid_loop_content', 	'ministries_archive_post_title',	20 );
add_action( 'ministries_after_grid_loop', 		'ministries_div_wrapper_end',		10 );

add_action( 'ministries_before_list_loop', 		'ministries_list_tab_wrapper_start',10 );
add_action( 'ministries_list_loop_content', 	'ministries_loop_thumbnail',		10 );
add_action( 'ministries_list_loop_content', 	'ministries_content_wrapper_start',	20 );
add_action( 'ministries_list_loop_content', 	'ministries_archive_post_title',	30 );
add_action( 'ministries_list_loop_content', 	'bethlehem_social_share_icons',		40 );
add_action( 'ministries_list_loop_content', 	'ministries_post_excerpt',			50 );
add_action( 'ministries_list_loop_content', 	'ministries_div_wrapper_end',		60 );
add_action( 'ministries_after_list_loop', 		'ministries_div_wrapper_end',		10 );

/**
 * Single Page
 */
add_action( 'ministries_main_content', 			'ministries_single_thumbnail',			10 );
add_action( 'ministries_main_content', 			'ministries_single_post_title',			20 );
add_action( 'ministries_main_content', 			'bethlehem_social_share_icons',			30 );
add_action( 'ministries_main_content', 			'ministries_post_content',				40 );

/**
 * Sidebar
 */
add_action( 'ministries_sidebar', 				'ministries_sidebar',		10 );