<?php
/**
 * Header Style 4
 *
 * @package bethlehem
 */
?>
<header id="masthead" class="site-header" <?php if ( bethlehem_get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( bethlehem_get_header_image() ) . ');"'; } ?>>

	<div class="wrap">
		<div class="header-top-nav-menu">
			<?php
			/**
			 * @hooked bethlehem_header_contact_info - 10
			 * @hooked bethlehem_event_time - 20
			 */
			do_action( 'bethlehem_header_4_top_bar' ); ?>
		</div>

		<div class="header-nav-menu">
			<?php
			/**
			 * @hooked bethlehem_skip_links - 0
			 * @hooked bethlehem_site_branding - 10
			 * @hooked bethlehem_primary_navigation - 20
			 * @hooked bethlehem_navigation_links - 30
			 */
			do_action( 'bethlehem_header_4_nav_bar' ); ?>
		</div>

		<?php
		/**
		 * @hooked bethlehem_header_content - 10
		 */
		do_action( 'bethlehem_header_4' ); ?>

	</div>

</header><!-- #masthead -->