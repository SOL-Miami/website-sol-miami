<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) die( '-1' );

define( 'BETHLEHEM_VC_PLUGIN_FILE_PATH', plugin_dir_path( __FILE__ ) );

// Shortcodes
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_banner.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_donation_carousel.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_events_calendar.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_events_venue_locations.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_events_list_widget.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_recent_posts_widget.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_sermons_carousel.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_stories_carousel.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_team_members.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_testimonials_carousel.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_title.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_sermons_media.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_tiled_gallery.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_image_carousel.php';
require_once BETHLEHEM_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_bethlehem_team_members_carousel.php';


class VCExtendAddonClass {

    /**
     * List of paths.
     *
     * @var array
     */
    private $paths = array();

    function __construct() {

        $dir = BETHLEHEM_VC_PLUGIN_FILE_PATH;

        $this->setPaths( Array(
            'APP_ROOT' => $dir,
            'WP_ROOT' => preg_replace( '/$\//', '', ABSPATH ),
            'APP_DIR' => plugin_basename( $dir ),
            'CONFIG_DIR' => $dir . '/config',
            'ASSETS_DIR' => $dir . '/assets',
            'ASSETS_DIR_NAME' => 'assets',
        ) );

        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );
    }

    public function integrateWithVC() {

        // Check if Visual Composer is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            //add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }

        require_once  $this->path( 'CONFIG_DIR', 'map.php');
    }

    /**
     * Setter for paths
     *
     * @since  4.2
     * @access protected
     * @param $paths
     */
    protected function setPaths( $paths ) {
        $this->paths = $paths;
    }

    /**
     * Gets absolute path for file/directory in filesystem.
     *
     * @since  4.2
     * @access public
     * @param $name        - name of path dir
     * @param string $file - file name or directory inside path
     * @return string
     */
    public function path( $name, $file = '' ) {
        return $this->paths[$name] . ( strlen( $file ) > 0 ? '/' . preg_replace( '/^\//', '', $file ) : '' );
    }

    /*
    Show notice if your plugin is activated but Visual Composer is not
    */
    public function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
        <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'bethlehem-extension'), $plugin_data['Name']).'</p>
        </div>';
    }
}

// Finally initialize code
new VCExtendAddonClass();