<?php
/**
 * bethlehem hooks
 *
 * @package bethlehem
 */

/**
 * General
 * @see  bethlehem_setup()
 * @see  bethlehem_widgets_init()
 * @see  bethlehem_register_widgets()
 * @see  bethlehem_scripts()
 * @see  bethlehem_header_widget_region()
 * @see  bethlehem_get_sidebar()
 */
add_action( 'after_setup_theme',			'bethlehem_setup' );
add_action( 'after_setup_theme',			'bethlehem_register_image_sizes' );
add_action( 'widgets_init',					'bethlehem_widgets_init' );
add_action( 'widgets_init', 				'bethlehem_register_widgets');
add_action( 'wp_enqueue_scripts',			'bethlehem_scripts',				10 );
add_action( 'bethlehem_sidebar',			'bethlehem_get_sidebar',			10 );
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	add_action( 'wp_head',						'bethlehem_site_favicon',			10 );
}

/**
 * Header
 * @see  bethlehem_get_header_template()
 */
add_action( 'bethlehem_header', 			'bethlehem_get_header_template', 		10 );

// Header 1
add_action( 'bethlehem_header_1',			'bethlehem_skip_links', 				0 );
add_action( 'bethlehem_header_1',			'bethlehem_site_branding', 				10 );
add_action( 'bethlehem_header_1',			'bethlehem_primary_navigation', 		20 );
add_action( 'bethlehem_header_1',			'bethlehem_header_content', 			30 );

// Header 2
add_action( 'bethlehem_header_2',			'bethlehem_skip_links', 				0 );
add_action( 'bethlehem_header_2',			'bethlehem_site_branding', 				10 );
add_action( 'bethlehem_header_2',			'bethlehem_primary_navigation',			20 );
add_action( 'bethlehem_header_2',			'bethlehem_header_content', 			30 );

// Header 3
add_action( 'bethlehem_header_3_top_bar',	'bethlehem_site_branding', 				10 );
add_action( 'bethlehem_header_3_top_bar',	'bethlehem_event_time', 				20 );
add_action( 'bethlehem_header_3_nav_bar',	'bethlehem_skip_links', 				0 );
add_action( 'bethlehem_header_3_nav_bar',	'bethlehem_primary_navigation',			10 );
add_action( 'bethlehem_header_3_nav_bar',	'bethlehem_navigation_links', 			20 );
add_action( 'bethlehem_header_3',			'bethlehem_header_content', 			10 );

// Header 4
add_action( 'bethlehem_header_4_top_bar',	'bethlehem_header_contact_info', 		10 );
add_action( 'bethlehem_header_4_top_bar',	'bethlehem_event_time', 				20 );
add_action( 'bethlehem_header_4_nav_bar',	'bethlehem_skip_links', 				0 );
add_action( 'bethlehem_header_4_nav_bar',	'bethlehem_site_branding', 				10 );
add_action( 'bethlehem_header_4_nav_bar',	'bethlehem_primary_navigation',			20 );
add_action( 'bethlehem_header_4_nav_bar',	'bethlehem_navigation_links', 			30 );
add_action( 'bethlehem_header_4',			'bethlehem_header_content', 			10 );

// Header 5
add_action( 'bethlehem_header_5_top_bar',	'bethlehem_header_contact_info', 		10 );
add_action( 'bethlehem_header_5_top_bar',	'bethlehem_event_time', 				20 );
add_action( 'bethlehem_header_5_nav_bar',	'bethlehem_skip_links', 				0 );
add_action( 'bethlehem_header_5_nav_bar',	'bethlehem_site_branding', 				10 );
add_action( 'bethlehem_header_5_nav_bar',	'bethlehem_primary_navigation',			20 );
add_action( 'bethlehem_header_5_nav_bar',	'bethlehem_navigation_links', 			30 );
add_action( 'bethlehem_header_5',			'bethlehem_header_content', 			10 );

// Header 6
add_action( 'bethlehem_header_6_nav_bar',	'bethlehem_skip_links', 				0 );
add_action( 'bethlehem_header_6_nav_bar',	'bethlehem_site_branding', 				10 );
add_action( 'bethlehem_header_6_nav_bar',	'bethlehem_primary_navigation',			20 );
add_action( 'bethlehem_header_6_nav_bar',	'bethlehem_navigation_links', 			30 );
add_action( 'bethlehem_header_6',			'bethlehem_header_content', 			10 );

