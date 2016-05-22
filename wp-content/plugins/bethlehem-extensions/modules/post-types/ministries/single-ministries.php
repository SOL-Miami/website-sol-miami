<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
?>

<section id="primary" class="content-area">
	<main id="main" class="site-main">

		<div class="ministries-single">
			<div class="ministries-content">	
		
				<?php do_action( 'ministries_before_main_content' ); ?>

				<?php while ( have_posts() ) :  the_post(); ?>

					<?php do_action( 'ministries_main_content' ); ?>

				<?php endwhile; ?>

				<?php do_action( 'ministries_after_main_content' ); ?>

			</div>
		</div>
	</main>
</section>

<?php do_action( 'ministries_sidebar' ); ?>

<?php 
	get_footer();