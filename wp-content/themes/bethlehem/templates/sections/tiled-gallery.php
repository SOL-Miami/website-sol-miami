<?php
/**
 * Tiled Gallery
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="bethlehem-tiled-gallery <?php echo esc_attr( $el_class ); ?>">
	<div class="description-content">
		<h3 class="pre-title"><?php echo $pretitle; ?></h3>
		<h3 class="title"><?php echo $title; ?></h3>
		<div class="textwidget"><?php echo $content; ?></div>
	</div>
	<div class="gallery-content">
		<?php echo do_shortcode( shortcode_unautop( $shortcode ) ); ?>
	</div>
</div>