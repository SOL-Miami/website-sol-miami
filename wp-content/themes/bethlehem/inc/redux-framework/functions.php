<?php

#-----------------------------------------------------------------
# Setup
#-----------------------------------------------------------------

function redux_queue_font_awesome() {
    wp_register_style(
		'redux-font-awesome',
		get_template_directory_uri() . '/assets/css/font-awesome.min.css',
		array(),
		time(),
		'all'
    );
    wp_enqueue_style( 'redux-font-awesome' );
}

function redux_remove_demo_mode() { // Be sure to rename this function to something more unique
    remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
}

function redux_get_all_stories() {
	$stories_options = array();

	$args = array(
		'posts_per_page'	=> -1,
		'orderby'			=> 'id',
		'post_type'			=> 'stories',
	);
	$stories = get_posts( $args );
	if( !empty( $stories ) ) :
		foreach( $stories as $story ) :
			$stories_options[$story->ID] = get_the_title( $story->ID );
		endforeach;
	endif;

	return $stories_options;
}

function redux_get_product_attr_taxonomies() {
	if( function_exists( 'bethlehem_get_product_attr_taxonomies' ) ) {
		return bethlehem_get_product_attr_taxonomies();
	}
}

function redux_get_all_rev_sliders() {
	$revsliders = array();

	if ( class_exists( 'RevSlider' ) ) {
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();

		if ( $arrSliders ) {
			foreach ( $arrSliders as $slider ) {
				/** @var $slider RevSlider */
				$revsliders[ $slider->getAlias() ] = $slider->getTitle();
			}
		}
	}

	return $revsliders;
}

#-----------------------------------------------------------------
# General
#-----------------------------------------------------------------

function redux_apply_favicon( $favicon_url ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['favicon']['url'] ) ) {
		$favicon_url = $bethlehem_options['favicon']['url'];
	}

	return $favicon_url;
}

function redux_apply_logo( $logo ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['use_text_logo'] ) && $bethlehem_options['use_text_logo'] == '1' ) :
		$logo = '<h1 class="site-title">'. $bethlehem_options['logo_text']. '</h1>';
	elseif( !empty( $bethlehem_options['site_logo']['url'] ) ) :
		$bethlehem_site_logo = $bethlehem_options['site_logo'];
		$logo = '<img src="' .esc_url( $bethlehem_site_logo['url'] ). '" class="img-responsive" alt="logo" width="' .esc_attr( $bethlehem_site_logo['width'] ). '" height="' .esc_attr( $bethlehem_site_logo['height'] ). '"/>';
	endif;

	return $logo;
}

function redux_toggle_scrollup( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['enable_scroll_to_top'] ) ) {
		if( $bethlehem_options['enable_scroll_to_top'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

#-----------------------------------------------------------------
# Header
#-----------------------------------------------------------------

function redux_apply_enable_home_page_slider( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['enable_home_page_rev_slider'] ) ) {
		if( $bethlehem_options['enable_home_page_rev_slider'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_apply_home_page_slider( $slider ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['home_page_rev_slider'] ) ) {
		$slider = $bethlehem_options['home_page_rev_slider'];
	}

	return $slider;
}

function redux_apply_header_style( $header_style ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['header_style'] ) ) {
		$header_style = $bethlehem_options['header_style'];
	}

	return $header_style;
}

function redux_sticky_header( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['enable_sticky_header'] ) ) {
		if( $bethlehem_options['enable_sticky_header'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_toggle_header_event_time( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['enable_event_countdown'] ) ) {
		if( $bethlehem_options['enable_event_countdown'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_header_contact_info( $info ) {
	global $bethlehem_options;

	if ( isset( $bethlehem_options['header_support_phone'] ) || isset( $bethlehem_options['header_support_email'] ) ) :
		ob_start();
		?>
		<div class="header-contact-info">
		    <?php if( !empty( $bethlehem_options['header_support_email'] ) ) : ?>
		    <div class="mail">
		        <i class="fa fa-envelope"></i> <?php echo $bethlehem_options['header_support_email']; ?>
		    </div>
		    <?php endif; ?>
		    <?php if( !empty( $bethlehem_options['header_support_phone'] ) ) : ?>
		    <div class="phone">
		        <i class="fa fa-phone"></i> <?php echo $bethlehem_options['header_support_phone']; ?>
		    </div>
		    <?php endif; ?>
		</div><!-- /.contact-row -->
		<?php
		$info = ob_get_clean();
	endif;

	return $info;
}

#-----------------------------------------------------------------
# Footer
#-----------------------------------------------------------------

function redux_apply_footer_style( $footer_style ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['footer_style'] ) ) {
		$footer_style = $bethlehem_options['footer_style'];
	}

	return $footer_style;
}

function redux_apply_footer_connect_text( $connect_text ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['footer_connect_text'] ) ) {
		$connect_text = $bethlehem_options['footer_connect_text'];
	}

	return $connect_text;
}

function redux_apply_footer_copyright_text( $copyright_text ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['footer_copyright_text'] ) ) {
		$copyright_text = $bethlehem_options['footer_copyright_text'];
	}

	return $copyright_text;
}

