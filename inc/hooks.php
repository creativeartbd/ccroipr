<?php
/**
 * ccroipr all hooks
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ccroipr
 */

add_action( 'wp_ajax_download_profile_action', 'download_profile_action' );
add_action( 'wp_ajax_nopriv_download_profile_action', 'download_profile_action' );

function download_profile_action() {

    wp_verify_nonce( '_wpnoncne', 'download_profile_action' );

    $user_id        = hashMe( sanitize_text_field( $_POST['user_id'] ), 'd' );    
    $submit_type    = hashMe( sanitize_text_field( $_POST['submit_type'] ), 'd' );    // ccroipr_register_p or ccroipr_register_t

    $is_user_exist  = get_userdata( $user_id );

    if( $is_user_exist ) {

        $author_meta        = get_user_meta( $user_id, 'register_user_meta_key', true );  

        $confirm_id         = $author_meta['confirm_id'];

        $surname            = $author_meta['surname'];
        $vorname            = $author_meta['vorname'];
        $strabe_nr          = $author_meta['strabe_nr'];
        $plz                = $author_meta['plz'];
        $ort                = $author_meta['ort'];
        $e_post_address     = $author_meta['e_post_address'];
        $kategorie          = $author_meta['kategorie'];
        $webseite           = $author_meta['webseite'];
        $werktitel          = $author_meta['werktitel'];
        $werk_beschreibung  = $author_meta['werk_beschreibung'];
        $inch_habe_die      = $author_meta['inch_habe_die']; 
        $inh_habe_die_agb   = $author_meta['inh_habe_die_agb']; 
        $ich_habe_die       = $author_meta['ich_habe_die']; 
        $ip                 = $author_meta['user_ip']; 
        $email              = get_the_author_meta( 'email', $user_id );

        if( 'ccroipr_register_p' == $submit_type ) {
            $wiener             = $author_meta['wiener'];
            $locarno            = $author_meta['locarno'];
            $internationale     = $author_meta['internationale'];
            $nizzaklassifikation= $author_meta['nizzaklassifikation'];
            $sha256             = $author_meta['sha256'];
            $keywordnr1         = $author_meta['keywordnr1']; 
            $keywordnr2         = $author_meta['keywordnr2']; 
            $keywordnr3         = $author_meta['keywordnr3']; 
            $keywordnr4         = $author_meta['keywordnr4']; 
            $keywordnr5         = $author_meta['keywordnr5'];    
        }     

        if( 'ccroipr-register-t' == $submit_type ) {
            $kategorie          = str_replace('ccroipr-', 'ccroipr-cat-t-', $kategorie);
        }

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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('freesans', '', 11);

        $pdf->AddPage();

        if( 'ccroipr_register_p' == $submit_type ) {
            $thumb      = wp_get_attachment_image_src( $author_meta[ 'thumb_id' ], 'ccroipr' );
            $thumb_src  = $thumb[0]; 

            $image      = $thumb_src;
            $explode    = explode('.', $image);
            $extension  = strtolower(end($explode));
            //$extension  = strtoupper($explode[1]);    
        }
        
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
                    ";

        if( 'ccroipr_register_p' == $submit_type ) {
            $html .= "
                <tr>
                    <td>SHA256 (Hashwert der Originalabbildung)</td>
                    <td colspan=\"2\">$sha256</td>
                </tr>
                <tr>
                    <td>Werktitel</td>
                    <td colspan=\"2\">$werktitel</td>
                </tr>                
            </table>
            <table border=\"0\" cellpadding=\"5\">
                <tr>
                    <td>Werk-Beschreibung</td>
                </tr>
                <tr>
                    <td colspan=\"3\">$werk_beschreibung</td>
                </tr>    
            </table>
            ";
        } else {
            $html .= "
                <tr>
                    <td>Werktitel</td>
                    <td colspan=\"2\">$werktitel</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan=\"2\"></td>
                </tr>
            </table>
            <table border=\"0\" width=\"355\" cellpadding=\"5\">
                <tr>
                    <td>CCROIPR-Kategorie</td>
                    <td>$kategorie</td>
                </tr>              
            </table>
            <table border=\"0\" cellpadding=\"5\">
                <tr>
                    <td>Werk-Beschreibung</td>
                </tr>
                <tr>
                    <td colspan=\"3\">$werk_beschreibung</td>
                </tr>    
            </table>
            ";
        }                

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

        if( 'ccroipr_register_p' == $submit_type ) {
            $pdf->Image($image, '', '45', '75', '', $extension, '', '', true, 300, 'R', false, false, 1, false, false, false);
        }
        
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $pdf->AddPage();
        $pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);        

        $upload         = wp_upload_dir();
        $upload_dir     = $upload['basedir'];
        $upload_dir     = $upload_dir . '/ccroipr-pdf/';

        if (! is_dir($upload_dir)) {
            mkdir( $upload_dir, 0755 );
        }        

        $filename= $confirm_id.'.pdf';      
        $pdf->Output($upload_dir.$filename,'F');        
        echo $upload['baseurl'] . '/ccroipr-pdf/' . $confirm_id . '.pdf';

        //echo $upload_dir     = $upload_dir . '/ccroipr-pdf/'.$confirm_id.'.pdf';
    }
    wp_die();
}


add_action( 'wp_ajax_register_confirm_action', 'register_confirm_action' );
add_action( 'wp_ajax_nopriv_register_confirm_action', 'register_confirm_action' );