// Header 7
add_action( 'bethlehem_header_7_top_bar',	'bethlehem_site_branding', 				10 );
add_action( 'bethlehem_header_7_top_bar',	'bethlehem_navigation_links', 			20 );
add_action( 'bethlehem_header_7_top_bar',	'bethlehem_event_time', 				30 );
add_action( 'bethlehem_header_7_nav_bar',	'bethlehem_skip_links', 				0 );
add_action( 'bethlehem_header_7_nav_bar',	'bethlehem_primary_navigation',			10 );
add_action( 'bethlehem_header_7_nav_bar',	'bethlehem_search_widget', 				20 );
add_action( 'bethlehem_header_7',			'bethlehem_header_content', 			10 );

// Header 8
add_action( 'bethlehem_header_8',			'bethlehem_skip_links', 				0 );
add_action( 'bethlehem_header_8',			'bethlehem_site_branding', 				10 );
add_action( 'bethlehem_header_8',			'bethlehem_primary_navigation',			20 );
add_action( 'bethlehem_header_8',			'bethlehem_header_content', 			30 );

/**
 * Footer
 * @see  bethlehem_footer_widgets()
 * @see  bethlehem_credit()
 */

add_action( 'bethlehem_footer', 			'bethlehem_get_footer_template',	10 );

add_action( 'bethlehem_before_footer',		'bethlehem_footer_before_content',	10 );

// Footer 1
add_action( 'bethlehem_footer_1', 			'bethlehem_footer_wrapper_start',	5 );
add_action( 'bethlehem_footer_1', 			'bethlehem_footer_logo',			10 );
add_action( 'bethlehem_footer_1', 			'bethlehem_footer_connect',			20 );
add_action( 'bethlehem_footer_1', 			'bethlehem_footer_wrapper_end',		25 );
add_action( 'bethlehem_footer_1', 			'bethlehem_footer_1_widgets',		30 );

// Footer 2
add_action( 'bethlehem_footer_2', 			'bethlehem_footer_wrapper_start',	5 );
add_action( 'bethlehem_footer_2', 			'bethlehem_footer_connect',			10 );
add_action( 'bethlehem_footer_2', 			'bethlehem_footer_logo',			20 );
add_action( 'bethlehem_footer_2', 			'bethlehem_footer_wrapper_end',		25 );
add_action( 'bethlehem_footer_2', 			'bethlehem_footer_2_widgets',		30 );

// Footer 3
add_action( 'bethlehem_footer_3', 			'bethlehem_footer_wrapper_start',	5 );
add_action( 'bethlehem_footer_3', 			'bethlehem_footer_logo',			10 );
add_action( 'bethlehem_footer_3', 			'bethlehem_footer_form_newsletter',	20 );
add_action( 'bethlehem_footer_3', 			'bethlehem_footer_wrapper_end',		25 );
add_action( 'bethlehem_footer_3', 			'bethlehem_footer_3_widgets',		30 );

/**
 * Homepage
 * @see  bethlehem_homepage_content()
 * @see  bethlehem_homepage_blog_element()
 * @see  bethlehem_homepage_testimonial_element()
 * @see  bethlehem_homepage_sermons_element()
 * @see  bethlehem_homepage_events_list_widget()
 */
//add_action( 'homepage', 'bethlehem_homepage_content',				10 );
add_action( 'homepage', 'bethlehem_homepage_blog_element',			20 );
add_action( 'homepage', 'bethlehem_homepage_testimonial_element',	30 );
add_action( 'homepage', 'bethlehem_homepage_donation_element',		40 );
add_action( 'homepage', 'bethlehem_homepage_sermons_element',		50 );
add_action( 'homepage', 'bethlehem_homepage_events_list_widget',	60 );

/**
 * Homepage v2
 * @see  bethlehem_homepagev2_banner_element()
 * @see  bethlehem_homepagev2_sermons_element()
 * @see  bethlehem_homepagev2_give_element()
 * @see  bethlehem_homepagev2_stories_element()
 * @see  bethlehem_homepagev2_events_calendar()
 * @see  bethlehem_homepagev2_blog_element()
 */
