<?php

/*  

 * section FOOTER COLORS

 */		

	

   	$wp_customize->add_section( 'tesseract_footer_content_align' , array(

    	'title'      => __('Footer Content Alignment', 'tesseract'),

    	'priority'   => 15,

		'panel'      => 'tesseract_footer_options'

	) );	

	

		$wp_customize->add_setting( 'tesseract_footer_content_align_option', array(
		'transport'         => 'refresh',
		'default' 			=> 'horizantal'
	) );			

	$wp_customize->add_control( 'tesseract_footer_content_align_option', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_footer_content_align',
		'settings'     		=> 'tesseract_footer_content_align_option',
		//'label'       		=> 'Logo Type',
		//'description' 		=> 'Make your Own Logo And Upload Here',
		'choices' 		=> array(
			'horizantal' => 'Horizantal',
			'vertical' => 'Vertical',
			
		),
		'priority' 			=> 1,
	) );
		

