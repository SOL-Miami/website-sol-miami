<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
?>
<section id="primary" class="content-area">
	<main id="main" class="site-main">

		<div class="ministries-archive">
			<div class="ministries-content">
		
			<?php do_action( 'ministries_before_archive_content' ); ?>

				<?php if ( have_posts() ) : ?>
					<?php do_action( 'ministries_archive_content' ); ?>
				<?php else : ?>
					<?php get_template_part( 'templates/contents/content', 'none' ); ?>
				<?php endif; ?>

			<?php do_action( 'ministries_after_archive_content' ); ?>

			</div>
		</div>
	</main>
</section>

<?php do_action( 'ministries_sidebar' ); ?>

<?php 
	get_footer();