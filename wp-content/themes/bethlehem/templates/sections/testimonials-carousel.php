<?php
/**
 * Testimonial Carousel
 *
 * @package bethlehem
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$content = '';
$image = '';
if( is_array( $query ) || is_object( $query ) ){
	foreach ($query as $post) {
		if( !empty($post->image) ) {
			$img_src_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( 75,75 ) );
			$img_src = $img_src_array[0];
			$width =  $img_src_array[1];
			$height =  $img_src_array[2];
			$image .= '<div class="quote-item"><img alt="" src="' . esc_url( $img_src ) . '" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '"></div>';
		} else {
			$image .= '<div class="quote-item"><img alt="" src="' . esc_url( get_template_directory_uri() . '/assets/images/icon-user-default.jpg' ) . '"></div>';
		}

		$content .= '<div class="quote-item">';
		$content .= '<h4>' .$post->post_title. '</h4>';
		$content .= '<p>' .$post->post_content. '</p>';
		$content .= '</div>';
	}
}
?>

<div class="quote-wrap <?php echo esc_attr( $el_class ); ?>">
	<div id="quote-img-slider" class="owl-carousel owl-theme">
		<?php echo $image; ?>
	</div>

	<div id="quote-info-slider" class="owl-carousel owl-theme">
		<?php echo $content; ?>
	</div>
</div>

<script type="text/javascript">
	(function($) {
		$(document).ready(function(){
			var $sync1 = $("#quote-info-slider");
			var $sync2 = $("#quote-img-slider");
			var flag = false;
			var duration = 300;

			$sync1.owlCarousel({
				items: 1,
				margin: 10,
				nav: true,
				dots: false,
				navText: ["<i class=\"fa fa-chevron-circle-left\"></i>" , "<i class=\"fa fa-chevron-circle-right\"></i>"],
				autoplay:false,
			    autoplayTimeout:5000,
			    autoplayHoverPause:true,
				animateOut: 'fadeOut',
			});

			$sync1.on('changed.owl.carousel', function (e) {
				if (!flag) {
					flag = true;
					$sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}
				$sync2.find(".owl-item").removeClass("synced").eq(e.item.index).addClass("synced");
			});

			$sync2.on('initialized.owl.carousel',function (e) {
				$sync2.find(".owl-item").eq(0).addClass("synced");
			});

			$sync2.owlCarousel({
				margin: 10,
				items: 10,
				nav: false,
				center: false,
				dots: false,
				responsive: {
	                0: {
	                    items: 1,
	                },
	                640 : {
	                    items: 3,
	                },
	                768 : {
	                    items: 6,
	                },
	                1024 : {
	                    items : 10,
	                },
	            },
			});

			$sync2.on('click', '.owl-item', function () {
				$sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);
			});

			$sync2.on('changed.owl.carousel', function (e) {
				if (!flag) {
					flag = true;
					$sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}
			});
		})
	})(jQuery);
</script>