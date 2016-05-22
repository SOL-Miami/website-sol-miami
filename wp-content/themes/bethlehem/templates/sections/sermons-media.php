<?php
/**
 * Sermons Media
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="sermons-media <?php echo esc_attr( $el_class ); ?>">
	<h3 class="pre-title"><?php echo $pre_title; ?></h3>
	<h3 class="title"><?php echo $title; ?></h3>
	<div class="sermons-media-channel">
		<?php echo $embeded_content; ?>
	</div>
	<?php if( count( $link ) > 0 ) : ?>
		<a class="hb-more-button" href="<?php echo esc_url( $link['url'] ); ?>"><?php echo ( !empty( $link['title'] ) ? $link['title'] : __( 'Browse More', 'bethlehem' ) ); ?></a>
	<?php endif; ?>
</div>