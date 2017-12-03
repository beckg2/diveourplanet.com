<?php

/**

 * The header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="content">

 *

 * @package Tesseract

 */

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> <?php if ( is_user_logged_in() ) {echo 'class="loginpage"';} ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11" >

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Aladin" media="screen">


<?php wp_head(); ?>
<!-- Infinite Scroll -->
<?php if (!is_single() || !is_page()): 
$args = array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'post_status'=>'publish'
  );
  $pr_post = get_posts( $args );
  $total_product = count($pr_post);

?>
<script type="text/javascript">
      jQuery(document).ready(function($) {
        $('a#inifiniteLoader img').hide('fast');
          // var count = 2;
          // var tot_pr = '<?php echo $total_product; ?>';
          // $(window).scroll(function(){
          //   var scroll = parseInt($(window).scrollTop()) - parseInt(200);
          //     if  (scroll >= $('#primary').height() - $(window).height()){
          //        if( $('ul.products li').length != tot_pr && tot_pr > $('ul.products li').length){
          //           //loadArticle(count);
          //           //count++;
          //       }
          //     }
          // }); 
          $("#inifiniteLoader").click(function(){
            var old_count     = $("#product_count_page_list").val();
            var new_count     = parseInt(old_count)+1;
            var max_num_page  = $("#max_num_page").val();
            loadArticle(old_count,max_num_page,new_count);
            $("#product_count_page_list").val(new_count);
          });
          function loadArticle(pageNumber,max_num_page,new_count){    
                  $('a#inifiniteLoader img').show('fast');
                  $.ajax({
                      url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                      type:'POST',
                      async: true,
                      cache: false,
                      data: "action=infinite_scroll&page_no="+ pageNumber, 
                      success: function(html){
                          $('a#inifiniteLoader img').hide('1000');
                          $(".products").append(html);
                          console.log(new_count);
                          console.log(max_num_page);
                          if(new_count > max_num_page){
                            $('a#inifiniteLoader').hide('1000');  
                          }
                      }
                  });
              return false;
          }
   
      });
      
  </script>
<?php endif; ?>

<!--[if gte IE 9]>

  <style type="text/css">

    .gradient {

       filter: none;

    }

  </style>

<![endif]-->

</head>

<?php // Additional body classes

$bodyClass = ( version_compare($wp_version, '4.0.0', '>') && is_customize_preview() ) ? 'backend' : 'frontend';



$slayout = (get_theme_mod('tesseract_search_results_layout')) ? get_theme_mod('tesseract_search_results_layout') : 'sidebar-right';



$bplayout = get_theme_mod('tesseract_blog_post_layout');

 

if ( (is_page()) && (has_post_thumbnail()) ) $bodyClass .= ' tesseract-featured';



if ( is_plugin_active('beaver-builder-lite-version/fl-builder.php') || is_plugin_active('beaver-builder/fl-builder.php') ) $bodyClass .= ' beaver-on';



$opValue = get_theme_mod('tesseract_header_colors_bck_color_opacity');



$header_bckOpacity = is_numeric($opValue) ? TRUE : FALSE;



if ( is_front_page() && ( $header_bckOpacity && ( intval($opValue) < 100 ) ) ) $bodyClass .= ' transparent-header';





$opValue1 = get_theme_mod('tesseract_footer_colors_bck_color_opacity');



$footer_bckOpacity = is_numeric($opValue1) ? TRUE : FALSE;



if ( is_front_page() && ( $footer_bckOpacity && ( intval($opValue1) < 100 ) ) ) $bodyClass .= ' transparent-footer';









if ( is_search() ) {

	if ( $slayout == 'fullwidth' ) $bodyClass .= ' fullwidth';

	if ( $slayout == 'sidebar-right' ) $bodyClass .= ' sidebar-right';

}elseif( is_single() ) {

	if ( $bplayout == 'fullwidth' ) $bodyClass .= ' fullwidth';

	if ( $bplayout == 'sidebar-right' ) $bodyClass .= ' sidebar-right';

}elseif( is_home() ) {

	if ( $bplayout == 'fullwidth' ) $bodyClass .= ' fullwidth';

	if ( $bplayout == 'sidebar-right' ) $bodyClass .= ' sidebar-right';

}

 

?>




<body <?php body_class( $bodyClass ); ?>>

<?php $headright_content = get_theme_mod('tesseract_header_right_content');

