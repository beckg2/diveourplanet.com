<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package uniq
 */
?>
<!DOCTYPE html>
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
							$logo_title = get_theme_mod( 'logo_title' );
							$logo = get_theme_mod( 'logo', '' );
							$tagline = get_theme_mod( 'tagline');
							if( $logo_title && $logo != '' ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url($logo) ?>"></a></h1>
						<?php else : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php endif; ?>
						<?php if( $tagline ) : ?>
								<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php endif; ?>
					</div>
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

<div id="content" class="site-content container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'uniq' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<div class="eight columns">
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'uniq' ); ?></p>

						<?php get_search_form(); ?>

						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					</div>
					<div class="eight columns">
					<?php if ( uniq_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php _e( 'Most Used Categories', 'uniq' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>

					<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'uniq' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
