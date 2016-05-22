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
add_action( 'stories_archive_loop_content', 	'stories_archive_post_title',		10 );
add_action( 'stories_archive_loop_content', 	'stories_loop_thumbnail',			20 );
add_action( 'stories_archive_loop_content', 	'stories_post_excerpt',				30 );
add_action( 'stories_archive_loop_content', 	'bethlehem_social_share_icons',		40 );

add_action( 'stories_before_loop_content', 		'stories_featured_post',			10 );
add_action( 'stories_before_loop_content', 		'bethlehem_set_query',				20 );
add_action( 'stories_after_loop_content', 		'bethlehem_reset_query',			10 );

add_action( 'stories_after_archive_content', 	'bethlehem_paging_nav',				95 );

add_action( 'stories_featured_loop_content', 	'stories_featured_thumbnail',		10 );
add_action( 'stories_featured_loop_content', 	'stories_content_wrapper_start',	20 );
add_action( 'stories_featured_loop_content', 	'stories_archive_post_title',		30 );
add_action( 'stories_featured_loop_content', 	'stories_post_excerpt',				40 );
add_action( 'stories_featured_loop_content', 	'bethlehem_social_share_icons',		50 );
add_action( 'stories_featured_loop_content', 	'stories_wrapper_end',				60 );

/**
 * Single Page
 */
add_action( 'stories_single_post_before', 		'stories_single_thumbnail',			10 );
add_action( 'stories_single_post_content', 		'stories_single_post_title',		10 );
add_action( 'stories_single_post_content', 		'bethlehem_social_share_icons',		20 );
add_action( 'stories_single_post_content', 		'stories_post_content',				30 );