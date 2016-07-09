<?php
/**
 * Creates Ministries Post Type
 */

// Initialize
//................................................................
Ministries::onload();

// Define Directory
define( 'MINISTRIES_DIR', plugin_dir_path( __FILE__ ) );

// Easy access to ministries output
//................................................................
function the_ministries( $id = false, $args = array() ) {
	if ($id) {
		$args["id"] = $id;
		echo Ministries::get_ministries_content($args);
	}
}

#-----------------------------------------------------------------
# Ministries Class
#-----------------------------------------------------------------
class Ministries {

	static function onload() {
		add_action('init', array(__CLASS__,'init_ministries'));
		add_action("after_switch_theme", "flush_rewrite_rules", 10 ,  2); // update permalinks for new rewrite rules
		add_shortcode('ministries', array(__CLASS__,'ministries_shortcode'));
	}

	static function init_ministries() {
		if (function_exists('register_post_type')) {
			$ministries_post_type_labels = apply_filters( 'ministries_post_type_labels', array(
					'name' =>				_x('Ministries', 'post type general name', 'bethlehem-extension'),
					'singular_name' =>		_x('Ministry', 'post type singular name', 'bethlehem-extension'),
					'add_new' =>			_x('Add New', 'block', 'bethlehem-extension'),
					'add_new_item' =>		__('Add New', 'bethlehem-extension'),
					'edit_item' =>			__('Edit', 'bethlehem-extension'),
					'new_item' =>			__('New', 'bethlehem-extension'),
					'all_items' =>			__('All Ministries', 'bethlehem-extension'),
					'view_item' =>			__('View', 'bethlehem-extension'),
					'search_items' =>		__('Search', 'bethlehem-extension'),
					'not_found' =>			__('No ministries found', 'bethlehem-extension'),
					'not_found_in_trash' =>	__('No ministries found in Trash', 'bethlehem-extension'),
					'parent_item_colon' => '',
					'menu_name' => 'Ministries'
				)
			);

			$ministries_post_type_args = apply_filters( 'ministries_post_type_args', array(
					'labels'			  => $ministries_post_type_labels,
					'publicly_queryable'  => true,
					'public'              => true,
					'show_ui'             => true,
					'query_var'           => 'ministries',
					'has_archive'		  => true,
					'rewrite'             => array('slug' => 'ministries'),
					'menu_icon'  		  => 'dashicons-groups',
					'supports'            => array(
						'title',
						'author',
						'editor',
						'excerpt',
						'thumbnail',
					),
				)
			);

			register_post_type( 'ministries', $ministries_post_type_args );

			$ministries_category_labels = apply_filters( 'ministries_category_labels', array(
					'name' 			=> __( 'Ministries Categories', 'bethlehem-extension' ),
					'singular_name' => __( 'Ministries Category', 'bethlehem-extension' ),
				)
			);

			$ministries_category_args = apply_filters( 'ministries_category_args', array(
					'hierarchical' => true,
					'labels' => $ministries_category_labels,
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'rewrite' => array(
						'slug' => 'ministries-category',
						'with_front' => false,
						'hierarchical' => true
					),
				)
			);

			register_taxonomy( 'ministries-category', 'ministries', $ministries_category_args );
		}
		
		include_once MINISTRIES_DIR . 'includes/template-tags.php';
		include_once MINISTRIES_DIR . 'includes/hooks.php';
	}

