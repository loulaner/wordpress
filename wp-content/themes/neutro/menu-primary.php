<?php
/**
 * The template for displaying Primary menu in the header
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>

<?php if ( has_nav_menu( 'primary' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'container'       => 'nav',
			'container_id'    => 'menu-primary',
			'container_class' => 'main-menu',
			'menu_id'         => 'menu-primary-items',
			'menu_class'      => 'menu-items',
			'fallback_cb'     => ''	
		)
	);

} ?>