function register_confirm_action() {

    wp_verify_nonce( '_wpnoncne', 'register_confirm_action' );
   
    $register_type      = isset( $_POST['register_type'] ) ? hashMe( sanitize_text_field( $_POST['register_type'] ), 'd' ) : '';
    if( !in_array( $register_type, [ 'ccroipr_register_t', 'ccroipr_register_p' ] ) ) {
        return false;    
    }

    $user_id        = hashMe( sanitize_text_field( $_POST['user_id'] ), 'd' );    
    $is_user_exist  = get_userdata( $user_id );

    if( $is_user_exist ) {



        $domain                     = get_site_url();
        $author_meta                = get_user_meta( $user_id, 'register_user_meta_key', true );

        if( $author_meta['is_confirm'] == 0 ) {
 
            $author_meta['is_confirm']  = 1;
            $confirm_id                 = 'ccroipr-'.date('Y'.'m'.'d'.'H'.'i'.'s').randomNumber(3);
            $author_meta['confirm_id']  = $confirm_id;
            

            if( 'ccroipr_register_p' == $register_type ) {

                $author_meta['kategorie']   = 'ccroipr-cat-p-'.date('Y'.'-'.'m'.'-'.'d');     
                
                $upload_dir                 = wp_upload_dir();
                $path                       = $upload_dir['path'];

                $thumb                      = wp_get_attachment_image_src( $author_meta[ 'thumb_id' ], 'ccroipr' );
                $thumb_src                  = $thumb[0];                
                $relative_url               = str_replace( $domain, '', $thumb_src );

                $explode                    = explode( '.', $thumb_src );
                $extension                  = end( $explode );
                $explode_2                  = explode( '/', $thumb_src );
                $file_name                  = end( $explode_2 );        
                
                //image_resize_base_width( $relative_url, $relative_url, 350, $extension);
                if( $extension == 'jpg') {
                    $jpg_image = imagecreatefromjpeg( $thumb_src );
                } elseif( $extension == 'png' ) {
                    $jpg_image = imagecreatefrompng( $thumb_src );
                } elseif ( $extension == 'gif' ) {
                    $jpg_image = imagecreatefromgif( $thumb_src );
                }

                // set font size
                $font       = @imageloadfont($jpg_image);
                $fontSize   = imagefontwidth($font);

                $orig_width = imagesx($jpg_image);
                $orig_height = imagesy($jpg_image);


                // Create your canvas containing both image and text
                $canvas = imagecreatetruecolor($orig_width,  ($orig_height + 40));
                // Allocate A Color For The background
                $bcolor = imagecolorallocate($canvas, 255, 255, 255);
                // Add background colour into the canvas
                imagefilledrectangle( $canvas, 0, 0, $orig_width, ($orig_height + 40), $bcolor);
                // Save image to the new canvas
                imagecopyresampled ( $canvas , $jpg_image , 0 , 0 , 0 , 0, $orig_width , $orig_height , $orig_width , $orig_height );
                
                $font_path = get_template_directory() . '/assets/fonts/arial.ttf';
                // Set Text to Be Printed On Image
                $text = 'cc-by-nd-'.$confirm_id;
                // Allocate A Color For The Text
                $color = imagecolorallocate($canvas, 0, 0, 0);
                // Print Text On Image
                imagettftext($canvas, 13, 0, 10, $orig_height + 25, $color, $font_path, $text);
                // Send Image to Browser
                if( $extension == 'jpg') {
                    imagejpeg($canvas, $path .'/'. $file_name );
                } elseif( $extension == 'png' ) {
                    imagepng($canvas, $path .'/'. $file_name );
                } elseif ( $extension == 'gif' ) {
                    imagegif($canvas, $path .'/'. $file_name );
                }
                // Clear Memory
                imagedestroy($canvas);      
                $category_id = get_category_by_slug( 'cat-p' ); //  

            } elseif( 'ccroipr_register_t' == $register_type ) {

                $werktitel = $author_meta['werktitel'];

                $author_meta['kategorie']   = 'ccroipr-'.date('Y'.'-'.'m'.'-'.'d');         
                $text = "TITELSCHUTZANMELDUNG $confirm_id $werktitel";
                $image_width = 1140;

                $search                 = array(' ', '-');
                $replace                = array('-', '');
                $imageName              = str_replace($search, $replace, $werktitel);
                $generatedImage         = $imageName.'-'.random(5);

                $upload         = wp_upload_dir();
                $upload_dir     = $upload['basedir'];
                $upload_dir     = $upload_dir . '/ccroipr-t/';

                if (! is_dir($upload_dir)) {
                    mkdir( $upload_dir, 0755 );
                }

                textToImg($text, $image_width, $upload_dir.$generatedImage);  
                $author_meta['thumb_id_t'] = $generatedImage;

                $category_id = get_category_by_slug( 'cat-t' ); //
            } 
        
            $category_id = $category_id->term_id;

            update_user_meta( $user_id, 'register_user_meta_key', $author_meta );         
            // create psot by the $confirm_id 
            $post_option = [
                'post_title'    => $confirm_id,      
                'post_status'   => 'publish',
                'post_author'   => $user_id,
                'post_category' => array( $category_id )
            ];

            $post_id = wp_insert_post( $post_option );

            if( ! is_wp_error( $post_id ) ) {
                if( 'ccroipr_register_p' == $register_type ) {
                    set_post_thumbnail( $post_id, $author_meta[ 'thumb_id' ] );
                    $permalink = get_the_permalink( $post_id );                    
                }
                wp_send_json_success( '<div class="alert alert-success">Successfully Confirmed your profile data.</div>' );
            } 
        } else {
            wp_send_json_error( 'You already confirmed your data'  );
        }             
    }

    wp_die();
}

