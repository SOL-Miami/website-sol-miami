<?php
/*
Plugin Name: Bethlehem Extensions
Plugin URI: http://demo.transvelo.in/wp/bethlehem/
Description: Extensions for Bethlehem Wordpress Theme. Supplied as a separate plugin so that the customer does not find empty shortcodes on changing the theme.
Version: 1.1.4
Author: Ibrahim Ibn Dawood
Author URI: http://transvelo.com/
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) die( '-1' );

define( 'BETHLEHEM_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
define( 'BETHLEHEM_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );

#-----------------------------------------------------------------
# Ministries Post Type
#-----------------------------------------------------------------

require_once BETHLEHEM_EXTENSIONS_DIR . '/modules/post-types/ministries/ministries.php';

#-----------------------------------------------------------------
# Sermons Post Type
#-----------------------------------------------------------------

require_once BETHLEHEM_EXTENSIONS_DIR . '/modules/post-types/sermons/sermons.php';

#-----------------------------------------------------------------
# Static Block Post Type for Megamenu Item
#-----------------------------------------------------------------

require_once BETHLEHEM_EXTENSIONS_DIR . '/modules/post-types/static-block/static-block.php';

#-----------------------------------------------------------------
# Stories Post Type
#-----------------------------------------------------------------

require_once BETHLEHEM_EXTENSIONS_DIR . '/modules/post-types/stories/stories.php';

#-----------------------------------------------------------------
# Visual Composer Extensions
#-----------------------------------------------------------------

require_once BETHLEHEM_EXTENSIONS_DIR . '/modules/js_composer/js_composer.php';

#-----------------------------------------------------------------
# Theme Shortcodes
#-----------------------------------------------------------------

require_once BETHLEHEM_EXTENSIONS_DIR . '/modules/theme-shortcodes/theme-shortcodes.php';
