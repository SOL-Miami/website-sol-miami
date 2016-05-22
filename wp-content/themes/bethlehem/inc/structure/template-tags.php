<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bethlehem
 */

if ( ! function_exists( 'bethlehem_product_categories' ) ) {
	/**
	 * Display Product Categories
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function bethlehem_product_categories( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'bethlehem_product_categories_args', array(
				'limit' 			=> 3,
				'columns' 			=> 3,
				'child_categories' 	=> 0,
				'orderby' 			=> 'name',
				'title'				=> __( 'Product Categories', 'bethlehem' ),
				) );

			echo '<section class="bethlehem-product-section bethlehem-product-categories">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[product_categories number="' . $args['limit'] . '" columns="' . $args['columns'] . '" orderby="' . $args['orderby'] . '" parent="' . $args['child_categories'] . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'bethlehem_recent_products' ) ) {
	/**
	 * Display Recent Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function bethlehem_recent_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'bethlehem_recent_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> __( 'Recent Products', 'bethlehem' ),
				) );

			echo '<section class="bethlehem-product-section bethlehem-recent-products">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[recent_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'bethlehem_featured_products' ) ) {
	/**
	 * Display Featured Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function bethlehem_featured_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'bethlehem_featured_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> __( 'Featured Products', 'bethlehem' ),
				) );

			echo '<section class="bethlehem-product-section bethlehem-featured-products">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[featured_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'bethlehem_popular_products' ) ) {
	/**
	 * Display Popular Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function bethlehem_popular_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'bethlehem_popular_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> __( 'Top Rated Products', 'bethlehem' ),
				) );

			echo '<section class="bethlehem-product-section bethlehem-popular-products">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[top_rated_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'bethlehem_on_sale_products' ) ) {
	/**
	 * Display On Sale Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function bethlehem_on_sale_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'bethlehem_on_sale_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> __( 'On Sale', 'bethlehem' ),
				) );

			echo '<section class="bethlehem-product-section bethlehem-on-sale-products">';

			echo '<h2 class="section-title">' . esc_attr( $args['title'] ) . '</h2>';
			echo do_shortcode( '[sale_products per_page="' . intval( $args['limit'] ) . '" columns="' . intval( $args['columns'] ) . '"]' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'bethlehem_homepage_content' ) ) {
	/**
	 * Display homepage content
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepage_content() {
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/contents/content', 'page' );

		endwhile; // end of the loop.
	}
}

if ( ! function_exists( 'bethlehem_social_icons' ) ) {
	/**
	 * Display social icons
	 * If the subscribe and connect plugin is active, display the icons.
	 * @link http://wordpress.org/plugins/subscribe-and-connect/
	 * @since 1.0.0
	 */
	function bethlehem_social_icons() {

		$social_icons_args = apply_filters( 'bethlehem_social_icons_args', array(
			array(
				'id'		=> 'facebook',
				'title'		=> __( 'Facebook', 'bethlehem' ),
				'class'		=> 'hb-fb',
				'icon'		=> 'fa fa-facebook',
				'link'		=> '#'
			),
			array(
				'id'		=> 'twitter',
				'title'		=> __( 'Twitter', 'bethlehem' ),
				'class'		=> 'hb-tw',
				'icon'		=> 'fa fa-twitter',
				'link'		=> '#'
			),
			array(
				'id'		=> 'google-plus',
				'title'		=> __( 'Google Plus', 'bethlehem' ),
				'class'		=> 'hb-google-plus',
				'icon'		=> 'fa fa-google-plus',
				'link'		=> '#'
			),
		) );
		?>
		<ul class="hb-social">
		<?php  foreach( $social_icons_args as $social_icon ) : ?>
			<?php if( !empty( $social_icon['link'] ) ) : ?>
			<li class="<?php echo esc_attr( $social_icon['class'] ); ?>"><a title="<?php echo esc_attr( $social_icon['title'] );?>" href="<?php echo esc_url( $social_icon['link'] ); ?>"><i class="<?php echo esc_attr( $social_icon['icon'] ); ?>"></i></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ul><!-- /.list-social-icons -->
		<?php
	}
}