add_action( 'wp_ajax_register_slim_file_action', 'register_slim_file_action' );
add_action( 'wp_ajax_nopriv_register_slim_file_action', 'register_slim_file_action' );

function register_slim_file_action() {

	wp_verify_nonce( '_wpnoncne', 'register_slim_file_action' );
	echo hash('sha256', uniqid());	
	wp_die();
}

// ====================================================================
// Registration and Update process for the "Register" and "Register T"
// ===================================================================
add_action( 'wp_ajax_register_action', 'register_action' );
add_action( 'wp_ajax_nopriv_register_action', 'register_action' );

function register_action() {

	wp_verify_nonce( '_wpnoncne', 'register_action' ); 

    $register_type      = isset( $_POST['register_type'] ) ? hashMe( sanitize_text_field( $_POST['register_type'] ), 'd' ) : '';
    if( !in_array( $register_type, [ 'ccroipr_register_t', 'ccroipr_register_p' ] ) ) {
        return false;    
    }

    $submit_type        = isset( $_POST['submit_type'] ) ? hashMe( sanitize_text_field( $_POST['submit_type'] ), 'd' ) : '';

	$surname 			= isset( $_POST['surname'] ) ? sanitize_text_field( $_POST[ 'surname' ] ) : '';
	$vorname 			= isset( $_POST['vorname'] ) ? sanitize_text_field( $_POST[ 'vorname' ] ) : '';
	$strabe_nr 			= isset( $_POST['strabe_nr'] ) ? sanitize_text_field( $_POST[ 'strabe_nr' ] ) : '';
	$plz 				= isset( $_POST['plz'] ) ? sanitize_text_field( $_POST[ 'plz' ] ) : '';
	$ort 				= isset( $_POST['ort'] ) ? sanitize_text_field( $_POST[ 'ort' ] ) : '';
	$e_post_address 	= isset( $_POST['e_post_address'] ) ? sanitize_text_field( $_POST[ 'e_post_address' ] ) : '';
	$webseite 			= isset( $_POST['webseite'] ) ? sanitize_text_field( $_POST[ 'webseite' ] ) : '';
	$werktitel 			= isset( $_POST['werktitel'] ) ? sanitize_text_field( $_POST[ 'werktitel' ] ) : '';
    $werk_beschreibung  = isset( $_POST['werk_beschreibung'] ) ? sanitize_text_field( $_POST[ 'werk_beschreibung' ] ) : '';
    $ip                 = isset( $_POST['ip'] ) ? sanitize_text_field( $_POST[ 'ip' ] ) : ''; 
    $email              = isset( $_POST['email'] ) ? sanitize_email( $_POST[ 'email' ] ) : '';  
    $inch_habe_die      = isset( $_POST['inch_habe_die'] ) ? absint( $_POST[ 'inch_habe_die' ] ) : ''; 
    $inh_habe_die_agb   = isset( $_POST['inh_habe_die_agb'] ) ? absint( $_POST[ 'inh_habe_die_agb' ] ) : ''; 
    $ich_habe_die       = isset( $_POST['ich_habe_die'] ) ? absint( $_POST[ 'ich_habe_die' ] ) : ''; 


    // Following data needed for the "Register P" form process
    if( 'ccroipr_register_p' == $register_type ) {        
    	$wiener 			= isset( $_POST['wiener'] ) ? sanitize_text_field( $_POST[ 'wiener' ] ) : '';
    	$locarno 			= isset( $_POST['locarno'] ) ? sanitize_text_field( $_POST[ 'locarno' ] ) : '';
    	$internationale 	= isset( $_POST['internationale'] ) ? sanitize_text_field( $_POST[ 'internationale' ] ) : '';
    	$nizzaklassifikation= isset( $_POST['nizzaklassifikation'] ) ? sanitize_text_field( $_POST[ 'nizzaklassifikation' ] ) : '';
    	$sha256 			= isset( $_POST['sha256'] ) ? sanitize_text_field( $_POST[ 'sha256' ] ) : '';	
    	$keywordnr1 		= isset( $_POST['keywordnr1'] ) ? sanitize_text_field( $_POST[ 'keywordnr1' ] ) : ''; 
    	$keywordnr2 		= isset( $_POST['keywordnr2'] ) ? sanitize_text_field( $_POST[ 'keywordnr2' ] ) : ''; 
    	$keywordnr3 		= isset( $_POST['keywordnr3'] ) ? sanitize_text_field( $_POST[ 'keywordnr3' ] ) : ''; 
    	$keywordnr4 		= isset( $_POST['keywordnr4'] ) ? sanitize_text_field( $_POST[ 'keywordnr4' ] ) : ''; 
        $keywordnr5 		= isset( $_POST['keywordnr5'] ) ? sanitize_text_field( $_POST[ 'keywordnr5' ] ) : '';         
        $slim               = sanitize_text_field( $_POST['slim'] );

        $decode             = json_decode( str_replace( '\\', '', $slim ) );       

        $image_name         = $decode->input->name;
        $image_size         = $decode->input->size;
        $final_image        = $decode->output->image;

        $explode            = explode('.', $image_name);
        $extension          = strtolower( end( $explode ) );

        $allowed_size       = 10485760;
        $allowed_image      = ['jpg', 'png', 'gif', 'jpeg'];      
        
    }
    
    $pattern            = '/(?:https?:\/\/)?(?:[a-zA-Z0-9.-]+?\.(?:[a-zA-Z])|\d+\.\d+\.\d+\.\d+)/';
    $errors 			= [];
   
	if( empty( $surname ) ) {
		$errors[] = 'Your surname is required';
	} elseif( strlen( $surname ) > 25 || strlen( $surname ) < 2  ) {
		$errors[] = 'Your surname must be between 2-25 characters long';
	}

	if( empty( $vorname ) ) {
		$errors[] = 'Your vorname is required';
	} elseif( strlen( $vorname ) > 25 || strlen( $vorname ) < 2  ) {
		$errors[] = 'Your vorname must be between 2-25 characters long';
	}

	if( empty( $strabe_nr ) ) {
		$errors[] = 'Your strabe nr is required';
	} elseif( strlen( $strabe_nr ) > 55 || strlen( $strabe_nr ) < 2  ) {
		$errors[] = 'Your strabe nr must be between 2-55 characters long';
	}

	if( empty( $plz ) ) {
		$errors[] = 'Your plz is required';
	} elseif( strlen( $plz ) > 10 || strlen( $plz ) < 2  ) {
		$errors[] = 'Your plz must be between 2-10 characters long';
	}

	if( empty( $ort ) ) {
		$errors[] = 'Your Ort / Stadt is required';
	} elseif( strlen( $ort ) > 35 || strlen( $ort ) < 2  ) {
		$errors[] = 'Your Ort / Stadt must be between 2-35 characters long';
	}

	if( empty( $e_post_address ) ) {
		$errors[] = 'Your E-post address is required';
	} elseif( strlen( $e_post_address ) > 50 || strlen( $e_post_address ) < 2  ) {
		$errors[] = 'Your E-post address must be between 2-50 characters long';
	}

	if( empty( $webseite ) ) {
		$errors[] = 'Your webseite is required';
	} elseif( !preg_match( $pattern, $webseite ) ) {
        $errors[] = 'Invalid webseite is given';
    } elseif( strlen( $webseite ) > 150 || strlen( $webseite ) < 2  ) {
		$errors[] = 'Your webseite must be between 2-150 characters long';
	}

	if( empty( $werktitel ) ) {
		$errors[] = 'Your werktitel is required';
	} elseif( strlen( $werktitel ) > 30 || strlen( $werktitel ) < 2  ) {
		$errors[] = 'Your werktitel must be between 2-30 characters long';
	}

    if( empty( $werk_beschreibung ) ) {
        $errors[] = 'werk beschreibung is required';
    } elseif( strlen( $werk_beschreibung ) > 1000 || strlen( $werk_beschreibung ) < 2  ) {
        $errors[] = 'werk beschreibung must be 2-1000 characters long';
    }

	if( !empty( $wiener ) ) {
		if( strlen( $wiener ) > 50 || strlen( $wiener ) < 2  ) {
			$errors[] = 'Your Wiener Klassifikation must be between 2-50 characters long';
		}
	}

	if( !empty( $locarno ) ) {
		if( strlen( $locarno ) > 50 || strlen( $locarno ) < 2  ) {
			$errors[] = 'Your Locarno Klassifikation  must be between 2-50 characters long';
		}
	}

	if( !empty( $internationale ) ) {
		if( strlen( $internationale ) > 50 || strlen( $internationale ) < 2  ) {
			$errors[] = 'Your nternationale Patentklassifikation must be between 2-50 characters long';
		}
	}

	if( !empty( $nizzaklassifikation ) ) {
		if( strlen( $nizzaklassifikation ) > 50 || strlen( $nizzaklassifikation ) < 2  ) {
			$errors[] = 'Your Nizzaklassifikation must be between 2-50 characters long';
		}
	}

    if( empty( $inch_habe_die ) ) {
        $errors[] = 'inch habe die is required';
    }

    if( empty( $inh_habe_die_agb ) ) {
        $errors[] = 'inh habe die agb is required';
    }

    if( empty( $ich_habe_die ) ) {
        $errors[] = 'ich habe die is required';
    }

    if( 'ccroipr_register_p' == $register_type ) {  

        if( 'updatedata' == $submit_type ) {
            if( !empty( $filename ) ) {
                if( !in_array( $extension, $allowed_image ) ) {
                    $errors[] = 'Only jpg, png and gif images are allowed';
                } elseif( $filesize > $allowed_size ) {
                    $errors[] = 'Maximum 10 MB image are allowd'; 
                }    
            }            
        } else {
            if( empty( $image_name ) ) {
                $errors[] = 'Please upload image';
            } elseif( !in_array( $extension, $allowed_image ) ) {
                $errors[] = 'Only jpg, png and gif images are allowed';
            } elseif( $image_size > $allowed_size ) {
                $errors[] = 'Maximum 10 MB image are allowd'; 
            }    
        }   

        if( empty( $sha256 ) ) {
            $errors[] = 'SHA256 (Hashwert der Originalabbildung) is required, please upload the image again';
        } elseif( strlen( $sha256 ) > 64 || strlen( $sha256 ) < 64  ) {
            $errors[] = 'Invalid SHA256 (Hashwert der Originalabbildung) is given';
        }   

        if( empty( $keywordnr1 ) ) {
            $errors[] = 'Keword Nr 1 is required';
        } elseif( strlen( $keywordnr1 ) > 40 || strlen( $keywordnr1 ) < 2  ) {
            $errors[] = 'Keword Nr 1 must be 2-40 characters long';
        }

        if( empty( $keywordnr2 ) ) {
            $errors[] = 'Keword Nr 2 is required';
        } elseif( strlen( $keywordnr2 ) > 40 || strlen( $keywordnr2 ) < 2  ) {
            $errors[] = 'Keword Nr 2 must be 2-40 characters long';
        }

        if( empty( $keywordnr3 ) ) {
            $errors[] = 'Keword Nr 3 is required';
        } elseif( strlen( $keywordnr3 ) > 40 || strlen( $keywordnr3 ) < 2  ) {
            $errors[] = 'Keword Nr 3 must be 2-40 characters long';
        }

        if( empty( $keywordnr4 ) ) {
            $errors[] = 'Keword Nr 4 is required';
        } elseif( strlen( $keywordnr4 ) > 40 || strlen( $keywordnr4 ) < 2  ) {
            $errors[] = 'Keword Nr 4 must be 2-40 characters long';
        }

        if( empty( $keywordnr5 ) ) {
            $errors[] = 'Keword Nr 5 is required';
        } elseif( strlen( $keywordnr5 ) > 40 || strlen( $keywordnr5 ) < 2  ) {
            $errors[] = 'Keword Nr 5 must be 2-40 characters long';
        } 
    }		

    if( ! $submit_type ) {
        if( empty( $email ) ) {
            $errors[] = 'E-mail address is required';
        } elseif( !is_email( $email )  ) {
            $errors[] = 'Invalid E-mail address';
        } 
    } 

    if( !empty( $errors ) ) {    
    	foreach ( $errors as $error ) {
    		wp_send_json_error( '<div class="alert alert-danger">'.$error.'</div>' );
    	}    	
    } else {        

        // Form value as meta key and value       
        $userdata = [     
            'user_pass'             => '',       
            'user_login'            => $surname,
            'user_nicename'         => $vorname,             
            'user_email'            => $email,  
            'display_name'          => $vorname,
            'nickname'              => $vorname,
            'first_name'            => $vorname,
            'show_admin_bar_front'  => false,
        ];

        if( 'ccroipr_register_p' == $register_type ) {
            $userdata['role']       = 'ccroipr_register_p';
        } elseif( 'ccroipr_register_t' == $register_type ) {
            $userdata['role']       = 'ccroipr_register_t';
        }

        $meta_array = [
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
            'user_ip'           => $ip,
            'is_confirm'        => 0,
        ];

        if( 'ccroipr_register_p' == $register_type ) {  
            $meta_array['wiener']              = $wiener; 
            $meta_array['locarno']             = $locarno; 
            $meta_array['internationale']      = $internationale; 
            $meta_array['nizzaklassifikation'] = $nizzaklassifikation; 
            $meta_array['sha256']              = $sha256;
            $meta_array['keywordnr1']          = $keywordnr1;
            $meta_array['keywordnr2']          = $keywordnr2; 
            $meta_array['keywordnr3']          = $keywordnr3; 
            $meta_array['keywordnr4']          = $keywordnr4; 
            $meta_array['keywordnr5']          = $keywordnr5; 
        }       

        // Update data only
        if( 'updatedata' == $submit_type ) {

            $user_id        = hashMe( sanitize_text_field( $_POST['user_id'] ), 'd' );
            
            if( 'ccroipr_register_p' == $register_type ) {

                $thumb_id       = hashMe( sanitize_text_field( $_POST['thumb_id'] ), 'd' );
                $is_user_exist  = get_userdata( $user_id ); 

                if( $is_user_exist ) {
                    if( $filename ) {
                        $attachment_id = media_handle_upload( 'file', 0 );                   
                        $meta_array['thumb_id'] =  $attachment_id;   
                        wp_delete_attachment( $thumb_id );
                    } else {
                        $meta_array['thumb_id'] = $thumb_id; 
                    }                     
                }            
            }

            update_user_meta( $user_id, 'register_user_meta_key', $meta_array );
            wp_send_json_success( '<div class="alert alert-success">Successfully updated your data.</div>' ); 

        } else {          

            $user_id = wp_insert_user( $userdata ) ;

            if ( ! is_wp_error( $user_id ) ) {
                
                if( 'ccroipr_register_p' == $register_type ) {
                    
                    $data                   = base64_decode( preg_replace( '#^data: image/\w+;base64,#i', '', $final_image ) );
                    $final_image            = $surname . '-' . rand(1000,9999) . '.' . $extension;
                    $upload                 = wp_upload_dir();
                    $upload_dir             = $upload['basedir'];
                    file_put_contents( $upload_dir . '/' . $final_image, $data );
                    $meta_array['thumb_id'] = $final_image;
                }
                    
                add_user_meta( $user_id, 'register_user_meta_key', $meta_array );

                $code = sha1( $user_id . time() );    

                global $wpdb; 

                $wpdb->update( 
                    $wpdb->prefix.'users', //table name     
                    array( 'user_activation_key' => $code ),       
                    array( 'ID' =>    $user_id ),     
                    array( '%s' ),
                    array( '%d' ) 
                );

                $activation_link = add_query_arg( 
                    array( 
                        'key' => $code, 
                        'user' => $user_id 
                    ), get_permalink( get_page_by_path( 'registration-confirmation' ) )
                );  

                $message = "<div style='padding : 20px; border : 1px solid #ddd; color : #000;'>Hello $surname, <br/><br/>Please confirm your email addresss for CCROIPR-Registration von $werktitel. Click this link to confirm : <a href='$activation_link'>Confirm Now</a><br/><br/>http://ccroipr.org<br/>Thank You.<br/></div>";

                $to         = $email;
                $subject    = 'Confirm your registration process at ccroipr.org';
                $body       = $message;
                $headers    = array('Content-Type: text/html; charset=UTF-8');

                $toArray[]  = 'registration@ccroipr.org';
                $toArray[]  = 'backup@ccroipr.org';
                $toArray[]  = 'backup@atelier-kalai.de';
                $toArray[]  =  $to;
                
                // Send email to user for activate the account 
                if( wp_mail( $toArray, $subject, $body, $headers ) ) {
                    wp_send_json_success( '<div class="alert alert-success">Please confirm your email addresss for CCROIPR-Registration von Werktitel.</div>' );
                }               
            } 
        }
    }

    wp_die();
    
}

