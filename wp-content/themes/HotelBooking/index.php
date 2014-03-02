<?php get_header(); ?>


        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('home_slider')){?><?php } else {?>  <?php }?>
  <div id="pages" class="clear bgnone index_page">      
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('index_page_content_left')){?><?php } else {?>  <?php }?>


<?php get_footer(); ?>