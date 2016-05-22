<?php
/**
 * Template functions used for posts.
 *
 * @package bethlehem
 */

if ( ! function_exists( 'bethlehem_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 * @since 1.0.0
	 */
	function bethlehem_post_header() {
		global $custom_query;

		if ( is_single() ) {
			bethlehem_post_media_attachment( get_the_ID() );
		} else {
			if ( isset( $custom_query->query['blog_style'] ) ) {
				$blog_style = $custom_query->query['blog_style'];
			} else {
				$blog_style = apply_filters( 'bethlehem_blog_view_style', 'normal' );
			}

			do_action( 'bethlehem_loop_post_image_before' );
			if ( $blog_style == 'list-view' || $blog_style == 'grid-view' ) {
				$post_icon = bethlehem_get_post_icon( get_post_format() );
				echo bethlehem_get_thumbnail( get_the_ID(), 'post-thumbnail', TRUE, TRUE, $post_icon );
			} else {
				bethlehem_post_media_attachment( get_the_ID() );
			}
			do_action( 'bethlehem_loop_post_image_after' );
		}
		?>
		<header class="entry-header">
		<?php
		if ( is_single() ) {
			bethlehem_posted_on();
			/**
			 * @hooked bethlehem_post_meta - 10
			 */
			do_action( 'bethlehem_single_post_title_before' );
			the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
			/**
			 * @hooked bethlehem_social_share_icons - 10
			 */
			do_action( 'bethlehem_single_post_title_after' );
		} else {
			if ( 'post' == get_post_type() ) {
				bethlehem_posted_on();
			}

			do_action( 'bethlehem_loop_post_title_before' );
			the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
			do_action( 'bethlehem_loop_post_title_after' );
		}
		?>
		</header><!-- .entry-header -->
		<?php
	}
}

if( ! function_exists( 'bethlehem_post_media_attachment' ) ) {
	/**
	 * Displays the media attachment of the post
	 * @since 1.0.0
	 */
	function bethlehem_post_media_attachment( $show_placeholder = FALSE ) { ?>
		<div class="post-media-attachment">
		<?php

		$post_format = get_post_format();

		if( $post_format == 'gallery' ){
			bethlehem_gallery_slideshow( get_the_ID() );
		}else if ( $post_format == 'video' ){
			bethlehem_video_player( get_the_ID() );
		}else if ( $post_format == 'audio' ){
			bethlehem_audio_player( get_the_ID() );
		}else if ( $post_format == 'image' || has_post_thumbnail() ){
			the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
		} else {
			if( $show_placeholder ) {
				bethlehem_get_thumbnail( get_the_ID(), 'post-thumbnail', TRUE, TRUE );
			}
		}
		?>
		</div><!-- /.post-media-attachment -->
		<?php
	}
}

if( ! function_exists( 'bethlehem_get_post_thumbnail' ) ) {
	/**
	 * Displays the thumbnail for the single post
	 * @since 1.0.0
	 */
	function bethlehem_get_post_thumbnail( $post_id , $size = 'post-thumbnail', $placholder_atts = array() ) {

		if( has_post_thumbnail() ) {
			return get_the_post_thumbnail( $post_id, $size );
		} else {
			return bethlehem_get_img_placeholder( $placholder_atts );
		}
	}
}

if ( ! function_exists( 'bethlehem_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 * @since 1.0.0
	 */
	function bethlehem_post_content() {
		?>
		<div class="entry-content" itemprop="articleBody">
		<?php
		$force_post_excerpts = true;
		// $force_post_excerpts  = $bethlehem_theme_options['force_excerpt'] ; // Bethlehem Theme Options //
		if ( ! is_single() && ( $force_post_excerpts || is_search() ) ) {
			do_action( 'bethlehem_loop_post_content_before' );
			echo apply_filters('bethlehem_loop_post_content', bethlehem_post_excerpt() );
			do_action( 'bethlehem_loop_post_content_after' );
		}
		else {

			do_action( 'bethlehem_single_post_content_before' );
			the_content(
				sprintf(
					__( 'Continue reading %s', 'bethlehem' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				)
			);
			do_action( 'bethlehem_single_post_content_after' );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bethlehem' ),
				'after'  => '</div>',
			) );
		}
		?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'bethlehem_post_meta' ) ) {
	/**
	 * Display the post meta
	 * @since 1.0.0
	 */
	function bethlehem_post_meta() {
		?>

			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'bethlehem' ) );

			if ( $categories_list && bethlehem_categorized_blog() ) : ?>
				<span class="cat-links">
					<?php
					echo '<span class="screen-reader-text">' . esc_attr( __( 'Categories: ', 'bethlehem' ) ) . '</span>';
					echo wp_kses_post( $categories_list );
					?>
				</span>
			<?php endif; // End if categories ?>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'bethlehem' ) );

			if ( $tags_list ) : ?>
				<span class="tags-links">
					<?php
					echo '<span class="screen-reader-text">' . esc_attr( __( 'Tags: ', 'bethlehem' ) ) . '</span>';
					echo wp_kses_post( $tags_list );
					?>
				</span>
			<?php endif; // End if $tags_list ?>

			<?php endif; // End if 'post' == get_post_type() ?>

			<?php if ( is_single() ) : ?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'bethlehem' ), __( '1 Comment', 'bethlehem' ), __( '% Comments', 'bethlehem' ) ); ?></span>
				<?php endif; ?>
			<?php endif; ?>
		<?php
	}
}

