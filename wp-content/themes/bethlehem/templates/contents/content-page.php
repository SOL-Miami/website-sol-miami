<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package bethlehem
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * @hooked bethlehem_page_header - 10
	 * @hooked bethlehem_page_content - 20
	 */
	do_action( 'bethlehem_page' );
	?>
</article><!-- #post-## -->
