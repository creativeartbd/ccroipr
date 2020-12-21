<?php

/**
 * ccroipr extra function
 *
 * @package ccroipr
 */

if(!current_user_can('manage_options')) {
    // Hide left side widget
    add_action( 'admin_head', 'hide_left_side_widget' );
    function hide_left_side_widget( ) {
        echo '<style>
        .widget-liquid-left {
            display: none;
        } 
        </style>';
    }
}

if(!current_user_can('manage_options')) {
    // Remove contextual help 
	add_filter( 'contextual_help', 'mytheme_remove_help_tabs', 999, 3 );
    // Remove screen options 
    add_filter('screen_options_show_screen', '__return_false');
	function mytheme_remove_help_tabs($old_help, $screen_id, $screen){
		$screen->remove_help_tabs();
		return $old_help;
	}
}


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
function generatePdfWithImage($pdf_data, $return = false, $create_txt = false, $show_condition = false)
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
    $pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(0);
    $pdf->SetFooterMargin(10);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // set font
    $pdf->SetFont('freesans', '', 10);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->AddPage();
    $thumb = '';

    if ( in_array( $type, [ 'photo', 'design'] ) ) {

        $thumb_array = [];
        $post_meta   = get_post_meta( $post_id, 'ccroipr_register_meta', true );

        foreach( $post_meta['cat_d_image'] as $key => $id ) {            
            $thumb_array[] = wp_get_attachment_image( $id, 'full' ); // get only the image not url
        }
    }   

    // Cat d title for the PDF 
    $date_title = '';
    if( 'design' == $type ) {
        $date_title =  'ccroipr-cat-d-' . date('Y-m-d') . ' / ';
    } elseif ( 'photo' == $type ) {
        $date_title =  'ccroipr-cat-p-' . date('Y-m-d') . ' / ';
    } elseif( 'title' == $type ) {
        $date_title =  'ccroipr-cat-t-' . date('Y-m-d') . ' / ';
    }

    $html = ''; 
    $html .= "
    <table border=\"0\" width=\"100%\">
        <tr>
            <td style=\"text-align: center;\">
                <h2 style=\"line-height:50%;\">Common Copyright Register of Intellectual Property Rights</h2>";

                if( 'title' == $type ) {
                    $html .= "<h2 style=\"line-height:50%;\">Certifikate of Registration</h2>";
                } else {
                    $html .= "<h2 style=\"line-height:50%;\">Certificate of Registration</h2>";   
                }
                
                $html .= "<h4 style=\"line-height:100%;\">$date_title $confirm_id</h4>";

                if( 'title' != $type ) {
                    $html .= "<h4 style=\"line-height:50%;\">$werktitel</h4>";
                } else {
                    $titelschutzanzeigen =  get_template_directory_uri() . '/assets/img/titelschutzanzeigen.jpg';
                    $html .= "<img src=\"{$titelschutzanzeigen}\">";        
                    $html .="<p>https://www.ccroipr.org/titelschutzanzeigen.jpg</p>";
                }
                
                $html .="
            </td>
        </tr>    
        <tr><td>&nbsp;</td></tr>        
        <tr><td>&nbsp;</td></tr>        
    </table>";

    if( 'title' == $type ) {
        $html .= "
        <table border=\"0\" width=\"100%\">            
            <tr>
                <td>
                    <h2>Titelschutzanzeigen-Text</h2>
                    <p><b>Unter  Hinweis  auf</b></p>
                    <p>* §80  UrhG,  §9  UWG  (Österreich) sowie. <br/>* §5  Abs.3 MarkenG (Deutschland) und. <br/> * Art. 2 Abs. 4 URG (Schweiz).</p>
                    <p><b>nehme ich Titelschutz in Anspruch für.</b></p>
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>";
    }
  
    
    if ( in_array( $type, [ 'photo', 'design'] ) ) {
        $html .= "<table border=\"0\" width=\"100%\" cellpadding=\"5\">";
            $html .= "<tr>";
            $x = 0;
            foreach( $thumb_array as $thumb ) {
                if($x!=0 && $x%6==0){  // if not first iteration and iteration divided by 3 has no remainder...
                    $html .= "</tr>\n<tr>";
                }
                $html .= "<td>$thumb</td>";
                ++$x;
            }                
        $html .="</tr></table> ";
    }
   
    $html .= "  
        <table border=\"0\" width=\"100%\">
        <tr>
            <td><b>Copyright Text</b></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>$werk_beschreibung</td>
        </tr>
        <tr><td>&nbsp;</td></tr>";

    if( 'title' == $type ) {
        $html .= "
            <tr>
                <td>in allen Darstellungsformen, Wortkombinationen, Schreibweisen, Abwandlungen, Erzeugnissen und Medien oder sonstigen vergleichbaren Werken und Anwendungen.
                </td>
            </tr>           
        ";
    }

    if ('photo' == $type) {
        $html .= "
        <tr>
            <td>SHA256 (Hashwert der Originalabbildung)</td>
        </tr>
        <tr>
            <td colspan=\"2\">$sha256</td>
        </tr>";
    }
    $html .= "<tr><td>&nbsp;</td></tr>";
    $html .= "</table>";
    
    $html .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\">";
    if( 'title' == $type ) {    
        $html .= "<tr><td colspan=\"2\"><p><b>Urheber - Impressum (§55 RStV) für</b></p></td></tr>";
        $html .= "<tr><td>&nbsp;</td></tr>";
    } else {
        $html .= "<tr><td colspan=\"2\"><p><b>Anmelder / Urheber-Impressum nach 55RStV</b></p></td></tr>";
        $html .= "<tr><td>&nbsp;</td></tr>";
    }    
    $html .= "
            <tr>
                <td width=\"30%\">Name</td>
                <td width=\"70%\">$surname</td>
            </tr>
            <tr>
                <td width=\"30%\">Vorname</td>
                <td width=\"70%\">$vorname</td>
            </tr>
            <tr>
                <td width=\"30%\">Straße / Nr</td>
                <td width=\"70%\">$strabe_nr</td>
            </tr>
            <tr>
                <td width=\"30%\">Plz</td>
                <td width=\"70%\">$plz</td>
            </tr>
            <tr>
                <td width=\"30%\">Ort / Stadt</td>
                <td width=\"70%\">$ort</td>
            </tr>
            <tr>
                <td width=\"30%\">E-Post-Address</td>
                <td width=\"70%\">$e_post_address</td>
            </tr>
        </table>";

    if ($show_condition) {
        $ip               = $post_meta['user_ip'];
        $copyright_symble = get_template_directory_uri() . '/assets/img/copyright-symbol.jpg';
        $html .= "
            <h4>Freigabeerklärung zum Certificate of Registration $confirm_id</h4>
            <p>* Mein Datenupload ist unter der $ip erfolgt.<br/>* Ich habe die Hinweise zur Anmeldung heruntergeladen, gelesen und meine Daten geprüft.<br/>* Ich habe die aktuellen Geschäftsbedingungen heruntergeladen, gelesen und akzeptiert.<br/>* Ich habe die CCROIPR - Lizenzvereinbarungen heruntergeladen, gelesen und akzeptiert.<br/>* Ich habe mit der E-Mail-Adresse $email die Anmeldung bestätigt.<br/>* Ich habe die Freigabe zur Veröffentlichung & Langzeitarchivierung im Common Copyright Register of Intellectual Property Rights erteilt.</p>";            
        $html .= "<p style=\"text-align:center;\"><img src=\"$copyright_symble\"></p>";
        $html .= "<p>Eine zusätzliche, bezeugte und besiegelte Urkunde kann gegen Gebühr bei certificate@ccroipr.org angefordert werden. Informationen unter ccroipr.org/info.</p>";
    }    

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    ///$pdf->AddPage();
    //$pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);

    $upload         = wp_upload_dir();
    $upload_dir     = $upload['basedir'];
    $upload_dir     = $upload_dir . '/ccroipr-pdf/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755);
    }

    // create file empty .txt file 
    if ($create_txt) {
        $fopen = fopen($upload_dir . $confirm_id . '.txt', "w");
        fclose($fopen);
    }

    $filename = $confirm_id . '.pdf';
    $filename_backup = $confirm_id . '_backup' . '.pdf';


    if ($show_condition) {
        $pdf->Output($upload_dir . $filename_backup, 'F');
    } else {
        $pdf->Output($upload_dir . $filename, 'F');
    }

    $pdf_link =  $upload['baseurl'] . '/ccroipr-pdf/' . $confirm_id . '.pdf';

    if ($return) {
        return $pdf_link;
    }
}

