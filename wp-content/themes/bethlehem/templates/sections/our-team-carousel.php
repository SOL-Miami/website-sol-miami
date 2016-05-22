<?php
/**
 * Our Team Carousel
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$carouselID = uniqid();
?>

<div class="team-member-carousel-wrap <?php echo esc_attr( $el_class ); ?>">
	<h3 class="pre-title"><?php echo ( !empty( $pre_title ) ? $pre_title : __( 'Meet us', 'bethlehem' ) ); ?></h3>
	<h3 class="title"><?php echo ( !empty( $title ) ? $title : __( 'Our Team', 'bethlehem' ) ); ?></h3>
	<div id="team-member-slider-<?php echo esc_attr( $carouselID ); ?>" class="owl-carousel">
		<?php if( is_array( $query ) || is_object( $query ) ) : ?>
			<?php foreach ( $query as $post ) : ?>
				<div class="team-member-carousel-item">
					<div class="member">
						<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
							<?php 
								$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
								echo wp_get_attachment_image( $post_thumbnail_id, 'thumbnail' ); ?>
						</a>
						<div class="member-info">
							<h4>
								<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo $post->post_title; ?></a>
								<span><?php echo $post->byline; ?></span>
							</h4>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
		    $("#team-member-slider-<?php echo esc_attr( $carouselID ); ?>").owlCarousel({
			    slideSpeed : 300,
			    pagination : true,
			    navText: ["<i class=\"fa fa-caret-left\"></i>" , "<i class=\"fa fa-caret-right\"></i>"],
			    dots: false,
			    nav : <?php echo ( count( $query ) > 5 ? 'true' : 'false' ); ?>,
			    items : <?php echo ( count( $query ) >= 5 ? 5 : count( $query ) ); ?>,
				responsive:{
			        0:{
			            items:1,
			            nav : <?php echo ( count( $query ) > 1 ? 'true' : 'false' ); ?>
			        },
			        600:{
			            items:3,
			            nav : <?php echo ( count( $query ) > 3 ? 'true' : 'false' ); ?>
			        },
			        1000:{
			            items:<?php echo ( count( $query ) >= 5 ? 5 : count( $query ) ); ?>,
			            nav : <?php echo ( count( $query ) > 5 ? 'true' : 'false' ); ?>
			        }
			    }
		    });
	    });
	})(jQuery);
</script>