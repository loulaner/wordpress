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

global $previousday, $authordata;
$previousday = -1;

?>
<div id="post-content-<?php the_ID() ?>" <?php post_class('hentry full') ?>>


	<div class="post-content-left">
		<div class="cal">
			<p class="month"><?php the_time('M') ?></p>
			<p class="year"><?php the_time('j') ?></p>
		</div>
		
		<div class="post-content-left-meta">
		<address class="author vcard full-author">
			<p>
			<?php printf(__('<span class="by">By</span> %s', 'carrington-text'), '<a class="url fn" href="'.get_author_link(false, get_the_author_ID(), $authordata->user_nicename).'" title="View all posts by ' . attribute_escape($authordata->display_name) . '">'.get_the_author().'</a>') ?>
			</p>
		</address>
		
		<p><!--<p class="comments-link">--><?php comments_popup_link(__('No Comments', 'carrington-text'), __('1 Comment', 'carrington-text'), __('% Comments', 'carrington-text')); ?></p>
		
		<p class="filed categories"><?php printf(__('Categories: %s', 'carrington-text'), get_the_category_list(', ')) ?></p>
		<?php the_tags(__('<p class="filed tags">Tags: ', 'carrington-text'), ', ', '</p>'); ?>
		<!--/filed-->	
		</div>
	</div>
	<div class="post-content-right">
	<div class="post-head">
<h1 class="entry-title full-title"><a href="<?php the_permalink() ?>" title="Permanent link to <?php the_title_attribute() ?>" rel="bookmark" rev="post-<?php the_ID(); ?>"><?php the_title() ?></a></h1>


</div>
	
	<div class="entry-content full-content">
		<?php 
			the_content('<span class="more-link">'.__('Continued...', 	'carrington-text').'</span>'); 
			$args = array(
				'before' => '<p class="pages-link">'. __('Pages: ', 'carrington-text'),
				'after' => "</p>\n",
				'next_or_number' => 'number'
			);
			wp_link_pages($args);
		?>
		
		<div class="clear"></div>
		
	</div><!--/entry-content-->
	</div>
	<div class="clear"></div>
	
	<div class="by-line">
		<?php edit_post_link(__('Edit', 'carrington-text'), '<div class="entry-editlink">', '</div>'); ?>	
	</div><!--/by-line-->
</div><!-- .post -->