<?php
/**
 * The template for displaying sermons content.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! function_exists( 'stories_loop_thumbnail' ) ) {
	/**
	 * Displays stories loop thumbnail
	 * @since 1.0.0
	 * @return void
	 */
	function stories_loop_thumbnail() {
		if( function_exists( 'bethlehem_get_thumbnail' ) ) {
			$post_id = get_the_ID();
			echo bethlehem_get_thumbnail( $post_id, 'medium', TRUE, TRUE, 'fa fa-comments' );
		}
	}
}

if( ! function_exists( 'stories_featured_thumbnail' ) ) {
	/**
	 * Displays stories featured thumbnail
	 * @since 1.0.0
	 * @return void
	 */
	function stories_featured_thumbnail() {
		if( function_exists( 'bethlehem_get_thumbnail' ) ) {
			$post_id = get_the_ID();
			echo '<div class="stories-post-thumbnail">' ;
			echo bethlehem_get_thumbnail( $post_id, 'large', TRUE, TRUE, 'fa fa-comments' );
			echo '</div>';
		}
	}
}

if( ! function_exists( 'stories_single_thumbnail' ) ) {
	/**
	 * Displays Stories Single Thumbnail
	 * @since 1.0.0
	 * @return void
	 */
	function stories_single_thumbnail() {
		if( function_exists( 'bethlehem_get_thumbnail' ) ) {
			$post_id = get_the_ID();
			echo bethlehem_get_thumbnail( $post_id, 'full', FALSE, FALSE );
		}
	}
}

if( ! function_exists( 'stories_single_post_title' ) ) {
	function stories_single_post_title() {
		the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
	}
}

if( ! function_exists( 'stories_archive_post_title' ) ) {
	function stories_archive_post_title() {
		the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
	}
}

if( ! function_exists( 'stories_post_content' ) ) {
	function stories_post_content() {
		?>
		<div class="entry-content" itemprop="description">
			<?php the_content(); ?>
		</div>
		<?php
	}
}

if( ! function_exists( 'stories_post_excerpt' ) ) {
	function stories_post_excerpt() {
		$excerpt_length = apply_filters( 'stories_excerpt_length', 75 );
		?>
		<div class="entry-content" itemprop="description">
			<p><?php echo custom_excerpt( get_the_content(), $excerpt_length ); ?></p>
			<div class="line"></div>
			<a class="hb-more" href="<?php esc_attr( the_permalink() ); ?>"><?php echo __( 'Read more', 'bethlehem-extension' ); ?></a>
		</div>
		<?php
	}
}

if( ! function_exists( 'stories_content_wrapper_start' ) ) {
	function stories_content_wrapper_start() {
		echo '<div class="stories-content">';
	}
}

if( ! function_exists( 'stories_wrapper_end' ) ) {
	function stories_wrapper_end () {
		echo '</div>';
	}
}

if( ! function_exists( 'stories_featured_post' ) ) {
	function stories_featured_post() {

		$default_args = array(
			'post_by'	=> '',
			'post_ids'	=> '',
		);

		$stories_featured_post = apply_filters( 'stories_featured_post_args', $default_args );

		if( $stories_featured_post['post_by'] == 'ids' && $stories_featured_post['post_ids'] != '' ){

			$post_ids = explode( ",", $stories_featured_post['post_ids'] );

			$post_args = array(
			    'post__in' 	=> $post_ids,
			    'post_type' => 'stories'
			);

		} else {
			$post_args = array(
			    'posts_per_page' 	=> 1,
			    'post_type' 		=> 'stories'
			);
		}

		$featured_stories = new WP_Query( $post_args );

		if ( $featured_stories->have_posts() ) :
			while ( $featured_stories->have_posts() ) : $featured_stories->the_post();
				echo '<div class="stories-featured">';
					do_action( 'stories_featured_loop_content' );
				echo '</div>';
			endwhile;
		endif;

		wp_reset_postdata();
	}
}

if( ! function_exists( 'bethlehem_set_query' ) ) {
	function bethlehem_set_query() {

		$default_args = array(
			'post_by'	=> '',
			'post_ids'	=> '',
		);

		$stories_featured_post = apply_filters( 'stories_featured_post_args', $default_args );

		if( $stories_featured_post['post_by'] == 'ids' && $stories_featured_post['post_ids'] != '' ) {
			$post_ids 	= explode( ",", $stories_featured_post['post_ids'] );
			$post_args 	= array(
			    'post__not_in' 	=> $post_ids,
			    'post_type' 	=> 'stories'
			);
			query_posts( $post_args );
		} else {
			$paged 	= get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$offset = ( $paged - 1 ) * get_query_var( 'posts_per_page' ) + 1;
			$post_args = array(
				'paged' 	=> $paged,
				'offset' 	=> $offset,
			    'post_type' => 'stories'
			);
			query_posts( $post_args );
		}
	}
}

if( ! function_exists( 'bethlehem_reset_query' ) ) {
	function bethlehem_reset_query() {
		wp_reset_query();
	}
}