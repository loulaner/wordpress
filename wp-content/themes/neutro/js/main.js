// Masonry JS
function gutterSize(){
  var smallTabletPotraitSize = Modernizr.mq( "screen and (min-width: 480px) and (max-width: 767px)" );

  if(smallTabletPotraitSize.matches){
    return 30;
  }
  else{
    return 26;
  }
  
}

// Masonry options

jQuery( document ).ready( function( $ ) {
  var $container = jQuery('#container');

  $container.imagesLoaded( function() {
    $container.masonry({
        itemSelector : '.content .item',
        bindResize : true,
        // columnWidth: container.querySelector('.item'), 
        gutter: gutterSize()
    });
  });
});