
<?php
/*
Template Name: Blog
*/
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>

</head>


<body <?php body_class(); ?>>

 <!--SOCIAL ICONS-->   
<div class="social_wrap">
    <div class="social">
<ul>
<?php if ( of_get_option('fbsoc_text') ) { ?>
<li class="soc_fb"><a title="Facebook" target="_blank" href="<?php echo of_get_option('fbsoc_text'); ?>">Facebook</a></li><?php } ?>
<?php if ( of_get_option('ttsoc_text') ) { ?>
<li class="soc_tw"><a title="Twitter" target="_blank" href="<?php echo of_get_option('ttsoc_text'); ?>">Twitter</a></li><?php } ?>
<?php if ( of_get_option('gpsoc_text') ) { ?>
<li class="soc_plus"><a title="Google Plus" target="_blank" href="<?php echo of_get_option('gpsoc_text'); ?>">Google Plus</a></li><?php } ?>
<?php if ( of_get_option('ytbsoc_text') ) { ?>
<li class="soc_ytb"><a title="Youtube" target="_blank" href="<?php echo of_get_option('ytbsoc_text'); ?>">Youtube</a></li><?php } ?>
<?php if ( of_get_option('flkrsoc_text') ) { ?>
<li class="soc_flkr"><a title="Flickr" target="_blank" href="<?php echo of_get_option('flkrsoc_text'); ?>">Flickr</a></li><?php } ?>
<?php if ( of_get_option('lnkdsoc_text') ) { ?>
<li class="soc_lnkd"><a title="Linkedin" target="_blank" href="<?php echo of_get_option('lnkdsoc_text'); ?>">Linkedin</a></li><?php } ?>
<?php if ( of_get_option('pinsoc_text') ) { ?>
<li class="soc_pin"><a title="Pinterest" target="_blank" href="<?php echo of_get_option('pinsoc_text'); ?>">Pinterest</a></li><?php } ?>
<?php if ( of_get_option('tmblrsoc_text') ) { ?>
<li class="soc_tmblr"><a title="Tumblr" target="_blank" href="<?php echo of_get_option('tmblrsoc_text'); ?>">Tumblr</a></li><?php } ?>
<?php if ( of_get_option('instasoc_text') ) { ?>
<li class="soc_insta"><a title="Instagram" target="_blank" href="<?php echo of_get_option('instasoc_text'); ?>">Instagram</a></li><?php } ?>
<?php if ( of_get_option('vimsoc_text') ) { ?>
<li class="soc_vim"><a title="Vimeo" target="_blank" href="<?php echo of_get_option('vimsoc_text'); ?>">Vimeo</a></li><?php } ?>
<?php if ( of_get_option('rsssoc_text') ) { ?>
<li class="soc_rss"><a title="Rss Feed" target="_blank" href="<?php echo of_get_option('rsssoc_text'); ?>">RSS</a></li><?php } ?>
</ul>
    </div>
</div>
  <!--SOCIAL ICONS END-->   
</div> 

<!--HEADER START-->
<div class="headcenter">
<div id="header">


    	<!--LOGO START-->
        <div class="logo">
        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name') ;?></a></h1>
        <div class="desc"><?php bloginfo('description')?></div>
        </div>
        
        <!--LOGO END-->
        
        <!--MENU STARTS-->
        <div id="menu_wrap"><div class="center"><div id="topmenu"><?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?></div></div></div>
        <!--MENU END-->
        

</div>
</div>

<?php if ( is_singular()) {?><div class="center"><div class="slide_shadow"></div></div><?php } ?>
<!--HEADER END-->

    <div class="center">

<div id="content">
<div class="lay5">
<div class="single_wrap">

                   <?php
	 $args = array(
				   'cat' => ''.$zn_blog = of_get_option('blog_cat').'',
				   'post_type' => 'post',
				   'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
				   );

	query_posts($args);

while (have_posts()) : the_post();?>
                   
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
<div class="single_post">                
                <div class="post_content">
                    <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="single_metainfo"><a <?php if ( the_title( ' ', ' ', false ) == "" ) {?> href="<?php the_permalink(); ?>"<?php } ?> class="comm_date"><?php the_time( get_option('date_format') ); ?></a><?php if(of_get_option('dissauth_checkbox') == "0"){ ?>  <a class="meta_auth"><?php the_author(); ?></a><?php } ?>
                    <?php edit_post_link(); ?>
                    </div>
                    <div class="theron_post_wrap"><?php the_content(); ?> </div>
                    <div style="clear:both"></div>
                    <div class="theron_post_wrap"><?php wp_link_pages('<p class="pages"><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?></div>
                    
                    
                    <!--Post Footer-->
                    <div class="post_foot">
					<?php if(of_get_option('disscats_checkbox') == "0"){ ?>
                        <div class="post_meta">
     <?php if( has_tag() ) { ?><div class="post_tag"><div class="tag_list"><?php the_tags('','  '); ?></div></div><?php } ?>
     <?php if( has_category() ) { ?><div class="post_cat"><div class="catag_list"><?php the_category(' '); ?></div></div><?php } ?>
                        
                        </div>
					<?php } ?>
                        
                   </div>
                    
                </div>
                
<?php if(of_get_option('dissshare_checkbox') == "0"){ ?><?php get_template_part('share_this');?><?php } ?>
                
                        </div>
                </div>                        
            <?php endwhile ?> 


</div>
                            <?php if (function_exists("theron_paginate")) {theron_paginate();} ?>

    </div>

            
<?php if(of_get_option('nosidebar_checkbox') == "0"){ ?><?php get_sidebar();?><?php } ?>
	</div>
<?php get_footer(); ?>