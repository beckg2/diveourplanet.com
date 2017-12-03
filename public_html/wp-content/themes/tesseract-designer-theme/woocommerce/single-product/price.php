<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * 
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 100.100.100
 */

global $product;
?>
<p class="price">
<?php
	if($product->is_type('simple') || $product->is_type('variable')){
		$p_obj = new Tesseract_Woo;
		$p_obj->tesseract_price_html($product);
	}
	else
	{
		echo $product->get_price_html();
	}
?>
</p>