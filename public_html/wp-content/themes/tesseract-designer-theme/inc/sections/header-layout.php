<?php

/*

 * section HEADER LAYOUT

 */

//if ( is_plugin_active( 'tesseract-pro-plugin/fl-builder.php' ) ) {

   	$wp_customize->add_section( 'tesseract_header_layouts' , array(

    	'title'      => __('Header Layout', 'tesseract'),

    	'priority'   => 1,

		'panel'      => 'tesseract_header_options'

	) );





	$wp_customize->add_setting( 'tesseract_header_layout_setting', array(

			'sanitize_callback' => 'tesseract_sanitize_select_header_layout_types',

			'default' 			=> 'defaultlayout'

	) );



	$wp_customize->add_control(

		new WP_Customize_Control(

		$wp_customize,

		'tesseract_header_layout_setting_control',

		array(

			'label'      => __( 'Header Layout Option', 'tesseract' ),

			'section'    => 'tesseract_header_layouts',

			'settings'   => 'tesseract_header_layout_setting',

			'type'          => 'select',

			'default'       => 'defaultlayout',

			'choices'		=> array(

				'none'  	                => 	'None',

				'navbottom'        			=> 	'Nav Bottom',

				'navright'			    	=>  'Nav Right & Logo Left',

				'navleft'			    	=>  'Nav Left & Logo Right',

				'logoleftnavleft'			=>  'Nav Left & Logo Left',

				'centered-inline-logo'		=>  'Logo In Menu Center',

				'navcentered'				=>  'Nav Centered',

				'vertical-left'				=>  'Nav Vertical Left',

				'vertical-right'			=>  'Nav Vertical Right',

				'defaultlayout'			    =>  'Default'

				),

			'priority'   => 1

		) )

	);

	

	$wp_customize->add_setting( 'inline_logo_side', array(

			'sanitize_callback' => 'tesseract_sanitize_inline_logo_side',

			'default' 			=> 'inlineright'

	) );



	

	

	$wp_customize->add_setting( 'tesseract_vertical_header_width', array(

		'transport'         => 'refresh',

		'sanitize_callback' => 'absint',

		'default' 			=> 230

	) );			

	

	$wp_customize->add_control( 'tesseract_vertical_header_width_control', array(

		'type'        		=> 'range',

		'priority'    		=> 1,

		'section'     		=> 'tesseract_header_layouts',

		'settings'     		=> 'tesseract_vertical_header_width',

		'label'       		=> 'Vertical Nav Width',

		'description' 		=> 'Use this range slider to set Vertical Nav Width',

		'input_attrs' 		=> array(

			'min'   => 200,

			'max'   => 400,

			'step'  => 1,

			'class' => 'tesseract-header-height',

			'style' => 'color: #0a0',

		),

		'priority' 			=> 1,

		'active_callback' 	=> 'tesseract_vertical_header_width_enable_2'

	) );

	$wp_customize->add_setting( 'tesseract_vertical_menu_social_icon', array(

		'transport'         => 'refresh',

		'default' 			=> 'disable'

	) );			

	

	$wp_customize->add_control( 'tesseract_vertical_menu_social_icon_control', array(

		'type'        		=> 'select',

		'priority'    		=> 2,

		'section'     		=> 'tesseract_header_layouts',

		'settings'     		=> 'tesseract_vertical_menu_social_icon',

		'label'       		=> 'Social Icon',

		'description' 		=> 'Use this to show the social icons into Menu.',

		'choices' 		=> array(

			'enable' => 'Enable',
			'disable' => 'Disable'

		),

		'priority' 			=> 2,

		'active_callback' 	=> 'tesseract_vertical_header_width_enable'

	) );

	$wp_customize->add_setting( 'tesseract_header_layout_bck_image' );	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tesseract_header_layout_bck_image', array(
    'label'    => __( 'Header Layout Background Image', 'tesseract' ),
    'description' => __('To set background image on header menu', 'tesseract'),
    'section'  => 'tesseract_header_layouts',
    'settings' => 'tesseract_header_layout_bck_image',
    'priority' => 4
) ) );
	$wp_customize->add_setting( 'tesseract_vertical_header_bck_img_rpt', array(
		'transport'         => 'refresh',
		'default' 			=> 'disable'
	) );			

	$wp_customize->add_control( 'tesseract_vertical_header_bck_img_rpt', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_header_layouts',
		'settings'     		=> 'tesseract_vertical_header_bck_img_rpt',
		'label'       		=> 'Header Background Image Repeat',
		'description' 		=> 'Use this you repeat the same background image instead of one.',
		'choices' 		=> array(
			'enable' => 'Enable',
			'disable' => 'Disable'
		),
		'priority' 			=> 5,
		'active_callback' 	=> 'tesseract_vertical_header_bck_image_choice'
	) );

	$wp_customize->add_setting( 'tesseract_vertical_header_menu_fixed', array(
		'transport'         => 'refresh',
		'default' 			=> 'disable'
	) );			

	$wp_customize->add_control( 'tesseract_vertical_header_menu_fixed', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_header_layouts',
		'settings'     		=> 'tesseract_vertical_header_menu_fixed',
		'label'       		=> 'Fixed Header Menu',
		'description' 		=> 'Use this you sticked/fixed the header menu, when your page is scrolling',
		'choices' 		=> array(
			'enable' => 'Enable',
			'disable' => 'Disable'
		),
		'priority' 			=> 3,
		'active_callback' 	=> 'tesseract_vertical_header_layout_choice'
	) );	

	$wp_customize->add_setting( 'tesseract_centre_header_menu_rl', array(
		'transport'         => 'refresh',
		'default' 			=> 'left'
	) );			

	$wp_customize->add_control( 'tesseract_centre_header_menu_rl', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_header_layouts',
		'settings'     		=> 'tesseract_centre_header_menu_rl',
		'label'       		=> 'Left/Right Position',
		'description' 		=> 'There are odd number of item in menu, so to place the logo choose below position',
		'choices' 		=> array(
			'right' => 'Right',
			'left' => 'Left'
		),
		'priority' 			=> 2,
		'active_callback' 	=> 'tesseract_centre_menu_in_logo_odd'
	) );

	/* Upper Header Left Area */

	$wp_customize->add_setting( 'tesseract_header_upper_status', array(
		'transport'         => 'refresh',
		'default' 			=> 'disable'
	) );			

	$wp_customize->add_control( 'tesseract_header_upper_status', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_header_layouts',
		'settings'     		=> 'tesseract_header_upper_status',
		'label'       		=> 'Header Upper Section',
		'choices' 		=> array(
			'disable' => 'Disable',
			'enable' => 'Enable',
		),
		'priority' 			=> 6,
		'active_callback' 	=> 'tesseract_header_upper_layout_choice_1'
	) );


	$wp_customize->add_setting( 'tesseract_header_upper_left_content_type', array(
		'transport'         => 'refresh',
		'default' 			=> 'text'
	) );			

	$wp_customize->add_control( 'tesseract_header_upper_left_content_type', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_header_layouts',
		'settings'     		=> 'tesseract_header_upper_left_content_type',
		'label'       		=> 'Left Content Type(Top)',
		'choices' 		=> array(
			'none' => 'None',
			'text' => 'Text',
			'social'=> 'Social',
			'textsocial'=>'Text and Social'
		),
		'priority' 			=> 7,
		'active_callback' 	=> 'tesseract_header_upper_layout_choice'
	) );

	$wp_customize->add_setting( 'tesseract_header_upper_left_content_text', array(
		'transport'         => 'refresh',
		'default' 			=> 'Text On Upper Header Left Panel'
	) );			

	$wp_customize->add_control( 'tesseract_header_upper_left_content_text', array(
		'type'        		=> 'textarea',
		'section'     		=> 'tesseract_header_layouts',
		'settings'     		=> 'tesseract_header_upper_left_content_text',
		'label'       		=> 'Left Content',
		'priority' 			=> 8,
		'active_callback' 	=> 'tesseract_header_upper_left_content_type_choice'
	) );


	/* Upper Header Centre Area */

	$wp_customize->add_setting( 'tesseract_header_upper_centre_content_type', array(
		'transport'         => 'refresh',
		'default' 			=> 'cartwoolink'
	) );			

	$wp_customize->add_control( 'tesseract_header_upper_centre_content_type', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_header_layouts',
		'settings'     		=> 'tesseract_header_upper_centre_content_type',
		'label'       		=> 'Center Content Type(Top)',
		'choices' 		=> array(
			'none' => 'None',
			'cartsummary' => 'Cart Summary',
			'woolinks' => 'WooCommerce User Page Links ',
			'cartwoolink' => 'Cart Summary and WooCommerce User Page Links'
		),
		'priority' 			=> 9,
		'active_callback' 	=> 'tesseract_header_upper_layout_choice'
	) );

	// $wp_customize->add_setting( 'tesseract_header_upper_centre_content_text', array(
	// 	'transport'         => 'refresh',
	// 	'default' 			=> '<a href="/signup">Signup</a> or <a href="/checkout">Checkout</a>'
	// ) );			

	// $wp_customize->add_control( 'tesseract_header_upper_centre_content_text', array(
	// 	'type'        		=> 'textarea',
	// 	'section'     		=> 'tesseract_header_layouts',
	// 	'settings'     		=> 'tesseract_header_upper_centre_content_text',
	// 	'label'       		=> 'Centre Content',
	// 	'priority' 			=> 9,
	// 	'active_callback' 	=> 'tesseract_header_upper_centre_content_type_choice'
	// ) );

	/* Upper Header Right Area */

	$wp_customize->add_setting( 'tesseract_header_upper_right_content_type', array(
		'transport'         => 'refresh',
		'default' 			=> 'searchcurrency'
	) );			

	$wp_customize->add_control( 'tesseract_header_upper_right_content_type', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_header_layouts',
		'settings'     		=> 'tesseract_header_upper_right_content_type',
		'label'       		=> 'Right Content Type(Top)',
		'choices' 		=> array(
			'none' => 'None',
			'search' => 'Search Bar',
			'currency' => 'Currency Switcher',
			'searchcurrency' => 'Search Bar & Currency Switcher'
		),
		'priority' 			=> 10,
		'active_callback' 	=> 'tesseract_header_upper_layout_choice'
	) );

	// $wp_customize->add_setting( 'tesseract_header_upper_right_content_text', array(
	// 	'transport'         => 'refresh',
	// 	'default' 			=> 'Text On Upper Header Right Panel'
	// ) );			

	// $wp_customize->add_control( 'tesseract_header_upper_right_content_text', array(
	// 	'type'        		=> 'textarea',
	// 	'section'     		=> 'tesseract_header_layouts',
	// 	'settings'     		=> 'tesseract_header_upper_right_content_text',
	// 	'label'       		=> 'Left Content',
	// 	'priority' 			=>  11,
	// 	'active_callback' 	=> 'tesseract_header_upper_right_content_type_choice'
	// ) );



	

	/*$wp_customize->add_control( 'tesseract_header_layout_bck_image_control', array(

		'type'        		=> 'file',

		'priority'    		=> 3,

		'section'     		=> 'tesseract_header_layouts',

		'settings'     		=> 'tesseract_header_layout_bck_image',

		'label'       		=> 'Header Layout Background Image',

		'description' 		=> 'To set background image on header menu',

	) );*/

			

		

		/*$wp_customize->add_setting( 'tesseract_header_height', array(

			'transport'         => 'postMessage',

			'sanitize_callback' => 'absint',

			'default' 			=> 10

		) );			

		

			$wp_customize->add_control( 'tesseract_header_height_control', array(

				'type'        		=> 'range',

				'priority'    		=> 2,

				'section'     		=> 'tesseract_header_layouts',

				'settings'     		=> 'tesseract_header_height',

				'label'       		=> 'Header Padding',

				'description' 		=> 'Use this range slider to set header height',

				'input_attrs' 		=> array(

					'min'   => 0,

					'max'   => 50,

					'step'  => 5,

					'class' => 'tesseract-header-height',

					'style' => 'color: #0a0',

				),

				'priority' 			=> 2

			) );*/

