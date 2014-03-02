<?php

// Excerpt length

function bm_better_excerpt($length, $ellipsis) {
$text = get_the_content();
$text = strip_tags($text);
$text = substr($text, 0, $length);
$text = substr($text, 0, strrpos($text, " "));
$text = $text.$ellipsis;
return $text;
}

 ///////////NEW FUNCTIONS  START//////
function bdw_get_images($iPostID,$img_size='thumb',$no_images='') 
{
    $arrImages =& get_children('order=ASC&orderby=menu_order ID&post_type=attachment&post_mime_type=image&post_parent=' . $iPostID );
	$counter = 0;
	$return_arr = array();
	if($arrImages) 
	{		
       foreach($arrImages as $key=>$val)
	   {
	   		$id = $val->ID;
			if($img_size == 'large')
			{
				$img_arr = wp_get_attachment_image_src($id,'full');	// THE FULL SIZE IMAGE INSTEAD
				$return_arr[] = $img_arr[0];
			}
			elseif($img_size == 'medium')
			{
				$img_arr = wp_get_attachment_image_src($id, 'medium'); //THE medium SIZE IMAGE INSTEAD
				$return_arr[] = $img_arr[0];
			}
			elseif($img_size == 'thumb')
			{
				$img_arr = wp_get_attachment_image_src($id, 'thumbnail'); // Get the thumbnail url for the attachment
				$return_arr[] = $img_arr[0];
			}
			$counter++;
			if($no_images!='' && $counter==$no_images)
			{
				break;	
			}
	   }
	  return $return_arr;
	}
}
function get_payment_optins($method)
{
	global $wpdb;
	$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_$method'";
	$paymentinfo = $wpdb->get_results($paymentsql);
	if($paymentinfo)
	{
		foreach($paymentinfo as $paymentinfoObj)
		{
			$option_value = unserialize($paymentinfoObj->option_value);
			$paymentOpts = $option_value['payOpts'];
			$optReturnarr = array();
			for($i=0;$i<count($paymentOpts);$i++)
			{
				$optReturnarr[$paymentOpts[$i]['fieldname']] = $paymentOpts[$i]['value'];
			}
			//echo "<pre>";print_r($optReturnarr);
			return $optReturnarr;
		}
	}
}
function get_site_emailId()
{
	
	if(get_option('ptthemes_site_email'))
	{
		return get_option('ptthemes_site_email');	
	}
	return get_option('admin_email');
}
function get_site_emailName()
{
	
	if(get_option('ptthemes_site_name'))
	{
		return stripslashes(get_option('ptthemes_site_name'));	
	}
	return stripslashes(get_option('blogname'));
}

/************************************
//FUNCTION NAME : commentslist
//ARGUMENTS :comment data, arguments,depth level for comments reply
//RETURNS : Comment listing format
***************************************/
function commentslist($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li>
        <div id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>            
        <div class="comment_left">
            <?php echo get_avatar($comment, 45, get_bloginfo('template_url').'/images/no-avatar.png'); ?>
       
            <div class="comment-meta">
                <?php printf(__('<p class="comment-author"><span>%s</span></p>','templatic'), get_comment_author_link()) ?>
                <?php printf(__('<p class="comment-date">%s</p>','templatic'), get_comment_date(templ_get_date_format())) ?>
              
              <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <span class="comment_arrow"></span>
        </div>
            <div class="comment-text">
                <?php if ($comment->comment_approved == '0') : ?>
                    <p><?php _e('Your comment is awaiting moderation.','templatic') ?></p>
                    <br/>
                <?php endif; ?>
                <?php comment_text() ?>
            </div>
         </div>
<?php
}


// ---------------------------------------------------------------------- ///
//Shortcodes add --------------------------------------------------------
//----------------------------------------------------------------------- /// 

// Shortcodes - Messages -------------------------------------------------------- //
function message_download( $atts, $content = null ) {
   return '<p class="download">' . $content . '</p>';
}
add_shortcode( 'Download', 'message_download' );

function message_alert( $atts, $content = null ) {
   return '<p class="alert">' . $content . '</p>';
}
add_shortcode( 'Alert', 'message_alert' );

function message_note( $atts, $content = null ) {
   return '<p class="note">' . $content . '</p>';
}
add_shortcode( 'Note', 'message_note' );


function message_info( $atts, $content = null ) {
   return '<p class="info">' . $content . '</p>';
}
add_shortcode( 'Info', 'message_info' );


// Shortcodes - About Author -------------------------------------------------------- //

function about_author( $atts, $content = null ) {
   return '<div class="about_author">' . $content . '</p></div>';
}
add_shortcode( 'Author Info', 'about_author' );


