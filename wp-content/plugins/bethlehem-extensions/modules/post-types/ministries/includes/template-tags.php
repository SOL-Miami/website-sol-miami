<?php
/**
 * The template for displaying ministries content.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! function_exists( 'ministries_loop_thumbnail' ) ) {
	/**
	 * Displays ministries loop thumbnail
	 * @since 1.0.0
	 * @return void
	 */
	function ministries_loop_thumbnail() {
		if( function_exists( 'bethlehem_get_thumbnail' ) ) {
			$post_id = get_the_ID();
			echo bethlehem_get_thumbnail( $post_id, 'post-thumbnail', TRUE, TRUE, 'fa fa-group' );
		}
	}
}

if( ! function_exists( 'ministries_single_thumbnail' ) ) {
	/**
	 * Displays Ministries Single Thumbnail
	 * @since 1.0.0
	 * @return void
	 */
	function ministries_single_thumbnail() {
		if( function_exists( 'bethlehem_get_thumbnail' ) ) {
			$post_id = get_the_ID();
			echo bethlehem_get_thumbnail( $post_id, 'large', FALSE, FALSE );
		}
	}
}

if( ! function_exists( 'ministries_single_post_title' ) ) {
	function ministries_single_post_title() {
		?>
		<h2 class="title"><?php the_title(); ?></h2>
		<?php
	}
}

if( ! function_exists( 'ministries_archive_post_title' ) ) {
	function ministries_archive_post_title() {
		?>
		<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php
	}
}

if( ! function_exists( 'ministries_post_content' ) ) {
	function ministries_post_content() {
		?>
		<div class="description" itemprop="description">
			<?php the_content(); ?>
		</div>
		<?php
	}
}

if( ! function_exists( 'ministries_post_excerpt' ) ) {
	function ministries_post_excerpt() {
		$excerpt_length = apply_filters( 'ministries_excerpt_length', 75 );
		?>
		<div class="description" itemprop="description">
			<?php echo custom_excerpt( get_the_content(), $excerpt_length ); ?>
		</div>
		<?php
	}
}

if( ! function_exists( 'ministries_grid_content' ) ) {
	function ministries_grid_content() {
		load_template( MINISTRIES_DIR . '/content-grid.php');
	}
}

if( ! function_exists( 'ministries_list_content' ) ) {
	function ministries_list_content() {
		load_template( MINISTRIES_DIR . '/content-list.php');
	}
}

if( ! function_exists( 'ministries_social_icons' ) ) {
	function ministries_social_icons() {
		$id = get_the_ID();
		$meta = get_post_meta( $id );

		$fb = (isset($meta['_facebook'][0]) ? $meta['_facebook'][0] : '');
		$tw = (isset($meta['_twitter'][0]) ? $meta['_twitter'][0] : '');
		$gp = (isset($meta['_googleplus'][0]) ? $meta['_googleplus'][0] : '');

		if (!empty($fb)) {
			$fburl = 'http://facebook.com/'.$fb;
		}
		if (!empty($tw)) {
			$twurl = 'http://twitter.com/'.$tw;
		}
		if (!empty($gp)) {
			$gpurl = 'http://plus.google.com/'.$gp;
		}

		?>
		<ul class="hb-social">
			<?php if (isset($fburl)) : ?>
				<li class="hb-fb"><a href="<?php echo esc_url( $fburl ); ?>"><i class="fa fa-facebook"></i></a></li>
			<?php endif; ?>
			<?php if (isset($twurl)) : ?>
				<li class="hb-tw"><a href="<?php echo esc_url( $twurl ); ?>"><i class="fa fa-twitter"></i></a></li>
			<?php endif; ?>
			<?php if (isset($gpurl)) : ?>
				<li class="hb-plus"><a href="<?php echo esc_url( $gpurl ); ?>"><i class="fa fa-google-plus"></i></a></li>
			<?php endif; ?>
		</ul>
		<?php
	}
}

if( ! function_exists( 'ministries_tab_pane_wrapper_start' ) ) {
	function ministries_tab_pane_wrapper_start() {
		echo '<div class="tab-content grid-list">';
	}
}

if( ! function_exists( 'ministries_grid_tab_wrapper_start' ) ) {
	function ministries_grid_tab_wrapper_start() {
		extract( ministries_tab_pane_classes() );
		?>
		<div id="grid-view" class="tab-pane <?php echo esc_attr( $grid_tab_pane_class ); ?>">
		<?php
	}
}

if( ! function_exists( 'ministries_list_tab_wrapper_start' ) ) {
	function ministries_list_tab_wrapper_start() {
		extract( ministries_tab_pane_classes() );
		?>
		<div id="list-view" class="tab-pane <?php echo esc_attr( $list_tab_pane_class ); ?>">
		<?php
	}
}

if( ! function_exists( 'ministries_content_wrapper_start' ) ) {
	function ministries_content_wrapper_start() {
		echo '<div class="list-view-content">';
	}
}

if( ! function_exists( 'ministries_div_wrapper_end' ) ) {
	function ministries_div_wrapper_end () {
		echo '</div>';
	}
}

if( ! function_exists( 'ministries_head' ) ) {
	function ministries_head () {
		?>
		<div class="ministries-head">
			<h5><?php echo _e( 'Ministries', 'bethlehem-extension' ); ?></h5>
			<?php ministries_tab_pane(); ?>
		</div>
		<?php
	}
}

if( ! function_exists( 'ministries_tab_pane_classes' ) ) {
	function ministries_tab_pane_classes () {
		if ( get_option('ministries_settings') !== false ) {
			$settings = get_option('ministries_settings');
		}
		$default_view = (isset($settings['default_view']) ? $settings['default_view'] : 'grid' );

		$grid_tab_pane_class = ( $default_view == 'grid' ? 'active' : '' );
		$list_tab_pane_class = ( $default_view == 'list' ? 'active' : '' );

		return array( 'list_tab_pane_class' => $list_tab_pane_class, 'grid_tab_pane_class' => $grid_tab_pane_class );
	}
}

if( ! function_exists( 'ministries_tab_pane' ) ) {
	function ministries_tab_pane () {
		extract( ministries_tab_pane_classes() );
		?>
		<ul>
		    <li class="grid-list-button-item grid-view <?php echo esc_attr( $grid_tab_pane_class ); ?>">
		    	<a href="#grid-view" data-toggle="tab"><?php echo _x( 'Grid', 'Grid as in list view/grid view', 'bethlehem-extension' );?></a>
		    </li>
		    <li class="grid-list-button-item list-view <?php echo esc_attr( $list_tab_pane_class ); ?>">
		    	<a href="#list-view" data-toggle="tab"><?php echo _x( 'List', 'List as in list view/grid view', 'bethlehem-extension' ); ?></a>
		    </li>
		</ul>
		<?php
	}
}

if( ! function_exists( 'ministries_sidebar' ) ) {
	function ministries_sidebar() {
		$layout = bethlehem_get_layout();

		if( $layout == 'right-sidebar' || $layout == 'left-sidebar' ){
			get_sidebar('ministries');
		}
	}
}