	// Retrieves content for Ministries (could also get pages, posts, etc.)
	static function get_ministries_content($args=array()) {

		$default = array(
			'id' => false,
			'post_type' => 'ministries',
			'class' => '',
			'title' => '',
			'showtitle' => false,
			'titletag' => 'h3',
		);
		$args = (object)array_merge($default,$args);

		// Find the page data
		if (!empty($args->id)) {
			// Get content by ID or slug
			$id = $args->id;
			$id = (!is_numeric($id)) ? get_ID_by_slug($id, $args->post_type) : $id;
			// Get the page contenet
			$page_data = get_page( $id );
		} else {
			$page_data = null;
		}

		// Format and return data
		if (is_null($page_data))
			return '<!-- [No arguments where provided or the values did not match an existing ministries] -->';
		else {

			// The content
			$content = $page_data->post_content;
			$content = apply_filters('ministries_content', $content);

			// NOTE: This entire section could be setup as a filter.
			if (get_post_meta($id, 'content_filters', true) == 'all') {
				// Apply all WP content filters, including those added by plugins.
				// This can still have autop turned off with our internal filter.
				$GLOBALS['wpautop_post'] = $page_data; // not default $post so global variable used by wpautop_disable(), if function exists
				$content = apply_filters('the_content', $content);
			} else {
				// Only apply default WP filters. This is the safe way to add basic formatting without any plugin injected filters
				$content = wptexturize($content);
				$content = convert_smilies($content);
				$content = convert_chars($content);
				if (get_post_meta($id, 'wpautop', true) == 'on') { // (!wpautop_disable($id)) {
					$content = wpautop($content); // Add paragraph tags.
				}
				$content = shortcode_unautop($content);
				$content = prepend_attachment($content);
				$content = do_shortcode($content);
			}
			$class = (!empty($args->class)) ? trim($args->class) : '';
			$content = '<div id="ministries-content-' . $id . '" class="ministries-content '. $class .'">'. $content .'</div>';

			// The title
			if (!empty($args->title)){
				$title = $args->title;
				$showtitle = true;
			} else {
				$title = $page_data->post_title;
				$showtitle = $args->showtitle;
			}
			if ($showtitle) $content =  '<'. $args->titletag .' class="ministries-content-title page-title">'. $page_data->post_title .'</'. $args->titletag .'>' . $content;

			// Return content
			return  $content;
		}
	}

	// Generate ministries content from shortcode
	static function ministries_shortcode($args=array()) {
		if (!isset($args['class'])) {
			$args['class'] = '';
		}
		$args['class'] .= ' from-shortcode';
		return self::get_ministries_content($args);
	}
}

// Load Template
add_filter( 'template_include', 'ministries_template_loader' );

if ( ! function_exists( 'ministries_template_loader' ) ) {
	function ministries_template_loader( $template ) {
		$file = '';

		$taxonomies = get_object_taxonomies( 'ministries' );

		if ( is_single() && get_post_type() == 'ministries' ) {
			$file = ministries_locate_template( 'single-ministries.php' );
		} elseif ( ! empty( $taxonomies ) && is_tax( $taxonomies ) ) {
			$file = ministries_locate_template( 'archive-ministries.php' );
		} elseif ( is_post_type_archive( 'ministries' ) ) {
			$file = ministries_locate_template( 'archive-ministries.php' );
		}

		if ( $file ) {
			$template = $file;
		}

		return $template;
	}
}

if ( ! function_exists( 'ministries_locate_template' ) ) {
	function ministries_locate_template( $template_name ) {
		$template = '';
		if( function_exists( 'bethlehem_locate_template' ) ) {
			$template_path = 'ministries/';
			$default_path = trailingslashit( MINISTRIES_DIR );
			$template = bethlehem_locate_template( $template_name, $template_path, $default_path );
		}

		if ( ! $template ) {
			$template = trailingslashit( MINISTRIES_DIR ) . $template_name;
		}

		return $template;
	}
}

// HELPER: Get content ID by slug
//................................................................
if ( ! function_exists( 'get_ID_by_slug' ) ) :

	function get_ID_by_slug($slug, $post_type = 'page') {

		// Find the page object (works for any post type)
		$page = get_page_by_path( $slug, 'OBJECT', $post_type );
		if ($page) {
			return $page->ID;
		} else {
			return null;
		}
	}
endif;

// Settings Menu Initialize
//................................................................

function ministries_menu() {
	add_submenu_page(
		'edit.php?post_type=ministries',
		__('Settings','bethlehem-extension'),
		__('Settings','bethlehem-extension'),
		'manage_options',
		'ministries-settings',
		'ministry_admin_page_settings'
	);
}

