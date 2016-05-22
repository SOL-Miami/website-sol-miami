<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The Template for displaying all single team-member post.
 */
	get_header();
?>

<?php
	/**
	 * team_members_before_main_content hook
	 *
	 */
	do_action( 'team_members_before_main_content' );
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		
		<div class="team-single">

			<?php if ( have_posts() ) : ?>
				<div class="single-team">
					<?php
						/**
						 * team_members_before_single_content hook
						 *
						 */
						do_action( 'team_members_before_single_content' );
					?>
					<?php while ( have_posts() ) :  the_post(); ?>
						<div class="team-single-content">
							<div class="team-single-meta">
								<?php
									/**
									 * team_members_single_content hook
									 *
									 * @hooked our_team_single_post_thumbnail - 10
									 * @hooked our_team_member_single_social_links - 20
									 */
									do_action( 'team_members_single_post_thumbnail' );
								?>
							</div>
							<div class="team-single-info">
								<?php
									/**
									 * team_members_single_content hook
									 *
									 * @hooked our_team_single_post_title - 10
									 * @hooked our_team_member_role - 20
									 * @hooked our_team_post_content - 30
									 */
									do_action( 'team_members_single_content' );
								?>
							</div>
						</div>
					<?php endwhile; ?>
					<?php
						/**
						 * team_members_after_single_content hook
						 *
						 */
						do_action( 'team_members_after_single_content' );
					?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'templates/contents/content', 'none' ); ?>
			<?php endif; ?>

		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
	/**
	 * team_members_after_main_content hook
	 *
	 */
	do_action( 'team_members_after_main_content' );
?>

<?php get_sidebar('team-member'); ?>

<?php
	get_footer();
