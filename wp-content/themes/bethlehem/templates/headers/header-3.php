<?php
/**
 * Header Style 3
 *
 * @package bethlehem
 */
?>
<header id="masthead" class="site-header" <?php if ( bethlehem_get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( bethlehem_get_header_image() ) . ');"'; } ?>>

	<div class="header-nav-menu">
		<div class="wrap">
			<?php
			/**
			 * @hooked bethlehem_skip_links - 0
			 * @hooked bethlehem_primary_navigation - 10
			 * @hooked bethlehem_navigation_links - 20
			 */
			do_action( 'bethlehem_header_3_nav_bar' ); ?>
		</div>
	</div>

	<div class="header-top-nav-menu">
		<div class="wrap">
			<?php
			/**
			 * @hooked bethlehem_site_branding - 10
			 * @hooked bethlehem_event_time - 20
			 */
			do_action( 'bethlehem_header_3_top_bar' ); ?>
		</div>
	</div>

	<div class="wrap">
		<?php
		/**
		 * @hooked bethlehem_header_content - 10
		 */
		do_action( 'bethlehem_header_3' ); ?>
	</div>

</header><!-- #masthead -->