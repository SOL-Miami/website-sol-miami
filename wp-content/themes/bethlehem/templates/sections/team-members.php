<?php
/**
 * Team Members
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php
if ( $type == 'large' ) {
	$css_class = 'team-large '.$el_class;
} else {
	$css_class = 'team-small '.$el_class;
}
?>

<div class="<?php echo esc_attr( $css_class ); ?>">
	<?php if( !empty($title) ) {
		echo '<h4 class="title">' .$title. '</h4>';
	} ?>

	<div class="team-members-wrapper">
	<?php if( is_array( $query ) || is_object( $query ) ) : ?>
		<?php foreach ( $query as $post ) : ?>
			<div class="member">
				<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo get_the_post_thumbnail( $post->ID ); ?></a>
				<div class="member-info">
					<h4><a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo $post->post_title; ?></a><span><?php echo $post->byline; ?></span></h4>
					<?php if ( $type == 'large' ) {
						echo '<p>' .$post->post_excerpt. '</p>';
					} ?>
					<div class="line"></div>
					<a class="hb-more" href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo __('Read more', 'bethlehem'); ?></a>
					<?php our_team_member_archive_social_links( $post->ID ); ?>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	</div>
</div>