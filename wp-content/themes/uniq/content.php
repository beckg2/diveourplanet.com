<?php
/**
 * @package uniq
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="entry-content">
	<?php 
		$featured_image = get_theme_mod( 'featured_image',true );
	    $featured_image_size = get_theme_mod ('featured_image_size','1');
		if( $featured_image ) : 
		        if ( $featured_image_size == '1' ) :?>		
						<div class="thumb">
						  <?php	if( $featured_image && has_post_thumbnail() ) : 
								    the_post_thumbnail('uniq-blog-full-width');
			                     endif;?>
			            </div> <?php
		        else: ?>
		 	            <div class="thumb">
		 	                 <?php if( has_post_thumbnail() && ! post_password_required() ) :   
					               the_post_thumbnail('uniq-small-featured-image-width');
								endif;?>
			             </div>  <?php				
	            endif; 
		endif; ?>   

<?php do_action('uniq_before_entry_header'); ?>
		<div class="entry-body">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<header class="entry-header">
					<?php if ( get_theme_mod('enable_single_post_top_meta', true ) ): ?>
					<footer class="entry-meta">
						<?php if(function_exists('uniq_entry_top_meta') ) {
						    uniq_entry_top_meta(); 
						} ?> 
					</footer><!-- .entry-footer -->
				<?php endif;?>  
					<br class="clear">
				</header><!-- .entry-header -->
				<?php do_action('uniq_after_entry_header'); ?>
				<?php
					/* translators: %s: Name of current post */
					echo the_content(__('Read More','uniq')); 
				?>
		</div>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages: ', 'uniq' ),
				'after'  => '</div>',
			) );
		?>
		<br class="clear" />
		</div><!-- .entry-content -->

	 <?php do_action('uniq_before_entry_footer'); ?>
	<?php if ( get_theme_mod('enable_single_post_bottom_meta', true ) ): ?>
		<footer class="entry-footer">
			<?php if(function_exists('uniq_entry_bottom_meta') ) {
			     uniq_entry_bottom_meta();
			} ?>
		</footer><!-- .entry-footer -->
	<?php endif;?>
<?php do_action('uniq_after_entry_footer'); ?>

</article><!-- #post-## -->