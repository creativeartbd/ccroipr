<?php

/**
 * ccroipr all hooks
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ccroipr
 */

add_action('wp_ajax_download_profile_action', 'download_profile_action');
add_action('wp_ajax_nopriv_download_profile_action', 'download_profile_action');

function download_profile_action()
{

    wp_verify_nonce('_wpnoncne', 'download_profile_action');

    $post_id        = hashMe(sanitize_text_field($_POST['post_id']), 'd');
    $submit_type    = hashMe(sanitize_text_field($_POST['submit_type']), 'd');    // ccroipr_register_p or ccroipr_register_t

    $post = get_post( $post_id );

    if( $post ) {       

        $upload     = wp_upload_dir();        
        $upload_dir = $upload['basedir'];
        $upload_dir = $upload_dir . '/ccroipr-pdf/';

        $post_meta  = get_post_meta( $post_id, 'ccroipr_register_meta', true );
        $confirm_id = $post_meta['confirm_id'];

        $filename = $confirm_id . '.pdf';        
        echo $upload['baseurl'] . '/ccroipr-pdf/' . $confirm_id . '.pdf';

    }
    wp_die();
}


// Delete cat d form 
add_action('wp_ajax_register_delete_action', 'register_delete_action');
add_action('wp_ajax_nopriv_register_delete_action', 'register_delete_action');
function register_delete_action()
{
    // verify nonce first 
    wp_verify_nonce('_wpnoncne', 'register_confirm_action');

    // Check register type
    $register_type      = isset($_POST['register_type']) ? strtolower(hashMe(sanitize_text_field($_POST['register_type']), 'd')) : '';
    
    if (!in_array($register_type, ['title', 'photo', 'design'])) {
        return false;
    }

    $post_id = hashMe(sanitize_text_field( $_POST['post_id']), 'd');
    $post    = get_post( $post_id );
    
    if ( $post ) {
        // Delete the post
        $delete_post = wp_delete_post( $post_id );

        if( ! is_wp_error( $delete_post ) ) {
            wp_send_json_success( [
                'message'   =>  '<div class="alert alert-success"><b>Successfully deleted your data.</b></div>',      
                'permalink' =>  get_site_url(),
            ] );  
        } else {
            wp_send_json_error( [
                'message'   =>  '<div class="alert alert-error"><b>Opps, Something is wrong to delete your data.</b></div>',            
            ]);
        }
    }

    wp_die();
}

// ====================================================================
// Confirm Register T data
// ===================================================================

add_action('wp_ajax_register_confirm_action', 'register_confirm_action');
add_action('wp_ajax_nopriv_register_confirm_action', 'register_confirm_action');

