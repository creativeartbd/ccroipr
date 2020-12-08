<?php
/**
 * The template for displaying author pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */

$author 		= get_queried_object();
$author_meta 	= get_user_meta( $author->ID, 'register_user_meta_key', true );
$author_role 	= $author->roles[0];
$thumb_id   	= isset( $author_meta[ 'thumb_id' ] ) ? $author_meta[ 'thumb_id' ] : '';
$thumb_id 		= hashMe( $thumb_id, 'e' );
$data_type      = hashMe( $author_role, 'e' );
$author_status 	= $author->user_status;
$author_id 		= $author->ID;
$author_id 		= hashMe( $author_id, 'e' );
$is_confirm     = isset( $author_meta['is_confirm'] ) ? $author_meta['is_confirm'] : '';
$author_email 	= get_the_author_meta( 'user_email', $author->ID );
$home_page 		= site_url( '/' );

get_header();
?>

<div class="container main-container">
	<div class="row">
		<div class="col-lg-12">   
			<?php 
			if( 0 == $author_status ){
				echo "<div class='alert alert-warning'><strong>Your account is not confirmed or activated. Please contact administrator.</strong></div>";				
			} else {
				?>
	        	<div id="download"></div>
				<h1>Profile 
					<?php 
					if( 1 == $is_confirm) { 
						$nonce = wp_create_nonce( 'download-nonce' );
						echo "<input type='button' value='Download' data-submit-type='$data_type' class='download btn btn-success float-right' id='download_profile' data-id='$author_id' data-nonce='$nonce'>"; 
					} 
					?>
				</h1>          

				<p><?php _e('Antrag auf kostenlose Eintragung und Veroffentlichung eines Urheberanspruchs nach Prioritatsprinzip', 'ccropir'); ?></p>  
				<?php if( 'ccroipr_register_p' == $author_role ) : ?>
					<h2><?php _e('Common Copyright Register of Intellectual Property Rights / CCROIPR-CAT-P', 'ccroipr'); ?></h2>   
				<?php else : ?>
					<h2><?php _e('Common Copyright Register of Intellectual Property Rights / CCROIPR-CAT-T', 'ccroipr'); ?></h2>
				<?php endif; ?>

	            <form action="" class="form" method="POST" id="form" enctype="multipart/form-data">
					<div class="row mt-5">					
						<div class="col-md-12">
							<div class="form-group">
	                            <label for=""><?php _e('Urheber - Impressum nach $55 RStV', 'ccroipr'); ?></label>
	                        </div>
						</div>
						<div class="col-md-3">							
							<div class="form-group">
	                            <label for=""><?php _e('', 'ccroipr'); ?><?php _e('Surename', 'ccroipr'); ?></label>
	                            <input type="text" name="surname" value="<?php echo $author_meta['surname']; ?>" maxlength="25" class="form-control" placeholder="Surname">
	                        </div>
							<div class="form-group">
								<label for=""><?php _e('Vorname', 'ccroipr'); ?></label>
	                        	<input type="text" name="vorname" value="<?php echo $author_meta['vorname']; ?>" maxlength="25" class="form-control" placeholder="Vorname">
							</div>
							 <div class="form-group">
	                            <label for=""><?php _e('Straße / Nr', 'ccroipr'); ?></label>
	                            <input type="text" name="strabe_nr" value="<?php echo $author_meta['strabe_nr']; ?>" maxlength="55" class="form-control" placeholder="Straße / Nr">
	                        </div>
	                        <div class="form-group">
	                            <label for=""><?php _e('Plz', 'ccroipr'); ?></label>
	                            <input type="text" name="plz" value="<?php echo $author_meta['plz']; ?>" class="form-control" maxlength="10" placeholder="Plz">
	                        </div>
	                        <div class="form-group">
	                            <label for=""><?php _e('Ort / Stadt', 'ccroipr'); ?></label>
	                            <input type="text" name="ort" value="<?php echo $author_meta['ort']; ?>" class="form-control" maxlength="35" placeholder="Ort / Stadt">
	                        </div>	      
	                        <div class="form-group">
	                            <label for=""><?php _e('E-Post-Address', 'ccroipr'); ?></label>
	                            <input type="text" name="e_post_address" value="<?php echo $author_meta['e_post_address']; ?>" maxlength="50" class="form-control" placeholder="E-Post-Address">
	                        </div>                  
						</div>
						<div class="col-md-3">								
	                        <div class="form-group">
	                            <label for=""><?php _e('Webseite', 'ccroipr'); ?></label>
	                            <input type="text" name="webseite" value="<?php echo $author_meta['webseite']; ?>" maxlength="150" class="form-control" placeholder="Webseite">
	                        </div>
						 	<div class="form-group">
	                            <label for=""><?php _e('Werktitel', 'ccroipr'); ?></label>
	                            <input type="text" name="werktitel" value="<?php echo $author_meta['werktitel']; ?>" id="werktitel" maxlength="30" class="form-control" placeholder="Werktitel">
	                        </div>
	                        <?php if( 'ccroipr_register_p' == $author_role ) : ?>
	                        <div class="form-group">
	                            <label for=""><?php _e('Wiener Klassifikation', 'ccroipr'); ?></label>
	                            <input type="text" name="wiener" value="<?php echo $author_meta['wiener']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <div class="form-group">
	                            <label for=""><?php _e('Locarno Klassifikation', 'ccroipr'); ?></label>
	                            <input type="text" name="locarno" value="<?php echo $author_meta['locarno']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <div class="form-group">
	                            <label for=""><?php _e('Internationale Patentklassifikation', 'ccroipr'); ?></label>
	                            <input type="text" name="internationale" value="<?php echo $author_meta['internationale']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <div class="form-group">
	                            <label for=""><?php _e('Nizzaklassifikation', 'ccroipr'); ?></label>
	                            <input type="text" name="nizzaklassifikation" value="<?php echo $author_meta['nizzaklassifikation']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <?php endif; ?>					
						</div>
						<div class="col-md-3">
							<?php if( 'ccroipr_register_p' == $author_role ) : ?>
							<div class="form-group">
								<?php 
								$upload                 = wp_upload_dir();							
								$upload_dir             = $upload['baseurl'];
								$image_url 				= $author_meta['thumb_id'];							
								?>		
								<div class="slim" data-download="true" data-instant-edit="true">
									<img src="<?php echo $upload_dir .'/'. $image_url; ?>" alt="">	
									<input type="file" name="slim" id="file_change"/>
								</div>				
		                    </div>
							<div class="form-group">
	                            <label for=""><?php _e('SHA256 (Hashwert der Originalabbildung)', 'ccroipr'); ?></label>
	                            <input type="text" id="sha256" name="sha256" value="<?php echo $author_meta['sha256']; ?>" maxlength="64" class="form-control" placeholder="SHA256 (Hashwert der Originalabbildung)" readonly>
	                        </div>
	                    	<?php endif; ?>
	                        <div class="form-group">
	                            <label for=""><?php _e('Werk-Beschreibung', 'ccroipr'); ?></label>
	                            <textarea id="limit" name="werk_beschreibung" cols="30" rows="10" class="form-control" placeholder="Werk-Beschreibung"><?php echo $author_meta['werk_beschreibung']; ?></textarea><span class="counter"></span>
	                        </div>
						</div>
						<?php if( 'ccroipr_register_p' == $author_role ) : ?>
						<div class="col-md-3">
							<div class="form-group">
	                            <label for=""><?php _e('Keword Nr 1', 'ccroipr'); ?></label>
	                            <input type="text" name="keywordnr1" value="<?php echo $author_meta['keywordnr1']; ?>" maxlength="40" class="form-control keyword1" placeholder="Keword Nr 1" value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for=""><?php _e('Keword Nr 2', 'ccroipr'); ?></label>
	                            <input type="text" name="keywordnr2" value="<?php echo $author_meta['keywordnr2']; ?>" maxlength="40" class="form-control keyword2"  placeholder="Keyword Nr 2" value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for=""><?php _e('Keword Nr 3', 'ccroipr'); ?></label>
	                            <input type="text" name="keywordnr3" value="<?php echo $author_meta['keywordnr3']; ?>" maxlength="40" class="form-control keyword3"  placeholder="Keword Nr 3"  value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for=""><?php _e('Keword Nr 4', 'ccroipr'); ?></label>
	                            <input type="text" name="keywordnr4" value="<?php echo $author_meta['keywordnr4']; ?>" maxlength="40" class="form-control keyword4"  placeholder="Keword Nr 4"  value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for=""><?php _e('Keword Nr 5', 'ccroipr'); ?></label>
	                            <input type="text" name="keywordnr5" value="<?php echo $author_meta['keywordnr5']; ?>" maxlength="40" class="form-control keyword5"  placeholder="Keword Nr 5"  value="Stichwort / Schlagwort">
	                        </div>
						</div>	
						<?php endif; ?>				
					</div>				
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
		                        <p><?php _e('', 'ccroipr'); ?>Der Urheber ist vollstandig fur den i nhalt der Darstellung verantworlich und drklart, dass er alle Rechte am beschriebenen Werk besitzt.</p>
		                        <p class="text-danger"><?php _e('Diese Angaben zur Registeranmeldung werden nicht veroffentlicht!', 'ccroipr'); ?></p>
		                    </div>
		                    <div class="checkbox">
		                        <label>
									<input type="checkbox" name="inch_habe_die" <?php if($author_meta['inch_habe_die'] == 1 ) echo 'checked="checked"'; ?> value="1" required >
									<?php _e('Ich habe die Hinweise heruntergeladen, gelesen undmeine Daten gepruft.', 'ccroipr'); ?>
		                        </label>
		                    </div>
		                    <div class="checkbox">
		                        <label>
									<input type="checkbox" name="inh_habe_die_agb" <?php if( $author_meta['inh_habe_die_agb'] == 1 ) echo 'checked="checked"'; ?> value="1" required>
									<?php _e('Inh habe die AGB heruntergeladen, gelesen und akzeptiert.', 'ccroipr'); ?>
								</label>
		                    </div>
		                    <div class="checkbox">
		                        <label>
									<input type="checkbox" name="ich_habe_die" <?php if( $author_meta['ich_habe_die'] == 1 ) echo 'checked="checked"'; ?> value="1" required>
									<?php _e('Ich habe die Lizenzvereinbarung nach $30 Markengesetz uber die. Urheber-Kennzeichnug eines Werkes mit der Bezeichnung "CCROIPR" heruntergeladen, gelesen und akzeptiert.', 'ccroipr'); ?>
								</label>
		                    </div>
		                    <div class="form-group">
		                        <p><?php _e('Bittle geben Sie Ihre E-Mail-Addresse ein (Eintragsbestatigung nach Art.246a $ 1 EGBGB)', 'ccroipr'); ?></p>
		                        <input type="email" class="form-control" value="<?php echo $author_email; ?>" readonly>
		                    </div>
		                    <div class="form-group">
		                        <label for=""><?php _e('', 'ccroipr'); ?>Sie sind Eingeloggt mit der IP-Adresse: USER-IP</label>
		                        <input type="text" name="ip" value="<?php echo $author_meta['user_ip']; ?>" class="form-control" readonly  style=" width: 25%;">
		                    </div>         
		                    <?php if( 0 == $is_confirm ) : ?>   
		                    <div class="confirm-wrapper">
			                    <div class="form-group">		                    	
			                    	<?php wp_nonce_field( 'register_action'); ?>
			                        <input type="submit" name="submit" id="register_btn" data-register-type="<?php echo $data_type; ?>" value="Update Data" class="btn btn-success">
			                        <input type="submit" name="submit" id="confirm_btn" data-nonce="<?php echo wp_create_nonce( 'register_confirm_action' ); ?>" data-register-type="<?php echo $data_type; ?>" value="Confirm Data" class="btn btn-primary float-right">			                        
			                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $author_id; ?>">
			                        <input type="hidden" name="thumb_id" value="<?php echo $thumb_id; ?>">
			                        <input type="hidden" name="submit_type" value="<?php echo hashMe( 'updatedata', 'e' ); ?>">
			                    </div>
			                    <div class="form-group">
			                    	<div class="text text-danger text-right"><?php _e('ote: If you confirm the data then you are not be able to edit/update the data anymore.', 'ccroipr'); ?>N</div>
			                    </div>
			                </div>       
			                <div id="form_result"></div>
		                	<?php endif; ?>		                	
		                </div>
					</div>
				</form>
			<?php } ?>
		</div>				
	</div>
</div>

<?php
get_footer();
