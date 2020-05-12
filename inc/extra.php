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

    $url = 'http://ccroipr.test/wp-content/uploads/2020/05/pl_icon-1.png';
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

    var_dump( $url );

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

function textToImg($text, $image_width, $imageName, $colour = array(0,0,0), $background = array(255,255,255) ) {
    $font         = 35;
    $line_height  = 50;
    $padding      = 120;
    $textArr      = array();
    $count        = array();
    $ex           = explode(' ', $text);
    foreach ($ex as $key => $value) {
        $count[] = strlen($value);
    }

    $max          = max($count);
    $textArr      = wordwrap($text, $max);
    $lines        = explode("\n", $textArr);
    $hochladen    = get_template_directory_uri() . '/assets/img/sample.png';
    $image        = imagecreatefrompng($hochladen);
    $background   = imagecolorallocate($image, $background[0], $background[1], $background[2]);
    $colour       = imagecolorallocate($image,$colour[0],$colour[1],$colour[2]);
    imagefill($image, 0, 0, $background);
    $i            = $padding;

    $fontPath = get_template_directory() . '/assets/fonts/arial.ttf';
    $count = 1;
    foreach($lines as $line){
        imagettftext($image, $font, 0, 150, $i, $colour, $fontPath, $line);
        if($count == 2 ) {
            $i += 150;
            $font -= 15;
        } else {
            $i += $line_height;
        }
        //$font -= 10;
        $count++;
    }

    imagejpeg($image, $imageName.'.jpg');
    imagedestroy($image);  
}

function random ($length) {
    $random = '';
    for ($i = 0; $i < $length; $i++) {
        $random .= chr(rand(ord('a'), ord('z')));
    }
    return $random;
}