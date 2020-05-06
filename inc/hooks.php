<?php
/**
 * ccroipr all hooks
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ccroipr
 */
add_action( 'wp_ajax_register_update_action', 'register_update_action' );
add_action( 'wp_ajax_nopriv_register_update_action', 'register_update_action' );

function register_update_action() {

    wp_verify_nonce( '_wpnoncne', 'register_update_action' );
    echo '<pre>';
        print_r( $_REQUEST );
        print_r( $_FILES );
    echo '</pre>';
}

add_action( 'wp_ajax_register_slim_file_action', 'register_slim_file_action' );
add_action( 'wp_ajax_nopriv_register_slim_file_action', 'register_slim_file_action' );

function register_slim_file_action() {

	wp_verify_nonce( '_wpnoncne', 'register_slim_file_action' );
	echo hash('sha256', uniqid());	
	wp_die();
}

add_action( 'wp_ajax_register_action', 'register_action' );
add_action( 'wp_ajax_nopriv_register_action', 'register_action' );

function register_action() {

	wp_verify_nonce( '_wpnoncne', 'register_action' );

    //  echo '<pre>';
    //     print_r( $_REQUEST );
    //     print_r( $_FILES );         
    // echo '</pre>';

    // wp_die();

    $submit_type        = isset( $_POST[ 'submit_type' ] ) ? sanitize_text_field( $_POST[ 'submit_type' ] ) : '';
	$surname 			= sanitize_text_field( $_POST[ 'surname' ] );
	$vorname 			= sanitize_text_field( $_POST[ 'vorname' ] );
	$strabe_nr 			= sanitize_text_field( $_POST[ 'strabe_nr' ] );
	$plz 				= sanitize_text_field( $_POST[ 'plz' ] );
	$ort 				= sanitize_text_field( $_POST[ 'ort' ] );
	$e_post_address 	= sanitize_text_field( $_POST[ 'e_post_address' ] );
	$webseite 			= sanitize_text_field( $_POST[ 'webseite' ] );
	$werktitel 			= sanitize_text_field( $_POST[ 'werktitel' ] );
	$wiener 			= sanitize_text_field( $_POST[ 'wiener' ] );
	$locarno 			= sanitize_text_field( $_POST[ 'locarno' ] );
	$internationale 	= sanitize_text_field( $_POST[ 'internationale' ] );
	$nizzaklassifikation= sanitize_text_field( $_POST[ 'nizzaklassifikation' ] );         
	$sha256 			= sanitize_text_field( $_POST[ 'sha256' ] ); 
	$werk_beschreibung 	= sanitize_text_field( $_POST[ 'werk_beschreibung' ] ); 
	$keywordnr1 		= sanitize_text_field( $_POST[ 'keywordnr1' ] ); 
	$keywordnr2 		= sanitize_text_field( $_POST[ 'keywordnr2' ] ); 
	$keywordnr3 		= sanitize_text_field( $_POST[ 'keywordnr3' ] ); 
	$keywordnr4 		= sanitize_text_field( $_POST[ 'keywordnr4' ] ); 
	$keywordnr5 		= sanitize_text_field( $_POST[ 'keywordnr5' ] ); 
	$inch_habe_die 		= sanitize_text_field( $_POST[ 'inch_habe_die' ] ); 
	$inh_habe_die_agb 	= sanitize_text_field( $_POST[ 'inh_habe_die_agb' ] ); 
	$ich_habe_die 		= sanitize_text_field( $_POST[ 'ich_habe_die' ] ); 
    $ip                 = sanitize_text_field( $_POST[ 'ip' ] ); 
	$email 				= sanitize_email( $_POST[ 'email' ] ); 	
	$file 				= isset( $_FILES['file'] ) ? $_FILES['file'] : '';
    $allowed_size       = 10485760;
    $allowed_image      = ['jpg', 'png', 'gif'];

    $filename = $extension = $filesize = '';
    if( $file ) {
        $filename = $file['name'];
        $explode = explode( '.' , $filename );
        $extension = strtolower( end( $explode ) );
        $filesize = $file['size'];
    }
    
    $errors 			= [];

    if( isset( $surname, $vorname, $strabe_nr, $plz, $ort, $e_post_address, $webseite, $werktitel, $wiener, $locarno, $internationale, $nizzaklassifikation, $sha256, $werk_beschreibung, $keywordnr1, $keywordnr2, $keywordnr3, $keywordnr4, $keywordnr5, $inch_habe_die, $inh_habe_die_agb, $ich_habe_die, $email ) ) {
    	
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
    	} elseif( !filter_var( $webseite, FILTER_VALIDATE_URL ) ) {
            $errors[] = 'Invalid webseite is given';
        } elseif( strlen( $webseite ) > 150 || strlen( $webseite ) < 2  ) {
    		$errors[] = 'Your webseite must be between 2-150 characters long';
    	}

    	if( empty( $werktitel ) ) {
    		$errors[] = 'Your werktitel is required';
    	} elseif( strlen( $werktitel ) > 30 || strlen( $werktitel ) < 2  ) {
    		$errors[] = 'Your werktitel must be between 2-30 characters long';
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

        if( 'updatedata' == $submit_type ) {
            if( !empty( $filename ) ) {
                if( !in_array( $extension, $allowed_image ) ) {
                    $errors[] = 'Only jpg, png and gif images are allowed';
                } elseif( $filesize > $allowed_size ) {
                    $errors[] = 'Maximum 10 MB image are allowd'; 
                }    
            }            
        } else {
            if( empty( $filename ) ) {
                $errors[] = 'Please upload image';
            } elseif( !in_array( $extension, $allowed_image ) ) {
                $errors[] = 'Only jpg, png and gif images are allowed';
            } elseif( $filesize > $allowed_size ) {
                $errors[] = 'Maximum 10 MB image are allowd'; 
            }    
        }        

    	if( empty( $sha256 ) ) {
    		$errors[] = 'SHA256 (Hashwert der Originalabbildung) is required, please upload the image again';
    	} elseif( strlen( $sha256 ) > 64 || strlen( $sha256 ) < 64  ) {
    		$errors[] = 'Invalid SHA256 (Hashwert der Originalabbildung) is given';
    	}

    	if( empty( $werk_beschreibung ) ) {
    		$errors[] = 'werk beschreibung is required';
    	} elseif( strlen( $werk_beschreibung ) > 1000 || strlen( $werk_beschreibung ) < 2  ) {
    		$errors[] = 'werk beschreibung must be 2-1000 characters long';
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

    	if( empty( $inch_habe_die ) ) {
    		$errors[] = 'inch habe die is required';
    	}

    	if( empty( $inh_habe_die_agb ) ) {
    		$errors[] = 'inh habe die agb is required';
    	}

    	if( empty( $ich_habe_die ) ) {
    		$errors[] = 'ich habe die is required';
    	}

        if( ! $submit_type ) {
            if( empty( $email ) ) {
                $errors[] = 'E-mail address is required';
            } elseif( !is_email( $email )  ) {
                $errors[] = 'Invalid E-mail address';
            } elseif( email_exists( $email ) ) {
                $errors[] = 'E-mail address is already exist, Please choose another';
            } 
        }    	

    	//echo '<pre>';
	    	// print_r( $_FILES );
	    	// print_r( $_REQUEST );
    		//print_r( $data );
            //$attachment_id = media_handle_upload( 'file', 0 );
    	//echo '</pre>';
        //print_r( $attachment_id );
    }

    if( !empty( $errors ) ) {
    	echo '<div class="alert alert-danger">';
    	foreach ( $errors as $error ) {
    		echo $error;
    		echo '<br/>';
    	}
    	echo '</div>';
    } else {

        // Form value as meta key and value
        $userdata = array(            
            'user_pass'             => '',   
            'user_login'            => $surname,
            'user_nicename'         => $vorname, 
            'user_url'              => '',   
            'user_email'            => $email,  
            'display_name'          => $vorname,
            'nickname'              => $vorname,
            'first_name'            => $vorname,
            'last_name'             => '', 
            'description'           => '', 
            'show_admin_bar_front'  => false,
            'role'                  => 'ccroipr_register_p',   //(string) User's role.
            'locale'                => '',   //(string) User's locale. Default empty.     
        );

        $meta_array = [
            'surname' => $surname,
            'vorname' => $vorname,
            'strabe_nr' => $strabe_nr, 
            'plz' => $plz, 
            'ort' => $ort,
            'e_post_address' => $e_post_address,
            'webseite' => $webseite,
            'werktitel' => $werktitel,
            'wiener' => $wiener, 
            'locarno' => $locarno, 
            'internationale' => $internationale, 
            'nizzaklassifikation' => $nizzaklassifikation, 
            'sha256' => $sha256, 
            'werk_beschreibung' => $werk_beschreibung, 
            'keywordnr1' => $keywordnr1, 
            'keywordnr2' => $keywordnr2, 
            'keywordnr3' => $keywordnr3, 
            'keywordnr4' => $keywordnr4, 
            'keywordnr5' => $keywordnr5, 
            'inch_habe_die' => $inch_habe_die, 
            'inh_habe_die_agb' => $inh_habe_die_agb, 
            'ich_habe_die' => $ich_habe_die,
            'user_ip' => $ip,
            'is_confirm' => 0,            
        ];

        // Update data only
        if( 'updatedata' == $submit_type ) {

            $user_id        = hashMe( sanitize_text_field( $_POST['user_id'] ), 'd' );
            $thumb_id       = hashMe( sanitize_text_field( $_POST['thumb_id'] ), 'd' );
            $is_user_exist  = get_userdata( $user_id );

            if( $is_user_exist ) {

                if( $filename ) {
                    $attachment_id = media_handle_upload( 'file', 0 );
                   //if ( !is_wp_error( $attachment_id ) ) {
                        $meta_array['thumb_id'] =  $attachment_id;   
                        wp_delete_attachment( $thumb_id );    
                    //}                    
                } else {
                    $meta_array['thumb_id'] = $thumb_id; 
                }
                update_user_meta( $user_id, 'register_user_meta_key', $meta_array );
                echo '<div class="alert alert-success">Successfully updated the data..</div>';    
                ?>
                <script type="text/javascript">
                    setTimeout(function(){// wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 3000);
                </script>
                <?php
            }            

        } else {

            $user_id = wp_insert_user( $userdata ) ;

            if ( ! is_wp_error( $user_id ) ) {
                if ( !is_wp_error( $attachment_id ) ) {
                    $meta_array['thumb_id'] =  $attachment_id;  
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
                        ), get_permalink( 44 )
                    );  

                    echo '<div class="alert alert-success">Please confirm your email addresss for CCROIPR-Registration von Werktitel.</div>';

                    // Send email to user for activate the account 
                    $message = "<div style='padding : 20px; border : 1px solid #ddd; color : #000;'>Hello $surname, <br/><br/>Please confirm your email addresss for CCROIPR-Registration von $werktitel. Click this link to confirm : <a href='$activation_link'>Confirm Now</a><br/><br/>http://ccroipr.org<br/>Thank You.<br/></div>";

                    $to         = $email;
                    $subject    = 'Confirm your registration process"';
                    $body       = $message;
                    $headers    = array('Content-Type: text/html; charset=UTF-8');

                    wp_mail( $to, $subject, $body, $headers );

                }
            }
        }


        
        

        
    

        // $attachment_id = media_handle_upload( 'file', 0 );

        // if ( is_wp_error( $attachment_id ) ) { 
        //     $response['response']   = "ERROR";
        //     $response['error']      = $fileErrors[ $_FILES['file']['error'] ];
        // } else {
        //     $fullsize_path          = get_attached_file( $attachment_id );
        //     $pathinfo               = pathinfo( $fullsize_path );
        //     $url                    = wp_get_attachment_url( $attachment_id );
        //     $response['response']   = "SUCCESS";
        //     $response['filename']   = $pathinfo['filename'];
        //     $response['url']        = $url;
        //     $type                   = $pathinfo['extension'];

        //     if( $type == "jpeg" || $type == "jpg" || $type == "png" || $type == "gif" ) {
        //         $type = "image/" . $type;
        //     }
        //     $response['type'] = $type;
        // }
        // echo '<pre>';
        // print_r( $response );

        // $imgName      = 'myimagename.jpg';
        // $confirmCode  = rand(1000, 9999);
        // $ex           = explode( '.', $imgName );

        // $ex1          = strtolower(end($ex));
        // $werktitel_R  = htmlspecialchars($werktitel);
        // $newFileName  = str_replace(' ', '-', strtolower($werktitel_R)).'-'.rand(5).".$ex1";
        // $userId         = 1254;

        //  $message = "<div style='padding : 20px; border : 1px solid #ddd; color : #000;'>Hello $surname, <br/><br/>Please confirm your email addresss for CCROIPR-Registration von $werktitel. Click this to confirm : <a href='http://ccroipr.org/confirmation.php?code=$confirmCode&id=$userId'>Confirm Now</a><br/><br/>http://ccroipr.org<br/>Thank You.<br/></div>";

        // $to = get_option( 'admin_email' );
        // $subject = 'The subject';
        // $body = $message;
        // $headers = array('Content-Type: text/html; charset=UTF-8');

        // wp_mail( $to, $subject, $body, $headers );
    }

    wp_die();
    
}

// Add new role
function ccroipr_new_custom_roles() {
    //if ( get_option( 'custom_roles_version' ) < 1 ) {
        add_role( 'ccroipr_register_p', 'Reigster P', array( 'read' => true, 'level_0' => true ) );
        add_role( 'ccroipr_register_t', 'Reigster T', array( 'read' => true, 'level_0' => true ) );
        
    //}
}
add_action( 'init', 'ccroipr_new_custom_roles' );

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
 function wpb_sender_email( $original_email_address ) {
    return get_option( 'admin_email');
}
 
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return get_bloginfo( 'name' );
}
 
// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

