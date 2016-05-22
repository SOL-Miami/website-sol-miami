<?php

$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'bethlehem' );

$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

$r = new WP_Query( apply_filters( 'bethlehem_donation_widget_posts_args', array(
	'post_type'			  => 'give_forms',
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
	<ul class="beth-recent-posts">
	<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<li>
			<?php echo give_loop_form_thumbnail(); ?>
			<a href="<?php the_permalink() ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
			<?php bethlehem_show_goal_progress(); ?>
		</li>
	<?php endwhile; ?>
	</ul>
	<?php echo $args['after_widget']; ?>
	<?php
endif;

wp_reset_postdata();