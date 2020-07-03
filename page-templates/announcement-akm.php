<?php
/**
 * Template Name: Ccroipr Announcement AKM
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */
get_header();
?>

<div class="container main-container">
	<div class="row">
		<div class="col-lg">				
            <div class="section-title mb-5">                        
                <h2>Common Copyright Register of Intellectual Property Rights / CCROIPR-CAT-P</h2>
            </div>    
			<?php 
			$category = get_category_by_slug( 'cat_p' );
			$cat_id = '';
			if( $category ) {
				$cat_id = $category->term_id;	
			}
			
			$args = [
				'post_type' => 'atelier_kalai_media',
				'posts_per_page' => -1,				
			];

			$posts = get_posts( $args );					
			if( $posts ) {
				$count = count( $posts );
				echo "<table class='table table-striped table-bordered'>";
				foreach ( $posts as $post ) {
					$permalink = get_the_permalink();
					$title = get_the_title();
					setup_postdata( $post );
						echo '<tr>';
							echo "<td>$count</td>";
							echo "<td><a href='$permalink'>$title</a></td>";
						echo '</tr>';
					$count--;							
				}
				echo "</table>"; 
				wp_reset_postdata();
			}
			?>
		</div>
	</div>
</div>

<?php 
get_footer();