<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the #content div and all content after

 *

 * @package Tesseract

 */

?>

    <?php 

	$bodyClass = ( version_compare($wp_version, '4.0.0', '>') && is_customize_preview() ) ? 'backend' : 'frontend';

	

	$opValue1 = get_theme_mod('tesseract_footer_colors_bck_color_opacity');

    $footer_bckOpacity = is_numeric($opValue1) ? TRUE : FALSE;

    if ( is_front_page() && ( $footer_bckOpacity && ( intval($opValue1) < 100 ) ) ) $bodyClass .= ' transparent-footer';





	$footpos = ( is_front_page() && ( $footer_bckOpacity && ( intval($opValue1) < 100 ) ) ) ? 'pos-absolute' : 'pos-relative'; 

	?>
	<?php 
	$tesseract_footer_upper_color = (get_theme_mod('tesseract_footer_upper_color')) ? get_theme_mod('tesseract_footer_upper_color') : '#000000';
	$tesseract_footer_upper_text_color = (get_theme_mod('tesseract_footer_upper_text_color')) ? get_theme_mod('tesseract_footer_upper_text_color') : '#ffffff';
	$tesseract_footer_upper_separator = (get_theme_mod('tesseract_footer_upper_separator')) ? get_theme_mod('tesseract_footer_upper_separator') : 'disable';
	//echo ">>>>>".$tesseract_footer_upper_separator;
	$footer_upper_section_choice = (get_theme_mod('footer_upper_section_choice')) ? get_theme_mod('footer_upper_section_choice') : 'disable';
	$tesheadr_layout = (get_theme_mod('tesseract_header_layout_setting')) ? get_theme_mod('tesseract_header_layout_setting') :'defaultlayout' ;
	if( $tesheadr_layout=='vertical-left' || $tesheadr_layout=='vertical-right' || is_plugin_active('tesseract-footer-content-builder-plugin/tesseract-footer-content-builder-plugin.php') )
	{
		$footer_upper_section_choice = 'disable';
	}

?>

	</div><!-- #content -->
	<?php if($footer_upper_section_choice != 'disable'){ ?>
	<div class="mid-footere <?php if($tesseract_footer_upper_separator=='enable'){echo 'separator';}?>" style="background-color:<?php echo $tesseract_footer_upper_color; ?>; color: <?php echo $tesseract_footer_upper_text_color; ?>;" >
	    <div class="fot-wrap">
	    
		    <div class="foot-mid-inner">
		    
			    <div class="footer-single fs-1">
			    	<?php $sec_1 = (get_theme_mod( 'footer_upper_section_1' )) ? get_theme_mod( 'footer_upper_section_1' ) : 'html'; ?>
					<?php footer_upper_content_section(1, $sec_1); ?>
			    </div>
			    
			    <div class="footer-single fs-2">
			    	<?php $sec_2 = (get_theme_mod( 'footer_upper_section_2' )) ? get_theme_mod( 'footer_upper_section_2' ) : 'recent_post'; ?>
					<?php footer_upper_content_section(2, $sec_2); ?>
				</div>
					    
				<div class="footer-single fs-3">
					<?php $sec_3 = (get_theme_mod( 'footer_upper_section_3' )) ? get_theme_mod( 'footer_upper_section_3' ) : 'socialmenu'; ?>
					<?php footer_upper_content_section(3, $sec_3); ?>
				</div>
					    
			    <div class="footer-single fs-4">
			    	<?php $sec_4 = (get_theme_mod( 'footer_upper_section_4' )) ? get_theme_mod( 'footer_upper_section_4' ) : 'menu'; ?>
					<?php footer_upper_content_section(4, $sec_4); ?>
			    </div>
		    
		    </div>
	    
		</div>	
	</div>
	<?php } ?>
	<style type="text/css">
		.footer-single h2 {
		    color: <?php echo $tesseract_footer_upper_text_color; ?> ;
		    display: inline-block;
		    font-size: 14px;
		    margin-bottom: 30px;
		    padding: 0 !important;
		    text-transform: uppercase;
		    width: 100%;
		}
		.footer-single .entry-title a {
		    border-bottom: 1px solid <?php echo $tesseract_footer_upper_text_color; ?>;
		    color: <?php echo $tesseract_footer_upper_text_color; ?>;
		}
		.footer-single p a {
		    color: <?php echo $tesseract_footer_upper_text_color; ?>;
		}

	</style>
