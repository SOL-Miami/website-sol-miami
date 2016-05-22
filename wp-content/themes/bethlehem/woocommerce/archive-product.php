<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked bethlehem_sorting_wrapper - 9
				 * @hooked woocommerce_result_count - 10
				 * @hooked bethlehem_shop_tab_pane - 11
				 * @hooked woocommerce_catalog_ordering - 20
				 * @hooked bethlehem_sorting_wrapper_close - 20
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_subcategories(); ?>

			<?php $default_shop_view = apply_filters( 'bethlehem_default_shop_view', 'grid-view' ); ?>

			<div class="tab-content">

				<div id="grid-view" class="tab-pane<?php if( $default_shop_view == 'grid-view' ) : ?> active<?php endif; ?>">
					<?php woocommerce_product_loop_start(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>
				</div>

				<div id="list-view" class="tab-pane<?php if( $default_shop_view == 'list-view' ) : ?> active<?php endif; ?>">
					<?php woocommerce_product_loop_start(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product-list-view' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>
				</div>

			</div>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked bethlehem_paging_nav - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked bethlehem_after_content - 10
		 * @hooked bethlehem_shop_sidebar - 20
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>