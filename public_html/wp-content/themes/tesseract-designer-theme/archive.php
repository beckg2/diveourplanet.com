<?php

/**

 * The template for displaying archive pages.

 *

 * Learn more: http://codex.wordpress.org/Template_Hierarchy

 *

 * @package Tesseract

 */



get_header(); ?>

<?php

		$bplayout = (get_theme_mod('tesseract_blog_post_layout')) ? get_theme_mod('tesseract_blog_post_layout') : 'sidebar-right';

 		//echo "==-------------------------> ".$bplayout;

		 

	?>
	

	<div id="primary" class="full-width-page <?php echo 'arch-'.$bplayout; ?>">

    <div class="leftSidebar"><?php if($bplayout != 'fullwidth'){get_sidebar(); }?></div>

    <div class="rightSidebar"><main id="main" class="site-main" role="main">

        

        <h1 class="page-title"><?php the_archive_title(); ?></h1>

        

        <?php if ( is_tag() || is_category() || is_tax() ) { ?>

        	<div class="archive-description"><?php the_archive_description(); ?></div>

		<?php } ?>



		<?php if ( have_posts() ) : ?>



			<?php /* Start the Loop */ ?>

			<?php while ( have_posts() ) : the_post(); ?>



				<?php

					/* Include the Post-Format-specific template for the content.

					 * If you want to override this in a child theme, then include a file

					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.

					 */

					get_template_part( 'content', get_post_format() );

				?>



			<?php endwhile; ?>



			<?php tesseract_paging_nav(); ?>



		<?php else : ?>



			<?php get_template_part( 'content', 'none' ); ?>



		<?php endif; ?>



		</main></div>

    

		<!-- #main -->

	</div><!-- #primary -->







<?php //get_footer(); ?>

<?php get_footer('custes'); ?>