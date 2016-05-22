<?php
/**
 * bethlehem setup functions
 *
 * @package bethlehem
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

/**
 * Assign the Bethlehem version to a var
 */
$theme 					= wp_get_theme();
$bethlehem_version 		= $theme['Version'];

if ( ! function_exists( 'bethlehem_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bethlehem_setup() {

		/*
		 * Load Localisation files.
		 *
		 * Note: the first-loaded transl
		 ation file overrides any following ones if the same translation is present.
		 */

		// wp-content/languages/themes/bethlehem-it_IT.mo
		load_theme_textdomain( 'bethlehem', trailingslashit( WP_LANG_DIR ) . 'themes/' );

		// wp-content/themes/child-theme-name/languages/it_IT.mo
		load_theme_textdomain( 'bethlehem', get_stylesheet_directory() . '/languages' );

		// wp-content/themes/theme-name/languages/it_IT.mo
		load_theme_textdomain( 'bethlehem', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 560, 320, TRUE );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array( 'primary' => __( 'Primary Menu', 'bethlehem' ) ) );

		/*
		 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'widgets',
		) );

		// Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bethlehem_custom_background_args', array(
			'default-color' => apply_filters( 'bethlehem_default_background_color', 'fcfcfc' ),
			'default-image' => '',
		) ) );

		// Add support for the Site Logo plugin and the site logo functionality in JetPack
		// https://github.com/automattic/site-logo
		// http://jetpack.me/
		add_theme_support( 'site-logo', array( 'size' => 'full' ) );

		// Declare WooCommerce support
		add_theme_support( 'woocommerce' );

		// Declare support for Post formats feature
		add_theme_support( 'post-formats', array(
			'image',
			'gallery',
			'video',
			'audio',
			'quote',
			'link',
			'aside',
			'status'
		) );

		// Declare support for title theme feature
		add_theme_support( 'title-tag' );
	}
endif; // bethlehem_setup

if ( ! function_exists( 'bethlehem_widgets_init' ) ) :
	/**
	 * Register widget area.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	function bethlehem_widgets_init() {

		register_sidebar( array(
			'name'          => __( 'Sidebar', 'bethlehem' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		if( is_woocommerce_activated() ) :
			register_sidebar( array(
				'name'          => __( 'Shop Sidebar', 'bethlehem' ),
				'id'            => 'shop-sidebar-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		endif;

		if( is_events_calendar_activated() ) :
			register_sidebar( array(
				'name'          => __( 'Events Sidebar', 'bethlehem' ),
				'id'            => 'events-sidebar-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		endif;

		if( class_exists( 'Ministries' ) ) :
			register_sidebar( array(
				'name'          => __( 'Ministries Sidebar', 'bethlehem' ),
				'id'            => 'ministries-sidebar-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		endif;

		if( class_exists( 'Sermons' ) ) :
			register_sidebar( array(
				'name'          => __( 'Sermons Sidebar', 'bethlehem' ),
				'id'            => 'sermons-sidebar-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		endif;

		if( class_exists( 'Woothemes_Our_Team' ) ) :
			register_sidebar( array(
				'name'          => __( 'Team Member Sidebar', 'bethlehem' ),
				'id'            => 'team-member-sidebar-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		endif;

		if( class_exists( 'Give' ) ) :
			register_sidebar( array(
				'name'          => __( 'Donation Sidebar', 'bethlehem' ),
				'id'            => 'donation-sidebar-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		endif;

		$footer_widget_regions = apply_filters( 'bethlehem_footer_widget_regions', 4 );

		for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
			register_sidebar( array(
				'name' 				=> sprintf( __( 'Footer %d', 'bethlehem' ), $i ),
				'id' 				=> sprintf( 'footer-%d', $i ),
				'description' 		=> sprintf( __( 'Widgetized Footer Region %d.', 'bethlehem' ), $i ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
				'after_widget' 		=> '</aside>',
				'before_title' 		=> '<h5>',
				'after_title' 		=> '</h5>',
				)
			);
		}
	}
endif;

if ( ! function_exists( 'bethlehem_register_widgets' ) ) :
	/**
	 * Register sidebar widgets.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	function bethlehem_register_widgets() {
		
		include_once get_template_directory() . '/inc/widgets/class-featured-posts-widget.php';
		register_widget( 'Featured_Posts_Widget' );

		include_once get_template_directory() . '/inc/widgets/class-recent-posts-widget.php';
		register_widget( 'Bethlehem_Widget_Recent_Posts' );

		include_once get_template_directory() . '/inc/widgets/widget-custom-post-type-recent-posts.php';
		register_widget( 'Bethlehem_Custom_Post_Type_Widgets_Recent_Posts' );

		include_once get_template_directory() . '/inc/widgets/widget-custom-post-type-archive.php';
		register_widget( 'Bethlehem_Custom_Post_Type_Widgets_Archives' );

		include_once get_template_directory() . '/inc/widgets/widget-custom-post-type-calendar.php';
		register_widget( 'Bethlehem_Custom_Post_Type_Widgets_Calendar' );

		include_once get_template_directory() . '/inc/widgets/widget-custom-post-type-categories.php';
		register_widget( 'Bethlehem_Custom_Post_Type_Widgets_Categories' );

		include_once get_template_directory() . '/inc/widgets/widget-custom-post-type-recent-comments.php';
		register_widget( 'Bethlehem_Custom_Post_Type_Widgets_Recent_Comments' );

		include_once get_template_directory() . '/inc/widgets/widget-custom-post-type-search.php';
		register_widget( 'Bethlehem_Custom_Post_Type_Widgets_Search' );

		include_once get_template_directory() . '/inc/widgets/widget-custom-post-type-tag-cloud.php';
		register_widget( 'Bethlehem_Custom_Post_Type_Widgets_Tag_Cloud' );

		if( class_exists( 'Sermons' ) ) {
			include_once get_template_directory() . '/inc/widgets/class-sermons-recent-posts-widget.php';
			register_widget( 'Bethlehem_Widget_Sermons_Recent_Posts' );
		}

		if ( is_events_calendar_activated() ) {
			include_once get_template_directory() . '/inc/widgets/class-events-sort-by-month-widget.php';
			register_widget( 'Events_Sort_By_Month_Widget' );
		}

		if ( is_give_activated() ) {
			include_once get_template_directory() . '/inc/widgets/class-donations-recent-posts-widget.php';
			register_widget( 'Bethlehem_Widget_Donations_Recent_Posts' );
		}
	}
endif;

if ( ! function_exists( 'bethlehem_fonts_url' ) ) :
	/**
	 * Register Google fonts for Bethlehem.
	 *
	 * @since Twenty Fifteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function bethlehem_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Bitter, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Bitter font: on or off', 'bethlehem' ) ) {
			$fonts[] = 'Bitter:400,400italic,700';
		}

		$fonts = apply_filters( 'bethlehem_google_fonts', $fonts );

		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'bethlehem' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;

if ( ! function_exists( 'bethlehem_colors_url' ) ) :
	/**
	 * Register colors for Bethlehem.
	 */
	function bethlehem_colors_url() {
		$colors_url = get_template_directory_uri() . '/assets/css/yellow.css';

		return apply_filters( 'bethlehem_colors_url', $colors_url );
	}
endif;

if ( ! function_exists( 'bethlehem_scripts' ) ) :
	/**
	 * Enqueue scripts and styles.
	 * @since  1.0.0
	 */
	function bethlehem_scripts() {
		global $bethlehem_version;

		$sticky_header = apply_filters( 'bethlehem_enable_sticky_header', TRUE );
		$scroll_to_top = apply_filters( 'bethlehem_enable_scrollup', TRUE );

		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'bethlehem-fonts', bethlehem_fonts_url(), array(), null );

		wp_enqueue_style( 'bethlehem-style', get_template_directory_uri() . '/style.min.css', '', $bethlehem_version );

		// Add custom color, used in the main stylesheet.
		wp_enqueue_style( 'bethlehem-color', bethlehem_colors_url(), array(), null );

		if ( is_child_theme() ) {
			if( apply_filters( 'bethlehem_load_child_style', TRUE ) ) {
				wp_enqueue_style( 'bethlehem-child-style', get_stylesheet_uri(), '', $bethlehem_version );
			}
		}

		$beth_options = array(
			'should_stick'			=> $sticky_header,
			'should_scroll'			=> $scroll_to_top,
		);

		if( apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
			
			wp_enqueue_script( 'bethlehem-all', get_template_directory_uri() . '/assets/js/bethlehem-all.min.js', array( 'jquery' ), $bethlehem_version, TRUE );

			wp_localize_script( 'bethlehem-all', 'bethlehem_options', $beth_options );
		
		} else {

			if( $sticky_header ) {
				wp_enqueue_script( 'bethlehem-waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array( 'jquery' ), '2.0.3', true );
		    	wp_enqueue_script( 'bethlehem-waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array( 'jquery' ), '2.0.3', true );
			}

			if( $scroll_to_top ) {
				wp_enqueue_script( 'bethlehem-easing', get_template_directory_uri() . '/assets/js/jquery.easing-1.3.min.js', array( 'jquery' ), '1.3', true );
			}

			if( apply_filters( 'bethlehem_enable_echo', TRUE ) ) {
				wp_enqueue_script( 'bethlehem-echo', get_template_directory_uri() . '/assets/js/echo.min.js', array(), '1.6.0', true );
			}

			wp_enqueue_script( 'bethlehem-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20120206', true );

			wp_enqueue_script( 'bethlehem-transition', get_template_directory_uri() . '/assets/js/transition.min.js', array(), '20120206', true );
			wp_enqueue_script( 'bethlehem-modal', get_template_directory_uri() . '/assets/js/modal.min.js', array(), '20120206', true );

			wp_enqueue_script( 'bethlehem-wow', get_template_directory_uri() . '/assets/js/wow.min.js', array(), '1.1.2', true );

			wp_enqueue_script( 'bethlehem-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array( 'jquery' ), $bethlehem_version, true );

			wp_enqueue_script( 'bethlehem-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20130115', true );

			wp_localize_script( 'bethlehem-scripts', 'bethlehem_options', $beth_options );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */

 function bethlehem_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}

	$located = bethlehem_locate_template( $template_name, $template_path, $default_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
		return;
	}

	// Allow 3rd party plugin filter template file from their plugin
	$located = apply_filters( 'bethlehem_get_template', $located, $template_name, $args, $template_path, $default_path );

	do_action( 'bethlehem_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'bethlehem_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function bethlehem_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = 'templates/';
	}

	if ( ! $default_path ) {
		$default_path = 'templates/';
	}

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template ) {
		$template = $default_path . $template_name;
	}

	// Return what we found
	return apply_filters( 'bethlehem_locate_template', $template, $template_name, $template_path );
}
