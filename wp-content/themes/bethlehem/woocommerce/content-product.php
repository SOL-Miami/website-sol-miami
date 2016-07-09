<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes = array();

if( ! function_exists( 'wc_get_loop_class' ) ) {
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
	}

	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}

	// Increase loop count
	$woocommerce_loop['loop']++;

	if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
		$classes[] = 'first';
	}
	if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
		$classes[] = 'last';
	}
}

if( apply_filters( 'bethlehem_products_animation', 'none' ) != 'none' ) {
	$classes[] = 'wow ' . apply_filters( 'bethlehem_products_animation', 'none' );
}
?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>" class="product-cover">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
	</a>

	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<?php
		/**
		 * bethlehem_product_grid_view_after_title hook
		 *
		 * @hooked bethlehem_get_book_author - 5
		 */
		do_action( 'bethlehem_product_grid_view_after_title' );
	?>

	<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	?>


	<?php

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' ); 

	?>

</li>
