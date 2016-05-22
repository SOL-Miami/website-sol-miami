<?php
/**
 * The sidebar containing the team member widget area.
 *
 * @package bethlehem
 */

if ( ! is_active_sidebar( 'team-member-sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'team-member-sidebar-1' ); ?>
</div><!-- #secondary -->