if ( ! function_exists( 'bethlehem_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function bethlehem_paging_nav() {
		global $wp_query, $page, $paged;

		$args = array(
			'prev_next'	=> false,
			'type' 		=> 'list',
			);

		if ($wp_query->max_num_pages > 1) {
			echo '<div class="page_result_count">';
				echo sprintf( '%s %d %s %d', __('Page', 'bethlehem'), ( $paged ? $paged : 1 ), __('of', 'bethlehem'),  $wp_query->max_num_pages );
			echo '</div>';
		}

		the_posts_pagination( $args );

		if ($wp_query->max_num_pages > 1) {
			echo '<div class="page_prev_next">';
				posts_nav_link( ' ' );
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'bethlehem_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function bethlehem_post_nav() {
		$args = array(
			'next_text' => '%title &nbsp;<span class="meta-nav">&rarr;</span>',
			'prev_text'	=> '<span class="meta-nav">&larr;</span>&nbsp;%title',
			);
		the_post_navigation( $args );
	}
}

if ( ! function_exists( 'bethlehem_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function bethlehem_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s" itemprop="datePublished">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( '%s', 'post date', 'bethlehem' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			_x( '%s', 'post author', 'bethlehem' ),
			'<span class="vcard author"><span class="fn" itemprop="author"><a class="url fn n" rel="author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>'
		);

		echo apply_filters( 'bethlehem_single_post_posted_on_html', '<span class="posted-on"> ' . $posted_on . '</span>', $posted_on );

	}
}

if ( !function_exists( 'bethlehem_isotope_wrapper_start' ) ) :
	/**
	 * Isotope Wrapper Start
	 */
	function bethlehem_isotope_wrapper_start() {
		global $custom_query;

		if ( isset( $custom_query->query['blog_style'] ) ) {
			$blog_style = $custom_query->query['blog_style'];
		} else {
			$blog_style = apply_filters( 'bethlehem_blog_view_style', 'normal' );
		}

		if ($blog_style == 'grid-view') {
			echo '<div class="masonry-blog" id="portfolio">';
			echo '<div id="folio" class="isotope">';
			echo '<div class="portfolio-inner" >';
		}
	}
endif;

