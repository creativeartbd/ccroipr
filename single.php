<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ccroipr
 */

get_header();
?>
<div class="container main-container">
	<div class="row">
		<div class="col-lg">
			<main id="primary" class="site-main">
				<?php
				echo '<pre>';
				print_r( get_queried_object() );
				print_r( get_category_by_slug( 'cat-p' ) );
				print_r( get_the_category() );
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );					
				endwhile; // End of the loop.
				?>
			</main><!-- #main -->
		</div>		
	</div>
</div>

<?php
get_footer();
