<?php
/**
 * The sidebar containing the sermons widget area.
 *
 * @package bethlehem
 */

if ( ! is_active_sidebar( 'sermons-sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sermons-sidebar-1' ); ?>
</div><!-- #secondary -->