function icon_list_view( $atts, $content = null ) {
   return '<div class="check_list">' . $content . '</p></div>';
}
add_shortcode( 'Icon List', 'icon_list_view' );


// Shortcodes - Boxes -------------------------------------------------------- //

function normal_box( $atts, $content = null ) {
   return '<div class="boxes normal_box">' . $content . '</p></div>';
}
add_shortcode( 'Normal_Box', 'normal_box' );

function warning_box( $atts, $content = null ) {
   return '<div class="boxes warning_box">' . $content . '</p></div>';
}
add_shortcode( 'Warning_Box', 'warning_box' );

function about_box( $atts, $content = null ) {
   return '<div class="boxes about_box">' . $content . '</p></div>';
}
add_shortcode( 'About_Box', 'about_box' );

function download_box( $atts, $content = null ) {
   return '<div class="boxes download_box">' . $content . '</p></div>';
}
add_shortcode( 'Download_Box', 'download_box' );

function info_box( $atts, $content = null ) {
   return '<div class="boxes info_box">' . $content . '</p></div>';
}
add_shortcode( 'Info_Box', 'info_box' );


function alert_box( $atts, $content = null ) {
   return '<div class="boxes alert_box">' . $content . '</p></div>';
}
add_shortcode( 'Alert_Box', 'alert_box' );



// Shortcodes - Boxes - Equal -------------------------------------------------------- //

function normal_box_equal( $atts, $content = null ) {
   return '<div class="boxes normal_box small">' . $content . '</p></div>';
}
add_shortcode( 'Normal_Box_Equal', 'normal_box_equal' );

function warning_box_equal( $atts, $content = null ) {
   return '<div class="boxes warning_box small">' . $content . '</p></div>';
}
add_shortcode( 'Warning_Box_Equal', 'warning_box_equal' );

function about_box_equal( $atts, $content = null ) {
   return '<div class="boxes about_box small">' . $content . '</p></div>';
}
add_shortcode( 'About_Box_Equal', 'about_box' );

function download_box_equal( $atts, $content = null ) {
   return '<div class="boxes download_box small">' . $content . '</p></div>';
}
add_shortcode( 'Download_Box_Equal', 'download_box_equal' );

function info_box_equal( $atts, $content = null ) {
   return '<div class="boxes info_box small">' . $content . '</p></div>';
}
add_shortcode( 'Info_Box_Equal', 'info_box_equal' );


function alert_box_equal( $atts, $content = null ) {
   return '<div class="boxes alert_box small">' . $content . '</p></div>';
}
add_shortcode( 'Alert_Box_Equal', 'alert_box_equal' );


// Shortcodes - Content Columns -------------------------------------------------------- //

function one_half_column( $atts, $content = null ) {
   return '<div class="one_half_column left">' . $content . '</p></div>';
}
add_shortcode( 'One_Half', 'one_half_column' );

function one_half_last( $atts, $content = null ) {
   return '<div class="one_half_column right">' . $content . '</p></div><div class="clear_spacer clearfix"></div>';
}
add_shortcode( 'One_Half_Last', 'one_half_last' );


function one_third_column( $atts, $content = null ) {
   return '<div class="one_third_column left">' . $content . '</p></div>';
}
add_shortcode( 'One_Third', 'one_third_column' );

function one_third_column_last( $atts, $content = null ) {
   return '<div class="one_third_column_last right">' . $content . '</p></div><div class="clear_spacer clearfix"></div>';
}
add_shortcode( 'One_Third_Last', 'one_third_column_last' );


function one_fourth_column( $atts, $content = null ) {
   return '<div class="one_fourth_column left">' . $content . '</p></div>';
}
add_shortcode( 'One_Fourth', 'one_fourth_column' );

function one_fourth_column_last( $atts, $content = null ) {
   return '<div class="one_fourth_column_last right">' . $content . '</p></div><div class="clear_spacer clearfix"></div>';
}
add_shortcode( 'One_Fourth_Last', 'one_fourth_column_last' );


function two_thirds( $atts, $content = null ) {
   return '<div class="two_thirds left">' . $content . '</p></div>';
}
add_shortcode( 'Two_Third', 'two_thirds' );

function two_thirds_last( $atts, $content = null ) {
   return '<div class="two_thirds_last right">' . $content . '</p></div><div class="clear_spacer clearfix"></div>';
}
add_shortcode( 'Two_Third_Last', 'two_thirds_last' );


function dropcaps( $atts, $content = null ) {
   return '<p class="dropcaps">' . $content . '</p>';
}
add_shortcode( 'Dropcaps', 'dropcaps' );


// Shortcodes - Small Buttons -------------------------------------------------------- //

function small_button( $atts, $content ) {
 return '<div class="small_button '.$atts['class'].'">' . $content . '</div>';
}
add_shortcode( 'Small_Button', 'small_button' );