function register_confirm_action()
{
    // verify nonce first 
    wp_verify_nonce('_wpnoncne', 'register_confirm_action');

    // Check register type
    $register_type      = isset($_POST['register_type']) ? strtolower(hashMe(sanitize_text_field($_POST['register_type']), 'd')) : '';
    
    if (!in_array($register_type, ['title', 'photo', 'design'])) {
        return false;
    }

    $post_id = hashMe(sanitize_text_field( $_POST['post_id']), 'd');
    $post    = get_post( $post_id );
    
    if ( $post ) {

        $domain      = get_site_url();
        $post_status = $post->post_status;        

       if ( 'publish' == $post_status ) {

            $post_meta                  = get_post_meta( $post_id, 'ccroipr_register_meta', true );
            $confirm_id                 = 'ccroipr-' . date('Y' . 'm' . 'd' . 'H' . 'i' . 's') . randomNumber(3);
            $post_meta['confirm_id']    = $confirm_id;

            if ( in_array( $register_type, [ 'photo', 'design' ] ) ) {

                if( 'photo' == $register_type ) {
                    $post_meta['kategorie'] = 'ccroipr-cat-p-' . date('Y' . '-' . 'm' . '-' . 'd');
                } elseif ( 'design' == $register_type ) {
                    $post_meta['kategorie'] = 'ccroipr-cat-p-' . date('Y' . '-' . 'm' . '-' . 'd');
                }

                $upload_dir  = wp_upload_dir();
                $path        = $upload_dir['path'];
                $path_2      = $upload_dir['basedir'];
                
                // start the loop because of multiple image of cat-d page                
                foreach( $post_meta['cat_d_image'] as $key => $id ) {

                    $thumb_src              = wp_get_attachment_image_src( $id, 'full' )[0];
                    $explode                = explode('.', $thumb_src);                
                    $extension              = strtolower( end ( $explode ) );
                    $file_name              = basename( $thumb_src );
    
                    //image_resize_base_width( $relative_url, $relative_url, 350, $extension);
                    if ( $extension == 'jpg' ) {
                        $jpg_image = imagecreatefromjpeg( $thumb_src );
                    } elseif( $extension == 'png') {
                        $jpg_image = imagecreatefrompng( $thumb_src );
                    } elseif( $extension == 'gif' ) {
                        $jpg_image = imagecreatefromgif( $thumb_src );
                    }
    
                    // set font size
                    $font        = @imageloadfont($jpg_image);
                    $fontSize    = imagefontwidth($font);
    
                    $orig_width  = imagesx($jpg_image);
                    $orig_height = imagesy($jpg_image);
    
                    // Create your canvas containing both image and text
                    $canvas = imagecreatetruecolor( $orig_width, ($orig_height + 40 ) );              
                    // Allocate A Color For The background
                    $bcolor = imagecolorallocate( $canvas, 255, 255, 255 );
                    // Add background colour into the canvas
                    imagefilledrectangle( $canvas, 0, 0, $orig_width, ($orig_height + 40), $bcolor );
                    // Save image to the new canvas
                    imagecopyresampled( $canvas, $jpg_image, 0, 0, 0, 0, $orig_width, $orig_height, $orig_width, $orig_height );
    
                    $font_path = get_template_directory() . '/assets/fonts/arial.ttf';

                    if( 'photo' == $register_type ) { 
                        // Set Text to Be Printed On Image
                        $text = '&#169; cc-by-nd-' . $confirm_id;
                    } elseif( 'design' == $register_type ) {
                        // Set Text to Be Printed On Image
                        $key =  $key + 1;
                        $text = '&#169; cc-by-nd-' . $confirm_id . "-d".$key;
                    }

                    // Allocate A Color For The Text
                    $color = imagecolorallocate($canvas, 0, 0, 0);
                    // Print Text On Image
                    imagettftext( $canvas, 13, 0, 0, $orig_height + 25, $color, $font_path, $text) ;
                    // Send Image to Browser
                    if ($extension == 'jpg') {
                        imagejpeg( $canvas, $path . '/' . $file_name );
                    } elseif ($extension == 'png') {
                        imagepng( $canvas, $path  . '/' . $file_name );
                    } elseif ( $extension == 'gif') {
                        imagegif( $canvas, $path . '/' . $file_name );
                    }
                    // Clear Memory
                    imagedestroy($canvas);

                    if( 'photo' == $register_type ) { 
                        $category_id = get_category_by_slug('photo');
                    } elseif( 'design' == $register_type ) {
                        $category_id = get_category_by_slug('design');
                    }                    
                }                

            } elseif ( 'title' == $register_type) {

                $werktitel              = $post_meta['werktitel'];
                $post_meta['kategorie'] = 'ccroipr-' . date('Y' . '-' . 'm' . '-' . 'd');
                $text                   = "TITELSCHUTZANMELDUNG $confirm_id $werktitel";
                $image_width            = 1140;

                $search                 = array(' ', '-');
                $replace                = array('-', '');
                $imageName              = str_replace($search, $replace, $werktitel);
                $generatedImage         = $imageName . '-' . random(5);

                $upload                 = wp_upload_dir();
                $upload_dir             = $upload['basedir'];
                $upload_dir             = $upload_dir . '/ccroipr-t/';

                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755);
                }

                textToImg($text, $image_width, $upload_dir . $generatedImage);
                $post_meta['thumb_id_t'] = $generatedImage;

                $category_id = get_category_by_slug('title'); 
            }
            
            $category_id = $category_id->term_id;           
            // Create post object
            $post_array = array(
                'ID'            => $post_id,
                'post_title'    => $confirm_id,
                'post_status'   => 'confirmed', 
                'post_name'     => $confirm_id               
            ); 

            // generate the copyright symbol
            $copyright_symbol = get_template_directory_uri() . '/assets/img/copyright-symbol.png';
            $sym_explode      = explode('.', $copyright_symbol);                
            $sym_extension    = strtolower( end ( $sym_explode ) );
            $sym_file_name    = basename( $copyright_symbol );
            //image_resize_base_width( $relative_url, $relative_url, 350, $extension);
            $sym_jpg_image = imagecreatefrompng( $copyright_symbol );
            // set font size
            $sym_font        = @imageloadfont($sym_jpg_image);
            $sym_fontSize    = imagefontwidth($sym_font);
            $sym_orig_width  = imagesx($sym_jpg_image);
            $sym_orig_height = imagesy($sym_jpg_image);
            // Create your canvas containing both image and text
            $sym_canvas = imagecreatetruecolor( $sym_orig_width, ($sym_orig_height + 40 ) );              
            // Allocate A Color For The background
            $sym_bcolor = imagecolorallocate( $sym_canvas, 255, 255, 255 );
            // Add background colour into the canvas
            imagefilledrectangle( $sym_canvas, 0, 0, $sym_orig_width, ($sym_orig_height + 40), $sym_bcolor );
            // Save image to the new canvas
            imagecopyresampled( $sym_canvas, $sym_jpg_image, 0, 0, 0, 0, $sym_orig_width, $sym_orig_height, $sym_orig_width, $sym_orig_height );

            $sym_font_path  = get_template_directory() . '/assets/fonts/arial.ttf';
            $sym_upload_dir = wp_upload_dir();
            $sym_path       = $sym_upload_dir['path'];                
            $sym_text       = $confirm_id;

            // Allocate A Color For The Text
            $sym_color = imagecolorallocate($sym_canvas, 0, 0, 0);
            // Print Text On Image
            imagettftext( $sym_canvas, 15, 0, 25, 155, $sym_color, $sym_font_path, $sym_text) ;
            // Send Image to Browser
            imagepng( $sym_canvas, $sym_path  . '/' . $confirm_id . '.png' );
            // Clear Memory
            imagedestroy($sym_canvas);

            // Insert the post into the database
            $post_id_updated = wp_update_post( $post_array );

            if ( !is_wp_error( $post_id_updated ) ) {
                
                // update post meta
                update_post_meta( $post_id_updated, 'ccroipr_register_meta', $post_meta );
                                          
                // Generate PDF file
                $pdf_data = [
                    'post_id'           => $post_id,
                    'surname'           => $post_meta['surname'],
                    'attachment_id'     => get_post_thumbnail_id( $post_id_updated ),
                    'confirm_id'        => $confirm_id,
                    'vorname'           => $post_meta['vorname'],
                    'strabe_nr'         => $post_meta['strabe_nr'],
                    'plz'               => $post_meta['plz'],
                    'ort'               => $post_meta['ort'],
                    'e_post_address'    => $post_meta['e_post_address'],                    
                    'werktitel'         => $post_meta['werktitel'],
                    'werk_beschreibung' => $post_meta['werk_beschreibung'],
                    'ip'                => $post_meta['user_ip'],
                    'email'             => $post_meta['email'],
                    'type'              => $register_type
                ];        
                
                if( 'photo' == $register_type ) {
                    $pdf_data['sha256'] = $post_meta['sha256'];
                }

                $pdf_link = generatePdfWithImage( $pdf_data, false, false, true );
                $pdf_link = generatePdfWithImage( $pdf_data, false, false, false );

                // send an email to user and site owner
                $toUser     = $post_meta['email'];  
                $toArray[]  = 'backup@ccroipr.org';              
                $toArray[]  = 'backup@atelier-kalai.de';              
                $subject    = 'Copy of your document from ccroipr';
                $body       = 'Please download the PDF version of your document from ccroipr';
                $headers    = 'From: My Name <support@ccroipr.org>' . "\r\n";


                $upload_dir        = wp_upload_dir();
                $path              = $upload_dir['path'];
                $path_2            = $upload_dir['basedir'];
                $attachment_backup = $path_2 . '/ccroipr-pdf/' . $confirm_id . '_backup' . '.pdf';
                $attachment        = $path_2 . '/ccroipr-pdf/' . $confirm_id . '.pdf';
                
                // Send email to user
                wp_mail( $toUser, $subject, $body, $headers, $attachment );     
                // Send email to backup             
                wp_mail( $toArray, $subject, $body, $headers, $attachment_backup );                  

                // Finally show a confirmation message
                wp_send_json_success( [
                    'message'   =>  '<div class="alert alert-success"><b>Successfully Confirmed your profile data.</b></div>',
                    'permalink' =>  get_the_permalink( $post_id_updated )
                ]);  
            }

        } else {
            wp_send_json_error( [
                'message' => '<div class="alert alert-danger">You already confirmed your data.</div>'
            ]);
        }
    }

    wp_die();
}

