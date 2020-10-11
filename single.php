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
			<?php		
			if( have_posts() ) {
				while ( have_posts() ) {					
					the_post();
					$categories = get_the_category();

					foreach ( $categories as $category ) {
						$slug = $category->slug;						
						if( $slug == 'ccroipr-p' ) {
							get_template_part( 'template-parts/content', 'ccroipr-p' );
						} elseif ( $slug == 'ccroipr-t' ) {
							get_template_part( 'template-parts/content', 'ccroipr-t' );
						} else {
							get_template_part( 'template-parts/content', get_post_type() );
						}
					}
				}
			}					
			?>	
		</div>		
	</div>
</div>

<?php
get_footer();
