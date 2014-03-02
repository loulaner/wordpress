<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Neutro
 * @subpackage Functions
 * @version    1.0.2
 * @since      1.0
 * @author     Septian Ahmad Fujianto <septianahmad@naisinpo.com>
 * @copyright  Copyright (c) 2013, Septian Ahmad Fujianto
 * @link       http://seotemplates.net/blog/theme/neutro-wordpress-theme/
 * @license    http://www.gnu.org/licenses/gpl.html
 */

/* Load the core theme framework. */
require_once(trailingslashit(get_template_directory()).'library/hybrid.php' );
new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'neutro_theme_setup' );

function neutro_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Load Theme Settings */
	if ( is_admin() ) 
        require_once(trailingslashit(get_template_directory()) . 'admin/admin.php' );

    /* Load Theme Customizer */
	if ( is_admin() ) 
        require_once(trailingslashit(get_template_directory()) . 'admin/customizer.php' );

    // Enables settings page
    add_theme_support( 'hybrid-core-theme-settings', array( 'footer', 'about') ); 

	/* Register menus. */
	add_theme_support( 
		'hybrid-core-menus', 
		array( 'primary', 'secondary') 
	);

	/* Register sidebars. */
	add_theme_support( 
		'hybrid-core-sidebars', 
		array( 'primary', 'secondary', 'tertiary' ) 
	);

	/* Load scripts. */
	add_theme_support( 
		'hybrid-core-scripts', 
		array( 'comment-reply' ) 
	);

	/* Load styles. */
	add_theme_support( 
		'hybrid-core-styles', 
		array( 'gallery', 'parent','style', ) 
	);

	
	/* Load widgets. */
	add_theme_support( 'hybrid-core-widgets' );

	/* Load shortcodes. */
	add_theme_support( 'hybrid-core-shortcodes' );

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Load the media grabber. */
	add_theme_support( 'hybrid-core-media-grabber' );

	/* Allow per-post stylesheets. */
	add_theme_support( 'post-stylesheets' );

	/* Support pagination instead of prev/next links. */
	add_theme_support( 'loop-pagination' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Use breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* Post formats. */
	add_theme_support( 
		'post-formats', 
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) 
	);

	/* Custom background. */
	add_theme_support( 
		'custom-background',
		array( 'default-color' => '#f9f9f9' )
	);

	/* Load custom scripts. */
	add_action( 'wp_enqueue_scripts', 'neutro_enqueue_scripts' );

	/*	Load custom styles.	*/
	add_action( 'wp_enqueue_scripts', 'neutro_enqueue_styles' );

	/*	Set default image sizes for featured image	*/
	add_image_size('featured-image', 768, 372, true );

	/* Exclude sticky posts from home page. */
	add_action( 'pre_get_posts', 'neutro_exclude_sticky' );

	/*	Hook custom css value from Theme Options to wp_head  */
	add_action('wp_head', 'neutro_customizer_css');

	/*	Hook customizer css value to wp_head  */
	add_action('wp_head', 'neutro_custom_css');

	/* Register tertiary sidebar */
	add_action( 'widgets_init', 'neutro_register_sidebars', 11 );

	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 768 );

}

/**
 * Echo the custom css value of Theme Options custom css box.
 * 
 * @since 1.0
 * @return string custom css. 
 */
function neutro_custom_css(){
	$custom_css = hybrid_get_setting('custom_css');

	if(!empty( $custom_css ) ) :
?>
	<style type="text/css">
		<?php echo  htmlspecialchars_decode( $custom_css ) ; ?>
	</style>

<?php endif;
}

/**
 * Echo Theme customizer css value.
 * 
 * @since 1.0
 * @return string Theme customizer css.
 */
function neutro_customizer_css(){
	$customizer_options = get_option( 'neutro_customizer' ); 

	if(!empty($customizer_options) ){ ?>
		
		<style type="text/css">
            a { color: <?php echo $customizer_options['link_color']; ?>; }
            #header-container{ background: <?php echo $customizer_options['header_color'] ?>;}
            #secondary-menu-container, .secondary-menu ul li ul li{ background: <?php echo $customizer_options['secondary_menu_color']; ?> }
            .footer-container{ background: <?php echo $customizer_options['footer_color'] ?>; }
        </style>

<?php }
}

