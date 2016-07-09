<?php
/**
 * The template for displaying product content list-view within loops.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

if( ! function_exists( 'wc_get_loop_class' ) ) {
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) )
		$woocommerce_loop['loop'] = 0;

	// Increase loop count
	$woocommerce_loop['loop']++;

}

// Extra post classes
$classes[] = 'list-view';
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

	<div class="list-view-content">

		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<?php
			/**
			 * bethlehem_product_list_view_after_title hook
			 *
			 * @hooked bethlehem_get_book_author - 5
			 * @hooked bethlehem_shop_short_desc - 10
			 */
			do_action( 'bethlehem_product_list_view_after_title' );
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
			 * bethlehem_product_list_view_shop_loop_item hook
			 *
			 * @hooked bethlehem_button_list_view_details - 10
			 */
			do_action( 'bethlehem_product_list_view_shop_loop_item' );
		?>

		<?php

			/**
			 * woocommerce_after_shop_loop_item hook
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' ); 

		?>

	</div>

</li>
