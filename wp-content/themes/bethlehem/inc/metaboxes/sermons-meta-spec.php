<?php

$bethlehem_sermon_media_access = new WPAlchemy_MediaAccess();

$bethlehem_sermon_metabox = new WPAlchemy_MetaBox(
	array(
		'id' 		=> '_bethlehem_sermon_metabox',
		'title' 	=> 'Sermon Attributes',
		'types'		=> array( 'sermons' ),
		'context' 	=> 'normal', // same as above, defaults to "normal"
		'priority' 	=> 'high', // same as above, defaults to "high"
		'mode'		=> 'WPALCHEMY_MODE_EXTRACT',
		'prefix'	=> '_beth_',
		'template' 	=> get_template_directory() . '/inc/metaboxes/sermon-media-meta.php',
	)
);