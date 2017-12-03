<?php

/**

 * Template Name: Right Sidebar 

 *

 * @package Tesseract

 */



get_header(); 



?>
	<?php if ( has_post_thumbnail() ) {

		

        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tesseract-large' ); ?>

        <div class="entry-background" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>)">

            <?php if ( my_theme_show_page_header() ) : ?>

                <header class="entry-header page-header">

                    <?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <div class="row">
					    <div class="twelve columns">
					    	<div class="table">
						        <div class="cell">
						        	<h1><?php the_title( '<h1>', '</h1>' ); ?></h1>
						        	<ul class="breadcrumbs">
						    			<li><a href="<?php echo site_url(); ?>" title="Home">Home</a></li>
						    			<li><span><?php the_title(); ?></span></li>
						    		</ul>
						        </div>
						    </div>
						</div>
					</div>

                </header><!-- .entry-header -->

          	<?php endif; ?>

        </div><!-- .entry-background -->

    

	<?php } else { ?>

    

		<?php if ( my_theme_show_page_header() ) : ?>

            <header class="entry-header page-header bread-right-title-left">

                <?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <div class="row">
					    <div class="twelve columns">
					    	<div class="table">
						        <div class="cell">
						        	<h1><?php the_title( '<h1>', '</h1>' ); ?></h1>
						        	<ul class="breadcrumbs right-breadcrumb">
						    			<li><a href="<?php echo site_url(); ?>" title="Home">Home</a></li>
						    			<li><span><?php the_title(); ?></span></li>
						    		</ul>
						        </div>
						    </div>
						</div>
					</div>

            </header><!-- .entry-header -->

        <?php endif; ?>

	

	<?php } ?>
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

	<div id="primary" class="<?php echo $cnt_cls; ?> content-area sidebar-right sidebar-right-alt">

		<main id="main" class="site-main" role="main">



			<?php while ( have_posts() ) : the_post(); ?>



				<?php get_template_part( 'content', 'page' ); ?>



				<?php

					// If comments are open or we have at least one comment, load up the comment template

					if ( comments_open() || get_comments_number() ) :

						comments_template();

					endif;

				?>



			<?php endwhile; // end of the loop. ?>



		</main><!-- #main -->

	</div><!-- #primary -->

<style type="text/css">
	.fl-builder .site-content{ max-width:1170px !important; margin:0 auto !important;}
</style>

<?php if ( !is_plugin_active('woocommerce/woocommerce.php') || ( is_plugin_active('woocommerce/woocommerce.php') && ( !isset( $layout_default ) || !$layout_default || ( $layout_default == 'sidebar-left' ) || ( $layout_default == 'sidebar-right' ) ) ) ) get_sidebar(); ?>

	

<?php //get_footer(); ?>

<?php get_footer('custes'); ?>