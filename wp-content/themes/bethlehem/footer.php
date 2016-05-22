<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package bethlehem
 */
?>
	</div><!-- #content -->

	<?php do_action( 'bethlehem_before_footer' ); ?>

	<?php
	/**
	 * @hooked bethlehem_get_footer_template - 10
	 */
	do_action( 'bethlehem_footer' ); ?>


	<?php do_action( 'bethlehem_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
