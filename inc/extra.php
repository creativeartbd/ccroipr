<?php
/**
 * ccroipr extra function
 *
 * @package ccroipr
 */

/**
* Encrypt and Deycrypt string
*/
function hashMe( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}

/**
* Generate random number
*/
function randomNumber($length) {
    $result = '';
    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}

/**
* Resize image based on width
*/
function image_resize_base_width ( $target, $newcopy, $w, $ext) {

    $url = $target;
    $width = $w;

    // Loading the image and getting the original dimensions
    $ext = strtolower($ext);
    if ($ext == "gif"){
        $image = imagecreatefromgif($target);
    } elseif($ext =="png"){
        $image = imagecreatefrompng($target);
    } else {
        $image = imagecreatefromjpeg($target);
    }

    $orig_width     = imagesx($image);
    $orig_height    = imagesy($image);

    // Calc the new height
    $height = (($orig_height * $width) / $orig_width);

    // Create new image to display
    $new_image = imagecreatetruecolor($width, $height);

    // Create new image with changed dimensions
    imagecopyresized($new_image, $image,
        0, 0, 0, 0,
        $width, $height,
        $orig_width, $orig_height);

    // Print image
    if ($ext == "gif"){
        imagegif($new_image, $newcopy);
    } else if($ext =="png"){
        imagepng($new_image, $newcopy);
    } else {
        imagejpeg($new_image, $newcopy, 84);
    }
}