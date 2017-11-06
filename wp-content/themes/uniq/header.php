<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package uniq
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if( get_theme_mod('apple_touch') ) : ?>
	<!-- For first- and second-generation iPad: -->
	<link rel="apple-touch-icon" href="<?php echo esc_url( get_theme_mod( 'apple_touch' ) ); ?>">
<?php endif; ?> 

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
 
<body <?php body_class(); ?>>
<div id="page" class="hfeed site <?php echo uniq_site_style_class(); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'uniq' ); ?></a>
	<?php do_action('uniq_before_header'); ?>
	   <header id="masthead" class="site-header <?php echo uniq_site_style_header_class(); uniq_header_slider_class(); ?>" role="banner">
			<div class="container branding header-image">

				<?php if ( get_theme_mod ('header_overlay',false ) ) { 
				   echo '<div class="overlay overlay-header"></div>';     
				} ?>
				<div class="six columns">
					<div class="site-branding">    
						<?php  
						   // $header_text = get_theme_mod( 'header_text' );
							$logo_title = get_theme_mod( 'logo_title' );
							$logo = get_theme_mod( 'logo', '' );  
							$tagline = get_theme_mod( 'tagline',true);
							if( $logo_title && function_exists( 'the_custom_logo' ) ) {
                                the_custom_logo();     
					        }elseif( $logo != '' && $logo_title ) { ?>
							   <h1 class="site-title img-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url($logo) ?>"></a></h1>
					<?php	}else { ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						    <?php } ?>
						<?php if( $tagline ) : ?>
								<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php endif;  
					?>
                  </div><!-- .site-branding -->
				</div>
				<div class="ten columns nav-wrap" id="nav-wrap">

					<div class="top-nav">
						<div class="row">
							<div class="eight columns top-left cart">
								<?php if( is_active_sidebar( 'top-left' ) ) : ?>
									<?php dynamic_sidebar('top-left' ); ?>
								<?php else:
										echo '&nbsp;'; ?>
								<?php endif; ?>
							</div>
							<div class="eight columns top-right social">
								<?php if( is_active_sidebar('top-right' ) ) : ?>
								<?php dynamic_sidebar('top-right' ); ?>
									<?php else:
										echo '&nbsp;'; ?>
							    <?php endif; ?>
							</div>
						
						</div>
					</div> <!-- .top-nav -->
					<div class="search-wrap">
					<?php if ( get_theme_mod ('header_search',true) ){  ?>
							<?php get_search_form(); ?>
					<?php }?>
					
					</div>
					<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
						<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php echo apply_filters('uniq_responsive_menu_title',__('Primary Menu','uniq') ); ?></button>
						<?php 
							wp_nav_menu( array(
							 'theme_location' => 'primary',
							 'link_before' => '<span>',
							 'link_after' => '</span>'
						 	)
						 );						
						?>						
					</nav><!-- #site-navigation -->
				</div>
				<?php do_action('uniq_after_primary_nav'); ?>
		</div><!-- .branding -->
 	
	</header><!-- #masthead -->
	<?php do_action('uniq_after_header'); ?>  
	
<?php if ( function_exists( 'is_woocommerce' ) || function_exists( 'is_cart' ) || function_exists( 'is_chechout' ) ) :
 if ( is_woocommerce() || is_cart() || is_checkout() ) { ?>    
		<div class="breadcrumb-wrap">
			<div class="container">
				<div class="ten columns">
					<header class="entry-header">
						<h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>
					</header><!-- .entry-header -->				
				</div>
				<div class="six columns">
					<?php $breadcrumb = get_theme_mod( 'breadcrumb',true ); 
					if( $breadcrumb ) : ?>
						<div id="breadcrumb" role="navigation">
							<?php woocommerce_breadcrumb(); ?>    
						</div>
					<?php endif; ?>
				</div>	
			</div>
	    </div> 	
<?php } 
endif; ?>