/**
 * Registers the Theme Customizer Preview with WordPress.
 *
 * @package    Neutro
 * @since      1.0
 */
add_action( 'customize_preview_init', 'neutro_customizer_live_preview' );

function neutro_customizer_live_preview() {

        wp_enqueue_script(
                'neutro-theme-customizer',
                THEME_URI . '/js/min/theme-customizer.min.js',
                array( 'jquery', 'customize-preview' ),
                '0.3.0',
                true
        );

} 

/**
 * Enqueue javascripts for WordPress theme Frontend.
 * 
 * @since 1.0
 */
function neutro_enqueue_scripts() {
	wp_enqueue_script( 'modernizr', hybrid_locate_theme_file( array('js/min/modernizr.min.js') ) , 
		array('jquery'), '2.6.2', false );

	if(is_home() && !is_paged() && hybrid_get_setting('featured_slider_display') != 1 ){
		wp_enqueue_script( 'flexslider', hybrid_locate_theme_file( array('js/min/jquery.flexslider-min.js') ) , 
			array('jquery'), '2.2.0', true );

		if(neutro_is_ie8() )
		{
			wp_enqueue_script( 'flexslider-options.ie', hybrid_locate_theme_file( array('js/flexslider-options.ie.js') ) , 
				array('jquery'), false, true );
		} 
		else{
			wp_enqueue_script( 'flexslider-options', hybrid_locate_theme_file( array('js/flexslider-options.js') ) , 
				array('jquery'), false, true );
		}
		
	}

	if(!is_singular() ){
		/** if it's  <= IE 8, use older version script **/
		if(neutro_is_ie8() )
		{
		    wp_enqueue_script('jquery-masonry');
		   	wp_enqueue_script( 'main.ie', hybrid_locate_theme_file( array('js/main.ie.js') ) , 
				array('jquery', 'modernizr'), false, true );
		}
		else{
			wp_enqueue_script( 'imagesloaded', hybrid_locate_theme_file( array('js/min/imagesloaded.pkgd.min.js') ) , 
				array('jquery'), '3.0.4', true );
			wp_enqueue_script( 'masonry', hybrid_locate_theme_file( array('js/min/masonry.pkgd.min.js') ) , 
				array('jquery'), '3.1.0', true );
		   	wp_enqueue_script( 'main', hybrid_locate_theme_file( array('js/main.js') ) , 
				array('jquery', 'modernizr'), false, true );
		}

		
	}

	wp_enqueue_script( 'menus', hybrid_locate_theme_file( array('js/responsive-menu.js') ) , 
		array('jquery'), false, true );
	wp_enqueue_script( 'search', hybrid_locate_theme_file( array('js/toggle-search.js') ) , 
		array('jquery'), false, true );
	
}

/**
 * Enqueue CSS for WordPress theme Frontend.
 * 
 * @since 1.0
 */
function neutro_enqueue_styles() {
	wp_enqueue_style( 'bootstrap', hybrid_locate_theme_file( array('css/bootstrap.css') ), 
		'false', false, 'all' );
	wp_enqueue_style( 'bootstrap-responsive', hybrid_locate_theme_file( array('css/bootstrap-responsive.min.css') ), 
		'false', false, 'all' );
	wp_enqueue_style( 'genericons', hybrid_locate_theme_file( array('css/genericons.css') ), 
		'false', false, 'all' );

	if(is_home() && !is_paged() && hybrid_get_setting('featured_slider_display') != 1 ){
		wp_enqueue_style( 'flexslider', hybrid_locate_theme_file( array('css/flexslider.css') ), 
			'false', false, 'all' );
	}
	
	wp_enqueue_style( 'main', hybrid_locate_theme_file( array('css/main.css') ), 
		'false', array('bootstrap', 'bootstrap-responsive', 'genericons') , 'all' );
}