if( ! function_exists( 'bethlehem_social_share_icons' ) ) {
	/**
	 * Displays social share icons.
	 */
	function bethlehem_social_share_icons(){
		$share_icons = apply_filters( 'bethlehem_social_share_icons_args', array(
                'facebook'		=> array( 'class' => 'hb-fb', 'icon' => 'fa fa-facebook', 'share_link' => 'https://www.facebook.com/sharer/sharer.php?u=%s' ),
                'twitter'		=> array( 'class' => 'hb-tw', 'icon' => 'fa fa-twitter', 'share_link' => 'https://twitter.com/home?status=%s' ),
                'google_plus'	=> array( 'class' => 'hb-google-plus', 'icon' => 'fa fa-google-plus', 'share_link' => 'https://plus.google.com/share?url=%s' )
            ));
		?>
		<ul class="hb-social">
			<?php foreach ($share_icons as $share_icon) : ?>
					<li class="<?php echo esc_attr( $share_icon['class'] ); ?>"><a href="<?php echo esc_attr( sprintf( $share_icon['share_link'], get_permalink() )); ?>"><i class="<?php echo esc_attr( $share_icon['icon'] ); ?>"></i></a></li>
			<?php endforeach; ?>
		</ul>
		<?php
	}
}

if ( ! function_exists( 'bethlehem_get_sidebar' ) ) {
	/**
	 * Display bethlehem sidebar
	 * @uses get_sidebar()
	 * @since 1.0.0
	 */
	function bethlehem_get_sidebar() {
		$layout = bethlehem_get_layout();
		if( ! ('bethlehem-full-width-content' === $layout || 'page-template-template-fullwidth-php' === $layout ) ) {
			get_sidebar();
		}
	}
}

