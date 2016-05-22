<?php
/**
 * Header Style 8
 *
 * @package bethlehem
 */
?>
<header id="masthead" class="site-header" <?php if ( bethlehem_get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( bethlehem_get_header_image() ) . ');"'; } ?>>

	<div class="wrap">
		<?php
		/**
		 * @hooked bethlehem_skip_links - 0
		 * @hooked bethlehem_site_branding - 10
		 * @hooked bethlehem_primary_navigation - 20
		 * @hooked bethlehem_header_content - 30
		 */
		do_action( 'bethlehem_header_8' ); ?>
	</div>

</header><!-- #masthead -->