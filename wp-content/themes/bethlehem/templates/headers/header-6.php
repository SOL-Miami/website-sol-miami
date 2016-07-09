<?php
/**
 * Header Style 6
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
			 * @hooked bethlehem_site_branding - 10
			 * @hooked bethlehem_primary_navigation - 20
			 * @hooked bethlehem_navigation_links - 30
			 */
			do_action( 'bethlehem_header_6_nav_bar' ); ?>
		</div>
	</div>

	<div class="wrap">
		<?php
		/**
		 * @hooked bethlehem_header_content - 10
		 */
		do_action( 'bethlehem_header_6' ); ?>
	</div>

</header><!-- #masthead -->