function redux_apply_footer_contact_info( $contact_info ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['footer_contact_info'] ) ) {
		$contact_info = $bethlehem_options['footer_contact_info'];
	}

	return $contact_info;
}

function redux_apply_footer_contact_info_address( $contact_info_address ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['footer_contact_info_address'] ) ) {
		$contact_info_address = $bethlehem_options['footer_contact_info_address'];
	}

	return $contact_info_address;
}

function redux_apply_footer_contact_info_phone( $contact_info_phone ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['footer_contact_info_phone'] ) ) {
		$contact_info_phone = $bethlehem_options['footer_contact_info_phone'];
	}

	return $contact_info_phone;
}

function redux_apply_footer_contact_info_fax( $contact_info_fax ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['footer_contact_info_fax'] ) ) {
		$contact_info_fax = $bethlehem_options['footer_contact_info_fax'];
	}

	return $contact_info_fax;
}

function redux_apply_footer_link_button( $link_button ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['footer_button_link'] ) && !empty( $bethlehem_options['footer_button_text'] ) ) {
		$link_button = sprintf( '<a class="hb-more-button" href="%s">%s</a>', esc_url( $bethlehem_options['footer_button_link'] ), $bethlehem_options['footer_button_text'] );
	}

	return $link_button;
}

#-----------------------------------------------------------------
# Blog
#-----------------------------------------------------------------

function redux_apply_blog_page_layout( $layout ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['blog_layout'] ) ) {
		$layout = $bethlehem_options['blog_layout'];
	}
	return $layout;
}

function redux_apply_blog_view_style( $view_style ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['blog_style'] ) ) {
		$view_style = $bethlehem_options['blog_style'];
	}
	return $view_style;
}

function redux_apply_post_excerpt_length( $excerpt_length ) {
	global $bethlehem_options;

	if ( isset( $bethlehem_options['force_excerpt'] ) && $bethlehem_options['force_excerpt'] ) {
		if( !empty( $bethlehem_options['excerpt_length'] ) ) {
			$excerpt_length = $bethlehem_options['excerpt_length'];
		}
	}
	return $excerpt_length;
}

#-----------------------------------------------------------------
# Shop : General Settings
#-----------------------------------------------------------------

function redux_is_catalog_mode_disabled() {
	global $bethlehem_options;

	if( isset( $bethlehem_options['catalog_mode'] ) && $bethlehem_options['catalog_mode'] == '1' ) {
		$is_disabled = FALSE;
	} else {
		$is_disabled = TRUE;
	}

	return $is_disabled;
}

function redux_enable_stores_carousel( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['footer_stores_carousel'] ) && $bethlehem_options['footer_stores_carousel'] == '0' ) {
		$enable = FALSE;
	} else {
		$enable = TRUE;
	}

	return $enable;
}

function redux_apply_catalog_mode_for_product_loop( $product_link, $product ) {
	global $bethlehem_options;

	if( ! redux_is_catalog_mode_disabled() ) {
		$product_link = sprintf( '<a href="%s" class="button view_product_button product_type_%s">%s</a>',
			get_permalink( $product->ID ),
			esc_attr( $product->product_type ),
			apply_filters( 'bethlehem_catalog_mode_button_text', __( 'View Product', 'bethlehem' ) )
		);
	}

	return $product_link;
}

function redux_products_per_page( $products_per_page ) {
	global $bethlehem_options;

	if ( !empty( $bethlehem_options['products_per_page'] )) {
		$products_per_page = $bethlehem_options['products_per_page'];
	}
	return $products_per_page;
}

function redux_apply_shop_view( $shop_view ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['remember_user_view'] ) && $bethlehem_options['remember_user_view'] && isset( $_COOKIE['user_shop_view'] ) ){
		$shop_view = $_COOKIE['user_shop_view'];
	} else {
		if( isset( $bethlehem_options['shop_default_view'] ) && !empty( $bethlehem_options['shop_default_view']) ) {
			$shop_view = $bethlehem_options['shop_default_view'];
		}
	}

	return $shop_view;
}

