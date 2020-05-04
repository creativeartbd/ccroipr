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

function register_action() {

	wp_verify_nonce( '_wpnoncne', 'register_action' );

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
	$email 				= sanitize_email( $_POST[ 'email' ] ); 
	$slim 				= sanitize_text_field( $_POST[ 'slim' ] ); 
    
    $errors 			= [];

    if( isset( $surname, $vorname, $strabe_nr, $plz, $ort, $e_post_address, $webseite, $werktitel, $wiener, $locarno, $internationale, $nizzaklassifikation, $sha256, $werk_beschreibung, $keywordnr1, $keywordnr2, $keywordnr3, $keywordnr4, $keywordnr5, $inch_habe_die, $inh_habe_die_agb, $ich_habe_die, $email, $slim ) ) {
    	
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

    	if( empty( $sha256 ) ) {
    		$errors[] = 'SHA256 (Hashwert der Originalabbildung) is required';
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
    	
    	if( empty( $email ) ) {
    		$errors[] = 'E-mail address is required';
    	} elseif( is_email( $email )  ) {
    		$errors[] = 'Invalid E-mail address';
    	} elseif( email_exists( $email ) ) {
    		$errors[] = 'E-mail address is already exist, Please choose another';
    	}   	

    	if( empty( $slim ) ) {
    		$errors[] = 'Please upload hochladen';
    	} 
    	
    }

    if( !empty( $errors ) ) {
    	echo '<div class="alert alert-danger">';
    	foreach ( $errors as $error ) {
    		echo $error;
    		echo '<br/>';
    	}
    	echo '</div>';
    }
     
	// echo '<pre>';
	// print_r( $_REQUEST );
	// echo '</pre>';

	wp_die();
    
}