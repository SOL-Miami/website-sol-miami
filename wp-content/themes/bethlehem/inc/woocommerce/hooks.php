<?php
/**
 * bethlehem WooCommerce hooks
 *
 * @package bethlehem
 */

/**
 * Styles
 * @see  bethlehem_woocommerce_scripts()
 */
add_action( 'wp_enqueue_scripts', 									'bethlehem_woocommerce_scripts',		20 );
add_filter( 'woocommerce_enqueue_styles', 							'__return_empty_array' );

/**
 * Layout
 * @see  bethlehem_before_content()
 * @see  bethlehem_after_content()
 * @see  woocommerce_breadcrumb()
 */
remove_action( 'woocommerce_before_main_content', 					'woocommerce_breadcrumb', 					20, 0 );
remove_action( 'woocommerce_before_main_content', 					'woocommerce_output_content_wrapper', 		10 );
remove_action( 'woocommerce_after_main_content', 					'woocommerce_output_content_wrapper_end', 	10 );
remove_action( 'woocommerce_sidebar', 								'woocommerce_get_sidebar', 					10 );
remove_action( 'woocommerce_after_shop_loop', 						'woocommerce_pagination', 					10 );
remove_action( 'woocommerce_before_shop_loop', 						'woocommerce_result_count', 				20 );
remove_action( 'woocommerce_before_shop_loop', 						'woocommerce_catalog_ordering', 			30 );
remove_action( 'woocommerce_after_shop_loop_item_title',			'woocommerce_template_loop_rating',			5 );

remove_action( 'woocommerce_before_shop_loop_item',					'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item',					'woocommerce_template_loop_product_link_close', 5 );

add_action( 'woocommerce_before_main_content', 						'bethlehem_before_content', 				10 );
add_action( 'woocommerce_after_main_content', 						'bethlehem_after_content', 					10 );
add_action( 'woocommerce_after_main_content', 						'bethlehem_shop_sidebar', 					20 );

add_action( 'woocommerce_after_shop_loop', 							'bethlehem_paging_nav', 					40 );
add_action( 'woocommerce_before_shop_loop',							'bethlehem_sorting_wrapper',				9 );
add_action( 'woocommerce_before_shop_loop', 						'woocommerce_result_count', 				10 );

add_action( 'woocommerce_before_shop_loop', 						'bethlehem_shop_tab_pane', 					11 );
add_action( 'woocommerce_before_shop_loop', 						'woocommerce_catalog_ordering', 			20 );
add_action( 'woocommerce_before_shop_loop',							'bethlehem_sorting_wrapper_close',			30 );

/**
 * Products
 * @see  bethlehem_upsell_display()
 */
remove_action( 'woocommerce_after_single_product_summary', 			'woocommerce_upsell_display', 				15 );
add_action( 'woocommerce_after_single_product_summary', 			'bethlehem_upsell_display', 				15 );
add_action( 'woocommerce_before_add_to_cart_button', 				'bethlehem_single_product_lbl_qty', 		15 );
add_action( 'woocommerce_single_product_summary', 					'bethlehem_get_book_author',				7 );
add_action( 'bethlehem_product_grid_view_after_title',				'bethlehem_get_book_author',				5 );
add_action( 'bethlehem_product_list_view_after_title',				'bethlehem_get_book_author',				5 );
add_action( 'bethlehem_product_list_view_after_title',				'bethlehem_shop_short_desc',				10 );
add_action( 'bethlehem_product_list_view_shop_loop_item',			'bethlehem_button_list_view_details',		10 );		

remove_action( 'woocommerce_before_shop_loop_item_title', 			'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 				'bethlehem_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_single_product_summary', 				'woocommerce_template_single_add_to_cart',		30 );
add_action( 'woocommerce_single_product_summary', 					'bethlehem_single_product_add_to_cart',			30 );

/**
 * Filters
 * @see  bethlehem_woocommerce_body_class()
 * @see  bethlehem_cart_link_fragment()
 * @see  bethlehem_thumbnail_columns()
 * @see  bethlehem_related_products_args()
 * @see  bethlehem_products_per_page()
 * @see  bethlehem_loop_columns()
 * @see  bethlehem_breadcrumb_delimeter()
 * @see  bethlehem_wrap_star_rating()
 */
add_filter( 'body_class', 											'bethlehem_woocommerce_body_class' );
add_filter( 'woocommerce_product_thumbnails_columns', 				'bethlehem_thumbnail_columns' );
add_filter( 'woocommerce_output_related_products_args', 			'bethlehem_related_products_args' );
add_filter( 'loop_shop_per_page', 									'bethlehem_products_per_page' );
add_filter( 'loop_shop_columns', 									'bethlehem_loop_columns' );
add_filter( 'woocommerce_product_get_rating_html',					'bethlehem_wrap_star_rating' );
add_filter( 'woocommerce_checkout_fields',							'bethlehem_override_checkout_fields' );
add_filter( 'woocommerce_short_description',						'bethlehem_product_short_description' );
add_filter( 'woocommerce_show_page_title',							'bethlehem_show_page_title' );

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'bethlehem_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'bethlehem_cart_link_fragment' );
}

/**
 * Integrations
 * @see  bethlehem_woocommerce_integrations_scripts()
 * @see  bethlehem_add_bookings_customizer_css()
 */
add_action( 'wp_enqueue_scripts', 									'bethlehem_woocommerce_integrations_scripts' );

/**
 * Cart
 * @see bethlehem_button_proceed_to_checkout()
 * @see woocommerce_cross_sell_display()
 */
remove_action( 'woocommerce_cart_collaterals', 						'woocommerce_cross_sell_display' );
remove_action( 'woocommerce_proceed_to_checkout', 					'woocommerce_button_proceed_to_checkout', 	20 );
add_action( 'woocommerce_proceed_to_checkout', 						'bethlehem_button_proceed_to_checkout', 	20 );
add_action( 'woocommerce_proceed_to_checkout', 						'bethlehem_button_continue_shopping', 		30 );
add_action( 'woocommerce_after_cart', 								'woocommerce_cross_sell_display' );

/**
 *   Footer
 */
add_action( 'bethlehem_store_carousel',								'bethlehem_store_carousel',					10 );
