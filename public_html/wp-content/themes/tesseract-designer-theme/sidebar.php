<?php

/**

 * The sidebar containing the main widget area.

 *

 * @package Tesseract

 */






if ( is_plugin_active('woocommerce/woocommerce.php') ) {

	

	$layout_loop = (get_theme_mod('tesseract_woocommerce_loop_layout')) ? get_theme_mod('tesseract_woocommerce_loop_layout') : 'four-column';

	$layout_product = (get_theme_mod('tesseract_woocommerce_product_layout')) ? get_theme_mod('tesseract_woocommerce_product_layout') : 'fullwidth';

	$layout_default = get_theme_mod('tesseract_woocommerce_default_layout');	

	//echo "------------------------------------------------------------------------------->".$layout_product;
	

	if ( ( function_exists( 'WC' ) && (is_shop() || is_product_category() || is_product_tag()) ) && ( ($layout_loop == 'sidebar-right') || ($layout_loop == 'one-columnlistright') || ($layout_loop == 'two-columnlistright') || ($layout_loop == 'three-columnlistright') || ($layout_loop == 'four-columnlistright') || ($layout_loop == 'five-columnlistright') ) ) { 	

		$sidebarClass = 'woo-archive woo-right-sidebar'; 

	} else if ( ( function_exists( 'WC' ) && (is_shop() || is_product_category() || is_product_tag()) ) && ( ($layout_loop == 'one-columnlistleft') || ($layout_loop == 'two-columnlistleft') || ($layout_loop == 'three-columnlistleft') || ($layout_loop == 'four-columnlistleft') || ($layout_loop == 'five-columnlistleft') ) ) {

		$sidebarClass = 'sidebar-default';

	} else if ( is_product() && $layout_product == 'sidebar-right' ) {

		$sidebarClass = 'woo-product woo-right-sidebar';

	} else {

		$sidebarClass = 'sidebar-default';

	}

} 
//echo "-----------------------------------------------------------> ".$sidebarClass;
global $wp_query;
if($wp_query->query['pagename']=='blog'){
	if ( is_author() || is_category() || is_single() || is_tag() || 'post' == get_post_type()) { 
		$sidebarClass =  (get_theme_mod('tesseract_blog_post_layout')) ? get_theme_mod('tesseract_blog_post_layout') : 'sidebar-left';
	}
	if($sidebarClass == 'sidebar-left')
	{
		$sidebarClass = 'sidebar-default';
	}
	//echo "string";
}
//echo '>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>'.get_post_type()."  ".get_post_meta( get_the_ID(), '_wp_page_template', true ) ;
if(get_post_type() == 'page')
{
	if(get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'default')
	{
		$extraClass='default-left';
	}
	elseif( get_post_meta( get_the_ID(), '_wp_page_template', true ) =='page-rightsidebar.php')
	{
		$extraClass = 'default-right';
	}
	else
	{
		$extraClass='';
	}
}
else
{
	$extraClass='';
}
if(get_post_type() == 'post')
{
	$bplayout = (get_theme_mod('tesseract_blog_post_layout')) ? get_theme_mod('tesseract_blog_post_layout') : 'sidebar-right';

 		//echo "--------------------------------".$bplayout;

		switch ( $bplayout ) {

			/*case 'fullwidth':

				$blog_cls = 'full-width-page no-sidebar';



				break;*/

			case 'sidebar-right':

				$blog_cls = 'content-area sidebar-right-alt';



				break;

			case 'sidebar-left':
				$blog_cls ='woo-left-sdebar';
				break;

			default:

				// sidebar-left

				$blog_cls = 'woo-left-sdebar';

		}


}

?>



<div id="secondary" class="<?php echo $extraClass; ?> widget-area sidebar-default <?php if($sidebarClass=='sidebar-default' && get_post_type() != 'post'){ echo 'woo-left-sdebar '; }else{ echo $blog_cls;}?>" role="complementary" <?php if($sidebarClass=='sidebar-default'){  echo 'style="float:left;"';}else{ echo 'style="float:right;"';  }?>>

	<?php  dynamic_sidebar( 'sidebar-right-tesseract' ); ?>

</div><!-- #secondary -->
<?php /*if('post' == get_post_type()){?>
<style>
#primary{
	float: left;
}
</style>
<?php }*/ ?>
