<?php
/********************************************************************
You can add your widgets in this file and it will affected.
This is the theme related widgets functions file where you can add you created widget code.\
The file is included in functions.php  file of theme root.
********************************************************************/
// =============================== Book an Appointment  ======================================
if(!class_exists('templ_bookan_appointment'))
{
	class templ_bookan_appointment extends WP_Widget {
		function templ_bookan_appointment() {
		//Constructor
			$widget_ops = array('classname' => 'widget Book a Hotel ', 'description' => apply_filters('templ_templ_bookan_appointment_filter','预订酒店小工具显示前台酒店预订表格') );		
			$this->WP_Widget('widget_templ_bookan_appointment', apply_filters('templ_bookan_appointment_title_filter','T &rarr; 预订酒店'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$desc = empty($instance['desc']) ? '' : apply_filters('widget_desc', $instance['desc']);
			?>						
		   
			<div id="booking">
                <?php if($title){?><h3><?php echo $title; ?></h3><?php }?>
                <?php if($desc){?><p><?php echo $desc; ?></p><?php }?>
				<?php include(TEMPL_USER_BOOKING_FOLDER."widget_form.php");  ?> 
			</div> <!-- booking #end -->
				 

		<?php
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['desc'] = strip_tags($new_instance['desc']);
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );		
			$title = strip_tags($instance['title']);
			$desc = strip_tags($instance['desc']);
		?>
		<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title : ','templatic');?> <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
        
        <p><label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Short Description','templatic');?> : <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo attribute_escape($desc); ?></textarea></label></p>
      
		<?php
	}}
	register_widget('templ_bookan_appointment');
}



// =============================== Contact us  ======================================
if(!class_exists('templ_contact'))
{
	class templ_contact extends WP_Widget {
		function templ_contact() {
		//Constructor
			$widget_ops = array('classname' => 'widget for reservation', 'description' => apply_filters('templ_templ_contact_filter','预订') );		
			$this->WP_Widget('widget_templ_contact', apply_filters('templ_contact_title_filter','T &rarr; 预订'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$text = empty($instance['text']) ? 'For Reservation' : apply_filters('widget_text', $instance['text']);
			$phone = empty($instance['phone']) ? '' : apply_filters('widget_phone', $instance['phone']);
			?>						
		    
                 <div class="for_reservation">
					<?php if($title){?><h3><?php echo $title; ?></h3><?php }?>
                    <?php if($phone){?><p class="i_phone"><?php echo $phone; ?></p><?php }?>
                </div>
                 

		<?php
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['text'] = strip_tags($new_instance['text']);
			$instance['phone'] = strip_tags($new_instance['phone']);
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );		
			$title = strip_tags($instance['title']);
			$text = strip_tags($instance['text']);
			$phone = strip_tags($instance['phone']);
		?>
		<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title : ','templatic');?> <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
        <p><label for="<?php  echo $this->get_field_id('phone'); ?>"><?php _e('Phone Number : ','templatic');?> <input class="widefat" id="<?php  echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo attribute_escape($phone); ?>" /></label></p>
        
      
		<?php
	}}
	register_widget('templ_contact');
}



// =============================== Social Media  ======================================
if(!class_exists('templ_social'))
{
	class templ_social extends WP_Widget {
		function templ_social() {
		//Constructor
			$widget_ops = array('classname' => 'widget for reservation', 'description' => apply_filters('templ_templ_social_filter','预订') );		
			$this->WP_Widget('widget_templ_social', apply_filters('templ_social_title_filter','T &rarr; 预订'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$text = empty($instance['text']) ? 'For Reservation' : apply_filters('widget_text', $instance['text']);
			$phone = empty($instance['phone']) ? '' : apply_filters('widget_phone', $instance['phone']);
			?>						
		    
                 <div class="for_reservation">
					<?php if($title){?><h3><?php echo $title; ?></h3><?php }?>
                    <?php if($phone){?><p class="i_phone"><?php echo $phone; ?></p><?php }?>
                </div>
                 

		<?php
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['text'] = strip_tags($new_instance['text']);
			$instance['phone'] = strip_tags($new_instance['phone']);
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );		
			$title = strip_tags($instance['title']);
			$text = strip_tags($instance['text']);
			$phone = strip_tags($instance['phone']);
		?>
		<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title : ','templatic');?> <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
        <p><label for="<?php  echo $this->get_field_id('phone'); ?>"><?php _e('Phone Number : ','templatic');?> <input class="widefat" id="<?php  echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo attribute_escape($phone); ?>" /></label></p>
        
      
		<?php
	}}
	register_widget('templ_social');
}



// latest post /////////////////////
if(!class_exists('templ_latest_posts_with_date')){
	class templ_latest_posts_with_date extends WP_Widget {
	
		function templ_latest_posts_with_date() {
		//Constructor
		global $thumb_url;
			$widget_ops = array('classname' => 'widget special', 'description' => apply_filters('templ_latestpost_date_widget_desc_filter','文章带日期') );
			$this->WP_Widget('latest_posts_with_date',apply_filters('templ_latestpost_date_widget_title_filter','T &rarr; 文章带日期'), $widget_ops);
		}
	 
		function widget($args, $instance) {
		// prints the widget
	
			extract($args, EXTR_SKIP);
	 
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
			$number = empty($instance['number']) ? '5' : apply_filters('widget_number', $instance['number']);
			$post_type = empty($instance['post_type']) ? 'post' : apply_filters('widget_post_type', $instance['post_type']);
			$more = empty($instance['more']) ? '5' : apply_filters('widget_more', $instance['more']);
			 ?>
			
		 <?php if($title){?> <h3><?php echo $title; ?> </h3> <?php }?>
					<ul class="resources"> 
		<?php 
			global $post;
			if($category)
			{
				$arg = "&category=$category";	
			}
			$today_special = get_posts('numberposts='.$number.$arg);
			foreach($today_special as $post) :
			setup_postdata($post);
			 ?>
		
			<li>	
             <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="title"><?php the_title(); ?></a><br />
            <span class="post-date"><?php the_time('j') ?> <?php the_time('F') ?> <?php the_time('Y') ?> at  <?php the_time('g:i a') ?>  </span> 
             <span class="single_comments"> / <?php comments_popup_link('0 Commment', '1 Commment', '% Commments'); ?> </span> 
           </li>
	<?php endforeach; ?>
			</ul>
            
           <?php if($more){?> <a href="<?php echo $more; ?>" class="more_lnk">More News</a><?php }  ?>
		
	<?php
			echo $after_widget;
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['category'] = strip_tags($new_instance['category']);
			$instance['number'] = strip_tags($new_instance['number']);
			$instance['post_type'] = strip_tags($new_instance['post_type']);
			$instance['more'] = strip_tags($new_instance['more']);
			return $instance;
		}
	 
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '', 'number' => '' ) );
			$title = strip_tags($instance['title']);
			$category = strip_tags($instance['category']);
			$number = strip_tags($instance['number']);
			$post_type = strip_tags($instance['post_type']);
			$more = strip_tags($instance['more']);
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','templatic');?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
	
	<p>
	  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo attribute_escape($number); ?>" />
	  </label>
	</p>
   
	<p>
	  <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Categories (<code>IDs</code> separated by commas):','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" /></label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('more'); ?>"><?php _e('Read More Link : (ex.http://templatic.com/blog)','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('more'); ?>" name="<?php echo $this->get_field_name('more'); ?>" type="text" value="<?php echo attribute_escape($more); ?>" /></label>
	</p>
	<?php
		}
	}
	register_widget('templ_latest_posts_with_date');
}






//  Home Page Banner  /////////////////////
if(!class_exists('templ_home_slider')){
	class templ_home_slider extends WP_Widget {
	
		function templ_home_slider() {
		//Constructor
		global $thumb_url;
			$widget_ops = array('classname' => 'widget Home Slider', 'description' => apply_filters('templ_latestpost_date_widget_desc_filter','首页幻灯片小工具：建议在“首页横幅”区域使用') );
			$this->WP_Widget('home_slider',apply_filters('templ_latestpost_date_widget_title_filter','T &rarr; 首页幻灯片'), $widget_ops);
		}
	 
		function widget($args, $instance) {
		// prints the widget
	
			extract($args, EXTR_SKIP);
	 
			echo $before_widget;
			$f1 = empty($instance['f1']) ? '' : apply_filters('widget_f1', $instance['f1']);
			$f1_url = empty($instance['f1_url']) ? '' : apply_filters('widget_f1_url', $instance['f1_url']);
			$f1_line = empty($instance['f1_line']) ? '' : apply_filters('widget_f1_line', $instance['f1_line']);
			$f1_img = empty($instance['f1_img']) ? '' : apply_filters('widget_f1_img', $instance['f1_img']);
			
			$f2 = empty($instance['f2']) ? '' : apply_filters('widget_f2', $instance['f2']);
			$f2_url = empty($instance['f2_url']) ? '' : apply_filters('widget_f2_url', $instance['f2_url']);
			$f2_line = empty($instance['f2_line']) ? '' : apply_filters('widget_f2_line', $instance['f2_line']);
			$f2_img = empty($instance['f2_img']) ? '' : apply_filters('widget_f2_img', $instance['f2_img']);
			
			$f3 = empty($instance['f3']) ? '' : apply_filters('widget_f3', $instance['f3']);
			$f3_url = empty($instance['f3_url']) ? '' : apply_filters('widget_f3_url', $instance['f3_url']);
			$f3_line = empty($instance['f3_line']) ? '' : apply_filters('widget_f3_line', $instance['f3_line']);
			$f3_img = empty($instance['f3_img']) ? '' : apply_filters('widget_f3_img', $instance['f3_img']);
			
			$f4 = empty($instance['f4']) ? '' : apply_filters('widget_f4', $instance['f4']);
			$f4_url = empty($instance['f4_url']) ? '' : apply_filters('widget_f4_url', $instance['f4_url']);
			$f4_line = empty($instance['f4_line']) ? '' : apply_filters('widget_f4_line', $instance['f4_line']);
			$f4_img = empty($instance['f4_img']) ? '' : apply_filters('widget_f4_img', $instance['f4_img']);
			
			$f5 = empty($instance['f5']) ? '' : apply_filters('widget_f5', $instance['f5']);
			$f5_url = empty($instance['f5_url']) ? '' : apply_filters('widget_f5_url', $instance['f5_url']);
			$f5_line = empty($instance['f5_line']) ? '' : apply_filters('widget_f5_line', $instance['f5_line']);
			$f5_img = empty($instance['f5_img']) ? '' : apply_filters('widget_f5_img', $instance['f5_img']);
			
			$speed = empty($instance['speed']) ? '6000' : apply_filters('widget_speed', $instance['speed']);

			 ?>
			
   
    
 <div id="slider">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" language="javascript" >

// Speed of the automatic slideshow
var slideshowSpeed = <?php if($speed){?><?php echo $speed; ?><?php }  ?>;

// Variable to store the images we need to set as background
// which also includes some text and url's.
var photos = [ <?php if($f1_img != ''){?>{
		//"title" : "",
		"image" : "<?php echo $f1_img; ?>",
		"url" : "<?php if($f1_url){?><?php echo $f1_url; ?><?php }  ?>",
		"firstline" : "<?php if($f1){?><?php echo $f1; ?><?php }  ?>",
		"secondline" : "<?php if($f1_line){?><?php echo $f1_line; ?><?php }  ?>"
	}, <?php }  ?> <?php if($f2_img != ''){?>{
		//"title" : "",
		"image" : "<?php echo $f2_img; ?>",
		"url" : "<?php if($f2_url){?><?php echo $f2_url; ?><?php }  ?>",
		"firstline" : "<?php if($f2){?><?php echo $f2; ?><?php }  ?>",
		"secondline" : "<?php if($f2_line){?><?php echo $f2_line; ?><?php }  ?>"
	},<?php }  ?> <?php if($f3_img != ''){?>{
		//"title" : "",
		"image" : "<?php echo $f3_img; ?>",
		"url" : "<?php if($f3_url){?><?php echo $f3_url; ?><?php }  ?>",
		"firstline" : "<?php if($f3){?><?php echo $f3; ?><?php }  ?>",
		"secondline" : "<?php if($f3_line){?><?php echo $f3_line; ?><?php }  ?>"
	},<?php }  ?> <?php if($f4_img != ''){?>{
		//"title" : "",
		"image" : "<?php echo $f4_img; ?>",
		"url" : "<?php if($f4_url){?><?php echo $f4_url; ?><?php }  ?>",
		"firstline" : "<?php if($f4){?><?php echo $f4; ?><?php }  ?>",
		"secondline" : "<?php if($f4_line){?><?php echo $f4_line; ?><?php }  ?>"
	},<?php }  ?> <?php if($f5_img != ''){?>{
		//"title" : "",
		"image" : "<?php echo $f5_img; ?>",
		"url" : "<?php if($f5_url){?><?php echo $f5_url; ?><?php }  ?>",
		"firstline" : "<?php if($f5){?><?php echo $f5; ?><?php }  ?>",
		"secondline" : "<?php if($f5_line){?><?php echo $f5_line; ?><?php }  ?>"
	}<?php }  ?>
];



jQuery(document).ready(function() {
		
	// Backwards navigation
	jQuery("#back").click(function() {
		stopAnimation();
		navigate("back");
	});
	
	// Forward navigation
	jQuery("#next").click(function() {
		stopAnimation();
		navigate("next");
	});
	
	var interval;
	jQuery("#control").toggle(function(){
		stopAnimation();
	}, function() {
		// Change the background image to "pause"
		jQuery(this).css({ "background-image" : "url(images/btn_pause.png)" });
		
		// Show the next image
		navigate("next");
		
		// Start playing the animation
		interval = setInterval(function() {
			navigate("next");
		}, slideshowSpeed);
	});
	
	
	var activeContainer = 1;	
	var currentImg = 0;
	var animating = false;
	var navigate = function(direction) {
		// Check if no animation is running. If it is, prevent the action
		if(animating) {
			return;
		}
		
		// Check which current image we need to show
		if(direction == "next") {
			currentImg++;
			if(currentImg == photos.length + 1) {
				currentImg = 1;
			}
		} else {
			currentImg--;
			if(currentImg == 0) {
				currentImg = photos.length;
			}
		}
		
		// Check which container we need to use
		var currentContainer = activeContainer;
		if(activeContainer == 1) {
			activeContainer = 2;
		} else {
			activeContainer = 1;
		}
		
		showImage(photos[currentImg - 1], currentContainer, activeContainer);
		
	};
	
	var currentZindex = -1;
	var showImage = function(photoObject, currentContainer, activeContainer) {
		animating = true;
		
		// Make sure the new container is always on the background
		currentZindex--;
		
		// Set the background image of the new active container
		jQuery("#sliderimg" + activeContainer).css({
			"background-image" : "url(" + photoObject.image + ")",
			"display" : "block",
			"z-index" : currentZindex
		});
		
		// Hide the slider text
		jQuery("#slidertxt").css({"display" : "none"});
		
		// Set the new slider text
		jQuery("#firstline").html(photoObject.firstline);
		jQuery("#secondline")
			.attr("href", photoObject.url)
			.html(photoObject.secondline);
		jQuery("#pictureduri")
			.attr("href", photoObject.url)
			.html(photoObject.title);
		
		
		// Fade out the current container
		// and display the slider text when animation is complete
		jQuery("#sliderimg" + currentContainer).fadeOut(function() {
			setTimeout(function() {
				jQuery("#slidertxt").css({"display" : "block"});
				animating = false;
			}, 500);
		});
	};
	
	var stopAnimation = function() {
		// Change the background image to "play"
		jQuery("#control").css({ "background-image" : "url(images/btn_play.png)" });
		
		// Clear the interval
		clearInterval(interval);
	};
	
	// We should statically set the first image
	navigate("next");
	
	// Start playing the animation
	interval = setInterval(function() {
		navigate("next");
	}, slideshowSpeed);
	
});
		</script>
        
        <div id="sliderimgs">
		<div id="sliderimg1" class="sliderimg"></div>
		<div id="sliderimg2" class="sliderimg"></div>
	</div>
    
    	
	
	 
	<!-- Slideshow controls -->
	<div id="slidernav-outer">
		<div id="slidernav">
			<div id="back" class="btn"></div>
			<div id="control" class="btn"></div>
			<div id="next" class="btn"></div>
		</div>
	</div>
	<!-- jQuery handles for the text displayed on top of the images -->
    
    
    
    <div id="slidertxt">
		<p class="caption">
			<span id="firstline"></span>
			<a href="#" id="secondline"></a>
		</p>
		<!--<p class="pictured">
			<a href="#" id="pictureduri"></a>
		</p>-->
	</div>
    
   
 </div> <!-- slider #end -->
            
            		
	<?php
			echo $after_widget;
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;
			$instance['f1'] = strip_tags($new_instance['f1']);
			$instance['f1_url'] = strip_tags($new_instance['f1_url']);
			$instance['f1_line'] = strip_tags($new_instance['f1_line']);
			$instance['f1_img'] = strip_tags($new_instance['f1_img']);
			
			$instance['f2'] = strip_tags($new_instance['f2']);
			$instance['f2_url'] = strip_tags($new_instance['f2_url']);
			$instance['f2_line'] = strip_tags($new_instance['f2_line']);
			$instance['f2_img'] = strip_tags($new_instance['f2_img']);
			
			$instance['f3'] = strip_tags($new_instance['f3']);
			$instance['f3_url'] = strip_tags($new_instance['f3_url']);
			$instance['f3_line'] = strip_tags($new_instance['f3_line']);
			$instance['f3_img'] = strip_tags($new_instance['f3_img']);
			
			$instance['f4'] = strip_tags($new_instance['f4']);
			$instance['f4_url'] = strip_tags($new_instance['f4_url']);
			$instance['f4_line'] = strip_tags($new_instance['f4_line']);
			$instance['f4_img'] = strip_tags($new_instance['f4_img']);
			
			$instance['f5'] = strip_tags($new_instance['f5']);
			$instance['f5_url'] = strip_tags($new_instance['f5_url']);
			$instance['f5_line'] = strip_tags($new_instance['f5_line']);
			$instance['f5_img'] = strip_tags($new_instance['f5_img']);
			
			$instance['speed'] = strip_tags($new_instance['speed']);
			return $instance;
		}
	 
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '', 'number' => '' ) );
			
			$f1 = strip_tags($instance['f1']);
			$f1_url = strip_tags($instance['f1_url']);
			$f1_line = strip_tags($instance['f1_line']);
			$f1_img = strip_tags($instance['f1_img']);
			
			$f2 = strip_tags($instance['f2']);
			$f2_url = strip_tags($instance['f2_url']);
			$f2_line = strip_tags($instance['f2_line']);
			$f2_img = strip_tags($instance['f2_img']);
			
			$f3 = strip_tags($instance['f3']);
			$f3_url = strip_tags($instance['f3_url']);
			$f3_line = strip_tags($instance['f3_line']);
			$f3_img = strip_tags($instance['f3_img']);
			
			$f4 = strip_tags($instance['f4']);
			$f4_url = strip_tags($instance['f4_url']);
			$f4_line = strip_tags($instance['f4_line']);
			$f4_img = strip_tags($instance['f4_img']);

			$f5 = strip_tags($instance['f5']);
			$f5_url = strip_tags($instance['f5_url']);
			$f5_line = strip_tags($instance['f5_line']);
			$f5_img = strip_tags($instance['f5_img']);
			
			$speed = strip_tags($instance['speed']);
			
	?>
	<p>
	  <label for="<?php echo $this->get_field_id('f1'); ?>"><?php _e('Slider 1 Image Main Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f1'); ?>" name="<?php echo $this->get_field_name('f1'); ?>" type="text" value="<?php echo attribute_escape($f1); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f1_line'); ?>"><?php _e('Slider 1 Image Second Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f1_line'); ?>" name="<?php echo $this->get_field_name('f1_line'); ?>" type="text"  value="<?php echo attribute_escape($f1_line); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f1_url'); ?>"><?php _e('Slider 1 Image Second title URL Link :(ex.http://templatic.com)','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f1_url'); ?>" name="<?php echo $this->get_field_name('f1_url'); ?>" type="text" value="<?php echo attribute_escape($f1_url); ?>" />
	  </label>
	</p>
    
    
    <p>
	  <label for="<?php echo $this->get_field_id('f1_img'); ?>"><?php _e('Slider 1 Image Full URL : (ex.http://templatic.com/images/banner.jpg) (images size : width:1400xheight538 pixel ) ','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f1_img'); ?>" name="<?php echo $this->get_field_name('f1_img'); ?>" type="text" value="<?php echo attribute_escape($f1_img); ?>" />
	  </label>
	</p>
    
    
    
    <p>
	  <label for="<?php echo $this->get_field_id('f2'); ?>"><?php _e('Slider 2 Image Main Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f2'); ?>" name="<?php echo $this->get_field_name('f2'); ?>" type="text" value="<?php echo attribute_escape($f2); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f2_line'); ?>"><?php _e('Slider 2 Image Second Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f2_line'); ?>" name="<?php echo $this->get_field_name('f2_line'); ?>" type="text"  value="<?php echo attribute_escape($f2_line); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f2_url'); ?>"><?php _e('Slider 2 Image Second title URL Link :(ex.http://templatic.com)','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f2_url'); ?>" name="<?php echo $this->get_field_name('f2_url'); ?>" type="text" value="<?php echo attribute_escape($f2_url); ?>" />
	  </label>
	</p>
    
    
    <p>
	  <label for="<?php echo $this->get_field_id('f2_img'); ?>"><?php _e('Slider 2 Image Full URL : (ex.http://templatic.com/images/banner.jpg) (images size : width:1400xheight538 pixel ) ','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f2_img'); ?>" name="<?php echo $this->get_field_name('f2_img'); ?>" type="text" value="<?php echo attribute_escape($f2_img); ?>" />
	  </label>
	</p>
    
    
    <p>
	  <label for="<?php echo $this->get_field_id('f3'); ?>"><?php _e('Slider 3 Image Main Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f3'); ?>" name="<?php echo $this->get_field_name('f3'); ?>" type="text" value="<?php echo attribute_escape($f3); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f3_line'); ?>"><?php _e('Slider 3 Image Second Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f3_line'); ?>" name="<?php echo $this->get_field_name('f3_line'); ?>" type="text"  value="<?php echo attribute_escape($f3_line); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f3_url'); ?>"><?php _e('Slider 3 Image Second title URL Link :(ex.http://templatic.com)','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f3_url'); ?>" name="<?php echo $this->get_field_name('f3_url'); ?>" type="text" value="<?php echo attribute_escape($f3_url); ?>" />
	  </label>
	</p>
    
    
    <p>
	  <label for="<?php echo $this->get_field_id('f3_img'); ?>"><?php _e('Slider 3 Image Full URL : (ex.http://templatic.com/images/banner.jpg) (images size : width:1400xheight538 pixel ) ','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f3_img'); ?>" name="<?php echo $this->get_field_name('f3_img'); ?>" type="text" value="<?php echo attribute_escape($f3_img); ?>" />
	  </label>
	</p>
    
    
    <p>
	  <label for="<?php echo $this->get_field_id('f4'); ?>"><?php _e('Slider 4 Image Main Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f4'); ?>" name="<?php echo $this->get_field_name('f4'); ?>" type="text" value="<?php echo attribute_escape($f4); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f4_line'); ?>"><?php _e('Slider 4 Image Second Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f4_line'); ?>" name="<?php echo $this->get_field_name('f4_line'); ?>" type="text"  value="<?php echo attribute_escape($f4_line); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f4_url'); ?>"><?php _e('Slider 4 Image Second title URL Link :(ex.http://templatic.com)','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f4_url'); ?>" name="<?php echo $this->get_field_name('f4_url'); ?>" type="text" value="<?php echo attribute_escape($f4_url); ?>" />
	  </label>
	</p>
    
    
    <p>
	  <label for="<?php echo $this->get_field_id('f4_img'); ?>"><?php _e('Slider 4 Image Full URL :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f4_img'); ?>" name="<?php echo $this->get_field_name('f4_img'); ?>" type="text" value="<?php echo attribute_escape($f4_img); ?>" />
	  </label>
	</p>
    
    
    
        <p>
	  <label for="<?php echo $this->get_field_id('f5'); ?>"><?php _e('Slider 5 Image Main Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f5'); ?>" name="<?php echo $this->get_field_name('f5'); ?>" type="text" value="<?php echo attribute_escape($f5); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f5_line'); ?>"><?php _e('Slider 5 Image Second Title :','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f5_line'); ?>" name="<?php echo $this->get_field_name('f5_line'); ?>" type="text"  value="<?php echo attribute_escape($f5_line); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('f5_url'); ?>"><?php _e('Slider 5 Image Second title URL Link :(ex.http://templatic.com)','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f5_url'); ?>" name="<?php echo $this->get_field_name('f5_url'); ?>" type="text" value="<?php echo attribute_escape($f5_url); ?>" />
	  </label>
	</p>
    
    
    <p>
	  <label for="<?php echo $this->get_field_id('f5_img'); ?>"><?php _e('Slider 5 Image Full URL : (ex.http://templatic.com/images/banner.jpg) (images size : width:1400xheight538 pixel ) ','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('f5_img'); ?>" name="<?php echo $this->get_field_name('f5_img'); ?>" type="text" value="<?php echo attribute_escape($f5_img); ?>" />
	  </label>
	</p>
    
    <p>
	  <label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Slider Rotate Speed Setting : (ex.6000)','templatic');?>
	  <input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo attribute_escape($speed); ?>" />
	  </label>
	</p>
    
    
	<?php
		}
	}
	register_widget('templ_home_slider');
}

