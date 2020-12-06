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

if( $key && $post_id  ) {
	// Get post data
	$post = get_post( $post_id );
	if( $post ) {
		$post_id 	   = $post->ID;
		$post_status = $post->post_status;
		$post_meta   = get_post_meta( $post_id, 'ccroipr_register_meta', true );
		$code        = $post_meta['code'];

		if( $key === $code ) {
			if( 'pending' === $post_status ) {
				// Update post
				$post_id = wp_update_post( [
					'ID' => $post_id, 
					'post_status' => 'publish'
				] );

				// If update success
				if( ! is_wp_error( $post_id ) ) {
					$permalink = get_the_permalink( $post_id );
					$message .= "<div class='alert alert-success'>Congratulation! Your email has been confirmed. You will be redirect in a moment...</div>";
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
		<div class="col-lg-12">			
			<?php echo $message; ?>
		</div>
	</div>
</div>

<?php 
get_footer();
