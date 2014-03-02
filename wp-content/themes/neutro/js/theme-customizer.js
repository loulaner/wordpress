/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */

(function( $ ) {
        "use strict";

        //Update link color in real time...
        wp.customize( 'neutro_customizer[link_color]', function( value ) {
                value.bind( function( to ) {
                        $( 'a' ).css( 'color', to );
                } );
        });

        //Update header color in real time...
        wp.customize( 'neutro_customizer[header_color]', function( value ) {
                value.bind( function( to ) {
                        $( '#header-container' ).css( 'background', to );
                } );
        });

        //Update secondary menu color in real time...
        wp.customize( 'neutro_customizer[secondary_menu_color]', function( value ) {
                value.bind( function( to ) {
                        $( '#secondary-menu-container, .secondary-menu ul li ul li' ).css( 'background', to );
                } );
        });

        //Update footer color in real time...
        wp.customize( 'neutro_customizer[footer_color]', function( value ) {
                value.bind( function( to ) {
                        $( '.footer-container' ).css( 'background', to );
                } );
        });


})( jQuery );