<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php do_action( 'ministries_before_list_loop' ); ?>

<?php while ( have_posts() ) :  the_post(); ?>
	<div class="ministries-list">
		<?php do_action( 'ministries_list_loop_content' ); ?>
	</div>
<?php endwhile; ?>

<?php do_action( 'ministries_after_list_loop' ); ?>