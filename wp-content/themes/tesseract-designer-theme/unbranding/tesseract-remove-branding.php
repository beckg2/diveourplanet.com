<?php
class Tesseract_Remove_Branding {
	public static $instance = null;

	const VERSION = '1.0.0';

	public function __construct() {
		add_action( 'init', array( $this, 'get_instance' ) );
		add_action( 'after_setup_theme', array( $this, 'tesseract_remove_branding_setup' ), 100 );
		include_once 'includes/class-trb-customizer.php';
	}
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	public static function get_assets_url() {
		return '/assets/';
	}
	public function tesseract_remove_branding_setup() {
		register_nav_menus( array(
			'secondary_right' => __( 'Footer Right', 'tesseract' )
		) );
	}

}

function tesseract_remove_branding() {
	remove_action( 'tesseract_footer_branding', 'tesseract_footer_branding_output', 10 );
}

function tesseract_replace_branding()
{
	$default_html = '<strong>Theme by <a href="http://tesseracttheme.com">Tesseract</a></strong>
                        &nbsp;&nbsp;
                        <strong>
                        	<a href="http://tesseracttheme.com">
                        		<img src="http://tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" />
                            </a>
                        </strong>';
	$content = get_theme_mod('tesseract_footer_right_content');
	$content_default_html = (get_theme_mod('tesseract_footer_right_content_html')) ? get_theme_mod('tesseract_footer_right_content_html') : $default_html ;
	if ( $content ) : ?>
		<div id="footer-banner-right" class="banner-right <?php echo 'content-' . $content; ?>">
			<?php switch( $content ) {
				default:
					break;
				case 'html':
					$code = do_shortcode( $content_default_html );
					echo '<div id="footer-button-container"><div id="footer-button-container-inner">' . $code . '</div></div>';

					break;
				case 'social': ?>
						<ul class="hr-social">
							<?php 
								$bln_tesseract_social_account_right = false;
								
								for ( $i = 1; $i <= 10; $i++ ) {
									$account_number = sprintf( '%02d', $i );
									$sn_img = get_theme_mod( "tesseract_social_account{$account_number}_image" );
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
							?>
						</ul>

					<?php break;
				case 'search':
					get_search_form();
					break;
				case 'logo':
									$headerLogo = get_theme_mod('tesseract_header_logo_image');

									$footerLogo = get_theme_mod('tesseract_footer_logo_image');

									$footerLogoEnable = ( get_theme_mod('tesseract_footer_logo_enable') == 'yes' ) ? true : false;

									$header_logo_choice = (get_theme_mod('tesseract_header_logo_type')) ? get_theme_mod('tesseract_header_logo_type') : 'image';

								    $header_text        = (get_theme_mod('tesseract_header_logo_text')) ? get_theme_mod('tesseract_header_logo_text') : get_bloginfo();

								   	$header_fonts       = (get_theme_mod('tesseract_header_logo_text_fonts')) ? get_theme_mod('tesseract_header_logo_text_fonts') : 'Open Sans';
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
				case 'menu'; ?>
                 <div class="mobile-menu-collaps-button foot-collaps2" id="right-collaps">MENU <i class="fa fa-bars"></i></div>
					<nav id="footer-right-menu" role="navigation" class="menu-right">
						<?php if ( function_exists( 'tesseract_output_menu' ) ) : ?>
							<?php tesseract_output_menu( FALSE, FALSE, 'secondary_right', 1 ); ?>
						<?php else: ?>
							Using the menu option requires Tesseract version 2 or newer.
						<?php endif; ?>
					</nav>
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
}new Tesseract_Remove_Branding();

add_action( 'tesseract_footer_branding', 'tesseract_remove_branding', 9 );
add_action( 'tesseract_footer_branding', 'tesseract_replace_branding', 10 );






