<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
?>

<section id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="sermons-single">
			<div class="sermons-content">
				
				<?php do_action( 'sermons_before_main_content' ); ?>

					<?php while ( have_posts() ) :  the_post(); ?>
						
						<?php do_action( 'sermons_single_post_before' ); ?>

						<?php do_action( 'sermons_single_post_content' ); ?>

						<?php do_action( 'sermons_single_post_after' ); ?>

					<?php endwhile; ?>

				<?php do_action( 'sermons_after_main_content' ); ?>

			</div>
		</div>

	</main>
</section>

<?php do_action( 'sermons_sidebar' ); ?>

<?php 
	get_footer();