// Settings Menu Callback: Display Page
//................................................................
function ministry_admin_page_settings() {
	$updatemessage = '';
	if(isset($_POST['settings'])) {
		update_option('ministries_settings', $_POST['settings']);

		$updatemessage .= '<div id="message" class="updated below-h2">' . "\n";
		$updatemessage .= '<p>Settings updated.</p>' . "\n";
		$updatemessage .= '</div>' . "\n";
	}
	if ( get_option('ministries_settings') !== false ) {
		$prevsettings = get_option('ministries_settings');
	}

	$html = '';
	$html .= '<div class="wrap">' . "\n";
	$html .= '<h2>Settings </h2>' . "\n";
	$html .= $updatemessage;
	$html .= '<div class="form-wrap">' . "\n";
		$html .= '<h3>General Settings</h3>' . "\n";
		$html .= '<form id="ministry_settings" class="validate" action="admin.php?page=ministries-settings" method="post">' . "\n";
			$html .= '<div class="form-field form-required">' . "\n";
				$html .= '<label for="default_view">Default View</label>' . "\n";
				$html .= '<select class="postform" id="default_view" name="settings[default_view]">' . "\n";
				$html .= '<option '.((isset($prevsettings['default_view']) && $prevsettings['default_view'] == 'grid') ? 'selected="selected"' : '' ).' value="grid">Grid</option>' . "\n";
				$html .= '<option '.((isset($prevsettings['default_view']) && $prevsettings['default_view'] == 'list') ? 'selected="selected"' : '' ).' value="list">List</option>' . "\n";
				$html .= '</select>' . "\n";
				$html .= '<p>The default view is how it appears on your site.</p>' . "\n";
			$html .= '</div>' . "\n";
			$html .= '<div class="form-field form-required">' . "\n";
				$html .= '<label for="archive_sidebar">Archive Page Sidebar</label>' . "\n";
				$html .= '<input type="checkbox" '.((isset($prevsettings['archive_sidebar']) && $prevsettings['archive_sidebar']) ? 'checked="checked"' : '' ).' value="1" name="settings[archive_sidebar]">' . "\n";
				$html .= '<p>Enable for show sidebar in archive page.</p>' . "\n";
			$html .= '</div>' . "\n";
			$html .= '<div class="form-field form-required">' . "\n";
				$html .= '<label for="single_sidebar">Single Page Sidebar</label>' . "\n";
				$html .= '<input type="checkbox" '.((isset($prevsettings['single_sidebar']) && $prevsettings['single_sidebar']) ? 'checked="checked"' : '' ).' value="1" name="settings[single_sidebar]">' . "\n";
				$html .= '<p>Enable for show sidebar in single pagee.</p>' . "\n";
			$html .= '</div>' . "\n";
			$html .= '<p class="submit"><input type="submit" value="Save" class="button button-primary" id="submit" name="submit"></p>' . "\n";
		$html .= '</form>' . "\n";
	$html .= '</div>' . "\n";
	$html .= '</div>' . "\n";

	echo $html;
}

#-----------------------------------------------------------------
# Custom Meta Fields for Ministries
#-----------------------------------------------------------------

add_action('admin_menu', 'meta_box_setup_ministries');
add_action('save_post', 'meta_box_save_ministries');

#-----------------------------------------------------------------
# Define Meta Fields
#-----------------------------------------------------------------

