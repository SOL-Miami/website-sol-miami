<aside class="tribe-events-single-sidebar widget-area">
	<?php if ( apply_filters( 'events_single_sidebar_contact', TRUE ) ) : ?>
		<?php if( tribe_has_organizer() ) : ?>
			<?php
				$organizer_name = tribe_get_organizer();
				$organizer_mail = tribe_get_organizer_email();
				$organizer = ! empty( $organizer_mail ) ? sprintf( '<a href="mailto:%s">%s</a>', $organizer_mail, $organizer_name ) : $organizer_name;
				$organizer_info = sprintf( __( 'If you have any question about the event please contact %s.', 'bethlehem' ), $organizer );
			?>
			<aside class="side-widget about">
				<h5><?php _e( 'Questions?', 'bethlehem' ); ?></h5>
				<p><?php echo $organizer_info; ?></p>
			</aside>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( apply_filters( 'events_single_sidebar_map', TRUE ) ) : ?>
		<aside class="side-widget map">
			<h5><?php _e( 'Where will be Event?', 'bethlehem' ); ?></h5>
			<?php tribe_get_template_part( 'modules/meta/map' ); ?>
		</aside>
	<?php endif; ?>
	<?php
		if ( apply_filters( 'events_single_sidebar_widgets', TRUE ) && is_active_sidebar( 'events-sidebar-1' ) ) {
			dynamic_sidebar( 'events-sidebar-1' );
		}
	?>
</aside><!-- /.tribe-events-single-sidebar -->