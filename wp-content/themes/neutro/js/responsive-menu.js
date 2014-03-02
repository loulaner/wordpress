jQuery(document).ready(function(){
  /* Clone and Append menu content to Adaptive menu */
  jQuery('.main-menu ul:first-child').clone().appendTo('.mobile-main-menu');
  jQuery('.secondary-menu ul:first-child').clone().appendTo('.mobile-secondary-menu');

  /*  Slide Adaptive menu when Menu button clicked  */
  jQuery('#mobile-main-menu-btn').click(function(event){
    event.preventDefault();
    jQuery('.mobile-main-menu').slideToggle();
  });

  jQuery('#mobile-secondary-menu-btn').click(function(event){
    event.preventDefault();
    jQuery('.mobile-secondary-menu').slideToggle();
  });

});