$wooheader = ( get_theme_mod('tesseract_woocommerce_headercart') == 1 ) ? true : false;

$rightclass = '';

if ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) {

	$rightclass = $wooheader ? $headright_content . ' is-right is-woo ' : $headright_content . ' is-right no-woo ';

} else if ( ( $headright_content == 'nothing' ) && $wooheader ) {

	$rightclass = $wooheader ? $headright_content . ' no-right is-woo ' : $headright_content . ' no-right no-woo ';

}





$headpos = ( is_front_page() && ( $header_bckOpacity && ( intval($opValue) < 100 ) ) ) ? 'pos-absolute' : 'pos-relative';



$footpos = ( is_front_page() && ( $footer_bckOpacity && ( intval($opValue1) < 100 ) ) ) ? 'pos-absolute' : 'pos-relative';



?>





<div id="page" class="hfeed site">



<?php $logoImg = get_theme_mod('tesseract_header_logo_image');

    $blogname = get_bloginfo('blogname');

    $hmenusize = get_theme_mod('tesseract_header_width');

    $header_logo_choice = (get_theme_mod('tesseract_header_logo_type')) ? get_theme_mod('tesseract_header_logo_type') : 'image';

    $header_text        = (get_theme_mod('tesseract_header_logo_text')) ? get_theme_mod('tesseract_header_logo_text') : get_bloginfo();
    $header_fonts       = (get_theme_mod('tesseract_header_logo_text_fonts')) ? get_theme_mod('tesseract_header_logo_text_fonts') : 'Pacifico';
    $header_font_styles = (get_theme_mod('tesseract_header_logo_text_fonts_styles')) ? get_theme_mod('tesseract_header_logo_text_fonts_styles') : 'normal';
    $header_font_weight = (get_theme_mod('tesseract_header_logo_text_fonts_weights')) ? get_theme_mod('tesseract_header_logo_text_fonts_weights') : '900';


	$mmdClass = (get_theme_mod( 'tesseract_mobmenu_opener_mob' )) ? get_theme_mod( 'tesseract_mobmenu_opener_mob' ) : 'mob-showit';
  //echo "--------------------------------- ".get_theme_mod( 'tesseract_mobmenu_opener_mob' );

	//$mmdClass = ( $mmdisplay == 1 ) ? 'showit' : 'hideit';



    $hmenusize_class = ( $hmenusize == 'fullwidth' ) ? 'fullwidth' : 'autowidth';



    if ( !$logoImg && $blogname ) $brand_content = 'blogname';

    if ( $logoImg ) $brand_content = 'logo';

    if ( !$logoImg && !$blogname ) $brand_content = 'no-brand';






    ?>
     
<?php $tesheadr_layout = (get_theme_mod('tesseract_header_layout_setting')) ? get_theme_mod('tesseract_header_layout_setting') :'defaultlayout' ; ?>

<?php $tesheadr_inlinelogopos = get_theme_mod('inline_logo_side'); ?>

<?php $tesheadr_vertpadding = (get_theme_mod('tesseract_vertical_header_width')) ? get_theme_mod('tesseract_vertical_header_width') : 230; ?>

<?php 

$menu_bck_img = get_theme_mod('tesseract_header_layout_bck_image');
$bck_image_rpt = (get_theme_mod('tesseract_vertical_header_bck_img_rpt')) ? get_theme_mod('tesseract_vertical_header_bck_img_rpt') : 'disable';
if($menu_bck_img)
{
  //$menu_bck_img_url = 'background:url(../images/site-nav-img.png) right center no-repeat #FFF !important; padding:0 15px; overflow:inherit !important;';
  $menu_bck_img_url = 'bck_img';
  if($bck_image_rpt == 'enable'){
  ?>
    <style type="text/css">
      .bck_img{
        background-repeat: repeat;
        background-position: 0 0;
        background:url(<?php echo $menu_bck_img; ?>) right center #FFF !important; padding:0 15px; overflow:inherit !important;
        
      }
    </style>
  <?php
  }
  else{
    ?>
    <style type="text/css">
      .bck_img{
        background:url(<?php echo $menu_bck_img; ?>) right center no-repeat #FFF !important; padding:0 15px; overflow:inherit !important;
        
      }
    </style>
    <?php
  }
}
else
{
  $menu_bck_img_url = '';
}
$tesheadr_menu = (get_theme_mod('tesseract_vertical_header_menu_fixed')) ? get_theme_mod('tesseract_vertical_header_menu_fixed') : 'disable';
if($tesheadr_menu)
{
  if($tesheadr_menu == 'enable'){
    $tesheadr_menu_fixed = 'header-fixed';
    $tesheadr_content_fixed = 'content-fixed';

  }
  else
  {
    $tesheadr_menu_fixed = 'header-not-fixed';
    $tesheadr_content_fixed = '';
  }
}
else
{
  $tesheadr_menu_fixed = 'header-not-fixed';
  $tesheadr_content_fixed = '';
}
$header_upper_color = (get_theme_mod('tesseract_header_upper_color_top_part')) ? get_theme_mod('tesseract_header_upper_color_top_part') : '#000000';
$top_enable = (get_theme_mod( 'tesseract_header_upper_status' )) ? get_theme_mod( 'tesseract_header_upper_status' ) : 'disable';

