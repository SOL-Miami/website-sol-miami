<?php
/**
 * General functions used to integrate this theme with Give.
 *
 * @package bethlehem
 */

if( ! function_exists( 'bethlehem_give_checkout_final_total' ) ) {
	function bethlehem_give_checkout_final_total( $form_id ) {
		global $give_options;

		$variable_pricing    = give_has_variable_prices( $form_id );
		$allow_custom_amount = get_post_meta( $form_id, '_give_custom_amount', true );
		$currency_position   = isset( $give_options['currency_position'] ) ? $give_options['currency_position'] : 'before';
		$symbol              = isset( $give_options['currency'] ) ? give_currency_symbol( $give_options['currency'] ) : '$';
		$currency_output     = '<span class="give-currency-symbol give-currency-position-' . $currency_position . '">' . $symbol . '</span>';
		$default_amount      = give_get_default_form_amount( $form_id );
		$custom_amount_text  = get_post_meta( $form_id, '_give_custom_amount_text', true );

		if ( isset( $_POST['give_total'] ) ) {
			$total = apply_filters( 'give_donation_total', $_POST['give_total'] );
		} else {
			//default total
			$total = give_get_default_form_amount( $form_id );
		}
		//Only proceed if give_total available
		if ( empty( $total ) ) {
			return;
		}
		?>

		<?php if ( $allow_custom_amount == 'no' ) : ?>
			<input id="give-amount" class="give-amount-hidden" type="hidden" name="give-amount" value="<?php echo esc_attr( $default_amount ); ?>" required>
			<p class="set-price give-donation-amount form-row-wide">
				<?php

				if ( $currency_position == 'before' ) {
					echo $currency_output;
				}

				?>
				<span id="give-amount" class="give-text-input"><?php echo give_format_amount( $default_amount ); ?></span>
			</p>
		<?php else : ?>
			<div class="give-final-total-wrap form-wrap">
				<?php
				if ( $currency_position == 'before' ) {
					echo $currency_output;
				}
				?>
				<input class="give-total-amount required" id="give-amount" name="give-amount" type="text" value="<?php echo $total; ?>" required autocomplete="off">
				<?php
				if ( $currency_position == 'after' ) {
					echo $currency_output;
				}
				?>
				<p class="give-loading-text give-updating-price-loader" style="display: none;">
					<span class="give-loading-animation"></span> <?php _e( 'Updating Price', 'bethlehem' ); ?>
					<span class="elipsis">.</span><span class="elipsis">.</span><span class="elipsis">.</span>
				</p>
			</div>
		<?php
		endif;

		//Custom Amount Text
		if ( ! empty( $custom_amount_text ) && ! $variable_pricing && $allow_custom_amount == 'yes' ) :
			?>
			<p class="give-custom-amount-text"><?php echo $custom_amount_text; ?></p>
			<?php
		endif;

		//Output Variable Pricing Levels
		if ( $variable_pricing ) {
			give_output_levels( $form_id );
		}

		?>
		<script type="text/javascript">
			(function($) {
				$(document).ready(function() {

					$('.give-total-wrap').hide();
					$('.give-btn-modal').off('click');

					$( 'body' ).on( 'click', '.give-btn-modal', function ( e ) {

						e.preventDefault();
						var this_form = $( this ).parents( 'div.give-form-wrap' );
						var this_amount_field = this_form.find( '#give-amount' );
						var this_amount = this_amount_field.val();

						//Alls well, open popup!
						$.magnificPopup.open( {
							mainClass: 'give-modal',
							items  : {
								src : this_form,
								type: 'inline'
							},
							open: function () {
								// Will fire when this exact popup is opened
								// this - is Magnific Popup object
							},
							close  : function () {
								//Remove popup class
								this_form.removeClass( 'mfp-hide' );
							}
						} );

					} );

					$( 'body' ).on( 'focus', '.give-total-amount', function ( e ) {

						//Remove any invalid class
						$( this ).removeClass( 'invalid-amount' );

						//Fire up Mask Money
						$( this ).maskMoney( {
							decimal  : give_global_vars.decimal_separator,
							thousands: give_global_vars.thousands_separator
						} );

						var parent_form = $( this ).parents( 'form' );

						//Set data amount
						$( this ).data( 'amount', $( this ).val() );
						//This class is used for CSS purposes
						$( this ).parent( '.give-donation-amount' ).addClass( 'give-custom-amount-focus-in' );
						//Set Multi-Level to Custom Amount Field
						parent_form.find( '.give-default-level, .give-radio-input' ).removeClass( 'give-default-level' );
						parent_form.find( '.give-btn-level-custom' ).addClass( 'give-default-level' );
						parent_form.find( '.give-radio-input' ).prop( 'checked', false ); //Radio
						parent_form.find( '.give-radio-input.give-radio-level-custom' ).prop( 'checked', true ); //Radio
						parent_form.find( '.give-select-level' ).prop( 'selected', false ); //Select
						parent_form.find( '.give-select-level .give-donation-level-custom' ).prop( 'selected', true ); //Select

					} );

					$( 'body' ).on( 'blur', '.give-total-amount', function ( e ) {

						var pre_focus_amount = $( this ).data( 'amount' );
						var value_now = $( this ).val();

						//Does this number have a value?
						if ( !value_now || value_now <= 0 ) {
							$( this ).addClass( 'invalid-amount' );
						}

						//If values don't match up then proceed with updating donation total value
						if ( pre_focus_amount !== value_now ) {
							//update checkout total (include currency sign)
							$( this ).parents( 'form' ).find( '.give-total-amount' ).val( value_now );

							//fade in/out updating text
							$( this ).next( '.give-updating-price-loader' ).find( '.give-loading-animation' ).css( 'background-image', 'url(' + give_scripts.ajax_loader + ')' );
							$( this ).next( '.give-updating-price-loader' ).stop().fadeIn().fadeOut();

						}
						//This class is used for CSS purposes
						$( this ).parent( '.give-donation-amount' ).removeClass( 'give-custom-amount-focus-in' );

					} );

					//Multi-level Buttons: Update Amount Field based on Multi-level Donation Select
					$( 'body' ).on( 'click touchend', '.give-donation-level-btn', function ( e ) {
						e.preventDefault(); //don't let the form submit
						bethlehem_update_multiselect_vals( $( this ) );
					} );

					//Multi-level Radios: Update Amount Field based on Multi-level Donation Select
					$( 'body' ).on( 'click touchend', '.give-radio-input-level', function ( e ) {
						bethlehem_update_multiselect_vals( $( this ) );
					} );

					//Multi-level Radios: Update Amount Field based on Multi-level Donation Select
					$( 'body' ).on( 'change', '.give-select-level', function ( e ) {
						bethlehem_update_multiselect_vals( $( this ) );
					} );

				 });

				function bethlehem_update_multiselect_vals( selected_field ) {

					var parent_form = selected_field.parents( 'form' );
					var this_amount = selected_field.val();
					var price_id = selected_field.data( 'price-id' );
					var currency_symbol = parent_form.find( '.give-currency-symbol' ).text();

					//remove old selected class & add class for CSS purposes
					$( selected_field ).parents( '.give-donation-levels-wrap' ).find( '.give-default-level' ).removeClass( 'give-default-level' );
					$( selected_field ).addClass( 'give-default-level' );
					parent_form.find( '.give-amount-top' ).removeClass( 'invalid-amount' );

					//Is this a custom amount selection?
					if ( this_amount === 'custom' ) {
						//It is, so focus on the custom amount input
						parent_form.find( '.give-amount-top' ).val( '' ).focus();
						return false; //Bounce out
					}

					//check if price ID blank because of dropdown type
					if ( !price_id ) {
						price_id = selected_field.find( 'option:selected' ).data( 'price-id' );
					}

					//Fade in/out price loading updating image
					parent_form.find( '.give-updating-price-loader' ).stop().fadeIn().fadeOut();

					//update price id field for variable products
					parent_form.find( 'input[name=give-price-id]' ).val( price_id );

					//Update hidden price field
					parent_form.find( '.give-amount-hidden' ).val( this_amount );
					
					//update custom amount field
					parent_form.find( '.give-amount-top' ).val( this_amount );
					parent_form.find( 'span.give-amount-top' ).text( this_amount );

					//update checkout total
					var formatted_total = currency_symbol + this_amount;

					if ( give_global_vars.currency_pos == 'after' ) {
						formatted_total = this_amount + currency_symbol;
					}

					//Update donation form bottom total data attr and text
					parent_form.find( '.give-total-amount' ).val( this_amount );
				}
			})(jQuery);
		</script>
		<?php
	}
}

