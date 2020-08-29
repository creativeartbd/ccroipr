<?php
/**
 * Template part for displaying a ccroipr confirm register p data
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */

$post_id  = get_the_ID();
$post = get_post( $post_id );

if( ! $post ) return;

$post_status   = $post->post_status;
$category      = get_the_category();
$category_name = $category[0]->name;
$data_type     = hashMe( $category_name, 'e' );
$post_meta   	 = get_post_meta( $post_id, 'ccroipr_register_meta', true );

echo '<pre>';
	print_r( $post_meta );
echo '</pre>';
?>

<div class="container main-container">
	<div class="row">
		<div class="col-lg">   
			<?php
			if( 'publish' != $post_status && 'confirmed' != $post_status  ) {
				echo "<div class='alert alert-warning'><strong>Your account is not confirmed or activated. Please contact administrator.</strong></div>";				
			} else {
				?>
	        	<div id="download"></div>
	            <h1>Profile 
	            	<?php 
	            	if( 'confirmed' == $post_status ) { 
	            		$nonce = wp_create_nonce( 'download-nonce' );
	            		echo "<input type='button' value='Download' data-submit-type='$data_type' class='download btn btn-success float-right' id='download_profile' data-id='".hashMe($post_id, 'e')."' data-nonce='$nonce'>"; 
	            	} 
	            	?>
	            </h1>          

	            <p>Antrag auf kostenlose Eintragung und Veroffentlichung eines Urheberanspruchs nach Prioritatsprinzip</p>  
	            <?php if( 'ccroipr-p' == $category_name ) : ?>
	            	<h2>Common Copyright Register of Intellectual Property Rights / CCROIPR-CAT-P</h2>   
	            <?php else : ?>
	            	<h2>Common Copyright Register of Intellectual Property Rights / CCROIPR-CAT-T</h2>
	            <?php endif; ?>

	            <form action="" class="form" method="POST" id="form" enctype="multipart/form-data">
					<div class="row mt-5">					
						<div class="col-md-12">
							<div class="form-group">
	                            <label for="">Urheber - Impressum nach $55 RStV</label>
	                        </div>
						</div>
						<div class="col-md-3">							
							<div class="form-group">
	                            <label for="">Surename</label>
	                            <input type="text" name="surname" value="<?php echo $post_meta['surname']; ?>" maxlength="25" class="form-control" placeholder="Surname">
	                        </div>
							<div class="form-group">
								<label for="">Vorname</label>
	                        	<input type="text" name="vorname" value="<?php echo $post_meta['vorname']; ?>" maxlength="25" class="form-control" placeholder="Vorname">
							</div>
							 <div class="form-group">
	                            <label for="">Straße / Nr</label>
	                            <input type="text" name="strabe_nr" value="<?php echo $post_meta['strabe_nr']; ?>" maxlength="55" class="form-control" placeholder="Straße / Nr">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Plz</label>
	                            <input type="text" name="plz" value="<?php echo $post_meta['plz']; ?>" class="form-control" maxlength="10" placeholder="Plz">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Ort / Stadt</label>
	                            <input type="text" name="ort" value="<?php echo $post_meta['ort']; ?>" class="form-control" maxlength="35" placeholder="Ort / Stadt">
	                        </div>	      
	                        <div class="form-group">
	                            <label for="">E-Post-Address</label>
	                            <input type="text" name="e_post_address" value="<?php echo $post_meta['e_post_address']; ?>" maxlength="50" class="form-control" placeholder="E-Post-Address">
	                        </div>                  
						</div>
						<div class="col-md-3">								
	                        <div class="form-group">
	                            <label for="">Webseite</label>
	                            <input type="text" name="webseite" value="<?php echo $post_meta['webseite']; ?>" maxlength="150" class="form-control" placeholder="Webseite">
	                        </div>
						 	<div class="form-group">
	                            <label for="">Werktitel</label>
	                            <input type="text" name="werktitel" value="<?php echo $post_meta['werktitel']; ?>" id="werktitel" maxlength="30" class="form-control" placeholder="Werktitel">
	                        </div>
	                        <?php if( 'ccroipr-p' == $category_name ) : ?>
	                        <div class="form-group">
	                            <label for="">Wiener Klassifikation</label>
	                            <input type="text" name="wiener" value="<?php echo $post_meta['wiener']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Locarno Klassifikation</label>
	                            <input type="text" name="locarno" value="<?php echo $post_meta['locarno']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Internationale Patentklassifikation</label>
	                            <input type="text" name="internationale" value="<?php echo $post_meta['internationale']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Nizzaklassifikation</label>
	                            <input type="text" name="nizzaklassifikation" value="<?php echo $post_meta['nizzaklassifikation']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <?php endif; ?>					
						</div>
						<div class="col-md-3">
							<?php if( 'ccroipr-p' == $category_name ) : ?>
							<div class="form-group">
								<?php $thumbnail_url = get_the_post_thumbnail_url( $post_id ); ?>		
								<div class="slim" data-download="true" data-instant-edit="true">
									<img src="<?php echo $thumbnail_url; ?>" alt="">	
									<input type="file" name="slim" id="file_change"/>
								</div>								
		                    </div>
							<div class="form-group">
	                            <label for="">SHA256 (Hashwert der Originalabbildung)</label>
	                            <input type="text" id="sha256" name="sha256" value="<?php echo $post_meta['sha256']; ?>" maxlength="64" class="form-control" placeholder="SHA256 (Hashwert der Originalabbildung)" readonly>
	                        </div>
	                    	<?php endif; ?>
	                        <div class="form-group">
	                            <label for="">Werk-Beschreibung</label>
	                            <textarea id="limit" name="werk_beschreibung" cols="30" rows="10" class="form-control" placeholder="Werk-Beschreibung"><?php echo $post_meta['werk_beschreibung']; ?></textarea><span class="counter"></span>
	                        </div>
						</div>
						<?php if( 'ccroipr-p' == $category_name ) : ?>
						<div class="col-md-3">
							<div class="form-group">
	                            <label for="">Keword Nr 1 </label>
	                            <input type="text" name="keywordnr1" value="<?php echo $post_meta['keywordnr1']; ?>" maxlength="40" class="form-control keyword1" placeholder="Keword Nr 1" value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Keword Nr 2 </label>
	                            <input type="text" name="keywordnr2" value="<?php echo $post_meta['keywordnr2']; ?>" maxlength="40" class="form-control keyword2"  placeholder="Keyword Nr 2" value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Keword Nr 3 </label>
	                            <input type="text" name="keywordnr3" value="<?php echo $post_meta['keywordnr3']; ?>" maxlength="40" class="form-control keyword3"  placeholder="Keword Nr 3"  value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Keword Nr 4 </label>
	                            <input type="text" name="keywordnr4" value="<?php echo $post_meta['keywordnr4']; ?>" maxlength="40" class="form-control keyword4"  placeholder="Keword Nr 4"  value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Keword Nr 5 </label>
	                            <input type="text" name="keywordnr5" value="<?php echo $post_meta['keywordnr5']; ?>" maxlength="40" class="form-control keyword5"  placeholder="Keword Nr 5"  value="Stichwort / Schlagwort">
	                        </div>
						</div>	
						<?php endif; ?>				
					</div>				
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
		                        <p>Der Urheber ist vollstandig fur den i nhalt der Darstellung verantworlich und drklart, dass er alle Rechte am beschriebenen Werk besitzt.</p>
		                        <p class="text-danger">Diese Angaben zur Registeranmeldung werden nicht veroffentlicht!</p>
		                    </div>
		                    <div class="checkbox">
		                        <label>
		                        	<input type="checkbox" name="inch_habe_die" <?php if($post_meta['inch_habe_die'] == 1 ) echo 'checked="checked"'; ?> value="1" required >Ich habe die Hinweise heruntergeladen, gelesen undmeine Daten gepruft.
		                        </label>
		                    </div>
		                    <div class="checkbox">
		                        <label>
		                        	<input type="checkbox" name="inh_habe_die_agb" <?php if( $post_meta['inh_habe_die_agb'] == 1 ) echo 'checked="checked"'; ?> value="1" required>Inh habe die AGB heruntergeladen, gelesen und akzeptiert.</label>
		                    </div>
		                    <div class="checkbox">
		                        <label>
		                        	<input type="checkbox" name="ich_habe_die" <?php if( $post_meta['ich_habe_die'] == 1 ) echo 'checked="checked"'; ?> value="1" required>Ich habe die Lizenzvereinbarung nach $30 Markengesetz uber die. Urheber-Kennzeichnug eines Werkes mit der Bezeichnung "CCROIPR" heruntergeladen, gelesen und akzeptiert.</label>
		                    </div>
		                    <div class="form-group">
		                        <p>Bittle geben Sie Ihre E-Mail-Addresse ein (Eintragsbestatigung nach Art.246a $ 1 EGBGB)</p>
		                        <input type="email" class="form-control" value="<?php echo $post_meta['email']; ?>" readonly>
		                    </div>
		                    <div class="form-group">
		                        <label for="">Sie sind Eingeloggt mit der IP-Adresse: USER-IP</label>
		                        <input type="text" name="ip" value="<?php echo $post_meta['user_ip']; ?>" class="form-control" readonly  style=" width: 25%;">
		                    </div>         
		                    <?php if( 'publish' == $post_status ) : ?>   
		                    <div class="confirm-wrapper">
			                    <div class="form-group">		                    	
			                    	<?php wp_nonce_field( 'register_action'); ?>
			                        <input type="submit" name="submit" id="register_btn" data-register-type="<?php echo $data_type; ?>" value="Update Data" class="btn btn-success">
			                        <input type="submit" name="submit" id="confirm_btn" data-nonce="<?php echo wp_create_nonce( 'register_confirm_action' ); ?>" data-register-type="<?php echo $data_type; ?>" value="Confirm Data" class="btn btn-primary float-right">			                        
			                        <input type="hidden" name="post_id" id="post_id" value="<?php echo hashMe( $post_id, 'e' ); ?>">
			                        <input type="hidden" name="submit_type" value="<?php echo hashMe( 'updatedata', 'e' ); ?>">
			                    </div>
			                    <div class="form-group">
			                    	<div class="text text-danger text-right">Note: If you confirm the data then you are not be able to edit/update the data anymore.</div>
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