add_action('wp_ajax_register_slim_file_action', 'register_slim_file_action');
add_action('wp_ajax_nopriv_register_slim_file_action', 'register_slim_file_action');

function register_slim_file_action()
{

    wp_verify_nonce('_wpnoncne', 'register_slim_file_action');
    echo hash('sha256', uniqid());
    wp_die();
}

// ========================================================================
// Registration and Update process for the "Register" and "Register T" form
// ========================================================================
add_action('wp_ajax_register_action', 'register_action');
add_action('wp_ajax_nopriv_register_action', 'register_action');

function register_action()
{

    // Verify nonce
    wp_verify_nonce('_wpnoncne', 'register_action');

    // Check register form type. Must be ccroipr-p or ccroipr-t
    $register_type = isset($_POST['register_type']) ? hashMe(sanitize_text_field($_POST['register_type']), 'd'): '';      
    
    if ( !in_array ( $register_type, ['title', 'photo', 'design'] ) ) {
        return false;
    }

    // Check form submit type wheather is for update or new registration
    $submit_type        = isset($_POST['submit_type']) ? hashMe(sanitize_text_field($_POST['submit_type']), 'd') : ''; // Either register or update
    $surname            = isset($_POST['surname']) ? sanitize_text_field($_POST['surname']) : '';
    $vorname            = isset($_POST['vorname']) ? sanitize_text_field($_POST['vorname']) : '';
    $strabe_nr          = isset($_POST['strabe_nr']) ? sanitize_text_field($_POST['strabe_nr']) : '';
    $plz                = isset($_POST['plz']) ? sanitize_text_field($_POST['plz']) : '';
    $ort                = isset($_POST['ort']) ? sanitize_text_field($_POST['ort']) : '';
    $e_post_address     = isset($_POST['e_post_address']) ? sanitize_text_field($_POST['e_post_address']) : '';
    $webseite           = isset($_POST['webseite']) ? sanitize_text_field($_POST['webseite']) : '';
    $werktitel          = isset($_POST['werktitel']) ? sanitize_text_field($_POST['werktitel']) : '';
    $werk_beschreibung  = isset($_POST['werk_beschreibung']) ? sanitize_text_field($_POST['werk_beschreibung']) : '';
    $ip                 = isset($_POST['ip']) ? sanitize_text_field($_POST['ip']) : '';
    $email              = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $inch_habe_die      = isset($_POST['inch_habe_die']) ? absint($_POST['inch_habe_die']) : '';
    $inh_habe_die_agb   = isset($_POST['inh_habe_die_agb']) ? absint($_POST['inh_habe_die_agb']) : '';
    $ich_habe_die       = isset($_POST['ich_habe_die']) ? absint($_POST['ich_habe_die']) : '';
    $pattern            = '/(?:https?:\/\/)?(?:[a-zA-Z0-9.-]+?\.(?:[a-zA-Z])|\d+\.\d+\.\d+\.\d+)/';

    // Following data needed for the "Register P" form process
    if ( in_array( $register_type, ['photo', 'design'] ) ) {

        $wiener                 = isset($_POST['wiener']) ? sanitize_text_field($_POST['wiener']) : '';
        $locarno                = isset($_POST['locarno']) ? sanitize_text_field($_POST['locarno']) : '';
        $internationale         = isset($_POST['internationale']) ? sanitize_text_field($_POST['internationale']): '';
        $nizzaklassifikation    = isset($_POST['nizzaklassifikation']) ? sanitize_text_field($_POST['nizzaklassifikation']): '';
        $sha256                 = isset($_POST['sha256']) ? sanitize_text_field($_POST['sha256']) : '';
        $keywordnr1             = isset($_POST['keywordnr1']) ? sanitize_text_field($_POST['keywordnr1']) : '';
        $keywordnr2             = isset($_POST['keywordnr2']) ? sanitize_text_field($_POST['keywordnr2']) : '';
        $keywordnr3             = isset($_POST['keywordnr3']) ? sanitize_text_field($_POST['keywordnr3']) : '';
        $keywordnr4             = isset($_POST['keywordnr4']) ? sanitize_text_field($_POST['keywordnr4']) : '';
        $keywordnr5             = isset($_POST['keywordnr5']) ? sanitize_text_field($_POST['keywordnr5']) : '';
        $slims                  = $_POST['slims'];

        $image_names         = [];
        $image_sizes         = [];
        $final_images        = [];
        $extensions          = [];

        if( $slims ) {        
            foreach( $slims as $slim ) {
                $decode                 = json_decode(str_replace('\\', '', sanitize_text_field( $slim ) ) );
                $image_names[]  = $decode->input->name;
                $image_sizes[]  = $decode->input->size;
                $final_images[] = $decode->output->image; // We need this image becuase it's cropped
                $image_name     = $decode->input->name;
                $explode        = explode('.', $image_name);
                $extensions[]   = strtolower(end($explode));
                $allowed_size   = 10485760;
                $allowed_image  = ['jpg', 'png', 'gif', 'jpeg'];
            }
        }
    }

    // Store all errors message
    $errors                     = [];

    // Check error messages and store them to $errors array
    if (empty($surname)) {
        $errors[] = 'Your surname is required';
    } elseif (strlen($surname) > 25 || strlen($surname) < 2) {
        $errors[] = 'Your surname must be between 2-25 characters long';
    }

    if (empty($vorname)) {
        $errors[] = 'Your vorname is required';
    } elseif (strlen($vorname) > 25 || strlen($vorname) < 2) {
        $errors[] = 'Your vorname must be between 2-25 characters long';
    }

    if (empty($strabe_nr)) {
        $errors[] = 'Your strabe nr is required';
    } elseif (strlen($strabe_nr) > 55 || strlen($strabe_nr) < 2) {
        $errors[] = 'Your strabe nr must be between 2-55 characters long';
    }

    if (empty($plz)) {
        $errors[] = 'Your plz is required';
    } elseif (strlen($plz) > 10 || strlen($plz) < 2) {
        $errors[] = 'Your plz must be between 2-10 characters long';
    }

    if (empty($ort)) {
        $errors[] = 'Your Ort / Stadt is required';
    } elseif (strlen($ort) > 35 || strlen($ort) < 2) {
        $errors[] = 'Your Ort / Stadt must be between 2-35 characters long';
    }

    if (empty($e_post_address)) {
        $errors[] = 'Your E-post address is required';
    } elseif (strlen($e_post_address) > 50 || strlen($e_post_address) < 2) {
        $errors[] = 'Your E-post address must be between 2-50 characters long';
    }

    if (!empty($webseite)) {
        if (!preg_match($pattern, $webseite)) {
            $errors[] = 'Invalid webseite is given';
        } elseif (strlen($webseite) > 150 || strlen($webseite) < 2) {
            $errors[] = 'Your webseite must be between 2-150 characters long';
        }
    }

    if (empty($werktitel)) {
        $errors[] = 'Your werktitel is required';
    } elseif (strlen($werktitel) > 30 || strlen($werktitel) < 2) {
        $errors[] = 'Your werktitel must be between 2-30 characters long';
    }

    if (empty($werk_beschreibung)) {
        $errors[] = 'werk beschreibung is required';
    } elseif (strlen($werk_beschreibung) > 1000 || strlen($werk_beschreibung) < 2) {
        $errors[] = 'werk beschreibung must be 2-1000 characters long';
    }

    if (!empty($wiener)) {
        if (strlen($wiener) > 50 || strlen($wiener) < 2) {
            $errors[] = 'Your Wiener Klassifikation must be between 2-50 characters long';
        }
    }

    if (!empty($locarno)) {
        if (strlen($locarno) > 50 || strlen($locarno) < 2) {
            $errors[] = 'Your Locarno Klassifikation  must be between 2-50 characters long';
        }
    }

    if (!empty($internationale)) {
        if (strlen($internationale) > 50 || strlen($internationale) < 2) {
            $errors[] = 'Your nternationale Patentklassifikation must be between 2-50 characters long';
        }
    }

    if (!empty($nizzaklassifikation)) {
        if (strlen($nizzaklassifikation) > 50 || strlen($nizzaklassifikation) < 2) {
            $errors[] = 'Your Nizzaklassifikation must be between 2-50 characters long';
        }
    }

    if (empty($inch_habe_die)) {
        $errors[] = 'inch habe die is required';
    }

    if (empty($inh_habe_die_agb)) {
        $errors[] = 'inh habe die agb is required';
    }

    if (empty($ich_habe_die)) {
        $errors[] = 'ich habe die is required';
    }

    if ( in_array( $register_type, [ 'photo', 'design' ] ) ) {
        if ('register' == $submit_type) {

            if (empty($image_names)) {
                $errors[] = 'Please upload an image';
            }

            foreach( $image_names as $key => $image_name ) {
                if (empty($image_name)) {
                    $errors[] = 'Please upload image';
                } elseif (!in_array($extensions[$key], $allowed_image)) {
                    $errors[] = 'Only jpg, png and gif images are allowed';
                } elseif ($image_sizes[$key] > $allowed_size) {
                    $errors[] = 'Maximum 10 MB image are allowd';
                } 
            }
            
        } elseif( 'update' == $submit_type ) {
            foreach( $image_names as $key => $image_name ) {
                if (!empty($image_name)) {
                    if (!in_array($extensions[$key], $allowed_image)) {
                        $errors[] = 'Only jpg, png and gif images are allowed';
                    } elseif ($image_sizes[$key] > $allowed_size) {
                        $errors[] = 'Maximum 10 MB image are allowd';
                    }
                }
            }
        }

        if ( in_array( $register_type, [ 'photo', 'design' ] ) ) {
            if (empty($sha256)) {
                $errors[] = 'SHA256 (Hashwert der Originalabbildung) is required, please upload the image again';
            } elseif (strlen($sha256) > 64 || strlen($sha256) < 64) {
                $errors[] = 'Invalid SHA256 (Hashwert der Originalabbildung) is given';
            }
        }

        if (empty($keywordnr1)) {
            $errors[] = 'Keword Nr 1 is required';
        } elseif (strlen($keywordnr1) > 40 || strlen($keywordnr1) < 2) {
            $errors[] = 'Keword Nr 1 must be 2-40 characters long';
        }

        if (empty($keywordnr2)) {
            $errors[] = 'Keword Nr 2 is required';
        } elseif (strlen($keywordnr2) > 40 || strlen($keywordnr2) < 2) {
            $errors[] = 'Keword Nr 2 must be 2-40 characters long';
        }

        if (empty($keywordnr3)) {
            $errors[] = 'Keword Nr 3 is required';
        } elseif (strlen($keywordnr3) > 40 || strlen($keywordnr3) < 2) {
            $errors[] = 'Keword Nr 3 must be 2-40 characters long';
        }

        if (empty($keywordnr4)) {
            $errors[] = 'Keword Nr 4 is required';
        } elseif (strlen($keywordnr4) > 40 || strlen($keywordnr4) < 2) {
            $errors[] = 'Keword Nr 4 must be 2-40 characters long';
        }

        if (empty($keywordnr5)) {
            $errors[] = 'Keword Nr 5 is required';
        } elseif (strlen($keywordnr5) > 40 || strlen($keywordnr5) < 2) {
            $errors[] = 'Keword Nr 5 must be 2-40 characters long';
        }
    }

    if ( 'register' === $submit_type) {
        if (empty($email)) {
            $errors[] = 'E-mail address is required';
        } elseif (!is_email($email)) {
            $errors[] = 'Invalid E-mail address';
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            wp_send_json_error( [
                'message'   =>  '<div class="alert alert-danger">' . $error . '</div>'
            ]);
        }
    } else {
    
        $confirm_id         = 'ccroipr-' . date('Y' . 'm' . 'd' . 'H' . 'i' . 's') . randomNumber(3);
        $kategorie          = 'ccroipr-cat-p-' . date('Y' . '-' . 'm' . '-' . 'd');
        $category           = get_category_by_slug( $register_type );
        $code               = sha1( $confirm_id . time());
        $category_id        = '';

        if ( $category instanceof WP_Term ) {
            $category_id = $category->term_id;
        }

        $post_meta = [
            'surname'           => $surname,
            'vorname'           => $vorname,
            'strabe_nr'         => $strabe_nr,
            'plz'               => $plz,
            'ort'               => $ort,
            'e_post_address'    => $e_post_address,
            'webseite'          => $webseite,
            'werktitel'         => $werktitel,
            'werk_beschreibung' => $werk_beschreibung,
            'inch_habe_die'     => $inch_habe_die,
            'inh_habe_die_agb'  => $inh_habe_die_agb,
            'ich_habe_die'      => $ich_habe_die,
            'is_confirm'        => 0,
            'confirm_id'        => $confirm_id,
            'kategorie'         => $kategorie,
            'code'              => $code,
            'email'             => $email
        ];        

        if( 'register' == $submit_type ) {

            $post_meta['email']   = $email;
            $post_meta['user_ip'] = $ip;

        } elseif( 'update' == $submit_type ) {

            $post_id = hashMe( $_POST['post_id'], 'd' );

            if( get_post( $post_id ) ) {

                $ext_post_meta = get_post_meta( $post_id, 'ccroipr_register_meta', true );
                $post_meta['email']   = $ext_post_meta['email'];
                $post_meta['user_ip'] = $ext_post_meta['user_ip'];
            }
        }

        if ( in_array( $register_type, [ 'photo', 'design' ] ) ) {

            $post_meta['wiener']              = $wiener;
            $post_meta['locarno']             = $locarno;
            $post_meta['internationale']      = $internationale;
            $post_meta['nizzaklassifikation'] = $nizzaklassifikation;
            $post_meta['sha256']              = $sha256;
            $post_meta['keywordnr1']          = $keywordnr1;
            $post_meta['keywordnr2']          = $keywordnr2;
            $post_meta['keywordnr3']          = $keywordnr3;
            $post_meta['keywordnr4']          = $keywordnr4;
            $post_meta['keywordnr5']          = $keywordnr5;
        }
        
        // Update form data
        if ( 'update' == $submit_type ) { 
            
            if ( in_array( $register_type, [ 'photo', 'design' ] ) ) { 

                // get the post id from the input hidden field
                $post_id = hashMe( $_POST['post_id'], 'd' );
                $post    = get_post( $post_id );
               
                if( $post ) {
                   
                    $get_post_meta      = get_post_meta( $post_id, 'ccroipr_register_meta', true );   
                    $cat_d_images       = $get_post_meta['cat_d_image'];
                    $processed_images   = [];

                    // If, there is a new post thumbnail
                    foreach( $image_names as $key => $image_name ) {
                        if( isset( $image_name ) ) {                        
                            // Upload new post thumbnail
                            if( $register_type == 'design' ) {
                                $increment_id = $key + 1;
                            } elseif( $register_type == 'photo' ) {
                                $increment_id = '';
                            }
                            $processed_images[] = upload_post_thumbnail( $surname, $extensions[$key], $final_images[$key], $post_id, true, $confirm_id, $increment_id );
                        } else {
                            $processed_images[] = '';
                        }
                    }
                    
                    foreach( $processed_images as $key => $process ) {
                        if( empty( $process ) ) {
                            $processed_images[$key] = $cat_d_images[$key];
                        }
                    }

                    $post_meta['cat_d_image'] = $processed_images;

                    // Update post meta
                    update_post_meta( $post_id, 'ccroipr_register_meta', $post_meta );
                    
                    // Successfully uddated
                    wp_send_json_success( [
                        'message'   =>  '<div class="alert alert-success"><b>Successfully updated the data.</b></div>',
                        'type'      =>  'update'
                    ] );
                }
            } elseif ( 'title' == $register_type ) {
                // get the post id from the input hidden field
                $post_id = hashMe( $_POST['post_id'], 'd' );
                $post    = get_post( $post_id );
               
                if( $post ) {
                  
                    // Update post meta                    
                    update_post_meta( $post_id, 'ccroipr_register_meta', $post_meta );
                   
                    // Successfully uddated
                    wp_send_json_success( [
                        'message'   =>  '<div class="alert alert-success"><b>Successfully updated the data.</b></div>',
                        'type'      =>  'update'
                    ] );
                }
            }
        } elseif( 'register' == $submit_type ) {

            // Create post object
            $post_array = array(
                'post_title'    => $confirm_id,
                'post_content'  => '',
                'post_status'   => 'pending',
                'post_author'   => 1,
                'post_category' => array( $category_id ),
            ); 
            // Insert the post into the database
            $post_id = wp_insert_post( $post_array );            

            // If the post is successfully craeted
            if( ! is_wp_error( $post_id ) ) {
              
                if( $image_names ) {
                    foreach( $image_names as $key => $image_name ) {
                        if( $register_type == 'design' ) {
                            $increment_id = $key + 1;
                        } elseif( $register_type == 'photo' ) {
                            $increment_id = '';
                        }
    
                        $attach_id = upload_post_thumbnail( $surname, $extensions[$key], $final_images[$key], $post_id, true, $confirm_id, $increment_id );
                        $post_meta['cat_d_image'][] = $attach_id;
                    }
    
                }
                
                // Insert post meta
                add_post_meta( $post_id, 'ccroipr_register_meta', $post_meta );
                
                // Generate activation link
                $activation_link = add_query_arg(
                    array(
                        'key' => $code,
                        'post_id' => $post_id
                    ),
                    get_permalink( get_page_by_path( 'registration-confirmation' ) )
                );

                // Prepare the message to be sent
                $message    = "<div style='padding : 20px; border : 1px solid #ddd; color : #000;'>Hello $surname, <br/><br/>Please confirm your email addresss for CCROIPR-Registration von $werktitel. Click this <a href='$activation_link'>link</a> to confirm now.<br/><br/>http://ccroipr.org<br/>Thank You.<br/></div>";
                $to         = $email;
                $subject    = 'Confirm your registration process at ccroipr.org';
                $body       = $message;
                $headers    = array('Content-Type: text/html; charset=UTF-8');
    
                $toArray[]  = 'registration@ccroipr.org';
                $toArray[]  = 'backup@ccroipr.org';
                $toArray[]  = 'backup@atelier-kalai.de';
                $toArray[]  =  $to;
    
                // Send email to user for activate the account 
                if ( wp_mail ( $toArray, $subject, $body, $headers ) ) {                    
                    wp_send_json_success( [
                        'message'   =>  '<div class="alert alert-success"><b>please confirm your email addresss for CCROIPR-Registration.</b></div>',
                        'type'      =>  'register'
                    ] );
                } else {
                    wp_send_json_error( [
                        'message'  => '<div class="alert alert-danger">Opps! For some reasons a confirmation email is not sending. Please contact admin</div>'
                    ] ) ;
                }
            } else {
                wp_send_json_error( [
                    'message'   =>  '<div class="alert alert-danger">Opps! System can\'t create the post. Please contact admin</div>',
                ] );
            }            
        }
    }

    wp_die();
}

