<?php
/**
 * The template for displaying search results pages.
 *
 * @package uniq
 */

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
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'uniq' ); ?></a>
	
	<header id="masthead" class="site-header" role="banner">
			<div class="container branding">
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
				</div><!-- .site-branding -->
				<div class="ten columns nav-wrap">
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
						<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Primary Menu', 'uniq' ); ?></button>
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
		</div><!-- .branding -->

	</header><!-- #masthead -->
	

<?php get_template_part('breadcrumb'); ?>

<div id="content" class="site-content container">

 <?php do_action('uniq_two_sidebar_left'); ?>	

	<section id="primary" class="content-area <?php uniq_layout_class();?> columns">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'uniq' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

		
	<?php 
		if(  get_theme_mod ('numeric_pagination',true) && function_exists( 'uniq_pagination' ) ) : 
				uniq_pagination();
			else :
				uniq_post_nav();     
			endif; 
	?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

      <?php do_action('uniq_two_sidebar_right'); ?>	
	

<?php get_footer(); ?>
