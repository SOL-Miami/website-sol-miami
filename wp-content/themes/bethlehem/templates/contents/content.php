<?php
/**
 * @package bethlehem
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
	/**
 	 * @hooked bethlehem_post_header() - 10
 	 * @hooked bethlehem_post_content() - 30
	 */
	do_action( 'bethlehem_loop_post' );
	?>

</article><!-- #post-## -->