<?php
/**
 * @package uniq
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
$single_featured_image = get_theme_mod( 'single_featured_image',true );
$single_featured_image_size = get_theme_mod ('single_featured_image_size','1');
if ($single_featured_image_size != 3 ) {
if ( $single_featured_image ) :
	 if ( $single_featured_image_size == 1 ) :?>
	 		<div class="post-thumb blog-thumb">
	 <?php  if( has_post_thumbnail() && ! post_password_required() ) :   
				the_post_thumbnail('uniq-blog-large-width');  
			
			endif;?>
			</div><?php
		 else: ?>
		 	<div class="post-thumb blog-thumb"><?php
		 	if( has_post_thumbnail() && ! post_password_required() ) :   
					the_post_thumbnail('uniq-small-featured-image-width');		
			endif;?>
			</div><?php
	endif; 
endif;
} ?>	 

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if ( get_theme_mod('enable_single_post_top_meta',true ) ): ?>
		    <div class="entry-meta">
		    <?php if(function_exists('uniq_entry_top_meta') ) {
		         uniq_entry_top_meta();
		     } ?>
			</div><!-- .entry-meta -->
    <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages: ', 'uniq' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_theme_mod('enable_single_post_bottom_meta', true ) ): ?>
	<footer class="entry-footer">
	<?php if(function_exists('uniq_entry_bottom_meta') ) {
		     uniq_entry_bottom_meta();
		} ?>
	</footer><!-- .entry-footer -->
<?php endif;?>

</article><!-- #post-## -->

	<?php uniq_post_nav(); ?>