add_action('wp_ajax_secret_register_action', 'secret_register_action');
add_action('wp_ajax_nopriv_secret_register_action', 'secret_register_action');

function secret_register_action()
{

    wp_verify_nonce('_wpnoncne', 'secret_register_action');

    $register_type      = isset($_POST['register_type']) ? hashMe(sanitize_text_field($_POST['register_type']), 'd') : '';
    if (!in_array($register_type, ['secret'])) {
        return false;
    }

    $submit_type        = isset($_POST['submit_type']) ? hashMe(sanitize_text_field($_POST['submit_type']), 'd') : '';

    $surname            = isset($_POST['surname']) ? sanitize_text_field($_POST['surname']) : '';
    $vorname            = isset($_POST['vorname']) ? sanitize_text_field($_POST['vorname']) : '';
    $strabe_nr          = isset($_POST['strabe_nr']) ? sanitize_text_field($_POST['strabe_nr']) : '';
    $plz                = isset($_POST['plz']) ? sanitize_text_field($_POST['plz']) : '';
    $ort                = isset($_POST['ort']) ? sanitize_text_field($_POST['ort']) : '';
    $e_post_address     = isset($_POST['e_post_address']) ? sanitize_text_field($_POST['e_post_address']) : '';
    $webseite           = isset($_POST['webseite']) ? sanitize_text_field($_POST['webseite']) : '';
    $werktitel          = isset($_POST['werktitel']) ? sanitize_text_field($_POST['werktitel']) : '';
    $werk_beschreibung  = isset($_POST['werk_beschreibung']) ? sanitize_text_field($_POST['werk_beschreibung']) : '';
    $ip                 = isset($_POST['ip']) ? sanitize_text_field($_POST['ip']) : '';
    $email              = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $inch_habe_die      = isset($_POST['inch_habe_die']) ? absint($_POST['inch_habe_die']) : '';
    $inh_habe_die_agb   = isset($_POST['inh_habe_die_agb']) ? absint($_POST['inh_habe_die_agb']) : '';
    $ich_habe_die       = isset($_POST['ich_habe_die']) ? absint($_POST['ich_habe_die']) : '';


    $wiener             = isset($_POST['wiener']) ? sanitize_text_field($_POST['wiener']) : '';
    $locarno            = isset($_POST['locarno']) ? sanitize_text_field($_POST['locarno']) : '';
    $internationale     = isset($_POST['internationale']) ? sanitize_text_field($_POST['internationale']) : '';
    $nizzaklassifikation = isset($_POST['nizzaklassifikation']) ? sanitize_text_field($_POST['nizzaklassifikation']) : '';
    $sha256             = isset($_POST['sha256']) ? sanitize_text_field($_POST['sha256']) : '';
    $keywordnr1         = isset($_POST['keywordnr1']) ? sanitize_text_field($_POST['keywordnr1']) : '';
    $keywordnr2         = isset($_POST['keywordnr2']) ? sanitize_text_field($_POST['keywordnr2']) : '';
    $keywordnr3         = isset($_POST['keywordnr3']) ? sanitize_text_field($_POST['keywordnr3']) : '';
    $keywordnr4         = isset($_POST['keywordnr4']) ? sanitize_text_field($_POST['keywordnr4']) : '';
    $keywordnr5         = isset($_POST['keywordnr5']) ? sanitize_text_field($_POST['keywordnr5']) : '';

    $file               = isset($_FILES['file']) ? $_FILES['file'] : '';
    $allowed_size       = 10485760;
    $allowed_image      = ['jpg', 'png', 'gif', 'jpeg'];
    $filename = $extension = $filesize = '';

    if ($file) {
        $filename = $file['name'];
        $explode = explode('.', $filename);
        $extension = strtolower(end($explode));
        $filesize = $file['size'];
    }


    $pattern            = '/(?:https?:\/\/)?(?:[a-zA-Z0-9.-]+?\.(?:[a-zA-Z])|\d+\.\d+\.\d+\.\d+)/';
    $errors             = [];

    if (empty($surname)) {
        $errors[] = 'Your surname is required';
    } elseif (strlen($surname) > 25 || strlen($surname) < 2) {
        $errors[] = 'Your surname must be between 2-25 characters long';
    }

    if (empty($vorname)) {
        $errors[] = 'Your vorname is required';
    } elseif (strlen($vorname) > 25 || strlen($vorname) < 2) {
        $errors[] = 'Your vorname must be between 2-25 characters long';
    }

    if (empty($strabe_nr)) {
        $errors[] = 'Your strabe nr is required';
    } elseif (strlen($strabe_nr) > 55 || strlen($strabe_nr) < 2) {
        $errors[] = 'Your strabe nr must be between 2-55 characters long';
    }

    if (empty($plz)) {
        $errors[] = 'Your plz is required';
    } elseif (strlen($plz) > 10 || strlen($plz) < 2) {
        $errors[] = 'Your plz must be between 2-10 characters long';
    }

    if (empty($ort)) {
        $errors[] = 'Your Ort / Stadt is required';
    } elseif (strlen($ort) > 35 || strlen($ort) < 2) {
        $errors[] = 'Your Ort / Stadt must be between 2-35 characters long';
    }

    if (empty($e_post_address)) {
        $errors[] = 'Your E-post address is required';
    } elseif (strlen($e_post_address) > 50 || strlen($e_post_address) < 2) {
        $errors[] = 'Your E-post address must be between 2-50 characters long';
    }

    if (empty($webseite)) {
        if (!preg_match($pattern, $webseite)) {
            $errors[] = 'Invalid webseite is given';
        } elseif (strlen($webseite) > 150 || strlen($webseite) < 2) {
            $errors[] = 'Your webseite must be between 2-150 characters long';
        }
    }

    if (empty($werktitel)) {
        $errors[] = 'Your werktitel is required';
    } elseif (strlen($werktitel) > 30 || strlen($werktitel) < 2) {
        $errors[] = 'Your werktitel must be between 2-30 characters long';
    }

    if (empty($werk_beschreibung)) {
        $errors[] = 'werk beschreibung is required';
    } elseif (strlen($werk_beschreibung) > 1000 || strlen($werk_beschreibung) < 2) {
        $errors[] = 'werk beschreibung must be 2-1000 characters long';
    }

    if (!empty($wiener)) {
        if (strlen($wiener) > 50 || strlen($wiener) < 2) {
            $errors[] = 'Your Wiener Klassifikation must be between 2-50 characters long';
        }
    }

    if (!empty($locarno)) {
        if (strlen($locarno) > 50 || strlen($locarno) < 2) {
            $errors[] = 'Your Locarno Klassifikation  must be between 2-50 characters long';
        }
    }

    if (!empty($internationale)) {
        if (strlen($internationale) > 50 || strlen($internationale) < 2) {
            $errors[] = 'Your nternationale Patentklassifikation must be between 2-50 characters long';
        }
    }

    if (!empty($nizzaklassifikation)) {
        if (strlen($nizzaklassifikation) > 50 || strlen($nizzaklassifikation) < 2) {
            $errors[] = 'Your Nizzaklassifikation must be between 2-50 characters long';
        }
    }

    if (empty($inch_habe_die)) {
        $errors[] = 'inch habe die is required';
    }

    if (empty($inh_habe_die_agb)) {
        $errors[] = 'inh habe die agb is required';
    }

    if (empty($ich_habe_die)) {
        $errors[] = 'ich habe die is required';
    }

    if (empty($filename)) {
        $errors[] = 'Please upload image';
    } elseif (!in_array($extension, $allowed_image)) {
        $errors[] = 'Only jpg, png and gif images are allowed';
    } elseif ($filesize > $allowed_size) {
        $errors[] = 'Maximum 10 MB image are allowd';
    }
    
    if (empty($sha256)) {
        $errors[] = 'SHA256 (Hashwert der Originalabbildung) is required, please upload the image again';
    } elseif (strlen($sha256) > 64 || strlen($sha256) < 64) {
        $errors[] = 'Invalid SHA256 (Hashwert der Originalabbildung) is given';
    }

    if (empty($keywordnr1)) {
        $errors[] = 'Keword Nr 1 is required';
    } elseif (strlen($keywordnr1) > 40 || strlen($keywordnr1) < 2) {
        $errors[] = 'Keword Nr 1 must be 2-40 characters long';
    }

    if (empty($keywordnr2)) {
        $errors[] = 'Keword Nr 2 is required';
    } elseif (strlen($keywordnr2) > 40 || strlen($keywordnr2) < 2) {
        $errors[] = 'Keword Nr 2 must be 2-40 characters long';
    }

    if (empty($keywordnr3)) {
        $errors[] = 'Keword Nr 3 is required';
    } elseif (strlen($keywordnr3) > 40 || strlen($keywordnr3) < 2) {
        $errors[] = 'Keword Nr 3 must be 2-40 characters long';
    }

    if (empty($keywordnr4)) {
        $errors[] = 'Keword Nr 4 is required';
    } elseif (strlen($keywordnr4) > 40 || strlen($keywordnr4) < 2) {
        $errors[] = 'Keword Nr 4 must be 2-40 characters long';
    }

    if (empty($keywordnr5)) {
        $errors[] = 'Keword Nr 5 is required';
    } elseif (strlen($keywordnr5) > 40 || strlen($keywordnr5) < 2) {
        $errors[] = 'Keword Nr 5 must be 2-40 characters long';
    }

    if (!$submit_type) {
        if (empty($email)) {
            $errors[] = 'E-mail address is required';
        } elseif (!is_email($email)) {
            $errors[] = 'Invalid E-mail address';
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            wp_send_json_error([
                'message'   =>  $error
            ]);
        }
    } else {

        $confirm_id          = 'ccroipr-' . date('Y' . 'm' . 'd' . 'H' . 'i' . 's') . randomNumber(3);

        $post_meta  =  [
            'surname'             => $surname,
            'vorname'             => $vorname,
            'strabe_nr'           => $strabe_nr,
            'plz'                 => $plz,
            'ort'                 => $ort,
            'e_post_address'      => $e_post_address,
            'webseite'            => $webseite,
            'werktitel'           => $werktitel,
            'werk_beschreibung'   => $werk_beschreibung,
            'inch_habe_die'       => $inch_habe_die,
            'inh_habe_die_agb'    => $inh_habe_die_agb,
            'ich_habe_die'        => $ich_habe_die,
            'user_ip'             => $ip,
            'is_confirm'          => 0,
            'wiener'              => $wiener,
            'locarno'             => $locarno,
            'internationale'      => $internationale,
            'nizzaklassifikation' => $nizzaklassifikation,
            'sha256'              => $sha256,
            'keywordnr1'          => $keywordnr1,
            'keywordnr2'          => $keywordnr2,
            'keywordnr3'          => $keywordnr3,
            'keywordnr4'          => $keywordnr4,
            'keywordnr5'          => $keywordnr5,
            'confirm_id'          => $confirm_id,
        ];

        $attachment_id          = media_handle_upload('file', 0);

        if (!is_wp_error($attachment_id)) {

            $post_meta['thumb_id'] = $attachment_id;

            $post_option = [
                'post_title'   => $confirm_id,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_type'    => 'atelier_kalai_media',
                'post_content' => '',
                'post_password' =>  'demo',
            ];


            $post_id = wp_insert_post($post_option);

            if (!is_wp_error($post_id)) {

                set_post_thumbnail($post_id, $post_meta['thumb_id']);
                update_post_meta($post_id, 'secret_akm', $post_meta);

                $pdf_data = [
                    'surname'           => $surname,
                    'attachment_id'     => $attachment_id,
                    'confirm_id'        => $confirm_id,
                    'vorname'           => $vorname,
                    'strabe_nr'         => $strabe_nr,
                    'plz'               => $plz,
                    'ort'               => $ort,
                    'e_post_address'    => $e_post_address,
                    'sha256'            => $sha256,
                    'werktitel'         => $werktitel,
                    'werk_beschreibung' => $werk_beschreibung,
                    'ip'                => $ip,
                    'email'             => $email,
                ];

                $pdf_link = generatePdfWithImage($pdf_data, true);

                wp_send_json_success([
                    'message'  => __('Successfully Submited', 'ccroipr'),
                ]);
            }
        }
    }

    wp_die();
}

