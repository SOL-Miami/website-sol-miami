<?php
/**
 * Images Carousel
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$carouselID = uniqid();
$carousel_images = array();

if( is_array( $image_ids ) || is_object( $image_ids ) ) {
    foreach ($image_ids as $image_id ) {
        $full_img_src_arr 		= wp_get_attachment_image_src( $image_id, 'full', false );
        $thumbnail_img_src_arr 	= wp_get_attachment_image_src( $image_id, 'thumbnail', false );
        $carousel_images[$image_id] 		= array(
        	'full'		=> $full_img_src_arr,
        	'thumbnail'	=> $thumbnail_img_src_arr
    	);
    }
}
?>
<div class="images-carousel-wrap <?php echo esc_attr( $el_class ); ?>">
	<h3 class="pre-title"><?php echo ( !empty( $pre_title ) ? $pre_title : __( 'A few snaps from Gallery', 'bethlehem' ) ); ?></h3>
	<h3 class="title"><?php echo ( !empty( $title ) ? $title : __( 'Photos', 'bethlehem' ) ); ?></h3>
	<div id="bethlehem-images-slider-<?php echo esc_attr( $carouselID ); ?>" class="owl-carousel">
		<?php if( is_array( $carousel_images ) || is_object( $carousel_images ) ) : ?>
			<?php foreach( $carousel_images as $carousel_image ) : ?>
				<?php
					$thumbnail_image_src 	= $carousel_image['thumbnail'][0];
					$thumbnail_image_width 	= $carousel_image['thumbnail'][1];
					$thumbnail_image_height = $carousel_image['thumbnail'][2];

					$full_image_src = $carousel_image['full'][0];
				?>
				<div class="images-item">
					<a href="<?php echo esc_url( $full_image_src ); ?>" rel="prettyPhoto[pp_gal]">
						<img src="<?php echo esc_url( $thumbnail_image_src ); ?>" alt="" width="<?php echo esc_attr( $thumbnail_image_width ); ?>" height="<?php echo esc_attr( $thumbnail_image_height ); ?>">
					</a>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<?php if( count( $link ) > 0 ) : ?>
		<a class="hb-more-button" href="<?php echo esc_url( $link['url'] ); ?>"><?php echo ( !empty( $link['title'] ) ? $link['title'] : __( 'Follow us on Instagram', 'bethlehem' ) ); ?></a>
	<?php endif; ?>
</div>

<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
		    $("#bethlehem-images-slider-<?php echo esc_attr( $carouselID ); ?>").owlCarousel({
			    nav : true,
			    slideSpeed : 300,
			    pagination : true,
			    navText: ["<i class=\"fa fa-chevron-left\"></i>" , "<i class=\"fa fa-chevron-right\"></i>"],
			    dots: false,
			    items : 6,
			    autoWidth: true,
				responsive:{
			        0:{
			            items:1,
			            nav:true
			        },
			        600:{
			            items:3
			        },
			        1281:{
			            items:4
			        },
			        1920:{
			        	items:6
			        },
			    }
		    });
			$("a[rel^='prettyPhoto']").prettyPhoto({
				social_tools: false,
			});
	    });
	})(jQuery);
</script>
