<div class="beth-metabox beth-page-meta">
	
	<div class="form-group">
		<?php $mb->the_field('hide_title'); ?>
		<div class="checkbox">
			<label id="label-beth-metabox-hide-title"><input type="checkbox" id="beth-metabox-hide-title" name="<?php $mb->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1'); ?>/> <?php echo __( 'Hide Title', 'bethlehem' ); ?></label>
		</div>
		<span class="help-block"><em><?php echo __( 'Check this if you do not want to display title in your page.', 'bethlehem' ); ?></em></span>
	</div>
	<div class="hide-title form-group">
		<?php $mb->the_field( 'page_title' ); ?>
		<label for="beth-page-meta-page-title"><?php echo __( 'Page Title', 'bethlehem' ); ?></label>
		<input id="beth-page-meta-page-title" class="form-control" type="text" name="<?php $mb->the_name('page_title'); ?>" value="<?php $mb->the_value('page_title'); ?>">
		<span class="help-block"><em><?php echo __( 'Leave blank if you do not want to display a different title for your page', 'bethlehem' );?>.</em></span>
	</div>
	<div class="hide-title form-group">
		<?php $mb->the_field( 'page_subtitle' ); ?>
		<label for="beth-page-meta-page-subtitle"><?php echo __( 'Page Subtitle', 'bethlehem' );?></label>
		<input id="beth-page-meta-page-subtitle" class="form-control" type="text" name="<?php $mb->the_name('page_subtitle'); ?>" value="<?php $mb->the_value('page_subtitle'); ?>">
	</div>
	<div class="form-group">
		<?php $mb->the_field('container_unwrap'); ?>
		<div class="checkbox">
			<label><input type="checkbox" name="<?php $mb->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1'); ?>/> <?php echo __( 'Do not wrap the page with a container.', 'bethlehem' ); ?></label>
		</div>
		<span class="help-block"><em><?php echo __( 'Check this if you want your page elements run full width without being contained. Eg, Banner Element on About Page, Full-width donation slider on Home Page.', 'bethlehem' ); ?></em></span>
	</div>

	<?php if( post_type_exists( 'static_block' ) ) : ?>
	
	<?php
		$args = array(
			'posts_per_page'	=> 20,
			'orderby'			=> 'title',
			'post_type'			=> 'static_block',
		);
		$static_blocks = get_posts( $args );

		if( !empty( $static_blocks ) ) :
	?>

			<div class="form-group">
				
				<?php $mb->the_field( 'header_content_static_block_ID' ); ?>
				<label for="header-content-static-block-id"><?php echo __( 'Header Content', 'bethlehem' ); ?></label>
				<select id="header-content-static-block-id" class="form-control" name="<?php $mb->the_name( 'header_content_static_block_ID' ); ?>">
					<option value=""><?php echo __( 'Select a Static Block', 'bethlehem' ); ?></option>
				<?php foreach( $static_blocks as $static_block ) : ?>
					<option value="<?php echo esc_attr( $static_block->ID ); ?>"<?php $mb->the_select_state( $static_block->ID ); ?>><?php echo get_the_title( $static_block->ID ); ?></option>
				<?php endforeach; ?>
				</select>

			</div>

		<?php endif; ?>

	<?php endif; ?>
</div>
<script type="text/javascript">
jQuery(function ($) {
	$(document).ready(function(){
		toggleTitleFields();
		$('#beth-metabox-hide-title, #label-beth-metabox-hide-title').on('click', function(){
			toggleTitleFields();
		});	
	});

	function toggleTitleFields(){
		if($('#beth-metabox-hide-title').prop('checked')){
			$('.hide-title').hide();
		}else{
			$('.hide-title').show();
		}
	}
});