function upload_post_thumbnail($surname, $extension, $final_image, $post_id, $cat_d = null, $confirm_id, $increment_id = null )
{
    if( $confirm_id ) {
        $new_file_id = $confirm_id;
    } else {
        $new_file_id = rand(1000, 9999);
    }

    if( $increment_id ) {
        $increment_id = '-d'.$increment_id;
    }
    $new_file_name = $new_file_id . $increment_id . '.' . $extension;
    $wp_upload_dir = wp_upload_dir();
    $path          = $wp_upload_dir['path'];   
    $image_parts   = explode(";base64,", $final_image);
    $image_base64  = base64_decode($image_parts[1]);
    $filename      = $path . '/' . $new_file_name;
    file_put_contents($filename, $image_base64);

    // Check the type of file. We'll use this as the 'post_mime_type'.
    $filetype = wp_check_filetype(basename($filename), null);

    // Prepare an array of post data for the attachment.
    $attachment = array(
        'guid'           => $path . '/' . basename($filename),
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    // Insert the attachment.
    $attach_id = wp_insert_attachment($attachment, $filename, $post_id);

    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Generate the metadata for the attachment, and update the database record.
    $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
    wp_update_attachment_metadata($attach_id, $attach_data);

    if( ! $cat_d ) {
        // set the post thumbnail
        set_post_thumbnail($post_id, $attach_id);
        return;
    }
    return $attach_id;
    
}

function dimox_breadcrumbs()
{

    $delimiter = '&raquo;';
    $name = 'Start'; //get_site_url(); //text for the 'Home' link
    $currentBefore = '<span class="current">';
    $currentAfter = '</span>';

    if (!is_home() && !is_front_page() || is_paged()) {

        echo '<div id="crumbs">';

        global $post;
        $home = get_bloginfo('url');
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';

        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo (get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $currentBefore . 'Archive by category &#39;';
            //single_cat_title();
            echo '&#39;' . $currentAfter;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('d') . $currentAfter;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('F') . $currentAfter;
        } elseif (is_year()) {
            echo $currentBefore . get_the_time('Y') . $currentAfter;
        } elseif (is_single() && !is_attachment()) {
            $cat = get_the_category();
            $cat = $cat[0];            
            //echo get_category_parents($cat, false, ' ' . $delimiter . ' ');
            //echo ucfirst($cat->slug) . ' ' . $delimiter . ' ';
            //echo $currentBefore;
            $post_meta     = get_post_meta( get_the_ID( ), 'ccroipr_register_meta', true );
            $post_status   = $post_meta['is_confirm'];
            
            if( 0 == $post_status ) {
                echo ucfirst($cat->slug);
            } else {    
                echo 'Register';
            }

            if( 'design' == $cat->slug ) {                
                echo ' '. $delimiter .' Copyrightzeichen überprüfen  ';
            } else {                
                echo ' '. $delimiter .' Copyright-Zeichen  ';
                the_title();
            }             
            //echo $currentAfter;
            //echo $currentAfter;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_page() && !$post->post_parent) {
            echo $currentBefore;
            //echo ucfirst($post->post_name); // slug
            the_title();
            echo $currentAfter;
        } elseif (is_page() && $post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_search()) {
            echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
        } elseif (is_tag()) {
            echo $currentBefore . 'Posts tagged &#39;';
            single_tag_title();
            echo '&#39;' . $currentAfter;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
        } elseif (is_404()) {
            echo $currentBefore . 'Error 404' . $currentAfter;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
        }

        echo '</div>';
    }
}

if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}

