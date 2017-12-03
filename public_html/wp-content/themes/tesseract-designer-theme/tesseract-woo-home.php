<?php

/**

 * Template name: Woo Home Page(Tesseract)

 *

 */
get_header(); 
?>
	<link href="<?php echo get_template_directory_uri() . '/css/flexslider.css'; ?>" rel="stylesheet" type="text/css" />
	<script src="<?php echo get_template_directory_uri() . '/js/jquery.flexslider.js'; ?>"></script>
	

<div class="home-slider-wrapper">
    <div class="flexslider-banner">
    	 <ul class="slides">
        <!-- <img src="<?php echo get_template_directory_uri(); ?>/images/slider-1.jpg" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/slider-2.jpg" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/slider-3.jpg" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/slider-4.jpg" /> -->

	        <?php $args = array(
				'posts_per_page'   => -1,
				'post_type'        => 'banner',
				'post_status'      => 'publish',
			);
			$posts_array = get_posts( $args ); 
			//echo "<pre>"; print_r($posts_array); echo "</pre>";
			foreach($posts_array as $banner)
			{
				$image_id = get_post_meta( $banner->ID, '_banner_image_id', true );
				$image_src = wp_get_attachment_url( $image_id );
				if($image_src)
				{
			?>
				 <li><img src="<?php echo $image_src; ?>"  style="max-width:100%;"/></li>
			<?php
				}
			}
			?>
		</ul>
    </div>
</div>
<?php 
	$args = array(
				'posts_per_page'   => -1,
				'post_type'        => 'collection',
				'post_status'      => 'publish',
			);
	$posts_array = get_posts( $args ); 
	//echo "<pre>"; print_r($posts_array); echo "</pre>";
	$i=1;
?>

<div class="home-middle-content">
	<?php
		foreach($posts_array as $collection)
		{
	?>
			<div class="home-box" id="home-box-<?php echo $i; ?>">
				<a href="<?php echo get_post_permalink($collection->ID); ?>">
					<?php
						if(get_the_post_thumbnail($collection->ID))
						{
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $collection->ID ), 'single-post-thumbnail' );
					?>
							<img src=<?php echo $image[0];?> style="height:188px; width:376px;" />
					<?php
						}
						else
						{
							?>
							<img src="<?php echo get_template_directory_uri() ?>/images/photo_na.jpg" />
							<?php
						}
					?>
				</a>
			</div>
		<?php
			$i++;
		}
		?>
</div>

<?php
	$meta_query[] = array(
	    'key'   => '_featured',
	    'value' => 'yes'
	);
	$tax_query[] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => 'featured',
		'operator' => 'IN',
	);

	$query_args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => -1,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'tax_query'           => $tax_query,
	);
	$featured_pr = get_posts($query_args);  
