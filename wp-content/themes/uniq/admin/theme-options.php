<?php
/**
 * Created by PhpStorm.
 * User: venkat
 * Date: 2/5/16
 * Time: 4:32 PM        
 */

include_once( get_template_directory() . '/admin/kirki/kirki.php' );     
include_once( get_template_directory() . '/admin/kirki-helpers/class-uniq-kirki.php' );
       
Uniq_Kirki::add_config( 'uniq', array(     
	'capability'    => 'edit_theme_options',                  
	'option_type'   => 'theme_mod',           
) );             
     
// uniq option start //   

//  site identity section // 

Uniq_Kirki::add_section( 'title_tagline', array(
	'title'          => __( 'Site Identity','uniq' ),
	'description'    => __( 'Site Header Options', 'uniq'),       
	'priority'       => 8,         																																																				
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'logo_title',
	'label'    => __( 'Enable Logo as Title', 'uniq' ),
	'section'  => 'title_tagline',
	'type'     => 'switch',
	'priority' => 5,
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'off',   
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'tagline',
	'label'    => __( 'Show site Tagline', 'uniq' ), 
	'section'  => 'title_tagline',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'on',
) );

// home panel //

Uniq_Kirki::add_panel( 'home_options', array(     
	'title'       => __( 'Home', 'uniq' ),
	'description' => __( 'Home Page Related Options', 'uniq' ),     
) );  

// home page type section

Uniq_Kirki::add_section( 'home_type_section', array(
	'title'          => __( 'General Settings','uniq' ),
	'description'    => __( 'Home Page options', 'uniq'),
	'panel'          => 'home_options', // Not typically needed. 
) );

	
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_home_default_content',
	'label'    => __( 'Enable Home Page Default Content', 'uniq' ),
	'section'  => 'home_type_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),

	'default'  => 'off',
	'tooltip' => __('Enable home page default content ( home page content )','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'home_sidebar',
	'label'    => __( 'Enable sidebar on the Home page', 'uniq' ),
	'section'  => 'home_type_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	
	'default'  => 'off',
	'tooltip' => __('Disable by default. If you want to display the sidebars in your frontpage, turn this Enable.','uniq'),
) );
  

// Slider section

Uniq_Kirki::add_section( 'slider_section', array(
	'title'          => __( 'Slider Section','uniq' ),
	'description'    => __( 'Home Page Slider Related Options', 'uniq'),
	'panel'          => 'home_options', // Not typically needed. 
) );
Uniq_Kirki::add_field( 'uniq', array(  
	'settings' => 'enable_slider',
	'label'    => __( 'Enable Slider Post ( Section )', 'uniq' ),
	'section'  => 'slider_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ),
	),
	'default'  => 'on',
	'tooltip' => __('Enable Slider Post in home page','uniq'),
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'slider_cat',
	'label'    => __( 'Slider Posts category', 'uniq' ),
	'section'  => 'slider_section',
	'type'     => 'select',
	'choices' => Kirki_Helper::get_terms( 'category' ),
	'active_callback' => array(
		array(
			'setting'  => 'enable_slider',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Create post ( Goto Dashboard => Post => Add New ) and Post Featured Image ( Preferred size is 1200 x 450 pixels ) as taken as slider image and Post Content as taken as Flexcaption.','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'slider_count',
	'label'    => __( 'No. of Sliders', 'uniq' ),
	'section'  => 'slider_section',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 999,
		'step' => 1,
	),
	'default'  => 2,
	'active_callback' => array(
		array(
			'setting'  => 'enable_slider',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Enter number of slides you want to display under your selected Category','uniq'),
) );

     
// service section 

Uniq_Kirki::add_section( 'service_section', array(
	'title'          => __( 'Service Section','uniq' ),
	'description'    => __( 'Home Page - Service Related Options', 'uniq'),
	'panel'          => 'home_options', // Not typically needed. 
) );

Uniq_Kirki::add_field( 'uniq', array( 
	'settings' => 'enable_service',
	'label'    => __( 'Enable Service Section', 'uniq' ),
	'section'  => 'service_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	
	'default'  => 'on',
	'tooltip' => __('Enable service section in home page','uniq'),
) ); 
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'service_count',
	'label'    => __( 'No. of Service Section', 'uniq' ),
	'description' => __('Save the Settings, and Reload this page to Configure the service section','uniq'),
	'section'  => 'service_section',
	'type'     => 'number',
	'choices' => array(
		'min' => 3,
		'max' => 99,
		'step' => 1,
	),
	'default'  => 3,
	'active_callback' => array(
		array(
			'setting'  => 'enable_service',
			'operator' => '==',
			'value'    => true,
		),
		
    ),
    'tooltip' => __('Enter number of service page you want to display','uniq'),
) );

if ( get_theme_mod('service_count') > 0 ) {
 $service = get_theme_mod('service_count');
 		for ( $i = 1 ; $i <= $service ; $i++ ) {
             //Create the settings Once, and Loop through it.
 			Uniq_Kirki::add_field( 'uniq', array(
				'settings' => 'service_'.$i,
				'label'    => sprintf(__( 'Service Section #%1$s', 'uniq' ), $i ),
				'section'  => 'service_section',
				'type'     => 'dropdown-pages',	
				//'tooltip' => __('Create Page ( Goto Dashboard => Page =>Add New ) and Page Featured Image ( Preferred size is 100 x 100 pixels )','uniq'),
				'active_callback' => array(
					array(
						'setting'  => 'enable_service',
						'operator' => '==',
						'value'    => true,
					),
					
                ), 
               // 'description' => __('Create Page ( Goto Dashboard => Page =>Add New ) and Page Featured Image ( Preferred size is 100 x 100 pixels )','uniq'),
        
			) );
 		}
}
// latest blog section 

Uniq_Kirki::add_section( 'latest_blog_section', array(
	'title'          => __( 'Latest Blog Section','uniq' ),
	'description'    => __( 'Home Page - Latest Blog Options', 'uniq'),
	'panel'          => 'home_options', // Not typically needed. 
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_recent_post_service',
	'label'    => __( 'Enable Recent Post Section', 'uniq' ),
	'section'  => 'latest_blog_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	 
	'default'  => 'on',
	'tooltip' => __('Enable recent post section in home page','uniq'),
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'recent_posts_count',
	'label'    => __( 'No. of Recent Posts', 'uniq' ),
	'section'  => 'latest_blog_section',
	'type'     => 'number',
	'choices' => array(
		'min' => 2,
		'max' => 99,
		'step' => 1,
	),
	'default'  => 4,
	'active_callback' => array(
		array(
			'setting'  => 'enable_recent_post_service',
			'operator' => '==',
			'value'    => true,
		),
		
    ),
) );

// general panel   

Uniq_Kirki::add_panel( 'general_panel', array(   
	'title'       => __( 'General Settings', 'uniq' ),  
	'description' => __( 'general settings', 'uniq' ),         
) );

//  Page title bar section // 

Uniq_Kirki::add_section( 'header-pagetitle-bar', array(   
	'title'          => __( 'Page Title Bar & Breadcrumb','uniq' ),
	'description'    => __( 'Page Title bar related options', 'uniq'),
	'panel'          => 'general_panel', // Not typically needed.
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'page_titlebar',  
	'label'    => __( 'Page Title Bar', 'uniq' ),
	'section'  => 'header-pagetitle-bar', 
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		1 => __( 'Show Bar and Content', 'uniq' ),
		2 => __( 'Show Content Only ', 'uniq' ),
		3 => __('Hide','uniq'),
    ),
    'default' => 1,
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'page_titlebar_text',  
	'label'    => __( 'Page Title Bar Text', 'uniq' ),
	'section'  => 'header-pagetitle-bar', 
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		1 => __( 'Show', 'uniq' ),
		2 => __( 'Hide', 'uniq' ), 
    ),
    'default' => 1,
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'breadcrumb',  
	'label'    => __( 'Breadcrumb', 'uniq' ),
	'section'  => 'header-pagetitle-bar', 
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ),
	),
	'default'  => 'on',
) ); 

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'breadcrumb_char',
	'label'    => __( 'Breadcrumb Character', 'uniq' ),
	'section'  => 'header-pagetitle-bar',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		1 => __( ' >> ', 'uniq' ),
		2 => __( ' / ', 'uniq' ),
		3 => __( ' > ', 'uniq' ),
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'breadcrumb',
			'operator' => '==',
			'value'    => true,
		),
	),
	//'sanitize_callback' => 'allow_htmlentities'
) );

