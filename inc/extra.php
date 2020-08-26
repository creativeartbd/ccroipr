<?php

/**
 * ccroipr extra function
 *
 * @package ccroipr
 */

function Generate_Featured_Image($image_url, $post_id)
{
    $upload_dir          =  wp_upload_dir();
    $image_data          =  file_get_contents($image_url);
    $filename            =  basename($image_url);

    if (wp_mkdir_p($upload_dir['path'])) {
        $file              =  $upload_dir['path'] . '/' . $filename;
    } else {
        $file              =  $upload_dir['basedir'] . '/' . $filename;
    }        

    file_put_contents($file, $image_data);

    $wp_filetype         =  wp_check_filetype($filename, null);
    $attachment          =  array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );
    
    $attach_id           =  wp_insert_attachment($attachment, $file, $post_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data         =  wp_generate_attachment_metadata($attach_id, $file);
    $res1                =  wp_update_attachment_metadata($attach_id, $attach_data);
    $res2                =  set_post_thumbnail($post_id, $attach_id);
}

/**
 * Encrypt and Deycrypt string
 */
function hashMe($string, $action = 'e')
{
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

/**
 * Generate random number
 */
function randomNumber($length)
{
    $result = '';
    for ($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}

/**
 * Resize image based on width
 */
function image_resize_base_width($target, $newcopy, $w, $ext)
{

    $url = 'http://ccroipr.test/wp-content/uploads/2020/05/pl_icon-1.png';
    $width = $w;

    // Loading the image and getting the original dimensions
    $ext = strtolower($ext);
    if ($ext == "gif") {
        $image = imagecreatefromgif($target);
    } elseif ($ext == "png") {
        $image = imagecreatefrompng($target);
    } else {
        $image = imagecreatefromjpeg($target);
    }

    var_dump($url);

    $orig_width     = imagesx($image);
    $orig_height    = imagesy($image);

    // Calc the new height
    $height = (($orig_height * $width) / $orig_width);

    // Create new image to display
    $new_image = imagecreatetruecolor($width, $height);

    // Create new image with changed dimensions
    imagecopyresized(
        $new_image,
        $image,
        0,
        0,
        0,
        0,
        $width,
        $height,
        $orig_width,
        $orig_height
    );

    // Print image
    if ($ext == "gif") {
        imagegif($new_image, $newcopy);
    } else if ($ext == "png") {
        imagepng($new_image, $newcopy);
    } else {
        imagejpeg($new_image, $newcopy, 84);
    }
}

function textToImg($text, $image_width, $imageName, $colour = array(0, 0, 0), $background = array(255, 255, 255))
{
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
    $colour       = imagecolorallocate($image, $colour[0], $colour[1], $colour[2]);
    imagefill($image, 0, 0, $background);
    $i            = $padding;

    $fontPath = get_template_directory() . '/assets/fonts/arial.ttf';
    $count = 1;
    foreach ($lines as $line) {
        imagettftext($image, $font, 0, 150, $i, $colour, $fontPath, $line);
        if ($count == 2) {
            $i += 150;
            $font -= 15;
        } else {
            $i += $line_height;
        }
        //$font -= 10;
        $count++;
    }

    imagejpeg($image, $imageName . '.jpg');
    imagedestroy($image);
}

function random($length)
{
    $random = '';
    for ($i = 0; $i < $length; $i++) {
        $random .= chr(rand(ord('a'), ord('z')));
    }
    return $random;
}

/**
 * Gnerate PDF file
 */
function generatePdfWithImage($pdf_data, $return = null)
{

    extract($pdf_data);

    require_once get_template_directory() . '/assets/vendor/tcpdf/tcpdf.php';
    //echo get_template_directory() . '/assets/vendor/tcpdf/tcpdf_include.php';
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('CCROIPR');
    $pdf->SetTitle($surname);
    $pdf->SetSubject($surname . 'profile');
    $pdf->SetKeywords('');

    // set default header data
    $pdf->SetHeaderData('', PDF_HEADER_LOGO_WIDTH, ' ', '');

    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('freesans', '', 11);

    $pdf->AddPage();

    $thumb      = wp_get_attachment_image_src($attachment_id, 'ccroipr');
    $thumb_src  = $thumb[0];

    $image      = $thumb_src;
    $explode    = explode('.', $image);
    $extension  = strtolower(end($explode));
    //$extension  = strtoupper($explode[1]);    


    $html = '';
    $html .= '<h4>Common Copyright Register of Intellectual Property Rights</h4>';
    $html .= "<p>$confirm_id</p>";
    $html .= "
            <table border=\"0\" width=\"355\" cellpadding=\"5\">
                <tr>
                    <td>Name</td>
                    <td>$surname</td>
                </tr>
                <tr>
                    <td>Vorname</td>
                    <td>$vorname</td>
                </tr>
                <tr>
                    <td>Straße / Nr</td>
                    <td>$strabe_nr</td>
                </tr>
                <tr>
                    <td>Plz</td>
                    <td>$plz</td>
                </tr>
                <tr>
                    <td>Ort / Stadt</td>
                    <td>$ort</td>
                </tr>
                <tr>
                    <td>E-Post-Address</td>
                    <td>$e_post_address</td>
                </tr>
                <tr>
                    <td>SHA256 (Hashwert der Originalabbildung)</td>
                    <td colspan=\"2\">$sha256</td>
                </tr>
                <tr>
                    <td>Werktitel</td>
                    <td colspan=\"2\">$werktitel</td>
                </tr>
                <tr>
                    <td>Werk-Beschreibung</td>
                    <td colspan=\"3\">$werk_beschreibung</td>
                </tr>                            
            </table>
        ";

    $html2 = '';
    $html2 .= '<table border="0" cellpadding="5">';
    $html2 .= "<tr><td colspan=\"2\"></td></tr>";
    $html2 .= "<tr><td colspan=\"2\"><b>Freigabeerklärung zu $confirm_id</b></td></tr>";
    $html2 .= "<tr><td colspan=\"2\">Mein Datenupload ist unter der IP-Adresse $ip erfolgt.</td></tr>";
    $html2 .= "</table>";

    $html2 .= '<table border="0" cellpadding="5">';
    $html2 .= "<tr><td>Ich habe die Hinweise zur Anmeldung heruntergeladen, gelesen und meine Daten geprüft.</td></tr>";
    $html2 .= "<tr><td>Ich habe die aktuellen Geschäftsbedingungen heruntergeladen, gelesen und akzeptiert.</td></tr>";
    $html2 .= "<tr><td>Ich habe die CCROIPR - Lizenzvereinbarungen heruntergeladen, gelesen und akzeptiert.</td></tr>";
    $html2 .= "<tr><td>Ich habe mit der E-Mail-Adresse $email die Anmeldung bestätigt.</td></tr>";
    $html2 .= "<tr><td>und erteile hiermit die Freigabe zur Langzeitarchivierung im.</td></tr>";
    $html2 .= "<tr><td>Common Popyright Register of Intellectual Property Rights.</td></tr>";
    $html2 .= "</table>";

    $pdf->Image($image, '', '45', '75', '', $extension, '', '', true, 300, 'R', false, false, 1, false, false, false);


    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    $pdf->AddPage();
    $pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);

    $upload         = wp_upload_dir();
    $upload_dir     = $upload['basedir'];
    $upload_dir     = $upload_dir . '/ccroipr-secret-pdf/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755);
    }

    // create file empty .txt file 
    fopen($upload_dir . $confirm_id . '.txt', "w");

    $filename = $confirm_id . '.pdf';
    $pdf->Output($upload_dir . $filename, 'F');
    $pdf_link =  $upload['baseurl'] . '/ccroipr-secret-pdf/' . $confirm_id . '.pdf';

    if ($return) {
        return $pdf_link;
    }
}

function upload_post_thumbnail( $surname, $extension, $final_image, $post_id ) {
    
    $new_file_name = strtolower($surname) . '-' . rand(1000, 9999) . '.' . $extension;
    $wp_upload_dir = wp_upload_dir();
    $path          = $wp_upload_dir['path']; // /Applications/MAMP/htdocs/ccroipr/wp-content/uploads/2020/08    
    $image_parts   = explode(";base64,", $final_image);
    $image_base64  = base64_decode($image_parts[1]);
    $filename      = $path . '/' . $new_file_name;      
    file_put_contents( $filename, $image_base64 );                              
    
    // Check the type of file. We'll use this as the 'post_mime_type'.
    $filetype = wp_check_filetype( basename( $filename ), null );     

    // Prepare an array of post data for the attachment.
    $attachment = array(
        'guid'           => $path['url'] . '/' . basename( $filename ), 
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );
    
    // Insert the attachment.
    $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
    
    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    
    // Generate the metadata for the attachment, and update the database record.
    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    // set the post thumbnail
    set_post_thumbnail( $post_id, $attach_id );
}