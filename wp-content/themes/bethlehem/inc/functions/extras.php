<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package bethlehem
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
if( ! function_exists( 'bethlehem_page_menu_args' ) ) {
	function bethlehem_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if( ! function_exists( 'bethlehem_body_classes' ) ) {
	function bethlehem_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if ( ! function_exists( 'woocommerce_breadcrumb' ) || ! apply_filters( 'bethlehem_enable_breadcrumb', true ) ) {
			$classes[]	= 'no-wc-breadcrumb';
		}

		/**
		 * What is this?!
		 * Take the blue pill, close this file and forget you saw the following code.
		 * Or take the red pill, filter bethlehem_make_me_cute and see how deep the rabbit hole goes...
		 */
		$cute	= apply_filters( 'bethlehem_make_me_cute', false );

		if ( true === $cute ) {
			$classes[] = 'bethlehem-cute';
		}

		return $classes;
	}
}

/**
 * Layout classes
 * Adds 'right-sidebar' and 'left-sidebar' classes to the body tag
 * @param  array $classes current body classes
 * @return string[]          modified body classes
 * @since  1.0.0
 */
if( ! function_exists( 'bethlehem_layout_class' ) ) {
	function bethlehem_layout_class( $classes ) {

	    $layout = bethlehem_get_layout();

		$classes[] = $layout;

	    $style = bethlehem_get_style();

	    $classes[] = $style;

	    $header = bethlehem_get_header();

	    $classes[] = $header;

	    $footer = bethlehem_get_footer();

	    $classes[] = $footer;

	    if( is_page() && bethlehem_should_hide_container() ) {
	        $classes[] = 'no-container';
	    }

	    if( is_front_page() ) {
	    	$classes[] = 'home-page';
	    }

	    if( is_woocommerce_activated() && is_account_page() && !is_user_logged_in() ){
	        $classes[] = 'light-bg';

	        if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'no' ) {
	            $classes[] = 'no-registration';
	        }
	    }

		return $classes;
	}
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false ;
	}
}

if( ! function_exists( 'is_events_calendar_activated' ) ) {
	function is_events_calendar_activated() {
		return class_exists( 'Tribe__Events__Main' ) ? true : false ;
	}
}

if( ! function_exists( 'is_events_calendar_pro_activated' ) ) {
	function is_events_calendar_pro_activated() {
		return class_exists( 'Tribe__Events__Pro__Main' ) ? true : false ;
	}
}

if( ! function_exists( 'is_rev_slider_activated' ) ) {
	function is_rev_slider_activated() {
		return class_exists( 'RevSlider' ) ? true : false ;
	}
}

if( !function_exists( 'is_give_activated' ) ) {
	function is_give_activated() {
		return class_exists( 'Give' ) ? true : false ;
	}
}

if( !function_exists( 'is_our_team_activated' ) ) {
	function is_our_team_activated() {
		return class_exists( 'Woothemes_Our_Team' ) ? true : false ;
	}
}

if( !function_exists( 'is_testimonials_activated' ) ) {
	function is_testimonials_activated() {
		return class_exists( 'Woothemes_Testimonials' ) ? true : false ;
	}
}

if( ! function_exists( 'is_redux_activated' ) ) {
	function is_redux_activated() {
		return class_exists( 'ReduxFrameworkPlugin' ) ? true : false;
	}
}

if( ! function_exists( 'is_wp_tiles_activated' ) ) {
	function is_wp_tiles_activated() {
		return defined( 'WP_TILES_VERSION' ) ? true : false;
	}
}

/**
 * Check if Visual Composer is activated
 */
if( ! function_exists( 'is_visual_composer_activated' ) ) {
	function is_visual_composer_activated() {
		return class_exists( 'WPBakeryVisualComposerAbstract' ) ? true : false;
	}
}

/**
 * Schema type
 * @return string schema itemprop type
 */
