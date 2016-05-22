<?php

add_action( 'admin_head', 		'bethlehem_remove_vc_teaser' );
add_action( 'wp_loaded', 		'bethlehem_add_vc_params' );

add_action( 'vc_before_init', 	'bethlehem_setup_visual_composer' );

add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'bethlehem_apply_custom_css', PHP_INT_MAX, 3 );