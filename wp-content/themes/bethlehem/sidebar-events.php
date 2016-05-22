<?php
/**
 * The sidebar containing the events widget area.
 *
 * @package bethlehem
 */

if ( ! is_active_sidebar( 'events-sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'events-sidebar-1' ); ?>
</div><!-- #secondary -->