if( ! function_exists( 'bethlehem_html_tag_schema' ) ) {
	function bethlehem_html_tag_schema() {
		$schema 	= 'http://schema.org/';
		$type 		= 'WebPage';

		// Is single post
		if ( is_singular( 'post' ) ) {
			$type 	= 'Article';
		}

		// Is author page
		elseif ( is_author() ) {
			$type 	= 'ProfilePage';
		}

		// Is search results page
		elseif ( is_search() ) {
			$type 	= 'SearchResultsPage';
		}

		echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if( ! function_exists( 'bethlehem_categorized_blog' ) ) {
	function bethlehem_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'bethlehem_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'bethlehem_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so bethlehem_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so bethlehem_categorized_blog should return false.
			return false;
		}
	}
}

/**
 * Flush out the transients used in bethlehem_categorized_blog.
 */
function bethlehem_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'bethlehem_categories' );
}
add_action( 'edit_category', 'bethlehem_category_transient_flusher' );
add_action( 'save_post',     'bethlehem_category_transient_flusher' );

if( ! function_exists( 'bethlehem_get_layout' ) ) {
	function bethlehem_get_layout(){

		$layout = 'right-sidebar'; // This is the default layout

		$give_taxonomies = get_object_taxonomies( 'give_forms' );

		if( is_woocommerce_activated() && is_shop() ) {
			// Shop Page
			$layout = apply_filters( 'bethlehem_shop_page_layout', 'left-sidebar' );

		} elseif ( is_woocommerce_activated() && is_product_category() ) {
			// Category Product Page
			$layout = apply_filters( 'bethlehem_shop_page_layout', 'left-sidebar' );

		} elseif ( is_woocommerce_activated() && is_product() ) {
			// Single Product Page
			$layout = apply_filters( 'bethlehem_single_product_layout', 'left-sidebar' );

		} elseif( is_events_calendar_pro_activated() && ( tribe_is_week() || tribe_is_photo() || tribe_is_map() ) ) {
			if ( tribe_is_week() ) {
				$layout = apply_filters( 'bethlehem_events_week_layout', 'bethlehem-full-width-content' );
			} elseif ( tribe_is_map() ) {
				$layout = apply_filters( 'bethlehem_events_month_layout', 'bethlehem-full-width-content' );
			} else {
				$layout = apply_filters( 'bethlehem_events_layout', 'right-sidebar' );
			}

		} elseif( is_events_calendar_activated() && ( tribe_is_event() || tribe_is_event_category() || tribe_is_in_main_loop() || tribe_is_view() || 'tribe_events' == get_post_type() || is_singular( 'tribe_events' ) || tribe_is_day() || tribe_is_list_view() || tribe_is_month() ) ) {
			if ( is_single() ) {
				$layout = apply_filters( 'bethlehem_events_single_layout', 'bethlehem-full-width-content' );
			} elseif ( tribe_is_month() ) {
				$layout = apply_filters( 'bethlehem_events_month_layout', 'bethlehem-full-width-content' );
			} else {
				$layout = apply_filters( 'bethlehem_events_layout', 'right-sidebar' );
			}
		} elseif ( is_front_page() && is_home() ) {
			// Default homepage
			$layout = 'right-sidebar';

		} elseif ( is_front_page() ) {
			// static homepage
			$layout = 'bethlehem-full-width-content';

		} elseif ( is_home() ) {
			// blog page
			$layout = apply_filters( 'bethlehem_blog_page_layout', 'right-sidebar' );
			if ( apply_filters( 'bethlehem_blog_view_style', 'normal' ) == 'grid-view' ) {
				$layout = 'bethlehem-full-width-content';
			}

		} elseif( is_page() ) {
			if( !is_page_template() ){
				$layout = 'right-sidebar';
			} else {
				// All Pages
				$layout = ''; // This is because, there is an option to choose the layout from Page templates
			}

		} elseif( is_post_type_archive( 'ministries' ) || is_tax( get_object_taxonomies( 'ministries' ) ) || is_singular( array( 'ministries' ) ) ) {
			// ministries page
			if( is_post_type_archive( 'ministries' ) || is_tax( get_object_taxonomies( 'ministries' ) ) ) {
				$layout = apply_filters( 'bethlehem_ministries_layout', 'bethlehem-full-width-content' );
			} else {
				$layout = apply_filters( 'bethlehem_ministries_single_layout', 'right-sidebar' );
			}

		} elseif( is_post_type_archive( 'sermons' ) || is_tax( get_object_taxonomies( 'sermons' ) ) || is_singular( array( 'sermons' ) ) ) {
			// sermons page
			if( is_post_type_archive( 'sermons' ) || is_tax( get_object_taxonomies( 'sermons' ) ) ) {
				$layout = apply_filters( 'bethlehem_sermons_layout', 'right-sidebar' );
			} else {
				$layout = apply_filters( 'bethlehem_sermons_single_layout', 'right-sidebar' );
			}

		} elseif( is_post_type_archive( 'give_forms' ) || ( !empty( $give_taxonomies ) && is_tax( $give_taxonomies ) ) || is_singular( array( 'give_forms' ) ) ) {
			// donations page
			if( is_post_type_archive( 'give_forms' ) || is_tax( get_object_taxonomies( 'give_forms' ) ) ) {
				$layout = apply_filters( 'bethlehem_donations_layout', 'right-sidebar' );
			} else {
				$layout = apply_filters( 'bethlehem_donations_single_layout', 'right-sidebar' );
			}

		} elseif( is_post_type_archive( 'stories' ) || is_tax( get_object_taxonomies( 'stories' ) ) || is_singular( array( 'stories' ) ) ) {
			// stories page
			if( is_post_type_archive( 'stories' ) || is_tax( get_object_taxonomies( 'stories' ) ) ) {
				$layout = apply_filters( 'bethlehem_stories_layout', 'bethlehem-full-width-content' );
			} else {
				$layout = apply_filters( 'bethlehem_stories_single_layout', 'bethlehem-full-width-content' );
			}

		} elseif( is_post_type_archive( 'team-member' ) || is_tax( get_object_taxonomies( 'team-member' ) ) || is_singular( array( 'team-member' ) ) ) {
			// Team Members page
			if( is_post_type_archive( 'team-member' ) || is_tax( get_object_taxonomies( 'team-member' ) ) ) {
				$layout = apply_filters( 'bethlehem_team_member_layout', 'bethlehem-full-width-content' );
			} else {
				$layout = apply_filters( 'bethlehem_team_member_single_layout', 'right-sidebar' );
			}

		} else {
		  //everything else
			$layout = 'right-sidebar';
		}

		return $layout;
	}
}