if ( !function_exists( 'bethlehem_isotope_wrapper_end' ) ) :
	/**
	 * Isotope Wrapper End
	 */
	function bethlehem_isotope_wrapper_end() {
			global $custom_query;

			if ( isset( $custom_query->query['blog_style'] ) ) {
				$blog_style = $custom_query->query['blog_style'];
			} else {
				$blog_style = apply_filters( 'bethlehem_blog_view_style', 'normal' );
			}

		if ($blog_style == 'grid-view') {
			echo '</div>';
			echo '</div>';
			echo '</div>';
			if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
				wp_enqueue_script( 'bethlehem-isotope-js', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', array( 'jquery' ), '1.5.21', true );
			}

		}
	}
endif;

if ( !function_exists( 'bethlehem_isotope_item_wrapper_start' ) ) :
	/**
	 * Isotope Wrapper Start
	 */
	function bethlehem_isotope_item_wrapper_start() {
		global $custom_query;

		if ( isset( $custom_query->query['blog_style'] ) ) {
			$blog_style = $custom_query->query['blog_style'];
		} else {
			$blog_style = apply_filters( 'bethlehem_blog_view_style', 'normal' );
		}

		if ($blog_style == 'grid-view') {
			echo '<div class="folio-item">';
		}
	}
endif;

if ( !function_exists( 'bethlehem_isotope_item_wrapper_end' ) ) :
	/**
	 * Isotope Wrapper End
	 */
	function bethlehem_isotope_item_wrapper_end() {
			global $custom_query;

			if ( isset( $custom_query->query['blog_style'] ) ) {
				$blog_style = $custom_query->query['blog_style'];
			} else {
				$blog_style = apply_filters( 'bethlehem_blog_view_style', 'normal' );
			}

		if ($blog_style == 'grid-view') {
			echo '</div>';
		}
	}
endif;

if ( !function_exists( 'bethlehem_listview_wrapper_start' ) ) :
	/**
	 * List View Wrapper Start
	 */
	function bethlehem_listview_wrapper_start() {
		global $custom_query;

		if ( isset( $custom_query->query['blog_style'] ) ) {
			$blog_style = $custom_query->query['blog_style'];
		} else {
			$blog_style = apply_filters( 'bethlehem_blog_view_style', 'normal' );
		}

		if ($blog_style == 'list-view') {
			echo '<div class="list-view-content" >';
		}
	}
endif;

if ( !function_exists( 'bethlehem_listview_img_wrapper_start' ) ) :
	/**
	 * List View Image Wrapper Start
	 */
	function bethlehem_listview_img_wrapper_start() {
		global $custom_query;

		if ( isset( $custom_query->query['blog_style'] ) ) {
			$blog_style = $custom_query->query['blog_style'];
		} else {
			$blog_style = apply_filters( 'bethlehem_blog_view_style', 'normal' );
		}

		if ($blog_style == 'list-view') {
			echo '<div class="list-view-thumbnail" >';
		}
	}
endif;

if ( !function_exists( 'bethlehem_listview_wrapper_end' ) ) :
	/**
	 * List View Wrapper End
	 */
	function bethlehem_listview_wrapper_end() {
		global $custom_query;

		if ( isset( $custom_query->query['blog_style'] ) ) {
			$blog_style = $custom_query->query['blog_style'];
		} else {
			$blog_style = apply_filters( 'bethlehem_blog_view_style', 'normal' );
		}

		if ($blog_style == 'list-view') {
			echo '</div>';
		}
	}
endif;

