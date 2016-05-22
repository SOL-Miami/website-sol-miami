<?php
/**
 * Sermons Carousel
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$carouselID = uniqid();
?>

<div class="sermons-carousel-wrap type-2 <?php echo esc_attr( $el_class ); ?>" <?php echo $style; ?>>
	<div id="sermons-slider-<?php echo esc_attr( $carouselID ); ?>" class="owl-carousel">
		<?php if ( $query->have_posts() ) : ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="sermons-carousel-item">
					<?php echo bethlehem_get_thumbnail( get_the_ID(), 'post-thumbnail', TRUE, TRUE, 'fa fa-headphones' ); ?>
					<div class="sermons-carousel-info">
						<div class="post-info">
							<span><?php echo ( !empty( $title ) ? $title : __( 'Latest Message', 'bethlehem' ) ); ?></span>
							<?php sermons_archive_post_title(); ?>
							<?php sermons_meta_info(); ?>
						</div>
						<?php sermons_post_format_icons(); ?>
						<div class="line"></div>
						<a class="hb-more-button" href="<?php echo esc_url( get_post_type_archive_link( 'sermons' ) ); ?>"><i class="fa fa-long-arrow-right"></i><?php echo ( !empty( $archive_link_text ) ? $archive_link_text : __( 'View Sermons', 'bethlehem' ) ); ?></a>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
		    $("#sermons-slider-<?php echo esc_attr( $carouselID ); ?>").owlCarousel({
			    slideSpeed : 300,
			    pagination : true,
			    navText: ["" , ""],
			    dots: false,
			    nav : <?php echo ( count( $query->posts ) > 1 ? 'true' : 'false' ); ?>,
			    items : 1,
		    });
	    });
	})(jQuery);
</script>