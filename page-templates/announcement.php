<?php
/**
 * Template Name: Ccroipr Announcement
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */
get_header();
?>

<div class="container main-container">
	<div class="row">
		<div class="col-lg-12">				
            <div class="section-title mb-5">                        
                <h2><?php _e('Common Copyright Register of Intellectual Property Rights / CCROIPR-CAT-P', 'ccroipr'); ?></h2>
            </div> 

			<?php 
			$category = get_category_by_slug( 'ccroipr-p' );
			$category2 = get_category_by_slug( 'ccroipr-d' );
			$cat_id   = '';
			$cat_id2   = '';

			if( $category ) {
				$cat_id = $category->term_id;	
			}

			if( $category2 ) {
				$cat_id2 = $category2->term_id;	
			}
			
			$args = [
				'post_type'      => 'post',
				'posts_per_page' => -1,
				'category'       => [$cat_id, $cat_id2],
				'post_status'	 => 'confirmed'
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