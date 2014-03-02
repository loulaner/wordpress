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

?>
	</div><!--#inside_inner_page-->
	</div><!--#inner_page-->
	</div><!--#page-->
		<div class="clear"></div>
		<div id="footer">
                    <p>Designed by Tim Sainburg from <a href="http://www.bramblingdesign.com">Brambling Design</a></p>
		<img src="<?php bloginfo('template_url') ?>/img/leaf.png" alt="leaf" />
		</div><!--#footer -->
	
	<?php wp_footer() ?>
</body>
</html>