function redux_apply_book_author_attribute( $book_author_attribute ) {
	global $bethlehem_options;

	if ( !empty( $bethlehem_options['book_author_attribute'] )) {
		$book_author_attribute = $bethlehem_options['book_author_attribute'];
	}
	return $book_author_attribute;
}

#-----------------------------------------------------------------
# Shop : Layout Settings
#-----------------------------------------------------------------

function redux_apply_shop_page_layout( $layout ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['shop_page_layout'] ) ) {
		$layout = $bethlehem_options['shop_page_layout'];
	}
	return $layout;
}

function redux_apply_single_product_layout( $layout ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['single_product_layout'] ) ) {
		$layout = $bethlehem_options['single_product_layout'];
	}
	return $layout;
}

#-----------------------------------------------------------------
# Shop : Product Item Settings
#-----------------------------------------------------------------

function redux_apply_products_animation( $aniamtion ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['products_animation'] ) ) {
		$aniamtion = $bethlehem_options['products_animation'];
	}
	return $aniamtion;
}

function redux_toggle_echo( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['enable_lazy_loading'] ) ) {
		$enable = $bethlehem_options['enable_lazy_loading'];
	}

	return $enable;
}

#-----------------------------------------------------------------
# Ministries
#-----------------------------------------------------------------

function redux_apply_ministries_per_page( $per_page ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['ministries_per_page'] ) ) {
		$per_page = $bethlehem_options['ministries_per_page'];
	}
	return $per_page;
}

function redux_apply_ministries_single_layout( $layout ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['ministries_single_layout'] ) ) {
		$layout = $bethlehem_options['ministries_single_layout'];
	}
	return $layout;
}

#-----------------------------------------------------------------
# Sermons
#-----------------------------------------------------------------

function redux_apply_sermons_per_page( $per_page ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['sermons_per_page'] ) ) {
		$per_page = $bethlehem_options['sermons_per_page'];
	}
	return $per_page;
}

function redux_apply_sermons_layout( $layout ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['sermons_layout'] ) ) {
		$layout = $bethlehem_options['sermons_layout'];
	}
	return $layout;
}

function redux_apply_sermons_single_layout( $layout ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['sermons_single_layout'] ) ) {
		$layout = $bethlehem_options['sermons_single_layout'];
	}
	return $layout;
}

#-----------------------------------------------------------------
# Stories
#-----------------------------------------------------------------

function redux_apply_stories_per_page( $per_page ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['stories_per_page'] ) ) {
		$per_page = $bethlehem_options['stories_per_page'];
	}
	return $per_page;
}

function redux_apply_stories_featured_post_args( $featured_post_args ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['stories_featured_post_by_id'] ) && $bethlehem_options['stories_featured_post_by_id'] ) {
		if( !empty( $bethlehem_options['stories_featured_post_id'] ) ) {
			$featured_post_args = array(
				'post_by'	=> 'ids',
				'post_ids'	=> $bethlehem_options['stories_featured_post_id'],
			);
		}
	}
	return $featured_post_args;
}

#-----------------------------------------------------------------
# Donations
#-----------------------------------------------------------------

function redux_apply_give_forms_per_page( $per_page ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['donations_per_page'] ) ) {
		$per_page = $bethlehem_options['donations_per_page'];
	}
	return $per_page;
}

function redux_apply_donations_layout( $layout ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['donations_layout'] ) ) {
		$layout = $bethlehem_options['donations_layout'];
	}
	return $layout;
}

function redux_apply_donations_single_layout( $layout ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['donations_single_layout'] ) ) {
		$layout = $bethlehem_options['donations_single_layout'];
	}
	return $layout;
}

#-----------------------------------------------------------------
# Events
#-----------------------------------------------------------------

function redux_apply_events_layout( $layout ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['events_layout'] ) ) {
		$layout = $bethlehem_options['events_layout'];
	}
	return $layout;
}

