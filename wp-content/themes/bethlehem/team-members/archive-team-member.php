<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
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

			<?php if ( have_posts() ) : ?>
				<div class="team-archive">
					<?php
						/**
						 * team_members_before_loop hook
						 *
						 */
						do_action( 'team_members_before_loop' );
					?>
					<div class="team-small">
						<?php while ( have_posts() ) :  the_post(); ?>
							<div class="member">
								<?php
									/**
									 * team_members_before_loop_content hook
									 *
									 * @hooked our_team_archive_post_thumbnail - 10
									 */
									do_action( 'team_members_before_loop_content' );
								?>

								<div class="member-info">
									<?php
										/**
										 * team_members_loop_content hook
										 *
										 * @hooked our_team_archive_post_title - 10
										 * @hooked our_team_member_read_more - 20
										 * @hooked our_team_member_archive_social_links - 30
										 */
										do_action( 'team_members_loop_content' );
									?>
								</div>

								<?php
									/**
									 * team_members_after_loop_content hook
									 *
									 */
									do_action( 'team_members_after_loop_content' );
								?>
							</div>
						<?php endwhile; ?>
					</div>
					<?php
						/**
						 * team_members_after_loop hook
						 *
						 */
						do_action( 'team_members_after_loop' );
					?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'templates/contents/content', 'none' ); ?>
			<?php endif; ?>

		</main>
	</div>

	<?php
		/**
		 * team_members_after_main_content hook
		 *
		 */
		do_action( 'team_members_after_main_content' );
	?>
<?php
	get_footer();