<?php
/**
 * Secondary sidebar Template
 *
 * Display widget on secondary sidebar area
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>
<?php if ( is_active_sidebar( 'secondary' ) ) { ?>

	<aside class="span2" id="sidebar-secondary">

		<?php dynamic_sidebar( 'secondary' ); ?>

	</aside><!-- #sidebar-secondary .aside -->

<?php } ?>