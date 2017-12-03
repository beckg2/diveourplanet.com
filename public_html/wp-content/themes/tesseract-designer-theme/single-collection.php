<?php

/**

 * The template for displaying all pages.

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site will use a

 * different template.

 *

 * @package Tesseract

 */



get_header(); 


if(is_plugin_active('woocommerce/woocommerce.php'))
{
?>

<div id="site-body">
    <div class="row padded-h">
      	<div class="small-12 columns">
      		<header class="page-header">
				<div class="row">
				    <div class="twelve columns">
				    	<div class="table">
					        <div class="cell">
					          <h1><?php the_title(); ?></h1>
					            <ul class="breadcrumbs">
					    			<li><a href="<?php echo site_url(); ?>" title="">Home</a></li>
					    			<li><span><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></span></li>
					    		</ul>
	        				</div>
	       					<div class="cell">
	       						<div id="page-header-actions" class="table compress">
						            <div class="cell">
						                <div class="collection-tag-filter">
						                	<label for="collection-tags" class="inline">Collections</label>
						                		<?php
													$args = array(  
														        'post_type' => 'collection',  
														        'posts_per_page' => -1
														    );  
													$collections = get_posts($args);  
												?>
												<select class="collection-tags" onchange="location = this.value;">
													<?php foreach($collections as $collection){ ?>
													    <option value="<?php echo get_post_permalink($collection->ID); ?>" <?php if(get_the_ID() == $collection->ID){ echo 'selected'; } ?> id="<?php echo $collection->ID; ?>">
													    		<?php echo $collection->post_title; ?>
													    </option>
													<?php } ?>
												</select>
	      								</div>
	      							</div>
	      						</div>
	      					</div>
	      				</div>
	      			</div>
	      		</div>
	    	</header>
	    	<?php 	
		    	$my_postid = get_the_ID();
				$content_post = get_post($my_postid);
				$content = $content_post->post_content;
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]&gt;', $content);
				if($content != ''){
			?>
		    	<div class="collection-description">
		    		<p>
		    			<?php echo $content; ?>
					</p>
		    	</div>
		    <?php } ?>
	    	<?php
				$pr_ids_string = get_post_meta(get_the_ID(),'pr_ids',true);
				if($pr_ids_string != 0)
				{
					$pr_ids_arr = explode("|",$pr_ids_string);
					//echo '<pre>'; print_r($pr_ids_arr);echo '</pre>';
					$pr_per_page = (get_theme_mod('tesseract_product_per_page')) ? get_theme_mod('tesseract_product_per_page') : 12;
					$current_url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					$current_url_arr = explode('/',$current_url);
					$current_page_no = $current_url_arr[count($current_url_arr)-2];
					if(!is_numeric($current_page_no))
					{
						$current_page_no = 1;
					}
					//print_r($current_url_arr);
					//echo '..................... '.$current_page_no;
					
					$start_num = $pr_per_page*($current_page_no-1);
					$end_num = ($pr_per_page*$current_page_no)-1;
			?>
			    	<div class="home-featured-product">
						<ul class="block-grid small-block-grid-1 medium-block-grid-3 large-block-grid-4">
							<?php
								for($i=$start_num; $i<=$end_num; $i++)
								{   
						            if($pr_ids_arr[$i]=='' || !is_numeric($pr_ids_arr[$i]))
						            	break;
						            $product = get_product( $pr_ids_arr[$i] );

						    ?>
					              	<li>
						              	<div class="product card">
						              		<div class="image">
						              		<a href="<?php echo get_the_permalink($product->post->ID); ?>" title="<?php echo $product->post->post_title; ?>">
						              			<?php $img_url = $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->post->ID ), 'single-post-thumbnail' );?>
						              			<img src="<?php echo $image[0]; ?>" class="attachment-shop_catalog size-shop_catalog wp-post-image" draggable="false" width="300" height="300">
						              		</a>
						              		</div> 
						              		
						              		<div class="details">
						              			<div class="sub-details">
							              			<header>
												        <h2>
												          <a href="<?php echo get_the_permalink($product->post->ID); ?>" title="<?php echo $product->post->post_title; ?>">
												            <span class="name"><?php echo $product->post->post_title; ?></span>
												          </a>
												        </h2>
												    </header>
												    <span class="brand">
													    <?php $brands = wp_get_post_terms( $product->post->ID, 'pr_brand', array('name') );
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
												<div class="actions">
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
						        }
							?>
						</ul>
					</div>
				<?php
				}
			    else
			    {
			    	echo "No product found in this collection, please try another collections.";
			    }
			    ?>

    	</div>
	</div>
</div>

<?php } ?>
<?php if(is_numeric(count($pr_ids_arr)) && is_numeric($pr_per_page) && count($pr_ids_arr)>=$pr_per_page){ ?>
	<nav class="woocommerce-pagination">
		<?php $total_no_of_page = ceil(count($pr_ids_arr)/$pr_per_page); //echo '------- '.$current_page_no;?>
		<ul class="page-numbers">
		<?php for($i=1;$i<=$total_no_of_page; $i++){ 
			if($i<=2){
				if($current_page_no == $i){ ?>
					<li><span class="page-numbers current"><?php echo $i; ?></span></li>
				<?php }else{ ?>
					<li><a class="page-numbers" href="<?php echo get_post_permalink(get_the_ID()).''.$i.'/'; ?>"><?php echo $i; ?></a></li>
				<?php }
			}
			else
			{
				if($i==3)
				{
					?>
					<li><select onchange="location = this.value;">
						<option value="">More...</option>
					<?php
				}
				?>
					<?php  if($current_page_no == $i){ ?>
							<option selected><?php echo $i; ?></option>
					<?php } else { ?>
						<option value="<?php echo get_post_permalink(get_the_ID()).''.$i.'/'; ?>"><?php echo $i; ?></option>
					<?php } ?>
				<?php

				if($i==$total_no_of_page)
				{
					echo '</select></li>';
				}
			}
		} ?>
	</ul>
	<?php //echo  ?>
	</nav>
<?php } ?>
<?php get_footer('custes'); ?>