add_action( 'homepage_v2', 'bethlehem_homepagev2_banner_element1',		10 );
add_action( 'homepage_v2', 'bethlehem_homepagev2_sermons_element',		20 );
add_action( 'homepage_v2', 'bethlehem_homepagev2_banner_element2',		30 );
add_action( 'homepage_v2', 'bethlehem_homepagev2_stories_element',		40 );
add_action( 'homepage_v2', 'bethlehem_homepagev2_events_calendar',		50 );
add_action( 'homepage_v2', 'bethlehem_homepagev2_blog_element',			60 );

/**
 * Homepage v3
 */
add_action( 'homepage_v3', 'bethlehem_homepagev3_sermons_media_element',50 );
add_action( 'homepage_v3', 'bethlehem_homepagev3_our_team_element',		60 );
add_action( 'homepage_v3', 'bethlehem_homepagev3_blog_element',			70 );
add_action( 'homepage_v3', 'bethlehem_homepagev3_map_element',			80 );

/**
 * Posts
 * @see  bethlehem_post_header()
 * @see  bethlehem_post_meta()
 * @see  bethlehem_post_content()
 * @see  bethlehem_paging_nav()
 * @see  bethlehem_single_post_header()
 * @see  bethlehem_author_info()
 * @see  bethlehem_post_nav()
 * @see  bethlehem_display_comments()
 */
add_action( 'bethlehem_loop_post',					'bethlehem_isotope_item_wrapper_start',	5 );
add_action( 'bethlehem_loop_post',					'bethlehem_post_header',				10 );
add_action( 'bethlehem_loop_post_title_before',		'bethlehem_post_meta',					20 );
add_action( 'bethlehem_loop_post',					'bethlehem_post_content',				30 );
add_action( 'bethlehem_loop_before',				'bethlehem_isotope_wrapper_start',		10 );
add_action( 'bethlehem_loop_after',					'bethlehem_isotope_wrapper_end',		10 );
add_action( 'bethlehem_loop_after',					'bethlehem_paging_nav',					20 );
add_action( 'bethlehem_loop_post_content_after',	'bethlehem_social_share_icons',			10 );
add_action( 'bethlehem_loop_post_image_before',		'bethlehem_listview_img_wrapper_start',	10 );
add_action( 'bethlehem_loop_post_image_after',		'bethlehem_listview_wrapper_end',		10 );
add_action( 'bethlehem_loop_post_image_after',		'bethlehem_listview_wrapper_start',		20 );
add_action( 'bethlehem_loop_post',					'bethlehem_listview_wrapper_end',		35 );
add_action( 'bethlehem_loop_post',					'bethlehem_isotope_item_wrapper_end',	40 );

add_action( 'bethlehem_single_post',				'bethlehem_post_header',			10 );
add_action( 'bethlehem_single_post',				'bethlehem_post_content',			30 );
add_action( 'bethlehem_single_post_title_before',	'bethlehem_post_meta',				10 );
add_action( 'bethlehem_single_post_title_after',	'bethlehem_social_share_icons',		10 );
add_action( 'bethlehem_single_post_after',			'bethlehem_author_info',			10 );
add_action( 'bethlehem_single_post_after',			'bethlehem_post_nav',				10 );
add_action( 'bethlehem_single_post_after',			'bethlehem_display_comments',		10 );

/**
 * Pages
 * @see  bethlehem_page_header()
 * @see  bethlehem_page_content()
 * @see  bethlehem_display_comments()
 */
add_action( 'bethlehem_page', 			'bethlehem_page_header',		10 );
add_action( 'bethlehem_page', 			'bethlehem_page_content',		20 );
add_action( 'bethlehem_page_after', 	'bethlehem_display_comments',	10 );

/**
 * Extras
 * @see  bethlehem_setup_author()
 * @see  bethlehem_body_classes()
 * @see  bethlehem_page_menu_args()
 */
add_filter( 'body_class',								'bethlehem_body_classes' );
add_filter( 'body_class', 								'bethlehem_layout_class' );
add_filter( 'wp_page_menu_args',						'bethlehem_page_menu_args' );
add_filter( 'pre_get_posts',							'bethlehem_pre_get_posts' );
add_filter( 'bethlehem_homepage_sermons_carousel', 		'bethlehem_wrapper_start' );
add_filter( 'bethlehem_homepage_events_list_html',		'bethlehem_wrapper_end' );