// Add new role
add_action('init', 'ccroipr_new_custom_roles');
function ccroipr_new_custom_roles()
{
    add_role('ccroipr_register_p', 'Reigster P', array('read' => true, 'level_0' => true));
    add_role('ccroipr_register_t', 'Reigster T', array('read' => true, 'level_0' => true));
}

// Use this hook to check if the user account status is active or not
add_filter('wp_authenticate_user', 'shibbir_authenticate_user', 10, 2);
function shibbir_authenticate_user($user)
{
    if ($user->data->user_status  == 0) {
        return new WP_Error('error', __('Your account is not activate, Please contact site admininstrator.', 'shibbir'));
    }
    return $user;
}

// To delete user we need this file !!!
// require_once(ABSPATH.'wp-admin/includes/user.php');
// wp_delete_user( 2 );
// wp_delete_user( 3 );    

// Function to change email address
add_filter('wp_mail_from', 'shibbir_mail_from');
function shibbir_mail_from($original_email_address)
{
    return 'registration@ccroipr.org';
}

// Function to change sender name
add_filter('wp_mail_from_name', 'shibbir_mail_from_name');
function shibbir_mail_from_name($original_email_from)
{
    return 'ccroipr.org';
}

add_filter('wp_mail_content_type', 'shibbir_set_content_type');
function shibbir_set_content_type()
{
    return 'text/html';
}

