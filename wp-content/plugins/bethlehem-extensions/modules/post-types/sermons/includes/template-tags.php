<?php
/**
 * The template for displaying sermons content.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! function_exists( 'sermons_loop_thumbnail' ) ) {
	/**
	 * Displays sermon loop thumbnail
	 * @since 1.0.0
	 * @return void
	 */
	function sermons_loop_thumbnail() {
		if( function_exists( 'bethlehem_get_thumbnail' ) ) {
			$post_id = get_the_ID();
			echo bethlehem_get_thumbnail( $post_id, 'post-thumbnail', TRUE, TRUE );
		}
	}
}

if( ! function_exists( 'sermons_single_thumbnail' ) ) {
	/**
	 * Displays Single Thumbnail
	 * @since 1.0.0
	 * @return void
	 */
	function sermons_single_thumbnail() {
		if( function_exists( 'bethlehem_get_thumbnail' ) ) {
			$post_id = get_the_ID();
			echo bethlehem_get_thumbnail( $post_id, 'large', FALSE, FALSE );
		}
	}
}

if( ! function_exists( 'sermons_post_media' ) ) {
	function sermons_post_media() {
		$id = get_the_ID();
		$post_format = get_post_format();

		if($post_format == 'video' || $post_format == 'audio'){
			switch( $post_format ) {
				case 'audio' :
					bethlehem_audio_player( $id );
				break;
				case 'video' :
					bethlehem_video_player( $id );
				break;
			}
		} else {
			sermons_single_thumbnail();
		}
	}
}

if( ! function_exists( 'sermons_post_audio' ) ) {
	function sermons_post_audio() {
		$id = get_the_ID();
		$post_format = get_post_format();

		if($post_format == 'video' || $post_format == 'audio'){
			bethlehem_audio_player( $id );
		}
	}
}

if( ! function_exists( 'sermons_post_video' ) ) {
	function sermons_post_video() {
		$id = get_the_ID();
		$post_format = get_post_format();

		if($post_format == 'video' || $post_format == 'audio'){
			bethlehem_video_player( $id );
		}
	}
}

if( ! function_exists( 'sermons_single_post_title' ) ) {
	function sermons_single_post_title() {
		?>
		<h2 class="title"><?php the_title(); ?></h2>
		<?php
	}
}

if( ! function_exists( 'sermons_archive_post_title' ) ) {
	function sermons_archive_post_title() {
		?>
		<h4 class="title"><a href="<?php esc_attr( the_permalink() ); ?>"><?php the_title(); ?></a></h4>
		<?php
	}
}

if( ! function_exists( 'sermons_meta_info' ) ) {
	function sermons_meta_info() {
		$id = get_the_ID();
		?>
		<div class="post-meta">
			<span class="post-author">
				<?php echo get_the_author(); ?>
			</span>
			<span class="post-date">
				<?php echo get_the_date(); ?>
			</span>
			<span class="post-categories">
				<?php echo get_the_term_list( $id, 'sermons-category' ); ?>
			</span>
		</div>
		<?php
	}
}

if( ! function_exists( 'sermons_post_content' ) ) {
	function sermons_post_content() {
		?>
		<div class="description" itemprop="description">
			<?php the_content(); ?>
		</div>
		<?php
	}
}

