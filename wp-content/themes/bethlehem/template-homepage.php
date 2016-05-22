<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package bethlehem
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			/**
			 * @hooked bethlehem_homepage_content - 10
			 * @hooked bethlehem_homepage_blog_element - 20
			 * @hooked bethlehem_homepage_testimonial_element - 30
			 * @hooked bethlehem_homepage_donation_element - 40
			 * @hooked bethlehem_homepage_sermons_element - 50
			 * @hooked bethlehem_homepage_events_list_widget - 60
			 */
			do_action( 'homepage' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