if ( ! function_exists( 'bethlehem_homepage_blog_element' ) ) {
	/**
	 * Display homepage blog post widget
	 * Hooked into the `homepage` action in the homepage blog post widget
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepage_blog_element() {
		$atts = array(
			'title'			=> '',
			'limit'			=> 4,
			'type'			=> 'type-1',
			'el_class'		=> '',
	    );

		$content = shortcode_bethlehem_recent_posts_widget( $atts );

		echo apply_filters( 'bethlehem_homepage_recent_posts_html', '<div class="wrap">' . $content . '</div>' );
	}
}

if ( ! function_exists( 'bethlehem_homepage_testimonial_element' ) ) {
	/**
	 * Display homepage testimonial element
	 * Hooked into the `homepage` action in the homepage testimonial element
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepage_testimonial_element() {
		$atts = array(
			'title' 		=> '',
			'description' 	=> '',
			'limit' 		=> 10,
			'orderby' 		=> '',
			'order' 		=> '',
			'category' 		=> 0,
			'el_class' 		=> '',
	    );

		$content = shortcode_bethlehem_testimonials_carousel( $atts );

		echo apply_filters( 'bethlehem_homepage_testimonals_carousel_html', '<div class="wrap">' . $content . '</div>' );
	}
}

if ( ! function_exists( 'bethlehem_homepage_donation_element' ) ) {
	/**
	 * Display homepage donation element
	 * Hooked into the `homepage` action in the homepage donation element
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepage_donation_element() {
	    $atts = array(
			'limit' 	=> 8,
			'orderby' 	=> '',
			'order' 	=> '',
			'bg_img' 	=> '',
			'el_class' 	=> '',
	    );

		$content = shortcode_bethlehem_donation_carousel( $atts );

		echo apply_filters( 'bethlehem_homepage_donations_carousel_html', $content );
	}
}

if ( ! function_exists( 'bethlehem_homepage_sermons_element' ) ) {
	/**
	 * Display homepage sermons element
	 * Hooked into the `homepage` action in the homepage sermons element
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepage_sermons_element() {
		$atts = array(
			'title' 			=> __( 'Sermons', 'bethlehem' ),
			'limit' 			=> 4,
			'type'				=> 'type-1',
			'bg_img'			=> '',
			'archive_link_text' => __( 'Archive of Sermons', 'bethlehem' ),
			'orderby' 			=> '',
			'order' 			=> '',
			'category' 			=> 0,
			'el_class' 			=> '',
	    );

		$content = '';
		if( function_exists( 'shortcode_bethlehem_sermons_carousel' ) ) {
			$content = shortcode_bethlehem_sermons_carousel( $atts );
		}

		echo apply_filters( 'bethlehem_homepage_sermons_carousel', $content );
	}
}

if ( ! function_exists( 'bethlehem_homepage_events_list_widget' ) ) {
	/**
	 * Display homepage events list widget
	 * Hooked into the `homepage` action in the homepage events list widget
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepage_events_list_widget() {
		$atts = array(
			'title'				 => '',
			'limit'				 => 3,
			'no_upcoming_events' => '',
			'el_class'			 => '',
	    );

		$content = '';
		if( function_exists( 'shortcode_bethlehem_events_list_widget' ) ) {
			$content = shortcode_bethlehem_events_list_widget( $atts );
		}

		echo apply_filters( 'bethlehem_homepage_events_list_html', $content );
	}
}

if ( ! function_exists( 'bethlehem_homepagev2_events_calendar' ) ) {
	/**
	 * Display homepage events calendar
	 * Hooked into the `homepage_v2` action in the homepage events calendar
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepagev2_events_calendar() {
		$atts = array(
			'title'				 => __( 'Featured Events', 'bethlehem' ),
			'limit'				 => 3,
			'no_upcoming_events' => '',
			'el_class'			 => '',
	    );

		$content = '';
		if( function_exists( 'shortcode_bethlehem_events_calendar' ) ) {
			$content = shortcode_bethlehem_events_calendar( $atts );
		}

		echo apply_filters( 'bethlehem_homepage_events_calendar_html', '<div class="wrap">' . $content . '</div>' );
	}
}

if ( ! function_exists( 'bethlehem_homepagev2_stories_element' ) ) {
	/**
	 * Display homepage stories element
	 * Hooked into the `homepage_v2` action in the homepage stories element
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepagev2_stories_element() {
		$atts = array(
			'limit' 			=> 10,
			'archive_link_text'	=> __( 'Read story', 'bethlehem' ),
			'orderby' 			=> '',
			'order' 			=> '',
			'bg_img' 			=> '',
			'el_class' 			=> '',
	    );

		$content = '';
		if( function_exists( 'shortcode_bethlehem_stories_carousel' ) ) {
			$content = shortcode_bethlehem_stories_carousel( $atts );
		}

		echo apply_filters( 'bethlehem_homepage_stories_element_html', $content );
	}
}

if ( ! function_exists( 'bethlehem_homepagev2_blog_element' ) ) {
	/**
	 * Display homepage blog post widget
	 * Hooked into the `homepage_v2` action in the homepage blog post widget
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepagev2_blog_element() {
		$atts = array(
			'title'			=> __( 'From the blog', 'bethlehem' ),
			'limit'			=> 3,
			'type'			=> 'type-2',
			'el_class'		=> '',
	    );

		$content = '';
		if( function_exists( 'shortcode_bethlehem_recent_posts_widget' ) ) {
			$content = shortcode_bethlehem_recent_posts_widget( $atts );
		}

		echo apply_filters( 'bethlehem_homepagev2_recent_posts_html', '<div class="wrap">' . $content . '</div>' );
	}
}

if ( ! function_exists( 'bethlehem_homepagev2_sermons_element' ) ) {
	/**
	 * Display homepage sermons element
	 * Hooked into the `homepage_v2` action in the homepage sermons element
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepagev2_sermons_element() {
		$atts = array(
			'title' 			=> __( 'Latest Message', 'bethlehem' ),
			'limit' 			=> 10,
			'type'				=> 'type-2',
			'bg_img'			=> '',
			'archive_link_text' => __( 'View Sermons', 'bethlehem' ),
			'orderby' 			=> '',
			'order' 			=> '',
			'category' 			=> 0,
			'el_class' 			=> '',
	    );

		$content = '';
		if( function_exists( 'shortcode_bethlehem_sermons_carousel' ) ) {
			$content = shortcode_bethlehem_sermons_carousel( $atts );
		}

		echo apply_filters( 'bethlehem_homepagev2_sermons_carousel', $content );
	}
}

if ( ! function_exists( 'bethlehem_homepagev2_banner_element1' ) ) {
	function bethlehem_homepagev2_banner_element1() {
		$content = '';

		if ( shortcode_exists( 'bethlehem_banner' ) ) {
			$shortcode_content_html = '';
			$shortcode_content_html .= '<h3>'.__( 'Beth is a church that believes in Jesus, <br>a church that loves God and people.', 'bethlehem' ).'</h3>';
			$shortcode_content_html .= '<p class="banner-content">'.__( 'Nam hendrerit molestie nunc ac venenatis. Donec elit quam, semper at mollis quis, ornare. Nam dui nunc, tinc- idunt quis scelerisque ac, aliquet sit amet turpis. Aliquam vulputate, lacus ac bibendum vehicula, nisi libero fringilla orci.', 'bethlehem' ).'</p>';
			$shortcode_content_html .= '<ul class="list-unstyled">';
			$shortcode_content_html .= '<li><a class="hb-more-button" href="#">'.__( 'I\'m new', 'bethlehem' ).'</a></li>';
			$shortcode_content_html .= '<li><a class="hb-more-button" href="#">'.__( 'meet our pastors', 'bethlehem' ).'</a></li>';
			$shortcode_content_html .= '<li><a class="hb-more-button" href="#">'.__( 'our mission', 'bethlehem' ).'</a></li>';
			$shortcode_content_html .= '</ul>';

			$shortcode_content = apply_filters( 'bethlehem_homev2_banner_element1_content', $shortcode_content_html );
			$shortcode = '[bethlehem_banner type="type-2"]'.$shortcode_content.'[/bethlehem_banner]';
			$content = do_shortcode( $shortcode );
		}
		echo apply_filters( 'bethlehem_homepagev2_banner_element1', $content );
	}
}

if ( ! function_exists( 'bethlehem_homepagev2_banner_element2' ) ) {
	function bethlehem_homepagev2_banner_element2() {
		$content = '';
		
		if ( shortcode_exists( 'bethlehem_banner' ) ) {
			$shortcode_content_html = '';
			$shortcode_content_html .= '<h3>'.__( 'Give Online', 'bethlehem' ).'</h3>';
			$shortcode_content_html .= '<p class="banner-content">'.__( 'Nam hendrerit molestie nunc ac venenatis. Donec elit quam, semper at mollis quis, ornare. Nam dui nunc, tinc- idunt quis scelerisque ac, aliquet sit amet turpis. Aliquam vulputate, lacus ac bibendum vehicula, nisi libero fringilla orci.', 'bethlehem' ).'</p>';
			$shortcode_content_html .= '<ul class="list-unstyled">';
			$shortcode_content_html .= '<li><a class="hb-more-button" href="#">'.__( 'Make Donation', 'bethlehem' ).'</a></li>';
			$shortcode_content_html .= '</ul>';
			$shortcode_content_html .= '<iframe src="https://www.youtube.com/embed/E19MFHRAJB8" frameborder="0" allowfullscreen="allowfullscreen"></iframe>';

			$shortcode_content = apply_filters( 'bethlehem_homev2_banner_element2_content', $shortcode_content_html );
			$shortcode = '[bethlehem_banner type="type-2"]'.$shortcode_content.'[/bethlehem_banner]';
			$content = do_shortcode( $shortcode );
		}
		echo apply_filters( 'bethlehem_homepagev2_banner_element2', $content );
	}
}

if ( ! function_exists( 'bethlehem_homepagev3_blog_element' ) ) {
	/**
	 * Display homepage blog post widget
	 * Hooked into the `homepage_v3` action in the homepage blog post widget
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepagev3_blog_element() {
		$atts = array(
			'title'			=> __( 'The blog', 'bethlehem' ),
			'pre_title'		=> __( 'Read with Love', 'bethlehem' ),
			'limit'			=> 3,
			'type'			=> 'type-3',
			'el_class'		=> '',
	    );

		$content = '';
		if( function_exists( 'shortcode_bethlehem_recent_posts_widget' ) ) {
			$content = shortcode_bethlehem_recent_posts_widget( $atts );
		}

		echo apply_filters( 'bethlehem_homepagev3_recent_posts_html', '<div class="wrap">' . $content . '</div>' );
	}
}

if ( ! function_exists( 'bethlehem_homepagev3_our_team_element' ) ) {
	/**
	 * Display homepage our_team element
	 * Hooked into the `homepage_v3` action in the homepage our_team element
	 * @since  1.0.0
	 * @return  void
	 */
	function bethlehem_homepagev3_our_team_element() {
		$atts = array(
			'title' 			=> __( 'Our Team', 'bethlehem' ),
			'pre_title' 		=> __( 'Meet us', 'bethlehem' ),
			'limit' 			=> 10,
			'orderby' 			=> '',
			'order' 			=> '',
			'category' 			=> 0,
			'el_class' 			=> '',
	    );

		$content = '';
		if( function_exists( 'shortcode_bethlehem_our_team_carousel' ) ) {
			$content = shortcode_bethlehem_our_team_carousel( $atts );
		}

		echo apply_filters( 'bethlehem_homepagev3_our_team_carousel', $content );
	}
}

