<?php
/**
 * Search Form Template
 *
 * The search form template displays the search form.
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>

<div class="search-widget">
	<form class="navbar-form pull-right" id="top-search" action="<?php echo trailingslashit( home_url() ); ?>">
	    <div class="input-append">
	        <input id="search" type="search" name="s" value="" placeholder="<?php if ( is_search() ) echo esc_attr( get_search_query() ); else esc_attr_e( 'Search this site...', 'neutro' ); ?>">        
	        <span class="btn btn-inside" href="#"><i class="icon-search icon-white"></i></span>
	    </div>
	</form>
</div>