add_action( 'wp_ajax_secret_register_action', 'secret_register_action' );
add_action( 'wp_ajax_nopriv_secret_register_action', 'secret_register_action' );

function secret_register_action() {

    wp_verify_nonce( '_wpnoncne', 'secret_register_action' );

    $register_type      = isset( $_POST['register_type'] ) ? hashMe( sanitize_text_field( $_POST['register_type'] ), 'd' ) : '';
    if( !in_array( $register_type, [ 'secret' ] ) ) {
        return false;    
    }  

    $submit_type        = isset( $_POST['submit_type'] ) ? hashMe( sanitize_text_field( $_POST['submit_type'] ), 'd' ) : '';

    $surname            = isset( $_POST['surname'] ) ? sanitize_text_field( $_POST[ 'surname' ] ) : '';
    $vorname            = isset( $_POST['vorname'] ) ? sanitize_text_field( $_POST[ 'vorname' ] ) : '';
    $strabe_nr          = isset( $_POST['strabe_nr'] ) ? sanitize_text_field( $_POST[ 'strabe_nr' ] ) : '';
    $plz                = isset( $_POST['plz'] ) ? sanitize_text_field( $_POST[ 'plz' ] ) : '';
    $ort                = isset( $_POST['ort'] ) ? sanitize_text_field( $_POST[ 'ort' ] ) : '';
    $e_post_address     = isset( $_POST['e_post_address'] ) ? sanitize_text_field( $_POST[ 'e_post_address' ] ) : '';
    $webseite           = isset( $_POST['webseite'] ) ? sanitize_text_field( $_POST[ 'webseite' ] ) : '';
    $werktitel          = isset( $_POST['werktitel'] ) ? sanitize_text_field( $_POST[ 'werktitel' ] ) : '';
    $werk_beschreibung  = isset( $_POST['werk_beschreibung'] ) ? sanitize_text_field( $_POST[ 'werk_beschreibung' ] ) : '';
    $ip                 = isset( $_POST['ip'] ) ? sanitize_text_field( $_POST[ 'ip' ] ) : ''; 
    $email              = isset( $_POST['email'] ) ? sanitize_email( $_POST[ 'email' ] ) : '';  
    $inch_habe_die      = isset( $_POST['inch_habe_die'] ) ? absint( $_POST[ 'inch_habe_die' ] ) : ''; 
    $inh_habe_die_agb   = isset( $_POST['inh_habe_die_agb'] ) ? absint( $_POST[ 'inh_habe_die_agb' ] ) : ''; 
    $ich_habe_die       = isset( $_POST['ich_habe_die'] ) ? absint( $_POST[ 'ich_habe_die' ] ) : ''; 
    
    
    $wiener             = isset( $_POST['wiener'] ) ? sanitize_text_field( $_POST[ 'wiener' ] ) : '';
    $locarno            = isset( $_POST['locarno'] ) ? sanitize_text_field( $_POST[ 'locarno' ] ) : '';
    $internationale     = isset( $_POST['internationale'] ) ? sanitize_text_field( $_POST[ 'internationale' ] ) : '';
    $nizzaklassifikation= isset( $_POST['nizzaklassifikation'] ) ? sanitize_text_field( $_POST[ 'nizzaklassifikation' ] ) : '';
    $sha256             = isset( $_POST['sha256'] ) ? sanitize_text_field( $_POST[ 'sha256' ] ) : '';   
    $keywordnr1         = isset( $_POST['keywordnr1'] ) ? sanitize_text_field( $_POST[ 'keywordnr1' ] ) : ''; 
    $keywordnr2         = isset( $_POST['keywordnr2'] ) ? sanitize_text_field( $_POST[ 'keywordnr2' ] ) : ''; 
    $keywordnr3         = isset( $_POST['keywordnr3'] ) ? sanitize_text_field( $_POST[ 'keywordnr3' ] ) : ''; 
    $keywordnr4         = isset( $_POST['keywordnr4'] ) ? sanitize_text_field( $_POST[ 'keywordnr4' ] ) : ''; 
    $keywordnr5         = isset( $_POST['keywordnr5'] ) ? sanitize_text_field( $_POST[ 'keywordnr5' ] ) : ''; 
    
    $file               = isset( $_FILES['file'] ) ? $_FILES['file'] : '';
    $allowed_size       = 10485760;
    $allowed_image      = ['jpg', 'png', 'gif', 'jpeg'];
    $filename = $extension = $filesize = '';

    if( $file ) {
        $filename = $file['name'];
        $explode = explode( '.' , $filename );
        $extension = strtolower( end( $explode ) );
        $filesize = $file['size'];
    }
    
    
    $pattern            = '/(?:https?:\/\/)?(?:[a-zA-Z0-9.-]+?\.(?:[a-zA-Z])|\d+\.\d+\.\d+\.\d+)/';
    $errors             = [];
   
    if( empty( $surname ) ) {
        $errors[] = 'Your surname is required';
    } elseif( strlen( $surname ) > 25 || strlen( $surname ) < 2  ) {
        $errors[] = 'Your surname must be between 2-25 characters long';
    }

    if( empty( $vorname ) ) {
        $errors[] = 'Your vorname is required';
    } elseif( strlen( $vorname ) > 25 || strlen( $vorname ) < 2  ) {
        $errors[] = 'Your vorname must be between 2-25 characters long';
    }

    if( empty( $strabe_nr ) ) {
        $errors[] = 'Your strabe nr is required';
    } elseif( strlen( $strabe_nr ) > 55 || strlen( $strabe_nr ) < 2  ) {
        $errors[] = 'Your strabe nr must be between 2-55 characters long';
    }

    if( empty( $plz ) ) {
        $errors[] = 'Your plz is required';
    } elseif( strlen( $plz ) > 10 || strlen( $plz ) < 2  ) {
        $errors[] = 'Your plz must be between 2-10 characters long';
    }

    if( empty( $ort ) ) {
        $errors[] = 'Your Ort / Stadt is required';
    } elseif( strlen( $ort ) > 35 || strlen( $ort ) < 2  ) {
        $errors[] = 'Your Ort / Stadt must be between 2-35 characters long';
    }

    if( empty( $e_post_address ) ) {
        $errors[] = 'Your E-post address is required';
    } elseif( strlen( $e_post_address ) > 50 || strlen( $e_post_address ) < 2  ) {
        $errors[] = 'Your E-post address must be between 2-50 characters long';
    }

    if( empty( $webseite ) ) {
        $errors[] = 'Your webseite is required';
    } elseif( !preg_match( $pattern, $webseite ) ) {
        $errors[] = 'Invalid webseite is given';
    } elseif( strlen( $webseite ) > 150 || strlen( $webseite ) < 2  ) {
        $errors[] = 'Your webseite must be between 2-150 characters long';
    }

    if( empty( $werktitel ) ) {
        $errors[] = 'Your werktitel is required';
    } elseif( strlen( $werktitel ) > 30 || strlen( $werktitel ) < 2  ) {
        $errors[] = 'Your werktitel must be between 2-30 characters long';
    }

    if( empty( $werk_beschreibung ) ) {
        $errors[] = 'werk beschreibung is required';
    } elseif( strlen( $werk_beschreibung ) > 1000 || strlen( $werk_beschreibung ) < 2  ) {
        $errors[] = 'werk beschreibung must be 2-1000 characters long';
    }

    if( !empty( $wiener ) ) {
        if( strlen( $wiener ) > 50 || strlen( $wiener ) < 2  ) {
            $errors[] = 'Your Wiener Klassifikation must be between 2-50 characters long';
        }
    }

    if( !empty( $locarno ) ) {
        if( strlen( $locarno ) > 50 || strlen( $locarno ) < 2  ) {
            $errors[] = 'Your Locarno Klassifikation  must be between 2-50 characters long';
        }
    }

    if( !empty( $internationale ) ) {
        if( strlen( $internationale ) > 50 || strlen( $internationale ) < 2  ) {
            $errors[] = 'Your nternationale Patentklassifikation must be between 2-50 characters long';
        }
    }

    if( !empty( $nizzaklassifikation ) ) {
        if( strlen( $nizzaklassifikation ) > 50 || strlen( $nizzaklassifikation ) < 2  ) {
            $errors[] = 'Your Nizzaklassifikation must be between 2-50 characters long';
        }
    }

    if( empty( $inch_habe_die ) ) {
        $errors[] = 'inch habe die is required';
    }

    if( empty( $inh_habe_die_agb ) ) {
        $errors[] = 'inh habe die agb is required';
    }

    if( empty( $ich_habe_die ) ) {
        $errors[] = 'ich habe die is required';
    }  

    if( empty( $filename ) ) {
        $errors[] = 'Please upload image';
    } elseif( !in_array( $extension, $allowed_image ) ) {
        $errors[] = 'Only jpg, png and gif images are allowed';
    } elseif( $filesize > $allowed_size ) {
        $errors[] = 'Maximum 10 MB image are allowd'; 
    }           

    if( empty( $sha256 ) ) {
        $errors[] = 'SHA256 (Hashwert der Originalabbildung) is required, please upload the image again';
    } elseif( strlen( $sha256 ) > 64 || strlen( $sha256 ) < 64  ) {
        $errors[] = 'Invalid SHA256 (Hashwert der Originalabbildung) is given';
    }   

    if( empty( $keywordnr1 ) ) {
        $errors[] = 'Keword Nr 1 is required';
    } elseif( strlen( $keywordnr1 ) > 40 || strlen( $keywordnr1 ) < 2  ) {
        $errors[] = 'Keword Nr 1 must be 2-40 characters long';
    }

    if( empty( $keywordnr2 ) ) {
        $errors[] = 'Keword Nr 2 is required';
    } elseif( strlen( $keywordnr2 ) > 40 || strlen( $keywordnr2 ) < 2  ) {
        $errors[] = 'Keword Nr 2 must be 2-40 characters long';
    }

    if( empty( $keywordnr3 ) ) {
        $errors[] = 'Keword Nr 3 is required';
    } elseif( strlen( $keywordnr3 ) > 40 || strlen( $keywordnr3 ) < 2  ) {
        $errors[] = 'Keword Nr 3 must be 2-40 characters long';
    }

    if( empty( $keywordnr4 ) ) {
        $errors[] = 'Keword Nr 4 is required';
    } elseif( strlen( $keywordnr4 ) > 40 || strlen( $keywordnr4 ) < 2  ) {
        $errors[] = 'Keword Nr 4 must be 2-40 characters long';
    }

    if( empty( $keywordnr5 ) ) {
        $errors[] = 'Keword Nr 5 is required';
    } elseif( strlen( $keywordnr5 ) > 40 || strlen( $keywordnr5 ) < 2  ) {
        $errors[] = 'Keword Nr 5 must be 2-40 characters long';
    }        

    if( ! $submit_type ) {
        if( empty( $email ) ) {
            $errors[] = 'E-mail address is required';
        } elseif( !is_email( $email )  ) {
            $errors[] = 'Invalid E-mail address';
        } 
    } 

    if( !empty( $errors ) ) {    
        foreach ( $errors as $error ) {
            wp_send_json_error( [
                'message'   =>  $error
            ] );
        }       
    } else {

        $confirm_id          = 'ccroipr-'.date('Y'.'m'.'d'.'H'.'i'.'s').randomNumber(3);

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
                    
        $attachment_id          = media_handle_upload( 'file', 0 );   

        if( !is_wp_error( $attachment_id ) ) {

            $post_meta['thumb_id'] = $attachment_id;

            $post_option = [
                'post_title'   => $confirm_id,
                'post_status'  => 'publish',
                'post_author'  => 1, 
                'post_type'    => 'atelier_kalai_media',
                'post_content' => '',
                'post_password' =>  'demo',
            ];    


            $post_id = wp_insert_post( $post_option );

            if( ! is_wp_error( $post_id ) ) {   

                set_post_thumbnail( $post_id, $post_meta[ 'thumb_id' ] );  
                update_post_meta( $post_id, 'secret_akm', $post_meta );
                
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

                $pdf_link = generatePdfWithImage( $pdf_data, true );

                wp_send_json_success( [
                    'message'  => __( 'Successfully Submited', 'ccroipr'),                    
                ] );

            }          
        } 
        
    }

    wp_die();
}

