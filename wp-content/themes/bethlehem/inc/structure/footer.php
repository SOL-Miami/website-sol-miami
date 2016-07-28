<?php
/**
 * Template functions used for the site footer.
 *
 * @package bethlehem
 */

if ( ! function_exists( 'bethlehem_get_footer_template' ) ) {
	/**
	 * Locate Footer Templates
	 * @since  1.0.0
	 */
	function bethlehem_get_footer_template() {
		$footer = bethlehem_get_footer();

		switch ( $footer ) {
			case 'footer-3':
				bethlehem_get_template( 'footers/footer-3.php' );
				break;
			case 'footer-2':
				bethlehem_get_template( 'footers/footer-2.php' );
				break;
			case 'footer-1':
				bethlehem_get_template( 'footers/footer-1.php' );
				break;
			default:
				bethlehem_get_template( 'footers/footer-1.php' );
				break;
		}
	}
}

if ( ! function_exists( 'bethlehem_footer_1_widgets' ) ) {
	function bethlehem_footer_1_widgets() {
		bethlehem_footer_widgets();
	}
}

if ( ! function_exists( 'bethlehem_footer_2_widgets' ) ) {
	function bethlehem_footer_2_widgets() {
		?>
		<div class="footer-widgets">
			<div class="wrap">
				<div class="footer-widget-area">
					<div class="block footer-widget footer-widget-1">
						<p><?php echo apply_filters( 'bethlehem_footer_contact_info', __( 'Bethlehem Church', 'bethlehem' ) ); ?></p>
					</div>
					<div class="block footer-widget footer-widget-2">
						<p><?php echo apply_filters( 'bethlehem_footer_contact_info_address', __( '901-947 South Ripple Creek Drive, Houston, TX 77057, USA', 'bethlehem' ) ); ?></p>
					</div>
					<div class="block footer-widget footer-widget-3">
						<p><?php echo apply_filters( 'bethlehem_footer_contact_info_phone', __( 'Telephone: +1 555 1234', 'bethlehem' ) ); ?></p>
					</div>
					<div class="block footer-widget footer-widget-4">
						<p><?php echo apply_filters( 'bethlehem_footer_contact_info_fax', __( 'Fax: +1 555 4444', 'bethlehem' ) ); ?></p>
					</div>
				</div>
				<div class="footer-copyright-area">
					<div class="footer-copyright-text">
						<p><?php echo apply_filters( 'bethlehem_footer_copyright_text', __( '@ All rights reserved 2015', 'bethlehem' ) ); ?></p>
					</div>
					<div class="footer-button">
						<?php echo apply_filters( 'bethlehem_footer_link_button', sprintf( '<a class="hb-more-button" href="%s"><i class="fa fa-long-arrow-right"></i>%s</a>', esc_url( home_url( '/' ) ), __( 'Contact us', 'bethlehem' ) ) ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'bethlehem_footer_3_widgets' ) ) {
	function bethlehem_footer_3_widgets() {
		?>
		<div class="footer-widgets">
			<div class="wrap">
				<div class="footer-copyright-text">
					<p><?php echo apply_filters( 'bethlehem_footer_copyright_text', __( '@ All rights reserved 2015', 'bethlehem' ) ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'bethlehem_footer_widgets' ) ) {
	/**
	 * Display the footer widget regions
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_footer_widgets() {
		if ( is_active_sidebar( 'footer-4' ) ) {
			$widget_columns = apply_filters( 'bethlehem_footer_widget_regions', 4 );
		} elseif ( is_active_sidebar( 'footer-3' ) ) {
			$widget_columns = apply_filters( 'bethlehem_footer_widget_regions', 3 );
		} elseif ( is_active_sidebar( 'footer-2' ) ) {
			$widget_columns = apply_filters( 'bethlehem_footer_widget_regions', 2 );
		} elseif ( is_active_sidebar( 'footer-1' ) ) {
			$widget_columns = apply_filters( 'bethlehem_footer_widget_regions', 1 );
		} else {
			$widget_columns = apply_filters( 'bethlehem_footer_widget_regions', 0 );
		}

		if ( $widget_columns > 0 ) {
			?>
			<div class="footer-widgets col-<?php echo intval( $widget_columns ); ?> fix">

				<div class="wrap">
					<?php $i = 0; while ( $i < $widget_columns ) : $i++; ?>

						<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>

							<div class="block footer-widget footer-widget-<?php echo intval( $i ); ?>">
					        	<?php dynamic_sidebar( 'footer-' . intval( $i ) ); ?>
							</div>

				        <?php endif; ?>

					<?php endwhile; ?>
				</div><!-- /.wrap -->

			</div><!-- /.footer-widgets  -->
			<?php
		}
	}
}

if ( ! function_exists( 'bethlehem_footer_logo' ) ) {
	function bethlehem_footer_logo() {
		ob_start();
		bethlehem_site_branding();
		$site_logo = ob_get_clean();
		?>
		<div class="footer-logo">
			<?php echo apply_filters( 'bethlehem_footer_logo', $site_logo ); ?>
			<ul class="social-buttons">
				<li><a href="#"><i class="fa fa-2x fa-facebook-official" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-2x fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-2x fa-youtube-square" aria-hidden="true"></i></a></li>
			</ul>
			<h4 class="newsletter-htag">Subscribe to newsletter</h4>
		</div>
		<?php
	}
}

if ( ! function_exists( 'bethlehem_footer_connect' ) ) {
	function bethlehem_footer_connect() {
		echo '<div class="connect-with-us">';
			echo sprintf( '<h5>%s</h5>', apply_filters( 'bethlehem_footer_connect_text', __( 'Connect with us', 'bethlehem' ) ) );
			apply_filters( 'bethlehem_footer_social_icons', bethlehem_social_icons() );
		echo '</div>';
	}
}

if ( ! function_exists( 'bethlehem_footer_before_content' ) ) {
	function bethlehem_footer_before_content() {
		$footer = bethlehem_get_footer();

		if( apply_filters( 'bethlehem_is_stores_carousel_enable', TRUE ) && $footer != 'footer-3' ) {
			do_action( 'bethlehem_store_carousel' );
		}
	}
}

if( ! function_exists( 'bethlehem_footer_form_newsletter' ) ) {
	/**
	 * Displays a newsletter signup form
	 * @since 1.0.0
	 * @return void
	 */
	function bethlehem_footer_form_newsletter() {
		if ( shortcode_exists( 'mc4wp_form' ) ) {
			echo do_shortcode( '[mc4wp_form]' );
		}
	}
}

if ( ! function_exists( 'bethlehem_footer_wrapper_start' ) ) {
	function bethlehem_footer_wrapper_start() {
		echo '<div class="wrap">';
	}
}

if ( ! function_exists( 'bethlehem_footer_wrapper_end' ) ) {
	function bethlehem_footer_wrapper_end() {
		echo '</div><!-- /.wrap -->';
	}
}
