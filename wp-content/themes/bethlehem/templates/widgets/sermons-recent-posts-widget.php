<?php

$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'bethlehem' );

$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

$r = new WP_Query( apply_filters( 'bethlehem_widget_sermons_recent_posts_args', array(
	'post_type'			  => 'sermons',
	'posts_per_page'	  => $number,
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
	<ul class="beth-recent-posts">
	<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<li>
			<?php
				if( function_exists( 'bethlehem_get_thumbnail' ) ) {
					echo bethlehem_get_thumbnail( get_the_ID(), 'thumbnail', TRUE, TRUE );
				}
				echo '<div class="sermons-widget-content">';
				sermons_archive_post_title();
				sermons_post_format_icons();
				echo '</div>';
			?>
		</li>
	<?php endwhile; ?>
	</ul>
	<?php echo $args['after_widget']; ?>
	<?php
endif;

wp_reset_postdata();