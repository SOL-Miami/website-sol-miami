<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage v2
 *
 * @package bethlehem
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			/**
			 * @hooked  bethlehem_homepagev2_banner_element1 - 10
			 * @hooked  bethlehem_homepagev2_sermons_element - 20
			 * @hooked  bethlehem_homepagev2_banner_element2 - 30
			 * @hooked  bethlehem_homepagev2_stories_element - 40
			 * @hooked  bethlehem_homepagev2_events_calendar - 50
			 * @hooked  bethlehem_homepagev2_blog_element - 60
			 */
			do_action( 'homepage_v2' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
