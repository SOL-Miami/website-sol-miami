<?php
/**
 * The sidebar containing the shop widget area.
 *
 * @package bethlehem
 */

if ( ! is_active_sidebar( 'shop-sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'shop-sidebar-1' ); ?>
</div><!-- #secondary -->
