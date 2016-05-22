<?php
/**
 * Template functions used for the site header.
 *
 * @package bethlehem
 */

if ( ! function_exists( 'bethlehem_get_header_template' ) ) {
	/**
	 * Locate Header Templates
	 * @since  1.0.0
	 */
	function bethlehem_get_header_template() {
		$header = bethlehem_get_header();

		switch ( $header ) {
			case 'header-8':
				bethlehem_get_template( 'headers/header-8.php' );
				break;
			case 'header-7':
				bethlehem_get_template( 'headers/header-7.php' );
				break;
			case 'header-6':
				bethlehem_get_template( 'headers/header-6.php' );
				break;
			case 'header-5':
				bethlehem_get_template( 'headers/header-5.php' );
				break;
			case 'header-4':
				bethlehem_get_template( 'headers/header-4.php' );
				break;
			case 'header-3':
				bethlehem_get_template( 'headers/header-3.php' );
				break;
			case 'header-2':
				bethlehem_get_template( 'headers/header-2.php' );
				break;
			case 'header-1':
				bethlehem_get_template( 'headers/header-1.php' );
				break;
			default:
				bethlehem_get_template( 'headers/header-1.php' );
				break;
		}
	}
}

if ( ! function_exists( 'bethlehem_header_content' ) ) {
	function bethlehem_header_content() {

		global $bethlehem_page_metabox;

		if( ! is_page_template( array( 'template-homepage.php', 'template-homepage-v2.php' ) ) ) {
			if( is_page() && method_exists( $bethlehem_page_metabox, 'get_the_value' ) ) {
				$static_block_ID = $bethlehem_page_metabox->get_the_value( 'header_content_static_block_ID' );
				if( !empty( $static_block_ID ) && $static_block_ID != 0 ) {
					$content = bethlehem_get_the_content_by_id( $static_block_ID );
					if( !empty( $content ) ) {
						$content = apply_filters('the_content', $content );
						echo '<div class="header-content">' . $content . '</div>';
					}
				}
			} else {

				if( is_woocommerce_activated() ){
					bethlehem_breadcrumb();
				}

				bethlehem_page_title();
			}
		}
	}
}

if ( ! function_exists( 'bethlehem_site_branding' ) ) {
	/**
	 * Display Site Branding
	 * @since  1.0.0
	 * @return void
	 */
	function bethlehem_site_branding() {
		ob_start();
		if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} else {
			bethlehem_get_template( 'sections/bethlehem-logo.php' );
		}
		$site_logo = ob_get_clean();
		$site_logo = apply_filters( 'bethlehem_site_logo', $site_logo );
		echo sprintf( '<div class="site-branding"><a href="%s" rel="home">%s</a></div>', esc_url( home_url( '/' ) ), $site_logo );
	}
}

if ( ! function_exists( 'bethlehem_site_favicon' ) ) {
	/**
	 * Adds Favicon for website
	 * @since 1.0.0
	 * @return void
	 */
	function bethlehem_site_favicon() {
		$favicon_url = apply_filters( 'bethlehem_site_favicon_url', get_template_directory_uri() . '/assets/images/favicon.png' );
		echo '<link rel="shortcut icon" href="' .esc_url( $favicon_url ). '">';
	}
}

if ( ! function_exists( 'bethlehem_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function bethlehem_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" aria-label="<?php _e( 'Primary Navigation', 'bethlehem' ); ?>">
		<button class="menu-toggle"><?php echo esc_attr( apply_filters( 'bethlehem_menu_toggle_text', __( 'Navigation', 'bethlehem' ) ) ); ?></button>
			<?php
				$container_class = 'primary-navigation';
				if( apply_filters( 'bethlehem_nav_menu_dropdown_animation', 'none' ) != 'none' ) {
					$container_class = 'primary-navigation animate-dropdown';
				}
				wp_nav_menu(
					array(
						'theme_location'	=> 'primary',
						'container_class'	=> $container_class,
						'items_wrap'		=> '<div class="left-nav-menu"><ul class="%2$s">%3$s</ul></div>',
						'walker'			=> new SplitMenuWalker() ,
						'fallback_cb'		=> 'SplitMenuWalker::fallback',
					)
				);
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'bethlehem_skip_links' ) ) {
	/**
	 * Skip links
	 * @since 1.0.0
	 * @return void
	 */
	function bethlehem_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#site-navigation"><?php _e( 'Skip to navigation', 'bethlehem' ); ?></a>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'bethlehem' ); ?></a>
		<?php
	}
}

