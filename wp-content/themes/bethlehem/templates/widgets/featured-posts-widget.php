<?php

extract( $args );

$title = apply_filters( 'widget_title', $instance['title'] );

echo $before_widget;

echo $before_title . $title . $after_title;

$post_ids = explode( ',', $instance['post_ids'] );

$post_args = array(
    'post__in' 				=> $post_ids,
    'ignore_sticky_posts' 	=> 1
);

$featured_posts = new WP_Query( $post_args );

if ( $featured_posts->have_posts() ) :
	echo '<ul class="fposts">';
    	while ( $featured_posts->have_posts() ) : $featured_posts->the_post();
	    	echo '<li id="post-'.get_the_ID().'">';
	    		the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
	    		bethlehem_posted_on();
				bethlehem_post_meta();
				the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
				echo '<div class="line"></div>';
				echo sprintf( '<a href="%s" class="hb-more">%s</a>', get_permalink(), __( 'Read more', 'bethlehem' ) );
				echo '<span class="comments-count">';
				comments_number();
				echo '</span>';
	    	echo '</li>';
    	endwhile;
	echo '</ul>';
	echo '<a class="archive_link" href="' .home_url(). '">' .apply_filters( 'bethlehem_featured_posts_widget_archive_text' , __( 'See the Archive', 'bethlehem' ) ). '</a>';
endif;

echo $after_widget;

wp_reset_postdata();