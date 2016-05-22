<?php
/**
 * General functions used to integrate this theme with WooCommerce.
 *
 * @package bethlehem
 */

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'bethlehem_before_content' ) ) {
	function bethlehem_before_content() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
	    	<?php
	}
}

/**
 * After Content
 * Closes the wrapping divs
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'bethlehem_after_content' ) ) {
	function bethlehem_after_content() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}

/**
 * Shop Sidebar
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'bethlehem_shop_sidebar' ) ) {
	function bethlehem_shop_sidebar() {
		$layout = bethlehem_get_layout();
		if( ! ('bethlehem-full-width-content' === $layout || 'page-template-template-fullwidth-php' === $layout ) ) {
			get_sidebar( 'shop' );
		}
	}
}

/**
 * Default loop columns on product archives
 * @return integer products per row
 * @since  1.0.0
 */
if( ! function_exists( 'bethlehem_loop_columns' ) ) {
	function bethlehem_loop_columns() {
		return apply_filters( 'bethlehem_products_loop_columns', 3 ); // 3 products per row
	}
}

/**
 * Add 'woocommerce-active' class to the body tag
 * @param  array $classes
 * @return array $classes modified to include 'woocommerce-active' class
 */
if( ! function_exists( 'bethlehem_woocommerce_body_class' ) ) {
	function bethlehem_woocommerce_body_class( $classes ) {
		if ( is_woocommerce_activated() ) {
			$classes[] = 'woocommerce-active';
		}

		return $classes;
	}
}

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 * @param  array $fragments Fragments to refresh via AJAX
 * @return array            Fragments to refresh via AJAX
 */
if ( ! function_exists( 'bethlehem_cart_link_fragment' ) ) {
	function bethlehem_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		bethlehem_cart_link();

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

/**
 * WooCommerce specific scripts & stylesheets
 * @since 1.0.0
 */
if( ! function_exists( 'bethlehem_woocommerce_scripts' ) ) {
	function bethlehem_woocommerce_scripts() {
		global $bethlehem_version;
		if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
			wp_enqueue_script( 'bethlehem-collapse', get_template_directory_uri() . '/assets/js/collapse.min.js', array(), '3.3.4', true );
			wp_enqueue_script( 'bethlehem-tab', get_template_directory_uri() . '/assets/js/tab.min.js', array(), '3.3.4', true );
		}
	}
}

/**
 * Related Products Args
 * @param  array $args related products args
 * @since 1.0.0
 * @return  array $args related products args
 */
if( ! function_exists( 'bethlehem_related_products_args' ) ) {
	function bethlehem_related_products_args( $args ) {
		$args = apply_filters( 'bethlehem_related_products_args', array(
			'posts_per_page' => 3,
			'columns'        => 3,
		) );

		return $args;
	}
}

/**
 * Product gallery thumnail columns
 * @return integer number of columns
 * @since  1.0.0
 */
if( ! function_exists( 'bethlehem_thumbnail_columns' ) ) {
	function bethlehem_thumbnail_columns() {
		return intval( apply_filters( 'bethlehem_product_thumbnail_columns', 4 ) );
	}
}

/**
 * Products per page
 * @return integer number of products
 * @since  1.0.0
 */
if( ! function_exists( 'bethlehem_products_per_page' ) ) {
	function bethlehem_products_per_page() {
		return intval( apply_filters( 'bethlehem_products_per_page', 12 ) );
	}
}

/**
 * Query WooCommerce Extension Activation.
 * @var  $extension main extension class name
 * @return boolean
 */
if( ! function_exists( 'is_woocommerce_extension_activated' ) ) {
	function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
		return class_exists( $extension ) ? true : false;
	}
}

if( ! function_exists( 'bethlehem_single_product_add_to_cart' ) ) {
	function bethlehem_single_product_add_to_cart() {
		global $product;

		if( apply_filters( 'bethlehem_is_catalog_mode_disabled', TRUE ) ) {
			do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  );
		} else {
			if( $product->is_type( 'external' ) ) {
				do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  );
			}
		}
	}
}

if( ! function_exists( 'bethlehem_get_product_attr_taxonomies' ) ) {
	function bethlehem_get_product_attr_taxonomies() {
		$product_taxonomies = array();
		$attribute_taxonomies = wc_get_attribute_taxonomies();
		if ( $attribute_taxonomies ) {
			foreach ( $attribute_taxonomies as $tax ) {
				$product_taxonomies[wc_attribute_taxonomy_name( $tax->attribute_name )] = $tax->attribute_label;
			}
		}

		return $product_taxonomies;
	}
}

if( ! function_exists( 'bethlehem_shop_short_desc' ) ) {
	/* Product Short Description*/
	function bethlehem_shop_short_desc() {
		global $post;

		if ( ! $post->post_excerpt ) {
			return;
		}
		echo '<p>'.$post->post_excerpt.'</p>';
	}
}

if( ! function_exists( 'bethlehem_button_proceed_to_checkout' ) ) {
	/* Checkout button*/
	function bethlehem_button_proceed_to_checkout() {
		$checkout_url = WC()->cart->get_checkout_url();
		
		?>
		<a href="<?php echo esc_url( $checkout_url ); ?>" class="checkout-button button alt wc-forward"><?php _e( 'Checkout', 'bethlehem' ); ?></a>
		<?php
	}
}

