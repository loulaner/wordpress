<?php
/* If a post password is required or no comments are given and comments/pings are closed, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>

<section id="comments-template">

	<div class="comment-area">
	
		<?php get_template_part( 'comments-loop' ); // Loads the comments-loop.php template. ?>

		<?php comment_form( (function_exists('neutro_comments_args') ? neutro_comments_args() : '' ) ); // Loads the comment form. ?>

	</div>

</section>