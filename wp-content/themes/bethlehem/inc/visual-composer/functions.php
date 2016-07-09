<?php
/**
 * Setup Visual Composer for mediacenter
 * 
 * @return void
 */

vc_disable_frontend();

if( ! function_exists( 'bethlehem_setup_visual_composer' ) ) {
	function bethlehem_setup_visual_composer() {
		// Setup Visual Composer as part of theme
		if( function_exists( 'vc_set_as_theme' ) ) {
			vc_set_as_theme( true );
		}
	}
}

/**
 * Remove VC teaser
 * 
 * @return void
 */
if( ! function_exists( 'bethlehem_remove_vc_teaser' ) ) {
	function bethlehem_remove_vc_teaser() {
		remove_meta_box( 'vc_teaser', '' , 'side' );
	}
}

/**
 * Set additional VC params for mediacenter
 *
 * @return void
 */
if( ! function_exists( 'bethlehem_add_vc_params' ) ) {
	function bethlehem_add_vc_params() {
		if ( function_exists( 'vc_add_param' ) ) {

			// Add parameters to 'vc_row'
			$base = 'vc_row';
			$extraParams = array(
				array(
					'type' 			=> 'dropdown',
					'heading'		=> __( 'CSS3 Animation', 'bethlehem' ),
					'param_name'	=> 'row_animation',
					'value'			=> array(
						__( 'No Animation', 'bethlehem' ) 			=> 	'',
			        	__( 'BounceIn', 'bethlehem' ) 				=> 	'bounceIn',
			        	__( 'BounceInDown', 'bethlehem' ) 			=> 	'bounceInDown',
			        	__( 'BounceInLeft', 'bethlehem' ) 			=> 	'bounceInLeft',
			        	__( 'BounceInRight', 'bethlehem' ) 			=> 	'bounceInRight',
			        	__( 'BounceInUp', 'bethlehem' ) 				=> 	'bounceInUp',
						__( 'FadeIn', 'bethlehem' ) 					=> 	'fadeIn',
						__( 'FadeInDown', 'bethlehem' ) 				=> 	'fadeInDown',
						__( 'FadeInDown Big', 'bethlehem' ) 			=> 	'fadeInDownBig',
						__( 'FadeInLeft', 'bethlehem' ) 				=> 	'fadeInLeft',
						__( 'FadeInLeft Big', 'bethlehem' ) 			=> 	'fadeInLeftBig',
						__( 'FadeInRight', 'bethlehem' ) 			=> 	'fadeInRight',
						__( 'FadeInRight Big', 'bethlehem' ) 		=> 	'fadeInRightBig',
						__( 'FadeInUp', 'bethlehem' ) 				=> 	'fadeInUp',
						__( 'FadeInUp Big', 'bethlehem' ) 			=> 	'fadeInUpBig',
						__( 'FlipInX', 'bethlehem' ) 				=> 	'flipInX',
						__( 'FlipInY', 'bethlehem' ) 				=> 	'flipInY',
						__( 'Light SpeedIn', 'bethlehem' ) 			=> 	'lightSpeedIn',
						__( 'RotateIn', 'bethlehem' ) 				=> 	'rotateIn',
						__( 'RotateInDown Left', 'bethlehem' ) 		=> 	'rotateInDownLeft',
						__( 'RotateInDown Right', 'bethlehem' ) 		=> 	'rotateInDownRight',
						__( 'RotateInUp Left', 'bethlehem' ) 		=> 	'rotateInUpLeft',
						__( 'RotateInUp Right', 'bethlehem' ) 		=> 	'rotateInUpRight',
						__( 'RoleIn', 'bethlehem' ) 					=> 	'roleIn',
			        	__( 'ZoomIn', 'bethlehem' ) 					=> 	'zoomIn',
						__( 'ZoomInDown', 'bethlehem' ) 				=> 	'zoomInDown',
						__( 'ZoomInLeft', 'bethlehem' ) 				=> 	'zoomInLeft',
						__( 'ZoomInRight', 'bethlehem' ) 			=> 	'zoomInRight',
						__( 'ZoomInUp', 'bethlehem' ) 				=> 	'zoomInUp',
					),
					'description'	=> __( 'Choose the animation effect on the row when scrolled into view.', 'bethlehem' ),
				),
			);
			
			foreach ($extraParams as $params) {
				vc_add_param( $base, $params );
			}

			// Update 'vc_row' to include custom shortcode template and re-map shortcode
			vc_map_update( 'vc_row');
		}
	}
}

if( ! function_exists( 'bethlehem_apply_custom_css' ) ) {
	/**
	 * Applies CSS animation class to vc_row element
	 */
	function bethlehem_apply_custom_css( $css_classes, $base, $atts ) {
		if( $base == 'vc_row' ) {
			
			extract( shortcode_atts( array(
				'row_animation'		=> '',
			), $atts ) );
			
			if( ! empty( $row_animation ) && $row_animation != 'none' ) {
				$css_classes .= ' wow ' . $row_animation;
			}
		}

		return $css_classes;
	}
}