// Change post page title for title category post 
function custom_title($title_parts) {    
    if( is_single() ) {
        
        $category      = get_the_category();
        $category_name = $category[0]->slug;
        
        $post_meta     = get_post_meta( get_the_ID( ), 'ccroipr_register_meta', true );
        $post_status   = $post_meta['is_confirm'];
        $confirm_id     = $post_meta['confirm_id'];
       
        if( 'title' == $category_name ) {            
            $title_parts['title'] = "► COPYRIGHT - ZEICHEN » {$confirm_id} [CCROIPR]";
            return $title_parts;
        } elseif( 'design' == $category_name ) {
            if( 0 == $post_status ) {
                $title_parts['title'] = "► Designschutz » prüfen & offenbaren [CCROIPR]";
                return $title_parts;
            }
        }
        return $title_parts;        
    }    
}
add_filter( 'document_title_parts', 'custom_title' );

// Disable Yoast SEO for single post page
function change_post_page_title( $title ) {
    if( is_single() ) {
        return false;
    }
    return $title;
}
add_filter( 'wpseo_title', 'change_post_page_title' );

// Change Yoast meta description of single post page from title category
function change_post_page_meta_description( $meta_descriptin ) {
    if( is_single() ) {

        $category      = get_the_category();
        $category_name = $category[0]->slug;

        $post_meta     = get_post_meta( get_the_ID( ), 'ccroipr_register_meta', true );
        $post_status   = $post_meta['is_confirm'];
        $confirm_id     = $post_meta['confirm_id'];

        if( 'title' == $category_name ) {
            return 'Titelschutzanzeige mit Prioritätsnachweis & Registerurkunde nach dem Prioritätsprinzip - ein kostenloser Service von ATELIER•KALAI•MEDIA';
        } elseif( 'design' == $category_name ) {
            if( 0 == $post_status ) {
                return 'Designschutz nach (EG) Nr. 6/2002 - Prioritätsnachweis für nicht eingetragene Gemeinschaftsgeschmacksmuster der EU - ein kostenloser Service von ATELIER•KALAI•MEDIA';
            }
        }
    }
    return $meta_descriptin;
}
add_filter( 'wpseo_metadesc', 'change_post_page_meta_description' );

