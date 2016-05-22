<?php
/**
 * Donatioin Carousel
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$carouselID = uniqid();
?>

<div class="donation-carousel-wrap <?php echo esc_attr( $el_class ); ?>" <?php echo $style; ?>>
	<div id="donation-slider-<?php echo esc_attr( $carouselID ); ?>" class="owl-carousel">
		<?php if ( $query->have_posts() ) : ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="donation-item">
					<?php the_title( '<h3>', '</h3>' ); ?>
					<?php bethlehem_show_goal_progress(); ?>
					<?php give_donate_btn(); ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			$("#donation-slider-<?php echo esc_attr( $carouselID ); ?>").owlCarousel({
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