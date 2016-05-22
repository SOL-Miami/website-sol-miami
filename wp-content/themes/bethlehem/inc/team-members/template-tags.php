<?php
/**
 * Custom template tags used to integrate this theme with Our Team.
 *
 * @package bethlehem
 */

/**
 * Archive Post Thumbnail
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_archive_post_thumbnail' ) ) {
	function our_team_archive_post_thumbnail() {
		echo '<a href="' .get_the_permalink(). '">';
		echo get_the_post_thumbnail();
		echo '</a>';
	}
}

/**
 * Single Post Thumbnail
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_single_post_thumbnail' ) ) {
	function our_team_single_post_thumbnail() {
		echo get_the_post_thumbnail( get_the_ID() );
	}
}

/**
 * Archive Post Title
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_archive_post_title' ) ) {
	function our_team_archive_post_title() {
		echo '<h4>';
		the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' );
		our_team_member_role();
		echo '</h4>';
	}
}

/**
 * Single Post Title
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_single_post_title' ) ) {
	function our_team_single_post_title() {
		the_title( '<h4>', '</h4>' );
	}
}

/**
 * Post Content
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_post_content' ) ) {
	function our_team_post_content() {
		the_content();
	}
}

/**
 * Excerpt
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_post_excerpt' ) ) {
	function our_team_post_excerpt() {
		echo '<div class="team-member-desc">';
		the_excerpt();
		echo '</div>';
	}
}

/**
 * Role
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_member_role' ) ) {
	function our_team_member_role() {
		$role = esc_attr( get_post_meta( get_the_ID(), '_byline', true ) );
		if( !empty( $role ) ) {
			echo '<span class="role">'.$role.'</span>';
		}
	}
}

/**
 * Read More
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_member_read_more' ) ) {
	function our_team_member_read_more() {
		?>
		<div class="line"></div>
		<a class="hb-more" href="<?php the_permalink(); ?>"><?php echo __('Read more', 'bethlehem'); ?></a>
		<?php
	}
}

/**
 * Social Links
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_member_archive_social_links' ) ) {
	function our_team_member_archive_social_links() {
		
		if ( apply_filters( 'enable_archive_team_member_social', TRUE ) ) :
			$twitter 			= esc_attr( get_post_meta( get_the_ID(), '_twitter', true ) );
			$facebook			= esc_attr( get_post_meta( get_the_ID(), '_facebook', true ) );
			$skype 				= esc_attr( get_post_meta( get_the_ID(), '_skype', true ) );
			$mail 				= esc_attr( get_post_meta( get_the_ID(), '_contact_email', true ) );
			$url 				= esc_attr( get_post_meta( get_the_ID(), '_url', true ) );

			$social_icons = apply_filters( 'our_team_member_archive_social_links_icons_args', array(
	                'skype'			=> array( 
	                	'class' 		=> 'hb-sky', 
	                	'icon' 			=> 'fa fa-skype', 
	                	'title' 		=> __( 'Add me on Skype', 'bethlehem' ),
	                	'social_link' 	=> $skype 
	            	),
	                'mail'	=> array( 
	                	'class' 		=> 'hb-mail', 
	                	'icon' 			=> 'fa fa-envelope', 
	                	'title' 		=> __( 'E-mail me', 'bethlehem' ),
	                	'social_link' 	=> $mail 
	            	)
	            )
			);
			?>
			<ul class="hb-social">
				<?php foreach ($social_icons as $social_icon) : ?>
					<?php if( !empty( $social_icon['social_link'] ) ) :?>
					<li class="<?php echo $social_icon['class']; ?>"><a href="<?php echo esc_url( $social_icon['social_link'] ); ?>"><i class="<?php echo $social_icon['icon']; ?>"></i></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<?php
		endif;
	}
}

/**
 * Social Links
 * @since   1.0.0
 * @return  void
 */
if ( !function_exists( 'our_team_member_single_social_links' ) ) {
	function our_team_member_single_social_links() {
		
		if ( apply_filters( 'enable_single_team_member_social', TRUE ) ) :
			$twitter 			= esc_attr( get_post_meta( get_the_ID(), '_twitter', true ) );
			$facebook			= esc_attr( get_post_meta( get_the_ID(), '_facebook', true ) );
			$skype 				= esc_attr( get_post_meta( get_the_ID(), '_skype', true ) );
			$mail 				= esc_attr( get_post_meta( get_the_ID(), '_contact_email', true ) );
			$url 				= esc_attr( get_post_meta( get_the_ID(), '_url', true ) );

			$social_icons = apply_filters( 'our_team_member_single_social_links_icons_args', array(
	                'twitter'		=> array( 
	                	'class' 		=> 'hb-tw', 
	                	'icon' 			=> 'fa fa-twitter', 
	                	'title' 		=> __( 'Follow me on Twitter', 'bethlehem' ),
	                	'social_link' 	=> $twitter 
	            	),
	                'facebook'		=> array( 
	                	'class' 		=> 'hb-fb', 
	                	'icon' 			=> 'fa fa-facebook', 
	                	'title' 		=> __( 'Find me on Facebook', 'bethlehem' ),
	                	'social_link' 	=> $facebook 
	            	),
	                'skype'			=> array( 
	                	'class' 		=> 'hb-sky', 
	                	'icon' 			=> 'fa fa-skype', 
	                	'title' 		=> __( 'Add me on Skype', 'bethlehem' ),
	                	'social_link' 	=> $skype 
	            	),
	                'mail'	=> array( 
	                	'class' 		=> 'hb-mail', 
	                	'icon' 			=> 'fa fa-envelope', 
	                	'title' 		=> __( 'E-mail me', 'bethlehem' ),
	                	'social_link' 	=> $mail 
	            	),
	                'url'		=> array( 
	                	'class' 		=> 'hb-rss', 
	                	'icon' 			=> 'fa fa-rss', 
	                	'title' 		=> __( 'Reply my Blog', 'bethlehem' ), 
	                	'social_link' 	=> $url 
	            	)
				)
			);
			?>
			<ul class="hb-social team-single-contact-meta">
				<?php foreach ($social_icons as $social_icon) : ?>
					<?php if( !empty( $social_icon['social_link'] ) ) :?>
					<li class="<?php echo $social_icon['class']; ?>"><a href="<?php echo esc_url( $social_icon['social_link'] ); ?>"><i class="<?php echo $social_icon['icon']; ?>"></i><span><?php echo $social_icon['title']; ?></span></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<?php
		endif;
	}
}
