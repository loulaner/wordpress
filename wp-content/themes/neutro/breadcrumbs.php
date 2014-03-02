<?php
/**
 * The template for displaying Breadcumbs
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>

<?php if(!is_home() && !is_front_page() ){

if ( current_theme_supports( 'breadcrumb-trail' ) ) {
	breadcrumb_trail(
		array( 
			'container' => 'nav', 
			'separator' => '&rarr;', 
			'labels'    => array( 
					'browse' => __( 'Browse: ', 'neutro' ) 
				) 
		) 
	);

}} ?>