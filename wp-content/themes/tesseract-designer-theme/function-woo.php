<?php
class Tesseract_Woo{

	public function __construct() {


        add_action( 'init', array($this,'banner_post_type'), 0 );

        add_action( 'init', array($this,'register_custom_post_types'), 0 );

        add_action('after_setup_theme', array($this,'insert_home_page'),0);


        //add_action('after_setup_theme', array($this,'insert_nav_menu'),0);



       	//add_filter('woocommerce_currency_symbol', array($this,'change_existing_currency_symbol_123'), 10, 2);

        add_filter( 'woocommerce_settings_tabs_array',array($this,'add_currency_tab'), 50 );
        add_action( 'woocommerce_settings_tabs_tesseract_currency', array($this,'tesseract_currency_tab_content' ))	;
        add_action( 'woocommerce_update_options_tesseract_currency', array($this,'update_currency_tab_settings' ));
        if(!is_plugin_active('tesseract-footer-content-builder-plugin/tesseract-footer-content-builder-plugin.php')){
        	add_action( 'customize_register' , array( $this , 'register_footer_upper' ) );
        }
        
        add_action( 'customize_register' , array( $this , 'register_cart_button_hover' ) );
        add_action( 'customize_register' , array( $this , 'register_cart_button_text' ) );

        add_filter( 'woocommerce_checkout_fields' , array($this, 'custom_wc_checkout_fields' ));


        if(isset($_GET) && count($_GET) != NULL)
		{
			if(isset($_GET['currency']))
			{
				$selected_currency = $_GET['currency'];
				update_option('tesseract_selected_currency',$selected_currency,true);
			}
			//update_option('woocommerce_currency',$selected_currency,true);
		}
       	//add_filter( 'woocommerce_get_price_html', array($this,'wpa83367_price_html'), 100, 2 );
        //add_filter('woocommerce_get_price', array($this,'return_custom_price'), 10, 2);
        add_action( 'woocommerce_before_calculate_totals', array($this,'add_custom_price_in_cart' ));

       	if(get_posts(array('post_type'=>'banner'))){
	       	add_filter( 'manage_edit-banner_columns' , array($this, 'add_banner_image_column') );
	        add_action( 'manage_banner_posts_custom_column' , array($this, 'display_banners_image'), 10, 2 );
	    }

	    if(get_posts(array('post_type'=>'collection'))){
	        add_filter( 'manage_edit-collection_columns' , array($this, 'add_collection_pr_column') );
	        add_action( 'manage_collection_posts_custom_column' , array($this, 'display_collection_pr'), 10, 2 );
	    }	
        if ( is_admin() ) {
			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_filter( 'admin_init' , array( $this , 'register_fields' ));
		}

    	add_action( 'init', array($this, 'create_product_brands'), 0 );

    	//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    	//remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    	add_action( 'widgets_init', array($this,'tesseract_widgets_init' ));

    	add_action( 'tgmpa_register', array($this,'tessearact_register_required_plugins' ));

    	
    }

    
    public function register_custom_post_types()
    {
		register_post_type('fl-builder-template', apply_filters( 'fl_builder_register_template_post_type_args', array(
			'public'            => false,
			'labels'            => array(
				'name'               => _x( 'Templates', 'Custom post type label.', 'fl-builder' ),
				'singular_name'      => _x( 'Template', 'Custom post type label.', 'fl-builder' ),
				'menu_name'          => _x( 'Templates', 'Custom post type label.', 'fl-builder' ),
				'name_admin_bar'     => _x( 'Template', 'Custom post type label.', 'fl-builder' ),
				'add_new'            => _x( 'Add New', 'Custom post type label.', 'fl-builder' ),
				'add_new_item'       => _x( 'Add New Template', 'Custom post type label.', 'fl-builder' ),
				'new_item'           => _x( 'New Template', 'Custom post type label.', 'fl-builder' ),
				'edit_item'          => _x( 'Edit Template', 'Custom post type label.', 'fl-builder' ),
				'view_item'          => _x( 'View Template', 'Custom post type label.', 'fl-builder' ),
				'all_items'          => _x( 'All Templates', 'Custom post type label.', 'fl-builder' ),
				'search_items'       => _x( 'Search Templates', 'Custom post type label.', 'fl-builder' ),
				'parent_item_colon'  => _x( 'Parent Templates:', 'Custom post type label.', 'fl-builder' ),
				'not_found'          => _x( 'No templates found.', 'Custom post type label.', 'fl-builder' ),
				'not_found_in_trash' => _x( 'No templates found in Trash.', 'Custom post type label.', 'fl-builder' )
			),
			'menu_icon'			=> 'dashicons-welcome-widgets-menus',
			'supports'          => array(
				'title',
				'revisions',
				'page-attributes'
			),
			'taxonomies'		=> array(
				'fl-builder-template-category'
			),
			'publicly_queryable' 	=> true,
			'exclude_from_search'	=> true
		) ) );
		
		// Register the template category tax.
		register_taxonomy( 'fl-builder-template-category', array( 'fl-builder-template' ), apply_filters( 'fl_builder_register_template_category_args', array(
			'labels'            => array(
				'name'              => _x( 'Template Categories', 'Custom taxonomy label.', 'fl-builder' ),
				'singular_name'     => _x( 'Template Category', 'Custom taxonomy label.', 'fl-builder' ),
				'search_items'      => _x( 'Search Template Categories', 'Custom taxonomy label.', 'fl-builder' ),
				'all_items'         => _x( 'All Template Categories', 'Custom taxonomy label.', 'fl-builder' ),
				'parent_item'       => _x( 'Parent Template Category', 'Custom taxonomy label.', 'fl-builder' ),
				'parent_item_colon' => _x( 'Parent Template Category:', 'Custom taxonomy label.', 'fl-builder' ),
				'edit_item'         => _x( 'Edit Template Category', 'Custom taxonomy label.', 'fl-builder' ),
				'update_item'       => _x( 'Update Template Category', 'Custom taxonomy label.', 'fl-builder' ),
				'add_new_item'      => _x( 'Add New Template Category', 'Custom taxonomy label.', 'fl-builder' ),
				'new_item_name'     => _x( 'New Template Category Name', 'Custom taxonomy label.', 'fl-builder' ),
				'menu_name'         => _x( 'Categories', 'Custom taxonomy label.', 'fl-builder' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true
		) ) );
		
		// Register the template type tax.
		register_taxonomy( 'fl-builder-template-type', array( 'fl-builder-template' ), apply_filters( 'fl_builder_register_template_type_args', array(
			'label'             => _x( 'Type', 'Custom taxonomy label.', 'fl-builder' ),
			'hierarchical'      => false,
			'public'            => false,
			'show_admin_column' => true
		) ) );
    }

    public function tessearact_register_required_plugins()
    {
		$plugins = array(
			array(
				'name'   	=> 'WooCommerce',
				'slug'		=> 'woocommerce',
				'required'	=> false, 
			),
			array(
				'name'		=> 'Elementor',
				'slug'		=> 'elementor',
				'required'	=> false,
			),
			array(
				'name'		=> 'W3 Total Cache',
				'slug'		=> 'w3-total-cache',
				'required'	=> false,
			),
			/*array(
				'name'		=> 'YITH WooCommerce Zoom Magnifier',
				'slug'		=> 'yith-woocommerce-zoom-magnifier',
				'required'	=> false,
			)*/
			
		);
		$config = array(
			'id'           => 'tgmpa',                 
			'default_path' => '',                      
			'menu'         => 'tgmpa-install-plugins', 
			'parent_slug'  => 'themes.php',            
			'capability'   => 'edit_theme_options',    
			'has_notices'  => true,                    
			'dismissable'  => true,                    
			'dismiss_msg'  => '',                      
			'is_automatic' => false,                   
			'message'      => '',                      
			
		);
		tgmpa( $plugins, $config );
	}
    

   

    public function insert_nav_menu()
    {
    	add_action('load-nav-menus.php', array($this,'auto_nav_creation_primary'));
    }
    
    public function auto_nav_creation_primary()
    {
		$name = 'Navigation';
		$menu_exists = wp_get_nav_menu_object($name);
		//echo '<pre>'; print_r($menu_exists); echo "</pre>";
		if( !$menu_exists){
			$menu_id = wp_create_nav_menu($name);
		}
			$menu = get_term_by( 'name', $name, 'nav_menu' );
			wp_update_nav_menu_item($menu->term_id, 0, array(
				'menu-item-title' =>  __('Home'),
				'menu-item-classes' => '',
				'menu-item-url' => site_url(),
				'menu-item-type' => 'custom',
				'menu-item-status' => 'publish'));
			wp_update_nav_menu_item($menu->term_id, 0, array(
		        'menu-item-title' =>  __('Test Page 1'),
		        'menu-item-url' => '#', 
		        'menu-item-status' => 'publish'));
			wp_update_nav_menu_item($menu->term_id, 0, array(
		        'menu-item-title' =>  __('Test Page 2'),
		        'menu-item-url' => '#', 
		        'menu-item-status' => 'publish'));
			wp_update_nav_menu_item($menu->term_id, 0, array(
		        'menu-item-title' =>  __('Test Page 3'),
		        'menu-item-url' => '#', 
		        'menu-item-status' => 'publish'));
		
		//then you set the wanted theme  location
		$locations = get_theme_mod('nav_menu_locations');
		//echo "<pre>"; print_r($menu); echo "</pre>";
		$locations['primary'] = $menu->term_id;
		$locations['secondary'] = $menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
    

    public function load_custom_css_code()
    {
    	$tesseract_woocommerce_button_text_color = (get_theme_mod('tesseract_woocommerce_button_text_color')) ? get_theme_mod('tesseract_woocommerce_button_text_color') : '#ffffff';

    	$tesseract_woocommerce_button_hover_color = (get_theme_mod('tesseract_woocommerce_button_hover_color')) ? get_theme_mod('tesseract_woocommerce_button_hover_color') : '#1581B2';

    	$tesseract_woocommerce_button_backgroud = (get_theme_mod('tesseract_woocommerce_button_backgroud')) ? get_theme_mod('tesseract_woocommerce_button_backgroud') : '#49B9E6';

    	?>
    		<style>
    			.tesseract-woo-button{
    				background-color: <?php echo $tesseract_woocommerce_button_backgroud; ?>!important;
    				color: <?php echo $tesseract_woocommerce_button_text_color; ?>!important;
    			}
    			#place_order:hover{
    				background-color: <?php echo $tesseract_woocommerce_button_hover_color; ?>!important;
    			}
    		</style>
    	<?php
    }

    public function custom_wc_checkout_fields( $fields )
    {
    	//$fields['billing']['billing_first_name']['label'] = '';
    	$fields['billing']['billing_first_name']['placeholder'] = 'First name';

    	//$fields['billing']['billing_last_name']['label'] = '';
    	$fields['billing']['billing_last_name']['placeholder'] = 'Last name';

    	//$fields['billing']['billing_company']['label'] = '';
    	$fields['billing']['billing_company']['placeholder'] = 'Company name';

    	//$fields['billing']['billing_email']['label'] = '';
    	$fields['billing']['billing_email']['placeholder'] = 'Email';

    	//$fields['billing']['billing_phone']['label'] = '';
    	$fields['billing']['billing_phone']['placeholder'] = 'Phone';

    	//$fields['billing']['billing_country']['label'] = '';
    	$fields['billing']['billing_country']['placeholder'] = 'Country';

    	//$fields['billing']['billing_address_1']['label'] = '';
    	$fields['billing']['billing_address_1']['placeholder'] = 'Address 1';

    	//$fields['billing']['billing_address_1']['label'] = '';
    	$fields['billing']['billing_address_1']['placeholder'] = 'Address 2: Apartment, suite, unit etc';

    	//$fields['billing']['billing_city']['label'] = '';
    	$fields['billing']['billing_city']['placeholder'] = 'Town / City';

    	//$fields['billing']['billing_state']['label'] = '';
    	$fields['billing']['billing_state']['placeholder'] = 'State';

    	//$fields['billing']['billing_postcode']['label'] = '';
    	$fields['billing']['billing_postcode']['placeholder'] = 'Postal code/Zip';

    	/* Shipping */

    	//$fields['shipping']['shipping_first_name']['label'] = '';
    	$fields['shipping']['shipping_first_name']['placeholder'] = 'First name';

    	//$fields['shipping']['shipping_last_name']['label'] = '';
    	$fields['shipping']['shipping_last_name']['placeholder'] = 'Last name';

    	//$fields['shipping']['shipping_company']['label'] = '';
    	$fields['shipping']['shipping_company']['placeholder'] = 'Company name';

    	//$fields['shipping']['shipping_email']['label'] = '';
    	$fields['shipping']['shipping_email']['placeholder'] = 'Email';

    	//$fields['shipping']['shipping_phone']['label'] = '';
    	$fields['shipping']['shipping_phone']['placeholder'] = 'Phone';

    	//$fields['shipping']['shipping_country']['label'] = '';
    	$fields['shipping']['shipping_country']['placeholder'] = 'Country';

    	//$fields['shipping']['shipping_address_1']['label'] = '';
    	$fields['shipping']['shipping_address_1']['placeholder'] = 'Address 1';

    	//$fields['shipping']['shipping_address_1']['label'] = '';
    	$fields['shipping']['shipping_address_1']['placeholder'] = 'Address 2: Apartment, suite, unit etc';

    	//$fields['shipping']['shipping_city']['label'] = '';
    	$fields['shipping']['shipping_city']['placeholder'] = 'Town / City';

    	//$fields['shipping']['shipping_state']['label'] = '';
    	$fields['shipping']['shipping_state']['placeholder'] = 'State';

    	//$fields['shipping']['shipping_postcode']['label'] = '';
    	$fields['shipping']['shipping_postcode']['placeholder'] = 'Postal code/Zip';


    	

		return $fields;	
    }

    public function tesseract_widgets_init()
    {
    	register_sidebar( array(
        'name' => __( 'Right Sidebar(Tesseract)', 'tesseract' ),
        'id' => 'sidebar-right-tesseract',
        'description' => __( 'Appears on the right.', 'tesseract' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    	) );
    	register_widget( 'tesseract_sm_widget' );
    	register_widget( 'tesseract_fc_widget' );
    }

  


    public function register_cart_button_hover( $wp_customize )
    {
    	$wp_customize->add_setting( 'tesseract_woocommerce_cart_button_hover', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#000000'
		) );

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'tesseract_woocommerce_cart_button_hover_control',
			array(
				'label'      => __( 'Button Hover Color', 'tesseract' ),
				'section'    => 'tesseract_woocommerce',
				'settings'   => 'tesseract_woocommerce_cart_button_hover',
				'priority'   => 13
			) )

		);
    }
    public function register_cart_button_text( $wp_customize )
    {
    	$wp_customize->add_setting( 'tesseract_woocommerce_cart_button_text', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#000000'
		) );

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'tesseract_woocommerce_cart_button_text_control',
			array(
				'label'      => __( 'Button Text Color', 'tesseract' ),
				'section'    => 'tesseract_woocommerce',
				'settings'   => 'tesseract_woocommerce_cart_button_text',
				'priority'   => 14
			) )

		);
    }
    public function create_product_brands()
    {
        $labels = array(
            'name'              => _x( 'Brands', 'tesseract' ),
            'singular_name'     => _x( 'Brand', 'tesseract' ),
            'search_items'      => _x( 'Search Brands', 'tesseract' ),
            'all_items'         => _x( 'All Brands', 'tesseract' ),
            'parent_item'       => _x( 'Parent Brand', 'tesseract' ),
            'parent_item_colon' => _x( 'Parent Brand:', 'tesseract' ),
            'edit_item'         => _x( 'Edit Brand', 'tesseract' ), 
            'update_item'       => _x( 'Update Brand', 'tesseract' ),
            'add_new_item'      => _x( 'Add New Brand', 'tesseract' ),
            'new_item_name'     => _x( 'New Product Category', 'tesseract' ),
            'menu_name'         => _x( 'Brands', 'tesseract' ),
        );
        
        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
            'query_var' => true,
            'rewrite' => true,
            'show_admin_column' => true
        );
        
        register_taxonomy( 'pr_brand', 'product', $args );
    }
    public function register_footer_upper( $wp_customize )
    {
    	$wp_customize->add_section( 
			'footer_upper_section', 
			array(
				'title'       => __( 'Footer Upper Section', 'tesseract' ),
				'panel'		=> 'tesseract_footer_options',
				'priority'    => 3,
				'capability'  => 'edit_theme_options',
				'description' => __('Change footer upper content from here. Section 1 is left most and accordingly, Section 4 is right most.', 'tesseract'),
				'active_callback' 	=> 'tesseract_header_upper_layout_choice_1'

			) 
		);
		$default_1 = '<section class="widget widget-page-content 01">
						<div class="widget-inner">
						  <header class="widget-header">
						    <h2>Providence</h2>
						  </header>
						    <div class="page-content">
								  <p><span>Providence is a feature-rich, completely responsive Shopify theme that looks beautiful on all screens, from phones to desktops.</span></p>
								<p><span>Let your customers enjoy its clean, user-friendly design as-is or tailor it to your liking through the extensive array of theme options.</span></p>
								<p>Built by <a href="http://tesseractplus.com/" target="_blank" title="Tesseract">, Tesseract.</a></p>
							</div>
						</div>
					</section>';
		$footer_upper_menu = get_terms( 'nav_menu' );
		if ( empty( $footer_upper_menu ) ) {
			$footer_upper_menu_items = array( 'none' => "You haven't made any menus!" );
		} else {
			$footer_upper_menu_items = array();
			$item_keys = array( 'none' ); $item_values = array( 'None' );
			foreach ( $footer_upper_menu as $items ) {
				array_push( $item_keys, $items->slug);
				array_push( $item_values, $items->name);
			}
			$footer_upper_menu_items = array_combine( $item_keys, $item_values );
		}
		$wp_customize->add_setting( 'footer_upper_section_choice',
			array(
				'default' => 'disable',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_choice',
				array(
					'label'          => __( 'Status', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_choice',
					'type'           => 'select',
					'choices' 		 => array('enable'=>'Enable','disable'=>'Disable'), 	
					'priority' 		 => 1

				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_1',
			array(
				'default' => 'html',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_1',
				array(
					'label'          => __( 'Section 1', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_1',
					'type'           => 'select',
					'choices' 		 => array('none'=>'None','html'=>'HTML','recent_post'=>'Recent Post',/*'newsletter'=>'Newsletter',*/'socialmenu'=>'Social Icon','menu'=>'Menu'), 	
					'priority' 		 => 3,
					'active_callback' 	=> 'footer_upper_section_status_choice'						
				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_1_html', array(
			'sanitize_callback' => 'tesseract_sanitize_textarea_html',
			'default' 			=> $default_1
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_1_html',
				array(
					'label'          => __( 'HTML(Section: 1)', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_1_html',
					'type'           => 'textarea',
					'priority' 		 => 4,
					'active_callback' => 'footer_upper_section_1_type'
				)
			)
		);

		$wp_customize->add_setting( 'footer_upper_section_1_menu', array(
			'sanitize_callback' => 'tesseract_sanitize_select',
			'default' 			=> 'none'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_1_menu',
				array(
					'label'          => __( 'Menu(Section: 1)', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_1_menu',
					'type'           => 'select',
					'choices'        => $footer_upper_menu_items,
					'priority' 		 => 5,
					'active_callback' 	=> 'footer_upper_section_1_type_menu'
				)
			)
		);
		
		$wp_customize->add_setting( 'footer_upper_section_2',
			array(
				'default' => 'recent_post',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_2',
				array(
					'label'          => __( 'Section 2', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_2',
					'type'           => 'select',
					'choices' 		 => array('none'=>'None','html'=>'HTML','recent_post'=>'Recent Post',/*'newsletter'=>'Newsletter',*/'socialmenu'=>'Social Icon','menu'=>'Menu'), 	
					'priority' 		 => 6,
					'active_callback' 	=> 'footer_upper_section_status_choice'						
				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_2_html', array(
			'sanitize_callback' => 'tesseract_sanitize_textarea_html',
			'default' 			=> $default_1
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_2_html',
				array(
					'label'          => __( 'HTML(Section: 2)', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_2_html',
					'type'           => 'textarea',
					'priority' 		 => 7,
					'active_callback' => 'footer_upper_section_2_type'
				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_2_menu', array(
			'sanitize_callback' => 'tesseract_sanitize_select',
			'default' 			=> 'none'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_2_menu',
				array(
					'label'          => __( 'Menu(Section: 2)', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_2_menu',
					'type'           => 'select',
					'choices'        => $footer_upper_menu_items,
					'priority' 		 => 8,
					'active_callback' 	=> 'footer_upper_section_2_type_menu'
				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_3',
			array(
				'default' => 'socialmenu',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_3',
				array(
					'label'          => __( 'Section 3', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_3',
					'type'           => 'select',
					'choices' 		 => array('none'=>'None','html'=>'HTML','recent_post'=>'Recent Post',/*'newsletter'=>'Newsletter',*/'socialmenu'=>'Social Icon','menu'=>'Menu'), 	
					'priority' 		 => 9,
					'active_callback' 	=> 'footer_upper_section_status_choice'						
				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_3_html', array(
			'sanitize_callback' => 'tesseract_sanitize_textarea_html',
			'default' 			=> $default_1
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_3_html',
				array(
					'label'          => __( 'HTML(Section: 3)', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_3_html',
					'type'           => 'textarea',
					'priority' 		 => 10,
					'active_callback' => 'footer_upper_section_3_type'
				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_3_menu', array(
			'sanitize_callback' => 'tesseract_sanitize_select',
			'default' 			=> 'none'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_1_menu',
				array(
					'label'          => __( 'Menu(Section: 3)', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_3_menu',
					'type'           => 'select',
					'choices'        => $footer_upper_menu_items,
					'priority' 		 => 11,
					'active_callback' 	=> 'footer_upper_section_3_type_menu'
				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_4',
			array(
				'default' => 'menu',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_4',
				array(
					'label'          => __( 'Section 4', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_4',
					'type'           => 'select',
					'choices' 		 => array('none'=>'None','html'=>'HTML','recent_post'=>'Recent Post',/*'newsletter'=>'Newsletter',*/'socialmenu'=>'Social Icon','menu'=>'Menu'), 	
					'priority' 		 => 12,
					'active_callback' 	=> 'footer_upper_section_status_choice'						
				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_4_html', array(
			'sanitize_callback' => 'tesseract_sanitize_textarea_html',
			'default' 			=> $default_1
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_4_html',
				array(
					'label'          => __( 'HTML(Section: 4)', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_4_html',
					'type'           => 'textarea',
					'priority' 		 => 13,
					'active_callback' => 'footer_upper_section_4_type'
				)
			)
		);
		$wp_customize->add_setting( 'footer_upper_section_4_menu', array(
			'sanitize_callback' => 'tesseract_sanitize_select',
			'default' 			=> 'none'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_upper_section_4_menu',
				array(
					'label'          => __( 'Menu(Section: 4)', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'footer_upper_section_4_menu',
					'type'           => 'select',
					'choices'        => $footer_upper_menu_items,
					'priority' 		 => 14,
					'active_callback' 	=> 'footer_upper_section_4_type_menu'
				)
			)
		);
    }
    public function register_fields($value='')
    {
    	register_setting( 'general', 'fotter_page_info', 'esc_attr' );
        add_settings_field('fav_color', '<label for="fotter_page_info">'.__('Footer Page' , 'favorite_color' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    public function fields_html() {
        $value = get_option( 'fotter_page_info', '' );
       ?>
       	<select name="fotter_page_info">
       		<?php
       			$posts_array = get_posts(array('post_type'=>'page','post_per_pages'=>-1,'post_status'=>'publish'));
       			foreach($posts_array as $pages){
       				echo "<option value=".$pages->ID.">".$pages->post_title."</option>";
       			}
       		 ?>
       		
       	</select>
       <?php
    }
    public function add_custom_price_in_cart($cart_object)
    {
		foreach ( $cart_object->cart_contents as $key => $value ) {
			$from = "USD";
			if(get_option('tesseract_selected_currency',true))
		    {
		    	$to = get_option('tesseract_selected_currency',true);
		    }
		    else
		    {
		    	$to = get_option('woocommerce_currency',true);
		    }
		   
		    $amount = $value['data']->price;
		    if($from != $to)
		    {
			    // $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
			    // $data = file_get_contents($url);
			    // preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
			    // $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
			    // //echo " Converted ".$converted;
			    // $value['data']->price =  round($converted, 3);
			    $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
			    $handle = fopen($url, 'r');
			 
			    if ($handle) {
			        $result = fgets($handle, 4096);
			        fclose($handle);
			    }
			 
			    $allData = explode(',',$result); 
			    $currencyValue = $allData[1];
			 	$value['data']->price = $amount*$currencyValue;
			    $responseTxt = 'Value of 1 '.$from.' in '.$to. ' is ' .$currencyValue;
			}
			//echo " -- ".$value['data']->price;
		   //$value['data']->price = 2058;
		}
    }
    public function change_existing_currency_symbol_123( $currency_symbol, $currency ) 
    {
	    if(get_option('tesseract_selected_currency',true))
	    {
	    	return get_option('tesseract_selected_currency',true);
	    }
	    else
	    {
	    	return get_option('woocommerce_currency',true);
	    }
	    
	}
	public function return_custom_price($price, $product)
	{
	    global $post, $blog_id;
	    $price = get_post_meta($post->ID, '_regular_price');

	    $from = "USD";
	    $to = get_option('selected_currency',true);
	    $amount = $price[0];
	    if($from != $to)
	    {
		    
		    $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
		    $data = file_get_contents($url);
		    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
		    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
		    return number_format(round($converted, 3),2);
		}
		else
		{
			return number_format($price[0],2);
		}
		
	    // $post_id = $post->ID;
	    // $price = ($price[0]*2);
	    // return $price;
	}
		
    public function insert_home_page()
    {
    	global $wpdb;

	 	if (!get_page_by_title('Home-by Tesseract', 'OBJECT', 'page'))
	 	{
	    	$homepage = array(
	            'post_type'    => 'page',
	            'post_title'    => 'Home-by Tesseract',
	            'post_content'  => '',
	            'post_status'   => 'publish',
	            'post_author'   => 1
	        ); 
	        // Insert the post into the database
	        $homepage_id =  wp_insert_post( $homepage );
	        //set the page template 
	        //assuming you have defined template on your-template-filename.php
	        update_post_meta($homepage_id, '_wp_page_template', 'tesseract-woo-home.php');
	        // set this page as homepage
	        if(!get_option('page_on_front'))
	        {
	        	update_option('show_on_front', 'page');
	        	update_option('page_on_front', $homepage_id);
	        }
	       
	    }
	    if(!get_post_meta(get_option( 'woocommerce_shop_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_shop_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_cart_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_cart_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_checkout_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_checkout_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_myaccount_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_myaccount_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_thanks_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_thanks_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_edit_address_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_edit_address_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_pay_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_pay_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_view_order_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_view_order_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_terms_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_terms_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    
	    

		/*update_post_meta(get_option( 'woocommerce_cart_page_id' ), '_wp_page_template', 'full-width-page.php'); 
		update_post_meta(get_option( 'woocommerce_checkout_page_id' ), '_wp_page_template', 'full-width-page.php');
		update_post_meta(get_option( 'woocommerce_pay_page_id' ), '_wp_page_template', 'full-width-page.php'); 
		update_post_meta(get_option( 'woocommerce_thanks_page_id' ), '_wp_page_template', 'full-width-page.php'); 
		update_post_meta(get_option( 'woocommerce_myaccount_page_id' ), '_wp_page_template', 'full-width-page.php'); 
		update_post_meta(get_option( 'woocommerce_edit_address_page_id' ), '_wp_page_template', 'full-width-page.php'); 
		update_post_meta(get_option( 'woocommerce_view_order_page_id' ), '_wp_page_template', 'full-width-page.php'); 
		update_post_meta(get_option( 'woocommerce_terms_page_id' ), '_wp_page_template', 'full-width-page.php');*/
    }

	public function banner_post_type()
	{
		$labels = array(
			'name'                => _x( 'Theme Banners', 'banner', 'tesseract' ),
			'singular_name'       => _x( 'Banner', 'banners', 'tesseract' ),
			'menu_name'           => __( 'Theme Banners', 'tesseract' ),
			'all_items'           => __( 'All Banners', 'tesseract' ),
			'view_item'           => __( 'View Banner', 'tesseract' ),
			'add_new_item'        => __( 'Add New Banner', 'tesseract' ),
			'add_new'             => __( 'Add New', 'tesseract' ),
			'edit_item'           => __( 'Edit Banner', 'tesseract' ),
			'update_item'         => __( 'Update Banner', 'tesseract' ),
			'search_items'        => __( 'Search Banner', 'tesseract' ),
			'not_found'           => __( 'No banner Found', 'tesseract' ),
			'not_found_in_trash'  => __( 'No banner found in Trash', 'tesseract' ),
		);
		
		$args = array(
			'label'               => __( 'banners', 'tesseract' ),
			'description'         => __( 'Banners for slide-show on home page', 'tesseract' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			 'menu_icon'          => 'dashicons-images-alt',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		
		register_post_type( 'banner', $args );

		$labels_2 = array(
			'name'                => _x( 'Collections', 'collection', 'tesseract' ),
			'singular_name'       => _x( 'Collection', 'collections', 'tesseract' ),
			'menu_name'           => __( 'Collections', 'tesseract' ),
			'all_items'           => __( 'All Collections', 'tesseract' ),
			'view_item'           => __( 'View Collection', 'tesseract' ),
			'add_new_item'        => __( 'Add New Collection', 'tesseract' ),
			'add_new'             => __( 'Add New', 'tesseract' ),
			'edit_item'           => __( 'Edit Collection', 'tesseract' ),
			'update_item'         => __( 'Update Collection', 'tesseract' ),
			'search_items'        => __( 'Search Collection', 'tesseract' ),
			'not_found'           => __( 'No collection Found', 'tesseract' ),
			'not_found_in_trash'  => __( 'No collection found in Trash', 'tesseract' ),
		);
		
		$args_2 = array(
			'label'               => __( 'collections', 'tesseract' ),
			'description'         => __( 'Collection of product', 'tesseract' ),
			'labels'              => $labels_2,
			'supports'            => array( 'title', 'thumbnail','editor'),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 55,
			 'menu_icon'          => 'dashicons-products',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		
		register_post_type( 'collection', $args_2 );
	}

	public function admin_init()
	{
		global $pagenow;
		if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' || $pagenow == 'edit.php' ) {
			add_action( 'add_meta_boxes', array( &$this, 'meta_boxes' ) );
			add_action( 'save_post', array( &$this, 'meta_boxes_save' ), 1, 2 );
		}

		/*if ( !is_plugin_active('zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs/woocommerce-zoom-extension.php'))
		{
			add_action( 'admin_notices', array($this,'zoom_plugins_notice') );
		}
		if ( !is_plugin_active('newsletter-subscription-form/newsletter-subscription-form.php'))
		{
			add_action( 'admin_notices', array($this,'newsletter_plugins_notice') );
		}*/
		
	}
	public function zoom_plugins_notice()
	{
		?>
			<div class="notice error my-acf-notice is-dismissible" >
			    <p><?php _e( 'Please install <b>ZWoom - WooCommerce Product Image Zoom</b> plugins for Poduct zoom. <a href="https://downloads.wordpress.org/plugin/zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs.zip">Download Here</a>', 'tesseract' ); ?></p>
			</div>
		<?php
	}
	public function newsletter_plugins_notice()
	{
		?>
			<div class="notice error my-acf-notice is-dismissible" >
			    <p><?php _e( 'Please install <b>Newsletter Subscription Form plugins for Newsletter subscription.</b> <a href="https://downloads.wordpress.org/plugin/newsletter-subscription-form.1.0.8.zip">Download Here</a>', 'tesseract' ); ?></p>
			</div>
		<?php
	}

	public function meta_boxes_save( $post_id, $post )
	{
		if ( empty( $post_id ) || empty( $post ) || empty( $_POST ) ) return;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( is_int( wp_is_post_revision( $post ) ) ) return;
		if ( is_int( wp_is_post_autosave( $post ) ) ) return;
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
		//if ( $post->post_type != 'banner' ||  $post->post_type != 'collection') return;
		if($post->post_type == 'banner'){ $this->process_banner_meta( $post_id, $post ); }
		if($post->post_type == 'collection'){ $this->process_collection_meta( $post_id, $post ); }
	}

	private function process_banner_meta( $post_id, $post )
	{
		update_post_meta( $post_id, '_banner_image_id', $_POST['upload_image_id'] );
	}

	private function process_collection_meta( $post_id, $post ) {
		$id_value = ($_POST['pr_ids']) ? implode("|",$_POST['pr_ids']) : 0;
		update_post_meta( $post_id, 'pr_ids', $id_value );
	}

	public function meta_boxes() {
		add_meta_box( 'banner-image', _x( 'Banner Image (Recommended size: 1164px X 400px)', 'tesseract' ), array( &$this, 'banner_image_meta_box' ), 'banner', 'normal', 'high' );

		add_meta_box( 'product-sync', _x( 'Products', 'tesseract' ), array( &$this, 'banner_pr_meta_box' ), 'collection', 'normal', 'high' );
	}
	public function banner_image_meta_box()
	{
		global $post;
		
		$image_src = '';
		
		$image_id = get_post_meta( $post->ID, '_banner_image_id', true );
		$image_src = wp_get_attachment_url( $image_id );
		
		?>
		
		
		
		<p>
			<label for="upload_image">
			    <span id="upload_image"><img id="book_image" src="<?php echo $image_src ?>" style="max-width:100%;" /></span>
			    <br/>
			    <input type="hidden" name="upload_image_id" id="upload_image_id" value="<?php echo $image_id; ?>" />
			    <input id="upload_image_button" class="button" type="button" value="Upload Image" />
			    
			</label>
		</p>
		<script type="text/javascript">
		    jQuery(document).ready(function($){
			    var custom_uploader;
			    $('#upload_image_button').click(function(e) {
			        e.preventDefault();
			        //If the uploader object has already been created, reopen the dialog
			        if (custom_uploader) {
			            custom_uploader.open();
			            return;
			        }
			        //Extend the wp.media object
			        custom_uploader = wp.media.frames.file_frame = wp.media({
			            title: 'Choose Banner Image(Recommended size: 1164px X 400px)',
			            button: {
			                text: 'Set Image'
			            },
			            multiple: false
			        });
			        //When a file is selected, grab the URL and set it as the text field's value
			        custom_uploader.on('select', function() {
			            attachment = custom_uploader.state().get('selection').first().toJSON();
			            $('#upload_image_id').val(attachment.id);
			            $('#upload_image').html('<img src="'+attachment.url+'" style="max-width:100%;"/>');
			        });
			        //Open the uploader dialog
			        custom_uploader.open();
		    	});
			});
		</script>
		<?php
	}

	public function display_banners_image( $column, $post_id )
	{
		global $post;
		if ( $post->post_type != 'banner' ) return;
	    if ($column == 'b_image'){
	    	$image_id = get_post_meta( $post->ID, '_banner_image_id', true );
			$image_src = wp_get_attachment_url( $image_id );
			if($image_src){
	       ?>
	       	<img id="book_image" src="<?php echo $image_src ?>" style="max-width:50%;" />
	       <?php
	   		}
	   		else
	   		{
	   			echo "Banner picture is not found";
	   		}
	    }
	}

	public function add_banner_image_column( $columns ) 
	{
		global $post;
			if ( $post->post_type != 'banner' ) return;
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'title' => _e( 'Title', 'tesseract' ),
				'b_image' => _e( 'Image', 'tesseract' ),
				'date' => _e( 'Date', 'tesseract' )
			);
			return $columns;
	}

	public function banner_pr_meta_box()
	{
		global $post;
		$c_id = $post->ID;
		$loop = new WP_Query( array( 'post_type' => array('product'), 'posts_per_page' => -1 ) );
		if ( $loop->have_posts() )
		{
			?>
				<script src="<?php echo get_template_directory_uri(); ?>/js/build.min.js"></script>
	        	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fastselect.min.css">
	        	<script src="<?php echo get_template_directory_uri(); ?>/js/fastselect.standalone.js"></script>
		        <style>
		            .fstElement { font-size: 1.2em; }
		            .fstToggleBtn { min-width: 16.5em; }
		            .fstMultipleMode { display: block; }
		            .fstMultipleMode .fstControls { width: 100%; }
		        </style>

		        <?php
		        	$p_value = explode("|",get_post_meta($c_id,'pr_ids',true));
		        ?>
	         	<select class="multipleSelect" multiple name="pr_ids[]">
	         		<?php
						while ( $loop->have_posts() ) : $loop->the_post();
					?>
							<option value="<?php echo get_the_ID(); ?>" <?php if(in_array(get_the_ID(),$p_value)){ echo 'selected';} ?>><?php echo get_the_title(); ?></option>
					<?php 
						endwhile;
					?>
	         	</select>
	            <script>
	                $('.multipleSelect').fastselect();
	            </script>
			<?php
		}
		else
		{
			echo "Please add products, to make collection.";
		}
	}

	public function add_collection_pr_column( $columns ) 
	{
		global $post;
		$post_types = get_post_types('','names');
		//echo "<pre>"; print_r($post_types); echo "</pre>";
		if ( $post->post_type != 'collection' ) return;
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => _e( 'Title','tesseract' ),
			'pr_s' => _e( 'Products', 'tesseract' ),
			'date' => _e( 'Date','tesseract' )
		);
		return $columns;
	}

	public function display_collection_pr( $column, $post_id )
	{
		global $post,$woocommerce;
		if ( $post->post_type != 'collection' ) return;
	    if ($column == 'pr_s')
	    {
	    	$pr_ids = (get_post_meta( $post->ID, 'pr_ids', true )) ? explode("|",get_post_meta( $post->ID, 'pr_ids', true )) : 0;
	    	if(is_array($pr_ids))
	    	{
	    		for($i=0;$i<=count($pr_ids)-1;$i++)
	    		{
	    			if($i != 0 )
	    			{
	    				echo " | ";
	    			}
	    			echo '<a href="'.get_post_permalink($pr_ids[$i]).'">'.get_the_title( $pr_ids[$i] )."</a>";
	    		}
	    	}
	    	else
	    	{
	    		echo "No product found";
	    	}
	    }
	}

	public function add_currency_tab($settings_tabs)
	{
		$settings_tabs['tesseract_currency'] = __( 'Currency', 'woocommerce-settings-tab-demo' );
        return $settings_tabs;
	}

	public function tesseract_currency_tab_content()
	{
		woocommerce_admin_fields( $this->get_currency_tab_content() );
	}

	public function get_currency_tab_content() 
	{
	    ?>
	    <?php
	    $settings = array(
	        'section_title' => array(
	            'name'     => __( 'Currency Switcher Options', 'tesseract' ),
	            'type'     => 'title',
	            'desc'     => 'Used for switch currency from front-end throughout the site.',
	            'id'       => 'wc_tesseract_currency_section_title'
	        ),
	        'title' => array(
	            'name' => __( 'Choose Currency', 'tesseract' ),
	            'type' => 'multiselect',
	            'options' => array('AED' => 'United Arab Emirates Dirham (AED)',
							    'AFN' => 'Afghan Afghani (AFN)',
							    'ALL' => 'Albanian Lek (ALL)',
							    'AMD' => 'Armenian Dram (AMD)',
							    'ANG' => 'Netherlands Antillean Guilder (ANG)',
							    'AOA' => 'Angolan Kwanza (AOA)',
							    'ARS' => 'Argentine Peso (ARS)',
							    'AUD' => 'Australian Dollar (A$)',
							    'AWG' => 'Aruban Florin (AWG)',
							    'AZN' => 'Azerbaijani Manat (AZN)',
							    'BAM' => 'Bosnia-Herzegovina Convertible Mark (BAM)',
							    'BBD' => 'Barbadian Dollar (BBD)',
							    'BDT' => 'Bangladeshi Taka (BDT)',
							    'BGN' => 'Bulgarian Lev (BGN)',
							    'BHD' => 'Bahraini Dinar (BHD)',
							    'BIF' => 'Burundian Franc (BIF)',
							    'BMD' => 'Bermudan Dollar (BMD)',
							    'BND' => 'Brunei Dollar (BND)',
							    'BOB' => 'Bolivian Boliviano (BOB)',
							    'BRL' => 'Brazilian Real (R$)',
							    'BSD' => 'Bahamian Dollar (BSD)',
							    'BTN' => 'Bhutanese Ngultrum (BTN)',
							    'BWP' => 'Botswanan Pula (BWP)',
							    'BYR' => 'Belarusian Ruble (BYR)',
							    'BZD' => 'Belize Dollar (BZD)',
							    'CAD' => 'Canadian Dollar (CA$)',
							    'CDF' => 'Congolese Franc (CDF)',
							    'CHF' => 'Swiss Franc (CHF)',
							    'CLF' => 'Chilean Unit of Account (UF) (CLF)',
							    'CLP' => 'Chilean Peso (CLP)',
							    'CNH' => 'CNH (CNH)',
							    'CNY' => 'Chinese Yuan (CN¥)',
							    'COP' => 'Colombian Peso (COP)',
							    'CRC' => 'Costa Rican Colón (CRC)',
							    'CUP' => 'Cuban Peso (CUP)',
							    'CVE' => 'Cape Verdean Escudo (CVE)',
							    'CZK' => 'Czech Republic Koruna (CZK)',
							    'DEM' => 'German Mark (DEM)',
							    'DJF' => 'Djiboutian Franc (DJF)',
							    'DKK' => 'Danish Krone (DKK)',
							    'DOP' => 'Dominican Peso (DOP)',
							    'DZD' => 'Algerian Dinar (DZD)',
							    'EGP' => 'Egyptian Pound (EGP)',
							    'ERN' => 'Eritrean Nakfa (ERN)',
							    'ETB' => 'Ethiopian Birr (ETB)',
							    'EUR' => 'Euro (€)',
							    'FIM' => 'Finnish Markka (FIM)',
							    'FJD' => 'Fijian Dollar (FJD)',
							    'FKP' => 'Falkland Islands Pound (FKP)',
							    'FRF' => 'French Franc (FRF)',
							    'GBP' => 'British Pound Sterling (£)',
							    'GEL' => 'Georgian Lari (GEL)',
							    'GHS' => 'Ghanaian Cedi (GHS)',
							    'GIP' => 'Gibraltar Pound (GIP)',
							    'GMD' => 'Gambian Dalasi (GMD)',
							    'GNF' => 'Guinean Franc (GNF)',
							    'GTQ' => 'Guatemalan Quetzal (GTQ)',
							    'GYD' => 'Guyanaese Dollar (GYD)',
							    'HKD' => 'Hong Kong Dollar (HK$)',
							    'HNL' => 'Honduran Lempira (HNL)',
							    'HRK' => 'Croatian Kuna (HRK)',
							    'HTG' => 'Haitian Gourde (HTG)',
							    'HUF' => 'Hungarian Forint (HUF)',
							    'IDR' => 'Indonesian Rupiah (IDR)',
							    'IEP' => 'Irish Pound (IEP)',
							    'ILS' => 'Israeli New Sheqel (₪)',
							    'INR' => 'Indian Rupee (Rs.)',
							    'IQD' => 'Iraqi Dinar (IQD)',
							    'IRR' => 'Iranian Rial (IRR)',
							    'ISK' => 'Icelandic Króna (ISK)',
							    'ITL' => 'Italian Lira (ITL)',
							    'JMD' => 'Jamaican Dollar (JMD)',
							    'JOD' => 'Jordanian Dinar (JOD)',
							    'JPY' => 'Japanese Yen (¥)',
							    'KES' => 'Kenyan Shilling (KES)',
							    'KGS' => 'Kyrgystani Som (KGS)',
							    'KHR' => 'Cambodian Riel (KHR)',
							    'KMF' => 'Comorian Franc (KMF)',
							    'KPW' => 'North Korean Won (KPW)',
							    'KRW' => 'South Korean Won (₩)',
							    'KWD' => 'Kuwaiti Dinar (KWD)',
							    'KYD' => 'Cayman Islands Dollar (KYD)',
							    'KZT' => 'Kazakhstani Tenge (KZT)',
							    'LAK' => 'Laotian Kip (LAK)',
							    'LBP' => 'Lebanese Pound (LBP)',
							    'LKR' => 'Sri Lankan Rupee (LKR)',
							    'LRD' => 'Liberian Dollar (LRD)',
							    'LSL' => 'Lesotho Loti (LSL)',
							    'LTL' => 'Lithuanian Litas (LTL)',
							    'LVL' => 'Latvian Lats (LVL)',
							    'LYD' => 'Libyan Dinar (LYD)',
							    'MAD' => 'Moroccan Dirham (MAD)',
							    'MDL' => 'Moldovan Leu (MDL)',
							    'MGA' => 'Malagasy Ariary (MGA)',
							    'MKD' => 'Macedonian Denar (MKD)',
							    'MMK' => 'Myanma Kyat (MMK)',
							    'MNT' => 'Mongolian Tugrik (MNT)',
							    'MOP' => 'Macanese Pataca (MOP)',
							    'MRO' => 'Mauritanian Ouguiya (MRO)',
							    'MUR' => 'Mauritian Rupee (MUR)',
							    'MVR' => 'Maldivian Rufiyaa (MVR)',
							    'MWK' => 'Malawian Kwacha (MWK)',
							    'MXN' => 'Mexican Peso (MX$)',
							    'MYR' => 'Malaysian Ringgit (MYR)',
							    'MZN' => 'Mozambican Metical (MZN)',
							    'NAD' => 'Namibian Dollar (NAD)',
							    'NGN' => 'Nigerian Naira (NGN)',
							    'NIO' => 'Nicaraguan Córdoba (NIO)',
							    'NOK' => 'Norwegian Krone (NOK)',
							    'NPR' => 'Nepalese Rupee (NPR)',
							    'NZD' => 'New Zealand Dollar (NZ$)',
							    'OMR' => 'Omani Rial (OMR)',
							    'PAB' => 'Panamanian Balboa (PAB)',
							    'PEN' => 'Peruvian Nuevo Sol (PEN)',
							    'PGK' => 'Papua New Guinean Kina (PGK)',
							    'PHP' => 'Philippine Peso (Php)',
							    'PKG' => 'PKG (PKG)',
							    'PKR' => 'Pakistani Rupee (PKR)',
							    'PLN' => 'Polish Zloty (PLN)',
							    'PYG' => 'Paraguayan Guarani (PYG)',
							    'QAR' => 'Qatari Rial (QAR)',
							    'RON' => 'Romanian Leu (RON)',
							    'RSD' => 'Serbian Dinar (RSD)',
							    'RUB' => 'Russian Ruble (RUB)',
							    'RWF' => 'Rwandan Franc (RWF)',
							    'SAR' => 'Saudi Riyal (SAR)',
							    'SBD' => 'Solomon Islands Dollar (SBD)',
							    'SCR' => 'Seychellois Rupee (SCR)',
							    'SDG' => 'Sudanese Pound (SDG)',
							    'SEK' => 'Swedish Krona (SEK)',
							    'SGD' => 'Singapore Dollar (SGD)',
							    'SHP' => 'Saint Helena Pound (SHP)',
							    'SLL' => 'Sierra Leonean Leone (SLL)',
							    'SOS' => 'Somali Shilling (SOS)',
							    'SRD' => 'Surinamese Dollar (SRD)',
							    'STD' => 'São Tomé and Príncipe Dobra (STD)',
							    'SVC' => 'Salvadoran Colón (SVC)',
							    'SYP' => 'Syrian Pound (SYP)',
							    'SZL' => 'Swazi Lilangeni (SZL)',
							    'THB' => 'Thai Baht (฿)',
							    'TJS' => 'Tajikistani Somoni (TJS)',
							    'TMT' => 'Turkmenistani Manat (TMT)',
							    'TND' => 'Tunisian Dinar (TND)',
							    'TOP' => 'Tongan Paʻanga (TOP)',
							    'TRY' => 'Turkish Lira (TRY)',
							    'TTD' => 'Trinidad and Tobago Dollar (TTD)',
							    'TWD' => 'New Taiwan Dollar (NT$)',
							    'TZS' => 'Tanzanian Shilling (TZS)',
							    'UAH' => 'Ukrainian Hryvnia (UAH)',
							    'UGX' => 'Ugandan Shilling (UGX)',
							    'USD' => 'US Dollar ($)',
							    'UYU' => 'Uruguayan Peso (UYU)',
							    'UZS' => 'Uzbekistan Som (UZS)',
							    'VEF' => 'Venezuelan Bolívar (VEF)',
							    'VND' => 'Vietnamese Dong (₫)',
							    'VUV' => 'Vanuatu Vatu (VUV)',
							    'WST' => 'Samoan Tala (WST)',
							    'XAF' => 'CFA Franc BEAC (FCFA)',
							    'XCD' => 'East Caribbean Dollar (EC$)',
							    'XDR' => 'Special Drawing Rights (XDR)',
							    'XOF' => 'CFA Franc BCEAO (CFA)',
							    'XPF' => 'CFP Franc (CFPF)',
							    'YER' => 'Yemeni Rial (YER)',
							    'ZAR' => 'South African Rand (ZAR)',
							    'ZMK' => 'Zambian Kwacha (1968-2012) (ZMK)',
							    'ZMW' => 'Zambian Kwacha (ZMW)',
							    'ZWL' => 'Zimbabwean Dollar (2009) (ZWL)',
							  ),
	            'desc' => __( '<p>Please choose from drop down list. You can choose multiple currencies by using "ctrl" key.</p>', 'tesseract' ),
	            'id'   => 'wc_tesseract_currency_title',
	        ),
	        'section_end' => array(
	             'type' => 'sectionend',
	             'id' => 'wc_tesseract_currency_section_end'
	        )
	    );
	    return apply_filters( 'wc_tesseract_currency_settings', $settings );
	}
	public function update_currency_tab_settings()
	{
		woocommerce_update_options( $this->get_currency_tab_content() );
	}
	public function tesseract_price_html($product)
	{
		$sale_price = get_post_meta( $product->id, '_price', true);
		$regular_price = get_post_meta( $product->id, '_regular_price', true);
		if(!$sale_price) return;
		if(!$regular_price) return;
		//echo '  ---  '.$product->get_price()." S ".$product->get_sale_price()." R ".$product->get_regular_price();
		if(get_option('tesseract_selected_currency',true))
		{
			$currency_code = get_theme_mod('tesseract_selected_currency');
			//echo "222222----- ".$currency_code;
		}
		else
		{
			//echo "11111";
			$currency_code = (get_theme_mod('woocommerce_currency')) ? get_theme_mod('woocommerce_currency') : 'USD';
		}
		$currency_pos = (get_option('woocommerce_currency_pos')) ? get_option('woocommerce_currency_pos') : 'left';
		//echo "------ ".$currency_pos;
		if($product->get_sale_price()){
			?>
				<del>
					<span class="woocommerce-Price-amount amount" style="text-decoration: line-through;">
						<?php
							if($currency_pos == 'left'){ 
						?>
							<span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span><?php echo number_format($product->get_regular_price(),2); ?>
						<?php } ?>
						<?php
							if($currency_pos == 'left_space'){ 
						?>
							<span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span> <?php echo number_format($product->get_regular_price(),2); ?>
						<?php } ?>
						<?php
							if($currency_pos == 'right'){ 
						?>
							<?php echo number_format($product->get_regular_price(),2); ?><span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span>
						<?php } ?>
						<?php
							if($currency_pos == 'right_space'){ 
						?>
							<?php echo number_format($product->get_regular_price(),2); ?>
							 <span class="woocommerce-Price-currencySymbol"> <?php echo get_woocommerce_currency_symbol($currency_code); ?></span>
						<?php } ?>
						
					</span>
				</del>
				<ins>
					<span class="woocommerce-Price-amount amount">
						<span class="sales-price">
							<?php
								if($currency_pos == 'left'){ 
							?>
								<span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span><?php echo number_format($product->get_sale_price(),2); ?>
							<?php } ?>
							<?php
								if($currency_pos == 'left_space'){ 
							?>
								<span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span> <?php echo number_format($product->get_sale_price(),2); ?>
							<?php } ?>
							
							
							<?php
								if($currency_pos == 'right'){ 
							?>
								<?php echo number_format($product->get_sale_price(),2); ?><span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span>
							<?php } ?>
							<?php
								if($currency_pos == 'right_space'){ 
							?>
								<?php echo number_format($product->get_sale_price(),2); ?> <span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span>
							<?php } ?>
						</span>
					</span>
				</ins>
			<?php
		}
		else
		{
			?>
				<span class="woocommerce-Price-amount amount">
					<span class="sales-price">
							<?php
								if($currency_pos == 'left'){ 
							?>
								<span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span><?php echo number_format($product->get_regular_price(),2); ?>
							<?php } ?>
							<?php
								if($currency_pos == 'left_space'){ 
							?>
								<span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span> <?php echo number_format($product->get_regular_price(),2); ?>
							<?php } ?>
						
							<?php
								if($currency_pos == 'right'){ 
							?>
								<?php echo number_format($product->get_regular_price(),2); ?><span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol($currency_code); ?></span>
							<?php } ?>
							<?php
								if($currency_pos == 'right_space'){ 
							?>
								<?php echo number_format($product->get_regular_price(),2); ?> <span class="woocommerce-Price-currencySymbol"><?php echo  get_woocommerce_currency_symbol($currency_code); ?></span>
							<?php } ?>
					</span>
				</span>
			<?php
		}
	}

}new Tesseract_Woo();

function footer_upper_section_status_choice()
{
	$footer_upper_section_choice = get_theme_mod( 'footer_upper_section_choice' );
	$footer_section_choice = ( $footer_upper_section_choice == 'enable' )  ? true : false;
	return $footer_section_choice;
}

function footer_upper_section_1_type()
{
	$footer_upper_section = get_theme_mod( 'footer_upper_section_1' );
	$footer_upper_section_choice = get_theme_mod( 'footer_upper_section_choice' );

	$footer_section = ( $footer_upper_section == 'html' && $footer_upper_section_choice == 'enable' )  ? true : false;
	return $footer_section;
}

function footer_upper_section_1_type_menu()
{
	$footer_upper_section = get_theme_mod( 'footer_upper_section_1' );
	$footer_upper_section_choice = get_theme_mod( 'footer_upper_section_choice' );
	$footer_section = ( $footer_upper_section == 'menu' && $footer_upper_section_choice == 'enable' )  ? true : false;
	return $footer_section;
}

function footer_upper_section_2_type()
{
	$footer_upper_section = get_theme_mod( 'footer_upper_section_2' );
	$footer_upper_section_choice = get_theme_mod( 'footer_upper_section_choice' );
	$footer_section = ( $footer_upper_section == 'html' && $footer_upper_section_choice == 'enable' )  ? true : false;
	return $footer_section;
}
function footer_upper_section_2_type_menu()
{
	$footer_upper_section = get_theme_mod( 'footer_upper_section_2' );
	$footer_upper_section_choice = get_theme_mod( 'footer_upper_section_choice' );
	$footer_section = ( $footer_upper_section == 'menu' && $footer_upper_section_choice == 'enable' )  ? true : false;
	return $footer_section;
}

function footer_upper_section_3_type()
{
	$footer_upper_section = get_theme_mod( 'footer_upper_section_3' );
	$footer_upper_section_choice = get_theme_mod( 'footer_upper_section_choice' );
	$footer_section = ( $footer_upper_section == 'html' && $footer_upper_section_choice == 'enable' )  ? true : false;
	return $footer_section;
}
function footer_upper_section_3_type_menu()
{
	$footer_upper_section = get_theme_mod( 'footer_upper_section_3' );
	$footer_upper_section_choice = get_theme_mod( 'footer_upper_section_choice' );
	$footer_section = ( $footer_upper_section == 'menu' && $footer_upper_section_choice == 'enable' )  ? true : false;
	return $footer_section;
}

function footer_upper_section_4_type()
{
	$footer_upper_section = get_theme_mod( 'footer_upper_section_4' );
	$footer_upper_section_choice = get_theme_mod( 'footer_upper_section_choice' );
	$footer_section = ( $footer_upper_section == 'html' && $footer_upper_section_choice == 'enable' )  ? true : false;
	return $footer_section;
}
function footer_upper_section_4_type_menu()
{
	$footer_upper_section = get_theme_mod( 'footer_upper_section_4' );
	$footer_upper_section_choice = get_theme_mod( 'footer_upper_section_choice' );
	$footer_section = ( $footer_upper_section == 'menu' && $footer_upper_section_choice == 'enable' )  ? true : false;
	return $footer_section;
}


function footer_upper_content_section($sectionId,$sectionType)
{
	
	switch($sectionType)
	{
		case 'none':
			$default = '<section class="widget widget-page-content 01">
						<div class="widget-inner">
						  <header class="widget-header">
						    <h2></h2>
						  </header>
						    <div class="page-content">
								  <p><span></span></p>
								<p><span></span></p>
								<p></p>
							</div>
						</div>
					</section>';
			echo $default;
			break;
		case 'html':
			$default = '<section class="widget widget-page-content 01">
						<div class="widget-inner">
						  <header class="widget-header">
						    <h2>Providence</h2>
						  </header>
						    <div class="page-content">
								  <p><span>Providence is a feature-rich, completely responsive Shopify theme that looks beautiful on all screens, from phones to desktops.</span></p>
								<p><span>Let your customers enjoy its clean, user-friendly design as-is or tailor it to your liking through the extensive array of theme options.</span></p>
								<p>Built by <a href="http://tesseractplus.com/" target="_blank" title="Tesseract">Tesseract</a></p>
							</div>
						</div>
					</section>';
			$html = (get_theme_mod('footer_upper_section_'.$sectionId.'_html')) ? get_theme_mod('footer_upper_section_'.$sectionId.'_html') : $default;
			echo $html;
			break;
		case 'recent_post':
			?>
			<h2>Recent Articles</h2>
      		<article class="hentry entry-8522423">
				<?php
				  	$args = array(
						'numberposts' => 1,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'suppress_filters' => true
					);
					$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
					$author_id=$recent_posts[0]['post_author'];
				?>
				<header>
				    <h2 class="entry-title">
				      <a href="<?php echo get_post_permalink($recent_posts[0]['ID']); ?>" title=""><?php echo $recent_posts[0]['post_title']; ?></a>
				    </h2>
				</header>
			    <div class="entry-summary">
				    <p><?php if(strlen($recent_posts[0]['post_content'])>195){echo substr($recent_posts[0]['post_content'],0,195).'...';}else{ echo $recent_posts[0]['post_content']; }; ?></p>
				    <p class="more-link">
				      <a href="#" class="button">Read more</a>
				    </p>
				  
				</div>
				<div class="entry-meta">
				    <p>
				    	<span class="author group">By <?php the_author_meta( 'user_nicename' , $author_id ); ?></span><span class="divider"></span>
				    </p>
				</div>
		  	</article>
			<?php
			break;
		/*case 'newsletter':
			?>
			<h2>Newsletter</h2>
		    <?php
				if ( is_plugin_active('newsletter-subscription-form/newsletter-subscription-form.php')){
					echo do_shortcode('[nls_form]'); 
				}
				else
				{
					echo "No Suitable Newsletter plugins found";
				}
			?>
			<?php
			break;*/
		case 'socialmenu';
			?>
			<h2>Social Links</h2>
			<section id="footer-horizontal-menu" class="cf ft-social-links-mid">
				<div class="menu-footer-container">
					<ul class="menu">
						<?php 
							$bln_tesseract_social_account_right = false;
							for ( $i = 1; $i <= 10; $i++ ) 
							{
								$account_number = sprintf( '%02d', $i );
								$sn_img = get_theme_mod( "tesseract_social_account{$account_number}_image" );
								if ( $sn_img ) 
								{
									$sn_name = get_theme_mod( "tesseract_social_account{$account_number}_name" );
									$sn_url = get_theme_mod( "tesseract_social_account{$account_number}_url" );
									if ( $sn_name && $sn_url ) 
									{
										$bln_tesseract_social_account_right = true;
										echo '<li><a title="Follow Us on ' . $sn_name . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_name . ' icon" /></a></li>';
									}
								}
							}	
							if($bln_tesseract_social_account_right == false)
							{
								echo "<li>Add your social accounts and they'll appear here.</li>";
							}	
						?>
					</ul>
				</div>
			</section>
			<?php
			break;
		case 'menu':
			$menu_upper = get_theme_mod('footer_upper_section_'.$sectionId.'_menu');
			?>
			<h2>Links</h2>
      		<section id="footer-horizontal-menu" class="cf">
      			<?php wp_nav_menu(array('menu'=>$menu_upper)); ?>
      		</section>
			<?php
			break;
		case 'default':
			break;
	}
}

class tesseract_sm_widget extends WP_Widget 
{

	function __construct() {
		parent::__construct(
			'tesseract_widget_sm', 
			__('Social Media', 'tesseract'), 
			array( 'description' => __( 'Social Media links shows on Sidebar', 'tesseract' ),) 
		);
	}

	public function widget( $args, $instance ) 
	{
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		?>
			<ul class="hr-social">
				<?php 
					$bln_tesseract_social_account_right = false;
					for ( $i = 1; $i <= 10; $i++ ) 
					{
						$account_number = sprintf( '%02d', $i );
						$sn_img = get_theme_mod( "tesseract_social_account{$account_number}_image" );
						if ( $sn_img ) 
						{
							$sn_name = get_theme_mod( "tesseract_social_account{$account_number}_name" );
							$sn_url = get_theme_mod( "tesseract_social_account{$account_number}_url" );
							if ( $sn_name && $sn_url ) 
							{
								$bln_tesseract_social_account_right = true;
								echo '<li><a title="Follow Us on ' . $sn_name . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_name . ' icon" /></a></li>';
							}
						}
					}	
					if($bln_tesseract_social_account_right == false)
					{
						echo "<li>Add your social accounts and they'll appear here.</li>";
					}	
				?>
			</ul>
		<?php
		echo $args['after_widget'];
	}
		
	public function form( $instance ) 
	{
		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}
		else {
		$title = __( 'New title', 'tesseract' );
		}
	?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tesseract' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
	<?php 
	}
	
	public function update( $new_instance, $old_instance ) 
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

class tesseract_fc_widget extends WP_Widget 
{

	function __construct() {
		parent::__construct(
			'tesseract_widget_fc', 
			__('Featured Collections', 'tesseract'), 
			array( 'description' => __( 'Featured Collections Title with Links shows on Sidebar', 'tesseract' ),) 
		);
	}

	public function widget( $args, $instance ) 
	{
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		$args = array(
					'posts_per_page'   => -1,
					'post_type'        => 'collection',
					'post_status'      => 'publish',
				);
		$posts_array = get_posts( $args ); 
		//echo "<pre>"; print_r($posts_array); echo "</pre>";
		if($posts_array != NULL)
		{
			echo "<ul>";
			foreach($posts_array as $collection)
			{	
				echo "<li>";
				echo '<a href="'.get_post_permalink($collection->ID).'">';
				echo $collection->post_title;
				echo "</a>";
				echo "</li>";
			}
			echo "</ul>";
			echo $args['after_widget'];
		}
		else
		{
			echo "No collection found.";
		}

		
	}
		
	public function form( $instance ) 
	{
		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}
		else {
		$title = __( 'New title', 'tesseract' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tesseract' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
	
	public function update( $new_instance, $old_instance ) 
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

function tesseract_custom_woo_message( $message, $product_id = null ) {

	$titles[] = get_the_title( $product_id );
	$titles = array_filter( $titles );
	if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) :
		//$message = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );
	   $message = sprintf( '%s %s<a href="%s" class="button wc-forward tesseract-woo-button">%s</a>', $titles[0], __( 'has been added to cart.', 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ), __( 'Continue Shopping', 'woocommerce' ) );
	else :
	    $message = sprintf( '%s %s<a class="button wc-forward tesseract-woo-button" href="%s" class="your-class">%s</a>', $titles[0] , __( 'has been added to cart.' , 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ), __( 'View Cart', 'woocommerce' ) );
	endif;
	return $message;
}
add_filter( 'wc_add_to_cart_message', 'tesseract_custom_woo_message',10,2 );



?>