if ( ! function_exists( 'bethlehem_homepagev3_sermons_media_element' ) ) {
	function bethlehem_homepagev3_sermons_media_element() {
		
		$embeded_content = apply_filters( 'bethlehem_homev3_media_embedded_content', '<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/111921842&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>' );

		$atts = array(
	    	'title'				 => __( 'Latest Sermons', 'bethlehem' ),
			'pre_title'			 => __( 'Listen & Believe', 'bethlehem' ),
			'embeded_content'	 => $embeded_content,
			'link_text'			 => __( 'Browse More', 'bethlehem' ),
			'link'				 => '#',
	    );

	    $content = '';
		if( function_exists( 'shortcode_bethlehem_sermons_media' ) ) {
			$content = shortcode_bethlehem_sermons_media( $atts );
		}

		echo apply_filters( 'bethlehem_homepagev3_sermons_media', $content );
	}
}

if ( ! function_exists( 'bethlehem_homepagev3_map_element' ) ) {
	function bethlehem_homepagev3_map_element() {
		$content = '';

		if ( shortcode_exists( 'vc_gmaps' ) ) {
			$shortcode = '[vc_gmaps el_class="address-map"][/vc_gmaps]';
			$content = do_shortcode( $shortcode );
		}

		echo apply_filters( 'bethlehem_homepagev3_map_element', $content );
	}
}

