<?php
/**
 * General functions used to integrate this theme with Bethlehem Extensions.
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !function_exists( 'shortcode_bethlehem_recent_posts_widget' ) ) {
	function shortcode_bethlehem_recent_posts_widget( $atts = array(), $content = null ) {

		$default_atts = array(
			'title'			=> '',
			'pre_title'		=> '',
			'limit'			=> '',
			'type'			=> '',
			'show_date'		=> '',
			'el_class'		=> '',
	    );

	    extract( array_merge( $default_atts, $atts ) );

		$widget = 'Bethlehem_Widget_Recent_Posts';

		$instance = array(
				'title'			=> $title,
				'type'			=> $type,
				'number'		=> $limit,
				'show_date'		=> $show_date,
			);

		$before_widget = '<div class="widget vc_widget_recent_posts ' . esc_attr( $type ) .' '. esc_attr( $el_class ) . '">';
		$after_widget = '</div>';
		if( !empty( $pre_title ) ) {
			$before_title = '<h3 class="pre-title">'.$pre_title.'</h3><h3 class="widget-title">';
			$after_title = '</h3>';
		} else {
			$before_title = '<h3 class="widget-title">';
			$after_title = '</h3>';
		}

		$args = array(
				'before_widget'	 => $before_widget,
				'after_widget'	 => $after_widget,
				'before_title'	 => $before_title,
				'after_title'	 => $after_title
			);

		$output = '';

		ob_start();
		the_widget( $widget, $instance, $args );
		$output .= ob_get_clean();

		return apply_filters( 'shortcode_beth_recent_posts_widget' , $output );
	}
}

if( is_our_team_activated() ) :
	if( !function_exists( 'shortcode_bethlehem_team_members' ) ) {
		function shortcode_bethlehem_team_members( $atts = array(), $content = null ) {

			$default_atts = array(
				'title' => '',
				'type' => '',
				'limit' => 4,
				'orderby' => '',
				'order' => '',
				'category' => 0,
				'el_class' => '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			$args = array(
				'limit' => $limit,
				'orderby' => $orderby,
				'order' => $order,
				'category' => $category,
				'size' => '',
			);

		    $query = array();
		    $query = woothemes_get_our_team( $args );

		    ob_start();
			bethlehem_get_template( 'sections/team-members.php', array( 'query' => $query, 'el_class' => $el_class, 'type' => $type, 'title' => $title ) );
			$output = ob_get_clean();

			wp_reset_postdata();

			return apply_filters( 'shortcode_beth_team_members' , $output );
		}
	}

	if( !function_exists( 'shortcode_bethlehem_our_team_carousel' ) ) {
		function shortcode_bethlehem_our_team_carousel( $atts = array(), $content = null ) {

			$default_atts = array(
				'title' 			=> '',
				'pre_title' 		=> '',
				'limit' 			=> 10,
				'orderby' 			=> '',
				'order' 			=> '',
				'category' 			=> 0,
				'el_class' 			=> '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			$args = array(
				'limit' => $limit,
				'orderby' => $orderby,
				'order' => $order,
				'category' => $category,
				'size' => '',
			);

		    $query = array();
		    $query = woothemes_get_our_team( $args );

			ob_start();
			bethlehem_get_template( 'sections/our-team-carousel.php', array( 'query' => $query, 'el_class' => $el_class, 'pre_title' => $pre_title, 'title' => $title ) );
			$output = ob_get_clean();

			wp_reset_postdata();

			if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
				wp_enqueue_script( 'bethlehem-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
			}

			return apply_filters( 'shortcode_beth_our_team_carousel' , $output );
		}
	}
endif;

if( is_events_calendar_activated() ) :
	if( !function_exists( 'shortcode_bethlehem_events_list_widget' ) ) {
		function shortcode_bethlehem_events_list_widget( $atts = array(), $content = null ) {

			$default_atts = array(
				'title'				 => '',
				'limit'				 => 4,
				'no_upcoming_events' => '',
				'el_class'			 => '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			if( is_events_calendar_pro_activated() ) {
				$widget = 'Tribe__Events__Pro__Advanced_List_Widget';
				$instance = array(
					'title'				 => $title,
					'limit'				 => $limit,
					'no_upcoming_events' => $no_upcoming_events
				);
				if( !empty( $categories) ) {
					$instance['category'] = $categories;
				}
			} else {
				$widget = 'Tribe__Events__List_Widget';
				$instance = array(
					'title'				 => $title,
					'limit'				 => $limit,
					'no_upcoming_events' => $no_upcoming_events
				);
			}

			$before_widget = '<div class="widget vc-tribe-events-list-widget ' . esc_attr( $el_class ) . '">';
			$after_widget = '</div>';
			$before_title = '<h3 class="widget-title">';
			$after_title = '</h3>';

			$args = array(
					'before_widget'	 => $before_widget,
					'after_widget'	 => $after_widget,
					'before_title'	 => $before_title,
					'after_title'	 => $after_title
				);

			$output = '';

			ob_start();
			the_widget( $widget, $instance, $args );
			$output .= ob_get_clean();

			return apply_filters( 'shortcode_beth_events_list_widget' , $output );
		}
	}
	if( !function_exists( 'shortcode_bethlehem_events_venue_locations' ) ) {
		function shortcode_bethlehem_events_venue_locations( $atts = array(), $content = null ) {

			global $wp_query, $post;

			$default_atts = array(
				'title'				 => '',
				'limit'				 => 4,
				'service_time'		 => '',
				'no_upcoming_events' => '',
				'el_class'			 => '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			$output = '';

			ob_start();

			$posts = tribe_get_venues( $no_upcoming_events, $limit, true);

			echo '<div class="vc-events-list-location">';

			if ( !empty($title) ) {
				echo '<h3>'.$title.'</h3>';
			}

			foreach ($posts as $post) {
				// Do we have an address?
				$address = tribe_address_exists() ? '<address class="tribe-events-address">' . tribe_get_full_address() . '</address>' : '';
				$phone = tribe_get_phone();
				$city = tribe_get_city();

				// Do we have a Google Map link to display?
				$gmap_link = tribe_show_google_map_link() ? tribe_get_map_link() : '';
				$gmap_link = apply_filters( 'tribe_event_meta_venue_address_gmap', $gmap_link );

				$view_events = tribe_get_events_link();

				?>
				<div class="event-locations">
					<!-- Venue Image -->
					<?php echo tribe_event_featured_image( get_the_ID(), 'medium', false ); ?>

					<div class="location-content">
						<h4 class="event-title">
							<!-- Venue Title -->
							<a href="<?php echo esc_url( $view_events ); ?>"><?php the_title(); ?></a>
							<!-- Venue Location -->
							<?php if ( ! empty( $city ) ): ?>
								<span class="event-venue"><?php echo $city; ?></span>
							<?php endif; ?>
						</h4>

						<div class="location-meta">
							<!-- Display Address if appropriate -->
							<?php if ( ! empty( $address ) ) : ?>
								<div class="location"><?php echo $address; ?></div>
							<?php endif; ?>

							<!-- Venue Time -->
							<?php if ( ! empty( $service_time ) ): ?>
								<div class="date-time"><?php echo $service_time; ?></div>
							<?php endif ?>

							<!-- Venue Phone -->
							<?php if ( ! empty( $phone ) ): ?>
								<div class="phone"><?php echo $phone; ?></div>
							<?php endif ?>
						</div>

						<div class="event-btns">
							<?php if ( ! empty( $phone ) ): ?>
								<a href="<?php echo esc_url( $gmap_link ); ?>"><?php _e('Map It', 'bethlehem'); ?></a>
							<?php endif ?>
							<a href="<?php echo esc_url( $view_events ); ?>"><?php _e('View Events', 'bethlehem'); ?></a>
						</div>
					</div>
				</div>
				<?php
			}

			echo '</div>';

			$output .= ob_get_clean();

			wp_reset_postdata();

			return apply_filters( 'shortcode_beth_events_list_locations' , $output );
		}
	}
	if( !function_exists( 'shortcode_bethlehem_events_calendar' ) ) {
		function shortcode_bethlehem_events_calendar( $atts = array(), $content = null ) {
			global $wp_query, $post;

			$default_atts = array(
				'title'				 => '',
				'limit'				 => 3,
				'no_upcoming_events' => '',
				'el_class'			 => '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			$output = '';

			ob_start();

			$posts = tribe_get_events( array(
					'eventDisplay'   => 'list',
					'posts_per_page' => $limit
				)
			);

			echo '<div class="vc-events-calendar">';
				echo '<div class="events-lists">';
					echo '<h2>'.$title.'</h2>';
					foreach ($posts as $post) {
						setup_postdata( $post );
						?>
						<div class="events-list-content">
							<?php echo tribe_event_featured_image( get_the_ID(), 'thumbnail', true ); ?>
							<div class="event-info">
								<h4 class="entry-title summary"><a href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
								<p><?php echo custom_excerpt( get_the_content(), 15 ); ?></p>
								<div class="event-date"><?php echo tribe_get_start_date( get_the_ID(), true, tribe_get_datetime_format( true )); ?></div>
								<?php bethlehem_get_event_categories(); ?>
							</div>
						</div>
						<?php
						wp_reset_postdata();
					}
				echo '</div>';
				echo '<div class="events-calendar">';
					get_events_calendar();
					echo '<a class="hb-more-button" href="'.esc_url( add_query_arg( array( 'eventDisplay' => 'month' ),  tribe_get_events_link() ) ).'"><i class="fa fa-long-arrow-right"></i>'.__( 'Full Calendar', 'bethlehem' ).'</a>';
				echo '</div>';
			echo '</div>';

			$output .= ob_get_clean();

			wp_reset_postdata();

			return apply_filters( 'shortcode_beth_events_calendar' , $output );
		}
	}
endif;

if( is_testimonials_activated() ) :
	if( !function_exists( 'shortcode_bethlehem_testimonials_carousel' ) ) {
		function shortcode_bethlehem_testimonials_carousel( $atts = array(), $content = null ) {

			$default_atts = array(
				'limit' => 5,
				'orderby' => '',
				'order' => '',
				'category' => 0,
				'el_class' => '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			$args = array(
				'limit' => $limit,
				'orderby' => $orderby,
				'order' => $order,
				'category' => $category,
				'size' => '',
			);

			$query = array();
			$query = woothemes_get_testimonials( $args );

			ob_start();
			bethlehem_get_template( 'sections/testimonials-carousel.php', array( 'query' => $query, 'el_class' => $el_class ) );
			$output = ob_get_clean();

			wp_reset_postdata();

			if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
				wp_enqueue_script( 'bethlehem-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
			}

			return apply_filters( 'shortcode_beth_testimonials_carousel' , $output );
		}
	}
endif;

if( class_exists( 'Sermons' ) ) :
	if( ! function_exists( 'shortcode_bethlehem_sermons_media' ) ) {
		function shortcode_bethlehem_sermons_media( $atts = array(), $content = null ) {

			$default_atts = array(
				'title' 			=> '',
				'pre_title' 		=> '',
				'embeded_content'	=> '',
				'link'				=> '',
				'el_class' 			=> '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			ob_start();
			bethlehem_get_template( 'sections/sermons-media.php', array( 'embeded_content' => $embeded_content, 'el_class' => $el_class, 'title' => $title, 'pre_title' => $pre_title, 'link' => $link ) );
			$output = ob_get_clean();

			return apply_filters( 'shortcode_beth_sermons_media' , $output );
		}
	}
	
	if( ! function_exists( 'shortcode_bethlehem_sermons_carousel' ) ) {
		function shortcode_bethlehem_sermons_carousel( $atts = array(), $content = null ) {

			$default_atts = array(
				'title' 			=> '',
				'limit' 			=> 4,
				'type'				=> 'type-1',
				'bg_img'			=> '',
				'archive_link_text' => '',
				'orderby' 			=> '',
				'order' 			=> '',
				'category' 			=> 0,
				'el_class' 			=> '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			$post_type = 'sermons';

			$args = array(
				'posts_per_page' 	=> $limit,
				'orderby' 			=> $orderby,
				'order' 			=> $order,
				'post_type' 		=> $post_type,
			);

			if( $category != 0 ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'sermons-category',
						'field'    => 'term_id',
						'terms'    => explode( ",", $category ),
						'operator' => 'IN',
					),
				);
			}

			$query = new WP_Query( $args );

			$img_src = '';
			
			if ( !empty($bg_img) ) {
				$img_src_arr = wp_get_attachment_image_src( $bg_img, 'full', false );
				$img_src = $img_src_arr[0];
			}

			$style = '';
			if ( $img_src != '' ) {
				$background_style = 'background:rgba(0, 0, 0, 0) url(' . esc_url( $img_src ) . ') no-repeat fixed center center; background-size: cover';
				$style = 'style="' . esc_attr( $background_style ) . '"';
			}

			ob_start();
			if( $type == 'type-2' ) {
				bethlehem_get_template( 'sections/sermons-carousel-2.php', array( 'query' => $query, 'el_class' => $el_class, 'style' => $style, 'title' => $title, 'archive_link_text' => $archive_link_text ) );
			} else {
				bethlehem_get_template( 'sections/sermons-carousel-1.php', array( 'query' => $query, 'el_class' => $el_class, 'style' => $style, 'title' => $title, 'archive_link_text' => $archive_link_text ) );
			}
			$output = ob_get_clean();

			wp_reset_postdata();

			if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
				wp_enqueue_script( 'bethlehem-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
			}

			return apply_filters( 'shortcode_beth_sermons_carousel' , $output );
		}
	}
endif;

if( class_exists( 'Stories' ) ) :
	if( !function_exists( 'shortcode_bethlehem_stories_carousel' ) ) {
		function shortcode_bethlehem_stories_carousel( $atts = array(), $content = null ) {
			$default_atts = array(
				'limit' 			=> 8,
				'archive_link_text'	=> '',
				'orderby' 			=> '',
				'order' 			=> '',
				'bg_img' 			=> '',
				'el_class' 			=> '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			$post_type = 'stories';

			$args = array(
				'posts_per_page' 		=> $limit,
				'orderby' 				=> $orderby,
				'order' 				=> $order,
				'post_type' 			=> $post_type,
				'no_found_rows' 		=> true,
				'post_status' 			=> 'publish',
				'ignore_sticky_posts' 	=> true
			);

			$query = new WP_Query( $args );

			$img_src = '';
			if ( !empty($bg_img) ) {
				$img_src_arr = wp_get_attachment_image_src( $bg_img, 'full', false );
				$img_src = $img_src_arr[0];
			}

			$style = '';
			if ( $img_src != '' ) {
				$background_style = 'background:rgba(0, 0, 0, 0) url(' . esc_url( $img_src ) . ') no-repeat fixed center center; background-size: cover;';
				$style = 'style="' . esc_attr( $background_style ) . '"';
			}

			ob_start();
			bethlehem_get_template( 'sections/stories-carousel.php', array( 'query' => $query, 'el_class' => $el_class, 'style' => $style, 'archive_link_text' => $archive_link_text ) );
			$output = ob_get_clean();

			wp_reset_postdata();

			if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
				wp_enqueue_script( 'bethlehem-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
			}

			return apply_filters( 'shortcode_beth_stories_carousel' , $output );
		}
	}
endif;

if ( is_give_activated() ) :
	if( !function_exists( 'shortcode_bethlehem_donation_carousel' ) ) {
		function shortcode_bethlehem_donation_carousel( $atts = array(), $content = null ) {

			$default_atts = array(
				'limit' 	=> 8,
				'orderby' 	=> '',
				'order' 	=> '',
				'bg_img' 	=> '',
				'el_class' 	=> '',
		    );

		    extract( array_merge( $default_atts, $atts ) );

			$post_type = 'give_forms';

			$args = array(
				'posts_per_page' 		=> $limit,
				'orderby' 				=> $orderby,
				'order' 				=> $order,
				'post_type' 			=> $post_type,
				'no_found_rows' 		=> true,
				'post_status' 			=> 'publish',
				'ignore_sticky_posts' 	=> true
			);

			$query = new WP_Query( $args );

			$img_src = '';
			if ( !empty($bg_img) ) {
				$img_src_arr = wp_get_attachment_image_src( $bg_img, 'full', false );
				$img_src = $img_src_arr[0];
			}

			$style = '';
			if ( $img_src != '' ) {
				$background_style = 'background:rgba(0, 0, 0, 0) url(' . esc_url( $img_src ) . ') no-repeat center center; background-size: cover; background-attachment: fixed;';
				$style = 'style="' . esc_attr( $background_style ) . '"';
			}

			ob_start();
			bethlehem_get_template( 'sections/donation-carousel.php', array( 'query' => $query, 'el_class' => $el_class, 'style' => $style ) );
			$output = ob_get_clean();

			wp_reset_postdata();

			if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
				wp_enqueue_script( 'bethlehem-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
			}

			return apply_filters( 'shortcode_beth_donation_carousel' , $output );
		}
	}
endif;

if ( is_wp_tiles_activated() ) :
	if( !function_exists( 'shortcode_bethlehem_tiled_gallery' ) ) {
		function shortcode_bethlehem_tiled_gallery( $atts = array(), $content = null ) {

			$default_atts = array(
				'title'				=> '',
		        'pretitle'			=> '',
		        'content'			=> '',
		        'post_types'		=> '',
		        'orderby'			=> '',
		        'order'				=> '',
		        'tax_term'			=> false,
		        'taxonomy'			=> false,
		        'limit'				=> '',
		        'grid'				=> '',
		        'padding'			=> '',
		        'pagination'		=> '',
		        'byline_template'	=> '',
		        'byline_opacity'	=> '',
		        'byline_color'		=> '',
		        'el_class'			=> '',
		    );

			extract( array_merge( $default_atts, $atts ) );

			$shortcode = '[wp-tiles post_type='.$post_types.' posts_per_page='.$limit.' orderby='.$orderby.' order='.$order.' tax_term='.$tax_term.' taxonomy='.$taxonomy.' grids='.$grid.' padding='.$padding.' pagination='.$pagination.' byline_template='.$byline_template.' byline_opacity='.$byline_opacity.' byline_color='.$byline_color.' ]';
         
			$output = '';
			ob_start();
			bethlehem_get_template( 'sections/tiled-gallery.php', array( 'title' => $title, 'pretitle' => $pretitle, 'content' => $content, 'shortcode' => $shortcode, 'el_class' => $el_class ) );
		    $output = ob_get_clean();

		    return apply_filters( 'shortcode_beth_tiled_gallery' , $output );
		}
	}
endif;

if( !function_exists( 'shortcode_bethlehem_images_carousel' ) ) {
	function shortcode_bethlehem_images_carousel( $atts = array(), $content = null ) {
		$default_atts = array(
			'title'					=> '',
	    	'pre_title'				=> '',
			'link'					=> '',
			'el_class'				=> '',
			'image_ids'				=> '',
	    );

	    extract( array_merge( $default_atts, $atts ) );

	    $output = '';
		ob_start();
		bethlehem_get_template( 'sections/images-carousel.php', array( 'title' => $title, 'pre_title' => $pre_title, 'image_ids' => $image_ids, 'link' => $link, 'el_class' => $el_class ) );
	    $output = ob_get_clean();

	    if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
	    	wp_enqueue_script( 'bethlehem-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
	    	wp_enqueue_script( 'bethlehem-prettyPhoto-js', get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.min.js', array( 'jquery' ), '3.1.6', true );
	    }
	    wp_enqueue_style( 'bethlehem-prettyPhoto-css', get_template_directory_uri() . '/assets/css/prettyPhoto.css', array(), null );

	    return apply_filters( 'shortcode_beth_images_carousel' , $output );
	}
}
