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

jQuery( function() {

  // initialize Masonry
  var $container = jQuery('#container').masonry();
  // layout Masonry again after all images have loaded
  $container.imagesLoaded( function() {
    $container.masonry({
        itemSelector : '.item',
        bindResize : true,
        // columnWidth: container.querySelector('.item'), 
        gutterWidth : 10
    });
  });
  
});

// if ( jQuery.browser.msie ) {
// 	var browserVersion = jQuery.browser.version;

// 	if(browserVersion <= 8.0){
// 		alert("OLDIE");
// 	} else{
// 		alert("MODERN");
// 	}
//   alert( jQuery.browser.version );
// }