<?php $align = get_theme_mod('tesseract_footer_content_align_option') ? get_theme_mod('tesseract_footer_content_align_option') : 'horizantal'; ?>
<?php if( basename( get_page_template() ) != 'landing-page.php' && !is_plugin_active('tesseract-footer-content-builder-plugin/tesseract-footer-content-builder-plugin.php')){ ?>

	<footer id="colophon_TesseractTheme" class="<?php echo $align; ?>-align site-footer <?php echo $footpos; ?>" role="contentinfo">



		<?php $additional = get_theme_mod('tesseract_footer_additional_content') ? true : false;



        $menuClass = 'only-menu';

        if ( $additional ) $menuClass = 'is-additional';



        $addcontent_hml = (get_theme_mod('tesseract_footer_additional_content')) ? get_theme_mod('tesseract_footer_additional_content') : 'nothing';


		$footerNav_class = ( is_string($addcontent_hml) && ( $addcontent_hml !== 'nothing' ) ) ? 'is-before' : 'none-before';



		$content = get_theme_mod('tesseract_footer_right');

		$content_default_button = get_theme_mod('tesseract_footer_right_content_if_button');



		$footerWidthClass = ( get_theme_mod('tesseract_footer_width') == 'fullwidth' ) ? ' footer-fullwidth' : ' footer-autowidth';



		if ( defined('TESSERACT_BRANDING_EXIST') ) {

			if ( $content ) :

				$rightContentClass = ' mother-content-' . $content;

			elseif ( !$content && $content_default_button ) :

				$rightContentClass = ' mother-content-notset mother-defbtn-isset';

			else:

				$rightContentClass = ' mother-content-notset mother-defbtn-isset';

			endif;

		} else {

			$rightContentClass = ' mother-branding';

		} ?>




    	<?php if ( class_exists( 'Tesseract_Remove_Branding' ) ){ ?>

		<div id="footer-banner" class="cf<?php echo ' menu-' . $menuClass; echo $rightContentClass . $footerWidthClass; ?> with_unbrandinglogo">

			<?php } else { ?>

	    	<div id="footer-banner" class="cf<?php echo ' menu-' . $menuClass; echo $rightContentClass . $footerWidthClass; ?>">

			<?php } ?>

		    <?php //if($footerNav_class != 'none-before'){ ?>
            
		             <div id="horizontal-menu-wrap" class="<?php echo $menuClass . ' ' . $footerNav_class; ?>">

		                <?php 

		                if ( is_string($addcontent_hml) && ( $addcontent_hml !== 'nothing' ) ) : ?>

		                	
		                    <div id="horizontal-menu-before" class="switch thm-left-left"><?php tesseract_horizontal_footer_menu_additional_content( $addcontent_hml ); ?></div>



		                <?php endif; //EOF left menu - IS before content ?>

		                <?php $menuSelected = (get_theme_mod('tesseract_footer_menu_select')) ? get_theme_mod('tesseract_footer_menu_select') : 'none';
	

						if ( $menuSelected !== 'none' && $addcontent_hml == 'menu' ) : ?>

                           
							<div class="mobile-menu-collaps-button foot-collaps" id="left-collaps">MENU <i class="fa fa-bars"></i></div>

							<section id="footer-horizontal-menu" class="menu-left cf <?php echo $footerNav_class; ?>"><?php tesseract_output_menu( FALSE, FALSE, 'secondary', 1 ); ?></section>

		              	<?php endif; ?>

		        	</div><!-- EOF horizontal-menu-wrap -->
		    <?php //} ?>



            <?php tesseract_footer_branding(); ?>

			

			<?php $my_unbrandinglogo = get_theme_mod('tesseract_footer_content_if_unbranding'); ?>

            

			<?php if (class_exists( 'Tesseract_Remove_Branding' ) ){ 				

			if(!empty($my_unbrandinglogo)){ 	?>

				<div class="footer-extreme-right">

				<?php echo $my_unbrandinglogo; ?>

				</div>

			<?php }else{ ?>					

                  <style>.with_unbrandinglogo #footer-banner-right{width:40% !important;}

				  #footer-banner-right.banner-right #footer-button-container{ width:100% !important; text-align:right;}</style>  

			<?php }			

			} ?>

            

      	</div><!-- EOF footer-banner -->



	</footer><!-- #colophon -->
<?php }else{
	do_action('tes_footer_content_builder');
 } ?>