if( ! function_exists( 'bethlehem_wrapper_start' ) ) {
	/*
	 * Wraps the content with open wrap div
	 */
	function bethlehem_wrapper_start( $content = '' ) {
		return '<div class="wrap">' . $content ;
	}
}

if( ! function_exists( 'bethlehem_wrapper_end' ) ) {
	/*
	 * Wraps the content with close wrap div
	 */
	function bethlehem_wrapper_end( $content = '' ) {
		return $content . '</div><!-- /.wrap -->';
	}
}

if( ! function_exists( 'bethlehem_pre_get_posts' ) ) {
	/*
	 * Pre get posts for pagination
	 */
	function bethlehem_pre_get_posts( $query ) {
		$give_taxonomies = get_object_taxonomies( 'give_forms' );
		
		if ( $query->is_post_type_archive( 'ministries' ) || $query->is_tax( get_object_taxonomies( 'ministries' ) ) ) {
			if( ! isset( $query->query_vars['posts_per_page'] ) ) {
				$query->set( 'posts_per_page', apply_filters( 'ministries_posts_per_page', 10 ) );
			} else {
				return;
			}
		} elseif ( $query->is_post_type_archive( 'sermons' ) || $query->is_tax( get_object_taxonomies( 'sermons' ) ) ) {
			if( ! isset( $query->query_vars['posts_per_page'] ) ) {
				$query->set( 'posts_per_page', apply_filters( 'sermons_posts_per_page', 10 ) );
			} else {
				return;
			}
		} elseif ( $query->is_post_type_archive( 'stories' ) || $query->is_tax( get_object_taxonomies( 'stories' ) ) ) {
			if( ! isset( $query->query_vars['posts_per_page'] ) ) {
				$query->set( 'posts_per_page', apply_filters( 'stories_posts_per_page', 10 ) );
			} else {
				return;
			}
		} elseif ( $query->is_post_type_archive( 'give_forms' ) || ( !empty( $give_taxonomies ) && $query->is_tax( $give_taxonomies ) ) ) {
			if( ! isset( $query->query_vars['posts_per_page'] ) ) {
				$query->set( 'posts_per_page', apply_filters( 'give_forms_posts_per_page', 10 ) );
			} else {
				return;
			}
		} elseif ( $query->is_post_type_archive( 'team-member' ) || $query->is_tax( get_object_taxonomies( 'team-member' ) ) ) {
			if( ! isset( $query->query_vars['posts_per_page'] ) ) {
				$query->set( 'posts_per_page', apply_filters( 'team_members_posts_per_page', 10 ) );
			} else {
				return;
			}
		} else {
			return;
		}
	}
}