function redux_toggle_events_single_contact( $layout ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['events_single_contact'] ) ) {
		if( $bethlehem_options['events_single_contact'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_toggle_events_single_map( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['events_single_map'] ) ) {
		if( $bethlehem_options['events_single_map'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_toggle_events_single_sidebar_widgets( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['events_single_sidebar_widgets'] ) ) {
		if( $bethlehem_options['events_single_sidebar_widgets'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

#-----------------------------------------------------------------
# Team Members
#-----------------------------------------------------------------

function redux_apply_team_members_per_page( $per_page ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['team_members_per_page'] ) ) {
		$per_page = $bethlehem_options['team_members_per_page'];
	}
	return $per_page;
}


function redux_toggle_team_archive_social( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['enable_archive_team_social'] ) ) {
		if( $bethlehem_options['enable_archive_team_social'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

function redux_toggle_team_single_social( $enable ) {
	global $bethlehem_options;

	if( isset( $bethlehem_options['enable_single_team_social'] ) ) {
		if( $bethlehem_options['enable_single_team_social'] == '1' ) {
			$enable = TRUE;
		} else {
			$enable = FALSE;
		}
	}

	return $enable;
}

#-----------------------------------------------------------------
# Social Icons
#-----------------------------------------------------------------

function redux_apply_social_icons_args() {
	global $bethlehem_options;

	$social_icons = array(
		array(
		    'title'     => __('Facebook', 'bethlehem'),
		    'id'        => 'facebook',
		    'class'		=> 'hb-fb',
		    'icon'      => 'fa fa-facebook',
		),

		array(
		    'title'     => __('Twitter', 'bethlehem'),
		    'id'        => 'twitter',
		    'class'		=> 'hb-tw',
		    'icon'      => 'fa fa-twitter',
		),

		array(
		    'title'     => __('Google+', 'bethlehem'),
		    'id'        => 'google-plus',
		    'class'		=> 'hb-google-plus',
		    'icon'      => 'fa fa-google-plus',
		),

		array(
		    'title'     => __('Pinterest', 'bethlehem'),
		    'id'        => 'pinterest',
		    'class'		=> 'hb-pint',
		    'icon'      => 'fa fa-pinterest',
		),

		array(
		    'title'     => __('LinkedIn', 'bethlehem'),
		    'id'        => 'linkedin',
		    'class'		=> 'hb-link',
		    'icon'      => 'fa fa-linkedin',
		),

		array(
		    'title'     => __('RSS', 'bethlehem'),
		    'id'        => 'rss',
		    'class'		=> 'hb-rss',
		    'icon'      => 'fa fa-rss',
		),

		array(
		    'title'     => __('Tumblr', 'bethlehem'),
		    'id'        => 'tumblr',
		    'class'		=> 'hb-tumb',
		    'icon'      => 'fa fa-tumblr',
		),

		array(
		    'title'     => __('Instagram', 'bethlehem'),
		    'id'        => 'instagram',
		    'class'		=> 'hb-ins',
		    'icon'      => 'fa fa-instagram',
		),

		array(
		    'title'     => __('Youtube', 'bethlehem'),
		    'id'        => 'youtube',
		    'class'		=> 'hb-you',
		    'icon'      => 'fa fa-youtube',
		),

		array(
		    'title'     => __('Vimeo', 'bethlehem'),
		    'id'        => 'vimeo',
		    'class'		=> 'hb-vim',
		    'icon'      => 'fa fa-vimeo-square',
		),

		array(
		    'title'     => __('Dribbble', 'bethlehem'),
		    'id'        => 'dribbble',
		    'class'		=> 'hb-drib',
		    'icon'      => 'fa fa-dribbble',
		),

		array(
		    'title'     => __('Stumble Upon', 'bethlehem'),
		    'id'        => 'stumbleupon',
		    'class'		=> 'hb-stum',
		    'icon'      => 'fa fa-stumpleupon',
		),

		array(
		    'title'     => __('Sound Cloud', 'bethlehem'),
		    'id'        => 'soundcloud',
		    'class'		=> 'hb-sound',
		    'icon'      => 'fa fa-soundcloud',
		),

	);

	foreach( $social_icons as $key => $social_icon ) {
		$option_key = $social_icon['id'];

		if( !empty( $bethlehem_options[$option_key] ) ) {
			$social_icons[$key]['link'] = $bethlehem_options[$option_key];
		}
	}

	return $social_icons;
}

#-----------------------------------------------------------------
# Styling
#-----------------------------------------------------------------

function redux_apply_bethlehem_style( $style ) {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['bethlehem_style_class'] ) ) {
		$style = $bethlehem_options['bethlehem_style_class'];
	}
	return $style;
}

function redux_apply_primary_color() {
	global $bethlehem_options;

	if ( isset( $bethlehem_options['use_predefined_color'] ) && ( $bethlehem_options['use_predefined_color'] ) ) {
		$color = ( isset( $bethlehem_options['main_color'] ) ? $bethlehem_options['main_color'] : 'red' );
		return get_template_directory_uri() . '/assets/css/'.$color.'.css';
	} else {
		return get_template_directory_uri() . '/assets/css/custom-color.css';
	}
}

function redux_load_addtional_google_fonts( $fonts ) {
    global $bethlehem_options;

    if( ! empty( $bethlehem_options[ 'bethlehem_style_class' ] ) ) {
        if( $bethlehem_options[ 'bethlehem_style_class' ] == 'bethlehem-style-2' ) {
            /* translators: If there are characters in your language that are not supported by Roboto Condensed, translate this to 'off'. Do not translate into your own language. */
            if ( 'off' !== _x( 'on', 'Roboto Condensed: on or off', 'bethlehem' ) ) {
        		$fonts[] = 'Roboto Condensed:400,300,700';
        	}
        } elseif( $bethlehem_options[ 'bethlehem_style_class' ] == 'bethlehem-style-3' ) {
            /* translators: If there are characters in your language that are not supported by Alegreya, translate this to 'off'. Do not translate into your own language. */
            if ( 'off' !== _x( 'on', 'Alegreya: on or off', 'bethlehem' ) ) {
        		$fonts[] = 'Alegreya:400,400italic,700italic,700';
        	}
            /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
            if ( 'off' !== _x( 'on', 'Montserrat: on or off', 'bethlehem' ) ) {
        		$fonts[] = 'Montserrat:400,700';
        	}
        }
    }

    return $fonts;
}

#-----------------------------------------------------------------
# CUSTOM FONTS
#-----------------------------------------------------------------

function redux_apply_custom_fonts() {
	global $bethlehem_options;

	if ( isset( $bethlehem_options['use_default_font'] ) && ( $bethlehem_options['use_default_font'] == 0 ) ) {
		?>
		<style type="text/css">
			/* Typography */

			h1, .h1,
			h2, .h2,
			h3, .h3,
			h4, .h4,
			h5, .h5,
			h6, .h6{
				font-family: <?php echo $bethlehem_options['title_font']['font-family']; ?> !important;
			}

			body{
				font-family: <?php echo $bethlehem_options['default_font']['font-family']; ?> !important;
			}

			body.bethlehem-style-2, body.bethlehem-style-2 .hb-more-button, body.bethlehem-style-2 .primary-navigation ul.menu>li>a, body.bethlehem-style-2 .top-nav-links ul>li>a, body.bethlehem-style-2 .vc-events-calendar .events-calendar table#wp-calendar caption, body.bethlehem-style-2 button, body.bethlehem-style-2 .bethlehem-counter ul>li, body.bethlehem-style-2 .our-store.type-2 .product-item .actions .button.add_to_cart_button, body.bethlehem-style-2 .our-store.type-2 .product-item .actions .button.view_product_button{
				font-family: <?php echo $bethlehem_options['default_font']['font-family']; ?> !important;
			}

			body.bethlehem-style-3, body.bethlehem-style-3 .hb-more-button, body.bethlehem-style-3 .primary-navigation ul.menu>li>a, body.bethlehem-style-3 .top-nav-links ul>li>a, body.bethlehem-style-3 .vc-events-calendar .events-calendar table#wp-calendar caption, body.bethlehem-style-3 button, body.bethlehem-style-3 .bethlehem-counter ul>li, body.bethlehem-style-3 .our-store.type-2 .product-item .actions .button.add_to_cart_button, body.bethlehem-style-3 .our-store.type-2 .product-item .actions .button.view_product_button{
				font-family: <?php echo $bethlehem_options['default_font']['font-family']; ?> !important;
			}
		</style>
		<?php
	}
}

#-----------------------------------------------------------------
# CUSTOM CODE
#-----------------------------------------------------------------

function redux_apply_custom_css() {
	global $bethlehem_options;

	if ( ( isset( $bethlehem_options['custom_css'] ) ) && ( trim( $bethlehem_options['custom_css'] ) != "" ) ) {
		echo '<style type="text/css">';
			echo $bethlehem_options['custom_css'];
		echo '</style>';
	}
}

function redux_apply_header_js() {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['custom_header_js'] ) ) :
	?>
	<script type="text/javascript"><?php echo $bethlehem_options['custom_header_js']; ?></script>
	<?php
	endif;
}

function redux_apply_footer_js() {
	global $bethlehem_options;

	if( !empty( $bethlehem_options['custom_footer_js'] ) ) :
	?>
	<script type="text/javascript"><?php echo $bethlehem_options['custom_footer_js']; ?></script>
	<?php
	endif;
}