?>
<?php if(is_plugin_active('woocommerce/woocommerce.php')){wc_print_notices(); }?>
<div class="home-featured-product <?php if(count($featured_pr)>4){ echo 'flexslider carousel';} ?> ">

		<ul class="block-grid small-block-grid-1 medium-block-grid-3 large-block-grid-4 <?php if(count($featured_pr)>4){ echo 'slides';} ?> ">
			<?php
				if(is_plugin_active('woocommerce/woocommerce.php'))
				{
					if( count($featured_pr)>4 )
					{
						?>
							<script type="text/javascript">
					    		jQuery(window).load(function() {
									jQuery('.flexslider').flexslider({
									    animation: "slide",
									    animationLoop: false,
									    slideshow: false,
									    itemWidth: 250,
									    maxItems: 4,
									    minItems: 1,
									  });
									});
					    	</script>
						<?php
					}

						$tax_query[] = array(
							'taxonomy' => 'product_visibility',
							'field'    => 'name',
							'terms'    => 'featured',
							'operator' => 'IN',
						);

						$query_args = array(
							'post_type'           => 'product',
							'post_status'         => 'publish',
							'ignore_sticky_posts' => 1,
							'posts_per_page'      => -1,
							'orderby'             => 'date',
							'order'               => 'DESC',
							'tax_query'           => $tax_query,
						);					
						$featured_query = new WP_Query( $query_args );
					          
					    if ($featured_query->have_posts()) : 
					        while ($featured_query->have_posts()) :   
					          
					            $featured_query->the_post();  
					              
					            $product = get_product( $featured_query->post->ID ); 
					   //          $post_thumbnail_id = get_post_thumbnail_id( $featured_query->post->ID );
								// $image_url   = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );
								
					              ?>
					              <li>
					              	<div class="product card">
					              		<div class="image">
					              		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					              			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
					              		</a>
					              		</div> 
					              		
					              		<div class="details">
					              			<div class="sub-details">
						              			<header>
											        <h2>
											          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											            <span class="name"><?php the_title(); ?></span>
											          </a>
											        </h2>
											    </header>
											    <span class="brand">
												    <?php $brands = wp_get_post_terms( $featured_query->post->ID, 'pr_brand', array('name') );
												    	  $count =1;
												    	  foreach($brands as $brand)
												    	  {
												    	  	if($count !=1)
												    	  	{
												    	  		echo ", ";
												    	  	}	
												    	  	echo $brand->name;
												    	  	$count++;
												    	  }
												    ?>
												    	
												</span>
											    <span class="pricing">
												    <span class="price">
													    <?php
															if($product->is_type('simple')){
																$obj = new Tesseract_Woo;
																$obj->tesseract_price_html($product);
																
															}
															elseif($product->is_type('variable')){
																
 
															    $min_price_regular = $product->get_variation_regular_price( 'min', true );
															    $min_price_sale    = $product->get_variation_sale_price( 'min', true );
															    $max_price = $product->get_variation_price( 'max', true );
															    $min_price = $product->get_variation_price( 'min', true );
															 
															    $price = ( $min_price_sale == $min_price_regular ) ?
															        wc_price( $min_price_regular ) :
															        '<del>' . wc_price( $min_price_regular ) . '</del>' . '<ins>' . wc_price( $min_price_sale ) . '</ins>';
															    if($min_price == $max_price){
															    	echo $price;
															    }else{
															    	echo "From ".$price;
															    }
															    
															}
															else
															{
																
																echo $product->get_price_html();
															}
														?>
													</span>
												</span>
											</div>
											<?php
			$addtocart_pos_class = (get_theme_mod('tesseract_cart_button_position')) ? get_theme_mod('tesseract_cart_button_position') : 'left-woo-cart-btn';
		?>
											<div class="actions <?php echo $addtocart_pos_class; ?>">
												<?php
												if ( $product->is_in_stock() ) 
												{
												 	$wooaddbutton = (get_theme_mod('tesseract_woocommerce_product_morebutton')) ? get_theme_mod('tesseract_woocommerce_product_morebutton') : 'showcartbutton';  ?>
													<?php if($wooaddbutton == 'showcartbutton' ) 
													{?>
														<?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>
														<?php $woobutton_bgcolor = (get_theme_mod('tesseract_woocommerce_buttonbgcolor')) ? get_theme_mod('tesseract_woocommerce_buttonbgcolor') : '#0db6bc'; ?>
														<?php $woobutton_brderradius = get_theme_mod('tesseract_woocommerce_button_radius'); ?>
														<?php $woobutton_size = get_theme_mod('tesseract_woocommerce_button_size'); ?>
														<?php $woobutclass = ''; ?>
														<?php if($woobutton_size == 'small' ) { 
															$woobutclass = 'woobutton-small';
														} elseif ($woobutton_size == 'large' ) { 
															$woobutclass = 'woobutton-large'; 
														} else {
															$woobutclass = 'woobutton-medium';
														} ?>
												       <?php
												       $woobutton_text_color = (get_theme_mod('tesseract_woocommerce_cart_button_text')) ? get_theme_mod('tesseract_woocommerce_cart_button_text') : '#000000';
												       	echo apply_filters( 'woocommerce_loop_add_to_cart_link',
															sprintf( '<a class="add-cart-button-hover" style="background-color: '.$woobutton_bgcolor.'; border-radius: '.$woobutton_brderradius.'px; color: '.$woobutton_text_color.';" href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button '.$woobutclass.' %s product_type_%s">%s</a>',
																esc_url( $product->add_to_cart_url() ),
																esc_attr( $product->id ),
																esc_attr( $product->get_sku() ),
																$product->is_purchasable() ? 'add_to_cart_button' : '',
																esc_attr( $product->product_type ),
																esc_html( $product->add_to_cart_text() )
															),
														$product );
										       		}
										       	}
										       	else
										       	{
										       		echo '<a class="button small disabled" href="#">Sold Out</a>';
										       	}
										       ?>
										    </div>
					              		</div>
					              	</div>
					              </li>
					              <?php
					        endwhile;  
					    endif;  
					    wp_reset_query(); // Remember to reset  
				}
				else
				{
					echo 'In order to use this page, you will need to first install woo-commerce. Since this is an e-commerce shop page';
				}

			?>
		</ul>
</div>	
<?php
	$hover_color = (get_theme_mod('tesseract_woocommerce_cart_button_hover')) ? get_theme_mod('tesseract_woocommerce_cart_button_hover') : '#000000';
?>
<style>
.bx-controls-auto .bx-controls-auto-item.active{ display:none !important; }
.add-cart-button-hover:hover{ background-color: <?php echo $hover_color; ?> !important; }
@media (max-width: 1199px) {
.home.transparent-footer .site-footer{ position:inherit !important;}
}
</style>


<script>
jQuery(window).load(function() {
  jQuery('.flexslider-banner').flexslider({
    animation: "slide"
  });
});

</script> 


<?php get_footer('custes'); ?>