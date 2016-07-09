<?php
/**
 * Creates Sermons Post Type
 */

// Initialize
//................................................................
Sermons::onload();

// Define Directory
define( 'SERMONS_DIR', plugin_dir_path( __FILE__ ) );

// Easy access to sermons output
//................................................................
if ( ! function_exists( 'the_sermons' ) ) {
	function the_sermons( $id = false, $args = array() ) {
		if ($id) {
			$args["id"] = $id;
			echo Sermons::get_sermons_content($args);
		}
	}
}

#-----------------------------------------------------------------
# Sermons Class
#-----------------------------------------------------------------
class Sermons {

	static function onload() {
		add_action( 'init', array( __CLASS__, 'init_sermons' ) );
		add_action( 'after_switch_theme', 'flush_rewrite_rules', 10 , 2); // update permalinks for new rewrite rules
		add_shortcode( 'sermons', array( __CLASS__ , 'sermons_shortcode' ) );
	}

	static function init_sermons() {
		if ( function_exists( 'register_post_type' ) ) {
			$sermons_post_type_labels = apply_filters( 'sermons_post_type_labels', array(
					'name' 					=>	_x( 'Sermons', 'post type general name', 'bethlehem-extension' ),
					'singular_name' 		=>	_x( 'Sermon', 'post type singular name', 'bethlehem-extension' ),
					'add_new' 				=>	_x( 'Add New', 'block', 'bethlehem-extension' ),
					'add_new_item'			=>	__( 'Add New', 'bethlehem-extension' ),
					'edit_item' 			=>	__( 'Edit', 'bethlehem-extension' ),
					'new_item' 				=>	__( 'New', 'bethlehem-extension' ),
					'all_items' 			=>	__( 'All Sermons', 'bethlehem-extension' ),
					'view_item' 			=>	__( 'View', 'bethlehem-extension' ),
					'search_items' 			=>	__( 'Search', 'bethlehem-extension' ),
					'not_found' 			=>	__( 'No sermons found', 'bethlehem-extension' ),
					'not_found_in_trash' 	=>	__( 'No sermons found in Trash', 'bethlehem-extension'),
					'parent_item_colon' 	=> '',
					'menu_name' 			=> 'Sermons'
				)
			);

			$sermons_post_type_args = apply_filters( 'sermons_post_type_args', array(
					'labels' => $sermons_post_type_labels,
					'publicly_queryable'  => true,
					'public'              => true,
					'show_ui'             => true,
					'query_var'           => 'sermons',
					'has_archive'		  => true,
					'rewrite'             => array( 'slug' => 'sermons' ),
					'menu_icon'  		  => 'dashicons-controls-volumeon',
					'supports'            => array(
						'title',
						'author',
						'editor',
						'comments',
						'thumbnail',
						'post-formats',
					),
				)
			);

			register_post_type( 'sermons', $sermons_post_type_args );

			$sermons_category_labels = apply_filters( 'sermons_category_labels', array(
					'name' 			=> __( 'Sermons Categories', 'bethlehem-extension' ),
					'singular_name' => __( 'Sermons Category', 'bethlehem-extension' ),
				)
			);

			$sermons_category_args = apply_filters( 'sermons_category_args', array(
					'hierarchical'		=> true,
					'labels' 			=> $sermons_category_labels,
					'show_ui'    		=> true,
					'query_var'    		=> true,
					'show_admin_column' => true,
					'rewrite'			=> array(
						'slug' 			=> 'sermons-category',
						'with_front' 	=> false,
						'hierarchical' 	=> true
					),
				)
			);

			register_taxonomy( 'sermons-category', 'sermons', $sermons_category_args );

			$sermons_occasion_labels = apply_filters( 'sermons_occasion_labels',  array(
					'name' 			=> __( 'Sermons Occasions', 'bethlehem-extension' ),
					'singular_name' => __( 'Sermons Occasion', 'bethlehem-extension' ),
				)
			);

			$sermons_occasion_args = apply_filters( 'sermons_occasion_args',  array(
					'hierarchical'		=> true,
					'labels' 			=> $sermons_occasion_labels,
					'show_ui'    		=> true,
					'query_var'    		=> true,
					'show_admin_column' => true,
					'rewrite'			=> array(
						'slug' 			=> 'sermons-occasion',
						'with_front' 	=> false,
						'hierarchical' 	=> true
					),
				)
			);

			register_taxonomy( 'sermons-occasion', 'sermons', $sermons_occasion_args );
			
			// add post-formats to post_type 'sermons'
			add_post_type_support( 'sermons', 'post-formats', array( 'audio', 'video' ) );
			add_image_size( 'sermons-carousel', 290, 317, true );

			include_once SERMONS_DIR . 'includes/template-tags.php';
			include_once SERMONS_DIR . 'includes/hooks.php';
		}
	}

