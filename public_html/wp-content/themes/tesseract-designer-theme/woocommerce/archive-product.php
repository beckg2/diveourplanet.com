<?php

/**

 * The Template for displaying product archives, including the main shop page which is a post type archive.

 *

 * Override this template by copying it to yourtheme/woocommerce/archive-product.php

 *

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     100.100.100

 */



$layout = (get_theme_mod('tesseract_woocommerce_loop_layout')) ? get_theme_mod('tesseract_woocommerce_loop_layout') : 'four-column';



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


get_header( 'shop' ); ?>
<?php $wooBreadcrumb = (get_theme_mod('tesseract_woocommerce_product_breadcrumb')) ? get_theme_mod('tesseract_woocommerce_product_breadcrumb') : 'showbreadcrumb'; ?>
	<header class="entry-header page-header">
		<div class="row">
		    <div class="twelve columns">
		    	<div class="table">
			        <div class="cell">
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<h1><?php woocommerce_page_title(); ?></h1>
							<?php //woocommerce_breadcrumb(); ?>
						<?php endif; ?>
						<?php if( $wooBreadcrumb == 'showbreadcrumb' ) { ?>
							<ul class="breadcrumbs">
				    			<li><a href="<?php echo site_url(); ?>" title="Home">Home</a></li>
				    			<li><span><?php woocommerce_page_title(); ?></span></li>
				    		</ul>
						<?php } ?>
					</div>
					<div class="cell">
						<?php woocommerce_catalog_ordering(); ?>
					</div>
				</div>
			</div>
		</div>
    </header>


	<?php

		/**

		 * woocommerce_before_main_content hook

		 *

		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)

		 * @hooked woocommerce_breadcrumb - 20

		 */

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

		do_action( 'woocommerce_before_main_content' ); 

	?>

	

	



		<?php do_action( 'woocommerce_archive_description' ); ?>



		<?php if ( have_posts() ) : ?>


			
			<?php

				/**

				 * woocommerce_before_shop_loop hook

				 *

				 * @hooked woocommerce_result_count - 20

				 * @hooked woocommerce_catalog_ordering - 30

				 */
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
				//do_action( 'woocommerce_before_shop_loop' );

			?>



			<?php woocommerce_product_loop_start(); ?>



				<?php woocommerce_product_subcategories(); ?>



				<?php while ( have_posts() ) : the_post(); ?>


					<?php wc_get_template_part( 'content', 'product' ); ?>



				<?php endwhile; // end of the loop. ?>



			<?php woocommerce_product_loop_end(); ?>



			<?php

				/**

				 * woocommerce_after_shop_loop hook

				 *

				 * @hooked woocommerce_pagination - 10

				 */

				//do_action( 'woocommerce_after_shop_loop' );

			?>
			<?php $loader_size = get_theme_mod('tesseract_woocommerce_button_size'); ?>

          <div class="loading">
			<a id="inifiniteLoader" class="woobutton-<?php echo $loader_size; ?>">More Products<img src="<?php bloginfo('template_directory'); ?>/images/reload.svg" /> </a>
			<input type="hidden" id="product_count_page_list" value="2" />
			<?php global $wp_query; ?>
			<input type="hidden" id="max_num_page" value="<?php echo $wp_query->max_num_pages; ?>" />
          </div>




		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>



			<?php wc_get_template( 'loop/no-products-found.php' ); ?>



		<?php endif; ?>



	<?php

		/**

		 * woocommerce_after_main_content hook

		 *

		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)

		 */

		do_action( 'woocommerce_after_main_content' );

	?>



	<?php

		/**

		 * woocommerce_sidebar hook

		 *

		 * @hooked woocommerce_get_sidebar - 10

		 */

		if ( ( $layout == 'sidebar-left' ) || ( $layout == 'sidebar-right' ) || ( $layout == 'one-columnlistleft' ) || ( $layout == 'one-columnlistright' ) || ( $layout == 'two-columnlistleft' ) || ( $layout == 'two-columnlistright' ) || ( $layout == 'three-columnlistleft' ) || ( $layout == 'three-columnlistright' ) || ( $layout == 'four-columnlistleft' ) || ( $layout == 'four-columnlistright' ) || ( $layout == 'five-columnlistleft' ) || ( $layout == 'five-columnlistright' ) )

			do_action( 'woocommerce_sidebar' );

	?>




<?php //get_footer( 'shop' ); ?>

<?php get_footer('custes'); ?>