if ( !function_exists( 'bethlehem_gallery_slideshow' ) ) :
	/**
	 * Output Gallery (slide show) for Post Format.
	 */
    function bethlehem_gallery_slideshow($post_id , $thumbnail = 'post-thumbnail') {
    	global $post;

    	$post_id = ($post_id) ? $post_id : $post->ID;

    	// Get the media ID's
		$ids = esc_attr(get_post_meta($post_id, 'postformat_gallery_ids', true));

		// Query the media data
		$attachments = get_posts( array(
			'post__in' 			=> explode(",", $ids),
			'orderby' 			=> 'post__in',
			'post_type' 		=> 'attachment',
			'post_mime_type' 	=> 'image',
			'post_status' 		=> 'any',
			'numberposts' 		=> -1
		));

		// Create the media display
		if ($attachments) :
			if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
				wp_enqueue_script( 'bethlehem-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
			}
		?>
		<div class="media-attachment-gallery">
			<div id="owl-carousel-<?php echo esc_attr( $post_id ); ?>" class="owl-carousel owl-inner-pagination owl-inner-nav owl-blog-post-gallery">
			<?php foreach ($attachments as $attachment): ?>
				<div class="item">
					<figure>
						<?php echo wp_get_attachment_image($attachment->ID, $thumbnail); ?>
					</figure>
				</div><!-- /.item -->
			<?php endforeach; ?>
			</div>
			<div class="owl-custom-pagination">
				<a href="#" data-target="#owl-carousel-<?php echo esc_attr( $post_id ); ?>" class="slider-prev btn-prev fa fa-angle-left"></a>
				<a href="#" data-target="#owl-carousel-<?php echo esc_attr( $post_id ); ?>" class="slider-next btn-next fa fa-angle-right"></a>
			</div><!-- /.nav-holder -->
		</div><!-- /.media-attachment-gallery -->
		<script type="text/javascript">

			jQuery(document).ready(function(){
				if(jQuery().owlCarousel) {
					jQuery("#owl-carousel-<?php echo esc_attr( $post_id ); ?>").owlCarousel({
						items : 1,
						nav : false,
						slideSpeed : 300,
						dots: true,
						paginationSpeed : 400,
						responsive:{
							0:{
								items:1
							},
							600:{
								items:1
							},
							1000:{
								items:1
							}
						}
					});

					jQuery(".slider-next").click(function () {
						var owl = jQuery(jQuery(this).data('target'));
						owl.trigger('next.owl.carousel');
						return false;
					});

					jQuery(".slider-prev").click(function () {
						var owl = jQuery(jQuery(this).data('target'));
						owl.trigger('prev.owl.carousel');
						return false;
					});
				}
			});

		</script>
		<?php endif;
	}
endif;

if ( !function_exists( 'bethlehem_audio_player' ) ) :
	/**
	 *  Output Audio Player for Post Format
	 */
    function bethlehem_audio_player($post_id, $width = 980) {

    	// Get the player media
		$mp3    = get_post_meta($post_id, 'postformat_audio_mp3', 		TRUE);
		$ogg    = get_post_meta($post_id, 'postformat_audio_ogg', 		TRUE);
		$embed  = get_post_meta($post_id, 'postformat_audio_embedded', 	TRUE);

		if ( isset( $embed ) && $embed != '' ) {
			// Embed Audio
			if( !empty($embed) ) {
				// run oEmbed for known sources to generate embed code from audio links
				echo $GLOBALS['wp_embed']->autoembed( stripslashes(htmlspecialchars_decode($embed)) );

				return; // and.... Done!
			}

		} else {
			if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
				wp_enqueue_script( 'bethlehem-jplayer', get_template_directory_uri() . '/assets/js/jquery.jplayer.min.js', array( 'jquery' ), '2.2.0', true );
			}

		    // Other audio formats ?>

			<script type="text/javascript">

				jQuery(document).ready(function(){

					if(jQuery().jPlayer) {
						jQuery("#jquery_jplayer_<?php echo esc_attr( $post_id ); ?>").jPlayer({
							ready: function (event) {

								// set media
								jQuery(this).jPlayer("setMedia", {
								    <?php
								    if($mp3 != '') :
										echo 'mp3: "'. $mp3 .'",';
									endif;
									if($ogg != '') :
										echo 'oga: "'. $ogg .'",';
									endif; ?>
									end: ""
								});
							},
							size: {
	        				    width: "<?php echo $width; ?>px",
	        				},
							swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
							cssSelectorAncestor: "#jp_interface_<?php echo $post_id; ?>",
							supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
						});

					}
				});
			</script>

			<div id="jquery_jplayer_<?php echo esc_attr( $post_id ); ?>" class="jp-jplayer jp-jplayer-audio"></div>

			<div class="jp-audio-container">
				<div class="jp-audio">
					<div class="jp-type-single">
						<div id="jp_interface_<?php echo esc_attr( $post_id ); ?>" class="jp-interface">
							<ul class="jp-controls">
								<li><div class="seperator-first"></div></li>
								<li><div class="seperator-second"></div></li>
								<li><a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i><span>play</span></a></li>
								<li><a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i><span>pause</span></a></li>
								<li><a href="#" class="jp-mute" tabindex="1"><i class="fa fa-volume-up"></i><span>mute</span></a></li>
								<li><a href="#" class="jp-unmute" tabindex="1"><i class="fa fa-volume-off"></i><span>unmute</span></a></li>
							</ul>
							<div class="jp-progress-container">
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
							</div>
							<div class="jp-volume-bar-container">
								<div class="jp-volume-bar">
									<div class="jp-volume-bar-value"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		} // End if embedded/else
    }
