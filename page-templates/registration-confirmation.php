<?php
/**
 * Template Name: Registration Confirmation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */

$key 		= isset( $_GET['key'] ) ? sanitize_text_field( $_GET['key'] ) : '';
$post_id 	= isset( $_GET['post_id'] ) ? intval( $_GET['post_id'] ) : '';						
$message 	= '';

if( isset( $key, $post_id ) ) {
	if( !empty( $key) && !empty( $post_id ) ) {				
		$post = get_post( $post_id );
		if( $post ) {
			$post_status = $post->post_status;
			$post_id 	= 	$post->ID;
			if( 'draft' === $post_status ) {
				$post_id = wp_update_post( [
					'ID' => $post_id, 
					'post_status' => 'pending'
				] );
				if( ! is_wp_error( $post_id ) ) {
					$permalink = get_the_permalink( $post_id );
					$message .= "<div class='alert alert-success'>Congratulation! Your email has been confirmed.</div>";
					header( "refresh:5;url=$permalink" );
				} else {
					$message .= "<div class='alert alert-warning'>Your email address is already confirmed</div>"; 
		 			header( "refresh:5;url=$permalink" );
				}
			}			
		}
		
	}						
}

get_header();
?>
<div class="container main-container">
	<div class="row">
		<div class="col-lg">			
			<?php echo $message; ?>
		</div>
	</div>
</div>

<?php 
get_footer();