if( ! function_exists('bethlehem_donation_single_toggle_hook') ) {
	function bethlehem_donation_single_toggle_hook() {
		if( is_singular( 'give_forms' ) ) {
			remove_action( 'give_pre_form',				'bethlehem_show_goal_progress',	10, 2 );
			add_action( 'give_after_donation_levels',	'bethlehem_show_goal_progress',	10, 2 );
		}
	}
}

if( ! function_exists( 'bethlehem_output_donation_levels' ) ) {
	function bethlehem_output_donation_levels( $form_id = 0, $args = array() ) {
		do_action( 'give_before_donation_levels', $form_id );
		do_action( 'give_after_donation_levels', $form_id, $args );
	}
}

if( ! function_exists( 'bethlehem_give_form_validate_custom_fields' ) ) {
	function bethlehem_give_form_validate_custom_fields( $valid_data, $data ) {

		//Check for a amount data
		if ( !$data['give-amount'] || $data['give-amount'] <= 0 ) {
			give_set_error( 'give-amount', __( 'Please enter amount.', 'bethlehem' ) );
		}
	}
}

if( ! function_exists( 'bethlehem_give_default_wrapper_start' ) ) {
	function bethlehem_give_default_wrapper_start() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
		<?php
	}
}

if( ! function_exists( 'bethlehem_give_default_wrapper_end' ) ) {
	function bethlehem_give_default_wrapper_end() {
		?>
		</main></div>
		<?php
	}
}

