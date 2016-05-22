<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Bethlehem_Widget_Sermons_Recent_Posts') ) {
	class Bethlehem_Widget_Sermons_Recent_Posts extends WP_Widget {

		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			$this->widget_cssclass    = 'widget_sermons_recent_posts';
			$this->widget_description = __( 'Bethlehem Sermons Recent Posts.', 'bethlehem' );
			$this->widget_id          = 'widget_sermons_recent_posts';
			$this->widget_name        = __( 'Sermons Recent Posts', 'bethlehem' );
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'std'   => __( 'Sermons', 'bethlehem' ),
					'label' => __( 'Title for widget', 'bethlehem' )
				),
				'number' => array(
					'type'    => 'text',
					'std'     => '',
					'label'   => __( 'Post Count', 'bethlehem' )
				)
			);

			$widget_ops = array(
				'classname'   => $this->widget_cssclass,
				'description' => $this->widget_description
			);

			parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );
		}

		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget($args, $instance) {
			$cache = array();
			if ( ! $this->is_preview() ) {
				$cache = wp_cache_get( 'widget_sermons_recent_posts', 'widget' );
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

			bethlehem_get_template( 'widgets/sermons-recent-posts-widget.php', array( 'args' => $args,'instance' => $instance ) );

			$content = ob_get_clean();

			echo $content;

			$this->cache_widget( $args, $content );
		}

			/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			if ( ! $this->settings ) {
				return;
			}

			foreach ( $this->settings as $key => $setting ) {

				$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];

				switch ( $setting['type'] ) {

					case 'text' :
						?>
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; ?></label>
							<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
						</p>
						<?php
					break;

					case 'number' :
						?>
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; ?></label>
							<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
						</p>
						<?php
					break;

					case 'select' :
						?>
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; ?></label>
							<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>">
								<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
									<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
								<?php endforeach; ?>
							</select>
						</p>
						<?php
					break;

					case 'checkbox' :
						?>
						<p>
							<input id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
							<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; ?></label>
						</p>
						<?php
					break;
				}
			}
		}

		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			if ( ! $this->settings ) {
				return $instance;
			}

			foreach ( $this->settings as $key => $setting ) {

				if ( isset( $new_instance[ $key ] ) ) {
					$instance[ $key ] = sanitize_text_field( $new_instance[ $key ] );
				} elseif ( 'checkbox' === $setting['type'] ) {
					$instance[ $key ] = 0;
				}
			}

			$this->flush_widget_cache();

			return $instance;
		}

		/**
		 * get_cached_widget function.
		 */
		public function get_cached_widget( $args ) {

			$cache = wp_cache_get( apply_filters( 'bethlehem_cached_widget_id', $this->widget_id ), 'widget' );

			if ( ! is_array( $cache ) ) {
				$cache = array();
			}

			if ( isset( $cache[ $args['widget_id'] ] ) ) {
				echo $cache[ $args['widget_id'] ];
				return true;
			}

			return false;
		}

		/**
		 * Cache the widget
		 *
		 * @param  array $args
		 * @param  string $content
		 * @return string the content that was cached
		 */
		public function cache_widget( $args, $content ) {
			wp_cache_set( apply_filters( 'bethlehem_cached_widget_id', $this->widget_id ), array( $args['widget_id'] => $content ), 'widget' );

			return $content;
		}

		/**
		 * Flush the cache
		 *
		 * @return void
		 */
		public function flush_widget_cache() {
			wp_cache_delete( apply_filters( 'bethlehem_cached_widget_id', $this->widget_id ), 'widget' );
		}
	}
}