</div><!-- #page -->
<?php
	$hover_color = (get_theme_mod('tesseract_woocommerce_cart_button_hover')) ? get_theme_mod('tesseract_woocommerce_cart_button_hover') : '#000000';
	$loader_bgcolor = (get_theme_mod('tesseract_woocommerce_buttonbgcolor')) ? get_theme_mod('tesseract_woocommerce_buttonbgcolor') : '#0db6bc';
	$loader_brderradius 	= get_theme_mod('tesseract_woocommerce_button_radius');
	$loader_text_color = (get_theme_mod('tesseract_woocommerce_cart_button_text')) ? get_theme_mod('tesseract_woocommerce_cart_button_text') : '#000000';

?>
<style type="text/css">
#inifiniteLoader{
	background: <?php echo $loader_bgcolor;?> !important;
	border-radius: <?php echo $loader_brderradius;?>px !important;
	color:  <?php echo $loader_text_color;?> !important;
}
#inifiniteLoader:hover{
	background-color: <?php echo $hover_color; ?> !important;
	color:  #fff !important;
}
</style>
<style>
.add-cart-button-hover:hover{ background-color: <?php echo $hover_color; ?> !important; }
.single_add_to_cart_button:hover{ background-color: <?php echo $hover_color; ?> !important; }
.add_to_cart_button:hover{ background-color: <?php echo $hover_color; ?> !important; }
.product_type_external:hover{ background-color: <?php echo $hover_color; ?> !important; }
</style>
<?php
	$tesseract_woocommerce_button_text_color = (get_theme_mod('tesseract_woocommerce_button_text_color')) ? get_theme_mod('tesseract_woocommerce_button_text_color') : '#ffffff';

    $tesseract_woocommerce_button_hover_color = (get_theme_mod('tesseract_woocommerce_button_hover_color')) ? get_theme_mod('tesseract_woocommerce_button_hover_color') : '#1581B2';

    $tesseract_woocommerce_button_backgroud = (get_theme_mod('tesseract_woocommerce_button_backgroud')) ? get_theme_mod('tesseract_woocommerce_button_backgroud') : '#49B9E6';
?>
<style>
	.tesseract-woo-button{
		background-color: <?php echo $tesseract_woocommerce_button_backgroud; ?>!important;
		color: <?php echo $tesseract_woocommerce_button_text_color; ?>!important;
	}
	.tesseract-woo-button:hover{
		background-color: <?php echo $tesseract_woocommerce_button_hover_color; ?>!important;
	}
</style>
<script type="text/javascript">

	jQuery(document).on('change',"#fl-builder-settings-section-subheading_typo .fl-font-field-font", function(){
	//jQuery("#fl-builder-settings-section-subheading_typo").find(".fl-font-field-font").change(function(){
		//alert(123);
 		var fontvalue = jQuery(this).val();
 		console.log('fontvalue ', fontvalue);
 		if(fontvalue)
		{
			var link = document.createElement('link');
		    link.id = 'tesseract-sub-heading-preview';
		    link.rel = 'stylesheet';
		    link.href = '//fonts.googleapis.com/css?family='+fontvalue;
		    document.head.appendChild(link);
		    jQuery('.wpsm-heading-wrap .wpsm-subheading .wpsm-subheading-text').css('font-family',fontvalue);
		}
	});



