jQuery(document).ready(function(){
    var searchvisible = 0;            
    jQuery("#search-menu").click(function(e){ 
        //This stops the page scrolling to the top on a # link.
        e.preventDefault();
        if (searchvisible ===0) {
            //Search is currently hidden. Slide down and show it.
            jQuery(".mobile-search-widget").slideDown(200);
            jQuery("#mobile-search").focus(); //Set focus on the search input field.
            searchvisible = 1; //Set search visible flag to visible.
        } else {
            //Search is currently showing. Slide it back up and hide it.
            jQuery(".mobile-search-widget").slideUp(200);
            searchvisible = 0;
        }
    });
});