<?php
/**
 * The template for displaying all single posts.
 *
 * @package bethlehem
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			do_action( 'bethlehem_single_post_before' );

			get_template_part( 'templates/contents/content', 'single' );

			/**
			 * @hooked bethlehem_author_info - 10
			 * @hooked bethlehem_post_nav - 10
			 * @hooked bethlehem_display_comments - 10
			 */
			do_action( 'bethlehem_single_post_after' );
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'bethlehem_sidebar' ); ?>
<?php get_footer(); ?>