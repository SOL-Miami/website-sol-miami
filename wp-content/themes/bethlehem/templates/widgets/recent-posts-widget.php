<?php

$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'bethlehem' );

$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

$type = ( ! empty( $instance['type'] ) ) ? $instance['type'] : 'sidebar';

$r = new WP_Query( apply_filters( 'bethlehem_widget_recent_posts_args', array(
	'posts_per_page'      => $number,
	'no_found_rows'       => true,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true
) ) );

if ($r->have_posts()) :
	?>
	<?php echo $args['before_widget']; ?>
	<?php if ( $title ) {
		echo $args['before_title'] . $title . $args['after_title'];
	} ?>
	<ul class="beth-recent-posts<?php echo ( $type == 'sidebar' ? ' fposts' : '' ) ?>">
	<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<li>
			<?php
				if( $type == 'type-1' ) {
					
					bethlehem_posted_on();
					bethlehem_post_meta();
					the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
					echo bethlehem_get_post_thumbnail( get_the_ID(), 'post-thumbnail', array( 'margin-bottom' => '30px' ) );
					bethlehem_post_content();
				
				} else if( $type == 'type-2' ) {
				
					echo bethlehem_get_post_thumbnail( get_the_ID(), 'post-thumbnail', array( 'margin-bottom' => '38px' ) );
					the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
					bethlehem_posted_on();
					bethlehem_post_meta();
					bethlehem_post_content();
				
				} else if( $type == 'type-3' ) {
				
					echo '<div class="center-block">';
					echo '<div class="pull-left">';
					echo bethlehem_get_post_thumbnail( get_the_ID(), 'post-thumbnail', array( 'margin-bottom' => '30px' ) );
					echo '</div>';
					echo '<div class="recent-list-view-post-content">';
					the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
					bethlehem_posted_on();
					bethlehem_post_meta();
					bethlehem_post_content();
					echo '</div>';
					echo '</div>';

				} else {
				
					echo bethlehem_get_post_thumbnail( get_the_ID(), 'post-thumbnail', array( 'margin-bottom' => '30px' ) );
		    		bethlehem_posted_on();
					bethlehem_post_meta();
					the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
					echo '<div class="line"></div>';
					echo sprintf( '<a href="%s" class="hb-more">%s</a>', get_permalink(), __( 'Read more', 'bethlehem' ) );
					echo '<span class="comments-count">';
					comments_number();
					echo '</span>';
				}
			?>
		</li>
	<?php endwhile; ?>
	</ul>
	<a class="archive-link" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Blog' ) ) ); ?>"><?php  echo apply_filters( 'blog_archive_link_text', __( 'See the archive', 'bethlehem' ) ); ?></a>
	<?php echo $args['after_widget']; ?>
	<?php
	// Reset the global $the_post as this query will have stomped on it
	wp_reset_postdata();

endif;