endif;

if ( !function_exists( 'bethlehem_video_player' ) ) :
	/**
	 * Video Player / Embeds (self-hosted, jPlayer)
	 */
    function bethlehem_video_player($post_id, $width = 980) {

    	// Check for embedded video
    	$embed = get_post_meta($post_id, 'postformat_video_embed', true);
		if( !empty($embed) ) {
			$embed = do_shortcode( $embed );
			// run oEmbed for known sources to generate embed code from video links
			echo '<div class="video-container"><div class="embed-responsive embed-responsive-16by9">'. $GLOBALS['wp_embed']->autoembed( stripslashes(htmlspecialchars_decode($embed)) ) .'</div></div>';

			return; // and.... Done!
		}

		if( ! apply_filters( 'bethlehem_load_all_minified_js', TRUE ) ) {
			wp_enqueue_script( 'bethlehem-jplayer', get_template_directory_uri() . '/assets/js/jquery.jplayer.min.js', array( 'jquery' ), '2.2.0', true );
		}

		// Get the player media options
    	$height 	= get_post_meta($post_id, 'postformat_video_height', 	true);
    	$m4v 		= get_post_meta($post_id, 'postformat_video_m4v', 		true);
    	$ogv 		= get_post_meta($post_id, 'postformat_video_ogv', 		true);
    	$webm 		= get_post_meta($post_id, 'postformat_video_webm', 		true);
    	$poster 	= get_post_meta($post_id, 'postformat_video_poster', 	true);

		?>
	    <script type="text/javascript">
	    	jQuery(document).ready(function(){

	    		if(jQuery().jPlayer) {
	    			jQuery("#jquery_jplayer_<?php echo esc_attr( $post_id ); ?>").jPlayer({
	    				ready: function (event) {
							// mobile display helper
							// if(event.jPlayer.status.noVolume) {	$('#jp_interface_<?php echo esc_attr( $post_id ); ?>').addClass('no-volume'); }
							// set media
	    					jQuery(this).jPlayer("setMedia", {
	    						<?php if($m4v != '') : ?>
	    						m4v: "<?php echo $m4v; ?>",
	    						<?php endif; ?>
	    						<?php if($ogv != '') : ?>
	    						ogv: "<?php echo $ogv; ?>",
	    						<?php endif; ?>
	    						<?php if($webm != '') : ?>
	    						webmv: "<?php echo $webm; ?>",
	    						<?php endif; ?>
	    						<?php if ($poster != '') : ?>
	    						poster: "<?php echo $poster; ?>"
	    						<?php endif; ?>
	    					});
	    				},
						<?php if( !empty($poster) ) { ?>
						size: {
	    				    width: "<?php echo $width; ?>px",
	    				    height: "<?php echo $height; ?>'px'"
	    				},
	    				<?php } ?>
	    				swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
	    				cssSelectorAncestor: "#jp_interface_<?php echo $post_id; ?>",
	    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
	    			});
	    		}
	    	});
	    </script>

	    <div id="jquery_jplayer_<?php echo esc_attr( $post_id ); ?>" class="jp-jplayer jp-jplayer-video"></div>

	    <div class="jp-video-container">
	        <div class="jp-video">
	            <div class="jp-type-single">
	                <div id="jp_interface_<?php echo esc_attr( $post_id ); ?>" class="jp-interface">
	                    <ul class="jp-controls">
	                    	<li><div class="seperator-first"></div></li>
	                        <li><div class="seperator-second"></div></li>
	                        <li><a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i><span>play</span></a></li>
	                        <li><a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i><span>pause</span></a></li>
	                        <li><a href="#" class="jp-mute" tabindex="1"><i class="fa fa-volume-up"></i><span>mute</span></a></li>
	                        <li><a href="#" class="jp-unmute" tabindex="1"><i class="fa fa-volume-off"></i><span>unmute</span></a></li>
	                    </ul>
	                    <div class="jp-progress-container">
	                        <div class="jp-progress">
	                            <div class="jp-seek-bar">
	                                <div class="jp-play-bar"></div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="jp-volume-bar-container">
	                        <div class="jp-volume-bar">
	                            <div class="jp-volume-bar-value"></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?php
	}
