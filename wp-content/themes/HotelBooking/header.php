<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title ( '|', true,'right' ); ?></title>
   <?php do_action('templ_head_meta');?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
    <?php do_action('templ_head_css');?>
	<?php
    wp_enqueue_script('jquery');
    wp_enqueue_script('cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', 'jquery', false);
    wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery_02.js', 'jquery', false);
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', 'jquery', false);
    do_action('templ_head_js');
	wp_head();
	?>

</head>
<body <?php body_class(); ?>>
<?php templ_body_start(); // Body Start hooks?>
<?php templ_get_top_header_navigation_above() ?>


<div class="wrapper">
<?php templ_header_start(); // Header Start hooks?>
<div class="header clear">
  <div class="header_in">
    <div class="logo">
      <?php  templ_site_logo(); ?>
    </div>
    <div class="header_right">
      <?php if (function_exists('dynamic_sidebar')){ dynamic_sidebar('header_logo_right_side'); }?>
      
      	<?php /*?><div class="for_reservation">
        	<h3> For Reservations</h3>
        	<p class="i_booking"><a href="#">Book Online</a></p>
            <p class="i_phone">0844 575 8888 </p>
        </div><?php */?>
        
      
    </div>
  </div> <!-- header inner #end -->
</div> <!-- header #end -->


<div class="main_nav">
  <?php templ_get_main_header_navigation(); ?>
</div> <!-- main navi #end -->

<?php templ_header_end(); // Header End hooks?>

<?php templ_content_start(); // content start hooks?>


<?php $page_layout = templ_get_page_layout();
		if($page_layout=='full_width'){ 
			$layoutclass="";
		} 
		else if($page_layout=='2_col_right'){ 
			$layoutclass="two_col_right_sidebg";
		}
		else if($page_layout=='2_col_left'){ 
			$layoutclass="two_col_left_sidebg";
		}
		else if($page_layout=='3_col_fix'){ 
			$layoutclass="three_col_fixed_sidebg";
		}
		else if($page_layout=='3_col_right'){ 
			$layoutclass="three_col_right_sidebg";
		}
		else if($page_layout=='3_col_left'){ 
			$layoutclass="three_col_left_sidebg";
			
		}
		
	
		
		?>

<!-- Container -->
<div id="container" class="clear <?php echo $layoutclass; ?>">