<?php

/**

 * The template for displaying 404 pages (not found).

 *

 * @package Tesseract

 */



get_header(); ?>

<?php $tesheadr_layout = (get_theme_mod('tesseract_header_layout_setting')) ? get_theme_mod('tesseract_header_layout_setting') :'defaultlayout' ; 
		if($tesheadr_layout == 'vertical-left' || $tesheadr_layout=='vertical-right')
		{
			$cnt_cls = 'ver-menu-exst';
		}
		else
		{
			$cnt_cls = '';
		}
	?>

	<div id="primary" class="<?php echo $cnt_cls; ?> full-width-page">

		<main id="main" class="site-main" role="main">



			<section class="error-404 not-found">

				<header class="page-header">

					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'tesseract' ); ?></h1>

				</header><!-- .page-header -->



				<div class="page-content">

					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'tesseract' ); ?></p>



					<?php get_search_form(); ?>



				</div><!-- .page-content -->

			</section><!-- .error-404 -->



		</main><!-- #main -->

	</div><!-- #primary -->



<?php //get_footer(); ?>

<?php get_footer('custes'); ?>