<?php

if( ! function_exists( 'bethlehem_show_goal_progress' ) ) {
	/**
	 * Output Goal Progress
	 */
	
	function bethlehem_show_goal_progress() {
		give_get_template_part( 'single-give-form/goal-progress' );
	}
}

if( ! function_exists( 'give_loop_form_thumbnail' ) ) {
	/**
	 * Output Loop Form Thumbnail
	 */
	function give_loop_form_thumbnail() {
		global $post;

		if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_url  = wp_get_attachment_url( get_post_thumbnail_id() );
			$image       = get_the_post_thumbnail( $post->ID, 'give_form_thumbnail' , array(
				'title' => $image_title
			) );

			$image_link = get_the_permalink();

			echo apply_filters( 'thumbnail_give_form_image_html', sprintf( '<a href="%s" itemprop="image" class="give-main-image" title="%s">%s</a>', $image_link, $image_title, $image ), $post->ID );

		} else {

			$image_link = get_the_permalink();

			echo apply_filters( 'thumbnail_give_form_image_html', sprintf( '<a href="%s" itemprop="image" class="give-main-image"><img src="%s" alt="%s" /></a>', $image_link, give_get_placeholder_img_src(), __( 'Placeholder', 'bethlehem' ) ), $post->ID );

		}
	}
}