if( ! function_exists( 'is_bethlehem_front_page_template' ) ) {
	function is_bethlehem_front_page_template( $page_template_file ){
		$frontpage_ID = get_option('page_on_front');
		$page_template_ID = array();

		$query = new WP_Query(array(
		    'post_type'  => 'page',  /* overrides default 'post' */
		    'meta_key'   => '_wp_page_template',
		    'meta_value' => $page_template_file
		));

		if ( $query->have_posts() ) {
			foreach ($query->posts as $posts) {
				$page_template_ID[] = $posts->ID;
			}
		}

		wp_reset_postdata();

		if ( in_array( $frontpage_ID, $page_template_ID, false ) ) {
			return true;
		}

		return false;
	}
}

if( ! function_exists( 'bethlehem_get_style' ) ) {
	function bethlehem_get_style(){
		if ( is_page_template( array( 'template-homepage.php' ) ) || is_bethlehem_front_page_template( 'template-homepage.php' ) ) {
			$bethlehem_style = 'bethlehem-style-1';
		} else if ( is_page_template( array( 'template-homepage-v2.php' ) ) || is_bethlehem_front_page_template( 'template-homepage-v2.php' ) ) {
			$bethlehem_style = 'bethlehem-style-2';
		} else if ( is_page_template( array( 'template-homepage-v3.php' ) ) || is_bethlehem_front_page_template( 'template-homepage-v3.php' ) ) {
			$bethlehem_style = 'bethlehem-style-3';
		} else {
			$bethlehem_style = 'bethlehem-style-1';
		}
		return apply_filters( 'bethlehem_style_class', $bethlehem_style );
	}
}

