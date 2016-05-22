<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
?>

<section id="primary" class="content-area">
	<main id="main" class="site-main">
	
		<?php if ( have_posts() ) : ?>
			
			<?php do_action( 'stories_before_archive_content' ); ?>

			<div class="stories-archive">
				
				<?php do_action( 'stories_before_loop_content' ); ?>

				<?php while ( have_posts() ) :  the_post(); ?>
					
					<div class="stories-loop">

						<?php do_action( 'stories_archive_loop_content' ); ?>

					</div>

				<?php endwhile; ?>

				<?php do_action( 'stories_after_loop_content' ); ?>
			</div>

			<?php do_action( 'stories_after_archive_content' ); ?>

		<?php else : ?>
			<?php get_template_part( 'templates/contents/content', 'none' ); ?>
		<?php endif; ?>
	
	</main>
</section>

<?php do_action( 'stories_sidebar' ); ?>

<?php 
	get_footer();