if( ! function_exists( 'bethlehem_get_header_image' ) ) {
	/**
	 * Display the header image
	 * @since 1.0.0
	 * @return void
	 */
	function bethlehem_get_header_image() {

		global $post;

		$header_image = apply_filters( 'bethlehem_default_header_image', '' );

		if( ! is_front_page() ) {

			$header_image_width = 1920;

			if( $post ){
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) );

				if ( is_page() && has_post_thumbnail( $post->ID ) && $image[1] >= $header_image_width ) :
					// Houston, we have a new header image!
					$header_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),  array( $header_image_width, $header_image_width ) );
					$header_image = $header_image_url[0];
				endif;
			}
		}

		return $header_image;
	}
}

if( ! function_exists( 'bethlehem_page_title' ) ) {
	/**
	 * Returns the title of the page
	 * @since 1.0.0
	 * @return void
	 */
	function bethlehem_page_title() {
		if( apply_filters( 'bethlehem_enable_page_title', true ) ) {
			global $post;

			$page_title = '';

			$give_taxonomies = get_object_taxonomies( 'give_forms' );
			
			if ( is_front_page() && is_home() ) {
			  // Default homepage
			} elseif ( is_front_page() ) {
			  // static homepage
			} elseif ( is_woocommerce_activated() && is_woocommerce() ) {
	  			$page_title = __( 'Shop', 'bethlehem' );
			} elseif( is_post_type_archive( 'ministries' ) || is_singular( 'ministries' ) || is_tax( get_object_taxonomies( 'ministries' ) ) ) {
	  			$page_title = __( 'Ministries', 'bethlehem' );
	  		} elseif( is_post_type_archive( 'sermons' ) || is_singular( 'sermons' ) || is_tax( get_object_taxonomies( 'sermons' ) ) ) {
	  			$page_title = __( 'Sermons', 'bethlehem' );
	  		} elseif( is_post_type_archive( 'give_forms' ) || is_singular( 'give_forms' ) || ( !empty( $give_taxonomies ) && is_tax( $give_taxonomies ) ) ) {
	  			$page_title = __( 'Causes', 'bethlehem' );
	  		} elseif( is_post_type_archive( 'stories' ) || is_singular( 'stories' ) || is_tax( get_object_taxonomies( 'stories' ) ) ) {
	  			$page_title = __( 'Stories', 'bethlehem' );
	  		} elseif( is_post_type_archive( 'team-member' ) || is_singular( 'team-member' ) || is_tax( get_object_taxonomies( 'team-member' ) ) ) {
	  			$page_title = __( 'People', 'bethlehem' );
	  		} elseif( is_events_calendar_activated() && ( tribe_is_event() || tribe_is_event_category() || tribe_is_view() || is_singular( 'tribe_events' ) ) ) {
	  			$page_title = __( 'Events', 'bethlehem' );
	  		} elseif ( is_page() ) {
		  		$page_title = '';
	  		} elseif ( is_home() ) {
		  		$page_title = __( 'Blog', 'bethlehem' );
	  		} elseif ( is_category() ) {
		  		$page_title = __( 'Blog', 'bethlehem' );
	  		} elseif ( is_singular() ) {
		  		$page_title = __( 'Blog', 'bethlehem' );
	  		} else {
				//$page_title = $post->post_title;
			}
			?>
			<div class="site-page-title">
				<h1><?php echo $page_title; ?></h1>
			</div><!-- /.site-page-title -->
			<?php
		}
	}
}

if ( ! function_exists( 'bethlehem_navigation_links' ) ) {
	function bethlehem_navigation_links() {
		$btn_args = bethlehem_header_navbar_link_args();
		?>
		<div class="top-nav-links">
			<?php if( is_array( $btn_args ) && ! empty( $btn_args ) ) : ?>
				<ul>
					<?php foreach ( $btn_args as $btn ) : ?>
						<li>
							<?php
								$class = isset( $btn['class'] ) ? $btn['class'] : '';
								$link = isset( $btn['link'] ) ? $btn['link'] : '#';
								$icon = isset( $btn['icon'] ) ? $btn['icon'] : '';
								$title = isset( $btn['title'] ) ? $btn['title'] : '';
							?>
							<a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $link ); ?>">
								<i class="<?php echo esc_attr( $icon ); ?>"></i>
								<?php echo esc_html( $title ) ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php
	}
}

if( ! function_exists( 'bethlehem_header_navbar_link_args' ) ) {
	function bethlehem_header_navbar_link_args() {
		$args = array();
		$header = bethlehem_get_header();

		if( $header == 'header-7' ) {
			$args = array(
				array(
					'title'	=> esc_html__( 'Calendar', 'bethlehem' ),
					'link'	=> tribe_get_events_link(),
					'icon'	=> 'fa fa-calendar',
					'class'	=> 'events-link',
				),
				array(
					'title'	=> esc_html__( 'Media', 'bethlehem' ),
					'link'	=> get_post_type_archive_link( 'sermons' ),
					'icon'	=> 'fa fa-youtube-play',
					'class'	=> 'sermons-link',
				),
				array(
					'title'	=> esc_html__( 'Give Online', 'bethlehem' ),
					'link'	=> get_post_type_archive_link( 'give_forms' ),
					'icon'	=> 'fa fa-heart-o',
					'class'	=> 'donations-link',
				)
			);
		} elseif( $header == 'header-3' || $header == 'header-4' || $header == 'header-5' || $header == 'header-6' ) {
			$args = array(
				array(
					'title'	=> esc_html__( 'Donate Now', 'bethlehem' ),
					'link'	=> get_post_type_archive_link( 'give_forms' ),
					'icon'	=> '',
					'class'	=> 'btn donate-btn',
				)
			);
		}

		return apply_filters( 'bethlehem_header_navbar_link_args', $args );
	}
}

