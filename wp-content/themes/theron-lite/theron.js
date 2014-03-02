/* <![CDATA[ */
//THERON JavaScript 

jQuery(window).load(function($) {
jQuery('.logo:has(img)').css({"paddingBottom":"0px"});

jQuery('.comments_template .navigation a, .comments_template .navigation span').wrapAll('<div class="compagin" />');


//IE FIX
//IE SELECTORS
jQuery('.lay1 .hentry:eq(3), .lay1 .hentry:eq(7), .lay1 .hentry:eq(11), .lay1 .hentry:eq(15), .lay1 .hentry:eq(19), .lay1 .hentry:eq(23), .lay2 .hentry:eq(2), .lay2 .hentry:eq(5), .lay2 .hentry:eq(8), .lay2 .hentry:eq(11), .lay2 .hentry:eq(14), .lay2 .hentry:eq(17), .lay3 .hentry:eq(2), .lay3 .hentry:eq(5), .lay3 .hentry:eq(8), .lay3 .hentry:eq(11), .lay3 .hentry:eq(14), .lay3 .hentry:eq(17), .ads-125x125 a:eq(1) img, .ads-125x125 a:eq(3) img').css({'margin-Right':'0px'});


//FRONTPAGE SOCIAL ANIMATION
jQuery('.social_wrap ul li a').hoverIntent(function(){
jQuery(this).animate({'background-position-y': '-36px'}, 100, 'linear');
}, function(){
jQuery(this).animate({'background-position-y': '0%'}, 100, 'linear');
	});
	
	
	
	//MENU Animation
	if (jQuery(window).width() > 480) {
	jQuery('#topmenu ul > li').hoverIntent(function(){
	jQuery(this).find('.sub-menu:first, ul.children:first').slideDown({ duration: 200});
	}, function(){
	jQuery(this).find('.sub-menu:first, ul.children:first').slideUp({ duration: 200});	
	});
	jQuery('#topmenu ul li').not('#topmenu ul li ul li').hover(function(){
	jQuery(this).addClass('menu_hover');
	}, function(){
	jQuery(this).removeClass('menu_hover');	
	});
	jQuery('#topmenu li').has("ul").addClass('zn_parent_menu');
	jQuery('.zn_parent_menu > a').append("<span></span>");

	
	//Midrow Blocks Equal Width
	if(jQuery('.midrow_block').length == 4){ jQuery('.midrow_blocks').addClass('fourblocks'); }
	if(jQuery('.midrow_block').length == 3){ jQuery('.midrow_blocks').addClass('threeblocks'); }
	if(jQuery('.midrow_block').length == 2){ jQuery('.midrow_blocks').addClass('twoblocks'); }
	if(jQuery('.midrow_block').length == 1){ jQuery('.midrow_blocks').addClass('oneblock'); }
	jQuery('.midrow_block').equalHeights();
	}

//Layout 1 Date Animation
	jQuery('.lay1 .date_meta').css({"left":"-80px"});
 	jQuery('.lay1 .hentry').hoverIntent(function(){
	jQuery(this).find('.date_meta').animate({ "left":"0px"}, 200);
	}, function(){
	jQuery(this).find('.date_meta').animate({"left":"-80px"}, 100);	
	});


	//Comment Form
jQuery('.comment-form-author, .comment-form-email, .comment-form-url').wrapAll('<div class="field_wrap" />');

//copyright text width	
jQuery("#copyright").find('#footmenu:empty').parent().addClass('no_fmenu');
	
});


/* ]]> */