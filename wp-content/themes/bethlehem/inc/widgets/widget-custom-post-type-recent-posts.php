<?php
/**
 * Custom Post Type Recent Posts widget class
 *
 * @since 1.0.0
 */

if( ! class_exists('Bethlehem_Custom_Post_Type_Widgets_Recent_Posts') ) {
	class Bethlehem_Custom_Post_Type_Widgets_Recent_Posts extends WP_Widget {

		public function __construct() {
			$widget_ops = array( 'classname' => 'widget_recent_entries', 'description' => __( 'Your site’s most recent custom Posts.', 'bethlehem' ) );
			parent::__construct( 'custom-post-type-recent-posts', __( 'Recent Posts (Custom Post Type)', 'bethlehem' ), $widget_ops );
			$this->alt_option_name = 'widget_custom_post_type_recent_posts';

			add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
			add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
			add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
		}

		public function widget( $args, $instance ) {
			$cache = array();

			if ( ! $this->is_preview() ) {
				$cache = wp_cache_get( 'widget_custom_post_type_recent_posts', 'widget' );
			}

			if ( ! is_array( $cache ) ) {
				$cache = array();
			}

			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}

			if ( isset( $cache[ $args['widget_id'] ] ) ) {
				echo $cache[ $args['widget_id'] ];
				return;
			}

			ob_start();

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Posts', 'bethlehem' ) : $instance['title'], $instance, $this->id_base );
			$posttype = $instance['posttype'];
			if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
				$number = 5;
			}
			$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

			$post_types = get_post_types( array( 'public' => true ), 'objects' );

			if ( array_key_exists( $posttype, (array) $post_types ) ) {
				$r = new WP_Query( array(
					'post_type' => $posttype,
					'posts_per_page' => $number,
					'no_found_rows' => true,
					'post_status' => 'publish',
					'ignore_sticky_posts' => true,
				) );

				if ( $r->have_posts() ) : ?>
					<?php echo $args['before_widget']; ?>
					<?php if ( $title ) {
						echo $args['before_title'] . $title . $args['after_title'];
					} ?>
					<ul>
					<?php while ( $r->have_posts() ) : $r->the_post(); ?>
						<li><a href="<?php the_permalink() ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
						<?php if ( $show_date ) : ?>
							<span class="post-date"><?php echo get_the_date(); ?></span>
						<?php endif; ?>
						</li>
					<?php endwhile; ?>
					</ul>
					<?php echo $args['after_widget']; ?>
					<?php
					wp_reset_postdata();
				endif;
			}

			if ( ! $this->is_preview() ) {
				$cache[ $args['widget_id'] ] = ob_get_flush();
				wp_cache_set( 'widget_custom_post_type_recent_posts', $cache, 'widget' );
			}
			else {
				ob_end_flush();
			}
		}

		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['posttype'] = strip_tags( $new_instance['posttype'] );
			$instance['number'] = (int) $new_instance['number'];
			$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

			$this->flush_widget_cache();

			$alloptions = wp_cache_get( 'alloptions', 'options' );
			if ( isset( $alloptions['widget_custom_post_type_recent_posts'] ) ) {
				delete_option( 'widget_custom_post_type_recent_posts' );
			}

			return $instance;
		}

		public function flush_widget_cache() {
			wp_cache_delete( 'widget_custom_post_type_recent_posts', 'widget' );
		}

		public function form( $instance ) {
			$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$posttype = isset( $instance['posttype'] ) ? $instance['posttype']: 'post';
			$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
			$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
	?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'bethlehem' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'posttype' ) ); ?>"><?php _e( 'Post Type:', 'bethlehem' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'posttype' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'posttype' ) ); ?>">
			<?php
				$post_types = get_post_types( array( 'public' => true ), 'objects' );
				foreach ( $post_types as $post_type => $value ) {
					if ( 'attachment' == $post_type ) {
						continue;
					}
				?>
					<option value="<?php echo esc_attr( $post_type ); ?>"<?php selected( $post_type, $posttype ); ?>><?php _e( $value->label, 'bethlehem' ); ?></option>
			<?php } ?>
			</select>
			</p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'bethlehem' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

			<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php _e( 'Display post date?', 'bethlehem' ); ?></label></p>
	<?php
		}
	}
}