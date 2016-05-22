<?php
/**
 * Template functions used for pages.
 *
 * @package bethlehem
 */

if ( ! function_exists( 'bethlehem_page_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 * @since 1.0.0
	 */
	function bethlehem_page_header() {
		global $bethlehem_page_metabox;
		
		$page_title = $bethlehem_page_metabox->get_the_value( 'page_title' ) ;
		$page_subtitle = $bethlehem_page_metabox->get_the_value( 'page_subtitle' ) ;
		$should_hide_title = bethlehem_should_hide_title();

		if( ! $should_hide_title ) :
		?>
		<header class="entry-header">
			<?php if( empty( $page_title ) ) : ?>
				<?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
			<?php else : ?>
				<h1 class="entry-title" itemprop="name"><?php echo $page_title;?></h1>
			<?php endif; ?>
			<?php if( !empty( $page_subtitle ) ) : ?>
				<p class="page-subtitle"><?php echo $bethlehem_page_metabox->get_the_value( 'page_subtitle' ); ?></p>
			<?php endif; ?>
		</header><!-- .entry-header -->
		<?php
		endif;
	}
}

if ( ! function_exists( 'bethlehem_page_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 * @since 1.0.0
	 */
	function bethlehem_page_content() {
		?>
		<div class="entry-content" itemprop="mainContentOfPage">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'bethlehem' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php
	}
}

// Check to hide title
if( ! function_exists( 'bethlehem_should_hide_title' ) ) :
	function bethlehem_should_hide_title() {
	    global $bethlehem_page_metabox;
	    
	    $postID = get_the_ID();
	    $cart_page_ID = '';
	    $cart_page_ID = get_option( 'woocommerce_cart_page_id' );

	    return ( $bethlehem_page_metabox->get_the_value( 'hide_title' ) === '1' ) || ( $cart_page_ID == $postID );
	}
endif;

if( ! function_exists( 'bethlehem_should_hide_container' ) ) :
	function bethlehem_should_hide_container() {
		global $bethlehem_page_metabox;
		return ( $bethlehem_page_metabox->get_the_value( 'container_unwrap' ) === '1' );
	}
endif;