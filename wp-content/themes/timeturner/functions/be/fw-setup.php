<?php
/**
 * Framework setup.
 * @package TimeTurner
 * @since TimeTurner 1.0.0
*/

function timeturner_get_categories($parent) {	
	$timeturner_categories = get_categories();
	
	foreach ($timeturner_categories as $cat) {
		$categories[$cat->term_id] = $cat->name;
	} 
	return($categories);
}
		$categories = timeturner_get_categories(0);
		$categoriesParents = timeturner_get_categories(0);
		
	if (count($categories) > 0) {
	foreach ( $categories as $key => $value ) {
			$catids[] = $key;
			$catnames[] = $value;
	}
	}
	if (count($categoriesParents) > 0){
	foreach ( $categoriesParents as $key => $value ) {

		$catidsp[] = $key;
			$catnamesp[] = $value;
		}
}

function timeturner_bar_menu() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
		$admin_dir = get_admin_url();
		
	$wp_admin_bar->add_menu( array(
	'id' => 'custom_menu',
	'title' => __( 'Theme Options', 'timeturner' ),
	'href' => $admin_dir .'admin.php?page=fw-options.php',
	'meta' => array('title' => 'TimeTurner Setup', 'class' => 'timeturnerpanel') ) );
}
add_action('admin_bar_menu', 'timeturner_bar_menu', '1000');
?>