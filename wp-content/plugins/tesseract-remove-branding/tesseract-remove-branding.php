<?php
/**
 * Plugin Name: Tesseract Remove Branding
 * Plugin URI: http://www.tesseracttheme.com
 * Description: This plugin removes branding from the Tesseract theme footer.
 * Version: 1.8.4
 * Author: Tesseract Theme
 * Author URI: http://www.tesseracttheme.com
 * License: MIT
 * Text Domain: tesseract-remove-branding
 * Domain Path: languages/
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(is_plugin_active('tesseract-pro-plugin/fl-builder.php'))
{
	add_action( 'admin_notices', 'tesseract_pro_activate_notice'  );
	return false;
}
function tesseract_pro_activate_notice() {
	echo '<div class="error"><p>NOTE: An extra Footer Unbranding feature comes with the Tesseract Pro Plugin as a bonus. So you do not need to activate the Tesseract Remove Branding Plugin. Please deactivate Tesseract Remove Branding Plugin to take advantage of these additional footer edit features.</p></div>';
}

if( wp_get_theme() == 'Tesseract(Designer)'){
	add_action( 'admin_notices', 'tesseract_designer_theme_activation'  );
	return false;
}

function tesseract_designer_theme_activation() {
	echo '<div class="error"><p>NOTE: As a bonus the Footer Unbranding feature comes with the Tesseract Designer. So you do not need to activate the Tesseract Remove Branding Plugin. Please deactivate Tesseract Remove Branding Plugin to take advantage of these additional footer edit features.</p></div>';
}

require( dirname( __FILE__ ) . '/version-one-support.php');

if (  wp_get_theme() == 'TESSERACT' || wp_get_theme() == 'Tesseract' || wp_get_theme() == 'Tesseract(Pro)' || wp_get_theme() == 'Tesseract(Free)' || wp_get_theme() == 'Tesseract(Designer)'  ) {

	function tesseract_remove_branding() {
		remove_action( 'tesseract_footer_branding', 'tesseract_footer_branding_output', 10 );
	}

	// Set global variable $brandingGone
	if (!defined('TESSERACT_BRANDING_EXIST'))
		define('TESSERACT_BRANDING_EXIST', 'nope');

	function tesseract_replace_branding() {

		$content = (get_theme_mod('tesseract_footer_right_content')) ? get_theme_mod('tesseract_footer_right_content') : 'html';
		//$content_default_html = get_theme_mod('tesseract_footer_right_content_html');
		$default_html = '<strong>Theme by <a href="http://tesseracttheme.com">Tesseract</a></strong>
                        &nbsp;&nbsp;
                        <strong>
                        	<a href="http://tesseracttheme.com">
                        		<img src="http://tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" />
                            </a>
                        </strong>';
		$content_default_html = (get_theme_mod('tesseract_footer_right_content_html')) ? get_theme_mod('tesseract_footer_right_content_html') : $default_html;
		if ( $content ) : ?>

			<div id="footer-banner-right" class="banner-right <?php echo 'content-' . $content; ?>">

				<?php switch( $content ) {

					// Step 1 -> nothing
					default:
						break;

					// Step 2 -> html
					case 'html':
						
						$code = do_shortcode( $content_default_html );
						echo '<div id="footer-button-container"><div id="footer-button-container-inner">' . $code . '</div></div>';

						break;

					// Step 3 -> social
					case 'social': ?>

							<ul class="hr-social">
								<?php 
								
								$bln_tesseract_social_account_right = false;
									
									for ( $i = 1; $i <= 10; $i++ ) {
										$account_number = sprintf( '%02d', $i );
										$sn_img = get_theme_mod( "tesseract_social_account{$account_number}_image" );
								
										// Quit early if no image is found.
										if ( $sn_img ) {
											$sn_name = get_theme_mod( "tesseract_social_account{$account_number}_name" );
											$sn_url = get_theme_mod( "tesseract_social_account{$account_number}_url" );
								
											if ( $sn_name && $sn_url ) {
											
												$bln_tesseract_social_account_right = true;
												
												echo '<li><a title="Follow Us on ' . $sn_name . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_name . ' icon" /></a></li>';
											}
										}
									}	
									
									if($bln_tesseract_social_account_right == false){
									
										echo "<li>Add your social accounts and they'll appear here.</li>";
										
									}	
									
								/*$sn = array(
									'fb' => __( 'Facebook', 'tesseract' ),
									'tw' => __( 'Twitter', 'tesseract' ),
									'gplus' => __( 'Google Plus', 'tesseract' ),
									'li' => __( 'LinkedIn', 'tesseract' ),
									'yt' => __( 'YouTube', 'tesseract' ),
									'vim' => __( 'Vimeo', 'tesseract' ),
									'tumb' => __( 'Tumblr', 'tesseract' ),
									'fr' => __( 'FlickR', 'tesseract' ),
									'pin' => __( 'Pinterest', 'tesseract' ),
									'dr' => __( 'Dribbble', 'tesseract' )
								);

								$social_networks_set = array();

								foreach ( $sn as $sn_short => $sn_full ) {

									$sn_img = get_theme_mod('tesseract_' . $sn_short . '_image');
									$sn_url = get_theme_mod('tesseract_' . $sn_short . '_url');

									if ( $sn_img && $sn_url ) {
										$social_networks_set[] = array(
											'img' => $sn_img,
											'url' => $sn_url,
											'name' => $sn_full
										);
									}
								}

								if ( empty( $social_networks_set ) ) {
									echo "<li>Add your social accounts and they'll appear here.</li>";
								} else {
									foreach ( $social_networks_set as $sn ) {
										echo '<li><a title="' . __( 'Follow Us on ', 'tesseract' ) . esc_attr( $sn['name'] ) . '" href="' . esc_url( $sn['url'] ) . '" target="_blank"><img src="' . esc_url( $sn['img'] ) . '" width="24" height="24" alt="' . esc_attr( $sn['name'] ) . ' icon" /></a></li>';
									}
								}*/

								?>


							</ul>

						<?php break;

					// Step 5 -> search
					case 'search':

						get_search_form();

						break;
					case 'logo':
									$headerLogo = get_theme_mod('tesseract_header_logo_image');

									$footerLogo = get_theme_mod('tesseract_footer_logo_image');

									$footerLogoEnable = ( get_theme_mod('tesseract_footer_logo_enable') == 'yes' ) ? true : false;

									$header_logo_choice = (get_theme_mod('tesseract_header_logo_type')) ? get_theme_mod('tesseract_header_logo_type') : 'image';

								    $header_text        = (get_theme_mod('tesseract_header_logo_text')) ? get_theme_mod('tesseract_header_logo_text') : get_bloginfo();

								   	$header_fonts       = (get_theme_mod('tesseract_header_logo_text_fonts')) ? get_theme_mod('tesseract_header_logo_text_fonts') : 'Pacifico';
								    $header_font_styles = (get_theme_mod('tesseract_header_logo_text_fonts_styles')) ? get_theme_mod('tesseract_header_logo_text_fonts_styles') : 'normal';
								    $header_font_weight = (get_theme_mod('tesseract_header_logo_text_fonts_weights')) ? get_theme_mod('tesseract_header_logo_text_fonts_weights') : '900';

									$logoImg = ( $footerLogoEnable && $footerLogo ) ? $footerLogo : $headerLogo;
									if ( $header_logo_choice == 'image' && $logoImg ) : ?>
										<div class="site-branding">
											<h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>
										</div>
									<?php else : ?>
									<div class="site-branding">

										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

					                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
					                    <?php echo $header_text; ?>
					                  </span>

					                  </a></h1>
									</div>
									<?php endif;
						break;

					// Step 6 -> menu
					case 'menu':
					$footer_right_menu  = (get_theme_mod("tesseract_footer_right_menu_select")) ? get_theme_mod("tesseract_footer_right_menu_select") : 'none';
						if($footer_right_menu != 'none')
						{
						?>

							<nav id="footer-right-menu" role="navigation">
								<?php //if ( function_exists( 'tesseract_output_menu' ) ) : ?>
									<?php tesseract_output_menu( FALSE, FALSE, 'secondary_right', 1 ); ?>
								<?php //else: ?>
									<!--Using the menu option requires Tesseract version 2 or newer.-->
								<?php //endif; ?>
							</nav>
						<?php } ?>

				<?php } ?>

			</div>

		<?php elseif ( !$content && $content_default_html ) : ?>

			<div id="footer-banner-right" class="banner-right content-notset defbtn-isset">

				<div id="footer-button-container">
					<div id="footer-button-container-inner">
						<?php echo $content_default_html; ?>
					</div>
				</div>

			</div>

		<?php else : ?>
			<div id="footer-banner-right" class="banner-right content-notset defbtn-notset">
				<div id="footer-button-container">
					<div id="footer-button-container-inner">
						<strong>Theme by <a href="http://tesseracttheme.com">Tesseract</a></strong>
                        &nbsp;&nbsp;
                        <strong>
                        	<a href="http://tesseracttheme.com">
                        		<img src="//tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" />
                            </a>
                        </strong>
					</div>
				</div>
			</div>
          <?php endif;

	}

	add_action( 'tesseract_footer_branding', 'tesseract_remove_branding', 9 );
	add_action( 'tesseract_footer_branding', 'tesseract_replace_branding', 10 );

}

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tesseract_Remove_Branding' ) ) :

