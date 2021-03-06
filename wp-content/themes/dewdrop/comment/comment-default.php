<?php

// This file is part of the Carrington Text Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2009 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

global $post, $comment;

extract($data); // for comment reply link

?>
<div id="comment-<?php comment_ID(); ?>" <?php comment_class('hentry'); ?>>
	<div class="entry-content comment-content">
	


<div class="comment-head">
<span class="author"><?php comment_author_link();�?></span>

<span class="comment-time">
<?php 
echo '<a href="'.htmlspecialchars(get_comment_link( $comment->comment_ID )).'">',comment_date(),' | ',comment_time(),'</a>';
?>
</span>

</div>
<?php
if (function_exists('get_avatar')) { 
	echo '<a href="'.htmlspecialchars(get_comment_link( $comment->comment_ID )).'">',get_avatar($comment,100),'</a>';
}
?>	
<?php 

if ($comment->comment_approved == '0') {

?>
		<p class="notification"><strong><?php _e('(Your comment is awaiting moderation)', 'carrington-text'); ?></strong></p>


<?php 

}
comment_text();

?>
	</div><!--.entry-content-->
	<div class="clear"></div>
	<div class="meta">

<?php

edit_comment_link(__('Edit', 'carrington-text'), '<span class="comment-editlink">', '</span>');

?>


	</div>
</div>