add_filter('the_password_form', 'ccroipr_password_form');
function ccroipr_password_form()
{
    global $post;
    $label   =  'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $html    =  '';
    $html   .=  '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">';
    $html   .=  '<p>Please enter your password to access:</p>';
    $html   .=  '<div class="input-group mb-3">';
    $html   .=  '<input type="password" name="post_password" placeholder="Enter password" class="form-control" id="' . $label . '" size="20" maxlength="20">';
    $html   .=  '<div class="input-group-append">';
    $html   .=  '<input type="submit" name="submit" class="btn btn-success" value="Access Now">';
    $html   .=  '</div>';
    $html   .=  '</div>';
    $html   .= '</form>';
    return $html;
}

function wpdocs_custom_post_status(){
    register_post_status( 'confirmed', array(
        'label'                     => _x( 'Confirmed', 'post' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Confirmed <span class="count">(%s)</span>', 'Confirmed <span class="count">(%s)</span>' ),
    ) );
}
add_action( 'init', 'wpdocs_custom_post_status' );

// Remove WP admin dashboard widgets
function isa_disable_dashboard_widgets() {
    if( ! is_admin() ) {
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal');// Remove "At a Glance"
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');// Remove "Activity" which includes "Recent Comments"
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');// Remove Quick Draft
        remove_meta_box('dashboard_primary', 'dashboard', 'core');// Remove WordPress Events and News
    }
    
}
add_action('admin_menu', 'isa_disable_dashboard_widgets');