/**
 * Add custom class on post_class
 * 
 * @since 1.0
 * @param type $classes 
 * @return string filter class
 */
function neutro_post_class($classes){	
	/*	Don't add .item on singular post type */
	if(!is_singular() && !is_404() ){
		$classes[] = 'item';
	}

	return  $classes;
}

add_filter( 'post_class', 'neutro_post_class');


/**
 * Add custom class on next posts link
 * 
 * @since 1.0
 * @param string $html 
 * @return string filtered html 
 */
function add_class_next_post_link($html){
    $html = str_replace('<a','<a class="next"',$html);
    return $html;
}

add_filter('next_post_link','add_class_next_post_link',10,1);


/**
 * Add custom class on previous posts link
 * 
 * @since 1.0
 * @param string $html 
 * @return string filtered html
 */
function add_class_previous_post_link($html){
    $html = str_replace('<a','<a class="prev"',$html);
    return $html;
}

add_filter('previous_post_link','add_class_previous_post_link',10,1);


/**
 * Add custom attributes on previous comment link
 * 
 * @since 1.0
 * @param string $class 
 * @return string new attribute
 */
function neutro_previous_comments_link($class){
	$class = 'class="prev" ';
    return $class;
}

add_filter( 'previous_comments_link_attributes', 'neutro_previous_comments_link' );

/**
 *Add custom attributes on next comment link
 * 
 * @since 1.0
 * @param string $class 
 * @return string new attribute
 */
function neutro_next_comments_link($class){
	$class = 'class="next" ';
    return $class;
}

add_filter( 'next_comments_link_attributes', 'neutro_next_comments_link' );


/**
 * Custom args for comment area avatar size
 * 
 * @since 1.0
 * @param array $args 
 * @return array
 */
function add_neutro_list_comments_args($args){
	 $args['avatar_size'] = '45';

	return $args;
}

add_filter( 'neutro_list_comments_args', 'add_neutro_list_comments_args');


/**
 * Custom Footer content / footer_insert using [neutro-link] Shortcodes.
 * This function is made in order to alter credits link to 'Neutro Theme' from default 'Neutro WordPress Theme'
 * 
 * @since 1.0.1
 * @param array $settings 
 * @return array
 */
function neutro_theme_settings($settings){
	/* Set up some default variables. */
	$settings = array();

	/* Get theme-supported meta boxes for the settings page. */
	$supports = get_theme_support( 'hybrid-core-theme-settings' );

	/* If the current theme supports the footer meta box and shortcodes, add default footer settings. */
	if ( is_array( $supports[0] ) && in_array( 'footer', $supports[0] ) && current_theme_supports( 'hybrid-core-shortcodes' ) ) {

		/* If there is a child theme active, add the [child-link] shortcode to the $footer_insert. */
		if ( is_child_theme() )
			$settings['footer_insert'] = '<p class="copyright">' . __( 'Copyright &#169; [the-year] [site-link].', 'neutro' ) . '</p>' . "\n\n" . '<p class="credit">' . __( 'Powered by [wp-link], [neutro-link], and [child-link].', 'neutro' ) . '</p>';

		/* If no child theme is active, leave out the [child-link] shortcode. */
		else
			$settings['footer_insert'] = '<p class="copyright">' . __( 'Copyright &#169; [the-year] [site-link].', 'neutro' ) . '</p>' . "\n\n" . '<p class="credit">' . __( 'Powered by [wp-link] and [neutro-link].', 'neutro' ) . '</p>';
	}

	return $settings;
}

add_filter('neutro_default_theme_settings', 'neutro_theme_settings');


/**
 * Register tertiary sidebar
 * 
 * @since 1.0 
 * @return void
 */
function neutro_register_sidebars(){
	register_sidebar( 
		array( 
			'name' => __( 'Tertiary', 'neutro' ), 
			'id' => 'tertiary', 
			'before_widget' => '<section id="%1$s" class="widget %2$s widget-%2$s">', 
			'after_widget' => '</section>', 
			'before_title' => '<h3 class="widget-title">', 
			'after_title' => '</h3>' 
		) );
}

