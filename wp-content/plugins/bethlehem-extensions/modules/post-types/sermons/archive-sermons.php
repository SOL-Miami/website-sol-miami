<?php
if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}
	get_header();
?>

<section id="primary" class="content-area">
	<main id="main" class="site-main">

	<?php do_action( 'sermons_before_loop_content' ); ?>

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) :  the_post(); ?>
			
			<div class="sermons-loop">

				<?php do_action( 'sermons_archive_loop_content' ); ?>

			</div>

		<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part( 'templates/contents/content', 'none' ); ?>
	<?php endif; ?>

	<?php do_action( 'sermons_after_loop_content' ); ?>
	
	</main>
</section>

<?php do_action( 'sermons_sidebar' ); ?>

<?php 
	get_footer();