// Add new role
add_action( 'init', 'ccroipr_new_custom_roles' );
function ccroipr_new_custom_roles() {    
    add_role( 'ccroipr_register_p', 'Reigster P', array( 'read' => true, 'level_0' => true ) );
    add_role( 'ccroipr_register_t', 'Reigster T', array( 'read' => true, 'level_0' => true ) );
}

// Use this hook to check if the user account status is active or not
add_filter( 'wp_authenticate_user', 'shibbir_authenticate_user', 10, 2 );
function shibbir_authenticate_user( $user ) {
    if ( $user->data->user_status  == 0 ) {
        return new WP_Error( 'error', __( 'Your account is not activate, Please contact site admininstrator.' , 'shibbir' ) );
    }
    return $user;
}

// To delete user we need this file !!!
// require_once(ABSPATH.'wp-admin/includes/user.php');
// wp_delete_user( 2 );
// wp_delete_user( 3 );    

// Function to change email address
add_filter( 'wp_mail_from', 'shibbir_mail_from' );
function shibbir_mail_from( $original_email_address ) {
    return 'registration@ccroipr.org';
}
 
// Function to change sender name
add_filter( 'wp_mail_from_name', 'shibbir_mail_from_name' );
function shibbir_mail_from_name( $original_email_from ) {
    return 'ccroipr.org';
}

add_filter( 'wp_mail_content_type', 'shibbir_set_content_type' );
function shibbir_set_content_type() {
    return 'text/html';
}
 
add_filter( 'the_password_form', 'ccroipr_password_form');
function ccroipr_password_form() {
    global $post;
    $label   =  'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $html    =  '';
    $html   .=  '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
    $html   .=  '<p>Please enter your password to access:</p>';
    $html   .=  '<div class="input-group mb-3">';
    $html   .=  '<input type="password" name="post_password" placeholder="Enter password" class="form-control" id="'.$label.'" size="20" maxlength="20">';
    $html   .=  '<div class="input-group-append">';
    $html   .=  '<input type="submit" name="submit" class="btn btn-success" value="Access Now">';
    $html   .=  '</div>';
    $html   .=  '</div>';
    $html   .= '</form>';
    return $html;
}


