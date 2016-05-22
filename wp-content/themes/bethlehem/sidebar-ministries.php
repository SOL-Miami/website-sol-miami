<?php
/**
 * The sidebar containing the ministries widget area.
 *
 * @package bethlehem
 */

if ( ! is_active_sidebar( 'ministries-sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'ministries-sidebar-1' ); ?>
</div><!-- #secondary -->
