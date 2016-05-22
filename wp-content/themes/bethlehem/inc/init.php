<?php
/**
 * bethlehem engine room
 *
 * @package bethlehem
 */

/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/admin/post-formats/load.php';

require get_template_directory() . '/inc/admin/wpalchemy/MetaBox.php';
require get_template_directory() . '/inc/admin/wpalchemy/MediaAccess.php';
require get_template_directory() . '/inc/metaboxes/bethlehem-page-spec.php';
require get_template_directory() . '/inc/metaboxes/sermons-meta-spec.php';

require get_template_directory() . '/inc/functions/setup.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/functions/extras.php';
require get_template_directory() . '/inc/functions/media.php';

/**
 * Initialize Theme Options
 */
if( is_redux_activated() ) {
	require get_template_directory() . '/inc/redux-framework/hooks.php';
	require get_template_directory() . '/inc/redux-framework/functions.php';
	require get_template_directory() . '/inc/redux-framework/bethlehem-options.php';
}

/**
 * Structure.
 * Template functions used throughout the theme.
 */
require get_template_directory() . '/inc/structure/hooks.php';
require get_template_directory() . '/inc/structure/layout.php';
require get_template_directory() . '/inc/structure/post.php';
require get_template_directory() . '/inc/structure/page.php';
require get_template_directory() . '/inc/structure/header.php';
require get_template_directory() . '/inc/structure/footer.php';
require get_template_directory() . '/inc/structure/comments.php';
require get_template_directory() . '/inc/structure/template-tags.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack/jetpack.php';

/**
 * Welcome screen
 * Admin Enhancements
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/setup.php';
}

/**
 * Load WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
	require get_template_directory() . '/inc/woocommerce/integrations.php';
}

/**
 * Load Visual Composer compatibility files
 */
if( is_visual_composer_activated() ) {
	require get_template_directory() . '/inc/visual-composer/hooks.php';
	require get_template_directory() . '/inc/visual-composer/functions.php';
}

/**
 * Load Events compatibility files.
 */
if ( is_events_calendar_activated() ) {
	require get_template_directory() . '/inc/tribe-events/hooks.php';
	require get_template_directory() . '/inc/tribe-events/functions.php';
}

if( is_rev_slider_activated() ) {
	require get_template_directory() . '/inc/slider-revolution/hooks.php';
	require get_template_directory() . '/inc/slider-revolution/functions.php';	
}

if( is_give_activated() ) {
	require get_template_directory() . '/inc/give/hooks.php';
	require get_template_directory() . '/inc/give/functions.php';
	require get_template_directory() . '/inc/give/template-tags.php';
}

if( is_our_team_activated() ) {
	require get_template_directory() . '/inc/team-members/hooks.php';
	require get_template_directory() . '/inc/team-members/functions.php';
	require get_template_directory() . '/inc/team-members/template-tags.php';
}

/**
 * Load Bethlehem Extensions compatibility files.
 */
require get_template_directory() . '/inc/bethlehem-extensions/functions.php';