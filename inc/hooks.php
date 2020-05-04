<?php
/**
 * ccroipr all hooks
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ccroipr
 */

add_action( 'wp_ajax_register_action', 'register_action' );
add_action( 'wp_ajax_nopriv_register_action', 'register_action' );

function register_action( ) {
	wp_verify_nonce( '_wpnoncne', 'register_action' );
	
	echo '<pre>';
	print_r( $_REQUEST );
	echo '</pre>';

	wp_die();
}