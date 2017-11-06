<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package uniq
 */
?>
		</div> <!-- .container -->
	</div><!-- #content -->
	<?php do_action('uniq_before_footer'); ?>


	<footer id="colophon" class="site-footer footer-image  " role="contentinfo">
	<?php if ( get_theme_mod ('footer_overlay',false ) ) { 
				   echo '<div class="overlay overlay-footer"></div>';     
				} 
		$footer_widgets = get_theme_mod( 'footer_widgets',true );
		if( $footer_widgets ) : ?>
		<div class="footer-widgets">
			<div class="container">
				<?php get_template_part('footer','widgets'); ?>
			</div>
		</div>
	<?php endif; ?>
		<div class="footer-bottom site-info copy">
			<div class="container">
				<div class="copyright seven columns">
                  <?php if( get_theme_mod('copyright') ) : ?>
						<p><?php echo get_theme_mod('copyright'); ?></p>
					<?php else : 
				        do_action('uniq_credits'); 
                        endif;  ?>
				</div>

				<div class="left-sidebar social nine columns">
					<?php dynamic_sidebar( 'footer-nav' ); ?>
				</div>
			</div>
		</div><!-- .site-info -->
		<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
	</footer><!-- #colophon -->
<?php do_action('uniq_after_footer'); ?>
</div><!-- #page -->

	
<?php wp_footer(); ?>

</body>
</html>