class social_media extends WP_Widget {
	function social_media() {
	//Constructor
		$widget_ops = array('classname' => 'widget Social Media', 'description' => apply_filters('templ_socialmedia_widget_desc_filter','社交媒体小工具') );		
		$this->WP_Widget('social_media', apply_filters('templ_socialmedia_widget_title_filter','T &rarr; 社交媒体'), $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$twitter = empty($instance['twitter']) ? '' : apply_filters('widget_twitter', $instance['twitter']);
		$facebook = empty($instance['facebook']) ? '' : apply_filters('widget_facebook', $instance['facebook']);
		$digg = empty($instance['digg']) ? '' : apply_filters('widget_digg', $instance['digg']);
		$linkedin = empty($instance['linkedin']) ? '' : apply_filters('widget_linkedin', $instance['linkedin']);
		$myspace = empty($instance['myspace']) ? '' : apply_filters('widget_myspace', $instance['myspace']);
		$rss = empty($instance['rss']) ? '' : apply_filters('widget_rss', $instance['rss']);
		 ?>						

		<div class="widget social_media">
      	 
       
       <ul>
       	<?php if ( $twitter <> "" ) { ?>	
        	<li><a href="<?php echo $twitter; ?>" > <img src="<?php bloginfo('template_directory'); ?>/images/i_twitter.png" alt=""  /> </a>  </li>
         <?php } ?>
         	<?php if ( $facebook <> "" ) { ?>	
        	<li> <a href="<?php echo $facebook; ?>" > <img src="<?php bloginfo('template_directory'); ?>/images//i_facebook.png" alt=""  /> </a> </li>
         <?php } ?>
         	 
         	<?php if ( $linkedin <> "" ) { ?>	
        	<li> <a href="<?php echo $linkedin; ?>" > <img src="<?php bloginfo('template_directory'); ?>/images/i_linkedin.png" alt=""  /> </a>   </li>
         <?php } ?>
		</ul>
        
        
        </div> <!-- widget #end -->
            
            
	<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter'] = ($new_instance['twitter']);
		$instance['facebook'] = ($new_instance['facebook']);
		$instance['digg'] = ($new_instance['digg']);
		$instance['linkedin'] = ($new_instance['linkedin']);
		$instance['myspace'] = ($new_instance['myspace']);
		$instance['rss'] = ($new_instance['rss']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'twitter' => '', 'facebook' => '', 'digg' => '',  'linkedin' => '', 'myspace' => '','rss' => '' ) );		
		$title = strip_tags($instance['title']);
		$twitter = ($instance['twitter']);
		$facebook = ($instance['facebook']);
		$digg = ($instance['digg']);
		$linkedin = ($instance['linkedin']);		
		$myspace = ($instance['myspace']);
		$rss = ($instance['rss']);
?>
       <p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter Full URL','templatic');?>: <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo attribute_escape($twitter); ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook Full URL','templatic');?> : <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo attribute_escape($facebook); ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin Full URL','templatic');?> : <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo attribute_escape($linkedin); ?>" /></label></p>

<?php
	}}
register_widget('social_media');

?>