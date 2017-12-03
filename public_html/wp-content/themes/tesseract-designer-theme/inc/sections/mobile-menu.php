<?php

/*

 * section HEADER COLORS

 */



   	$wp_customize->add_section( 'tesseract_mobmenu' , array(

    	'title'      => __('Mobile Menu', 'tesseract'),

    	'priority'   => 7,

		'panel'      => 'tesseract_header_options'

	) );



		$wp_customize->add_setting( 'tesseract_mobmenu_opener_mob', array(
				'transport' => 'refresh',

				'default' 			=> 'mob-showit'

		) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_mobmenu_opener_control',

					array(

						'label'          => __( 'Mobile Menu', 'tesseract' ),

						'section'        => 'tesseract_mobmenu',

						'settings'       => 'tesseract_mobmenu_opener_mob',

						'type'           => 'select',
						'choices' => array('mob-showit'=>'Enable','mob-hideit'=>'Disable'),

						'priority' 		 => 1

					)

				)

			);



		//Register setting with the custom ALPHA enabled colorpicker

		// See full blog post here

		// http://pluto.kiwi.nz/2014/07/how-to-add-a-color-control-with-alphaopacity-to-the-wordpress-theme-customizer/



		$wp_customize->add_setting( 'tesseract_mobmenu_background_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'tesseract_sanitize_rgba',

				'default' 			=> '#336ca6'

		) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_mobmenu_background_color_control',

				array(

					'label'      => __( 'Menu Background Color', 'tesseract' ),

					'section'    => 'tesseract_mobmenu',

					'settings'   => 'tesseract_mobmenu_background_color',

					'priority'   => 2

				) )

			);



		$wp_customize->add_setting( 'tesseract_mobmenu_link_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#ffffff'

		) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_mobmenu_link_color_control',

				array(

					'label'      => __( 'Menu Link / Icon Color', 'tesseract' ),

					'section'    => 'tesseract_mobmenu',

					'settings'   => 'tesseract_mobmenu_link_color',

					'priority' 	 => 3

				) )

			);

			$wp_customize->add_setting( 'tesseract_mobmenu_x_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#ffffff'

			) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_mobmenu_x_color_control',

				array(

					'label'      => __( 'Menu " X " Color', 'tesseract' ),
 
					'section'    => 'tesseract_mobmenu',

					'settings'   => 'tesseract_mobmenu_x_color',

					'priority' 	 => 4

				) )

			);

			$wp_customize->add_setting( 'tesseract_mobmenu_x_bck_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#000000'

			) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_mobmenu_x_bck_color_control',

				array(

					'label'      => __( 'Menu " X " Background Color', 'tesseract' ),
 
					'section'    => 'tesseract_mobmenu',

					'settings'   => 'tesseract_mobmenu_x_bck_color',

					'priority' 	 => 5

				) )

			);

			$wp_customize->add_setting( 'tesseract_mobile_menu_font_size', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'esc_html',

				'default' 			=> 22

		) );



			$wp_customize->add_control( 'tesseract_mobile_menu_font_size_control', array(

				'type'        => 'range',

				'priority'    => 6,

				'section'     => 'tesseract_mobmenu',

				'settings'     => 'tesseract_mobile_menu_font_size',

				'label'       => 'Link Font Size',

				'description' => 'Use this range slider to set font size(Min:5px Max:100px) in mobile view.',

				'input_attrs' => array(

					'min'   => 5,

					'max'   => 100,

					'step'  => 1,

					'class' => 'tesseract-tho-header-colors-bck-opacity',

					'style' => 'color: #0a0',

				),


			) );

			$wp_customize->add_setting( 'tesseract_header_logo_height_mob', array(

				'transport'         => 'postMessage',

				'sanitize_callback' => 'absint',

				'default' 			=> 100

		) );			

			

			$wp_customize->add_control( 'tesseract_header_logo_height_mob_control', array(

				'type'        		=> 'range',


				'section'     		=> 'tesseract_mobmenu',

				'settings'     		=> 'tesseract_header_logo_height_mob',

				'label'       		=> 'Header Logo Height On Mobile',

				'description' 		=> 'Use this range slider to set header logo height(Min:30px Max:300px) on mobile device only.',

				'input_attrs' 		=> array(

					'min'   => 30,

					'max'   => 300,

					'step'  => 10,

					'class' => 'tesseract-tho-header-logo-height',

					'style' => 'color: #0a0',

				),

				'active_callback' 	=> 'tesseract_header_logo_height_enable',

				'priority' 			=> 7

			) );