if( ! function_exists( 'sermons_post_format_icons' ) ) {
	function sermons_post_format_icons() {
		$show_post_icons	= apply_filters( 'show_sermons_post_icons', TRUE );
		$enable_download	= apply_filters( 'enable_sermons_download', TRUE );
		$enable_audio		= apply_filters( 'enable_sermons_audio', TRUE );
		$enable_video		= apply_filters( 'enable_sermons_video', TRUE );

		if( $show_post_icons ) :
			$post_format 	= get_post_format();

			$audio_embed	= get_post_meta( get_the_ID(), 'postformat_audio_embedded', 	TRUE);
			$mp3			= get_post_meta( get_the_ID(), 'postformat_audio_mp3', 		TRUE);
			$ogg			= get_post_meta( get_the_ID(), 'postformat_audio_ogg', 		TRUE);
			
			$video_embed	= get_post_meta( get_the_ID(), 'postformat_video_embed', 	true);
			$m4v			= get_post_meta( get_the_ID(), 'postformat_video_m4v', 		TRUE);
			$ogv			= get_post_meta( get_the_ID(), 'postformat_video_ogv', 		TRUE);
			$webm			= get_post_meta( get_the_ID(), 'postformat_video_webm', 	TRUE);

			if( empty( $audio_embed ) && empty( $mp3 ) && empty( $ogg ) ) {
				$enable_audio = FALSE;
			}

			if( empty( $video_embed ) && empty( $m4v ) && empty( $ogv ) && empty( $webm ) ) {
				$enable_video = FALSE;
			}

			$download_url	= sermons_meta_media_url();
			if( empty( $download_url ) ) {
				if( ! empty( $mp3 ) ) {
					$download_url = $mp3;
				} elseif( ! empty( $ogg ) ) {
					$download_url = $ogg;
				} elseif ( ! empty( $m4v ) ) {
					$download_url = $m4v;
				} elseif( ! empty( $ogv ) ) {
					$download_url = $ogv;
				} elseif( ! empty( $webm ) ) {
					$download_url = $webm;
				}
			}

			if( empty( $download_url ) ) {
				$enable_download = FALSE;
			}

			if( $enable_video || $enable_audio || $enable_download ) :
				?>
				<ul class="post-icons">
					<?php if( $enable_video ) : ?>
						<li>
							<a href="#modal-sermon-media" role="button" class="sermon-video" data-modal-content-id="modal-content-video-<?php echo esc_attr( get_the_ID() );?>" data-toggle="modal" data-target="#modal-sermon-media">
								<i class="fa fa-play"></i>
								<span class="icon-info"><?php _e( 'Watch', 'bethlehem-extension' ); ?></span>
							</a>
							<div id="modal-content-video-<?php echo esc_attr( get_the_ID() );?>" class="modal-content-media hidden"><?php sermons_post_video(); ?></div>
						</li>
					<?php endif; ?>
					<?php if( $enable_audio ) : ?>
						<li>
							<a href="#modal-sermon-media" role="button" class="sermon-audio" data-modal-content-id="modal-content-audio-<?php echo esc_attr( get_the_ID() );?>" data-toggle="modal" data-target="#modal-sermon-media">
								<i class="fa fa-headphones"></i>
								<span class="icon-info"><?php _e( 'Listen', 'bethlehem-extension' ); ?></span>
							</a>
							<div id="modal-content-audio-<?php echo esc_attr( get_the_ID() );?>" class="modal-content-media hidden"><?php sermons_post_audio();?></div>
						</li>
					<?php endif; ?>
					<?php if( $enable_download ) : ?>
						<li>
							<a href="<?php echo esc_url( $download_url );?>" class="sermon-save" download><i class="fa fa-arrow-down"></i><span class="icon-info"><?php _e( 'Save as', 'bethlehem-extension' ); ?></span></a>
						</li>
					<?php endif; ?>
				</ul>
				<?php
			endif;
		endif;
	}
}

if( ! function_exists( 'sermons_post_media_modal_content' ) ) {
	function sermons_post_media_modal_content() {
		?>
		<div class="modal modal-sermon modal-sermon-media fade" id="modal-sermon-media" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			(function($) {
				$(document).ready(function() {
					$('#modal-sermon-media').on( 'show.bs.modal', function (event) {
						var button = $(event.relatedTarget);
						var content_id = button.data('modal-content-id');
						var content = $("#"+content_id).html();
						var modal = $(this);
						modal.find('.modal-body').html(content);
					});

					$('#modal-sermon-media').on( 'hide.bs.modal', function (event) {
						var modal = $(this);
						modal.find('.modal-body').empty();
						$( '.jp-jplayer' ).jPlayer( 'stop' );
					});
			    });
			})(jQuery);
		</script>
		<?php
	}
}

if( ! function_exists( 'sermons_meta_media_url' ) ) {
	function sermons_meta_media_url() {
		global $bethlehem_sermon_metabox;

		$media_url = '';

		$meta = get_post_meta( get_the_ID(), '_bethlehem_sermon_metabox', TRUE );
		if ( is_array( $meta ) && array_key_exists( 'mediaurl', $meta ) ) {
			$media_url = $meta['mediaurl'];
		}
		
		return $media_url;
	}
}

if( ! function_exists( 'sermons_content_body_wrapper_start' ) ) {
	function sermons_content_body_wrapper_start() {
		echo '<div class="sermon-info">';
	}
}

if( ! function_exists( 'sermons_content_wrapper_start' ) ) {
	function sermons_content_wrapper_start() {
		echo '<div class="list-view-content">';
	}
}

