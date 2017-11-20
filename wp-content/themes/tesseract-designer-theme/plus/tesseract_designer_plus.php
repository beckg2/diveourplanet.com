<?php

define( 'WPSM_BBE_DIR', get_template_directory() .'/plus/' );
define( 'WPSM_BBE_URL', get_template_directory_uri() .'/plus/' );

//die;


/**
 * Custom modules
 */
if ( !class_exists( 'WPSM_BBE_Extension' ) ) {
	/**
	*  Main Class
	*/
	class WPSM_BBE_Extension
	{
		
		function __construct()
		{
			$this->wpsActionFilterLoader();
			add_action( 'after_setup_theme', array( $this, 'wpsm_bbe_includes') );
			add_action( 'init', array( $this, 'wpsm_bbe_load_modules') );
			add_action( 'wp_enqueue_scripts', array( $this, 'wpsm_page_builder_script') );
			add_filter( 'fl_builder_render_css', array( $this, 'wpsm_bbe_render_css' ), 10, 3 );
		}
		
		function wpsActionFilterLoader() {
			/* Admin Fun*/
			require_once 'admin/help-function.php';

			/* Classe Loader */
			require 'classes/class-wpsbbe-admin-settings.php';
		}
		
		/**
		 * Includes Necessary Files
		 */
		function wpsm_bbe_includes() {
			
			if ( class_exists( 'FLBuilder' ) ) {
							
				/* Includes */
			    require_once 'includes/row-settings.php';
			    require_once 'includes/class-row-html.php';
   			    require_once 'includes/class-row-css.php';
			}
		}
		
		/**
		 * Load All Modules
		 */
		function wpsm_bbe_load_modules() {
			if ( class_exists( 'FLBuilder' ) ) {
				
			    /* Include Modules */
			    require_once 'modules/all-elements.php';
			}
		}


		/**
		 * Render Global uabb-layout-builder css
		 */
		function wpsm_bbe_render_css($css, $nodes, $global_settings) {
			if ( class_exists( 'FLBuilder' ) ) {

			    $css .= file_get_contents(WPSM_BBE_DIR . 'css/wpsm-row.css');
			    /*ob_start();
				include WPSM_BBE_DIR . 'includes/row-css.php';
				$css .= ob_get_clean();*/
    		}
	    	return $css;
		}

		/**
		 * Page Builder Scripts
		 */
		function wpsm_page_builder_script() {

			if ( class_exists( 'FLBuilder' ) && FLBuilderModel::is_builder_active() ) {
				wp_enqueue_script('wpsm-jqueryextend', WPSM_BBE_URL . 'js/jQueryExtend.js', array(), false, true);
				wp_enqueue_style('wpsm-pagebuilder-ui', WPSM_BBE_URL . 'admin/assets/css/pagebuilder-ui.css');
				wp_enqueue_script('wpsm-pagebuilder-ui', WPSM_BBE_URL . 'admin/assets/js/pagebuilder-ui.js', array(), false, true);
			}
		}
	}
	new WPSM_BBE_Extension();
}

