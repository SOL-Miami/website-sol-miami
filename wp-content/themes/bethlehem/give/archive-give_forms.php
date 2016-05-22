<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
?>
<?php
/**
 * give_before_main_content hook
 *
 * @hooked give_output_content_wrapper - 10 (outputs opening divs for the content)
 */
do_action( 'give_before_main_content' );
?>

	<?php do_action( 'give_before_loop_content' ); ?>

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) :  the_post(); ?>
			
			<div class="donations-loop">

				<?php do_action( 'give_archive_loop_content' ); ?>

			</div>

		<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part( 'templates/contents/content', 'none' ); ?>
	<?php endif; ?>

	<?php do_action( 'give_after_loop_content' ); ?>
<?php
/**
 * give_after_main_content hook
 *
 * @hooked give_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'give_after_main_content' );
?>

<?php
/**
 * give_sidebar hook
 *
 * @hooked give_get_sidebar - 10
 */
do_action( 'give_sidebar' );
?>

<?php 
	get_footer();