endif;

if( ! function_exists( 'bethlehem_author_info' ) ) :
	/**
	 * Display Author Info
	 */
	function bethlehem_author_info() {
		$show_author_info = true;
		if( $show_author_info ) :
			?>
			<div class="author-wrap">
				<?php echo get_avatar( get_the_author_meta( 'ID' ) , 160 ); ?>
				<h5><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></h5>
				<p><?php echo get_the_author_meta( 'description' );?></p>
			</div>
			<?php
		endif;
	}
endif;

if( ! function_exists( 'bethlehem_post_excerpt' ) ) :
	/**
	 * Display Post Excerpt
	 */
	function bethlehem_post_excerpt(){
		global $custom_query;

		if ( isset( $custom_query->query['excerpt_length'] ) ) {
			$excerpt_length = absint( $custom_query->query['excerpt_length'] );
		} else {
			$excerpt_length = absint( apply_filters( 'bethlehem_post_excerpt_length', 75 ) );
		}

		$read_more = __( 'Read more', 'bethlehem' );
		$read_more_exclude = array( 'quote', 'link', 'status', 'aside' ); // post formats to exclude read more link
		$post_excerpt = '<p>' . custom_excerpt( get_the_excerpt(), $excerpt_length ) . '</p>';

		if( $read_more != -1 && !in_array( get_post_format(), $read_more_exclude ) ){
			$post_excerpt .= '<div class="line"></div>';
			$post_excerpt .= sprintf( '<a href="%s" class="hb-more">%s</a>', get_permalink(), $read_more );
		}

		return $post_excerpt;
	}
endif;

if( ! function_exists( 'custom_excerpt' ) ) :
	/**
	 * Custom Length Excerpts
	 */
	function custom_excerpt( $excerpt = '', $excerpt_length = 300, $force_custom_excerpt = FALSE, $tags = '', $trailing = '...' ) {
		global $post;

		if ( has_excerpt() && !$force_custom_excerpt ) {
			// see if there is a user created excerpt, if so we use that without any trimming
			return get_the_excerpt();
		} else {
			// otherwise make a custom excerpt
			$string_check = explode(' ', $excerpt);
			if (count($string_check, COUNT_RECURSIVE) > $excerpt_length) {
				$excerpt = strip_shortcodes( $excerpt );
				$new_excerpt_words = explode(' ', $excerpt, $excerpt_length+1);
				array_pop($new_excerpt_words);
				$excerpt_text = implode(' ', $new_excerpt_words);
				$temp_content = strip_tags($excerpt_text, $tags);
				$short_content = preg_replace('`\[[^\]]*\]`','',$temp_content);
				$short_content .= $trailing;

				return $short_content;
			} else {
				// no trimming needed, excerpt is too short.
				return $excerpt;
			}
		}
	}
endif;
