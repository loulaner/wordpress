</div><!-- /pages #end -->
</div> <!-- /Container #end -->
<?php templ_content_end(); // content end hooks?>
<?php get_template_part( 'footer_bottom' ); // footer bottom. ?>
 
 <?php templ_before_footer(); // content end hooks?>
 <div class="footer">
  <div class="footer_in">
    <p class="copyright">&copy; 2011 <a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a>. 保留所有权利. </p>
    <p class="credits">设计：<a href="http://www.4mudi.com">wordpress主题</a></p>
  </div>
</div> <!-- footer #end -->
<?php templ_after_footer(); // content end hooks?>

</div>

 

<?php wp_footer(); ?>
<?php echo (get_option('ga')) ? get_option('ga') : '' ?>
<?php templ_body_end(); // Body end hooks?>
	</body>
</html>