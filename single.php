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
		<div class="col-lg-12">			
			<?php		
			if( have_posts() ) {
				while ( have_posts() ) {					
					the_post();
					
					$post_status = get_post_status();
					$categories = get_the_category();

					foreach ( $categories as $category ) {
						$slug = $category->slug;				
						if( $slug == 'photo' ) {
							if( $post_status == 'confirmed' ) {
								get_template_part( 'template-parts/content', 'ccroipr-p-confirmed' );
							} else {
								get_template_part( 'template-parts/content', 'ccroipr-p' );
							}							
						} elseif ( $slug == 'title' ) {
							get_template_part( 'template-parts/content', 'ccroipr-t' );
						} elseif( $slug == 'design' ) {
							if( $post_status == 'confirmed' ) {
								get_template_part( 'template-parts/content', 'ccroipr-d-confirmed' );
							} else {
								get_template_part( 'template-parts/content', 'ccroipr-d' );
							}
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