</script>
<style type="text/css">
	.beth-metabox input,
	.beth-metabox button,
	.beth-metabox select,
	.beth-metabox textarea {
	    font-family: inherit;
	    font-size: inherit;
	    line-height: inherit;
	}
	.beth-metabox fieldset {
	    min-width: 0;
	    padding: 0;
	    margin: 0;
	    border: 0;
	}
	.beth-metabox legend {
	    display: block;
	    width: 100%;
	    padding: 0;
	    margin-bottom: 20px;
	    font-size: 21px;
	    line-height: inherit;
	    color: #333;
	    border: 0;
	    border-bottom: 1px solid #e5e5e5;
	}
	.beth-metabox label {
	    display: inline-block;
	    max-width: 100%;
	    margin-bottom: 5px;
	    font-weight: bold;
	}
	.beth-metabox input[type="search"] {
	    -webkit-box-sizing: border-box;
	    -moz-box-sizing: border-box;
	    box-sizing: border-box;
	}
	.beth-metabox input[type="radio"],
	.beth-metabox input[type="checkbox"] {
	    margin: 4px 0 0;
	    margin-top: 1px \9;
	    line-height: normal;
	}
	.beth-metabox input[type="file"] {
	    display: block;
	}
	.beth-metabox input[type="range"] {
	    display: block;
	    width: 100%;
	}
	.beth-metabox select[multiple],
	.beth-metabox select[size] {
	    height: auto;
	}

	.beth-metabox output {
	    display: block;
	    padding-top: 7px;
	    font-size: 14px;
	    line-height: 1.42857143;
	    color: #555;
	}
	.beth-metabox .form-control {
	    display: block;
	    width: 100%;
	    height: 34px;
	    padding: 6px 12px;
	    font-size: 14px;
	    line-height: 1.42857143;
	    color: #555;
	    background-color: #fff;
	    background-image: none;
	    border: 1px solid #ccc;
	    border-radius: 4px;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	    -webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
	    -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
	    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
	}
	.beth-metabox .form-control::-moz-placeholder {
	    color: #777;
	    opacity: 1;
	}
	.beth-metabox .form-control:-ms-input-placeholder {
	    color: #777;
	}
	.beth-metabox .form-control::-webkit-input-placeholder {
	    color: #777;
	}
	.beth-metabox .form-control[disabled],
	.beth-metabox .form-control[readonly],
	.beth-metabox fieldset[disabled] .form-control {
	    cursor: not-allowed;
	    background-color: #eee;
	    opacity: 1;
	}
	.beth-metabox textarea.form-control {
	    height: auto;
	}
	.beth-metabox input[type="search"] {
	    -webkit-appearance: none;
	}
	.beth-metabox input[type="date"],
	.beth-metabox input[type="time"],
	.beth-metabox input[type="datetime-local"],
	.beth-metabox input[type="month"] {
	    line-height: 34px;
	    line-height: 1.42857143 \0;
	}
	.beth-metabox input[type="date"].input-sm,
	.beth-metabox input[type="time"].input-sm,
	.beth-metabox input[type="datetime-local"].input-sm,
	.beth-metabox input[type="month"].input-sm {
	    line-height: 30px;
	}
	.beth-metabox input[type="date"].input-lg,
	.beth-metabox input[type="time"].input-lg,
	.beth-metabox input[type="datetime-local"].input-lg,
	.beth-metabox input[type="month"].input-lg {
	    line-height: 46px;
	}
	.beth-metabox .form-group {
	    margin-bottom: 15px;
	}
	.beth-metabox .radio,
	.beth-metabox .checkbox {
	    position: relative;
	    display: block;
	    min-height: 20px;
	    margin-top: 10px;
	    margin-bottom: 10px;
	}
	.beth-metabox .radio label,
	.beth-metabox .checkbox label {
	    padding-left: 20px;
	    margin-bottom: 0;
	    font-weight: normal;
	    cursor: pointer;
	}
	.beth-metabox .radio input[type="radio"],
	.beth-metabox .radio-inline input[type="radio"],
	.beth-metabox .checkbox input[type="checkbox"],
	.beth-metabox .checkbox-inline input[type="checkbox"] {
	    position: absolute;
	    margin-top: 4px \9;
	    margin-left: -20px;
	}
	.beth-metabox .radio + .radio,
	.beth-metabox .checkbox + .checkbox {
	    margin-top: -5px;
	}
	.beth-metabox .radio-inline,
	.beth-metabox .checkbox-inline {
	    display: inline-block;
	    padding-left: 20px;
	    margin-bottom: 0;
	    font-weight: normal;
	    vertical-align: middle;
	    cursor: pointer;
	}
	.beth-metabox .radio-inline + .radio-inline,
	.beth-metabox .checkbox-inline + .checkbox-inline {
	    margin-top: 0;
	    margin-left: 10px;
	}
	.beth-metabox input[type="radio"][disabled],
	.beth-metabox input[type="checkbox"][disabled],
	.beth-metabox input[type="radio"].disabled,
	.beth-metabox input[type="checkbox"].disabled,
	.beth-metabox fieldset[disabled] input[type="radio"],
	.beth-metabox fieldset[disabled] input[type="checkbox"] {
	    cursor: not-allowed;
	}
	.beth-metabox .radio-inline.disabled,
	.beth-metabox .checkbox-inline.disabled,
	.beth-metabox fieldset[disabled] .radio-inline,
	.beth-metabox fieldset[disabled] .checkbox-inline {
	    cursor: not-allowed;
	}
	.beth-metabox .radio.disabled label,
	.beth-metabox .checkbox.disabled label,
	.beth-metabox fieldset[disabled] .radio label,
	.beth-metabox fieldset[disabled] .checkbox label {
	    cursor: not-allowed;
	}
	.beth-metabox .form-control-static {
	    padding-top: 7px;
	    padding-bottom: 7px;
	    margin-bottom: 0;
	}
	.beth-metabox .form-control-static.input-lg,
	.beth-metabox .form-control-static.input-sm {
	    padding-right: 0;
	    padding-left: 0;
	}
	.beth-metabox .input-sm,
	.beth-metabox .form-horizontal .form-group-sm .form-control {
	    height: 30px;
	    padding: 5px 10px;
	    font-size: 12px;
	    line-height: 1.5;
	    border-radius: 3px;
	}
	.beth-metabox select.input-sm {
	    height: 30px;
	    line-height: 30px;
	}
	.beth-metabox textarea.input-sm,
	.beth-metabox select[multiple].input-sm {
	    height: auto;
	}
	.beth-metabox .input-lg,
	.beth-metabox .form-horizontal .form-group-lg .form-control {
	    height: 46px;
	    padding: 10px 16px;
	    font-size: 18px;
	    line-height: 1.33;
	    border-radius: 6px;
	}
	.beth-metabox select.input-lg {
	    height: 46px;
	    line-height: 46px;
	}
	.beth-metabox textarea.input-lg,
	.beth-metabox select[multiple].input-lg {
	    height: auto;
	}
	.beth-metabox .has-feedback {
	    position: relative;
	}
	.beth-metabox .has-feedback .form-control {
	    padding-right: 42.5px;
	}
	.beth-metabox .form-control-feedback {
	    position: absolute;
	    top: 25px;
	    right: 0;
	    z-index: 2;
	    display: block;
	    width: 34px;
	    height: 34px;
	    line-height: 34px;
	    text-align: center;
	}
	.beth-metabox .input-lg + .form-control-feedback {
	    width: 46px;
	    height: 46px;
	    line-height: 46px;
	}
	.beth-metabox .input-sm + .form-control-feedback {
	    width: 30px;
	    height: 30px;
	    line-height: 30px;
	}
	.beth-metabox .has-feedback label.sr-only ~ .form-control-feedback {
	    top: 0;
	}
	.beth-metabox .help-block {
	    display: block;
	    margin-top: 5px;
	    margin-bottom: 10px;
	    color: #737373;
	}
</style>