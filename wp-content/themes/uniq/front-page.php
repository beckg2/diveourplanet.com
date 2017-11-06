<?php
	if ( 'posts' == get_option( 'show_on_front' ) ) { 
	   get_template_part('home');
	} else {
/**
 * The front page template file.
 *
 *
 * @package uniq
 */
get_header();  
	if ( get_theme_mod('page-builder',false ) ) { 
		if( get_theme_mod('flexslider') ) {   
			echo do_shortcode( get_theme_mod('flexslider'));
		} ?>
  
		<div id="content" class="site-content">
		<div class="container">
			<?php  if( get_theme_mod('home_sidebar',false ) ) { ?>
				<div id="primary" class="content-area eleven columns">
			<?php }else { ?>
			    <div id="primary" class="content-area sixteen columns">
			<?php } ?>
				<main id="main" class="site-main" role="main">
					<?php
						while ( have_posts() ) : the_post();
							the_content();
						endwhile;
					?>	
			     </main><!-- #main -->
		     </div><!-- #primary -->
<?php	} else {
        $home_slider = get_theme_mod('enable_slider',true); 
		if( $home_slider ) {
            get_template_part('category-slider');
		} ?>

	<div id="content" class="site-content free-home">
		
	<?php  if( get_theme_mod('home_sidebar',false ) ) { ?>
		        <div class="container">	
				<div id="primary" class="content-area eleven columns">
			<?php }else { ?>
				<div class="">	
			    <div id="primary" class="content-area">
			<?php } ?>	
		<main id="main" class="site-main" role="main">

		<?php
		do_action('uniq_service_content_before'); 
		if( get_theme_mod('enable_service',true) ) { 
			 $service = get_theme_mod('service_count',3);
			    $service_pages = array();
			    for ( $i = 1 ; $i <= $service ; $i++ ) {
					$service_page = absint(get_theme_mod('service_'.$i));
					if( $service_page ){
                        $service_pages[] = $service_page;
					}
			    }
			if( $service_pages && !empty( $service_pages ) ) {
				$args = array(
					'post_type' => 'page',
					'post__in' => $service_pages,
					'posts_per_page' => -1 ,
					'orderby' => 'post__in'
				);
			}elseif( current_user_can('manage_options') ) { ?>
			    <div class="services-wrapper">
					<div class="container">
						 <div class="eight columns tcenter">
	                        <img src="<?php echo get_template_directory_uri(); ?>/images/img-layout-free.png" />								    		
						</div>
						 <div class="eight columns">
							<h3><?php _e('Service Page-1','uniq');?></h3>
							<p><?php printf( __('You haven\'t created any service page yet. Create Page. Go to <a href="%1$s"target="_blank"> Customizer </a> and click uniq Options => Home => Service Section #1 and select page from  dropdown page list.','uniq'), admin_url('customize.php') ) ;?></p>						    	
						 </div>
					</div>
					<div class="hr-divider">
						<svg style="width: 100%;">
					    	<line x1="5" y1="5" x2="5600" y2="500" stroke="#3DAD66" stroke-width="8"/>
						</svg>
					</div>
				</div> 
				<div class="services-wrapper">
					<div class="container">
						 <div class="eight columns tcenter">
	                        <img src="<?php echo get_template_directory_uri(); ?>/images/img-layout-free.png" />								    		
						</div>
						 <div class="eight columns">
							<h3><?php _e('Service Page-2','uniq');?></h3>
							<p><?php printf( __('You haven\'t created any service page yet. Create Page. Go to <a href="%1$s"target="_blank"> Customizer </a> and click uniq Options => Home => Service Section #2 and select page from  dropdown page list.','uniq'), admin_url('customize.php') ) ;?></p>						    	
						 </div>
					</div>
					<div class="hr-divider">
						<svg style="width: 100%;">
					    	<line x1="5" y1="5" x2="5600" y2="500" stroke="#3DAD66" stroke-width="8"/>
						</svg>
					</div>
				</div> 
				<div class="services-wrapper">
					<div class="container">
						 <div class="eight columns tcenter">
	                        <img src="<?php echo get_template_directory_uri(); ?>/images/img-layout-free.png" />								    		
						</div>
						 <div class="eight columns">
							<h3><?php _e('Service Page-3','uniq');?></h3>
							<p><?php printf( __('You haven\'t created any service page yet. Create Page. Go to <a href="%1$s"target="_blank"> Customizer </a> and click uniq Options => Home => Service Section #3 and select page from  dropdown page list.','uniq'), admin_url('customize.php') ) ;?></p>						    	
						 </div>
					</div>
					<div class="hr-divider">
						<svg style="width: 100%;">
					    	<line x1="5" y1="5" x2="5600" y2="500" stroke="#3DAD66" stroke-width="8"/>
						</svg>
					</div>
				</div> 
	<?php 	} 			
		if( isset($args) ) : 
			$query = new WP_Query($args);
			if( $query->have_posts()) : 
			    while($query->have_posts()) :
					$query->the_post(); ?>
					<div class="services-wrapper">
						<div class="container">
						    <div class="eight columns tcenter">
						    	<?php if( has_post_thumbnail() ) : ?>
						    		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full'); ?></a>
						    	<?php endif; ?>
						    </div>
						    <div class="eight columns">
						    	<?php the_title( '<h3>', '</h3>' ); ?>
								<?php the_content('Read More','uniq'); ?>				    	
						    </div>
						</div>
						<div class="hr-divider">
							<svg style="width: 100%;">
						    	<line x1="5" y1="5" x2="5600" y2="500" stroke="#3DAD66" stroke-width="8"/>
							</svg>
						</div>
				    </div><?php 
				endwhile; 
			endif;  
				$query = null;
				wp_reset_postdata();
		endif;
		} ?> 
		<div class="container">
			<div class="sixteen columns"><?php 
				do_action('uniq_service_content_after');
				if( get_theme_mod('enable_recent_post_service',true)  ) {
					uniq_recent_posts(); 
				} ?>	
           </div>
		</div><?php
	    if( get_theme_mod('enable_home_default_content',false ) ) {  ?>
			<div class="container default-home-page"><?php
				while ( have_posts() ) : the_post();       
					the_content();
				endwhile; ?>
	        </div><?php 
	    } ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
}
if( get_theme_mod('home_sidebar',false ) ) { 
   get_sidebar();
}
get_footer();
} ?>