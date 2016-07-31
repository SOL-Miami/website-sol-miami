<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package bethlehem
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php bethlehem_html_tag_schema(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<script src="https://use.fontawesome.com/8349ea28f8.js"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php
	do_action( 'bethlehem_before_header' ); ?>

	<?php
	/**
	 * @hooked bethlehem_get_header_template - 10
	 */
	do_action( 'bethlehem_header' ); ?>

	<?php
	/**
	 * @hooked bethlehem_header_widget_region - 10
	 */
	do_action( 'bethlehem_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">
		<?php
		/**
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'bethlehem_content_top' ); ?>
