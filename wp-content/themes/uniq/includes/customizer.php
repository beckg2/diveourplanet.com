<?php
/**
 * uniq Theme Customizer
 *
 * @package uniq
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uniq_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'uniq_customize_register' ); 



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function uniq_customize_preview_js() {
	wp_enqueue_script( 'uniq_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'uniq_customize_preview_js' );


if( get_theme_mod('enable_primary_color',false) ) {

	add_action( 'wp_head','wbls_customizer_primary_custom_css' );

		function wbls_customizer_primary_custom_css() {
			$primary_color = get_theme_mod( 'primary_color','#3DAD66'); ?>

	<style type="text/css">
				.main-navigation {
					background-image: none!important;
				}

			</style>
<?php
	}
}

if( get_theme_mod('enable_navigation_primary_color',false) ) {

	add_action( 'wp_head','wbls_customizer_hover_navigation_primary_custom_css' );

		function wbls_customizer_hover_navigation_primary_custom_css() {
			$nav_navigation_primary_color = get_theme_mod( 'navigation_primary_color','#3dad66'); ?>

				<style type="text/css">
							.main-navigation {
					            background-image: none!important;
				             }
				             .site-footer .scroll-to-top:hover,.portfolioeffects .portfolio_overlay {
					opacity: 0.6;
				}
				</style>
<?php }
}











