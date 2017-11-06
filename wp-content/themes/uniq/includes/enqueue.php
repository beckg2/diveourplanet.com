<?php 

/**
 * Enqueue scripts and styles.
 */
function uniq_scripts() {
	wp_enqueue_style( 'uniq-patua', uniq_theme_font_url('Patua One'), array(), 20141212 );
	wp_enqueue_style( 'uniq-roboto', uniq_theme_font_url('Roboto:400,500,700'), array(), 20141212 );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), 20150224 );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), 20150224 );
	wp_enqueue_style( 'uniq-style', get_stylesheet_uri() );

	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '2.4.0', true );
	wp_enqueue_script( 'uniq-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'uniq-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'uniq-custom', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if( get_theme_mod('sticky_header',false) ){
		wp_enqueue_script( 'uniq-custom-sticky', get_template_directory_uri() . '/js/custom-sticky.js', array('jquery'), '1.0.0', true );
	}
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '2.4.0', true );
	wp_enqueue_script('masonry');
	wp_enqueue_script( 'uniq', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'uniq_scripts' );

/**
 * Register Google fonts.
 *
 * @return string
 */
function uniq_theme_font_url($font) {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Font, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Font: on or off', 'uniq' ) ) {
		$font_url = esc_url( add_query_arg( 'family', urlencode($font), "//fonts.googleapis.com/css" ) );
	}

	return $font_url;
}

function uniq_admin_enqueue_scripts( $hook ) {
	//if( strpos($hook, 'uniq_upgrade') ) {
		wp_enqueue_style( 
			'uniq-fa', 
			get_template_directory_uri() . '/css/font-awesome.min.css', 
			array(), 
			'4.3.0', 
			'all' 
		);
		wp_enqueue_style( 
			'uniq-admin-css', 
			get_template_directory_uri() . '/admin/css/admin.css', 
			array(), 
			'1.0.0', 
			'all' 
		);
	//}
}
add_action( 'admin_enqueue_scripts', 'uniq_admin_enqueue_scripts' );


function uniq_admin_customizer_enqueue_scripts(){
	   wp_enqueue_script( 
			'uniq-customizer-review-script', 
			get_template_directory_uri() . '/admin/js/script.js',
			array('jquery'),
			'1.0.0',
			true
		); 
	   wp_enqueue_style( 
			'uniq-customizer-css', 
			get_template_directory_uri() . '/admin/css/customizer.css', 
			array(), 
			'1.0.0', 
			'all' 
		);
}
add_action( 'admin_enqueue_scripts', 'uniq_admin_customizer_enqueue_scripts');