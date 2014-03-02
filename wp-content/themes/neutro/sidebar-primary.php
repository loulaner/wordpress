<?php
/**
 * Primary sidebar Template
 *
 * Display widget on primary sidebar area
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>
<?php if ( is_active_sidebar( 'primary' ) ) { ?>

	<aside class="span4" id="sidebar-primary">

		<?php dynamic_sidebar( 'primary' ); ?>

	</aside><!-- #sidebar-primary .aside -->

<?php } ?>