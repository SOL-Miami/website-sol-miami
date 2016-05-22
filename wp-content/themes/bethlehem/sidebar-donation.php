<?php
/**
 * The sidebar containing the give donation widget area.
 *
 * @package bethlehem
 */

if ( ! is_active_sidebar( 'donation-sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'donation-sidebar-1' ); ?>
</div><!-- #secondary -->
