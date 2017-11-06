<?php
/**
 * The template for displaying category-slider 
 *
 * display slider
 *
 * @package uniq
 */

$uniq_slider_cat = get_theme_mod( 'slider_cat', '' );
$uniq_slider_count = get_theme_mod( 'slider_count', 5 );
$uniq_slider_posts = array(
	'cat' => absint($uniq_slider_cat),
	'posts_per_page' => absint($uniq_slider_count)
);

	if ($uniq_slider_cat) {

		$uniq_query = new WP_Query($uniq_slider_posts);
			if( $uniq_query->have_posts()) : ?>
				<div class="flexslider">
					<ul class="slides">
						<?php while($uniq_query->have_posts()) :
								$uniq_query->the_post();
								if( has_post_thumbnail() ) : ?>
								    <li>
								    	<div class="flex-image">
								    		<?php the_post_thumbnail('full'); ?>
								    	</div>
								    	<?php $content=get_the_content();
								    	if(! empty($content) ) : ?>
									    	<div class="flex-caption">
									    		<?php the_content(); ?>
									    	</div>
									    <?php endif; ?>
								    </li>
								<?php endif; ?>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php endif; ?>
			<?php  
				$uniq_query = null;
				wp_reset_postdata();	
	}elseif( current_user_can('manage_options') ) {	?>	
		 <div class="flexslider">  
				<ul class="slides">	          
					<li>   	
						<div class="flex-image">
							<?php echo '<img src="' . get_template_directory_uri() . '/images/slider.jpg" alt="" >';?>	
						</div>
						<?php	$slide_description = sprintf( __('<h1> Slider Setting </h1><p>You haven\'t created any slider yet. Create a post, set your slider image as Post\'s featured image ( Recommended image size 1280*450 ) ). Go to Customizer and click uniq Options => Home and select Slider Post Category and No.of Sliders.<p><a href="%1$s"target="_blank"> Customizer </a></p>', 'uniq'),  admin_url('customize.php') );?>
						<div class="flex-caption"> <?php echo $slide_description;?></div>
					</li>
				</ul>
			</div><!-- flex-slider end -->	<?php
	}