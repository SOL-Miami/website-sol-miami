<?php
/**
 * Stories Carousel
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$carouselID = uniqid();
?>

<div class="stories-carousel-wrap <?php echo esc_attr( $el_class ); ?>" <?php echo $style; ?>>
	<div id="stories-slider-<?php echo esc_attr( $carouselID ); ?>" class="owl-carousel">
		<?php if ( $query->have_posts() ) : ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="stories-item">
					<?php the_title( '<h3>', '</h3>' ); ?>
					<p><?php echo custom_excerpt( get_the_content(), apply_filters( 'stories_carousel_excerpt_length', 25 ) ); ?></p>
					<a class="hb-more-button" href="<?php the_permalink(); ?>"><i class="fa fa-long-arrow-right"></i><?php echo ( !empty( $archive_link_text ) ? $archive_link_text : __( 'Read story', 'bethlehem' ) ); ?></a>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
		    $("#stories-slider-<?php echo esc_attr( $carouselID ); ?>").owlCarousel({
			    slideSpeed : 300,
			    pagination : true,
			    navText: ["<i class=\"fa fa-chevron-left\"></i>" , "<i class=\"fa fa-chevron-right\"></i>"],
			    //singleItem : true,
			    dots: false,
			    nav : <?php echo ( count( $query->posts ) > 1 ? 'true' : 'false' ); ?>,
			    items : 1
			    // "singleItem:true" is a shortcut for:
			    // items : 1,
			    // itemsDesktop : false,
			    // itemsDesktopSmall : false,
			    // itemsTablet: false,
			    // itemsMobile : false
		    });
	    });
	})(jQuery);
</script>