<?php
/**
 * Custom Post Type Search widget class
 *
 * @since 1.0.0
 */
if( ! class_exists('Bethlehem_Custom_Post_Type_Widgets_Search') ) {
	class Bethlehem_Custom_Post_Type_Widgets_Search extends WP_Widget {

		public function __construct() {
			$widget_ops = array( 'classname' => 'widget_search', 'description' => __( 'Search widget for custom post types.', 'bethlehem' ) );
			parent::__construct( 'custom-post-type-search', __( 'Search (Custom Post Type)', 'bethlehem' ), $widget_ops );
			$this->alt_option_name = 'widget_custom_post_type_search';

			add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
			add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
			add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
		}

		public function widget( $args, $instance ) {
			$cache = wp_cache_get( 'widget_custom_post_type_search', 'widget' );

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
			$posttype = $instance['posttype'];
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Search', 'bethlehem' ) : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			?>
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
				<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'bethlehem' ); ?></label>
				<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Type and search', 'placeholder', 'bethlehem' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'bethlehem' ); ?>" />
				<input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'bethlehem' ); ?>" />
				<input type="hidden" name="post_type" value="<?php echo esc_attr( $posttype ); ?>" />
			</form>
			<?php
			echo $args['after_widget'];
		}

		public function update( $new_instance, $old_instance ) {
			$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
			$instance['posttype'] = strip_tags( $new_instance['posttype'] );

			$this->flush_widget_cache();

			$alloptions = wp_cache_get( 'alloptions', 'options' );
			if ( isset( $alloptions['widget_custom_post_type_search'] ) ) {
				delete_option( 'widget_custom_post_type_search' );
			}

			return $instance;
		}

		public function flush_widget_cache() {
			wp_cache_delete( 'widget_custom_post_type_search', 'widget' );
		}

		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'posttype' => 'post' ) );
			$title = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : '';
			$posttype = isset( $instance['posttype'] ) ? $instance['posttype']: 'post';
	?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'bethlehem' ); ?></label> <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

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
	<?php
		}
	}
}