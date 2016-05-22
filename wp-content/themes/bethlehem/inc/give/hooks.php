<?php
/**
 * bethlehem Give hooks
 *
 * @package bethlehem
 */

/**
 * Single Give Form
 */
add_action( 'give_single_form_summary', 				'bethlehem_social_share_icons', 			7 );

/**
 * Filters
 */
add_filter( 'give_default_wrapper_start', 				'bethlehem_give_default_wrapper_start' );
add_filter( 'give_default_wrapper_end', 				'bethlehem_give_default_wrapper_end' );
add_filter( 'give_get_image_size_give_form_thumbnail', 	'bethlehem_give_form_thumbnail_image_size' );
add_filter( 'give_get_image_size_give_form_single',		'bethlehem_give_form_single_image_size');
add_filter( 'single_give_form_large_thumbnail_size',	'bethlehem_form_single_image_size' );
add_filter( 'template_include', 						'bethlehem_give_templates');
add_filter( 'give_default_form_name',					'bethlehem_change_forms_to_causes' );
add_filter( 'give_forms_donation_form_metabox_fields',	'bethlehem_remove_goal_progress_color_meta' );
add_filter( 'give_settings_display',					'bethlehem_enable_give_form_categories' );
add_filter( 'give_goal_output',							'bethlehem_show_goal_progress' );

remove_filter( 'the_title', 							'give_microdata_title', 					10 );
remove_action( 'give_pre_form', 						'give_test_mode_frontend_warning', 			10 );
remove_action( 'give_pre_form',							'give_show_goal_progress',					10, 2 );
add_action( 'give_after_donation_levels',				'give_show_goal_progress',					10, 2 );

/**
 * Give Form Input Changes
 * @see  bethlehem_give_checkout_final_total()
 */
remove_action( 'give_purchase_form_before_submit', 		'give_checkout_final_total', 				999 );
remove_action( 'give_checkout_form_top',				'give_output_donation_amount_top',			10, 2 );

add_action( 'give_purchase_form_before_submit', 		'bethlehem_give_checkout_final_total', 		999 );
add_action( 'give_checkout_form_top', 					'bethlehem_output_donation_levels' );
// Validate form amount field
add_action( 'give_checkout_error_checks', 				'bethlehem_give_form_validate_custom_fields', 10, 2 );

/**
 * Give Loop post content
 * @see  give_show_form_images()
 * @see  give_loop_content_info_wrapper_start()
 * @see  give_archive_post_title()
 * @see  give_post_excerpt()
 * @see  give_donate_btn()
 * @see  give_loop_content_info_wrapper_end()
 */
add_action( 'give_archive_loop_content', 				'give_loop_form_thumbnail', 				10 );
add_action( 'give_archive_loop_content', 				'give_loop_content_info_wrapper_start', 	20 );
add_action( 'give_archive_loop_content', 				'give_archive_post_title', 					30 );
add_action( 'give_archive_loop_content', 				'give_post_excerpt', 						40 );
add_action( 'give_archive_loop_content', 				'bethlehem_show_goal_progress', 			50 );
add_action( 'give_archive_loop_content', 				'give_donate_btn', 							70 );
add_action( 'give_archive_loop_content', 				'give_loop_content_info_wrapper_end', 		90 );

add_action( 'give_after_loop_content', 					'bethlehem_paging_nav', 					10 );

/**
 * Give sidebar
 * @see  bethlehem_give_get_sidebar()
 */
add_action( 'give_sidebar', 							'bethlehem_give_get_sidebar' );