function get_custom_meta_box_fields() {
	$fields = array();

	$fields['facebook'] = array(
        'name'            => __( 'Facebook Username', 'bethlehem-extension' ),
        'description'     => __( 'Enter this ministries Facebook username (for example: bethlehem).', 'bethlehem-extension' ),
        'type'            => 'text',
        'default'         => '',
        'section'         => 'info'
    );

    $fields['twitter'] = array(
        'name'            => __( 'Twitter Username', 'bethlehem-extension' ),
        'description'     => __( 'Enter this ministries Twitter username (for example: bethlehem).', 'bethlehem-extension' ),
        'type'            => 'text',
        'default'         => '',
        'section'         => 'info'
    );

    $fields['googleplus'] = array(
        'name'            => __( 'Google Plus Username/ID', 'bethlehem-extension' ),
        'description'     => __( 'Enter this ministries Google+ username with + or ID (for example: +bethlehem or 113551191017950459231).', 'bethlehem-extension' ),
        'type'            => 'text',
        'default'         => '',
        'section'         => 'info'
    );

	return apply_filters( 'ministries_fields', $fields );
}

/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function meta_box_content_ministries() {
	global $post_id;

	$ministries_fields = get_post_custom( $post_id );
	$ministries_field_data = get_custom_meta_box_fields();

	$html = '';
	$html .= '<input type="hidden" name="bethlehem_meta_box_nonce" value="'. wp_create_nonce(plugin_basename(__FILE__)). '" />';

	if ( 0 < count( $ministries_field_data ) ) {
		$html .= '<table class="form-table">' . "\n";
		$html .= '<tbody>' . "\n";
		foreach ( $ministries_field_data as $k => $v ) {
			$data = $v['default'];
			if ( isset( $ministries_fields['_' . $k] ) && isset( $ministries_fields['_' . $k][0] ) ) {
				$data = $ministries_fields['_' . $k][0];
			}
			switch ( $v['type'] ) {
				case 'hidden':
					$field = '<input name="' . esc_attr( $k ) . '" type="hidden" id="' . esc_attr( $k ) . '" value="' . esc_attr( $data ) . '" />';
					$html .= '<tr valign="top">' . $field . "\n";
					$html .= '<tr/>' . "\n";
					break;
				default:
					$field = '<input name="' . esc_attr( $k ) . '" type="text" id="' . esc_attr( $k ) . '" class="regular-text" value="' . esc_attr( $data ) . '" />';
					$html .= '<tr valign="top"><th scope="row"><label for="' . esc_attr( $k ) . '">' . $v['name'] . '</label></th><td>' . $field . "\n";
					$html .= '<p class="description">' . $v['description'] . '</p>' . "\n";
					$html .= '</td><tr/>' . "\n";
					break;
			}
		}
		$html .= '</tbody>' . "\n";
		$html .= '</table>' . "\n";
	}
	echo $html;
}

/*-----------------------------------------------------------------------------------*/
/*	Add metabox to Ministries edit screen
/*-----------------------------------------------------------------------------------*/

function meta_box_setup_ministries () {
	add_meta_box( 'theme-meta-box-ministries-filters', __( 'Ministries Details', 'bethlehem-extension' ), 'meta_box_content_ministries', 'ministries', 'normal', 'high' );
}

/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
function meta_box_save_ministries ( $post_id ) {
	global $post;

	if ( ( get_post_type() != 'ministries' ) || ! wp_verify_nonce( $_POST['bethlehem_meta_box_nonce'], plugin_basename(__FILE__) ) ) {
		return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$ministries_field_data = get_custom_meta_box_fields();
	$ministries_fields = array_keys( $ministries_field_data );

	foreach ( $ministries_fields as $f ) {

		${$f} = strip_tags(trim($_POST[$f]));

		// Escape the URLs.
		if ( 'url' == $ministries_field_data[$f]['type'] ) {
			${$f} = esc_url( ${$f} );
		}

		if ( get_post_meta( $post_id, '_' . $f ) == '' ) {
			add_post_meta( $post_id, '_' . $f, ${$f}, true );
		} elseif( ${$f} != get_post_meta( $post_id, '_' . $f, true ) ) {
			update_post_meta( $post_id, '_' . $f, ${$f} );
		} elseif ( ${$f} == '' ) {
			delete_post_meta( $post_id, '_' . $f, get_post_meta( $post_id, '_' . $f, true ) );
		}
	}
}
