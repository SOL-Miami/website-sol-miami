<?php
/**
 * WPBakery Visual Composer Shortcodes settings
 *
 * @package BethlehemVCExtensions
 *
 */

if ( function_exists( 'vc_map' ) ) :

	#-----------------------------------------------------------------
	# Bethlehem Banner Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => __( 'Banner', 'bethlehem-extension' ),
			'base' => 'bethlehem_banner',
			'description' => __( 'Add a banner to your page.', 'bethlehem-extension' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => '',
			'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
		   	'params' => array(
	      		array(
					'type' => 'attach_image',
		         	'heading' => __( 'Banner Image', 'bethlehem-extension' ),
		         	'param_name' => 'banner_image',
		      	),
		      	array(
					'type' => 'colorpicker',
		         	'heading' => __( 'Background Color', 'bethlehem-extension' ),
		         	'param_name' => 'bg_color',
		         	'description' => __( 'Choose background color instead of image.', 'bethlehem-extension' )
		      	),
		      	array(
					'type' => 'dropdown',
			        'heading' => __( 'Type', 'bethlehem-extension' ),
			        'param_name' => 'type',
			        'value' => array(
			        	__( 'Choose Type', 'bethlehem-extension' )	=> '',
						__( 'Type 1', 'bethlehem-extension' )			=> 'type-1',
						__( 'Type 2', 'bethlehem-extension' )			=> 'type-2',
					),
		      	),
		      	array(
					 'type' => 'textfield',
			         'heading' => __( 'Title', 'bethlehem-extension' ),
			         'param_name' => 'title',
			         'description' => __( 'Enter banner title', 'bethlehem-extension' ),
			         'holder' => 'div'
		      	),
		      	array(
					 'type' => 'textfield',
			         'heading' => __( 'Subtitle Text', 'bethlehem-extension' ),
			         'param_name' => 'subtitle',
			         'description' => __( 'Enter banner subtitle', 'bethlehem-extension')
		      	),
		      	array(
					'type' => 'textarea_html',
					'heading' => __( 'Text', 'bethlehem-extension' ),
					'param_name' => 'content',
					'description' => __( 'Active only if choose Type 2.', 'bethlehem-extension')
				),
		      	array(
					'type' => 'textfield',
		         	'class' => '',
		         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
		         	'param_name' => 'el_class',
		         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
		      	)
		   	)
		)
	);

	#-----------------------------------------------------------------
	# Bethlehem Donation Carousel Element
	#-----------------------------------------------------------------
	if ( class_exists( 'Give' ) ):
		vc_map(
			array(
				'name' => __( 'Donation Carousel', 'bethlehem-extension' ),
				'base' => 'bethlehem_donation_carousel',
				'description' => __( 'Add Donation Carousel.', 'bethlehem-extension' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
				'params' => array(
					array(
						'type' => 'textfield',
				        'heading' => __( 'Limit', 'bethlehem-extension' ),
				        'param_name' => 'limit',
				        'holder' => 'div'
			      	),
					array(
						'type' => 'dropdown',
				        'heading' => __( 'Order By', 'bethlehem-extension' ),
				        'param_name' => 'orderby',
				        'value' => array(
							__( 'Choose Order By', 'bethlehem-extension' ) => '',
							__( 'None', 'bethlehem-extension' ) => 'none',
							__( 'ID', 'bethlehem-extension' )   => 'ID',
							__( 'Title', 'bethlehem-extension' ) => 'title',
							__( 'Date', 'bethlehem-extension' )   => 'date',
							__( 'Menu Order', 'bethlehem-extension' )   => 'menu_order',
						),
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Order', 'bethlehem-extension' ),
				        'param_name' => 'order',
				        'value' => array(
				        	__( 'Choose Order', 'bethlehem-extension' ) => '',
							__( 'Ascending', 'bethlehem-extension' ) => 'ASC',
							__( 'Descending', 'bethlehem-extension' )   => 'DESC',
						),
			      	),
			      	array(
						'type' => 'attach_image',
			         	'heading' => __( 'Background Image', 'bethlehem-extension' ),
			         	'param_name' => 'bg_img',
			      	),
			      	array(
						'type' => 'textfield',
			         	'class' => '',
			         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
			         	'param_name' => 'el_class',
			         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
			      	)
				)
			)
		);
	endif;

	#-----------------------------------------------------------------
	# Bethlehem Stories Carousel Element
	#-----------------------------------------------------------------
	if ( class_exists( 'Stories' ) ):
		vc_map(
			array(
				'name' => __( 'Stories Carousel', 'bethlehem-extension' ),
				'base' => 'bethlehem_stories_carousel',
				'description' => __( 'Add Stories Carousel.', 'bethlehem-extension' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
				'params' => array(
					array(
						'type' => 'textfield',
				        'heading' => __( 'Limit', 'bethlehem-extension' ),
				        'param_name' => 'limit',
				        'holder' => 'div'
			      	),
					array(
						'type' => 'dropdown',
				        'heading' => __( 'Order By', 'bethlehem-extension' ),
				        'param_name' => 'orderby',
				        'value' => array(
							__( 'Choose Order By', 'bethlehem-extension' ) => '',
							__( 'None', 'bethlehem-extension' ) => 'none',
							__( 'ID', 'bethlehem-extension' )   => 'ID',
							__( 'Title', 'bethlehem-extension' ) => 'title',
							__( 'Date', 'bethlehem-extension' )   => 'date',
							__( 'Menu Order', 'bethlehem-extension' )   => 'menu_order',
						),
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Order', 'bethlehem-extension' ),
				        'param_name' => 'order',
				        'value' => array(
							__( 'Choose Order', 'bethlehem-extension' ) => '',
							__( 'Ascending', 'bethlehem-extension' ) => 'ASC',
							__( 'Descending', 'bethlehem-extension' )   => 'DESC',
						),
			      	),
			      	array(
						'type' => 'textfield',
				        'heading' => __( 'Stories link text', 'bethlehem-extension' ),
				        'param_name' => 'archive_link_text',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'attach_image',
			         	'heading' => __( 'Background Image', 'bethlehem-extension' ),
			         	'param_name' => 'bg_img',
			      	),
			      	array(
						'type' => 'textfield',
			         	'class' => '',
			         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
			         	'param_name' => 'el_class',
			         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
			      	)
				)
			)
		);
	endif;

	#-----------------------------------------------------------------
	# Bethlehem Blog Recent Posts Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => __( 'Blog Recent Posts Widget', 'bethlehem-extension' ),
			'base' => 'bethlehem_recent_posts_widget',
			'description' => __( 'Add blog recent posts widget to your page.', 'bethlehem-extension' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => '',
			'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
			'params' => array(
				array(
					'type' => 'textfield',
			        'heading' => __( 'Title', 'bethlehem-extension' ),
			        'param_name' => 'title',
			        'holder' => 'div'
		      	),
		      	array(
					'type' => 'textfield',
			        'heading' => __( 'Pre Title', 'bethlehem-extension' ),
			        'param_name' => 'pre_title',
			        'description' => __( 'Enter title', 'bethlehem-extension' ),
			        'holder' => 'div'
		      	),
				array(
					'type' => 'textfield',
			        'heading' => __( 'Limit', 'bethlehem-extension' ),
			        'param_name' => 'limit',
			        'holder' => 'div'
		      	),
		      	array(
					'type' => 'dropdown',
			        'heading' => __( 'Type', 'bethlehem-extension' ),
			        'param_name' => 'type',
			        'value' => array(
						__( 'Choose Type', 'bethlehem-extension' )	=> '',
						__( 'Type 1', 'bethlehem-extension' ) 		=> 'type-1',
						__( 'Type 2', 'bethlehem-extension' )  		=> 'type-2',
						__( 'Type 3', 'bethlehem-extension' )  		=> 'type-3',
					),
		      	),
		      	array(
					'type' => 'textfield',
		         	'class' => '',
		         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
		         	'param_name' => 'el_class',
		         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
		      	)
			)
		)
	);

	#-----------------------------------------------------------------
	# Bethlehem Events List Elements
	#-----------------------------------------------------------------
	if ( class_exists( 'Tribe__Events__Main' ) ):
		if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
			vc_map(
				array(
					'name' => __( 'Events List Widget', 'bethlehem-extension' ),
					'base' => 'bethlehem_events_list_widget',
					'description' => __( 'Add events list widget to your page.', 'bethlehem-extension' ),
					'class'		=> '',
					'controls' => 'full',
					'icon' => '',
					'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
					'params' => array(
						array(
							'type' => 'textfield',
					        'heading' => __( 'Title', 'bethlehem-extension' ),
					        'param_name' => 'title',
					        'holder' => 'div'
				      	),
						array(
							'type' => 'textfield',
					        'heading' => __( 'Limit', 'bethlehem-extension' ),
					        'param_name' => 'limit',
					        'holder' => 'div'
				      	),
				      	array(
							'type' => 'textfield',
					        'heading' => __( 'Categories', 'bethlehem-extension' ),
					        'param_name' => 'categories',
					        'description' => 'Enter Category id.', 'bethlehem-extension',
					        'holder' => 'div'
				      	),
				      	array(
							'type' => 'checkbox',
							'param_name' => 'no_upcoming_events',
							'heading' => 'Show only there is Upcoming Events', 'bethlehem-extension',
							'description' => 'Show widget only if there are upcoming events.', 'bethlehem-extension',
							'value' => array( __( 'Allow', 'bethlehem-extension' ) => 'false' )
						),
				      	array(
							'type' => 'textfield',
				         	'class' => '',
				         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
				         	'param_name' => 'el_class',
				         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
				      	)
					)
				)
			);
		} else {
			vc_map(
				array(
					'name' => __( 'Events List Widget', 'bethlehem-extension' ),
					'base' => 'bethlehem_events_list_widget',
					'description' => __( 'Add events list widget to your page.', 'bethlehem-extension' ),
					'class'		=> '',
					'controls' => 'full',
					'icon' => '',
					'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
					'params' => array(
						array(
							'type' => 'textfield',
					        'heading' => __( 'Title', 'bethlehem-extension' ),
					        'param_name' => 'title',
					        'holder' => 'div'
				      	),
						array(
							'type' => 'textfield',
					        'heading' => __( 'Limit', 'bethlehem-extension' ),
					        'param_name' => 'limit',
					        'holder' => 'div'
				      	),
				      	array(
							'type' => 'checkbox',
							'param_name' => 'no_upcoming_events',
							'heading' => 'Show only there is Upcoming Events', 'bethlehem-extension',
							'description' => 'Show widget only if there are upcoming events.', 'bethlehem-extension',
							'value' => array( __( 'Allow', 'bethlehem-extension' ) => 'false' )
						),
				      	array(
							'type' => 'textfield',
				         	'class' => '',
				         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
				         	'param_name' => 'el_class',
				         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
				      	)
					)
				)
			);
		}
		vc_map(
			array(
				'name' => __( 'Events Venue Locations', 'bethlehem-extension' ),
				'base' => 'bethlehem_events_venue_locations',
				'description' => __( 'Add events venue location to your page.', 'bethlehem-extension' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
				'params' => array(
					array(
						'type' => 'textfield',
				        'heading' => __( 'Title', 'bethlehem-extension' ),
				        'param_name' => 'title',
				        'holder' => 'div'
			      	),
					array(
						'type' => 'textfield',
				        'heading' => __( 'Limit', 'bethlehem-extension' ),
				        'param_name' => 'limit',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'textarea',
				        'heading' => __( 'Service Time', 'bethlehem-extension' ),
				        'param_name' => 'service_time',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'checkbox',
						'param_name' => 'no_upcoming_events',
						'heading' => 'Show only there is Upcoming Events', 'bethlehem-extension',
						'description' => 'Show widget only if there are upcoming events.', 'bethlehem-extension',
						'value' => array( __( 'Allow', 'bethlehem-extension' ) => 'false' )
					),
			      	array(
						'type' => 'textfield',
			         	'class' => '',
			         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
			         	'param_name' => 'el_class',
			         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
			      	)
				)
			)
		);
		vc_map(
			array(
				'name' => __( 'Events Calendar', 'bethlehem-extension' ),
				'base' => 'bethlehem_events_calendar',
				'description' => __( 'Add events calendar to your page.', 'bethlehem-extension' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
				'params' => array(
					array(
						'type' => 'textfield',
				        'heading' => __( 'Title', 'bethlehem-extension' ),
				        'param_name' => 'title',
				        'holder' => 'div'
			      	),
					array(
						'type' => 'textfield',
				        'heading' => __( 'Limit', 'bethlehem-extension' ),
				        'param_name' => 'limit',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'checkbox',
						'param_name' => 'no_upcoming_events',
						'heading' => 'Show only there is Upcoming Events', 'bethlehem-extension',
						'description' => 'Show widget only if there are upcoming events.', 'bethlehem-extension',
						'value' => array( __( 'Allow', 'bethlehem-extension' ) => 'false' )
					),
			      	array(
						'type' => 'textfield',
			         	'class' => '',
			         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
			         	'param_name' => 'el_class',
			         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
			      	)
				)
			)
		);
	endif;

	#-----------------------------------------------------------------
	# Bethlehem Sermons Carousel Element
	#-----------------------------------------------------------------

	if ( class_exists( 'Sermons' ) ):
		vc_map(
			array(
				'name' => __( 'Sermons Carousel', 'bethlehem-extension' ),
				'base' => 'bethlehem_sermons_carousel',
				'description' => __( 'Add Sermons Carousel.', 'bethlehem-extension' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
				'params' => array(
					array(
						'type' => 'textfield',
				        'heading' => __( 'Title', 'bethlehem-extension' ),
				        'param_name' => 'title',
				        'holder' => 'div'
			      	),
					array(
						'type' => 'textfield',
				        'heading' => __( 'Limit', 'bethlehem-extension' ),
				        'param_name' => 'limit',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'textfield',
				        'heading' => __( 'Archive link text', 'bethlehem-extension' ),
				        'param_name' => 'archive_link_text',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Type', 'bethlehem-extension' ),
				        'param_name' => 'type',
				        'value' => array(
							__( 'Choose Type', 'bethlehem-extension' )	=> '',
							__( 'Type 1', 'bethlehem-extension' )			=> 'type-1',
							__( 'Type 2', 'bethlehem-extension' )			=> 'type-2',
						),
			      	),
			      	array(
						'type' => 'attach_image',
			         	'heading' => __( 'Background Image', 'bethlehem-extension' ),
			         	'param_name' => 'bg_img',
			         	'description' => __( 'Background Image is for only type-2.', 'bethlehem-extension')
			      	),
					array(
						'type' => 'dropdown',
				        'heading' => __( 'Order By', 'bethlehem-extension' ),
				        'param_name' => 'orderby',
				        'value' => array(
							__( 'Choose Order By', 'bethlehem-extension' ) => '',
							__( 'None', 'bethlehem-extension' ) => 'none',
							__( 'ID', 'bethlehem-extension' )   => 'ID',
							__( 'Title', 'bethlehem-extension' ) => 'title',
							__( 'Date', 'bethlehem-extension' )   => 'date',
							__( 'Menu Order', 'bethlehem-extension' )   => 'menu_order',
						),
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Order', 'bethlehem-extension' ),
				        'param_name' => 'order',
				        'value' => array(
							__( 'Choose Order', 'bethlehem-extension' ) => '',
							__( 'Ascending', 'bethlehem-extension' ) => 'ASC',
							__( 'Descending', 'bethlehem-extension' )   => 'DESC',
						),
			      	),
			      	array(
						'type' => 'textfield',
				        'heading' => __( 'Category ID', 'bethlehem-extension' ),
				        'param_name' => 'category',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'textfield',
			         	'class' => '',
			         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
			         	'param_name' => 'el_class',
			         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
			      	)
				)
			)
		);
	endif;

	#-----------------------------------------------------------------
	# Bethlehem Team Members Element
	#-----------------------------------------------------------------
	if ( class_exists( 'Woothemes_Our_Team' ) ) :
		vc_map(
			array(
				'name' => __( 'Team Members', 'bethlehem-extension' ),
				'base' => 'bethlehem_team_members',
				'description' => __( 'Add Team Members to your page.', 'bethlehem-extension' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
				'params' => array(
					array(
						'type' => 'textfield',
				        'heading' => __( 'Title', 'bethlehem-extension' ),
				        'param_name' => 'title',
				        'holder' => 'div'
			      	),
			      	array(
			      		'type' => 'dropdown',
			      		'heading' => __( 'Type', 'bethlehem-extension' ),
			      		'param_name' => 'type',
			      		'value' => array(
							__( 'Choose Type', 'bethlehem-extension' )	=> '',
							__( 'Standard', 'bethlehem-extension' )		=> 'standard',
							__( 'Large', 'bethlehem-extension' )			=> 'large',
						),
		      		),
					array(
						'type' => 'textfield',
				        'heading' => __( 'Limit', 'bethlehem-extension' ),
				        'param_name' => 'limit',
				        'holder' => 'div'
			      	),
					array(
						'type' => 'dropdown',
				        'heading' => __( 'Order By', 'bethlehem-extension' ),
				        'param_name' => 'orderby',
				        'value' => array(
							__( 'Choose Order By', 'bethlehem-extension' ) => '',
							__( 'None', 'bethlehem-extension' ) => 'none',
							__( 'ID', 'bethlehem-extension' )   => 'ID',
							__( 'Title', 'bethlehem-extension' ) => 'title',
							__( 'Date', 'bethlehem-extension' )   => 'date',
							__( 'Menu Order', 'bethlehem-extension' )   => 'menu_order',
						),
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Order', 'bethlehem-extension' ),
				        'param_name' => 'order',
				        'value' => array(
							__( 'Choose Order', 'bethlehem-extension' ) => '',
							__( 'Ascending', 'bethlehem-extension' ) => 'ASC',
							__( 'Descending', 'bethlehem-extension' )   => 'DESC',
						),
			      	),
			      	array(
						'type' => 'textfield',
				        'heading' => __( 'Category ID', 'bethlehem-extension' ),
				        'param_name' => 'category',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Choose Columns', 'bethlehem-extension' ),
				        'param_name' => 'columns',
				        'value' => array(
							__( 'Choose Columns', 'bethlehem-extension' ) => '',
							__( '2 Columns', 'bethlehem-extension' )	=> 'col-2',
							__( '3 Columns', 'bethlehem-extension' )	=> 'col-3',
							__( '4 Columns', 'bethlehem-extension' )	=> 'col-4',
							__( '5 Columns', 'bethlehem-extension' )	=> 'col-5',
							__( '6 Columns', 'bethlehem-extension' )	=> 'col-6',
						),
						'description' => __( 'Only for Standard Type.', 'bethlehem-extension')
			      	),
			      	array(
						'type' => 'textfield',
			         	'class' => '',
			         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
			         	'param_name' => 'el_class',
			         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
			      	)
				)
			)
		);
		vc_map(
			array(
				'name' => __( 'Team Members Carousel', 'bethlehem-extension' ),
				'base' => 'bethlehem_team_members_carousel',
				'description' => __( 'Add Team Members Carousel to your page.', 'bethlehem-extension' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
				'params' => array(
					array(
						'type' => 'textfield',
				        'heading' => __( 'Title', 'bethlehem-extension' ),
				        'param_name' => 'title',
				        'description' => __( 'Enter title', 'bethlehem-extension' ),
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'textfield',
				        'heading' => __( 'Pre Title', 'bethlehem-extension' ),
				        'param_name' => 'pre_title',
				        'description' => __( 'Enter title', 'bethlehem-extension' ),
				        'holder' => 'div'
			      	),
					array(
						'type' => 'textfield',
				        'heading' => __( 'Limit', 'bethlehem-extension' ),
				        'param_name' => 'limit',
				        'holder' => 'div'
			      	),
					array(
						'type' => 'dropdown',
				        'heading' => __( 'Order By', 'bethlehem-extension' ),
				        'param_name' => 'orderby',
				        'value' => array(
							__( 'Choose Order By', 'bethlehem-extension' ) => '',
							__( 'None', 'bethlehem-extension' ) => 'none',
							__( 'ID', 'bethlehem-extension' )   => 'ID',
							__( 'Title', 'bethlehem-extension' ) => 'title',
							__( 'Date', 'bethlehem-extension' )   => 'date',
							__( 'Menu Order', 'bethlehem-extension' )   => 'menu_order',
						),
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Order', 'bethlehem-extension' ),
				        'param_name' => 'order',
				        'value' => array(
							__( 'Choose Order', 'bethlehem-extension' ) => '',
							__( 'Ascending', 'bethlehem-extension' ) => 'ASC',
							__( 'Descending', 'bethlehem-extension' )   => 'DESC',
						),
			      	),
			      	array(
						'type' => 'textfield',
				        'heading' => __( 'Category ID', 'bethlehem-extension' ),
				        'param_name' => 'category',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'textfield',
			         	'class' => '',
			         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
			         	'param_name' => 'el_class',
			         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
			      	)
				)
			)
		);
	endif;

	#-----------------------------------------------------------------
	# Bethlehem Testimonials Carousel Element
	#-----------------------------------------------------------------
	if ( class_exists( 'Woothemes_Testimonials' ) ) :
		vc_map(
			array(
				'name' => __( 'Testimonials Carousel', 'bethlehem-extension' ),
				'base' => 'bethlehem_testimonials',
				'description' => __( 'Add Testimonials Carousel.', 'bethlehem-extension' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
				'params' => array(
					array(
						'type' => 'textfield',
				        'heading' => __( 'Limit', 'bethlehem-extension' ),
				        'param_name' => 'limit',
				        'holder' => 'div'
			      	),
					array(
						'type' => 'dropdown',
				        'heading' => __( 'Order By', 'bethlehem-extension' ),
				        'param_name' => 'orderby',
				        'value' => array(
							__( 'Choose Order By', 'bethlehem-extension' ) => '',
							__( 'None', 'bethlehem-extension' ) => 'none',
							__( 'ID', 'bethlehem-extension' )   => 'ID',
							__( 'Title', 'bethlehem-extension' ) => 'title',
							__( 'Date', 'bethlehem-extension' )   => 'date',
							__( 'Menu Order', 'bethlehem-extension' )   => 'menu_order',
						),
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Order', 'bethlehem-extension' ),
				        'param_name' => 'order',
				        'value' => array(
							__( 'Choose Order', 'bethlehem-extension' ) => '',
							__( 'Ascending', 'bethlehem-extension' ) => 'ASC',
							__( 'Descending', 'bethlehem-extension' )   => 'DESC',
						),
			      	),
			      	array(
						'type' => 'textfield',
				        'heading' => __( 'Category ID', 'bethlehem-extension' ),
				        'param_name' => 'category',
				        'holder' => 'div'
			      	),
			      	array(
						'type' => 'textfield',
			         	'class' => '',
			         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
			         	'param_name' => 'el_class',
			         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
			      	)
				)
			)
		);
	endif;

	#-----------------------------------------------------------------
	# Bethlehem Title Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => __( 'Title', 'bethlehem-extension' ),
			'base' => 'bethlehem_title',
			'description' => __( 'Add a Title to your page with Description.', 'bethlehem-extension' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => '',
			'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
			'params' => array(
				array(
					'type' => 'textfield',
			        'heading' => __( 'Title', 'bethlehem-extension' ),
			        'param_name' => 'title',
			        'description' => __( 'Enter title', 'bethlehem-extension' ),
			        'holder' => 'div'
		      	),
		      	array(
					'type' => 'checkbox',
					'param_name' => 'is_title_link',
					'heading' => 'Enable Link for Title', 'bethlehem-extension',
					'description' => 'Select checkbox to include title link.', 'bethlehem-extension',
					'value' => array( __( 'Allow', 'bethlehem-extension' ) => 'false' )
				),
				array(
					'type' => 'textfield',
			        'heading' => __( 'Title Link', 'bethlehem-extension' ),
			        'param_name' => 'title_link',
			        'description' => __( 'Enter link for title or leave empty', 'bethlehem-extension' ),
			        'holder' => 'div'
		      	),
		      	array(
					'type' => 'textarea',
			        'heading' => __( 'Description', 'bethlehem-extension' ),
			        'param_name' => 'desc',
			        'description' => __( 'Enter description', 'bethlehem-extension' ),
			        'holder' => 'div'
		      	),
		      	array(
					'type' => 'textfield',
			        'heading' => __( 'Description Class', 'bethlehem-extension' ),
			        'param_name' => 'desc_class',
			        'description' => __( 'Enter description class or leave empty', 'bethlehem-extension' ),
			        'holder' => 'div'
		      	),
		      	array(
		      		'type' => 'dropdown',
		      		'heading' => __( 'Text Position', 'bethlehem-extension' ),
		      		'param_name' => 'text_position',
		      		'value' => array(
						__( 'Choose Text Position', 'bethlehem-extension' ) => '',
						__( 'Left', 'bethlehem-extension' ) => 'text-left',
						__( 'Right', 'bethlehem-extension' )   => 'text-right',
						__( 'Center', 'bethlehem-extension' )   => 'text-center',
					),
	      		),
		      	array(
		      		'type' => 'dropdown',
		      		'heading' => __( 'Heading Size', 'bethlehem-extension' ),
		      		'param_name' => 'heading_size',
		      		'description' => __( 'Select title heading size', 'bethlehem-extension' ),
		      		'value' => array(
						__( 'Choose Heading', 'bethlehem-extension' ) => '',
						__( 'Heading 1', 'bethlehem-extension' ) => 'h1',
						__( 'Heading 2', 'bethlehem-extension' ) => 'h2',
						__( 'Heading 3', 'bethlehem-extension' ) => 'h3',
						__( 'Heading 4', 'bethlehem-extension' ) => 'h4',
						__( 'Heading 5', 'bethlehem-extension' ) => 'h5',
						__( 'Heading 6', 'bethlehem-extension' ) => 'h6',
					),
	      		),
		      	array(
					'type' => 'textfield',
		         	'class' => '',
		         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
		         	'param_name' => 'el_class',
		         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
		      	)
			)
		)
	);

	#-----------------------------------------------------------------
	# Bethlehem Sermons Media Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => __( 'Sermons Media', 'bethlehem-extension' ),
			'base' => 'bethlehem_sermons_media',
			'description' => __( 'Add a Sermons Media to your page.', 'bethlehem-extension' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => '',
			'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
			'params' => array(
		      	array(
					'type' => 'textfield',
			        'heading' => __( 'Title', 'bethlehem-extension' ),
			        'param_name' => 'title',
			        'description' => __( 'Enter title', 'bethlehem-extension' ),
			        'holder' => 'div'
		      	),
		      	array(
					'type' => 'textfield',
			        'heading' => __( 'Pre Title', 'bethlehem-extension' ),
			        'param_name' => 'pre_title',
			        'description' => __( 'Enter title', 'bethlehem-extension' ),
			        'holder' => 'div'
		      	),
		      	array(
					'type' => 'textarea_safe',
			        'heading' => __( 'Embedded Channel Code', 'bethlehem-extension' ),
			        'param_name' => 'embeded_content',
			        'description' => __( 'Enter Embedded Sermons Channel code here.', 'bethlehem-extension' ),
		      	),
		      	array(
					'type' => 'vc_link',
		         	'heading' => __( 'Button Link', 'bethlehem-extension' ),
		         	'param_name' => 'link_button',
		      	),
		      	array(
					'type' => 'textfield',
		         	'class' => '',
		         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
		         	'param_name' => 'el_class',
		         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
		      	)
			)
		)
	);

	#-----------------------------------------------------------------
	# Bethlehem Tiles Gallery
	#-----------------------------------------------------------------
	if ( defined( 'WP_TILES_VERSION' ) ) :
		function bethlehem_get_all_grid_templates() {
			$grid_options = array(
				__( 'Choose Order', 'bethlehem-extension' ) => ''
			);

			$args = array(
				'posts_per_page'	=> -1,
				'orderby'			=> 'id',
				'post_type'			=> 'grid_template',
			);
			$grid_templates = get_posts( $args );
			if( !empty( $grid_templates ) ) :
				foreach( $grid_templates as $grid_template ) :
					$grid_options[$grid_template->ID] = get_the_title( $grid_template->ID );
				endforeach;
			endif;

			return $grid_options;
		}
		vc_map(
			array(
				'name' => __( 'Tiled Gallery', 'bethlehem-extension' ),
				'base' => 'bethlehem_tiled_gallery',
				'description' => __( 'Add a Tiled Gallery to your page.', 'bethlehem-extension' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
				'params' => array(
			      	array(
						 'type' => 'textfield',
				         'heading' => __( 'Title', 'bethlehem-extension' ),
				         'param_name' => 'title',
				         'description' => __( 'Enter title', 'bethlehem-extension' ),
				         'holder' => 'div'
			      	),
			      	array(
						 'type' => 'textfield',
				         'heading' => __( 'Pre Title', 'bethlehem-extension' ),
				         'param_name' => 'pretitle',
				         'description' => __( 'Enter pretitle', 'bethlehem-extension')
			      	),
			      	array(
						'type' => 'textarea_html',
						'heading' => __( 'Text', 'bethlehem-extension' ),
						'param_name' => 'content',
						'description' => __( 'Add description', 'bethlehem-extension')
					),
					array(
						 'type' => 'posttypes',
				         'heading' => __( 'Post Types', 'bethlehem-extension' ),
				         'param_name' => 'post_types',
				         'description' => __( 'Enter posttypes', 'bethlehem-extension' ),
				         'holder' => 'div'
			      	),
			      	array(
						 'type' => 'textfield',
				         'heading' => __( 'Limit', 'bethlehem-extension' ),
				         'param_name' => 'limit',
				         'description' => __( 'Enter limit', 'bethlehem-extension' ),
				         'holder' => 'div'
			      	),
			      	array(
							'type' => 'dropdown',
					        'heading' => __( 'Order By', 'bethlehem-extension' ),
					        'param_name' => 'orderby',
					        'value' => array(
								__( 'Choose Order By', 'bethlehem-extension' ) => '',
								__( 'None', 'bethlehem-extension' ) => 'none',
								__( 'ID', 'bethlehem-extension' )   => 'ID',
								__( 'Title', 'bethlehem-extension' ) => 'title',
								__( 'Date', 'bethlehem-extension' )   => 'date',
								__( 'Menu Order', 'bethlehem-extension' )   => 'menu_order',
							),
				      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Order', 'bethlehem-extension' ),
				        'param_name' => 'order',
				        'value' => array(
							__( 'Choose Order', 'bethlehem-extension' ) => '',
							__( 'Ascending', 'bethlehem-extension' ) => 'ASC',
							__( 'Descending', 'bethlehem-extension' )   => 'DESC',
						),
			      	),
			      	array(
						 'type' => 'textfield',
				         'heading' => __( 'Taxonomy Name', 'bethlehem-extension' ),
				         'param_name' => 'taxonomy',
				         'description' => __( 'Enter taxonomy name', 'bethlehem-extension' ),
				         'holder' => 'div'
			      	),
			      	array(
						 'type' => 'textfield',
				         'heading' => __( 'Taxonomy Terms Slug', 'bethlehem-extension' ),
				         'param_name' => 'tax_term',
				         'description' => __( 'Enter taxonomy terms slug', 'bethlehem-extension' ),
				         'holder' => 'div'
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Grid', 'bethlehem-extension' ),
				        'param_name' => 'grid',
				        'value' => bethlehem_get_all_grid_templates(),
			      	),
			      	array(
						 'type' => 'textfield',
				         'heading' => __( 'Padding', 'bethlehem-extension' ),
				         'param_name' => 'padding',
				         'description' => __( 'Enter padding for image grids', 'bethlehem-extension' ),
				         'holder' => 'div'
			      	),
			      	array(
						'type' => 'dropdown',
				        'heading' => __( 'Pagination', 'bethlehem-extension' ),
				        'param_name' => 'pagination',
				        'value' => array(
							__( 'Choose Order', 'bethlehem-extension' ) => '',
							__( 'None', 'bethlehem-extension' ) => 'none',
							__( 'Load More', 'bethlehem-extension' )   => 'ajax',
							__( 'Prev/Next', 'bethlehem-extension' ) => 'prev_next',
							__( 'Paging', 'bethlehem-extension' ) => 'paging',
						),
			      	),
			      	array(
						'type' => 'textfield',
				        'heading' => __( 'Byline Template', 'bethlehem-extension' ),
				        'param_name' => 'byline_template',
				        'description' => __( 'Use contents listed from below ', 'bethlehem-extension' ).'%title%, %content%, %date%, %excerpt%, %link%, %author%, %featured_image%, %categories%, %category_links%'
			      	),
			      	array(
						'type' => 'textfield',
			         	'heading' => __( 'Opacity of Byline Content', 'bethlehem-extension' ),
			         	'param_name' => 'byline_opacity',
			         	'description' => __( 'Choose Byline Opacity between 0 to 1.', 'bethlehem-extension' )
			      	),
			      	array(
						'type' => 'colorpicker',
			         	'heading' => __( 'Background Color for Byline Content', 'bethlehem-extension' ),
			         	'param_name' => 'byline_color',
			         	'description' => __( 'Choose background color Byline Content.', 'bethlehem-extension' )
			      	),
			      	array(
						'type' => 'textfield',
			         	'class' => '',
			         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
			         	'param_name' => 'el_class',
			         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
			      	)
				)
			)
		);
	endif;

	#-----------------------------------------------------------------
	# Bethlehem Image Carousel
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => __( 'Bethlehem Image Carousel', 'bethlehem-extension' ),
			'base' => 'bethlehem_images_carousel',
			'description' => __( 'Add a Image Carousel to your page.', 'bethlehem-extension' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => '',
			'category' => __( 'Bethlehem Elements', 'bethlehem-extension' ),
			'params' => array(
				array(
					'type' => 'textfield',
			        'heading' => __( 'Title', 'bethlehem-extension' ),
			        'param_name' => 'title',
			        'description' => __( 'Enter title', 'bethlehem-extension' ),
			        'holder' => 'div'
		      	),
		      	array(
					'type' => 'textfield',
			        'heading' => __( 'Pre Title', 'bethlehem-extension' ),
			        'param_name' => 'pre_title',
			        'description' => __( 'Enter title', 'bethlehem-extension' ),
			        'holder' => 'div'
		      	),
		      	array(
					'type' => 'attach_images',
		         	'heading' => __( 'Carousel Images', 'bethlehem-extension' ),
		         	'param_name' => 'carousel_images',
		      	),
		      	array(
					'type' => 'vc_link',
		         	'heading' => __( 'Button Link', 'bethlehem-extension' ),
		         	'param_name' => 'link_button',
		      	),
		      	array(
					'type' => 'textfield',
		         	'class' => '',
		         	'heading' => __( 'Extra Class', 'bethlehem-extension' ),
		         	'param_name' => 'el_class',
		         	'description' => __( 'Add your extra classes here.', 'bethlehem-extension')
		      	)
			)
		)
	);

endif;