if( ! function_exists( 'bethlehem_get_header' ) ) {
	function bethlehem_get_header(){
		global $header_style;

		if ( empty( $header_style ) ) {
			$header_style = 'header-1';
		} else if ( is_page_template( array( 'template-homepage-v2.php' ) ) || is_bethlehem_front_page_template( 'template-homepage-v2.php' ) ) {
	 		$header_style = 'header-7';
	 	} else if ( is_page_template( array( 'template-homepage-v3.php' ) ) || is_bethlehem_front_page_template( 'template-homepage-v3.php' ) ) {
	 		$header_style = 'header-6';
	 	}
		
		return apply_filters( 'bethlehem_header_style', $header_style );
	}
}

if( ! function_exists( 'bethlehem_get_footer' ) ) {
	function bethlehem_get_footer(){
		global $footer_style;

		if ( empty( $footer_style ) ) {
			$footer_style = 'footer-1';
		} else if ( is_page_template( array( 'template-homepage-v2.php' ) ) || is_bethlehem_front_page_template( 'template-homepage-v2.php' ) ) {
	 		$footer_style = 'footer-2';
	 	} else if ( is_page_template( array( 'template-homepage-v3.php' ) ) || is_bethlehem_front_page_template( 'template-homepage-v3.php' ) ) {
	 		$footer_style = 'footer-3';
	 	}
	 	
		return apply_filters( 'bethlehem_footer_style', $footer_style );
	}
}

if( ! class_exists( 'SplitMenuWalker' ) ) :
	class SplitMenuWalker extends Walker_Nav_Menu {

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			$attributes = '';

			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			if( 'static_block' == $item->object ){
				$megamenu_item = get_post( $item->object_id );
				$item_output = '<div class="megamenu-content">' . apply_filters( 'the_content', $megamenu_item->post_content ) . '</div>';
			} else {
				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;
			}

			$header = bethlehem_get_header();
			if( $header == 'header-1' && $depth == 0 && in_array( 'split-right', $classes ) ) {
				$output .= '</ul></div><div class="right-nav-menu"><ul class="menu nav-menu">';
			}

			$output .= $indent . '<li' . $id . $class_names .'>';

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a manu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 *
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'manage_options' ) ) {

				extract( $args );

				$fb_output = null;

				if ( $container ) {
					$fb_output = '<' . $container;

					if ( $container_id )
						$fb_output .= ' id="' . $container_id . '"';

					if ( $container_class )
						$fb_output .= ' class="' . $container_class . '"';

					$fb_output .= '>';
				}

				$fb_output .= '<ul';

				if ( $menu_id )
					$fb_output .= ' id="' . $menu_id . '"';

				if ( $menu_class )
					$fb_output .= ' class="' . $menu_class . '"';

				$fb_output .= '>';
				$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
				$fb_output .= '</ul>';

				if ( $container )
					$fb_output .= '</' . $container . '>';

				echo $fb_output;
			}
		}
	}
endif;

if( ! function_exists( 'bethlehem_get_the_content_by_id' ) ) {
	function bethlehem_get_the_content_by_id( $post_id = 0, $more_link_text = null, $stripteaser = false ){
	    global $post;
	    $post = get_post($post_id);
	    setup_postdata( $post, $more_link_text, $stripteaser );
	    $content = get_the_content();
	    wp_reset_postdata( $post );
	    return $content;
	}
}