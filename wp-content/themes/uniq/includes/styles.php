<?php

function uniq_custom_styles($custom) {
$custom = '';	
	$sticky_header_position = get_theme_mod('sticky_header_position') ;
	if( $sticky_header_position == 'bottom') {
		$custom .= ".site-header-sticky {  top: auto!important;
			bottom:0; }"."\n";	
		$custom .= ".site-header-sticky #nav-wrap .nav-menu .sub-menu {  top: auto;
			bottom:100%; }.site-header-sticky .branding .site-branding::after{display: none;}"."\n";	
	}

     $sticky_header = get_theme_mod('sticky_header');
     if( ! $sticky_header ) {
          $custom .= ".site-header {  position: absolute; }"."\n";        
     }	

	$page_title_bar = get_theme_mod('page_titlebar');
     switch ($page_title_bar) {
     	case 2:
     		$custom .= ".breadcrumb-wrap,.site-header, .home.blog .site-header {
     			background-color: transparent;
                    background-image: none;
     		}"."\n";
     		break;     	
     	case 3:
     		$custom .= ".breadcrumb-wrap div {
     			display: none;
     		}"."\n";
     		break;		
     }

     $page_title_bar_status = get_theme_mod('page_titlebar_text');
     if( $page_title_bar_status == 2 ) {
          $custom .= ".breadcrumb-wrap .entry-header .entry-title {
               display: none;
          }"."\n";
     }


     if( get_theme_mod('enable_flex_caption_edit') ) {
         $custom .= ".flexslider .flex-caption::after, .flexslider .flex-caption::before {
               display: none;
          }"."\n";
           $custom .= ".flexslider .flex-caption {
               min-height:auto;
          }"."\n";
 
     }


	//Output all the styles
	wp_add_inline_style( 'uniq-style', $custom );	
}



add_action( 'wp_enqueue_scripts', 'uniq_custom_styles' );  
