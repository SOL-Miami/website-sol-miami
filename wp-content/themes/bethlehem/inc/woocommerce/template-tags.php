<?php
/**
 * Custom template tags used to integrate this theme with WooCommerce.
 *
 * @package bethlehem
 */

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0.0
 */
if ( ! function_exists( 'bethlehem_cart_link' ) ) {
	function bethlehem_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'bethlehem' ); ?>">
				<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'bethlehem' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}

/**
 * Display Product Search
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'bethlehem_product_search' ) ) {
	function bethlehem_product_search() {
		if ( is_woocommerce_activated() ) { ?>
			<div class="site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
		<?php
		}
	}
}

/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'bethlehem_header_cart' ) ) {
	function bethlehem_header_cart() {
		if ( is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
		?>
		<ul class="site-header-cart menu">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php bethlehem_cart_link(); ?>
			</li>
			<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		</ul>
		<?php
		}
	}
}

/**
 * Upsells
 * Replace the default upsell function with our own which displays the correct number product columns
 * @since   1.0.0
 * @return  void
 * @uses    woocommerce_upsell_display()
 */
if ( ! function_exists( 'bethlehem_upsell_display' ) ) {
	function bethlehem_upsell_display() {
		woocommerce_upsell_display( -1, 3 );
	}
}

/**
 * Get the product thumbnail for the loop.
 *
 * @access public
 * @subpackage  Loop
 * @return void
 */
if( ! function_exists( 'bethlehem_loop_product_thumbnail') ) {
	function bethlehem_loop_product_thumbnail() {
		if( apply_filters( 'bethlehem_enable_echo', TRUE ) ) {
			if ( has_post_thumbnail() ) {
				$product_thumbnail_id = get_post_thumbnail_id();
				$product_thumbnail_src = wp_get_attachment_image_src( $product_thumbnail_id, 'shop_catalog' );
			} else {
				$dimensions = wc_get_image_size( 'shop_catalog' );
				$product_thumbnail_src = array(
					wc_placeholder_img_src(),
					esc_attr( $dimensions['width'] ),
					esc_attr( $dimensions['height'] )
				);
			}
			echo '<img class="attachment-shop_catalog wp-post-image echo-lazy-loading" src="' .get_template_directory_uri() . '/assets/images/blank.gif" alt="" data-echo="' . esc_attr( $product_thumbnail_src[0] ). '" width="' .esc_attr( $product_thumbnail_src[1] ). '" height="' .esc_attr( $product_thumbnail_src[2] ). '">';
		} else {
			echo woocommerce_get_product_thumbnail();
		}
	}
}

/**
 * Sorting wrapper
 * @since   1.0.0
 * @return  void
 */
if( ! function_exists( 'bethlehem_sorting_wrapper' ) ) {
	function bethlehem_sorting_wrapper() {
		echo '<div class="bethlehem-sorting">';
	}
}

/**
 * Sorting wrapper close
 * @since   1.0.0
 * @return  void
 */
if( ! function_exists( 'bethlehem_sorting_wrapper_close' ) ) {
	function bethlehem_sorting_wrapper_close() {
		echo '</div>';
	}
}

if( ! function_exists( 'bethlehem_get_book_author' ) ) {
	function bethlehem_get_book_author() {
		global $product;

		$book_author_attribute = apply_filters( 'bethlehem_book_author_attribute', 'pa_authors' );

		echo '<div class="book-author">' . $product->get_attribute( $book_author_attribute ) . '</div>';
	}
}

if( ! function_exists( 'bethlehem_our_store_carousel' ) ) {
	function bethlehem_our_store_carousel( $atts=array() ) {
		$default_atts = array(
			'post_type'			=> 'product',
			'posts_per_page'	=> 8,
			'type'				=> 'type-1'
		);
		extract( array_merge( $default_atts, $atts ) );
		$args = apply_filters( 'our_store_carousel_args', array(
			'post_type'			=> $post_type,
			'posts_per_page'	=> $posts_per_page,
		) );

		if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
			wp_enqueue_script( 'bethlehem-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
		}
		$carouselID = 'our-store-carousel-' . time();
		?>
		<section id="section-<?php echo esc_attr( $carouselID ); ?>" class="our-store <?php echo esc_attr( $type ); ?>">
			<div class="container">
				<header>
					<span class="our-store-carousel-nav our-store-carousel-prev" data-target="#<?php echo esc_attr( $carouselID ); ?>"><i class="fa fa-chevron-left"></i></span>
					<h3><?php echo apply_filters( 'our_store_carousel_title', __( 'Our Charity Store', 'bethlehem' ) ); ?></h3>
					<span class="our-store-carousel-nav our-store-carousel-next" data-target="#<?php echo esc_attr( $carouselID ); ?>"><i class="fa fa-chevron-right"></i></span>
				</header>

				<div id="<?php echo esc_attr( $carouselID ); ?>" class="our-store-carousel owl-carousel">
			<?php
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) :
					while ( $loop->have_posts() ) : $loop->the_post();
					$product = get_product( $loop->post->ID ); ?>
					<div class="item">
						<div class="product-item">
							<div class="product-info">
								<div class="product-thumbnail">
									<?php
										if( $type == 'type-2' ) {
											echo woocommerce_template_loop_product_thumbnail();
										} else {
											woocommerce_template_loop_product_thumbnail();
										}
									?>
								</div>
								<div class="product-body">
									<h5 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									<?php
										if( $type == 'type-1' ) {
											bethlehem_get_book_author();
										}
									?>
									<?php
										if( $type == 'type-1' ) {
											echo bethlehem_product_short_description();
										} else {
											echo '<div class="short-desc">';
											echo custom_excerpt( get_the_content(), 8, TRUE );
											echo '</div>';
										}
									?>
								</div>
								<div class="actions">
									<?php woocommerce_template_loop_price(); ?>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								</div>
							</div>
						</div>
					</div>
			<?php
					endwhile;
				endif;
				wp_reset_postdata();
			?>
				</div>
			</div>
			<script type="text/javascript">
				(function($) {
					$(document).ready(function() {
						var ourStoreCarousel = $("#<?php echo esc_attr( $carouselID ); ?>");
					    ourStoreCarousel.owlCarousel({
					    	items	: 4,
					    	nav		: false,
					    	dots	: false,
					    	responsive: {
				                0: {
				                    items: 1,
				                },
				                768 : {
				                    items: 2,
				                },
				                1024 : {
				                    items : 4,
				                },
				            },
					    });
					    $('.our-store-carousel-next').click(function() {
						    ourStoreCarousel.trigger('next.owl.carousel');
						});
						$('.our-store-carousel-prev').click(function() {
						    ourStoreCarousel.trigger('prev.owl.carousel');
						})
				    });
				})(jQuery);
			</script>
		</section>
		<?php
	}
}