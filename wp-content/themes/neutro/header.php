<!DOCTYPE html> 
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php hybrid_document_title(); ?></title>

        <!-- mobile meta -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=10.0" />

        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        <?php wp_head(); // wp_head ?>
      
    </head>

    <body class="<?php hybrid_body_class(); ?>">

        <div class="header-wrapper">

              <header class="container">

                <div class="row">
                    <div id="header-container" class="span12">

                      <div class="span4 clearfix" id="menu-wrapper">

                        <a href="" class="btn btn-neutro" id="mobile-main-menu-btn"><span><?php _e( 'Menu', 'neutro' ); ?></span></a>
                        <nav class="mobile-main-menu"></nav>

                        <?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

                      </div>

                      <!--End span 4 navigation-->
                      <div class="span4 clearfix" id="logo-wrapper">
                          <header class="website-logo">

                          <?php $customizer_display_logo = get_theme_mod('display_logo', true); ?>
                          <?php $customizer_default_logo = get_theme_mod('neutro_logo_url', THEME_URI.'/images/logo.png'); ?>

                            <?php if($customizer_display_logo === true ) : ?>
                            
                              <h1 class="logo-heading">
                                <a href="<?php echo home_url(); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"> <img src="<?php echo $customizer_default_logo; ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="logo"></a>
                              </h1>

                            <?php else : ?>
                   
                              <hgroup class="text-logo-group">
                                <h1 class="text-logo"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                <h2 class="text-tagline"><?php bloginfo('description'); ?> </h2>
                              </hgroup>
                            
                            <?php endif; ?>

                          </header>
                      </div>

                      <!--End  logo-->
                      <div class="span4 clearfix" id="search-wrapper">

                        <a class="btn btn-inside pull-right" id="search-menu" href="#"><i class="icon-search icon-white"></i></a>
                        <?php get_search_form(); ?>
                      
                      </div>
                      <!--End  search-->

                    </div>
                    <!--End header container-->
                    
                </div>
                <!--End row header-->

                <?php get_template_part( 'mobile-searchform', 'mobile-search' ); ?>

              </header>
              <!--End header-->
         
          <div id="secondary-menu-container">
            <div class="container">
              <div class="row">
                <div class="span12" id="secodary-menu-wrapper">

                  <a href="" class="btn btn-neutro" id="mobile-secondary-menu-btn"><span><?php _e( 'Menu', 'neutro' ); ?></span></a>
                  <nav class="mobile-secondary-menu"></nav>

                  <?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>

                </div>
              </div>
            </div>
          </div>
          <!-- End secondary menu container -->
        </div>
        <!-- End header wrapper -->