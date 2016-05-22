<?php
/**
 * Creates Stories Post Type
 */

// Initialize
//................................................................
Stories::onload();

// Define Directory
define( 'STORIES_DIR', plugin_dir_path( __FILE__ ) );

// Easy access to stories output
//................................................................
function the_stories( $id = false, $args = array() ) {
	if ( $id ) {
		$args["id"] = $id;
		echo Stories::get_stories_content( $args );
	}
}

#-----------------------------------------------------------------
# Stories Class
#-----------------------------------------------------------------
class Stories {

	static function onload() {
		add_action( 'init', array( __CLASS__ ,'init_stories' ) );
		add_action( 'after_switch_theme', 'flush_rewrite_rules', 10, 2 ); // update permalinks for new rewrite rules
		add_shortcode( 'stories', array( __CLASS__ , 'stories_shortcode' ) );
	}

	static function init_stories() {
		if ( function_exists('register_post_type') ) {

			$stories_post_type_labels	= apply_filters( 'stories_post_type_labels', array(
					'name' 					=> _x( 'Stories', 'post type general name', 'bethlehem-extension'),
					'singular_name' 		=> _x( 'Story', 'post type singular name', 'bethlehem-extension'),
					'add_new' 				=> _x( 'Add New', 'block', 'bethlehem-extension'),
					'add_new_item' 			=> __( 'Add New', 'bethlehem-extension'),
					'edit_item' 			=> __( 'Edit', 'bethlehem-extension'),
					'new_item' 				=> __( 'New', 'bethlehem-extension'),
					'all_items' 			=> __( 'All Stories', 'bethlehem-extension'),
					'view_item' 			=> __( 'View', 'bethlehem-extension'),
					'search_items' 			=> __( 'Search', 'bethlehem-extension'),
					'not_found' 			=> __( 'No stories found', 'bethlehem-extension'),
					'not_found_in_trash' 	=> __( 'No stories found in Trash', 'bethlehem-extension'),
					'parent_item_colon' 	=> '',
					'menu_name' 			=> 'Stories'
				)
			);

			$stories_post_type_args	= apply_filters( 'stories_post_type_args', array(
					'labels' 				=> $stories_post_type_labels,
					'publicly_queryable'  	=> true,
					'public'              	=> true,
					'show_ui'             	=> true,
					'query_var'           	=> 'stories',
					'has_archive'		  	=> true,
					'rewrite'             	=> array( 'slug' => 'stories'),
					'menu_icon'  		  	=> 'dashicons-format-chat',
					'supports'            	=> array(
						'title',
						'author',
						'editor',
						'excerpt',
						'thumbnail',
					),
				)
			);

			register_post_type( 'stories', $stories_post_type_args );

			$stories_category_labels = apply_filters( 'stories_category_labels', array(
					'name' 			=> __( 'Stories Categories', 'bethlehem-extension' ),
					'singular_name' => __( 'Stories Category', 'bethlehem-extension' ),
				)
			);

			$stories_category_args = apply_filters( 'stories_category_args', array(
					'hierarchical' 		=> true,
					'labels' 			=> $stories_category_labels,
					'show_ui' 			=> true,
					'query_var' 		=> true,
					'show_admin_column' => true,
					'rewrite' 			=> array(
						'slug' 			=> 'stories-category',
						'with_front' 	=> false,
						'hierarchical' 	=> true
					),
				)
			);

			register_taxonomy( 'stories-category', 'stories', $stories_category_args );
		}

		include_once STORIES_DIR . 'includes/template-tags.php';
		include_once STORIES_DIR . 'includes/hooks.php';
	}

	// Retrieves content for Stories (could also get pages, posts, etc.)
	static function get_stories_content( $args = array() ) {

		$default = array(
			'id' 		=> false,
			'post_type' => 'stories',
			'class' 	=> '',
			'title'	 	=> '',
			'showtitle' => false,
			'titletag' 	=> 'h3',
		);

		$args = (object) array_merge( $default, $args );

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
			return '<!-- [No arguments where provided or the values did not match an existing stories] -->';
		else {

			// The content
			$content = $page_data->post_content;
			$content = apply_filters( 'stories_content', $content );

			// NOTE: This entire section could be setup as a filter.
			if ( get_post_meta( $id, 'content_filters', true ) == 'all' ) {
				// Apply all WP content filters, including those added by plugins.
				// This can still have autop turned off with our internal filter.
				$GLOBALS['wpautop_post'] = $page_data; // not default $post so global variable used by wpautop_disable(), if function exists
				$content = apply_filters('the_content', $content);
			} else {
				// Only apply default WP filters. This is the safe way to add basic formatting without any plugin injected filters
				$content = wptexturize($content);
				$content = convert_smilies($content);
				$content = convert_chars($content);
				if ( get_post_meta($id, 'wpautop', true) == 'on' ) { // (!wpautop_disable($id)) {
					$content = wpautop($content); // Add paragraph tags.
				}
				$content = shortcode_unautop($content);
				$content = prepend_attachment($content);
				$content = do_shortcode($content);
			}

			$class = ( !empty($args->class) ) ? trim( $args->class ) : '';
			$content = '<div id="stories-content-' . $id . '" class="stories-content '. $class .'">'. $content .'</div>';

			// The title
			if ( !empty( $args->title ) ){
				$title = $args->title;
				$showtitle = true;
			} else {
				$title = $page_data->post_title;
				$showtitle = $args->showtitle;
			}

			if ( $showtitle ) {
				$content =  '<'. $args->titletag .' class="stories-content-title page-title">'. $page_data->post_title .'</'. $args->titletag .'>' . $content;
			}

			// Return content
			return  $content;
		}
	}

	// Generate stories content from shortcode
	static function stories_shortcode( $args=array() ) {
		if ( !isset( $args['class'] ) ) {
			$args['class'] = '';
		}
		$args['class'] .= ' from-shortcode';
		return self::get_stories_content( $args );
	}
}

// Load Template
add_filter( 'template_include', 'stories_template_loader' );

function stories_template_loader( $template ) {
	$file = '';
	if ( is_single() && get_post_type() == 'stories' ) {
		$file = STORIES_DIR . '/single-stories.php';
	}
	elseif ( is_tax( get_object_taxonomies( 'stories' ) ) ) {
		$file = STORIES_DIR . '/archive-stories.php';
	}
	elseif ( is_post_type_archive( 'stories' ) ) {
		$file = STORIES_DIR . '/archive-stories.php';
	}
	if ( $file ) {
		$template = $file;
	}
	return $template;
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
