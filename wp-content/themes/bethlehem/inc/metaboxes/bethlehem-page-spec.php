<?php

$bethlehem_page_metabox = new WPAlchemy_MetaBox(
	array(
		'id' => '_bethlehem_page_metabox',
		'title' => 'Bethlehem Page Attributes',
		'types' => array('page'),
		'context' => 'normal', // same as above, defaults to "normal"
		'priority' => 'high', // same as above, defaults to "high"
		'template' => get_template_directory() . '/inc/metaboxes/bethlehem-page-meta.php'
	)
);

/* eof */