if( ! function_exists( 'bethlehem_breadcrumb' ) ) {
	function bethlehem_breadcrumb() {
		if( apply_filters( 'bethlehem_enable_breadcrumb', true ) && is_woocommerce_activated() ) {
			woocommerce_breadcrumb();
		}
	}
}

if( ! function_exists( 'bethlehem_terms_breadcrumb' ) ) {
	function bethlehem_terms_breadcrumb( $args = array() ) {
		$args = wp_parse_args( $args, apply_filters( 'bethlehem_terms_breadcrumb_defaults', array(
            'delimiter'   => '&nbsp;&#47;&nbsp;',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'bethlehem' )
        ) ) );

        $breadcrumbs = new WC_Breadcrumb();

        if ( $args['home'] ) {
            $breadcrumbs->add_crumb( $args['home'], apply_filters( 'bethlehem_terms_breadcrumb_home_url', home_url() ) );
        }

       	$taxonomy_slug = get_query_var( 'taxonomy' );
       	$term_slug = get_query_var( 'term' );
       	$term = get_term_by( 'slug', $term_slug, $taxonomy_slug );
        if ( $term ) {
            $ancestors = get_ancestors( $term->term_id, $term->taxonomy );
			$ancestors = array_reverse( $ancestors );
			foreach ( $ancestors as $ancestor ) {
				$ancestor = get_term( $ancestor, $term->taxonomy );

				if ( ! is_wp_error( $ancestor ) && $ancestor ) {
					$breadcrumbs->add_crumb( $ancestor->name, get_term_link( $ancestor ) );
				}
			}
            $breadcrumbs->add_crumb( $term->name, get_term_link( $term->slug, $term->taxonomy ) );
        }

        $args['breadcrumb'] = $breadcrumbs->generate();

        wc_get_template( 'global/breadcrumb.php', $args );
	}
}