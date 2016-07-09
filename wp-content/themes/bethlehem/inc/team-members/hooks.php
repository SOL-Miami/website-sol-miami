<?php
/**
 * bethlehem Our Team hooks
 *
 * @package bethlehem
 */

/**
 * Filters
 */
add_filter( 'woothemes_our_team_member_fields',		'bethlehem_add_team_member_fields');
add_filter( 'woothemes_our_team_post_type_args',	'bethlehem_add_team_member_excerpt_support');
add_filter( 'template_include',						'bethlehem_team_member_templates');

remove_filter( 'the_content', 'woothemes_our_team_content' );

/**
 * Archive Team Member
 */
add_action( 'team_members_before_loop_content',		'our_team_archive_post_thumbnail',		10 );

add_action( 'team_members_loop_content',			'our_team_archive_post_title',			10 );
add_action( 'team_members_loop_content',			'our_team_member_read_more',			20 );
add_action( 'team_members_loop_content',			'our_team_member_archive_social_links',	30 );

add_action( 'team_members_after_loop', 				'bethlehem_paging_nav',					95 );

/**
 * Single Team Member
 */
add_action( 'team_members_single_post_thumbnail',	'our_team_single_post_thumbnail',		10 );
add_action( 'team_members_single_post_thumbnail',	'our_team_member_single_social_links',	20 );

add_action( 'team_members_single_content',			'our_team_single_post_title',			10 );
add_action( 'team_members_single_content',			'our_team_member_role',					20 );
add_action( 'team_members_single_content',			'our_team_post_content',				30 );