// filters add -------------///

add_filter('templ_top_header_nav_below_filter','templ_main_header_nav_above_fun');
function templ_main_header_nav_above_fun()
{
?>
    <ul class="member_link">
    <?php
    global $current_user;
    if($current_user->data->ID)
    {
    ?>
    <?php
    if(add_filter('templ_tophdr_welcome_filter',true))
	{
	?>
    <li><a href="<?php echo get_author_posts_url($current_user->data->ID);?>"><?php echo __('Welcome ','templatic'). $current_user->data->display_name;?></a></li>
    <?php
	}
	?>
    <li><a href="<?php echo site_url();?>/?ptype=profile"><?php _e('Profile','templatic');?></a></li>
    <li><a href="<?php echo site_url();?>/?ptype=login&amp;action=logout"><?php _e('Logout','templatic');?></a></li> 
    <?php	
    }else
    {
    ?>
    <li><a href="<?php echo site_url();?>/?ptype=register"><?php _e('Register','templatic');?></a></li>
    <li><a href="<?php echo site_url();?>/?ptype=login"><?php _e('Sign In','templatic');?></a></li> 
    <?php	
    }
    ?>
     <li><a href="<?php echo site_url();?>/?ptype=add_step1"><?php _e('Add Listing','templatic');?></a></li> 
    </ul>
<?php
}

add_filter('templ_head_css','templ_print_css');
function templ_print_css()
{
	
?>


<link rel="stylesheet" type="text/css" href="<?php echo TT_CSS_FOLDER_URL; ?>print.css" media="print" />
<?php
}
function get_pagination($targetpage,$total_pages,$limit=10,$page=0,$extra_url = '')
		{
			/* Setup page vars for display. */
			if ($page == 0) $page = 1;					//if no page var is given, default to 1.
			$prev = $page - 1;							//previous page is page - 1
			$next = $page + 1;							//next page is page + 1
			$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
			$lpm1 = $lastpage - 1;						//last page minus 1
			
			if(strstr($targetpage,'?'))
			{
				$querystr = "&pagination";
			}else
			{
				$querystr = "?pagination";
			}
			$pagination = "";
			if($lastpage > 1)
			{	
				$pagination .= "<div class=\"pagination\">";
				//previous button
				if ($page > 1) 
					$pagination.= '<a href="'.$targetpage.$querystr.'='.$prev.$extra_url.'">&laquo; previous</a>';
				else
					$pagination.= "<span class=\"disabled\">&laquo; previous</span>";	
				
				//pages	
				if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
				{	
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= '<a href="'.$targetpage.$querystr.'='.$counter.$extra_url.'">'.$counter.'</a>';					
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
				{
					//close to beginning; only hide later pages
					if($page < 1 + ($adjacents * 2))		
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= '<a href="'.$targetpage.$querystr.'='.$counter.$extra_url.'">'.$counter.'</a>';					
						}
						$pagination.= "...";
						$pagination.= '<a href="'.$targetpage.$querystr.'='.$lpm1.$extra_url.'">'.$lpm1.'</a>';
						$pagination.= '<a href="'.$targetpage.$querystr.'='.$lastpage.$extra_url.'">'.$lastpage.'</a>';		
					}
					//in middle; hide some front and some back
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= '<a href="'.$targetpage.$querystr.'=1'.$extra_url.'">1</a>';
						$pagination.= '<a href="'.$targetpage.$querystr.'=2'.$extra_url.'">2</a>';
						$pagination.= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= '<a href='.$targetpage.$querystr.'='.$counter.$extra_url.'">'.$counter.'</a>';					
						}
						$pagination.= "...";
						$pagination.= '<a href="'.$targetpage.$querystr.'='.$lpm1.$extra_url.'">'.$lpm1.'</a>';
						$pagination.= '<a href="'.$targetpage.$querystr.'='.$lastpage.$extra_url.'">'.$lastpage.'</a>';		
					}
					//close to end; only hide early pages
					else
					{
						$pagination.= '<a href="'.$targetpage.$querystr.'=1'.$extra_url.'">1</a>';
						$pagination.= '<a href="'.$targetpage.$querystr.'=2'.$extra_url.'">2</a>';
						$pagination.= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= '<a href="'.$targetpage.$querystr.'='.$counter.$extra_url.'">'.$counter.'</a>';					
						}
					}
				}
				
				//next button
				if ($page < $counter - 1) 
					$pagination.= '<a href="'.$targetpage.$querystr.'='.$next.$extra_url.'">next &raquo;</a>';
				else
					$pagination.= "<span class=\"disabled\">next &raquo;</span>";
				$pagination.= "</div>\n";		
			}
			return $pagination;
		}

?>