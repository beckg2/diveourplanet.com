<?php

/**

 * The Template for displaying all single products.

 *

 * Override this template by copying it to yourtheme/woocommerce/single-product.php

 *

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     100.100.100

 */

 

$layout = get_theme_mod('tesseract_woocommerce_product_layout'); 



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



get_header( 'shop' ); ?>

<header class="page-header bread-right-title-left">
				<div class="row">
				    <div class="twelve columns">
				      	<div class="table">
					        <div class="cell">
					          <h1><?php the_title(); ?></h1>
					          <ul class="breadcrumbs">
									    <li><a href="<?php echo site_url(); ?>" title="">Home</a></li>
									  	<li><span><?php the_title(); ?></span></li>
									</ul>
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

	?>

	<?php 

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

		do_action( 'woocommerce_before_main_content' );

	     ?>

		<?php $wooBreadcrumb = (get_theme_mod('tesseract_woocommerce_product_breadcrumb')) ? get_theme_mod('tesseract_woocommerce_product_breadcrumb') : 'showbreadcrumb'; ?>

		<?php if( $wooBreadcrumb == 'showbreadcrumb' ) { ?>

		<?php //do_action( 'woocommerce_before_main_content' ); ?>

		<?php //woocommerce_breadcrumb(); ?>

		<?php } ?>

		



		<?php while ( have_posts() ) : the_post(); ?>



			<?php wc_get_template_part( 'content', 'single-product' ); ?>



		<?php endwhile; // end of the loop. ?>



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

		if ( ( $layout == 'sidebar-left' ) || ( $layout == 'sidebar-right' )  ) 

			do_action( 'woocommerce_sidebar' );

	?>



<?php //get_footer( 'shop' ); ?>

<?php get_footer('custes'); ?>