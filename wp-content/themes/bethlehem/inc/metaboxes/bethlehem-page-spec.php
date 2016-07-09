<?php

$bethlehem_page_metabox = new WPAlchemy_MetaBox( apply_filters( 'bethlehem_page_metabox_args',
	array(
		'id' => '_bethlehem_page_metabox',
		'title' 	=> esc_html__( 'Bethlehem Page Attributes', 'bethlehem' ),
		'types' => array('page'),
		'context' => 'normal', // same as above, defaults to "normal"
		'priority' => 'high', // same as above, defaults to "high"
		'template' => get_template_directory() . '/inc/metaboxes/bethlehem-page-meta.php'
	) )
);

/* eof */