/**
 * Set custom comment form arguments 
 * 
 * @since 1.0
 * @return array of custom comment form arguments
 */
function neutro_comments_args(){
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$valid_email = '';

	$comments_args = array(
		'id_submit'=>'btn-comment-submit',
       	'fields' => apply_filters( 'comment_form_default_fields',  array( 
       		'author' =>
		      '<div class="view-row">' .

		      '<div class="view-item item-title clearfix hidden-phone hidden-tablet">
		      	<span class="form-icon icon-name"></span> <span>' . __( 'Name', 'neutro' ) . '</span> 
		       </div> 
  			   <span class="mobile-title visible-phone visible-tablet">' . __( 'Name', 'neutro' ) . '' . ( $req ? '*' : '' ) . ' </span>

	      	   <div class="view-item input">
		      	<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="Fill your name  ' . ( $req ? __('(required)', 'neutro')  : '' ) . '" size="30"' . $aria_req . ' />
		      </div>

		      </div>',

	      	'email' =>
		      '<div class="view-row">' .

		      '<div class="view-item item-title clearfix hidden-phone hidden-tablet">
		      	<span class="form-icon icon-mail"></span> <span>' . __( 'Email', 'neutro' ) . '</span> 
		       </div> 
  			   <span class="mobile-title visible-phone visible-tablet">' . __( 'Email', 'neutro' ) . ' ' . ( $req ? '*' : '' ) . ' </span>

	      	   <div class="view-item input">
		      	<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="Fill your email ' . ( $req ? __('(required)', 'neutro')  : '' ) . '" size="30"' . $aria_req . ' />
		      </div>

		      </div>',

	      	'url' =>
		      '<div class="view-row">' .

		      '<div class="view-item item-title clearfix hidden-phone hidden-tablet">
		      	<span class="form-icon icon-link"></span> <span>' . __( 'Website', 'neutro' ) . '</span> 
		       </div> 
  			   <span class="mobile-title visible-phone visible-tablet">' . __( 'Website', 'neutro' ) . ' </span>

	      	   <div class="view-item input">
		      	<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  placeholder="Fill your Website url" size="30" />
		      </div>

		      </div>'

       	)),
        // redefine your own textarea (the comment body)
        'comment_field' => 
        	'<div class="view-row"> 
        		<div class="view-item-wide"> 
        			<textarea id="comment" name="comment" aria-required="true" cols="30" rows="10"></textarea> 
        		</div> 
        	</div>'
	
	);

	return $comments_args;
}

/**
 * Exclude sticky post from Main loop if featured slider displayed.
 * Sticky  post will be displayed on featured slider
 * 
 * @since 1.0
 * @param array $query 
 * @return array
 */
function neutro_exclude_sticky( $query ) {
	/* Exclude if is home, is main query and slider is disabled. */
	if ( is_home() && $query->is_main_query() && hybrid_get_setting('featured_slider_display' ) != 1 ) 
		$query->set( 'post__not_in', get_option( 'sticky_posts' ) );	
}


/*********************************************/
/*			Neutro Shortcode			     */
/*********************************************/

/**
 * Shortcode to display a link to the parent theme page.
 *
 * @since 1.0.1
 * @access public
 * @uses get_theme_data() Gets theme (parent theme) information.
 * @return string
 */
function neutro_theme_link_shortcode() {

	$theme = wp_get_theme( get_template() );
	$themeURI = esc_url( $theme->get( 'ThemeURI' ) );
	$link_title = sprintf( esc_attr__( '%s Theme', 'neutro' ), $theme->get( 'Name' ) );
	$link_content =  esc_attr( $theme->get( 'Name' ) );

	return '<a class="theme-link" href="' . $themeURI . '" title="' . $link_title . '"><span>' . $link_content . '</span></a>';
}

add_shortcode('neutro-link', 'neutro_theme_link_shortcode');


/*********************************************/
/*			Neutro Custom Function			 */
/*********************************************/

/**
 * Strip out malicious code before entering input to database
 * 
 * @since 1.0.2
 * @link http://css-tricks.com/snippets/php/sanitize-database-inputs/
 * 
 * @param string $input 
 * @return string stripped input
 */