</script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/style-woo.css';?>"></link>

<?php wp_footer(); ?>

<script>
var maxheight = jQuery('#footer-banner').height();
jQuery(document).ready(function() {
 jQuery('#horizontal-menu-wrap, #footer-banner-right, #footer-banner-centre').css('min-height', maxheight)   
});
</script>
<?php 

$mobmenu_show = get_theme_mod('tesseract_mobmenu_opener_mob') ? get_theme_mod('tesseract_mobmenu_opener_mob') : 'mob-showit';

$mobmenu_bckColor = get_theme_mod('tesseract_mobmenu_background_color') ? get_theme_mod('tesseract_mobmenu_background_color') : '#336ca6';
$mobmenu_linkColor = get_theme_mod('tesseract_mobmenu_link_color') ? get_theme_mod('tesseract_mobmenu_link_color') : '#fff';
$mobmenu_xColor = get_theme_mod('tesseract_mobmenu_x_color') ? get_theme_mod('tesseract_mobmenu_x_color') : '#fff';
$mobmenu_x_bck_Color = get_theme_mod('tesseract_mobmenu_x_bck_color') ? get_theme_mod('tesseract_mobmenu_x_bck_color') : '#000';

$mobmenu_fontsize = get_theme_mod('tesseract_mobile_menu_font_size') ? get_theme_mod('tesseract_mobile_menu_font_size') : 22;


if($mobmenu_show == 'mob-showit'){
	$dis_style = 'block';
}
else{
	$dis_style = 'none';
}

if(is_plugin_active('elementor/elementor.php')){
?>
<style>
@media screen and (max-width:1400px) {
	.site-info, .site-content{
		height: inherit !important;
	}
}
</style>



<?php
}
?>
<style>
.woocommerce-checkout-review-order-table tr.fee th{ width:50%; }
.woocommerce-checkout-review-order-table tr.fee td{ text-align: right; }
@media screen and (max-width:1023px) {
	#masthead_TesseractTheme #site-banner{ display: <?php echo $dis_style; ?>; }
	#masthead_TesseractTheme.mob-view #site-banner{ background-color:<?php echo $mobmenu_bckColor; ?> ;}
	.top-navigation .nav-menu.showMenus{ background-color:<?php echo $mobmenu_bckColor; ?> !important;}
	.mobile-menu-collaps-button{ 
		background-color:<?php echo $mobmenu_bckColor; ?> !important;
	}

	#masthead_TesseractTheme.mob-view #site-banner ul.sub-menu li a{ background-color:<?php echo $mobmenu_bckColor; ?> !important;}
	#masthead_TesseractTheme.mob-view #site-banner nav ul li a{ color:<?php echo $mobmenu_linkColor; ?> !important;}
	#colophon_TesseractTheme a { color:<?php echo $mobmenu_linkColor; ?> !important; }
	.mobile-menu-collaps-button.close-btns{ 
		background-color:<?php echo $mobmenu_x_bck_Color; ?> !important;
		color:<?php echo $mobmenu_xColor; ?> !important;
	}
	.submenuu-arrrow i{
		color: <?php echo $mobmenu_linkColor; ?> !important;
	}

	#site-navigation ul li > a{
		font-size: <?php echo $mobmenu_fontsize; ?>px !important;
		color: <?php echo $mobmenu_linkColor; ?> !important;
	}
}

</style>
<script>

var $ =jQuery.noConflict();
jQuery("#left-collaps").click(function(){
    jQuery(".menu-left ul").slideToggle();
});

jQuery("#cetre-collaps").click(function(){
    jQuery(".menu-centre ul").slideToggle();
});

jQuery("#right-collaps").click(function(){
    jQuery(".menu-right ul").slideToggle();
});

</script>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
}
</script>



<script>
function openNav() {
    document.getElementById("menu-top").style.width = "100%";
}

function closeNav() {
    document.getElementById("menu-top").style.width = "0";
}
</script>
    
</body>

</html>

