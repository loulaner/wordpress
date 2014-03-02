<?php
/**
 * Mobile search Form Template
 *
 * The search form template displays the search form on mobile devices.
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>

<div class="container">
  <div class="row">
    <div class="span12" id="mobile-search-wrapper"> 
      <div class="mobile-search-widget">
        <form class="navbar-form" id="mobile-top-search" action="<?php echo trailingslashit( home_url() ); ?>">
          <input id="mobile-search" type="search"  name="s" value="<?php if ( is_search() ) echo esc_attr( get_search_query() ); else esc_attr_e( 'Search this site...', 'neutro' ); ?>">          
        </form>
      </div>
      <!-- End mobile search widget -->
    </div>
  </div>
</div>
<!-- End mobile search -->