if( ! function_exists( 'give_loop_content_info_wrapper_start' ) ) {
	function give_loop_content_info_wrapper_start() {
		echo '<div class="donation-info">';
	}
}

if( ! function_exists( 'give_loop_content_info_wrapper_end' ) ) {
	function give_loop_content_info_wrapper_end() {
		echo '</div>';
	}
}

if( ! function_exists( 'give_archive_post_title' ) ) {
	function give_archive_post_title() {
		?>
		<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php
	}
}

if( ! function_exists( 'give_post_content' ) ) {
	function give_post_content() {
		echo '<div class="description-content">';
		the_content( sprintf( __( 'Continue reading %s', 'bethlehem' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' ) );
		echo '</div>';
	}
}

if( ! function_exists( 'give_post_excerpt' ) ) {
	function give_post_excerpt() {
		$excerpt_length = 75 ; // Excerpt length
		?>
		<div class="description" itemprop="description">
			<?php echo custom_excerpt( get_the_content(), $excerpt_length ); ?>
		</div>
		<?php
	}
}

if( ! function_exists( 'give_donate_btn' ) ) {
	function give_donate_btn() {
		?>
		<a class="give-btn" href="<?php the_permalink(); ?>"><?php _e( 'Donate now', 'bethlehem' ); ?></a>
		<?php
	}
}

if( ! function_exists( 'bethlehem_give_get_sidebar' ) ) {
	function bethlehem_give_get_sidebar() {
		$layout = bethlehem_get_layout();

		if( $layout == 'right-sidebar' || $layout == 'left-sidebar' ){
			get_sidebar('donation');
		}
	}
}

if( ! function_exists( 'bethlehem_give_templates' ) ) {
	function bethlehem_give_templates( $template ) {
		$file = '';

		$give_taxonomies = get_object_taxonomies( 'give_forms' );
		
		if ( is_post_type_archive( 'give_forms' ) ) {
			$file = locate_template('give/archive-give_forms.php');
		} elseif ( !empty( $give_taxonomies ) && is_tax( $give_taxonomies ) ) {
			$file = locate_template('give/archive-give_forms.php');
		}

		if ( $file ) {
			$template = $file;
		}

		return $template;
	}
}

if( ! function_exists( 'bethlehem_give_form_thumbnail_image_size' ) ) {
	function bethlehem_give_form_thumbnail_image_size( $image_size ) {
		return array( 'width' => '241', 'height' => '152', 'crop' => 1 );
	}
}

if( ! function_exists( 'bethlehem_give_form_single_image_size' ) ) {
	function bethlehem_give_form_single_image_size( $image_size ) {
		return array( 'width' => '878', 'height' => '255', 'crop' => 0 );
	}
}

if( ! function_exists( 'bethlehem_form_single_image_size' ) ) {
	function bethlehem_form_single_image_size() {
		return 'give_form_single';
	}
}

if( ! function_exists( 'bethlehem_change_forms_to_causes' ) ) {
	function bethlehem_change_forms_to_causes() {

		$defaults = array(
			'singular' => __( 'Cause', 'bethlehem' ),
			'plural'   => __( 'Causes', 'bethlehem' )
		);

		return $defaults;
	}
}

if( ! function_exists( 'bethlehem_remove_goal_progress_color_meta' ) ) {
	function bethlehem_remove_goal_progress_color_meta( $fields ) {
		$goal_color_ID = '_give_goal_color';

		$new_fields = array();

		foreach( $fields as $field ) {
			if( isset( $field['id'] ) && $field['id'] == $goal_color_ID ) {
				continue;
			}

			$new_fields[] = $field;
		}

		return $new_fields;
	}
}

if( ! function_exists( 'bethlehem_enable_give_form_categories' ) ) {
	function bethlehem_enable_give_form_categories( $settings ) {

		if( apply_filters( 'bethlehem_should_force_give_display_settings', TRUE ) ) {
			foreach( $settings as $key => $setting ) {
				if( $settings[ $key ][ 'id' ] == 'enable_categories' ) {
					$settings[ $key ][ 'default'] = 'on';
				}
			}
		}

		return $settings;
	}
}