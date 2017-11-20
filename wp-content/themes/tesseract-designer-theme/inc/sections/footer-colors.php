<?php

/*  

 * section FOOTER COLORS

 */		

	

   	$wp_customize->add_section( 'tesseract_footer_colors' , array(

    	'title'      => __('Footer Colors', 'tesseract'),

    	'priority'   => 1,

		'panel'      => 'tesseract_footer_options'

	) );	

	

		$wp_customize->add_setting( 'tesseract_footer_colors_bck_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#1e73be'

		) );

	

			$wp_customize->add_control( 

				new WP_Customize_Color_Control( 

				$wp_customize, 

				'tesseract_footer_colors_bck_color_control', 

				array(

					'label'      => __( 'Footer Background Color', 'tesseract' ),

					'section'    => 'tesseract_footer_colors',

					'settings'   => 'tesseract_footer_colors_bck_color',

					'priority'   => 1

				) ) 						

			);

		

		$wp_customize->add_setting( 'tesseract_footer_colors_bck_color_opacity', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'esc_html',

				'default' 			=> 100

		) );



			$wp_customize->add_control( 'tesseract_footer_colors_bck_color_opacity_control', array(

				'type'        => 'range',

				'priority'    => 2,

				'section'     => 'tesseract_footer_colors',

				'settings'     => 'tesseract_footer_colors_bck_color_opacity',

				'label'       => 'Homepage Footer Opacity',

				'description' => 'Use this range slider to set background opacity',

				'input_attrs' => array(

					'min'   => 0,

					'max'   => 100,

					'step'  => 5,

					'class' => 'tesseract-tho-header-colors-bck-opacity',

					'style' => 'color: #0a0',

				),

				'active_callback' => 'tesseract_show_header_opacity_control'

			) );





		

		$wp_customize->add_setting( 'tesseract_footer_colors_text_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#ffffff'

		) );

	

			$wp_customize->add_control( 

				new WP_Customize_Color_Control( 

				$wp_customize, 

				'tesseract_footer_colors_text_color_control', 

				array(

					'label'      => __( 'Footer Text Color', 'tesseract' ),

					'section'    => 'tesseract_footer_colors',

					'settings'   => 'tesseract_footer_colors_text_color',

					'priority'   => 2

				) ) 						

			);

			

		$wp_customize->add_setting( 'tesseract_footer_colors_heading_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#ffffff'

		) );

	

			$wp_customize->add_control( 

				new WP_Customize_Color_Control( 

				$wp_customize, 

				'tesseract_footer_colors_heading_color_control', 

				array(

					'label'      => __( 'Footer Heading Color', 'tesseract' ),

					'section'    => 'tesseract_footer_colors',

					'settings'   => 'tesseract_footer_colors_heading_color',

					'priority'   => 3

				) ) 						

			);			

			

		$wp_customize->add_setting( 'tesseract_footer_colors_link_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#ffffff'

		) );

	

			$wp_customize->add_control( 

				new WP_Customize_Color_Control( 

				$wp_customize, 

				'tesseract_footer_colors_link_color_control', 

				array(

					'label'      => __( 'Footer Link/Logo(Text) Color', 'tesseract' ),

					'section'    => 'tesseract_footer_colors',

					'settings'   => 'tesseract_footer_colors_link_color',

					'priority' 	 => 4

				) ) 						

			);

			

		$wp_customize->add_setting( 'tesseract_footer_colors_link_hover_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#d1ecff'

		) );

	

			$wp_customize->add_control( 

				new WP_Customize_Color_Control( 

				$wp_customize, 

				'tesseract_footer_colors_link_hover_color_control', 

				array(

					'label'      => __( 'Footer Hovered Link Color', 'tesseract' ),

					'section'    => 'tesseract_footer_colors',

					'settings'   => 'tesseract_footer_colors_link_hover_color',

					'priority'   => 5

				) ) 						

			);

		$wp_customize->add_setting( 'tesseract_footer_upper_color', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#000000'
		) );

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'tesseract_header_upper_color_control',
			array(
				'label'      => __( 'Footer Upper Background Color', 'tesseract' ),
				'section'    => 'footer_upper_section',
				'settings'   => 'tesseract_footer_upper_color',
				'priority'   => 1,
				'active_callback' 	=> 'footer_upper_section_status_choice'
			) )

		);

		$wp_customize->add_setting( 'tesseract_footer_upper_text_color', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#ffffff'
		) );

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'tesseract_footer_upper_text_color_control',
			array(
				'label'      => __( 'Footer Upper Text Color', 'tesseract' ),
				'section'    => 'footer_upper_section',
				'settings'   => 'tesseract_footer_upper_text_color',
				'priority'   => 2,
				'active_callback' 	=> 'footer_upper_section_status_choice'
			) )

		);
		$wp_customize->add_setting( 'tesseract_footer_upper_separator',
			array(
				'default' => 'disable',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_footer_upper_separator_control',
				array(
					'label'          => __( 'Footer Upper Separator', 'tesseract' ),
					'section'        => 'footer_upper_section',
					'settings'       => 'tesseract_footer_upper_separator',
					'type'           => 'select',
					'choices' 		 => array('disable'=>'Disable','enable'=>'Enable'), 	
					'priority' 		 => 16,
					'active_callback' 	=> 'footer_upper_section_status_choice'						
				)
			)
		);