//};			



		$wp_customize->add_setting( 'tesseract_header_right_content', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_nextToMenu_right',

				'default'			=> 'nothing'

		) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_header_right_content_control',

					array(

						'label' => 		'Header Right Block Content',
						'description' 		=> 'Choose the content to be displayed in the right block of the header area, only applicable for \'Default\' Header Layout.', 'tesseract',

						'section'        => 'tesseract_header_layouts',

						'settings'       => 'tesseract_header_right_content',

						'type'           => 'radio',

						'choices' 		 => array(

							'nothing' 	 => __( 'Nothing', 'tesseract'),

							'buttons' 	 => __( 'Buttons', 'tesseract'),

							'social' 	 => __( 'Social Icon', 'tesseract'),


						),

						'priority' 		 => 15,
						'active_callback' 	=> 'tesseract_header_right_area_enable'


					)

				)

			);



		$defaultBtns = '<a href="/" class="button primary-button">Primary Button</a><a href="/" class="button secondary-button">Secondary Button</a>';



		$wp_customize->add_setting( 'tesseract_header_content_if_button', array(

			'sanitize_callback' => 'tesseract_sanitize_textarea_html',

			'default' 			=> $defaultBtns

		) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_header_content_if_button_control',

					array(

						'label'          => __( 'Button code', 'tesseract' ),

						'section'        => 'tesseract_header_layouts',

						'settings'       => 'tesseract_header_content_if_button',

						'type'           => 'textarea',

						'priority' 		 => 16,

						'active_callback' 	=> 'tesseract_button_textarea_enable2'


					)

				)

			);