if( ! function_exists( 'sermons_div_wrapper_end' ) ) {
	function sermons_div_wrapper_end() {
		echo '</div>';
	}
}

if( ! function_exists( 'sermons_sidebar' ) ) {
	function sermons_sidebar() {
		$layout = bethlehem_get_layout();

		if( $layout == 'right-sidebar' || $layout == 'left-sidebar' ){
			get_sidebar( 'sermons' );
		}
	}
}

if( ! function_exists( 'bethlehem_display_speaker_info' ) ) {
	function bethlehem_display_speaker_info() {
		global $bethlehem_sermon_metabox, $woothemes_our_team ;

		$team_member_ID = $bethlehem_sermon_metabox->get_the_value( 'sermon_speaker_ID' );

		$speaker = array(
			'image'			=> '',
			'name'			=> '',
			'description'	=> ''
		);

		$should_use_default_author = TRUE;

		if( !$should_use_default_author && !empty( $team_member_ID ) && isset( $woothemes_our_team ) ) {
			$sermon_speaker = $woothemes_our_team->get_our_team( array( 'id' => $team_member_ID, 'size' => 'thumbnail' ) );

			if( isset( $sermon_speaker[0] ) && is_a( $sermon_speaker[0], 'WP_Post' ) ) {
				$author = $sermon_speaker[0];

				$speaker = array(
					'image'			=> $author->image,
					'name'			=> $author->post_title,
					'description'	=> $author->post_excerpt
				);
			} else {
				$should_use_default_author = TRUE;
			}
		}

		if( $should_use_default_author === TRUE ) {

			$speaker = array(
				'image'			=> get_avatar( get_the_author_meta( 'ID' ) , 150 ),
				'name'			=> get_the_author(),
				'description'	=> get_the_author_meta( 'description' ),
			);
		}
	?>
	<div class="author-wrap">
		<?php echo $speaker['image']; ?>
		<h5><?php echo sprintf( __( 'About %s', 'bethlehem-extension' ), $speaker['name'] ); ?></h5>
		<p><?php echo $speaker['description']; ?></p>
	</div>
	<?php

	}
}

if( ! function_exists( 'bethlehem_get_sermon_speaker_name' ) ) {
	function bethlehem_get_sermon_speaker_name() {
		global $bethlehem_sermon_metabox, $woothemes_our_team ;

		$speaker_name = '';

		$team_member_ID = $bethlehem_sermon_metabox->get_the_value( 'sermon_speaker_ID' );

		$should_use_default_author = TRUE;

		if( !$should_use_default_author && !empty( $team_member_ID ) && isset( $woothemes_our_team ) ) {
			$sermon_speaker = $woothemes_our_team->get_our_team( array( 'id' => $team_member_ID, 'size' => 'thumbnail' ) );

			if( isset( $sermon_speaker[0] ) && is_a( $sermon_speaker[0], 'WP_Post' ) ) {
				$author 		= $sermon_speaker[0];
				$speaker_name   = $author->post_title;
			} else {
				$should_use_default_author = TRUE;
			}
		}

		if( $should_use_default_author === TRUE ) {
			$speaker_name = get_the_author();
		}

		return $speaker_name;
	}
}

if( ! function_exists( 'bethlehem_related_sermons' ) ) {
	function bethlehem_related_sermons() {
		global $post;

		$cat_ID		= array();
		$categories = get_the_terms( $post->ID, 'sermons-category' );

		if( empty( $categories ) ) {
			return;
		}
		
		if( is_array( $categories ) ) {
			foreach( $categories as $category ) {
				array_push( $cat_ID, $category->term_id );
			}
		}

		$args = array(
			'post_type' 		=> 'sermons',
			'posts_per_page' 	=> 3,
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
			'post__not_in' 		=> array($post->ID),
			'tax_query' 		=> array(
				array(
					'taxonomy' 	=> 'sermons-category',
					'field' 	=> 'term_id',
					'terms' 	=> $cat_ID,
				)
			),
		);

		$related_posts = new WP_Query( $args );

		echo '<div class="sermons-related">';
		echo '<h4>' .__( 'More from the current topic', 'bethlehem-extension'). '</h4>';

		while ( $related_posts->have_posts() ) :  $related_posts->the_post();
		?>

			<div class="sermons-loop">

				<?php do_action( 'sermons_archive_loop_content' ); ?>

			</div>

		<?php
		endwhile;

		echo '</div>';

		wp_reset_postdata();
	}
}
