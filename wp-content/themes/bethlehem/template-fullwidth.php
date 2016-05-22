<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Full width
 *
 * @package bethlehem
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				do_action( 'bethlehem_page_before' );
				?>

				<?php get_template_part( 'templates/contents/content', 'page' ); ?>

				<?php
				/**
				 * @hooked bethlehem_display_comments - 10
				 */
				do_action( 'bethlehem_page_after' );
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
