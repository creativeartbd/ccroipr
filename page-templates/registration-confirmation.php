<?php
/**
 * Template Name: Registration Confirmation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */

$key 		= isset( $_GET['key'] ) ? sanitize_text_field( $_GET['key'] ) : '';
$user_id 	= isset( $_GET['user'] ) ? intval( $_GET['user'] ) : '';						
$message 	= '';

if( isset( $key, $user_id ) ) {
	if( !empty( $key) && !empty( $user_id ) ) {		
		
		global $wpdb;   
		$author_page 	= get_author_posts_url( $user_id );										
		$table_name 	= $wpdb->prefix.'users';
		$query 			= $wpdb->get_row( "SELECT user_status FROM $table_name WHERE ID = $user_id AND user_activation_key = '$key' " );

		if( $query ) {
			$user_status = $query->user_status;
			if( 0 == $user_status ) {
				$wpdb->update( 
			    	$table_name,
			     	array( 'user_status' => 1 ),
			     	array( 
			     		'ID' =>  $user_id, 
			       		'user_activation_key' => $key,
			     	), 
			     	array( '%d', '%s')
				);		
				$message .= "<div class='alert alert-success'>Congratulation! Your email has been confirmed.</div>";
				header( "refresh:5;url=$author_page" );
			} else {
				$message .= "<div class='alert alert-warning'>Your email address is already confirmed</div>"; 
				header( "refresh:5;url=$author_page" );
			}
		}
	}						
}

get_header();
?>
<div class="container main-container">
	<div class="row">
		<div class="col-lg">
			<main id="primary" class="site-main">
				<div class="rows">
					<div class="col-mnd-12">
						<?php echo $message; ?>
					</div>
				</div>
			</main>
		</div>
	</div>
</div>

<?php 
get_footer();
