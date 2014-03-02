<?php
/**
 * Tertiary sidebar Template
 *
 * Display widget on tertiary sidebar area
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>
<?php if ( is_active_sidebar( 'tertiary' ) ) { ?>

	<aside class="span2" id="sidebar-tertiary">

		<?php dynamic_sidebar( 'tertiary' ); ?>

	</aside><!-- #sidebar-tertiary .aside -->

<?php } ?>