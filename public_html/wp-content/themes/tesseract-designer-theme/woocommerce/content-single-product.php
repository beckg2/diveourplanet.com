<?php

/**

 * The template for displaying product content in the single-product.php template

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.

 *

 * HOWEVER, on occasion WooCommerce will need to update template files and you

 * (the theme developer) will need to copy the new files to your theme to

 * maintain compatibility. We try to do this as little as possible, but it does

 * happen. When this occurs the version of the template file will be bumped and

 * the readme will list any important changes.

 *

 * @see 	    https://docs.woothemes.com/document/template-structure/

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     100.100.100

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



?>



<?php

	/**

	 * woocommerce_before_single_product hook.

	 *

	 * @hooked wc_print_notices - 10

	 */

	 do_action( 'woocommerce_before_single_product' );



	 if ( post_password_required() ) {

	 	echo get_the_password_form();

	 	return;

	 }

?>



<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="image-sale-flash">
		<?php
		    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		    global $post, $product;
		    if ( ! $product->is_in_stock() ) return;
		    $sale_price = get_post_meta( $product->id, '_price', true);
		    $regular_price = get_post_meta( $product->id, '_regular_price', true);
		    if (empty($regular_price) && !$product->is_type('external')){ //then this is a variable product
		        $available_variations = $product->get_available_variations();
		        $variation_id=$available_variations[0]['variation_id'];
		        $variation= new WC_Product_Variation( $variation_id );
		        $regular_price = $variation ->regular_price;
		        $sale_price = $variation ->sale_price;
		    }
		    if($regular_price != 0){
		    	$sale = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
		    }
		    
		?>
		<?php if ( !empty( $regular_price ) && !empty( $sale_price ) && $regular_price > $sale_price ) : ?>
		    <?php 
		    	$sale_tag_bck  = (get_theme_mod('tesseract_woocommerce_salebgcolor')) ? get_theme_mod('tesseract_woocommerce_salebgcolor') : '#77a464';
		    	$sale_tag_txt  = (get_theme_mod('tesseract_woocommerce_saletextcolor')) ? get_theme_mod('tesseract_woocommerce_saletextcolor') : '#fff';

		    	echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale" style="background-color:'.$sale_tag_bck.'; color:'.$sale_tag_txt.';">Sale</span>', $post, $product );
		    ?>
		<?php endif; ?>

		<?php

			/**

			 * woocommerce_before_single_product_summary hook.

			 *

			 * @hooked woocommerce_show_product_sale_flash - 10

			 * @hooked woocommerce_show_product_images - 20

			 */
			remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash');

			do_action( 'woocommerce_before_single_product_summary' );

		?>
	</div>



	<div class="summary entry-summary">



		<?php

			/**

			 * woocommerce_single_product_summary hook.

			 *

			 * @hooked woocommerce_template_single_title - 5

			 * @hooked woocommerce_template_single_rating - 10

			 * @hooked woocommerce_template_single_price - 10

			 * @hooked woocommerce_template_single_excerpt - 20

			 * @hooked woocommerce_template_single_add_to_cart - 30

			 * @hooked woocommerce_template_single_meta - 40

			 * @hooked woocommerce_template_single_sharing - 50

			 */

			do_action( 'woocommerce_single_product_summary' );

			

		?>



	</div><!-- .summary -->

<?php do_action( 'woocommerce_after_single_product_summary' ); ?>

	<?php

		/**

		 * woocommerce_after_single_product_summary hook.

		 *

		 * @hooked woocommerce_output_product_data_tabs - 10

		 * @hooked woocommerce_upsell_display - 15

		 * @hooked woocommerce_output_related_products - 20

		 */

		//do_action( 'woocommerce_after_single_product_summary' );

	?>



	<meta itemprop="url" content="<?php the_permalink(); ?>" />



</div><!-- #product-<?php the_ID(); ?> -->



<?php do_action( 'woocommerce_after_single_product' ); ?>