//echo "---------------------------> ".$tesheadr_layout;

?>



<?php if( basename( get_page_template() ) != 'landing-page.php' ){ ?>

    
    <?php if ( $tesheadr_layout == 'none' ) { ?>

    <?php } elseif ( $tesheadr_layout == 'defaultlayout') {?>

    <header id="masthead_TesseractTheme" class="mob-view site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '.$tesheadr_menu_fixed.' '.$menu_bck_img_url.' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
      <?php if($top_enable == 'enable'){ ?>
          <div class="header-upper" style="background-color:<?php echo $header_upper_color; ?>">
            <div class="head-main">
            <?php 
                tesseract_header_upper_html('left');
            ?>
            <div class="tes-centre-right">
              <?php
                tesseract_header_upper_html('centre');
                tesseract_header_upper_html('right');
              ?>
            </div>
            
            </div>
          </div>
      <?php } ?>
      
      <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content.' '; ?>">

        <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
          
          <div id="mobile-menu-trigger-wrap" class="cf cf-res-menu"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

          <div id="site-banner-left" class="header-lower">

            <div id="site-banner-left-inner">



              <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></span>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php ///} ?>

              <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';



    					if ( $menuSelected !== 'none' ) : ?>

              <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

                <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

              </nav>

              <!-- #site-navigation -->

              

              <?php endif; ?>

            </div>

          </div>

          <?php get_template_part( 'content', 'header-rightcontent' ); ?>

        </div>

      </div>
     
    </header>
    <style>
      .header-lower{
        display: inline-block !important;
        width: 65% !important;
      }
      
    </style>

    <?php } elseif ( $tesheadr_layout == 'logoleftnavleft' ) {?>

    <header id="masthead_TesseractTheme" class="mob-view site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '.$tesheadr_menu_fixed.' '.$menu_bck_img_url.' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
      <?php if($top_enable == 'enable'){ ?>
          <div class="header-upper" style="background-color:<?php echo $header_upper_color; ?>">
            <div class="head-main">
            <?php 
                tesseract_header_upper_html('left');
            ?>
            <div class="tes-centre-right">
              <?php
                tesseract_header_upper_html('centre');
                tesseract_header_upper_html('right');
              ?>
            </div>
            
            </div>
          </div>
      <?php } ?>
      
      <div id="site-banner" class="nav-left-logo-left cf<?php echo ' ' . $headright_content . ' ' . $brand_content.' '; ?>">

        <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
          
          <div id="mobile-menu-trigger-wrap" class="cf cf-res-menu"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

          <div id="site-banner-left" class="header-lower">

            <div id="site-banner-left-inner">



              <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>


                <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></span>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php ///} ?>

              <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';



              if ( $menuSelected !== 'none' ) : ?>

              <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

                <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

              </nav>

              <!-- #site-navigation -->

              

              <?php endif; ?>

            </div>

          </div>

          <?php get_template_part( 'content', 'header-rightcontent' ); ?>

        </div>

      </div>
    
    </header>

    <?php } elseif ( $tesheadr_layout == 'navbottom' ) { ?>

    <header id="masthead_TesseractTheme" class="mob-view site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '.$tesheadr_menu_fixed.' '.$menu_bck_img_url.' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
    <?php if($top_enable == 'enable'){ ?>
       <div class="header-upper" style="background-color:<?php echo $header_upper_color; ?>">
       <div class="head-main">
        <?php 
                tesseract_header_upper_html('left');
            ?>
            <div class="tes-centre-right">
              <?php
                tesseract_header_upper_html('centre');
                tesseract_header_upper_html('right');
              ?>
            </div>
        </div>
        </div>
    <?php } ?>
      <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?> bottomNav">

        <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

          <div id="mobile-menu-trigger-wrap" class="cf cf-res-menu"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>
          

          <div id="site-banner-left">

            <div id="site-banner-left-inner">

              <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></span>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>

            </div>

          </div>

          <?php get_template_part( 'content', 'header-rightcontent' ); ?>

        </div>

        <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';

    			if ( $menuSelected !== 'none' ) : ?>

        <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

          <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

        </nav>

        <!-- #site-navigation -->

        <?php endif; ?>

      </div>

    </header>

    <?php } elseif( $tesheadr_layout == 'navright' ) { ?>

    <header id="masthead_TesseractTheme" class="mob-view site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '.$tesheadr_menu_fixed.' '.$menu_bck_img_url.' '; echo get_header_image() ? 'is-header-image' : 'no-header-image nav-right-logo-left'; ?>" role="banner">
    <?php if($top_enable == 'enable'){ ?>
               <div class="header-upper" style="background-color:<?php echo $header_upper_color; ?>">
               <div class="head-main">
                  <?php 
                          tesseract_header_upper_html('left');
                      ?>
                      <div class="tes-centre-right">
                        <?php
                          tesseract_header_upper_html('centre');
                          tesseract_header_upper_html('right');
                        ?>
                      </div>
        </div>
        </div>
    <?php } ?>
      <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?>">

        <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

          <div id="mobile-menu-trigger-wrap" class="cf cf-res-menu"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

         
          <div id="site-banner-left">

            <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                  <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                  <?php else : ?>

                  <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                      <?php echo $header_text; ?>
                    </span>

                    </a>
                  </span>

                <?php endif; ?>
                
              </div>

          </div>


          <div id="" class="banner-right">
          <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';

          if ( $menuSelected !== 'none' ) : ?>
              <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

                <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

              </nav>
            <?php endif; ?>
            <?php  $social_icon_menu = (get_theme_mod('tesseract_vertical_menu_social_icon')) ? get_theme_mod('tesseract_vertical_menu_social_icon') : 'disable'; ?>
            <?php if($social_icon_menu == 'enable'){?>
                <ul class="hr-social2">
                  <?php 
                    $bln_tesseract_social_account_right = false;
                    for ( $i = 1; $i <= 10; $i++ ) 
                    {
                      $account_number = sprintf( '%02d', $i );
                      $sn_img = get_theme_mod( "tesseract_social_account{$account_number}_image" );
                      if ( $sn_img ) 
                      {
                        $sn_name = get_theme_mod( "tesseract_social_account{$account_number}_name" );
                        $sn_url = get_theme_mod( "tesseract_social_account{$account_number}_url" );
                        if ( $sn_name && $sn_url ) 
                        {
                          $bln_tesseract_social_account_right = true;
                          echo '<li><a title="Follow Us on ' . $sn_name . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_name . ' icon" /></a></li>';
                        }
                      }
                    } 
                    if($bln_tesseract_social_account_right == false)
                    {
                      echo "<li>Add your social accounts and they'll appear here.</li>";
                    } 
                  ?>
                </ul>
          <?php } ?>
          </div>

        </div>

      </div>

    </header>
    <?php $sep_clr = (get_theme_mod('tesseract_header_social_separator_color')) ? get_theme_mod('tesseract_header_social_separator_color') : '#000'; ?>
    <style>
      .nav-right-logo-left .banner-right .hr-social2{
        border-left: 1px solid <?php echo $sep_clr; ?>;
      }
    </style>

    <?php } elseif( $tesheadr_layout == 'navleft' ) { ?>

    <header id="masthead_TesseractTheme" class="mob-view navleftlogoright site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '.$tesheadr_menu_fixed.' '.$menu_bck_img_url.' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
    <?php if($top_enable == 'enable'){ ?>
               <div class="header-upper" style="background-color:<?php echo $header_upper_color; ?>">
               <div class="head-main">
            <?php 
                tesseract_header_upper_html('left');
            ?>
            <div class="tes-centre-right">
              <?php
                tesseract_header_upper_html('centre');
                tesseract_header_upper_html('right');
              ?>
            </div>
        </div>
        </div>
    <?php } ?>
      <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?>">

        <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

          <div id="mobile-menu-trigger-wrap" class="cf cf-res-menu"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

          
          <div id="site-banner-left-inner">

            <div id="site-banner-left-inner">

              <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';

    			if ( $menuSelected !== 'none' ) : ?>

              <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

                <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

              </nav>

              <!-- #site-navigation -->

              <?php endif; ?>

              <?php// if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></span>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>

            </div>

          </div>

        </div>

      </div>

    </header>

    <?php } elseif( $tesheadr_layout == 'navcentered' ) { ?>

    <header id="masthead_TesseractTheme" class="mob-view site-header <?php echo $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '.$tesheadr_menu_fixed.' '.$menu_bck_img_url.' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
    <?php if($top_enable == 'enable'){ ?>
               <div class="header-upper" style="background-color:<?php echo $header_upper_color; ?>">
               <div class="head-main">
        <?php 
                tesseract_header_upper_html('left');
            ?>
            <div class="tes-centre-right">
              <?php
                tesseract_header_upper_html('centre');
                tesseract_header_upper_html('right');
              ?>
            </div>
        </div>
        </div>
    <?php } ?>
      <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' '; ?> centeredNav">

        <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

          
          <div class="row">

            <div class="col-md-12">

              <?php// if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></span>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>

            </div>

            <div class="col-md-12">

              <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

              <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';

    			if ( $menuSelected !== 'none' ) : ?>

              <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

                <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

              </nav>

              <!-- #site-navigation -->

              <?php endif; ?>

            </div>

          </div>

        </div>

      </div>

    </header>

    <?php } elseif( $tesheadr_layout == 'centered-inline-logo' ) { ?>

    <header id="masthead_TesseractTheme" class="mob-view site-header <?php echo $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '.$tesheadr_menu_fixed.' '.$menu_bck_img_url.' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
      <?php if($top_enable == 'enable'){ ?>
               <div class="header-upper" style="background-color:<?php echo $header_upper_color; ?>">
               <div class="head-main">
        <?php 
                tesseract_header_upper_html('left');
            ?>
            <div class="tes-centre-right">
              <?php
                tesseract_header_upper_html('centre');
                tesseract_header_upper_html('right');
              ?>
            </div>
        </div>
        </div>
      <?php } ?>
    	<div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' '?> centered-inline-logo">

        <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

         
          <div class="row">
            <div class="col-md-12 dsk-menu">

              <div id="mobile-menu-trigger-wrap" class="cf cf-res-menu"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

              <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';

          if ( $menuSelected !== 'none' ) : ?>

              <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

                <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

              </nav>

              <!-- #site-navigation -->

              <?php endif; ?>

            </div>
            <div class="col-md-12 mob-menu">
              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></span>

                <?php endif; ?>
              </div>
              <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">
                <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>
              </nav>
            </div>

          </div>

        </div>

      </div>

    </header>


    <?php } elseif( $tesheadr_layout == 'vertical-left' ) { 
      $social_icon_menu = (get_theme_mod('tesseract_vertical_menu_social_icon')) ? get_theme_mod('tesseract_vertical_menu_social_icon') : 'disable';
    ?>
      <style>
      #site-banner.blogname .site-title a{
        white-space: normal !important;
      }
      #site-banner {
      	border-bottom: none !important;
     }
    </style>
    <div class="fl-page verticalNavLeftContainer">

    <header id="masthead_TesseractTheme" class="mob-view site-header verticalLeftHeader <?php echo $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '.$menu_bck_img_url.' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" style="width:<?php echo $tesheadr_vertpadding; ?>px;" role="banner" >

      <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?> vertical">

        <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

          <?php //if ( $logoImg || $blogname ) { ?>

          <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></span>

                <?php endif; ?>

              </div>

          <!-- .site-branding -->

          <?php //} ?>

          <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

          <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';

    			if ( $menuSelected !== 'none' ) : ?>

          <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

            <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

          </nav>
          

          <!-- #site-navigation -->

          <?php endif; ?>

        </div>
        <?php if($social_icon_menu == 'enable'){?>
            <ul class="hr-social2">
                  <?php 
                    $bln_tesseract_social_account_right = false;
                    for ( $i = 1; $i <= 10; $i++ ) 
                    {
                      $account_number = sprintf( '%02d', $i );
                      $sn_img = get_theme_mod( "tesseract_social_account{$account_number}_image" );
                      if ( $sn_img ) 
                      {
                        $sn_name = get_theme_mod( "tesseract_social_account{$account_number}_name" );
                        $sn_url = get_theme_mod( "tesseract_social_account{$account_number}_url" );
                        if ( $sn_name && $sn_url ) 
                        {
                          $bln_tesseract_social_account_right = true;
                          echo '<li><a title="Follow Us on ' . $sn_name . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_name . ' icon" /></a></li>';
                        }
                      }
                    } 
                    if($bln_tesseract_social_account_right == false)
                    {
                      echo "<li>Add your social accounts and they'll appear here.</li>";
                    } 
                  ?>
                </ul>
          <?php } ?>

      </div>
      

    </header>

    <?php } elseif( $tesheadr_layout == 'vertical-right' ) { 
       $social_icon_menu = (get_theme_mod('tesseract_vertical_menu_social_icon')) ? get_theme_mod('tesseract_vertical_menu_social_icon') : 'disable';

    ?>
    <style>
      #site-banner.blogname .site-title a{
        white-space: normal !important;
      }
      #site-banner {
      	border-bottom: none !important;
     }
    </style>
    <div class="fl-page verticalNavRightContainer">

    <header id="masthead_TesseractTheme" class="mob-view site-header verticalRightHeader <?php echo $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '.$menu_bck_img_url.' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" style="width:<?php echo $tesheadr_vertpadding; ?>px;" role="banner">

      <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?> vertical">

        <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

          <?php //if ( $logoImg || $blogname ) { ?>

          <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></span>

                <?php endif; ?>

              </div>

          <!-- .site-branding -->

          <?php //} ?>

          <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

          <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';

    			if ( $menuSelected !== 'none' ) : ?>

          <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

            <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

          </nav>

          <!-- #site-navigation -->

          <?php endif; ?>

        </div>
         <?php if($social_icon_menu == 'enable'){?>
            <ul class="hr-social2">
                  <?php 
                    $bln_tesseract_social_account_right = false;
                    for ( $i = 1; $i <= 10; $i++ ) 
                    {
                      $account_number = sprintf( '%02d', $i );
                      $sn_img = get_theme_mod( "tesseract_social_account{$account_number}_image" );
                      if ( $sn_img ) 
                      {
                        $sn_name = get_theme_mod( "tesseract_social_account{$account_number}_name" );
                        $sn_url = get_theme_mod( "tesseract_social_account{$account_number}_url" );
                        if ( $sn_name && $sn_url ) 
                        {
                          $bln_tesseract_social_account_right = true;
                          echo '<li><a title="Follow Us on ' . $sn_name . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_name . ' icon" /></a></li>';
                        }
                      }
                    } 
                    if($bln_tesseract_social_account_right == false)
                    {
                      echo "<li>Add your social accounts and they'll appear here.</li>";
                    } 
                  ?>
                </ul>
          <?php } ?>

      </div>

    </header>

    <?php } ?>

    

    <!-- #masthead -->

    <?php if ( $tesheadr_layout == 'vertical-left' ) { ?>

    <div id="content_TesseractTheme" class="cf site-content" style="margin-left:<?php echo $tesheadr_vertpadding; ?>px;">

    <?php } elseif ( $tesheadr_layout == 'vertical-right' ) { ?>

    <div id="content_TesseractTheme" class="cf site-content" style="margin-right:<?php echo $tesheadr_vertpadding; ?>px;">

    <?php } else { ?>

    <div id="content_TesseractTheme" class="cf site-content <?php echo $tesheadr_content_fixed; ?>">

    <?php } ?>
<?php } else { ?>
  <div id="content_TesseractTheme" class="cf">
<?php } ?>
<?php
$tesseract_header_logo_height_mob = (get_theme_mod('tesseract_header_logo_height_mob')) ? get_theme_mod('tesseract_header_logo_height_mob') : 100;
//echo "Current Pixel: ".$tesseract_header_logo_height_mob;
?>
<style type="text/css">

  @media screen and (max-width:1023px) {
    #site-banner .site-logo img {
            max-width: <?php echo $tesseract_header_logo_height_mob; ?>px !important;
            height: auto !important;
        }
  }
</style>

