<?php
if ( !class_exists( 'ReduxFramework' ) ) {
    return;
}

if ( !class_exists( "Bethlehem_Options" ) ) {

    class Bethlehem_Options {
        
        public function __construct( ) {
            // Base Config for Bethlehem
            add_action( 'after_setup_theme', array( $this, 'load_config' ), 20 );
        }

        public function load_config() {

            $entranceAnimations = array(
                'none'              => __( 'No Animation', 'bethlehem' ),
                'bounceIn'          => __( 'BounceIn', 'bethlehem' ),
                'bounceInDown'      => __( 'BounceInDown', 'bethlehem' ),
                'bounceInLeft'      => __( 'BounceInLeft', 'bethlehem' ),
                'bounceInRight'     => __( 'BounceInRight', 'bethlehem' ),
                'bounceInUp'        => __( 'BounceInUp', 'bethlehem' ),
                'fadeIn'            => __( 'FadeIn', 'bethlehem' ),
                'fadeInDown'        => __( 'FadeInDown', 'bethlehem' ),
                'fadeInDownBig'     => __( 'FadeInDown Big', 'bethlehem' ),
                'fadeInLeft'        => __( 'FadeInLeft', 'bethlehem' ),
                'fadeInLeftBig'     => __( 'FadeInLeft Big', 'bethlehem' ),
                'fadeInRight'       => __( 'FadeInRight', 'bethlehem' ),
                'fadeInRightBig'    => __( 'FadeInRight Big', 'bethlehem' ),
                'fadeInUp'          => __( 'FadeInUp', 'bethlehem' ),
                'fadeInUpBig'       => __( 'FadeInUp Big', 'bethlehem' ),
                'flipInX'           => __( 'FlipInX', 'bethlehem' ),
                'flipInY'           => __( 'FlipInY', 'bethlehem' ),
                'lightSpeedIn'      => __( 'LightSpeedIn', 'bethlehem' ),
                'rotateIn'          => __( 'RotateIn', 'bethlehem' ),
                'rotateInDownLeft'  => __( 'RotateInDown Left', 'bethlehem' ),
                'rotateInDownRight' => __( 'RotateInDown Right', 'bethlehem' ),
                'rotateInUpLeft'    => __( 'RotateInUp Left', 'bethlehem' ),
                'rotateInUpRight'   => __( 'RotateInUp Right', 'bethlehem' ),
                'roleIn'            => __( 'RoleIn', 'bethlehem' ),
                'zoomIn'            => __( 'ZoomIn', 'bethlehem' ),
                'zoomInDown'        => __( 'ZoomInDown', 'bethlehem' ),
                'zoomInLeft'        => __( 'ZoomInLeft', 'bethlehem' ),
                'zoomInRight'       => __( 'ZoomInRight', 'bethlehem' ),
                'zoomInUp'          => __( 'ZoomInUp', 'bethlehem' ),
            );

            $sections = array(

                array(
                    'title' => __('General', 'bethlehem'),
                    'icon'  => 'fa fa-dot-circle-o',
                    'fields' => array(
                        
                        array(
                            'title' => __('Your Logo', 'bethlehem'),
                            'subtitle' => __('<em>Upload your logo image. Recommended dimension : 233x54 pixels</em>', 'bethlehem'),
                            'id' => 'site_logo',
                            'type' => 'media',
                        ),
                        
                        array(
                            'title' => __('Use text instead of logo ?', 'bethlehem'),
                            'id' => 'use_text_logo',
                            'type' => 'checkbox',
                            'default' => '0',
                        ),
                        
                        array(
                            'title' => __('Logo Text', 'bethlehem'),
                            'subtitle' => __('<em>Will be displayed only if use text logo is checked.</em>', 'bethlehem'),
                            'id' => 'logo_text',
                            'type' => 'text',
                            'default' => 'Bethlehem',
                            'required' => array(
                                0 => 'use_text_logo',
                                1 => '=',
                                2 => 1,
                            ),
                        ),

                        array(
                            'title' => __('Scroll to Top', 'bethlehem'),
                            'id' => 'enable_scroll_to_top',
                            'on' => __('Enabled', 'bethlehem'),
                            'off' => __('Disabled', 'bethlehem'),
                            'type' => 'switch',
                            'default' => 1,
                        ),
                    ),
                ),

                array(
                    'title' => __('Header', 'bethlehem'),
                    'icon'  => 'fa fa-arrow-circle-o-up',
                    'fields' => array(
                        array(
                            'title' => __('Home Page Slider', 'bethlehem'),
                            'id' => 'enable_home_page_rev_slider',
                            'on' => __('Enabled', 'bethlehem'),
                            'off' => __('Disabled', 'bethlehem'),
                            'type' => 'switch',
                            'default' => 1,
                        ),
                        array(
                            'title'     => __( 'Choose Slider', 'bethlehem' ),
                            'id'        => 'home_page_rev_slider',
                            'type'      => 'select',
                            'options'   => redux_get_all_rev_sliders(),
                            'required'  => array( 'enable_home_page_rev_slider', 'equals', 1 )
                        ),
                        array(
                            'title'     => __( 'Header Background', 'bethlehem' ),
                            'id'        => 'header_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),
                        array(         
                            'id'       => 'header_background',
                            'type'     => 'background',
                            'title'    => __('Header Background', 'bethlehem'),
                            'subtitle' => __('Header background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array( 'header_bg', 'equals', 'custom' ),
                            ),
                            'output'   => array(
                                'background-color'      => '.header-1 .site-header, .header-2 .site-header, .header-3 .site-header, .header-4 .site-header, .header-5 .site-header, .header-6 .site-header, .header-8 .site-header',
                                'background-image'      => '.header-1 .site-header, .header-2 .site-header, .header-3 .site-header, .header-4 .site-header, .header-5 .site-header, .header-6 .site-header, .header-8 .site-header',
                                'background-repeat'     => '.header-1 .site-header, .header-2 .site-header, .header-3 .site-header, .header-4 .site-header, .header-5 .site-header, .header-6 .site-header, .header-8 .site-header',
                                'background-size'       => '.header-1 .site-header, .header-2 .site-header, .header-3 .site-header, .header-4 .site-header, .header-5 .site-header, .header-6 .site-header, .header-8 .site-header',
                                'background-attachment' => '.header-1 .site-header, .header-2 .site-header, .header-3 .site-header, .header-4 .site-header, .header-5 .site-header, .header-6 .site-header, .header-8 .site-header',
                                'background-position'   => '.header-1 .site-header, .header-2 .site-header, .header-3 .site-header, .header-4 .site-header, .header-5 .site-header, .header-6 .site-header, .header-8 .site-header',
                            )
                        ),
                        array(         
                            'id'       => 'header_text_color',
                            'type'     => 'color',
                            'title'    => __('Header Text Color', 'bethlehem'),
                            'required' => array(
                                array( 'header_bg','equals','custom' ),
                            ),
                            'output'   => array(
                                '.site-header',
                                '.top-bar',
                                '.main-navigation',
                                '.site-description',
                                'ul.menu li.current-menu-item > a'
                            )
                        ),
                        array(         
                            'id'       => 'header_link_color',
                            'type'     => 'link_color',
                            'title'    => __('Header Link Color', 'bethlehem'),
                            'required' => array(
                                array( 'header_bg', 'equals','custom' ),
                            ),
                            'output'   => array(
                                '.site-header a', 
                                '.main-navigation ul li a', 
                                '.site-title a', 
                                'ul.menu li a',
                                '.site-branding h1 a',
                                '.header-1 .header-nav-menu .primary-navigation ul.menu>li>a',
                                '.header-2 .header-nav-menu .primary-navigation ul.menu>li>a',
                                '.header-3 .header-nav-menu .primary-navigation ul.menu>li>a',
                                '.header-4 .header-nav-menu .primary-navigation ul.menu>li>a',
                                '.header-5 .header-nav-menu .primary-navigation ul.menu>li>a',
                                '.header-6 .header-nav-menu .primary-navigation ul.menu>li>a',
                                '.header-7 .header-nav-menu .primary-navigation ul.menu>li>a',
                                '.header-1 .main-navigation ul.menu > li .megamenu-content ul > li > a',
                                '.header-2 .main-navigation ul.menu > li .megamenu-content ul > li > a',
                                '.header-3 .main-navigation ul.menu > li .megamenu-content ul > li > a',
                                '.header-4 .main-navigation ul.menu > li .megamenu-content ul > li > a',
                                '.header-5 .main-navigation ul.menu > li .megamenu-content ul > li > a',
                                '.header-6 .main-navigation ul.menu > li .megamenu-content ul > li > a',
                                '.header-7 .main-navigation ul.menu > li .megamenu-content ul > li > a',
                                '.header-1 .main-navigation ul.nav-menu > li .megamenu-content ul > li > a',
                                '.header-2 .main-navigation ul.nav-menu > li .megamenu-content ul > li > a',
                                '.header-3 .main-navigation ul.nav-menu > li .megamenu-content ul > li > a',
                                '.header-4 .main-navigation ul.nav-menu > li .megamenu-content ul > li > a',
                                '.header-5 .main-navigation ul.nav-menu > li .megamenu-content ul > li > a',
                                '.header-6 .main-navigation ul.nav-menu > li .megamenu-content ul > li > a',
                                '.header-7 .main-navigation ul.nav-menu > li .megamenu-content ul > li > a'
                            )
                        ),
                        array(
                            'id'        => 'header_style',
                            'type'      => 'select',
                            'title'     => __( 'Header Style', 'bethlehem' ),
                            'options' => array(
                                'header-1' => __( 'Header 1', 'bethlehem' ),
                                'header-2' => __( 'Header 2', 'bethlehem' ),
                                'header-3' => __( 'Header 3', 'bethlehem' ),
                                'header-4' => __( 'Header 4', 'bethlehem' ),
                                'header-5' => __( 'Header 5', 'bethlehem' ),
                                'header-6' => __( 'Header 6', 'bethlehem' ),
                                'header-7' => __( 'Header 7', 'bethlehem' ),
                                'header-8' => __( 'Header 8', 'bethlehem' )
                            ),
                            'default' => 'header-1',
                        ),
                        array(
                            'title' => __('Sticky Header', 'bethlehem'),
                            'subtitle' => __('<em>Enable / Disable the Sticky Header. Available only for Header Style 2</em>', 'bethlehem'),
                            'id' => 'enable_sticky_header',
                            'on' => __('Enabled', 'bethlehem'),
                            'off' => __('Disabled', 'bethlehem'),
                            'type' => 'switch',
                            'default' => 0,
                            'required' => array( 'header_style', 'equals', array( 'header-3', 'header-4', 'header-5', 'header-6', 'header-7' ) )
                        ),
                        array(
                            'title' => __('Event Countdown', 'bethlehem'),
                            'subtitle' => __('<em>Enable / Disable the Event Countdown on Header.</em>', 'bethlehem'),
                            'id' => 'enable_event_countdown',
                            'on' => __('Enabled', 'bethlehem'),
                            'off' => __('Disabled', 'bethlehem'),
                            'type' => 'switch',
                            'default' => 1,
                            'required' => array( 'header_style', 'equals', array( 'header-3', 'header-4', 'header-5', 'header-7' ) )
                        ),
                        array(
                            'title' => __('Support Phone Number', 'bethlehem'),
                            'id' => 'header_support_phone',
                            'type' => 'text',
                            'default' => '(+800) 123 456 7890',
                            'required' => array( 'header_style', 'equals', array( 'header-5', 'header-4' ) )
                        ),
                        array(
                            'title' => __( 'Support Email Address', 'bethlehem' ),
                            'id' => 'header_support_email',
                            'type' => 'text',
                            'default' => 'contact@support.com',
                            'required' => array( 'header_style', 'equals', array( 'header-5', 'header-4' ) )
                        ),
                    ),
                ),

                array(
                    'title' => __('Footer', 'bethlehem'),
                    'icon'  => 'fa fa-arrow-circle-o-down',
                    'fields' => array(
                        array(
                            'id'        => 'footer_bg',
                            'type'      => 'select',
                            'title'     => __( 'Footer Style', 'bethlehem' ),
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),

                        array(         
                            'id'       => 'footer_background',
                            'type'     => 'background',
                            'title'    => __('Footer Background', 'bethlehem'),
                            'subtitle' => __('Footer background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array('footer_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.footer-1 footer.site-footer, .footer-2 footer.site-footer, .footer-3 footer.site-footer',
                                'background-image'      => '.footer-1 footer.site-footer, .footer-2 footer.site-footer, .footer-3 footer.site-footer',
                                'background-repeat'     => '.footer-1 footer.site-footer, .footer-2 footer.site-footer, .footer-3 footer.site-footer',
                                'background-size'       => '.footer-1 footer.site-footer, .footer-2 footer.site-footer, .footer-3 footer.site-footer',
                                'background-attachment' => '.footer-1 footer.site-footer, .footer-2 footer.site-footer, .footer-3 footer.site-footer',
                                'background-position'   => '.footer-1 footer.site-footer, .footer-2 footer.site-footer, .footer-3 footer.site-footer',
                            )
                        ),

                        array(         
                            'id'       => 'footer_text_color',
                            'type'     => 'color',
                            'title'    => __('Footer Text Color', 'bethlehem'),
                            'required' => array(
                                array('footer_bg','equals','custom'),
                            ),
                            'output'   => array(
                                '.site-footer',
                                '.site-footer label',
                                '.site-footer .connect-with-us',
                                '.footer-logo .site-title',
                                '.footer-logo .site-description',
                                '.footer-widgets',
                                '.footer-widgets .footer-widget',
                                '.footer-widgets .footer-widget ul li',
                                '.footer-widgets .footer-widget .widget'
                            )
                        ),

                        array(         
                            'id'       => 'footer_link_color',
                            'type'     => 'link_color',
                            'title'    => __('Footer Link Color', 'bethlehem'),
                            'required' => array (
                                array( 'footer_bg','equals','custom' ),
                            ),
                            'output'   => array (
                                '.site-footer a',
                                '.footer-widgets a',
                                '.footer-widgets .footer-widget a',
                                '.footer-widgets .footer-widget ul li',
                            )
                        ),
                        array(
                            'id'        => 'footer_style',
                            'type'      => 'select',
                            'title'     => __( 'Footer Style', 'bethlehem' ),
                            'options' => array(
                                'footer-1' => __( 'Footer 1', 'bethlehem' ),
                                'footer-2' => __( 'Footer 2', 'bethlehem' ),
                                'footer-3' => __( 'Footer 3', 'bethlehem' )
                            ),
                            'default' => 'footer-1',
                        ),
                        array(
                            'title' => __('Footer Connect Text', 'bethlehem'),
                            'id' => 'footer_connect_text',
                            'type' => 'text',
                            'default' => __( 'Connect with us', 'bethlehem' ),
                            'required' => array( 'footer_style', 'equals', array( 'footer-1' ) )
                        ),
                        array(
                            'title' => __('Footer Contact Info', 'bethlehem'),
                            'id' => 'footer_contact_info',
                            'type' => 'textarea',
                            'default' => __( 'Bethlehem Church', 'bethlehem' ),
                            'required' => array( 'footer_style', 'equals', array( 'footer-2' ) )
                        ),
                        array(
                            'title' => __('Footer Contact Info Address', 'bethlehem'),
                            'id' => 'footer_contact_info_address',
                            'type' => 'textarea',
                            'default' => '901-947 South Ripple Creek Drive, Houston, TX 77057, USA',
                            'required' => array( 'footer_style', 'equals', array( 'footer-2' ) )
                        ),
                        array(
                            'title' => __('Footer Contact Info Phone', 'bethlehem'),
                            'id' => 'footer_contact_info_phone',
                            'type' => 'textarea',
                            'default' => 'Telephone: +1 555 1234',
                            'required' => array( 'footer_style', 'equals', array( 'footer-2' ) )
                        ),
                        array(
                            'title' => __('Footer Contact Info Fax', 'bethlehem'),
                            'id' => 'footer_contact_info_fax',
                            'type' => 'textarea',
                            'default' => 'Fax: +1 555 4444',
                            'required' => array( 'footer_style', 'equals', array( 'footer-2' ) )
                        ),
                        array(
                            'title' => __('Footer Copyright Text', 'bethlehem'),
                            'subtitle' => __('<em>Enter your copyright information here.</em>', 'bethlehem'),
                            'id' => 'footer_copyright_text',
                            'type' => 'textarea',
                            'default' => '@ All rights reserved 2015',
                            'required' => array( 'footer_style', 'equals', array( 'footer-2', 'footer-3' ) )
                        ),
                        array(
                            'title' => __('Footer Button Text', 'bethlehem'),
                            'id' => 'footer_button_text',
                            'type' => 'text',
                            'default' => '<i class="fa fa-long-arrow-right"></i> '.__( 'Contact us', 'bethlehem' ),
                            'required' => array( 'footer_style', 'equals', array( 'footer-2' ) )
                        ),
                        array(
                            'title' => __('Footer Button Link', 'bethlehem'),
                            'id' => 'footer_button_link',
                            'type' => 'text',
                            'default' => 'http://demo.transvelo.in/wp/bethlehem/',
                            'required' => array( 'footer_style', 'equals', array( 'footer-2' ) )
                        ),
                    ),
                ),

                array(
                    'title' => __('Blog', 'bethlehem'),
                    'icon'  => 'fa fa-list-alt',
                    'fields' => array(
                        array(
                            'title'     => __( 'Header Background', 'bethlehem' ),
                            'id'        => 'blog_header_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),
                        array(         
                            'id'       => 'blog_header_background',
                            'type'     => 'background',
                            'title'    => __('Header Background', 'bethlehem'),
                            'subtitle' => __('Header background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array('blog_header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.single-post .site-header, .blog .site-header, .category .site-header',
                                'background-image'      => '.single-post .site-header, .blog .site-header, .category .site-header',
                                'background-repeat'     => '.single-post .site-header, .blog .site-header, .category .site-header',
                                'background-size'       => '.single-post .site-header, .blog .site-header, .category .site-header',
                                'background-attachment' => '.single-post .site-header, .blog .site-header, .category .site-header',
                                'background-position'   => '.single-post .site-header, .blog .site-header, .category .site-header',
                            )
                        ),
                        array(
                            'title'     => __('Blog Page Layout', 'bethlehem'),
                            'subtitle'  => __('<em>Select the layout for the Blog Listing. <br />The second option will enable the Blog Listing Sidebar.</em>', 'bethlehem'),
                            'id'        => 'blog_layout',
                            'type'      => 'image_select',
                            'options'   => array(
                                'right-sidebar'     => get_template_directory_uri() . '/assets/images/theme_options/blog_right_sidebar.png',
                                'bethlehem-full-width-content'   => get_template_directory_uri() . '/assets/images/theme_options/blog_no_sidebar.png',
                                'left-sidebar'      => get_template_directory_uri() . '/assets/images/theme_options/blog_left_sidebar.png',
                            ),
                            'default'   => 'right-sidebar',
                        ),
                        array(
                            'title'     => __('Blog Style', 'bethlehem'),
                            'subtitle'  => __('<em>Select the layout style for the Blog Listing.</em>', 'bethlehem'),
                            'id'        => 'blog_style',
                            'type'      => 'select',
                            'options'   => array(
                                'normal'        => __( 'Normal', 'bethlehem' ),
                                'list-view'     => __( 'List View', 'bethlehem' ),
                                'grid-view'     => __( 'Grid View', 'bethlehem' )
                            ),
                            'default'   => 'normal',
                        ),
                        array(
                            'title'     => __( 'Force Excerpt', 'bethlehem' ),
                            'subtitle'  => __( 'Show only excerpt instead of blog content in archive pages', 'bethlehem' ),
                            'id'        => 'force_excerpt',
                            'on'        => __('Yes', 'bethlehem'),
                            'off'       => __('No', 'bethlehem'),
                            'type'      => 'switch',
                            'default'   => 0,       
                        ),
                        array(
                            'title'     => __( 'Excerpt Length', 'bethlehem' ),
                            'id'        => 'excerpt_length',
                            'type'      => 'text',
                            'default'   => 75,
                            'required'  => array( 'force_excerpt', 'equals', 1 )        
                        ),
                    ),
                ),

                array(

                    'title' => __('Shop', 'bethlehem'),
                    'icon'  => 'fa fa-shopping-cart',
                    'fields' => array(
                        
                        array(
                            'id'                => 'shop_general_info_start',
                            'type'              => 'section',
                            'title'             => __( 'General', 'bethlehem' ),
                            'subtitle'          => __( '<em>General Shop Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),

                        array(
                            'title' => __('Catalog Mode', 'bethlehem'),
                            'subtitle' => __('<em>Enable / Disable the Catalog Mode.</em>', 'bethlehem'),
                            'desc' => __('<em>When enabled, the feature Turns Off the shopping functionality of WooCommerce.</em>', 'bethlehem'),
                            'id' => 'catalog_mode',
                            'on' => __('Enabled', 'bethlehem'),
                            'off' => __('Disabled', 'bethlehem'),
                            'type' => 'switch',
                        ),

                        array(
                            'title' => __('Stores Carousel', 'bethlehem'),
                            'subtitle' => __('<em>Enable / Disable the Stores Carousel.</em>', 'bethlehem'),
                            'desc' => __('<em>When enabled, Store carousel display before the footer(Footer 1 and 2 only).</em>', 'bethlehem'),
                            'id' => 'footer_stores_carousel',
                            'on' => __('Enabled', 'bethlehem'),
                            'off' => __('Disabled', 'bethlehem'),
                            'type' => 'switch',
                            'default'   => 1
                        ),

                        array(
                            'title'     => __( 'Author Attribute', 'bethlehem' ),
                            'subtitle'  => __( '<em>Choose a product attribute that will be used as authors</em>', 'bethlehem' ),
                            'desc'      => __( '<em>Once you choose a author attribute, you will be able to add author', 'bethlehem' ),
                            'id'        => 'book_author_attribute',
                            'type'      => 'select',
                            'options'   => redux_get_product_attr_taxonomies()
                        ),

                        array(
                            'title'     => __('Default View', 'bethlehem'),
                            'subtitle'  => __('<em>Choose a default view between grid and list views.</em>', 'bethlehem'),
                            'id'        => 'shop_default_view',
                            'type'      => 'select',
                            'options'   => array(
                                'grid-view' => __( 'Grid View', 'bethlehem' ),
                                'list-view' => __( 'List View', 'bethlehem' ),
                            ),
                            'default'   => 'grid-view',
                        ),

                        array(
                            'title'     => __('Remember User View ?', 'bethlehem' ),
                            'desc'      => __( 'When user switches a view, should we maintain the view in all pages ?', 'bethlehem' ),
                            'id'        => 'remember_user_view',
                            'type'      => 'switch',
                            'on'        => __( 'Yes', 'bethlehem' ),
                            'off'       => __( 'No', 'bethlehem' ),
                            'default'   => 0
                        ),

                        array(
                            'title'     => __( 'Header Background', 'bethlehem' ),
                            'id'        => 'shop_header_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),
                        array(         
                            'id'       => 'shop_header_background',
                            'type'     => 'background',
                            'title'    => __('Header Background', 'bethlehem'),
                            'subtitle' => __('Header background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array('shop_header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.single-product .site-header, .post-type-archive-product .site-header, .tax-product_cat .site-header',
                                'background-image'      => '.single-product .site-header, .post-type-archive-product .site-header, .tax-product_cat .site-header',
                                'background-repeat'     => '.single-product .site-header, .post-type-archive-product .site-header, .tax-product_cat .site-header',
                                'background-size'       => '.single-product .site-header, .post-type-archive-product .site-header, .tax-product_cat .site-header',
                                'background-attachment' => '.single-product .site-header, .post-type-archive-product .site-header, .tax-product_cat .site-header',
                                'background-position'   => '.single-product .site-header, .post-type-archive-product .site-header, .tax-product_cat .site-header',
                            )
                        ),

                        array(
                            'title'         => __('Number of Products per Page', 'bethlehem'),
                            'subtitle'      => __('<em>Drag the slider to set the number of products per page <br />to be listed on the shop page and catalog pages.</em>', 'bethlehem'),
                            'id'            => 'products_per_page',
                            'min'           => '3',
                            'step'          => '1',
                            'max'           => '48',
                            'type'          => 'slider',
                            'default'       => '15',
                            'display_value' => 'label'
                        ),

                        array(
                            'id'                => 'shop_general_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),

                        array(
                            'id'                => 'shop_layout_info_start',
                            'type'              => 'section',
                            'title'             => __( 'Layout', 'bethlehem' ),
                            'subtitle'          => __( '<em>Shop Layout Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),

                        array(
                            'id'      => 'shop_page_layout',
                            'title'   => __( 'Shop Page Layout', 'bethlehem' ),
                            'type'    => 'select',
                            'options' => array(
                                'bethlehem-full-width-content'  => __( 'Full-width', 'bethlehem' ),
                                'left-sidebar'                  => __( 'Left Sidebar', 'bethlehem' ),
                                'right-sidebar'                 => __( 'Right Sidebar', 'bethlehem' ),
                            ),
                            'default' => 'left-sidebar'
                        ),

                        array(
                            'id'      => 'single_product_layout',
                            'title'   => __( 'Single Product Page Layout', 'bethlehem' ),
                            'type'    => 'select',
                            'options' => array(
                                'bethlehem-full-width-content'  => __( 'Full-width', 'bethlehem' ),
                                'left-sidebar'                  => __( 'Left Sidebar', 'bethlehem' ),
                                'right-sidebar'                 => __( 'Right Sidebar', 'bethlehem' ),
                            ),
                            'default' => 'left-sidebar'
                        ),

                        array(
                            'id'                => 'shop_layout_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),

                        array(
                            'id'                => 'shop_product_item_info_start',
                            'type'              => 'section',
                            'title'             => __( 'Product Item', 'bethlehem' ),
                            'subtitle'          => __( '<em>Shop Product Item Settings Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),

                        array(
                            'title'     => __('Product Item Animation', 'bethlehem'),
                            'subtitle'  => __('<em>A list of all the product animations.</em>', 'bethlehem'),
                            'id'        => 'products_animation',
                            'type'      => 'select',
                            'options'   => $entranceAnimations,
                            'default'   => 'none',
                        ),

                        array(
                            'title' => __('Echo Lazy loading', 'bethlehem'),
                            'subtitle' => __( '<em>Lazy load product images. Product images will not be loaded until scrolled into view.</em>', 'bethlehem' ),
                            'id' => 'enable_lazy_loading',
                            'on' => __('Enabled', 'bethlehem'),
                            'off' => __('Disabled', 'bethlehem'),
                            'type' => 'switch',
                            'default' => 1,
                        ),

                        array(
                            'id'                => 'shop_product_item_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

                array(

                    'title' => __('Donations', 'bethlehem'),
                    'icon'  => ' fa fa-money',
                    'fields' => array(   
                        array(
                            'id'                => 'donations_general_info_start',
                            'type'              => 'section',
                            'title'             => __( 'General', 'bethlehem' ),
                            'subtitle'          => __( '<em>General Donations Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'title'     => __( 'Header Background', 'bethlehem' ),
                            'id'        => 'donations_header_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),
                        array(         
                            'id'       => 'donations_header_background',
                            'type'     => 'background',
                            'title'    => __('Header Background', 'bethlehem'),
                            'subtitle' => __('Header background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array('donations_header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.single-give_forms .site-header, .post-type-archive-give_forms .site-header, .tax-give_forms_category .site-header',
                                'background-image'      => '.single-give_forms .site-header, .post-type-archive-give_forms .site-header, .tax-give_forms_category .site-header',
                                'background-repeat'     => '.single-give_forms .site-header, .post-type-archive-give_forms .site-header, .tax-give_forms_category .site-header',
                                'background-size'       => '.single-give_forms .site-header, .post-type-archive-give_forms .site-header, .tax-give_forms_category .site-header',
                                'background-attachment' => '.single-give_forms .site-header, .post-type-archive-give_forms .site-header, .tax-give_forms_category .site-header',
                                'background-position'   => '.single-give_forms .site-header, .post-type-archive-give_forms .site-header, .tax-give_forms_category .site-header',
                            )
                        ),
                        array(
                            'title'         => __('Number of Donations per Page', 'bethlehem'),
                            'subtitle'      => __('<em>Drag the slider to set the number of donations per page <br />to be listed on the archive page.</em>', 'bethlehem'),
                            'id'            => 'donations_per_page',
                            'min'           => '3',
                            'step'          => '1',
                            'max'           => '48',
                            'type'          => 'slider',
                            'default'       => '10',
                            'display_value' => 'label'
                        ),
                        array(
                            'id'                => 'donations_general_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                        array(
                            'id'                => 'donations_layout_info_start',
                            'type'              => 'section',
                            'title'             => __( 'Layout', 'bethlehem' ),
                            'subtitle'          => __( '<em>Donations Layout Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'id'      => 'donations_layout',
                            'title'   => __( 'Donations Page Layout', 'bethlehem' ),
                            'type'    => 'select',
                            'options' => array(
                                'left-sidebar'                  => __( 'Left Sidebar', 'bethlehem' ),
                                'right-sidebar'                 => __( 'Right Sidebar', 'bethlehem' ),
                            ),
                            'default' => 'left-sidebar'
                        ),
                        array(
                            'id'      => 'donations_single_layout',
                            'title'   => __( 'Donations Single Page Layout', 'bethlehem' ),
                            'type'    => 'select',
                            'options' => array(
                                'left-sidebar'                  => __( 'Left Sidebar', 'bethlehem' ),
                                'right-sidebar'                 => __( 'Right Sidebar', 'bethlehem' ),
                            ),
                            'default' => 'left-sidebar'
                        ),
                        array(
                            'id'                => 'donations_layout_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

                array(

                    'title' => __('Events', 'bethlehem'),
                    'icon'  => 'fa fa-calendar',
                    'fields' => array(
                        array(
                            'id'                => 'events_general_info_start',
                            'type'              => 'section',
                            'title'             => __( 'General', 'bethlehem' ),
                            'subtitle'          => __( '<em>General Events Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'title'     => __( 'Header Background', 'bethlehem' ),
                            'id'        => 'events_header_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),
                        array(         
                            'id'       => 'events_header_background',
                            'type'     => 'background',
                            'title'    => __('Header Background', 'bethlehem'),
                            'subtitle' => __('Header background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array('events_header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.single-tribe_events .site-header, .post-type-archive-tribe_events .site-header, .tax-tribe_events_cat .site-header',
                                'background-image'      => '.single-tribe_events .site-header, .post-type-archive-tribe_events .site-header, .tax-tribe_events_cat .site-header',
                                'background-repeat'     => '.single-tribe_events .site-header, .post-type-archive-tribe_events .site-header, .tax-tribe_events_cat .site-header',
                                'background-size'       => '.single-tribe_events .site-header, .post-type-archive-tribe_events .site-header, .tax-tribe_events_cat .site-header',
                                'background-attachment' => '.single-tribe_events .site-header, .post-type-archive-tribe_events .site-header, .tax-tribe_events_cat .site-header',
                                'background-position'   => '.single-tribe_events .site-header, .post-type-archive-tribe_events .site-header, .tax-tribe_events_cat .site-header',
                            )
                        ),
                        array(
                            'id'                => 'events_general_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                        array(
                            'id'                => 'events_layout_info_start',
                            'type'              => 'section',
                            'title'             => __( 'Layout', 'bethlehem' ),
                            'subtitle'          => __( '<em>Events Layout Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'id'      => 'events_layout',
                            'title'   => __( 'Events Page Layout', 'bethlehem' ),
                            'type'    => 'select',
                            'options' => array(
                                'left-sidebar'                  => __( 'Left Sidebar', 'bethlehem' ),
                                'right-sidebar'                 => __( 'Right Sidebar', 'bethlehem' ),
                            ),
                            'default' => 'left-sidebar'
                        ),
                        array(
                            'id'                => 'events_layout_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                        array(
                            'id'                => 'events_single_info_start',
                            'type'              => 'section',
                            'title'             => __( 'Single', 'bethlehem' ),
                            'subtitle'          => __( '<em>Events Single Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'title'     => __('Contact Section', 'bethlehem'),
                            'id'        => 'events_single_contact',
                            'on'        => __('Enabled', 'bethlehem'),
                            'off'       => __('Disabled', 'bethlehem'),
                            'type'      => 'switch',
                            'default'   => 1,
                        ),
                        array(
                            'title'     => __('Map Section', 'bethlehem'),
                            'id'        => 'events_single_map',
                            'on'        => __('Enabled', 'bethlehem'),
                            'off'       => __('Disabled', 'bethlehem'),
                            'type'      => 'switch',
                            'default'   => 1,
                        ),
                        array(
                            'title'     => __('Event Sidebar Widgets', 'bethlehem'),
                            'id'        => 'events_single_sidebar_widgets',
                            'on'        => __('Enabled', 'bethlehem'),
                            'off'       => __('Disabled', 'bethlehem'),
                            'type'      => 'switch',
                            'default'   => 0,
                        ),
                        array(
                            'id'                => 'events_single_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

                array(

                    'title' => __('Sermons', 'bethlehem'),
                    'icon'  => 'fa fa-headphones',
                    'fields' => array(   
                        array(
                            'id'                => 'sermons_general_info_start',
                            'type'              => 'section',
                            'title'             => __( 'General', 'bethlehem' ),
                            'subtitle'          => __( '<em>General Sermons Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'title'     => __( 'Header Background', 'bethlehem' ),
                            'id'        => 'sermons_header_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),
                        array(         
                            'id'       => 'sermons_header_background',
                            'type'     => 'background',
                            'title'    => __('Header Background', 'bethlehem'),
                            'subtitle' => __('Header background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array('sermons_header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.single-sermons .site-header, .post-type-archive-sermons .site-header, .tax-sermons-category .site-header, .tax-sermons-occasion .site-header',
                                'background-image'      => '.single-sermons .site-header, .post-type-archive-sermons .site-header, .tax-sermons-category .site-header, .tax-sermons-occasion .site-header',
                                'background-repeat'     => '.single-sermons .site-header, .post-type-archive-sermons .site-header, .tax-sermons-category .site-header, .tax-sermons-occasion .site-header',
                                'background-size'       => '.single-sermons .site-header, .post-type-archive-sermons .site-header, .tax-sermons-category .site-header, .tax-sermons-occasion .site-header',
                                'background-attachment' => '.single-sermons .site-header, .post-type-archive-sermons .site-header, .tax-sermons-category .site-header, .tax-sermons-occasion .site-header',
                                'background-position'   => '.single-sermons .site-header, .post-type-archive-sermons .site-header, .tax-sermons-category .site-header, .tax-sermons-occasion .site-header',
                            )
                        ),
                        array(
                            'title'         => __('Number of Sermons per Page', 'bethlehem'),
                            'subtitle'      => __('<em>Drag the slider to set the number of sermons per page <br />to be listed on the archive page.</em>', 'bethlehem'),
                            'id'            => 'sermons_per_page',
                            'min'           => '3',
                            'step'          => '1',
                            'max'           => '48',
                            'type'          => 'slider',
                            'default'       => '10',
                            'display_value' => 'label'
                        ),
                        array(
                            'id'                => 'sermons_general_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                        array(
                            'id'                => 'sermons_layout_info_start',
                            'type'              => 'section',
                            'title'             => __( 'Layout', 'bethlehem' ),
                            'subtitle'          => __( '<em>Sermons Layout Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'id'      => 'sermons_layout',
                            'title'   => __( 'Sermons Page Layout', 'bethlehem' ),
                            'type'    => 'select',
                            'options' => array(
                                'left-sidebar'                  => __( 'Left Sidebar', 'bethlehem' ),
                                'right-sidebar'                 => __( 'Right Sidebar', 'bethlehem' ),
                            ),
                            'default' => 'left-sidebar'
                        ),
                        array(
                            'id'      => 'sermons_single_layout',
                            'title'   => __( 'Sermons Single Page Layout', 'bethlehem' ),
                            'type'    => 'select',
                            'options' => array(
                                'left-sidebar'                  => __( 'Left Sidebar', 'bethlehem' ),
                                'right-sidebar'                 => __( 'Right Sidebar', 'bethlehem' ),
                            ),
                            'default' => 'left-sidebar'
                        ),
                        array(
                            'id'                => 'sermons_layout_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

                array(

                    'title' => __('Ministries', 'bethlehem'),
                    'icon'  => 'fa fa-user',
                    'fields' => array(   
                        array(
                            'id'                => 'ministries_general_info_start',
                            'type'              => 'section',
                            'title'             => __( 'General', 'bethlehem' ),
                            'subtitle'          => __( '<em>General Ministries Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'title'     => __( 'Header Background', 'bethlehem' ),
                            'id'        => 'ministries_header_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),
                        array(         
                            'id'       => 'ministries_header_background',
                            'type'     => 'background',
                            'title'    => __('Header Background', 'bethlehem'),
                            'subtitle' => __('Header background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array('ministries_header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.single-ministries .site-header, .post-type-archive-ministries .site-header, .tax-ministries-category .site-header',
                                'background-image'      => '.single-ministries .site-header, .post-type-archive-ministries .site-header, .tax-ministries-category .site-header',
                                'background-repeat'     => '.single-ministries .site-header, .post-type-archive-ministries .site-header, .tax-ministries-category .site-header',
                                'background-size'       => '.single-ministries .site-header, .post-type-archive-ministries .site-header, .tax-ministries-category .site-header',
                                'background-attachment' => '.single-ministries .site-header, .post-type-archive-ministries .site-header, .tax-ministries-category .site-header',
                                'background-position'   => '.single-ministries .site-header, .post-type-archive-ministries .site-header, .tax-ministries-category .site-header',
                            )
                        ),
                        array(
                            'title'         => __('Number of Ministries per Page', 'bethlehem'),
                            'subtitle'      => __('<em>Drag the slider to set the number of ministries per page <br />to be listed on the archive page.</em>', 'bethlehem'),
                            'id'            => 'ministries_per_page',
                            'min'           => '3',
                            'step'          => '1',
                            'max'           => '48',
                            'type'          => 'slider',
                            'default'       => '10',
                            'display_value' => 'label'
                        ),
                        array(
                            'id'                => 'ministries_general_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                        array(
                            'id'                => 'ministries_layout_info_start',
                            'type'              => 'section',
                            'title'             => __( 'Layout', 'bethlehem' ),
                            'subtitle'          => __( '<em>Ministries Layout Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'id'      => 'ministries_single_layout',
                            'title'   => __( 'Ministries Single Page Layout', 'bethlehem' ),
                            'type'    => 'select',
                            'options' => array(
                                'left-sidebar'                  => __( 'Left Sidebar', 'bethlehem' ),
                                'right-sidebar'                 => __( 'Right Sidebar', 'bethlehem' ),
                            ),
                            'default' => 'left-sidebar'
                        ),
                        array(
                            'id'                => 'ministries_layout_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

                array(

                    'title' => __('Stories', 'bethlehem'),
                    'icon'  => 'fa fa-book',
                    'fields' => array(   
                        array(
                            'id'                => 'stories_general_info_start',
                            'type'              => 'section',
                            'title'             => __( 'General', 'bethlehem' ),
                            'subtitle'          => __( '<em>General Stories Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'title'     => __( 'Header Background', 'bethlehem' ),
                            'id'        => 'stories_header_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),
                        array(         
                            'id'       => 'stories_header_background',
                            'type'     => 'background',
                            'title'    => __('Header Background', 'bethlehem'),
                            'subtitle' => __('Header background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array('stories_header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.single-stories .site-header, .post-type-archive-stories .site-header, .tax-stories-category .site-header',
                                'background-image'      => '.single-stories .site-header, .post-type-archive-stories .site-header, .tax-stories-category .site-header',
                                'background-repeat'     => '.single-stories .site-header, .post-type-archive-stories .site-header, .tax-stories-category .site-header',
                                'background-size'       => '.single-stories .site-header, .post-type-archive-stories .site-header, .tax-stories-category .site-header',
                                'background-attachment' => '.single-stories .site-header, .post-type-archive-stories .site-header, .tax-stories-category .site-header',
                                'background-position'   => '.single-stories .site-header, .post-type-archive-stories .site-header, .tax-stories-category .site-header',
                            )
                        ),
                        array(
                            'title'         => __('Number of Stories per Page', 'bethlehem'),
                            'subtitle'      => __('<em>Drag the slider to set the number of stories per page <br />to be listed on the archive page.</em>', 'bethlehem'),
                            'id'            => 'stories_per_page',
                            'min'           => '3',
                            'step'          => '1',
                            'max'           => '48',
                            'type'          => 'slider',
                            'default'       => '10',
                            'display_value' => 'label'
                        ),
                        array(
                            'title'     => __( 'Show Featured Post by id?', 'bethlehem' ),
                            'subtitle'  => __( 'Show featured post by id instead of using recent post in archive page.', 'bethlehem' ),
                            'id'        => 'stories_featured_post_by_id',
                            'on'        => __('Yes', 'bethlehem'),
                            'off'       => __('No', 'bethlehem'),
                            'type'      => 'switch',
                            'default'   => 0,       
                        ),
                        array(
                            'title'     => __( 'Featured Post', 'bethlehem' ),
                            'id'        => 'stories_featured_post_id',
                            'type'      => 'select',
                            'options'   => redux_get_all_stories(),
                            'required'  => array( 'stories_featured_post_by_id', 'equals', 1 )        
                        ),
                        array(
                            'id'                => 'stories_general_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

                array(

                    'title' => __('Team Members', 'bethlehem'),
                    'icon'  => 'fa fa-users',
                    'fields' => array(   
                        array(
                            'id'                => 'team_members_general_info_start',
                            'type'              => 'section',
                            'title'             => __( 'General', 'bethlehem' ),
                            'subtitle'          => __( '<em>General Team Members Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'title'         => __('Number of Team Members per Page', 'bethlehem'),
                            'subtitle'      => __('<em>Drag the slider to set the number of team members per page <br />to be listed on the archive page.</em>', 'bethlehem'),
                            'id'            => 'team_members_per_page',
                            'min'           => '3',
                            'step'          => '1',
                            'max'           => '48',
                            'type'          => 'slider',
                            'default'       => '10',
                            'display_value' => 'label'
                        ),
                        array(
                            'title' => __('Archive Social Block', 'bethlehem'),
                            'id' => 'enable_archive_team_social',
                            'on' => __('Enabled', 'bethlehem'),
                            'off' => __('Disabled', 'bethlehem'),
                            'type' => 'switch',
                            'default' => 1,
                        ),
                        array(
                            'title' => __('Single Social Block', 'bethlehem'),
                            'id' => 'enable_single_team_social',
                            'on' => __('Enabled', 'bethlehem'),
                            'off' => __('Disabled', 'bethlehem'),
                            'type' => 'switch',
                            'default' => 1,
                        ),
                        array(
                            'id'                => 'team_members_general_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

                array(
                    'title' => __('Styling', 'bethlehem'),
                    'icon'  => 'fa fa-pencil-square-o',
                    'fields' => array(
                        array(
                            'id'                => 'styling_general_info_start',
                            'type'              => 'section',
                            'title'             => __( 'General', 'bethlehem' ),
                            'subtitle'          => __( '<em>General Theme Style Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'title'     => __( 'Style', 'bethlehem' ),
                            'id'        => 'bethlehem_style_class',
                            'type'      => 'select',
                            'options'   => array(
                                'bethlehem-style-1'    => __( 'Style 1', 'bethlehem' ),
                                'bethlehem-style-2'    => __( 'Style 2', 'bethlehem' ),
                                'bethlehem-style-3'    => __( 'Style 3', 'bethlehem' ),
                            ),
                            'default'   => 'bethlehem-style-1',
                        ),
                        array(
                            'title'     => __( 'Use a predefined color scheme', 'bethlehem' ),
                            'on'        => __('Yes', 'bethlehem'),
                            'off'       => __('No', 'bethlehem'),
                            'type'      => 'switch',
                            'default'   => 1,
                            'id'        => 'use_predefined_color'
                        ),
                        array(
                            'title'     => __('Main Theme Color', 'bethlehem'),
                            'subtitle'  => __('<em>The main color of the site.</em>', 'bethlehem'),
                            'id'        => 'main_color',
                            'type'      => 'select',
                            'options'   => array(
                                'green'      => __( 'Green', 'bethlehem' ) ,
                                'blue'       => __( 'Blue', 'bethlehem' ) ,
                                'red'        => __( 'Red', 'bethlehem' ) ,
                                'orange'     => __( 'Orange', 'bethlehem' ) ,
                                'violet'     => __( 'Violet', 'bethlehem' ) ,
                                'yellow'     => __( 'Yellow', 'bethlehem' ) ,
                            ),
                            'default'   => 'yellow',
                            'required'  => array( 'use_predefined_color', 'equals', 1 ),
                        ),
                        array(
                            'id'        => 'main_custom_color',
                            'icon'      => true,
                            'type'      => 'info',
                            'raw'       => '<h3>'. __( 'Using a Custom theme Color', 'bethlehem' ). '</h3>' .
                                           '<p>' . __( 'Using a custom color is simple but it requires a few extra steps.', 'bethlehem' ) . '</p>' .
                                           '<p>' . __( 'Method 1 (Recommended) : Using SASS', 'bethlehem' ) . '</p>' .
                                           '<ol>' .
                                           '<li>'. __( 'Navigate to <em>assets/sass/color/custom-color.scss</em> file.', 'bethlehem' ) . '</li>'.
                                           '<li>'. __( 'On line 5, set <mark>$primary-color</mark> to the color of your choice.', 'bethlehem' ) . '</li>'.
                                           '<li>'. __( 'Compile <em>assets/sass/color/custom-color.scss</em> file to <em>assets/css/custom-color.css</em>', 'bethlehem' ) . '</li>'.
                                           '<li>'. __( 'You can also use <a href="http://sassmeister.com/" target="_blank">sassmeister.com/</a> to compile the SCSS file and copy the output to <em>assets/css/custom-color.css</em>', 'bethlehem' ) . '</li>'.
                                           '</ol>'.
                                           '<p>' . __( 'Method 2 : Using CSS and Find and Replace', 'bethlehem' ) . '</p>' .
                                           '<ol>' .
                                           '<li>'. __( 'Navigate to <em>assets/css/custom-color.css</em> file.', 'bethlehem' ) . '</li>'.
                                           '<li>'. __( 'Do a find and replace of yellow color which is #ffb400 with your choice of color.', 'bethlehem' ) . '</li>'.
                                           '<li>'. __( 'We have also used darken and lighten version of the primary color. Replace them as well.', 'bethlehem' ) . '</li>'.
                                           '</ol>'.
                                           '</ol>',
                            'required'  => array( 'use_predefined_color', 'equals', 0 )
                        ),
                        array(
                            'id'                => 'styling_general_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                        array(
                            'id'                => 'body_info_start',
                            'type'              => 'section',
                            'title'             => __( 'Body', 'bethlehem' ),
                            'subtitle'          => __( '<em>Body Customization Settings</em>', 'bethlehem' ),
                            'indent'            => TRUE,
                        ),
                        array(
                            'title'     => __( 'Body Background', 'bethlehem' ),
                            'id'        => 'body_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => __( 'Default BG', 'bethlehem' ),
                                'custom'        => __( 'Custom', 'bethlehem' ),
                            ),
                            'default'   => 'default-bg',
                        ),
                        array(         
                            'id'       => 'body_background',
                            'type'     => 'background',
                            'title'    => __('Body Background', 'bethlehem'),
                            'subtitle' => __('Body background with image, color, etc.', 'bethlehem'),
                            'required' => array(
                                array('body_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => 'body, body.bethlehem_style_1, body.bethlehem_style_1',
                                'background-image'      => 'body, body.bethlehem_style_1, body.bethlehem_style_1',
                                'background-repeat'     => 'body, body.bethlehem_style_1, body.bethlehem_style_1',
                                'background-size'       => 'body, body.bethlehem_style_1, body.bethlehem_style_1',
                                'background-attachment' => 'body, body.bethlehem_style_1, body.bethlehem_style_1',
                                'background-position'   => 'body, body.bethlehem_style_1, body.bethlehem_style_1',
                            )
                        ),
                        array(         
                            'id'       => 'body_heading_color',
                            'type'     => 'color',
                            'title'    => __('Body Heading Color', 'bethlehem'),
                            'required' => array(
                                array('body_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'color' => 'body h1, body h2, body h3, body h4, body h5, body h6'
                            )
                        ),
                        array(
                            'id'                => 'body_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

                array(
                    'title' => __('Typography', 'bethlehem'),
                    'icon' => 'fa fa-font',
                    'fields' => array(
                        array(
                            'title'     => __( 'Use default font settings ?', 'bethlehem' ),
                            'subtitle'  => __( '<em>Toggle No if you want to override with your own fonts</em>', 'bethlehem' ),
                            'id'        => 'use_default_font',
                            'type'      => 'switch',
                            'on'        => __( 'Yes', 'bethlehem' ),
                            'off'       => __( 'No', 'bethlehem' ),
                            'default'   => 1
                        ),
                        array(
                            'title'         => __('Default Font Family', 'bethlehem'),
                            'subtitle'      => __('<em>Pick the default font family for your site.</em>', 'bethlehem'),
                            'id'            => 'default_font',
                            'type'          => 'typography',
                            'line-height'   => false,
                            'text-align'    => false,
                            'font-style'    => false,
                            'font-weight'   => false,
                            'font-size'     => false,
                            'color'         => false,
                            'required'      => array( 'use_default_font', 'equals', 0 ),
                            'default'       => array(
                                'font-family'   => 'Open Sans',
                                'subsets'       => '',
                            ),
                        ),

                        array(
                            'title'         => __('Title Font Family', 'bethlehem'),
                            'subtitle'      => __('<em>Pick the font family for titles for your site.</em>', 'bethlehem'),
                            'id'            => 'title_font',
                            'type'          => 'typography',
                            'line-height'   => false,
                            'text-align'    => false,
                            'font-style'    => false,
                            'font-weight'   => false,
                            'font-size'     => false,
                            'color'         => false,
                            'default'       => array(
                                'font-family'   => 'Open Sans',
                                'subsets'       => '',
                            ),
                            'required'      => array( 'use_default_font', 'equals', 0 ),
                        ),
                    ),
                ),

                array(
                    'title' => __('Social Media', 'bethlehem'),
                    'icon' => 'fa fa-share-square-o',
                    'fields' => array(
                        array(
                            'title' => __('Facebook', 'bethlehem'),
                            'subtitle' => __('<em>Type your Facebook profile URL here.</em>', 'bethlehem'),
                            'id' => 'facebook',
                            'type' => 'text',
                            'default' => 'https://www.facebook.com/transvelo',
                        ),
                        
                        array(
                            'title' => __('Twitter', 'bethlehem'),
                            'subtitle' => __('<em>Type your Twitter profile URL here.</em>', 'bethlehem'),
                            'id' => 'twitter',
                            'type' => 'text',
                            'default' => 'http://twitter.com/transvelo',
                        ),

                        array(
                            'title' => __('Google+', 'bethlehem'),
                            'subtitle' => __('<em>Type your Google+ profile URL here.</em>', 'bethlehem'),
                            'id' => 'google-plus',
                            'type' => 'text',
                        ),
                        
                        array(
                            'title' => __('Pinterest', 'bethlehem'),
                            'subtitle' => __('<em>Type your Pinterest profile URL here.</em>', 'bethlehem'),
                            'id' => 'pinterest',
                            'type' => 'text',
                        ),
                        
                        array(
                            'title' => __('LinkedIn', 'bethlehem'),
                            'subtitle' => __('<em>Type your LinkedIn profile URL here.</em>', 'bethlehem'),
                            'id' => 'linkedin',
                            'type' => 'text',
                        ),
                        
                        array(
                            'title' => __('RSS', 'bethlehem'),
                            'subtitle' => __('<em>Type your RSS Feed URL here.</em>', 'bethlehem'),
                            'id' => 'rss',
                            'type' => 'text',
                        ),

                        array(
                            'title' => __('Tumblr', 'bethlehem'),
                            'subtitle' => __('<em>Type your Tumblr URL here.</em>', 'bethlehem'),
                            'id' => 'tumblr',
                            'type' => 'text',
                        ),

                        array(
                            'title' => __('Instagram', 'bethlehem'),
                            'subtitle' => __('<em>Type your Instagram profile URL here.</em>', 'bethlehem'),
                            'id' => 'instagram',
                            'type' => 'text',
                        ),

                        array(
                            'title' => __('Youtube', 'bethlehem'),
                            'subtitle' => __('<em>Type your Youtube profile URL here.</em>', 'bethlehem'),
                            'id' => 'youtube',
                            'type' => 'text',
                        ),

                        array(
                            'title' => __('Vimeo', 'bethlehem'),
                            'subtitle' => __('<em>Type your Vimeo profile URL here.</em>', 'bethlehem'),
                            'id' => 'vimeo',
                            'type' => 'text',
                        ),

                        array(
                            'title' => __('Dribbble', 'bethlehem'),
                            'subtitle' => __('<em>Type your Dribble profile URL here.</em>', 'bethlehem'),
                            'id' => 'dribbble',
                            'type' => 'text',
                        ),

                        array(
                            'title' => __('Stumble Upon', 'bethlehem'),
                            'subtitle' => __('<em>Type your Stumble Upon profile URL here.</em>', 'bethlehem'),
                            'id' => 'stumbleupon',
                            'type' => 'text',
                        ),

                        array(
                            'title' => __('Sound Cloud', 'bethlehem'),
                            'subtitle' => __('<em>Type your Sound Cloud profile URL here.</em>', 'bethlehem'),
                            'id' => 'soundcloud',
                            'type' => 'text',
                        ),
                    ),
                ),

                array(
                    'title' => __('Custom Code', 'bethlehem'),
                    'icon' => 'fa fa-code',
                    'fields' => array(

                        array(
                            'title' => __('Custom CSS', 'bethlehem'),
                            'subtitle' => __('<em>Paste your custom CSS code here.</em>', 'bethlehem'),
                            'id' => 'custom_css',
                            'type' => 'ace_editor',
                            'mode' => 'css',
                        ),

                        array(
                            'title' => __('Header JavaScript Code', 'bethlehem'),
                            'subtitle' => __('<em>Paste your custom JS code here. The code will be added to the header of your site.</em>', 'bethlehem'),
                            'id' => 'custom_header_js',
                            'type' => 'ace_editor',
                            'mode' => 'javascript',
                        ),

                        array(
                            'title' => __('Footer JavaScript Code', 'bethlehem'),
                            'subtitle' => __('<em>Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.</em>', 'bethlehem'),
                            'id' => 'custom_footer_js',
                            'type' => 'ace_editor',
                            'mode' => 'javascript',
                        ),
                    ),
                ),
            );

            $theme = wp_get_theme();

            $args = array(
                'opt_name'          => 'bethlehem_options',
                'display_name'      => $theme->get('Name'),
                'display_version'   => $theme->get('Version'),
                'allow_sub_menu'    => false,
                'menu_title'        => __( 'Bethlehem', 'bethlehem' ),
                'google_api_key'    => 'AIzaSyDDZJO4F0d17RnFoi1F2qtw4wn6Wcaqxao',
                'page_priority'     => 3,
                'page_slug'         => 'theme_options',
                'intro_text'        => '',
                'dev_mode'          => false,
                'customizer'        => true,
                'footer_credit'     => '&nbsp;',
            );

            $ReduxFramework = new ReduxFramework($sections, $args);
        }   
    }
    new Bethlehem_Options();
}