function neutro_cleanInput($input) {
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
}

/**
 * Sanitize input before entering to database
 * 
 * @since 1.0.2
 * @link http://css-tricks.com/snippets/php/sanitize-database-inputs/
 * 
 * @param string $input 
 * @return string sanitized inpute
 */
function neutro_sanitize($input) {

    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = neutro_cleanInput($input);
        $output = mysql_real_escape_string($input);
    }

    return $output;
}

/**
 * Get several images from post format gallery and show it on home / index.
 * 
 * @param int $images_count 
 * @param string $width 
 * @param string $height 
 * 
 * @return mixed
 */
function neutro_get_several_gallery_thumbnail($images_count, $width = '372px', $height = '200px'){
	 /* Check if Gallery exist inside post */
    if ( get_post_gallery() ) :
        $gallery = get_post_gallery( get_the_ID(), false );

        $i = 1;
        /* Loop through all the image and output them one by one */
        foreach( $gallery['src'] AS $src )
        { 
            ?>

            <li>
                <figure>
	                <a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	                	<img src="<?php echo $src; ?>" class="my-custom-class" alt="<?php the_title_attribute(); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"/>
	                </a>
                </figure>
            </li>
            
            <?php
	        /* $images_count = How many image will be shown	*/
	        if ($i++ == $images_count) 
	        	break;
	        }

    endif;			
}

/**
 * Give proper attributes to content wrapper based on singular page or not.
 * 
 * @return String of class , id or any attributes for content wrapper
 */
function neutro_wrapper_attribute(){
	$attributes = '';

	if(!is_singular() && !is_404() ){
		$attributes = 'class="content" id="container" ';
	}
	else{
		$attributes = 'class="single-content" ';
	}

	if(has_filter( 'add_neutro_wrapper_attribute') ){
		$attributes = apply_filters( 'add_neutro_wrapper_attribute', $attributes );
	}

	echo $attributes;
}

/**
 * Give post title attributes based on the availibility of Featured image from get_the_image
 * 
 * @return String of title attributes.
 */
function neutro_title_attribute(){
	if (neutro_has_get_the_image() ){
		$attributes = 'class="entry-title"';
	}
	else{
		$attributes = 'class="title"';
	}

	if(has_filter( 'add_neutro_title_attribute') ){
		$attributes = apply_filters( 'add_neutro_title_attribute', $attributes );
	}

	echo $attributes;	
}

/**
 * Check if featured image exist and successfully grabbed by get the image.
 * 
 * @return boolean
 */
function neutro_has_get_the_image(){
	if ( current_theme_supports( 'get-the-image' ) ){
		// Prevent image to be echoed
		$image = get_the_image(array('echo'=>false) );

		if(!empty ($image) ){
			return true;
		} 
		else{
			return false;
		}
	}
}

/**
 * Set Mediaelement player width attribute with percetage
 * 
 * @param type $html 
 * @return string filtered html
 */
function neutro_audio_shortcode( $html ){
	return str_replace('<audio', '<audio width="100%"', $html);
}

add_filter('wp_audio_shortcode', 'neutro_audio_shortcode');

/**
 * Check if browser is Internet Explorer 8.
 * 
 * @return boolean true if IE 8.
 */
function neutro_is_ie8(){
    if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.') !== false) ){
        return true;
    }
    else{
        return false;
    }
}

/**
 * Push value to Associative array
 * 
 * @param array $array The target array
 * @param string $key The key of array
 * @param mixed $value New value 
 * 
 * @return array
 */
function neutro_array_push_assoc($array, $key, $value){
	$array[$key] = $value;
	return $array;
}

/***  DEV ONLY - REMOVE IT ON RELEASE	***/
// function pmc_dev_cachebuster( $src ) {
// 	return add_query_arg( 'ver', time(), $src );
// }
// add_filter( 'style_loader_src', 'pmc_dev_cachebuster' );
// add_filter( 'script_loader_src', 'pmc_dev_cachebuster' );

?>