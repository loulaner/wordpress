<?php
/**
 * The template for displaying Secondary menu in the header
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>

<?php if ( has_nav_menu( 'secondary' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'secondary',
			'container'       => 'nav',
			'container_id'    => 'menu-secondary',
			'container_class' => 'secondary-menu',
			'menu_id'         => 'menu-secondary-items',
			'menu_class'      => 'menu-items',
			'fallback_cb'     => ''
			
		)
	);

} ?>