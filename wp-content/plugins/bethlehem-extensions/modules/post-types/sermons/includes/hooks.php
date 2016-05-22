<?php
/**
 * The hooks for sermons.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Archive Page
 */
add_action( 'sermons_archive_loop_content', 	'sermons_loop_thumbnail',				10 );
add_action( 'sermons_archive_loop_content', 	'sermons_content_wrapper_start',		20 );
add_action( 'sermons_archive_loop_content', 	'sermons_content_body_wrapper_start',	30 );
add_action( 'sermons_archive_loop_content', 	'sermons_archive_post_title',			40 );
add_action( 'sermons_archive_loop_content', 	'sermons_meta_info',					50 );
add_action( 'sermons_archive_loop_content', 	'bethlehem_social_share_icons',			60 );
add_action( 'sermons_archive_loop_content', 	'sermons_div_wrapper_end',				70 );
add_action( 'sermons_archive_loop_content', 	'sermons_post_format_icons',			80 );
add_action( 'sermons_archive_loop_content', 	'sermons_div_wrapper_end',				90 );

add_action( 'sermons_after_loop_content', 		'bethlehem_paging_nav',					95 );

/**
 * Single Page
 */
add_action( 'sermons_single_post_before', 		'sermons_single_thumbnail',				10 );
add_action( 'sermons_single_post_content', 		'sermons_content_body_wrapper_start',	10 );
add_action( 'sermons_single_post_content', 		'sermons_single_post_title',			20 );
add_action( 'sermons_single_post_content', 		'sermons_meta_info',					30 );
add_action( 'sermons_single_post_content', 		'bethlehem_social_share_icons',			40 );
add_action( 'sermons_single_post_content', 		'sermons_div_wrapper_end',				50 );
add_action( 'sermons_single_post_content', 		'sermons_post_format_icons',			60 );
add_action( 'sermons_single_post_content', 		'sermons_post_content',					70 );

add_action( 'sermons_single_post_after', 		'bethlehem_display_speaker_info',		10 );

add_action( 'sermons_after_main_content', 		'bethlehem_display_comments',			20 );
add_action( 'sermons_after_main_content', 		'bethlehem_related_sermons',			30 );

/**
 * Sidebar
 */
add_action( 'sermons_sidebar', 					'sermons_sidebar',						10 );

add_action( 'wp_footer', 						'sermons_post_media_modal_content',		10 );
