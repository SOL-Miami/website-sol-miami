<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php do_action( 'ministries_before_grid_loop' ); ?>

<?php while ( have_posts() ) :  the_post(); ?>
	<div class="ministries-grid">
		<?php do_action( 'ministries_grid_loop_content' ); ?>
	</div>
<?php endwhile; ?>

<?php do_action( 'ministries_after_grid_loop' ); ?>