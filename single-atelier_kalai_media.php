<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
			<?php
               $post_meta = get_post_meta( get_the_ID(), 'secret_akm', true );
               echo '<pre>';
                    print_r( $post_meta );
               echo '</pre>';
			?>
		</div>		
	</div>
</div>	

<?php
get_footer();