if( ! function_exists( 'bethlehem_button_continue_shopping' ) ) {
	/* Continue Shopping button*/
	function bethlehem_button_continue_shopping() {
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );

		?>
		<a href="<?php echo esc_url( $shop_page_url ); ?>" class="continue-shop button alt wc-forward"><?php _e( 'Continue Shopping', 'bethlehem' ); ?></a>
		<?php
	}
}

if( ! function_exists( 'bethlehem_button_list_view_details' ) ) {
	/* Details button*/
	function bethlehem_button_list_view_details() {
		?>
		<div class="product-details"><a href="<?php the_permalink(); ?>"><?php _e( 'Details', 'bethlehem' ); ?></a></div>
		<?php
	}
}

if( ! function_exists( 'bethlehem_shop_tab_pane' ) ) {
	/* Grid/List Tab Pane Button*/
	function bethlehem_shop_tab_pane() {
		$default_shop_view = apply_filters( 'bethlehem_default_shop_view', 'grid-view' );
		?>
		<ul>
			<li class="grid-list-button-item grid-view<?php if( $default_shop_view == 'grid-view' ) : ?> active<?php endif; ?>">
				<a href="#grid-view" data-toggle="tab"><?php echo _x( 'Grid', 'Grid as in list view/grid view', 'bethlehem' );?></a>
			</li>
			<li class="grid-list-button-item list-view<?php if( $default_shop_view == 'list-view' ) : ?> active<?php endif; ?>">
				<a href="#list-view" data-toggle="tab"><?php echo _x( 'List', 'List as in list view/grid view', 'bethlehem' ); ?></a>
			</li>
		</ul>
		<?php
	}
}

if( ! function_exists( 'bethlehem_customer_wrapper_start' ) ) {
	/* Chckout */
	function bethlehem_customer_wrapper_start() {
		?>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingOne">
			<h3 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?php _e('Address' , 'bethlehem'); ?></a>
			</h3>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		<?php
	}
}

if( ! function_exists( 'bethlehem_customer_wrapper_end' ) ) {
	function bethlehem_customer_wrapper_end() {
		?>
		</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'bethlehem_review_wrapper_start' ) ) {
	function bethlehem_review_wrapper_start() {
		?>
		<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingTwo">
			<h3 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><?php _e('Your Order' , 'bethlehem'); ?></a>
			</h3>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		<?php
	}
}

if( ! function_exists( 'bethlehem_review_wrapper_end' ) ) {
	function bethlehem_review_wrapper_end() {
		?>
		</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'bethlehem_payment_wrapper_start' ) ) {
	function bethlehem_payment_wrapper_start() {
		?>
		<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingThree">
			<h3 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><?php _e('Payment' , 'bethlehem'); ?></a>
			</h3>
		</div>
		<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
		<?php
	}
}

if( ! function_exists( 'bethlehem_payment_wrapper_end' ) ) {
	function bethlehem_payment_wrapper_end() {
		?>
		</div>
		</div>
		</div>
		<?php
	}
}

/**
 * Adds a wrapper to star rating
 * @return string wrapped star rating html
 * @since 1.0.0
 */
if( ! function_exists( 'bethlehem_wrap_star_rating' ) ) {
	function bethlehem_wrap_star_rating( $rating_html ) {
		return '<div class="star-rating-wrapper">' . $rating_html . '</div>';
	}
}

if( ! function_exists( 'bethlehem_override_checkout_fields' ) ) {
	/* Override Checkout fields */
	function bethlehem_override_checkout_fields( $fields ) {

		foreach($fields as $key => $field ) {
			foreach( $field as $sub_key => $sub_field ) {
				if (isset($fields[$key][$sub_key]['label'])) {
					$fields[$key][$sub_key]['placeholder'] = $fields[$key][$sub_key]['label'];
				}
			}
		}

		return $fields;
	}
}

if( ! function_exists( 'bethlehem_single_product_lbl_qty' ) ) {
	function bethlehem_single_product_lbl_qty() {
		echo '<span class="lbl-qty">' .__( 'Quantity', 'bethlehem' ). ':</span>';
	}
}

if( ! function_exists( 'bethlehem_product_short_description' ) ) {
	function bethlehem_product_short_description() {
		global $post;

		$short_desc = '<div class="short-desc">'.$post->post_excerpt.'</div>';

		return apply_filters( 'bethlehem_product_short_description', $short_desc );
	}
}

if( ! function_exists( 'bethlehem_show_page_title' ) ) {
	function bethlehem_show_page_title( $show ) {
		if( is_shop() ){
			$show = false;
		}
		return $show;
	}
}

if( ! function_exists( 'bethlehem_store_carousel' ) ) {
	function bethlehem_store_carousel() {
		$footer = bethlehem_get_footer();

		if( $footer == 'footer-2' ) {
			bethlehem_our_store_carousel( array('type' => 'type-2') );
		} else {
			bethlehem_our_store_carousel();
		}
	}
}