//  pagination section // 

Uniq_Kirki::add_section( 'general-pagination', array(   
	'title'          => __( 'Pagination','uniq' ),
	'description'    => __( 'Pagination related options', 'uniq'),
	'panel'          => 'general_panel', // Not typically needed.
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'numeric_pagination',
	'label'    => __( 'Numeric Pagination', 'uniq' ),   
	'section'  => 'general-pagination',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Numbered', 'uniq' ),
		'off' => esc_attr__( 'Next/Previous', 'uniq' )
	),
	'default'  => 'on',
) );

// skin color panel 

Uniq_Kirki::add_panel( 'skin_color_panel', array(   
	'title'       => __( 'Skin Color', 'uniq' ),  
	'description' => __( 'Color Settings', 'uniq' ),         
) );

// Change Color Options

Uniq_Kirki::add_section( 'primary_color_field', array(
	'title'          => __( 'Change Color Options','uniq' ),
	'description'    => __( 'This will reflect in links, buttons,Navigation and many others. Choose a color to match your site.', 'uniq'),
	'panel'          => 'skin_color_panel', // Not typically needed.
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_primary_color',
	'label'    => __( 'Enable Custom Primary color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'off',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'primary_color',
	'label'    => __( 'Primary color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '#3DAD66',
	'alpha'  => true,
	'active_callback' => array(
		array (
			'setting'  => 'enable_primary_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element'  => 'button:hover,.main-navigation ul ul a,
							input[type="button"]:hover,
							input[type="reset"]:hover,
							input[type="submit"]:hover,
							input[type="text"]:focus,
							input[type="email"]:focus,
							input[type="url"]:focus,
							input[type="password"]:focus,
							input[type="search"]:focus,.flexslider .flex-caption a:hover,
							textarea:focus,ol.comment-list li.byuser article,ol.comment-list li.byuser .comment-author img',
			'property' => 'border-color',
		),
		array(
			'element'  => '.main-navigation ul.nav-menu > li > a,.branding .site-branding,.main-navigation ul.menu li:hover li a,	
							button:hover,.branding .site-branding,
							input[type="button"]:hover,.site-header-sticky,
							.home.blog .site-header-sticky,
							input[type="reset"]:hover,.hentry.sticky,
							input[type="submit"]:hover,.nav-links .meta-nav:hover,
							.more-link .meta-nav:hover,a.more-link:hover .meta-nav,.webulous_page_navi li a:hover,.webulous_page_navi li.bpn-next-link a:hover,
							.webulous_page_navi li.bpn-prev-link a:hover,.webulous_page_navi li.bpn-current ,.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover,
							.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
							.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover,
							.woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover,
							.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
							.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
							.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
							.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,.woocommerce #content nav.woocommerce-pagination ul li a:focus,
							.woocommerce #content nav.woocommerce-pagination ul li a:hover,
							.woocommerce #content nav.woocommerce-pagination ul li span.current,
							.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce a.remove,
							.woocommerce nav.woocommerce-pagination ul li a:hover,
							.woocommerce nav.woocommerce-pagination ul li span.current,
							.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
							.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
							.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
							.woocommerce-page nav.woocommerce-pagination ul li a:focus,
							.woocommerce-page nav.woocommerce-pagination ul li a:hover,
							.woocommerce-page nav.woocommerce-pagination ul li span.current,.widget_tag_cloud a,blockquote,blockquote:after,.flexslider .flex-caption a:hover, .flexslider .flex-direction-nav a.flex-next:hover:after,
							.flexslider .flex-direction-nav a.flex-next:hover:before,
							.flexslider .flex-direction-nav a.flex-prev:hover:before,
							.flexslider .flex-direction-nav a.flex-prev:hover:after,.page-template-blog-fullwidth .entry-body a.more-link,
							.page-template-blog-large .entry-body a.more-link,.site-footer .footer-widgets .widget_calendar td#today,
							.archive.category .entry-body a.more-link,.site-content .widget_social-networks-widget ul li a,
							.site-content .share-box ul li a,.widget_calendar table caption ',
			'property' => 'background-color',
		),
		array(
			'element'  => '.site-info .widget_nav_menu a:hover,.copyright p a,.site-footer .footer-widgets a:hover,
							.site-footer .footer-widgets .widget_calendar a,.widget-area .widget_rss a,
							.widget_calendar table th a, .widget_calendar table td a,.widget-area ul li a:hover,
							.entry-body .entry-title-meta a:hover,.entry-body .entry-title-meta span:hover,.entry-body .header-entry-meta,.breadcrumb-wrap #breadcrumb a,.post-wrapper .latest-post a.btn-readmore,
							.flexslider .flex-direction-nav a:hover,.hentry.post h1 a:hover,.hentry.sticky .entry-meta .posted-on a:hover,a:visited,.branding .top-nav .social ul li a:hover,.comment-metadata a:hover,
							.order-total .amount,
							.cart-subtotal .amount,.woocommerce #content table.cart a.remove,
							.woocommerce table.cart a.remove,
							.woocommerce-page #content table.cart a.remove,
							.woocommerce-page table.cart a.remove,.woocommerce .woocommerce-breadcrumb a:hover,
							.woocommerce-page .woocommerce-breadcrumb a:hover,.star-rating',	
			'property' => 'color',
		),
		array(
			'element'  => '.woocommerce #content input.button:hover,
							.woocommerce #respond input#submit:hover,
							.woocommerce a.button:hover,
							.woocommerce button.button:hover,
							.woocommerce input.button:hover,
							.woocommerce-page #content input.button:hover,
							.woocommerce-page #respond input#submit:hover,
							.woocommerce-page a.button:hover,
							.woocommerce-page button.button:hover,
							.woocommerce-page input.button:hover,.site-header-sticky, .home.blog .site-header-sticky',
			'property' => 'background-color',
			'suffix' => '!important',
		),
		array(
			'element' => '.branding .site-branding::after,
.branding .site-branding:after ',
			'property' => 'border-top-color',
		),
		array(
			'element' => '.widget-area h4.widget-title ',
			'property' => 'border-bottom-color',
		),
	),
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_navigation_primary_color',
	'label'    => __( 'Enable Navigation Primary Color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'off',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'navigation_primary_color',
	'label'    => __( 'Navigation Primary Color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '#3dad66',
	'alpha'  => true,
	'active_callback' => array(
		array(
			'setting'  => 'enable_navigation_primary_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element' => '.main-navigation ul.nav-menu > li > a,.branding .site-branding',
			'property' => 'background-color',
		),
		array(
			'element' => '.branding .site-branding::after',
			'property' => 'border-top-color',
		),
	),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_nav_hover_color',
	'label'    => __( 'Enable Navigation Hover color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'off',
) );    
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'nav_hover_color',
	'label'    => __( 'Navigation Hover Color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '#5f015b',
	'alpha'  => true,
	'active_callback' => array(
		array(
			'setting'  => 'enable_nav_hover_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element' => '.main-navigation ul.menu > li > a:hover,
							#site-navigation .current_page_item a, #site-navigation .current-menu-item a,
							#site-navigation .current-menu-parent > a,
							 #site-navigation .current_page_parent > a ',
			'property' => 'background-color',
		),
		
	),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_nav_dropdown_hover_color',
	'label'    => __( 'Enable Navigation Dropdown Hover color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'off',
) );    
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'nav_dropdown_hover_color',
	'label'    => __( 'Navigation Dropdown Hover color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '#5f015b',
	'alpha'  => true,
	'active_callback' => array(
		array(
			'setting'  => 'enable_nav_dropdown_hover_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element' => '.main-navigation ul.menu li:hover li a:hover ',
			'property' => 'background-color',
		),
		
	),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_nav_dropdown_bg_color',
	'label'    => __( 'Enable Navigation Dropdown Background color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'off',
) );    
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'nav_dropdown_bg_color',
	'label'    => __( 'Navigation Dropdown Background color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '#3DAD66',
	'alpha'  => true,
	'active_callback' => array(
		array(
			'setting'  => 'enable_nav_dropdown_bg_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element' => '.main-navigation ul.menu li:hover li a ',
			'property' => 'background-color',
		),
		array(
			'element' => '.main-navigation ul ul a',
			'property' => 'border-color',
		),
		
	),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_secondary_color',
	'label'    => __( 'Enable Custom Secondary color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'off',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'secondary_color',
	'label'    => __( 'Secondary Color', 'uniq' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '#4c4c4c',
	'alpha'  => true,
	'active_callback' => array(
		array(
			'setting'  => 'enable_secondary_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element' => '.webulous_page_navi li.bpn-current,.ui-accordion h3,.widget.widget_ourteam-widget .team-content h4,ol.comment-list .reply a:hover,.comment-author cite.fn a:hover,ol.comment-list li.byuser .comment-metadata a:hover,.hentry.sticky h1.entry-title a:hover,.hentry.sticky a,.hentry.sticky .entry-footer a:hover,
							.hentry.sticky .entry-meta a:hover,.circle-icon-box .more-button a:hover,
							button,
							input,
							select,
							textarea,h1, h2, h3, h4, h5, h6,
							      .ui-accordion .ui-accordion-header-active,.icon-horizontal .icon-title,.icon-horizontal .service,
							.icon-vertical .service,.related-posts ul#webulous-related-posts li:hover a,.cnt-form .wpcf7-form input[type="submit"],
							.icon-vertical .icon-title,.circle-icon-box .icon-wrapper p.fa-stack i,.siteorigin-panels-stretch .widget.widget_ourteam-widget .team-content h4,
							.wide-pattern-black .widget.widget_ourteam-widget .team-content h4,.widget.widget_skill-widget .skill-container .skill-content .txt-count,.page-links a:hover,.entry-header .posted-on .dd,.widget-area .widget_rss a:hover',
			'property' => 'color',
		),
		array(
			'element' => '.ui-accordion h3,.ui-accordion .ui-accordion-content,.stat-container .icon-wrapper .fa:after,#filters ul.filter-options li a:hover,
                          #filters ul.filter-options li a.selected,.toggle .toggle-title,.toggle .toggle-content',
			'property' => 'border-color',
			
		),
		array(
			'element' => '.nav-wrap,.main-navigation ul.menu > li > a:hover,.portfolio-excerpt a.btn-readmore:hover,
						.portfolio-excerpt a.more-link:hover,.portfolioeffects:hover .portfolio_link_icons a:hover,.ui-accordion .ui-accordion-content,.main-navigation ul.menu > li.current_page_item > a,.main-navigation ul.menu li:hover a,.navigation a,
						.more-link,a.more-link .meta-nav,.webulous_page_navi li a,.webulous_page_navi li.bpn-next-link a,
						.webulous_page_navi li.bpn-prev-link a,.widget_tag_cloud a:hover,.widget_social-networks-widget ul li a:hover,
						.share-box ul li a:hover,#filters ul.filter-options li a:after,.widget.widget_ourteam-widget .team-social ul li a:hover,
						.comment-navigation a,.widget_recent-work-widget .portfolioeffects .overlay_icon a,.flex-direction-nav a.flex-next:hover:after,
						.flex-direction-nav a.flex-next:hover:before,.callout-widget a,.widget_testimonial-widget .flex-control-nav a,
						.flex-direction-nav a.flex-prev:hover:before,.toggle .toggle-content,.icon-horizontal:hover .icon-wrapper,
						.icon-vertical:hover .icon-wrapper,.page-template-blog-fullwidth .entry-body a.more-link:hover,
						.page-template-blog-large .entry-body a.more-link:hover,.cnt-form,.cnt-form .wpcf7-form input,
						.cnt-form .wpcf7-form textarea,
						button,
						input[type="button"],
						input[type="reset"],
						input[type="submit"],
						.archive.category .entry-body a.more-link:hover,.wide-pattern-green,
						.flex-direction-nav a.flex-prev:hover:after,.toggle .toggle-title .icn,
						.widget_recent-work-widget .work .overlay_icon a,.ui-accordion .ui-accordion-header-active:before,.ui-accordion h3:before,.nav-links .meta-nav,.more-link .meta-nav,.widget.widget_skill-widget .skill-container .skill .skill-percentage',
			'property' => 'background-color',
		),
       array(
			'element' => '.nav-wrap:after,.cnt-details h3.widget-title:after',
			'property' => 'border-right-color',
		),
        array(
			'element' => '.widget_social-networks-widget ul li a:hover:after
        				 .share-box ul li a:hover:after,
        				.portfolioeffects:hover .portfolio_link_icons a:hover:after',
			'property' => 'border-top-color',
		),
		array(
			'element' => '.site-header-sticky,
							.home.blog .site-header-sticky,
							.page-template-page-full-width-slider .site-header-sticky,abbr, acronym',
			'property' => 'border-bottom-color',
		),
	),
) );
// typography panel //

Uniq_Kirki::add_panel( 'typography', array( 
	'title'       => __( 'Typography', 'uniq' ),
	'description' => __( 'Typography and Link Color Settings', 'uniq' ),
) );
   
    Uniq_Kirki::add_section( 'typography_section', array(
		'title'          => __( 'General Settings','uniq' ),
		'description'    => __( 'General Settings', 'uniq'),
		'panel'          => 'typography', // Not typically needed.
	) );
	Uniq_Kirki::add_field( 'uniq', array(
		'settings' => 'custom_typography',
		'label'    => __( 'Enable Custom Typography', 'uniq' ),
		'description' => __('Save the Settings, and Reload this page to Configure the typography section','uniq'),
		'section'  => 'typography_section',
		'type'     => 'switch',
		'choices' => array(
			'on'  => esc_attr__( 'Enable', 'uniq' ),
			'off' => esc_attr__( 'Disable', 'uniq' )
		),
		'tooltip' => __('Turn on to customize typography and turn off for default typography','uniq'),
		'default'  => 'off',
	) );

$typography_setting = get_theme_mod('custom_typography',false );
if( $typography_setting ) :

        $body_font = get_theme_mod('body_family','Roboto');		        
	    $body_color = get_theme_mod( 'body_color','#4c4c4c' );   
		$body_size = get_theme_mod( 'body_size','16');
		$body_weight = get_theme_mod( 'body_weight','regular');
		$body_weight == 'bold' ? $body_weight = '400':  $body_weight = 'regular';
		

	Uniq_Kirki::add_section( 'body_font', array(
		'title'          => __( 'Body Font','uniq' ),
		'description'    => __( 'Specify the body font properties', 'uniq'),
		'panel'          => 'typography', // Not typically needed.
	) ); 


	Uniq_Kirki::add_field( 'uniq', array(
		'settings' => 'body',
		'label'    => __( 'Body Settings', 'uniq' ),
		'section'  => 'body_font', 
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $body_font,
			'variant'        => $body_weight,
			'font-size'      => $body_size.'px',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => $body_color,
		),
		'output'      => array(
			array(
				'element' => 'body',
				//'suffix' => '!important',
			),
		),
	) );


	Uniq_Kirki::add_section( 'heading_section', array(
		'title'          => __( 'Heading Font','uniq' ),
		'description'    => __( 'Specify typography of H1, H2, H3, H4, H5, H6', 'uniq'),
		'panel'          => 'typography', // Not typically needed.
	) );

	$h1_font = get_theme_mod('h1_family','Patua One');
	$h1_color = get_theme_mod( 'h1_color','#242424' );
	$h1_size = get_theme_mod( 'h1_size','48');
	$h1_weight = get_theme_mod( 'h1_weight','400');
	$h1_weight == 'bold' ? $h1_weight = '400' : $h1_weight = 'regular';

	Uniq_Kirki::add_field( 'uniq', array(
		'settings' => 'h1',
		'label'    => __( 'H1 Settings', 'uniq' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h1_font,
			'variant'        => $h1_weight,
			'font-size'      => $h1_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h1_color,
		),
		'output'      => array(
			array(
				'element' => 'h1',
			),
		),
		
	) );

	$h2_font = get_theme_mod('h2_family','Patua One');
	$h2_color = get_theme_mod( 'h2_color','#242424' );
	$h2_size = get_theme_mod( 'h2_size','36');
	$h2_weight = get_theme_mod( 'h2_weight','400');
	$h2_weight == 'bold' ? $h2_weight = '400' : $h2_weight = 'regular';

	Uniq_Kirki::add_field( 'uniq', array(
		'settings' => 'h2',
		'label'    => __( 'H2 Settings', 'uniq' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h2_font,
			'variant'        => $h2_weight,
			'font-size'      => $h2_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h2_color,
		),
		'output'      => array(
			array(
				'element' => 'h2',
			),
		),
		
	) );

	$h3_font = get_theme_mod('h3_family','Patua One');
	$h3_color = get_theme_mod( 'h3_color','#242424' );
	$h3_size = get_theme_mod( 'h3_size','30');
	$h3_weight = get_theme_mod( 'h3_weight','400');
	$h3_weight == 'bold' ? $h3_weight = '400' : $h3_weight = 'regular';

	Uniq_Kirki::add_field( 'uniq', array(
		'settings' => 'h3',
		'label'    => __( 'H3 Settings', 'uniq' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default' => array(
			'font-family'    => $h3_font,
			'variant'        => $h3_weight,
			'font-size'      => $h3_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h3_color,
		),
		'output'      => array(
			array(
				'element' => 'h3',
			),
		),
	
	) );

	$h4_font = get_theme_mod('h4_family','Patua One');
	$h4_color = get_theme_mod( 'h4_color','#242424' );
	$h4_size = get_theme_mod( 'h4_size','24');
	$h4_weight = get_theme_mod( 'h4_weight','400');
	$h4_weight == 'bold' ? $h4_weight = '400' : $h4_weight = 'regular';


	Uniq_Kirki::add_field( 'uniq', array(
		'settings' => 'h4',
		'label'    => __( 'H4 Settings', 'uniq' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h4_font,
			'variant'        => $h4_weight,
			'font-size'      => $h4_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h4_color,
		),
		'output'      => array(
			array(
				'element' => 'h4',
			),
		),
	
	) );

    $h5_font = get_theme_mod('h5_family','Patua One');
	$h5_color = get_theme_mod( 'h5_color','#242424' );
	$h5_size = get_theme_mod( 'h5_size','18');
	$h5_weight = get_theme_mod( 'h5_weight','400');
	$h5_weight == 'bold' ? $h5_weight = '400' : $h5_weight = 'regular';


	Uniq_Kirki::add_field( 'uniq', array(
		'settings' => 'h5',
		'label'    => __( 'H5 Settings', 'uniq' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h5_font,
			'variant'        => $h5_weight,
			'font-size'      => $h5_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h5_color,
		),
		'output'      => array(
			array(
				'element' => 'h5',
			),
		),
	
	) );

	$h6_font = get_theme_mod('h6_family','Patua One');
	$h6_color = get_theme_mod( 'h6_color','#242424' );
	$h6_size = get_theme_mod( 'h6_size','16');
	$h6_weight = get_theme_mod( 'h6_weight','400');
	$h6_weight == 'bold' ? $h6_weight = '400' : $h6_weight = 'regular';


	Uniq_Kirki::add_field( 'uniq', array(
		'settings' => 'h6',
		'label'    => __( 'H6 Settings', 'uniq' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h6_font,
			'variant'        => $h6_weight,
			'font-size'      => $h6_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h6_color,
		),
		'output'      => array(
			array(
				'element' => 'h6',
			),
		),
	) );

	// navigation font 
	Uniq_Kirki::add_section( 'navigation_section', array(
		'title'          => __( 'Navigation Font','uniq' ),
		'description'    => __( 'Specify Navigation font properties', 'uniq'),
		'panel'          => 'typography', // Not typically needed.
	) );

	Uniq_Kirki::add_field( 'uniq', array(
		'settings' => 'navigation_font',
		'label'    => __( 'Navigation Font Settings', 'uniq' ),
		'section'  => 'navigation_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => 'Roboto',
			'variant'        => '600',
			'font-size'      => '16px',
			'line-height'    => '1.8', 
			'letter-spacing' => '0',
			'color'          => '#ffffff',
		),
		'output'      => array(
			array(
				'element' => '.main-navigation a',
			),
		),
	) );
endif; 


// header panel //

Uniq_Kirki::add_panel( 'header_panel', array(     
	'title'       => __( 'Header', 'uniq' ),
	'description' => __( 'Header Related Options', 'uniq' ), 
) );  

Uniq_Kirki::add_section( 'header', array(
	'title'          => __( 'General Header','uniq' ),
	'description'    => __( 'Header options', 'uniq'),
	'panel'          => 'header_panel', // Not typically needed.  
) );    

/*Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'header_text_color',
	'label'    => __( 'Header Text Color', 'uniq' ),
	'section'  => 'header',
	'type'     => 'color',
	'alpha' => true,
	'default'  => '#ffffff', 
	'output'   => array(
		array(
			'element'  => '.main-navigation a,.site-header .branding .site-branding .site-title a,
			                .main-navigation ul.nav-menu > li > a,
							.main-navigation ul ul a,.main-navigation a:hover, 
							.main-navigation .current_page_item > a, 
							.main-navigation .current-menu-item > a, 
							.main-navigation .current-menu-parent > a,
							 .main-navigation .current_page_ancestor > a, 
							 .main-navigation .current_page_parent > a',
			'property' => 'color',
		),
	),
) );*/
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'header_search',
	'label'    => __( 'Enable to Show Search box in Header', 'uniq' ), 
	'section'  => 'header',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'on',
) );
/* Breaking News section  */
/*Uniq_Kirki::add_section( 'header_breaking_news', array(
	'title'          => __( 'Breaking News','uniq' ),
	'description'    => __( 'Breaking News', 'uniq'),
	'panel'          => 'header_panel', // Not typically needed.
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'header_breaking_news',
	'label'    => __( 'Enable Breaking News', 'uniq' ), 
	'section'  => 'header_breaking_news',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'active_callback' => array(
		array(
			'setting'  => 'home-page-type',
			'operator' => '==',
			'value'    => 'magazine',
		),
    ),
	'default'  => 'off',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'header_breaking_news_title',
	'label'    => __( 'Breaking News Title', 'uniq' ),
	'section'  => 'header_breaking_news',
	'type'     => 'text',
	'active_callback' => array(
		array(
			'setting'  => 'home-page-type', 
			'operator' => '==',
			'value'    => 'magazine',
		),
		array(
			'setting'  => 'header_breaking_news', 
			'operator' => '==',
			'value'    => true,
		),
    ),
    'default' => __('LATEST NEWS','uniq'),   
) );*/
/* STICKY HEADER section */   

Uniq_Kirki::add_section( 'stricky_header', array(
	'title'          => __( 'Sticky Menu','uniq' ),
	'description'    => __( 'sticky header', 'uniq'),
	'panel'          => 'header_panel', // Not typically needed.
) );
Uniq_Kirki::add_field( 'uniq', array(    
	'settings' => 'sticky_header',
	'label'    => __( 'Enable Sticky Header', 'uniq' ),
	'section'  => 'stricky_header',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'on',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'sticky_header_position',
	'label'    => __( 'Enable Sticky Header Position', 'uniq' ),
	'section'  => 'stricky_header',
	'type'     => 'radio-buttonset',
	'choices' => array(
		'top'  => esc_attr__( 'Top', 'uniq' ),
		'bottom' => esc_attr__( 'Bottom', 'uniq' )
	),
	'active_callback'    => array(
		array(
			'setting'  => 'sticky_header',
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'top',
) );
/*
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'header_top_margin',
	'label'    => __( 'Header Top Margin', 'uniq' ),
	'description' => __('Select the top margin of header in pixels','uniq'),
	'section'  => 'header',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 1000,
		'step' => 1,
	),
	//'default'  => '213',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'header_bottom_margin',
	'label'    => __( 'Header Bottom Margin', 'uniq' ),
	'description' => __('Select the bottom margin of header in pixels','uniq'),
	'section'  => 'header',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 1000,
		'step' => 1,
	),
	//'default'  => '213',
) );*/


/*
/* e-option start */
/*
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'custon_favicon',
	'label'    => __( 'Custom Favicon', 'uniq' ),
	'section'  => 'header',
	'type'     => 'upload',
	'default'  => '',
) ); */
/* e-option start */ 
/* Blog page section */


/* Blog panel */

Uniq_Kirki::add_panel( 'blog_panel', array(     
	'title'       => __( 'Blog', 'uniq' ),
	'description' => __( 'Blog Related Options', 'uniq' ),     
) ); 
Uniq_Kirki::add_section( 'blog', array(
	'title'          => __( 'Blog Page','uniq' ),
	'description'    => __( 'Blog Related Options', 'uniq'),
	'panel'          => 'blog_panel', // Not typically needed.
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'blog-slider',
	'label'    => __( 'Enable to show the slider on blog page', 'uniq' ),
	'section'  => 'blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'off',
	'tooltip' => __('To show the slider on posts page','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'blog_layout',
	'label'    => __( 'Select Blog Page Layout you prefer', 'uniq' ),
	'section'  => 'blog',
	'type'     => 'select',
	'multiple'  => 1,
	'choices' => array(
		1  => esc_attr__( 'Default ( One Column )', 'uniq' ),
		2 => esc_attr__( 'Two Columns ', 'uniq' ),
		3 => esc_attr__( 'Three Columns ( Without Sidebar ) ', 'uniq' ),
		4 => esc_attr__( 'Two Columns With Masonry', 'uniq' ),
		5 => esc_attr__( 'Three Columns With Masonry ( Without Sidebar ) ', 'uniq' ),
	),
	'default'  => 1,
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'featured_image',
	'label'    => __( 'Enable Featured Image', 'uniq' ),
	'section'  => 'blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
	'tooltip' => __('Enable Featured Image for blog page','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'more_text',
	'label'    => __( 'More Text', 'uniq' ),
	'section'  => 'blog',
	'type'     => 'text',
	'description' => __('Text to display in case of text too long','uniq'),
	'default' => __('Read More','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'featured_image_size',
	'label'    => __( 'Choose the Featured Image Size for Blog Page', 'uniq' ),
	'section'  => 'blog',
	'type'     => 'select',
	'multiple'  => 1,
	'choices' => array(
		1 => esc_attr__( 'Large Featured Image', 'uniq' ),
		2 => esc_attr__( 'Small Featured Image', 'uniq' ),
		3 => esc_attr__( 'Original Size', 'uniq' ),
		4 => esc_attr__( 'Medium', 'uniq' ),
		5 => esc_attr__( 'Large', 'uniq' ), 
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'featured_image',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Set large and medium image size: Goto Dashboard => Settings => Media', 'uniq') ,
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_single_post_top_meta',
	'label'    => __( 'Enable to display top post meta data', 'uniq' ),
	'section'  => 'blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
	'tooltip' => __('Enable to Display Top Post Meta Details. This will reflect for blog page, single blog page, blog full width & blog large templates','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'single_post_top_meta',
	'label'    => __( 'Activate and Arrange the Order of Top Post Meta elements', 'uniq' ),
	'section'  => 'blog',
	'type'     => 'sortable',
	'choices'     => array(
		1 => esc_attr__( 'date', 'uniq' ),
		2 => esc_attr__( 'author', 'uniq' ),
		3 => esc_attr__( 'comment', 'uniq' ),
		4 => esc_attr__( 'category', 'uniq' ),
		5 => esc_attr__( 'tags', 'uniq' ),
		6 => esc_attr__( 'edit', 'uniq' ),
	),
	'default'  => array(1, 2, 6),
	'active_callback' => array(
		array(
			'setting'  => 'enable_single_post_top_meta',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Click above eye icon in order to activate the field, This will reflect for blog page, single blog page, blog full width & blog large templates','uniq'),

) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_single_post_bottom_meta',
	'label'    => __( 'Enable to display bottom post meta data', 'uniq' ),
	'section'  => 'blog', 
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'tooltip' => __('Enable to Display Top Post Meta Details. This will reflect for blog page, single blog page, blog full width & blog large templates','uniq'),
	'default'  => 'on',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'single_post_bottom_meta',
	'label'    => __( 'Activate and arrange the Order of Bottom Post Meta elements', 'uniq' ),
	'section'  => 'blog',
	'type'     => 'sortable',
	'choices'     => array(
		1 => esc_attr__( 'date', 'uniq' ),
		2 => esc_attr__( 'author', 'uniq' ),
		3 => esc_attr__( 'comment', 'uniq' ),
		4 => esc_attr__( 'category', 'uniq' ),
		5 => esc_attr__( 'tags', 'uniq' ),
		6 => esc_attr__( 'edit', 'uniq' ),
	),
	'default'  => array(3,4,5),
	'active_callback' => array(
		array(
			'setting'  => 'enable_single_post_bottom_meta',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Click above eye icon in order to activate the field, This will reflect for blog page, single blog page, blog full width & blog large templates','uniq'),
) );


/* Single Blog page section */

Uniq_Kirki::add_section( 'single_blog', array(
	'title'          => __( 'Single Blog Page','uniq' ),
	'description'    => __( 'Single Blog Page Related Options', 'uniq'),
	'panel'          => 'blog_panel', // Not typically needed.
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'single_featured_image',
	'label'    => __( 'Enable Single Post Featured Image', 'uniq' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
	'tooltip' => __('Enable Featured Image for Single Post Page','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'single_featured_image_size',
	'label'    => __( 'Choose the featured image display type for Single Post Page', 'uniq' ),
	'section'  => 'single_blog',
	'type'     => 'radio',
	'choices' => array(
		1  => esc_attr__( 'Large Featured Image', 'uniq' ),
		2 => esc_attr__( 'Small Featured Image', 'uniq' ),
		3 => esc_attr__( 'FullWidth Featured Image', 'uniq' ),
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'single_featured_image',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'author_bio_box',
	'label'    => __( 'Enable Author Bio Box below single post', 'uniq' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'off',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'social_sharing_box',
	'label'    => __( 'Show social sharing options box below single post', 'uniq' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'related_posts',
	'label'    => __( 'Show Related Posts', 'uniq' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'off',
	'tooltip' => __('Show the Related Post for Single Blog Page','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'related_posts_hierarchy',
	'label'    => __( 'Related Posts Must Be Shown As:', 'uniq' ),
	'section'  => 'single_blog',
	'type'     => 'radio',
	'choices' => array(
		1  => esc_attr__( 'Related Posts By Tags', 'uniq' ),
		2 => esc_attr__( 'Related Posts By Categories', 'uniq' ) 
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'related_posts',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Select the Hierarchy','uniq'),

) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'comments',
	'label'    => __( ' Show Comments', 'uniq' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
	'tooltip' => __('Show the Comments for Single Blog Page','uniq'),
) );
//  social network panel //

Uniq_Kirki::add_panel( 'social_panel', array(
	'title'        =>__( 'Social Networks', 'uniq'),
	'description'  =>__( 'social networks', 'uniq'),
	'priority'  =>11,	
));

//social sharing box section

Uniq_Kirki::add_section( 'social_sharing_box', array(
	'title'          =>__( 'Social Sharing Box', 'uniq'),
	'description'   =>__('Social Sharing box related options', 'uniq'),
	'panel'			 =>'social_panel',
));

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'facebook_sb',
	'label'    => __( 'Enable facebook sharing option below single post', 'uniq' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'twitter_sb',
	'label'    => __( 'Enable twitter sharing option below single post', 'uniq' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'linkedin_sb',
	'label'    => __( 'Enable linkedin sharing option below single post', 'uniq' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'google-plus_sb',
	'label'    => __( 'Enable googleplus sharing option below single post', 'uniq' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'email_sb',
	'label'    => __( 'Enable email sharing option below single post', 'uniq' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
) );
/* FOOTER SECTION 
footer panel */

Uniq_Kirki::add_panel( 'footer_panel', array(     
	'title'       => __( 'Footer', 'uniq' ),
	'description' => __( 'Footer Related Options', 'uniq' ),     
) );  

Uniq_Kirki::add_section( 'footer', array(
	'title'          => __( 'Footer','uniq' ),
	'description'    => __( 'Footer related options', 'uniq'),
	'panel'          => 'footer_panel', // Not typically needed.
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_widgets',
	'label'    => __( 'Footer Widget Area', 'uniq' ),
	'description' => sprintf(__('Select widgets, Goto <a href="%1$s"target="_blank"> Customizer </a> => Widgets','uniq'),admin_url('customize.php') ),
	'section'  => 'footer',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
) );
/* Choose No.Of Footer area */
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_widgets_count',
	'label'    => __( 'Choose No.of widget area you want in footer', 'uniq' ),
	'section'  => 'footer',
	'type'     => 'radio-buttonset',
	'choices' => array(
		1  => esc_attr__( '1', 'uniq' ),
		2  => esc_attr__( '2', 'uniq' ),
		3  => esc_attr__( '3', 'uniq' ),
		4  => esc_attr__( '4', 'uniq' ),
	), 
	'default'  => 4,
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'copyright',
	'label'    => __( 'Footer Copyright Text', 'uniq' ),
	'section'  => 'footer',
	'type'     => 'textarea',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_top_margin',
	'label'    => __( 'Footer Top Margin', 'uniq' ),
	'description' => __('Select the top margin of footer in pixels','uniq'),
	'section'  => 'footer',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 1000,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.site-footer',
			'property' => 'margin-top',
			'units' => 'px',
		),
	),
	'default'  => 0,
) );

/* CUSTOM FOOTER BACKGROUND IMAGE 
footer background image section  */

Uniq_Kirki::add_section( 'footer_image', array(
	'title'          => __( 'Footer Image','uniq' ),
	'description'    => __( 'Custom Footer Image options', 'uniq'),
	'panel'          => 'footer_panel', // Not typically needed.
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_image',
	'label'    => __( 'Upload Footer Background Image', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'upload',
	'default'  => '',
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-image',
		),
	),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_size',
	'label'    => __( 'Footer Background Size', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'radio-buttonset',
    'choices' => array(
		'cover'  => esc_attr__( 'Cover', 'uniq' ),
		'contain' => esc_attr__( 'Contain', 'uniq' ),
		'auto'  => esc_attr__( 'Auto', 'uniq' ),
		'inherit'  => esc_attr__( 'Inherit', 'uniq' ),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-size',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'cover',
	'tooltip' => __('Footer Background Image Size','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_repeat',
	'label'    => __( 'Footer Background Repeat', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__('No Repeat', 'uniq'),
        'repeat' => esc_attr__('Repeat', 'uniq'),
        'repeat-x' => esc_attr__('Repeat Horizontally','uniq'),
        'repeat-y' => esc_attr__('Repeat Vertically','uniq'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-repeat',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'repeat',  
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_position',
	'label'    => __( 'Footer Background Position', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'center top' => esc_attr__('Center Top', 'uniq'),
        'center center' => esc_attr__('Center Center', 'uniq'),
        'center bottom' => esc_attr__('Center Bottom', 'uniq'),
        'left top' => esc_attr__('Left Top', 'uniq'),
        'left center' => esc_attr__('Left Center', 'uniq'),
        'left bottom' => esc_attr__('Left Bottom', 'uniq'),
        'right top' => esc_attr__('Right Top', 'uniq'),
        'right center' => esc_attr__('Right Center', 'uniq'),
        'right bottom' => esc_attr__('Right Bottom', 'uniq'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-position',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'center center',  
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_attachment',
	'label'    => __( 'Footer Background Attachment', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'scroll' => esc_attr__('Scroll', 'uniq'),
        'fixed' => esc_attr__('Fixed', 'uniq'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-attachment',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'scroll',  
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_overlay',
	'label'    => __( 'Enable Footer( Background ) Overlay', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'off',
) );
  
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_overlay_color',
	'label'    => __( 'Footer Overlay ( Background )color', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'color',
	'alpha' => true,
	'default'  => '', 
	'active_callback' => array(
		array(
			'setting'  => 'footer_overlay',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'   => array(
		array(
			'element'  => '.footer_image',
			'property' => 'background-color',
		),
	),
) );


// single page section //

Uniq_Kirki::add_section( 'single_page', array(
	'title'          => __( 'Single Page','uniq' ),
	'description'    => __( 'Single Page Related Options', 'uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'single_page_featured_image',
	'label'    => __( 'Enable Single Page Featured Image', 'uniq' ),
	'section'  => 'single_page',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'single_page_featured_image_size',
	'label'    => __( 'Single Page Featured Image Size', 'uniq' ),
	'section'  => 'single_page',
	'type'     => 'radio-buttonset',
	'choices' => array(
		1  => esc_attr__( 'Normal', 'uniq' ),
		2 => esc_attr__( 'FullWidth', 'uniq' ) 
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'single_page_featured_image',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );

// Layout section //

Uniq_Kirki::add_section( 'layout', array(
	'title'          => __( 'Layout','uniq' ),
	'description'    => __( 'Layout Related Options', 'uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'site-style',
	'label'    => __( 'Site Style', 'uniq' ),
	'section'  => 'layout',
	'type'     => 'radio-buttonset',
	'choices' => array(
		'wide' =>  esc_attr__('Wide', 'uniq'),
        'boxed' =>  esc_attr__('Boxed', 'uniq'),
        'fluid' =>  esc_attr__('Fluid', 'uniq'),  
        //'static' =>  esc_attr__('Static ( Non Responsive )', 'uniq'),
    ),
	'default'  => 'wide',
	'tooltip' => __('Select the default site layout. Defaults to "Wide".','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'sidebar_position',
	'label'    => __( 'Main Layout', 'uniq' ),
	'section'  => 'layout',
	'type'     => 'radio-image',   
	'description' => __('Select main content and sidebar arranuniqent.','uniq'),
	'choices' => array(
		'left' =>  get_template_directory_uri() . '/admin/kirki/assets/images/2cl.png',
        'right' =>  get_template_directory_uri() . '/admin/kirki/assets/images/2cr.png',
        'two-sidebar' =>  get_template_directory_uri() . '/admin/kirki/assets/images/3cm.png',  
        'two-sidebar-left' =>  get_template_directory_uri() . '/admin/kirki/assets/images/3cl.png',
        'two-sidebar-right' =>  get_template_directory_uri() . '/admin/kirki/assets/images/3cr.png',
        'fullwidth' =>  get_template_directory_uri() . '/admin/kirki/assets/images/1c.png',
        'no-sidebar' =>  get_template_directory_uri() . '/images/no-sidebar.png',
    ),
	'default'  => 'right',
	'tooltip' => __('This layout will be reflected in all pages unless unique layout template is set for specific page','uniq'),
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'body_top_margin',
	'label'    => __( 'Body Top Margin', 'uniq' ),
	'description' => __('Select the top margin of body element in pixels','uniq'),
	'section'  => 'layout',
	'type'     => 'number',
	'choices' => array(
		'min' => 0,
		'max' => 200,
		'step' => 1,
	),
	'active_callback'    => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'margin-top',
			'units'    => 'px',
		),
	),
	'default'  => 0,
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'body_bottom_margin',
	'label'    => __( 'Body Bottom Margin', 'uniq' ),
	'description' => __('Select the bottom margin of body element in pixels','uniq'),
	'section'  => 'layout',
	'type'     => 'number',
	'choices' => array(
		'min' => 0,
		'max' => 200,
		'step' => 1,
	),
	'active_callback'    => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
	'default'  => 0,
) );

/* LAYOUT SECTION  */
/*
Uniq_Kirki::add_section( 'layout', array(
	'title'          => __( 'Layout','uniq' ),   
	'description'    => __( 'Layout settings that affects overall site', 'uniq'),
	'panel'          => 'uniq_options', // Not typically needed.
) );



Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'primary_sidebar_width',
	'label'    => __( 'Primary Sidebar Width', 'uniq' ),
	'section'  => 'layout',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'1' => __( 'One Column', 'uniq' ),
		'2' => __( 'Two Column', 'uniq' ),
		'3' => __( 'Three Column', 'uniq' ),
		'4' => __( 'Four Column', 'uniq' ),
		'5' => __( 'Five Column ', 'uniq' ),
	),
	'default'  => '5',  
	'tooltip' => __('Select the width of the Primary Sidebar. Please note that the values represent grid columns. The total width of the page is 16 columns, so selecting 5 here will make the primary sidebar to have a width of approximately 1/3 ( 4/16 ) of the total page width.','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'secondary_sidebar_width',
	'label'    => __( 'Secondary Sidebar Width', 'uniq' ),
	'section'  => 'layout',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'1' => __( 'One Column', 'uniq' ),
		'2' => __( 'Two Column', 'uniq' ),
		'3' => __( 'Three Column', 'uniq' ),
		'4' => __( 'Four Column', 'uniq' ),
		'5' => __( 'Five Column ', 'uniq' ),
	),            
	'default'  => '5',  
	'tooltip' => __('Select the width of the Secondary Sidebar. Please note that the values represent grid columns. The total width of the page is 16 columns, so selecting 5 here will make the primary sidebar to have a width of approximately 1/3 ( 4/16 ) of the total page width.','uniq'),
) ); 

*/

/* FOOTER SECTION 
footer panel */

Uniq_Kirki::add_panel( 'footer_panel', array(     
	'title'       => __( 'Footer', 'uniq' ),
	'description' => __( 'Footer Related Options', 'uniq' ),     
) );  

Uniq_Kirki::add_section( 'footer', array(
	'title'          => __( 'Footer','uniq' ),
	'description'    => __( 'Footer related options', 'uniq'),
	'panel'          => 'footer_panel', // Not typically needed.
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_widgets',
	'label'    => __( 'Footer Widget Area', 'uniq' ),
	'description' => sprintf(__('Select widgets, Goto <a href="%1$s"target="_blank"> Customizer </a> => Widgets','uniq'),admin_url('customize.php') ),
	'section'  => 'footer',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'on',
) );
/* Choose No.Of Footer area */
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_widgets_count',
	'label'    => __( 'Choose No.of widget area you want in footer', 'uniq' ),
	'section'  => 'footer',
	'type'     => 'radio-buttonset',
	'choices' => array(
		1  => esc_attr__( '1', 'uniq' ),
		2  => esc_attr__( '2', 'uniq' ),
		3  => esc_attr__( '3', 'uniq' ),
		4  => esc_attr__( '4', 'uniq' ),
	),
	'default'  => 4,
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'copyright',
	'label'    => __( 'Footer Copyright Text', 'uniq' ),
	'section'  => 'footer',
	'type'     => 'textarea',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_top_margin',
	'label'    => __( 'Footer Top Margin', 'uniq' ),
	'description' => __('Select the top margin of footer in pixels','uniq'),
	'section'  => 'footer',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 1000,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.site-footer',
			'property' => 'margin-top',
			'units' => 'px',
		),
	),
	'default'  => 0,
) );

/* CUSTOM FOOTER BACKGROUND IMAGE 
footer background image section  */

Uniq_Kirki::add_section( 'footer_image', array(
	'title'          => __( 'Footer Image','uniq' ),
	'description'    => __( 'Custom Footer Image options', 'uniq'),
	'panel'          => 'footer_panel', // Not typically needed.
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_image',
	'label'    => __( 'Upload Footer Background Image', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'upload',
	'default'  => '',
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-image',
		),
	),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_size',
	'label'    => __( 'Footer Background Size', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'radio-buttonset',
    'choices' => array(
		'cover'  => esc_attr__( 'Cover', 'uniq' ),
		'contain' => esc_attr__( 'Contain', 'uniq' ),
		'auto'  => esc_attr__( 'Auto', 'uniq' ),
		'inherit'  => esc_attr__( 'Inherit', 'uniq' ),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-size',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'cover',
	'tooltip' => __('Footer Background Image Size','uniq'),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_repeat',
	'label'    => __( 'Footer Background Repeat', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__('No Repeat', 'uniq'),
        'repeat' => esc_attr__('Repeat', 'uniq'),
        'repeat-x' => esc_attr__('Repeat Horizontally','uniq'),
        'repeat-y' => esc_attr__('Repeat Vertically','uniq'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-repeat',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'repeat',  
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_position',
	'label'    => __( 'Footer Background Position', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'center top' => esc_attr__('Center Top', 'uniq'),
        'center center' => esc_attr__('Center Center', 'uniq'),
        'center bottom' => esc_attr__('Center Bottom', 'uniq'),
        'left top' => esc_attr__('Left Top', 'uniq'),
        'left center' => esc_attr__('Left Center', 'uniq'),
        'left bottom' => esc_attr__('Left Bottom', 'uniq'),
        'right top' => esc_attr__('Right Top', 'uniq'),
        'right center' => esc_attr__('Right Center', 'uniq'),
        'right bottom' => esc_attr__('Right Bottom', 'uniq'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-position',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'center center',  
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_bg_attachment',
	'label'    => __( 'Footer Background Attachment', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'scroll' => esc_attr__('Scroll', 'uniq'),
        'fixed' => esc_attr__('Fixed', 'uniq'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-attachment',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'scroll',  
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_overlay',
	'label'    => __( 'Enable Footer( Background ) Overlay', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' )
	),
	'default'  => 'off',
) );
  
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'footer_overlay_color',
	'label'    => __( 'Footer Overlay ( Background )color', 'uniq' ),
	'section'  => 'footer_image',
	'type'     => 'color',
	'alpha' => true,
	'default'  => '#E5493A', 
	'active_callback' => array(
		array(
			'setting'  => 'footer_overlay',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'   => array(
		array(
			'element'  => '.overlay-footer',
			'property' => 'background-color',
		),
	),
) );

//  slider panel //

Uniq_Kirki::add_panel( 'slider_panel', array(   
	'title'       => __( 'Slider Settings', 'uniq' ),  
	'description' => __( 'Flex slider related options', 'uniq' ), 
	'priority'    => 11,    
) );

//  flexslider section  //

Uniq_Kirki::add_section( 'flex_caption_section', array(
	'title'          => __( 'Flexcaption Settings','uniq' ),
	'description'    => __( 'Flexcaption Related Options', 'uniq'),
	'panel'          => 'slider_panel', // Not typically needed.
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'enable_flex_caption_edit',
	'label'    => __( 'Enable Custom Flexcaption Settings', 'uniq' ),
	'section'  => 'flex_caption_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'uniq' ),
		'off' => esc_attr__( 'Disable', 'uniq' ) 
	),
	'default'  => 'off',
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'flexcaption_bg',
	'label'    => __( 'Select Flexcaption Background Color', 'uniq' ),
	'section'  => 'flex_caption_section',
	'type'     => 'color',
	'default'  => 'rgba(0, 0, 0, 0.65)',
	'alpha' => true,
	'output'   => array(
		array(
			'element'  => '.flex-caption',
			'property' => 'background-color',
			'suffix' => '!important',
		),
	),    
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'flexcaption_align',
	'label'    => __( 'Select Flexcaption Alignment', 'uniq' ),
	'section'  => 'flex_caption_section',
	'type'     => 'select',
	'default'  => 'left',
	'choices' => array(
		'left' => esc_attr__( 'Left', 'uniq' ),
		'right' => esc_attr__( 'Right', 'uniq' ),
		'center' => esc_attr__( 'Center', 'uniq' ),
		'justify' => esc_attr__( 'Justify', 'uniq' ),
	),
	'output'   => array(
		array(
			'element'  => '.home .flexslider .slides .flex-caption p,.home .flexslider .slides .flex-caption h1, .home .flexslider .slides .flex-caption h2, .home .flexslider .slides .flex-caption h3, .home .flexslider .slides .flex-caption h4, .home .flexslider .slides .flex-caption h5, .home .flexslider .slides .flex-caption h6,.flexslider .slides .flex-caption,.flexslider .slides .flex-caption h1, .flexslider .slides .flex-caption h2, .flexslider .slides .flex-caption h3, .flexslider .slides .flex-caption h4, .flexslider .slides .flex-caption h5, .flexslider .slides .flex-caption h6,.flexslider .slides .flex-caption p,.flexslider .slides .flex-caption',
			'property' => 'text-align',
			//'suffix' => '!important',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );
 Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'flexcaption_bg_position',
	'label'    => __( 'Select Flexcaption Background Horizontal Position', 'uniq' ),
	'tooltip' => __('Select how far from left, Default value Left = 13 ( in % )','uniq'),
	'section'  => 'flex_caption_section',
	'type'     => 'number',
	'default'  => '13',
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.flexslider .slides .flex-caption,.home .flexslider .slides .flex-caption',
			'property' => 'left',
			'suffix' => '%',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) ); 
 Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'flexcaption_bg_vertical_position',
	'label'    => __( 'Select Flexcaption Background Vertical Position', 'uniq' ),
	'tooltip' => __('Select how far from bottom, Default value Bottom = 20 ( in % )','uniq'),
	'section'  => 'flex_caption_section',
	'type'     => 'number',
	'default'  => '20',
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.flexslider .slides .flex-caption,.home .flexslider .slides .flex-caption',
			'property' => 'bottom',
			'suffix' => '%',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) ); 
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'flexcaption_bg_width',
	'label'    => __( 'Select Flexcaption Background Width', 'uniq' ),
	'section'  => 'flex_caption_section',
	'type'     => 'number',
	'default'  => '50',
	'tooltip' => __('Select Flexcaption Background Width , Default width value 50','uniq'),
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.flexslider .slides .flex-caption,.home .flexslider .slides .flex-caption',
			'property' => 'width',
			'suffix' => '%',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) ); 
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'flexcaption_responsive_bg_width',
	'label'    => __( 'Select Responsive Flexcaption Background Width', 'uniq' ),
	'section'  => 'flex_caption_section',
	'type'     => 'number',
	'default'  => '100',
	'tooltip' => __('Select Responsive Flexcaption Background Width, Default width value 100 ( This value will apply for max-width: 768px )','uniq'),
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.flexslider .slides .flex-caption,.home .flexslider .slides .flex-caption',
			'property' => 'width',
			'media_query' => '@media (max-width: 768px)',
			'value_pattern' => 'calc($%)',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'flexcaption_color',
	'label'    => __( 'Select Flexcaption Font Color', 'uniq' ),
	'section'  => 'flex_caption_section',
	'type'     => 'color',
	'default'  => '#ffffff',
	'alpha' => true,
	'output'   => array(
		array(
			'element'  => '.flexslider .flex-caption a,.flex-caption,.home .flexslider .slides .flex-caption p,.flexslider .slides .flex-caption p,.home .flexslider .slides .flex-caption h1, .home .flexslider .slides .flex-caption h2, .home .flexslider .slides .flex-caption h3, .home .flexslider .slides .flex-caption h4, .home .flexslider .slides .flex-caption h5, .home .flexslider .slides .flex-caption h6,.flexslider .slides .flex-caption h1,.flexslider .slides .flex-caption h2,.flexslider .slides .flex-caption h3,.flexslider .slides .flex-caption h4,.flexslider .slides .flex-caption h5,.flexslider .slides .flex-caption h6',
			'property' => 'color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );

 if( class_exists( 'WooCommerce' ) ) {
	Uniq_Kirki::add_section( 'woocommerce_section', array(
		'title'          => __( 'WooCommerce','uniq' ),
		'description'    => __( 'Theme options related to woocommerce', 'uniq'),
		'priority'       => 11, 

		'theme_supports' => '', // Rarely needed.
	) );
	Uniq_Kirki::add_field( 'woocommerce', array(
		'settings' => 'woocommerce_sidebar',
		'label'    => __( 'Enable Woocommerce Sidebar', 'uniq' ),
		'description' => __('Enable Sidebar for shop page','uniq'),
		'section'  => 'woocommerce_section',
		'type'     => 'switch',
		'choices' => array(
			'on'  => esc_attr__( 'Enable', 'uniq' ),
			'off' => esc_attr__( 'Disable', 'uniq' ) 
		),

		'default'  => 'on',
	) );
}
	
// background color ( rename )

Uniq_Kirki::add_section( 'colors', array(
	'title'          => __( 'Background Color','uniq' ),
	'description'    => __( 'This will affect overall site background color', 'uniq'),
	//'panel'          => 'skin_color_panel', // Not typically needed.
	'priority' => 11,
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'general_background_color',
	'label'    => __( 'General Background Color', 'uniq' ),
	'section'  => 'colors',
	'type'     => 'color',
	'alpha' => true,
	'default'  => '#ffffff',
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-color',
		),
	),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'content_background_color',
	'label'    => __( 'Content Background Color', 'uniq' ),
	'section'  => 'colors',
	'type'     => 'color',
	'description' => __('when you are select boxed layout content background color will reflect the grid area','uniq'), 
	'alpha' => true, 
	'default'  => '#ffffff',
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'general_background_image',
	'label'    => __( 'General Background Image', 'uniq' ),
	'section'  => 'background_image',
	'type'     => 'upload',
	'default'  => '',
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-image',
		),
	),
) );

// background image ( general & boxed layout ) //


Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'general_background_repeat',
	'label'    => __( 'General Background Repeat', 'uniq' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__('No Repeat', 'uniq'),
        'repeat' => esc_attr__('Repeat', 'uniq'),
        'repeat-x' => esc_attr__('Repeat Horizontally','uniq'),
        'repeat-y' => esc_attr__('Repeat Vertically','uniq'),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-repeat',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'general_background_image',
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'repeat',  
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'general_background_size',
	'label'    => __( 'General Background Size', 'uniq' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
    'choices' => array(
		'cover'  => esc_attr__( 'Cover', 'uniq' ),
		'contain' => esc_attr__( 'Contain', 'uniq' ),
		'auto'  => esc_attr__( 'Auto', 'uniq' ),
		'inherit'  => esc_attr__( 'Inherit', 'uniq' ),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-size',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'general_background_image',
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'cover',  
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'general_background_attachment',
	'label'    => __( 'General Background Attachment', 'uniq' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'scroll' => esc_attr__('Scroll', 'uniq'),
        'fixed' => esc_attr__('Fixed', 'uniq'),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-attachment',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'general_background_image',
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'fixed',  
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'general_background_position',
	'label'    => __( 'General Background Position', 'uniq' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'center top' => esc_attr__('Center Top', 'uniq'),
        'center center' => esc_attr__('Center Center', 'uniq'),
        'center bottom' => esc_attr__('Center Bottom', 'uniq'),
        'left top' => esc_attr__('Left Top', 'uniq'),
        'left center' => esc_attr__('Left Center', 'uniq'),
        'left bottom' => esc_attr__('Left Bottom', 'uniq'),
        'right top' => esc_attr__('Right Top', 'uniq'),
        'right center' => esc_attr__('Right Center', 'uniq'),
        'right bottom' => esc_attr__('Right Bottom', 'uniq'),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-position',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'general_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'center top',  
) );


/* CONTENT BACKGROUND ( boxed background image )*/

Uniq_Kirki::add_field( 'uniq', array(  
	'settings' => 'content_background_image',
	'label'    => __( 'Content Background Image', 'uniq' ),
	'description' => __('when you are select boxed layout content background image will reflect the grid area','uniq'),
	'section'  => 'background_image',
	'type'     => 'upload',
	'default'  => '',
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-image',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'content_background_repeat',
	'label'    => __( 'Content Background Repeat', 'uniq' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__('No Repeat', 'uniq'),
        'repeat' => esc_attr__('Repeat', 'uniq'),
        'repeat-x' => esc_attr__('Repeat Horizontally','uniq'),
        'repeat-y' => esc_attr__('Repeat Vertically','uniq'),
	),
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-repeat',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
		array(
			'setting'  => 'content_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'repeat',  
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'content_background_size',
	'label'    => __( 'Content Background Size', 'uniq' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
    'choices' => array(
		'cover'  => esc_attr__( 'Cover', 'uniq' ),
		'contain' => esc_attr__( 'Contain', 'uniq' ),
		'auto'  => esc_attr__( 'Auto', 'uniq' ),
		'inherit'  => esc_attr__( 'Inherit', 'uniq' ),
	),
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-size',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
		array(
			'setting'  => 'content_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'cover',  
) );

Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'content_background_attachment',
	'label'    => __( 'Content Background Attachment', 'uniq' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'scroll' => esc_attr__('Scroll', 'uniq'),
        'fixed' => esc_attr__('Fixed', 'uniq'),
	),
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-attachment',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
		array(
			'setting'  => 'content_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'fixed',  
) );
Uniq_Kirki::add_field( 'uniq', array(
	'settings' => 'content_background_position',
	'label'    => __( 'Content Background Position', 'uniq' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'center top' => esc_attr__('Center Top', 'uniq'),
        'center center' => esc_attr__('Center Center', 'uniq'),
        'center bottom' => esc_attr__('Center Bottom', 'uniq'),
        'left top' => esc_attr__('Left Top', 'uniq'),
        'left center' => esc_attr__('Left Center', 'uniq'),
        'left bottom' => esc_attr__('Left Bottom', 'uniq'),
        'right top' => esc_attr__('Right Top', 'uniq'),
        'right center' => esc_attr__('Right Center', 'uniq'),
        'right bottom' => esc_attr__('Right Bottom', 'uniq'),
	),
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-position',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
		array(
			'setting'  => 'content_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'center top',  
) );

do_action('wbls-uniq_pro_customizer_options');
do_action('uniq_child_customizer_options');
