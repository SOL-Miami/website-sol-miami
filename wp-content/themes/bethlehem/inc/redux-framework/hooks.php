<?php

add_action( 'init', 										'redux_remove_demo_mode' );
add_action( 'redux/page/bethlehem_options/enqueue', 		'redux_queue_font_awesome' );

/**
 * General Filters
 */
add_filter( 'bethlehem_site_favicon_url',					'redux_apply_favicon',							10 );
add_filter( 'bethlehem_site_logo',							'redux_apply_logo',								10 );
add_filter( 'bethlehem_enable_scrollup',					'redux_toggle_scrollup',						10 );
add_filter( 'bethlehem_enable_pace',						'redux_toggle_pace',							10 );

/**
 * Header Filters
 */
add_filter( 'bethlehem_enable_home_page_slider',			'redux_apply_enable_home_page_slider',			10 );
add_filter( 'bethlehem_get_home_page_slider',				'redux_apply_home_page_slider',					10 );
add_filter( 'bethlehem_header_style',						'redux_apply_header_style',						10 );
add_filter( 'bethlehem_enable_sticky_header',				'redux_sticky_header',							10 );
add_filter( 'bethlehem_header_event_time',					'redux_toggle_header_event_time',				10 );
add_filter( 'bethlehem_header_contact_info',				'redux_header_contact_info',					10 );

/**
 * Footer Filters
 */
add_filter( 'bethlehem_footer_style', 						'redux_apply_footer_style', 					10 );
add_filter( 'bethlehem_footer_connect_text',				'redux_apply_footer_connect_text',				10 );
add_filter( 'bethlehem_footer_contact_info',				'redux_apply_footer_contact_info',				10 );
add_filter( 'bethlehem_footer_contact_info_address',		'redux_apply_footer_contact_info_address',		10 );
add_filter( 'bethlehem_footer_contact_info_phone',			'redux_apply_footer_contact_info_phone',		10 );
add_filter( 'bethlehem_footer_contact_info_fax',			'redux_apply_footer_contact_info_fax',			10 );
add_filter( 'bethlehem_footer_copyright_text',				'redux_apply_footer_copyright_text',			10 );
add_filter( 'bethlehem_footer_link_button',					'redux_apply_footer_link_button',				10 );

/**
 * Blog Filters
 */
add_filter( 'bethlehem_blog_page_layout',					'redux_apply_blog_page_layout',					10 );
add_filter( 'bethlehem_blog_view_style',					'redux_apply_blog_view_style',					10 );
add_filter( 'bethlehem_post_excerpt_length',				'redux_apply_post_excerpt_length',				10 );

/**
 * Shop Filters
 */
// General Settings
add_filter( 'bethlehem_is_catalog_mode_disabled',			'redux_is_catalog_mode_disabled',				10 );
add_filter( 'bethlehem_is_stores_carousel_enable',			'redux_enable_stores_carousel',					10 );
add_filter( 'woocommerce_loop_add_to_cart_link',			'redux_apply_catalog_mode_for_product_loop',	10, 2 );
add_filter( 'bethlehem_products_per_page', 					'redux_products_per_page',						10 );
add_filter( 'bethlehem_default_shop_view', 					'redux_apply_shop_view',						10 );
add_filter( 'bethlehem_book_author_attribute', 				'redux_apply_book_author_attribute',			10 );

// Layout Settings
add_filter( 'bethlehem_shop_page_layout',					'redux_apply_shop_page_layout',					10 );
add_filter( 'bethlehem_single_product_layout',				'redux_apply_single_product_layout',			10 );

// Product Item Settings
add_filter( 'bethlehem_products_animation',					'redux_apply_products_animation',				10 );
add_filter( 'bethlehem_enable_echo',						'redux_toggle_echo',							10 );

/**
 * Ministries
 */
add_filter( 'ministries_posts_per_page',					'redux_apply_ministries_per_page',				10 );
add_filter( 'bethlehem_ministries_single_layout',			'redux_apply_ministries_single_layout',			10 );

/**
 * Sermons
 */
add_filter( 'sermons_posts_per_page',						'redux_apply_sermons_per_page',					10 );
add_filter( 'bethlehem_sermons_layout',						'redux_apply_sermons_layout',					10 );
add_filter( 'bethlehem_sermons_single_layout',				'redux_apply_sermons_single_layout',			10 );

/**
 * Stories
 */
add_filter( 'stories_posts_per_page',						'redux_apply_stories_per_page',					10 );
add_filter( 'stories_featured_post_args',					'redux_apply_stories_featured_post_args',		10 );

/**
 * Donations
 */
add_filter( 'give_forms_posts_per_page',					'redux_apply_give_forms_per_page',				10 );
add_filter( 'bethlehem_donations_layout',					'redux_apply_donations_layout',					10 );
add_filter( 'bethlehem_donations_single_layout',			'redux_apply_donations_single_layout',			10 );

/**
 * Events
 */
add_filter( 'bethlehem_events_layout',						'redux_apply_events_layout',					10 );
add_filter( 'events_single_sidebar_contact',				'redux_toggle_events_single_contact',			10 );
add_filter( 'events_single_sidebar_map',					'redux_toggle_events_single_map',				10 );
add_filter( 'events_single_sidebar_widgets',				'redux_toggle_events_single_sidebar_widgets',	10 );

/**
 * Team Members
 */
add_filter( 'team_members_posts_per_page',					'redux_apply_team_members_per_page',			10 );
add_filter( 'enable_archive_team_member_social',			'redux_toggle_team_archive_social',				10 );
add_filter( 'enable_single_team_member_social',				'redux_toggle_team_single_social',				10 );

/**
 * Social Icons
 */
add_filter( 'bethlehem_social_icons_args',					'redux_apply_social_icons_args',				10 );

/**
 * Styling
 */
add_action( 'bethlehem_style_class',						'redux_apply_bethlehem_style', 					10 );
add_action( 'bethlehem_colors_url',							'redux_apply_primary_color', 					10 );
add_filter( 'bethlehem_google_fonts',                       'redux_load_addtional_google_fonts',            10 );

/**
 * Custom Fonts
 */
add_action( 'wp_head',										'redux_apply_custom_fonts', 					99 );

/**
 * Custom Code
 */
add_action( 'wp_head',										'redux_apply_custom_css', 						100 );
add_action( 'wp_head',										'redux_apply_header_js',						PHP_INT_MAX );
add_action( 'wp_footer',									'redux_apply_footer_js',						PHP_INT_MAX );
