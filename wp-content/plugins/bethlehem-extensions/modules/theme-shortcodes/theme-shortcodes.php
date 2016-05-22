<?php

// Custom WP Query
include_once BETHLEHEM_EXTENSIONS_DIR . '/modules/theme-shortcodes/class-bethlehem-query-shortcode.php';

#-----------------------------------------------------------------
# Shortcodes using [query] calss
#-----------------------------------------------------------------


// [blog] shortcode
//................................................................
if ( ! function_exists( 'blog_query' ) ) :
	function blog_query($args = null, $content = null) {
		
		// default template
		if ( !isset($args['template']) || empty($args['template']) ) {
			$args['template'] = 'loop';
		}

		// default Style
		if ( !isset($args['blog_style']) || empty($args['blog_style']) ) {
			$args['blog_style'] = 'normal';
		}

		return custom_wp_query($args, $content);
	}
	
	add_shortcode('blog', 'blog_query');
endif;