if ( ! function_exists( 'bethlehem_event_time' ) ) {
	function bethlehem_event_time() {
		if( apply_filters( 'bethlehem_header_event_time', TRUE ) ) :
			$posts = tribe_get_events(
				apply_filters(
					'events_countdown_widget_query_args', array(
						'eventDisplay'   => 'list',
						'posts_per_page' => 3
					)
				)
			);

			if ( ! $posts ) {
				return;
			}

			$gmt_offset = ( get_option( 'gmt_offset' ) >= '0' ) ? ' +' . get_option( 'gmt_offset' ) : " " . get_option( 'gmt_offset' );
			$gmt_offset = str_replace( array( '.25', '.5', '.75' ), array( ':15', ':30', ':45' ), $gmt_offset );

			foreach ( $posts as $post ) {
				$post_id = $post->ID;

				if ( strtotime( tribe_get_start_date( $post_id, false, 'Y-m-d G:i' ) . $gmt_offset ) >= time() ) {
					break;
				}
			}
			$start_datetime = tribe_get_start_date( $post_id, true, 'F d, Y h:i a' );
			?>
			<div class="bethlehem-counter">
				<h3 class="counter-title"><?php echo apply_filters( 'events_countdown_widget_title', __( 'Next event starts in:', 'bethlehem' ) ); ?></h3>
				<span class="counter-start-time" style="display:none;"><?php echo $start_datetime; ?></span>
				<ul>
					<li><span class="days"></span><?php echo __( 'dys', 'bethlehem' ); ?></li>
					<li><span class="hours"></span><?php echo __( 'hrs', 'bethlehem' ); ?></li>
					<li><span class="minutes"></span><?php echo __( 'mins', 'bethlehem' ); ?></li>
					<li><span class="seconds"></span><?php echo __( 'secs', 'bethlehem' ); ?></li>
				</ul>
			</div>
			<script type="text/javascript">
				(function ($) {
					$(document).ready( function(){
						var countdownTimer = setInterval( function(){

							var currenttime = new Date();
							var eventtime = $('.bethlehem-counter .counter-start-time').text();
							
							eventtime = Date.parse(eventtime);
							eventtime = new Date(eventtime);

							if (eventtime > currenttime) {
								var currenttime_ms = currenttime.getTime();
								var eventtime_ms = eventtime.getTime();

								var difference_ms = eventtime_ms - currenttime_ms;
								var difference_sec = difference_ms/1000;
								var difference_min = difference_sec/60;
								var difference_hs = difference_min/60;

								var seconds = Math.floor(difference_sec % 60);
								var minutes = Math.floor(difference_min % 60);
								var hours = Math.floor(difference_hs % 24);
								var days = Math.floor(difference_hs/24);

								$('.bethlehem-counter ul > li > .days').html(days);
								$('.bethlehem-counter ul > li > .hours').html(hours);
								$('.bethlehem-counter ul > li > .minutes').html(minutes);
								$('.bethlehem-counter ul > li > .seconds').html(seconds);
							}
						}, 1000);
					})
				}(jQuery));
			</script>
			<?php
		endif;
	}
}

if ( ! function_exists( 'bethlehem_search_widget' ) ) {
	function bethlehem_search_widget() {
		$before_widget = '<div class="widget header_widget_search">';
		$after_widget = '</div>';

		$args = array(
			'before_widget'	 => $before_widget,
			'after_widget'	 => $after_widget,
		);

		the_widget( 'WP_Widget_Search', '', $args );
	}
}

if ( ! function_exists( 'bethlehem_header_contact_info' ) ) {
	function bethlehem_header_contact_info() {
		ob_start();
		?>
		<div class="header-contact-info">
		    <div class="mail">
		        <i class="fa fa-envelope"></i> <?php echo "contact@support.com"; ?>
		    </div>
		    <div class="phone">
		        <i class="fa fa-phone"></i> <?php echo "(+800) 123 456 7890"; ?>
		    </div>
		</div><!-- /.contact-row -->
		<?php
		$contact_info = ob_get_clean();
		echo apply_filters( 'bethlehem_header_contact_info', $contact_info );
	}
}