function change_opengraph_desc() {
    if( is_single() ) {

        $category      = get_the_category();
        $category_name = $category[0]->slug;

        $post_meta     = get_post_meta( get_the_ID( ), 'ccroipr_register_meta', true );
        $post_status   = $post_meta['is_confirm'];
        $confirm_id     = $post_meta['confirm_id'];

        if( 'design' == $category_name ) {
            if( 0 == $post_status ) {
                return 'Designschutz nach (EG) Nr. 6/2002 - Prioritätsnachweis für nicht eingetragene Gemeinschaftsgeschmacksmuster der EU - ein kostenloser Service von ATELIER•KALAI•MEDIA';
            }
        }
    }
}
add_filter( 'wpseo_opengraph_desc', 'change_opengraph_desc' );

function change_opengraph_title() {
    if( is_single() ) {

        $category      = get_the_category();
        $category_name = $category[0]->slug;

        $post_meta     = get_post_meta( get_the_ID( ), 'ccroipr_register_meta', true );
        $post_status   = $post_meta['is_confirm'];
        $confirm_id     = $post_meta['confirm_id'];

        if( 'design' == $category_name ) {
            if( 0 == $post_status ) {
                return '► Designschutz » prüfen & offenbaren [CCROIPR]';
            }
        }
    }
}
add_filter( 'wpseo_opengraph_title', 'change_opengraph_title' );


