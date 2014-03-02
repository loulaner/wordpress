<?php
/**
 * Featured slider Template
 *
 * Display sticky post in featured image slider.
 *
 * @package Neutro
 * @subpackage Template
 * @since 1.0
 */
?>
<?php if(is_home() && !is_paged() && hybrid_get_setting('featured_slider_display') != 1 ): ?>

<div class="flexslider">

<?php

  $do_not_duplicate = array();
  $sticky = get_option( 'sticky_posts' );
  $categories_slider = hybrid_get_setting( 'featured_slider_categories' );
  
  // If no featured slider category selected, get all sticky post. No sticky post? get 3 latest posts.
  if(empty($categories_slider) ){
    $query = array( 'post__in' => $sticky);
  } 
  else if ( !empty( $categories_slider ) && is_array( $categories_slider ) )
  {
    $query =  array( 'cat' => implode(",", $categories_slider), 'post__not_in' => $do_not_duplicate );
  } 
  else{
    $query = array( 'posts_per_page' => 3 ); // Default, get 3 latest post
  }

  $loop = new WP_Query( $query ); 
?>

    <ul class="slides">
      <?php while ( $loop->have_posts() ) : $loop->the_post(); $do_not_duplicate[] = $post->ID; ?>
         
        <li>
           <?php if ( current_theme_supports( 'get-the-image' ) ) 
             get_the_image( 
              array( 'size' => 'featured-image',
                      'width' => 768,
                      'height' => 372, 
                      'image_class' => 'flexslider-thumb', 
                      'before' => '<figure>', 
                      'after' => '</figure>' ,
                      'default_image' => THEME_URI.'/images/default-image.jpg'
              )); ?>
           
           <h2 class="flex-caption"><a href="<?php echo the_permalink(); ?>"> <?php echo the_title(); ?> </a></h2>
        </li>
      <?php endwhile; ?>

    </ul>

</div>
<!-- End flexslider -->
<?php endif; ?>