	// Retrieves content for Sermons (could also get pages, posts, etc.)
	static function get_sermons_content($args=array()) {

		$default = array(
			'id' 		=> false,
			'post_type' => 'sermons',
			'class' 	=> '',
			'title'		=> '',
			'showtitle' => false,
			'titletag' 	=> 'h3',
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
			return '<!-- [No arguments where provided or the values did not match an existing sermons] -->';
		else {

			// The content
			$content = $page_data->post_content;
			$content = apply_filters('sermons_content', $content);

			$GLOBALS['wpautop_post'] = $page_data; // not default $post so global variable used by wpautop_disable(), if function exists
			$content = apply_filters( 'the_content' , $content );

			$class = ( !empty( $args->class ) ) ? trim( $args->class ) : '';
			$content = '<div id="sermons-content-' . $id . '" class="sermons-content '. $class .'">'. $content .'</div>';

			// The title
			if (!empty($args->title)){
				$title = $args->title;
				$showtitle = true;
			} else {
				$title = $page_data->post_title;
				$showtitle = $args->showtitle;
			}
			if ($showtitle) $content =  '<'. $args->titletag .' class="sermons-content-title page-title">'. $page_data->post_title .'</'. $args->titletag .'>' . $content;

			// Return content
			return  $content;
		}
	}

	// Generate sermons content from shortcode
	static function sermons_shortcode($args=array()) {
		if (!isset($args['class'])) {
			$args['class'] = '';
		}
		$args['class'] .= ' from-shortcode';
		return self::get_sermons_content($args);
	}
}

// Load Template
add_filter( 'template_include', 'sermons_template_loader' );

if ( ! function_exists( 'sermons_template_loader' ) ) {
	function sermons_template_loader( $template ) {
		$file = '';

		$taxonomies = get_object_taxonomies( 'sermons' );

		if ( is_single() && get_post_type() == 'sermons' ) {
			$file = sermons_locate_template( 'single-sermons.php' );
		} elseif ( ! empty( $taxonomies ) && is_tax( $taxonomies ) ) {
			if ( is_tax( 'sermons-category') ) {
				$file = sermons_locate_template( 'taxonomy-sermons-category.php' );
			}
			elseif ( is_tax( 'sermons-occasion') ) {
				$file = sermons_locate_template( 'taxonomy-sermons-occasion.php' );
			}
		} elseif ( is_post_type_archive( 'sermons' ) ) {
			$file = sermons_locate_template( 'archive-sermons.php' );
		}

		if ( $file ) {
			$template = $file;
		}

		return $template;
	}
}

if ( ! function_exists( 'sermons_locate_template' ) ) {
	function sermons_locate_template( $template_name ) {
		$template = '';
		if( function_exists( 'bethlehem_locate_template' ) ) {
			$template_path = 'sermons/';
			$default_path = trailingslashit( SERMONS_DIR );
			$template = bethlehem_locate_template( $template_name, $template_path, $default_path );
		}

		if ( ! $template ) {
			$template = trailingslashit( SERMONS_DIR ) . $template_name;
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
