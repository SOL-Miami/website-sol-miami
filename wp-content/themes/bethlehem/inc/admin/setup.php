<?php
/**
 * bethlehem setup functions
 *
 * @package bethlehem
 */
#-----------------------------------------------------------------
# Plugin Recommendations
#-----------------------------------------------------------------

require_once get_template_directory() . '/inc/admin/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'bethlehem_register_required_plugins' );

if( ! function_exists( 'bethlehem_register_required_plugins' ) ) {
	function bethlehem_register_required_plugins() {
		
		$plugins = array(

			array(
				'name'					=> 'Bethlehem Extensions',
				'slug'					=> 'bethlehem-extensions',
				'source'				=> get_template_directory() . '/assets/plugins/bethlehem-extensions.zip',
				'required'				=> true,
				'version'				=> '1.2.2',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Contact Form 7',
				'slug'					=> 'contact-form-7',
				'source'				=> 'https://downloads.wordpress.org/plugin/contact-form-7.4.4.2.zip',
				'required'				=> false,
				'version'				=> '4.4.2',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Envato Market',
				'slug'					=> 'envato-market',
				'source'				=> 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required'				=> false,
				'version'				=> '1.0.0-RC2',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Give - WordPress Donation Plugin',
				'slug'					=> 'give',
				'source'				=> 'https://downloads.wordpress.org/plugin/give.1.4.5.zip',
				'required'				=> false,
				'version'				=> '1.4.5',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'MailChimp for WordPress',
				'slug'					=> 'mailchimp-for-wp',
				'source'				=> 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.3.1.9.zip',
				'required'				=> false,
				'version'				=> '3.1.9',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Our Team by WooThemes',
				'slug'					=> 'our-team-by-woothemes',
				'source'				=> 'https://downloads.wordpress.org/plugin/our-team-by-woothemes.1.4.1.zip',
				'required'				=> false,
				'version'				=> '1.4.1',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Redux Framework',
				'slug'					=> 'redux-framework',
				'source'				=> 'https://downloads.wordpress.org/plugin/redux-framework.3.6.0.2.zip',
				'required'				=> true,
				'version'				=> '3.6.0.2',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Regenerate Thumbnails',
				'slug'					=> 'regenerate-thumbnails',
				'source'				=> 'https://downloads.wordpress.org/plugin/regenerate-thumbnails.zip',
				'required'				=> false,
				'version'				=> '2.2.6',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Slider Revolution',
				'slug'					=> 'revslider',
				'source'				=> get_template_directory() . '/assets/plugins/revslider.zip',
				'required'				=> false,
				'version'				=> '5.2.5.4',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Testimonials by WooThemes',
				'slug'					=> 'testimonials-by-woothemes',
				'source'				=> 'https://downloads.wordpress.org/plugin/testimonials-by-woothemes.1.5.4.zip',
				'required'				=> false,
				'version'				=> '1.5.4',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'The Events Calendar',
				'slug'					=> 'the-events-calendar',
				'source'				=> 'https://downloads.wordpress.org/plugin/the-events-calendar.4.2.zip',
				'required'				=> false,
				'version'				=> '4.2',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'WooCommerce',
				'slug'					=> 'woocommerce',
				'source'				=> 'https://downloads.wordpress.org/plugin/woocommerce.2.6.0.zip',
				'required'				=> false,
				'version'				=> '2.6.0',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),
			
			array(
				'name'					=> 'WP Tiles',
				'slug'					=> 'wp-tiles',
				'source'				=> 'https://downloads.wordpress.org/plugin/wp-tiles.1.1.2.zip',
				'required'				=> false,
				'version'				=> '1.1.2',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Visual Composer',
				'slug'					=> 'js_composer',
				'source'				=> get_template_directory() . '/assets/plugins/js_composer.zip',
				'required'				=> false,
				'version'				=> '4.12',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			)

		);

		$config = array(
			'domain'       		=> 'bethlehem',         	// Text domain
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_slug' 		=> 'themes.php', 				// Default parent slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', 'bethlehem' ),
				'menu_title'                       			=> __( 'Install Plugins', 'bethlehem' ),
				'installing'                       			=> __( 'Installing Plugin: %s', 'bethlehem' ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', 'bethlehem' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'bethlehem' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'bethlehem' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'bethlehem' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'bethlehem' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'bethlehem' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'bethlehem' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'bethlehem' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'bethlehem' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'bethlehem'  ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'bethlehem'  ),
				'return'                           			=> __( 'Return to Required Plugins Installer', 'bethlehem' ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'bethlehem' ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'bethlehem' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa( $plugins, $config );
	}
}