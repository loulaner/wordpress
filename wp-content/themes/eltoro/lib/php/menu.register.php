<?php
	if ( function_exists('register_nav_menu') ) {
		register_nav_menus(
			array(
				'header_menu' => '主菜单',
				'footer_menu' => '页脚菜单'
            )
		);
	}
?>