/**
 * WooCommerce Colors main class.
 */
class Tesseract_Remove_Branding {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin.
	 */
	private function __construct() {
		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'after_setup_theme', array( $this, 'tesseract_remove_branding_setup' ), 100 );

		// Checks with WooCommerce is installed.
		if ( wp_get_theme() == 'TESSERACT' || wp_get_theme() == 'Tesseract' || wp_get_theme() == 'Tesseract(Pro)' || wp_get_theme() == 'Tesseract(Free)' || wp_get_theme() == 'Tesseract(Designer)' ) {
			$this->includes();
		} else {
			add_action( 'admin_notices', array( $this, 'tesseract_theme_missing_notice' ) );
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Get assets url.
	 *
	 * @return string
	 */
	public static function get_assets_url() {
		return plugins_url( 'assets/', __FILE__ );
	}

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'tesseract-remove-branding' );

		load_textdomain( 'tesseract-remove-branding', trailingslashit( WP_LANG_DIR ) . 'tesseract-remove-branding/tesseract-remove-branding-' . $locale . '.mo' );
		load_plugin_textdomain( 'tesseract-remove-branding', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Add new menu location.
	 */
	public function tesseract_remove_branding_setup() {
		register_nav_menus( array(
			'secondary_right' => __( 'Footer Right', 'tesseract' )
		) );
	}

	/**
	 * Includes.
	 */
	private function includes() {
		include_once 'includes/class-trb-customizer.php';
	}

	/**
	 * Get the plugin options.
	 *
	 * @param  array $colors
	 *
	 * @return array
	 */
	public static function get_options( $colors ) {

	}

	/**
	 * Install metfod.
	 */
	public static function install() {
		
	}

	/**
	 * WooCommerce fallback notice.
	 *
	 * @return string
	 */
	public function tesseract_theme_missing_notice() {
		echo '<div class="error"><p>' . sprintf( __( 'Tesseract Remove Branding depends on the %s to work!', 'tesseract-remove-branding' ), '<a href="https://s3.amazonaws.com/tesseracttheme/TESSERACT.zip" target="_blank">' . __( 'Tesseract theme', 'tesseract-remove-branding' ) . '</a>' ) . '</p></div>';
	}
}

// Plugin install.
register_activation_hook( __FILE__, array( 'Tesseract_Remove_Branding', 'install' ) );

add_action( 'plugins_loaded', array( 'Tesseract_Remove_Branding', 'get_instance' ) );

endif;


require 'vendor/plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://s3.amazonaws.com/tesseracttheme/version_unbranding.json',
   __FILE__
);