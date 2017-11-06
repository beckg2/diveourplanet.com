<?php
/**
 * The template used for displaying page breadcrumb
 *
 * @packageuniq
 */?>
	<div class="breadcrumb-wrap">
		<div class="container">
			<div class="ten columns">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->				
			</div>
			<div class="six columns">
				<?php $breadcrumb = get_theme_mod( 'breadcrumb',true ); 
				if( $breadcrumb ) : ?>
					<div id="breadcrumb" role="navigation">
						<?php uniq_breadcrumbs(); ?>    
					</div>
				<?php else:  ?>     
					&nbsp;
				<?php endif; ?>
			</div>
			
		</div>
	</div>