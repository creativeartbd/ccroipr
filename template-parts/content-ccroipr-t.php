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
$post_meta   	= get_post_meta( $post_id, 'ccroipr_register_meta', true );

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
	<h2>Common Copyright Register of Intellectual Property Rights / CCROIPR-CAT-T</h2>	           

	<form action="" class="form" method="POST" id="ccroipr_ru_form" enctype="multipart/form-data">
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
			</div>
			<div class="col-md-3">	
				<div class="form-group">
					<label for="">Ort / Stadt</label>
					<input type="text" name="ort" value="<?php echo $post_meta['ort']; ?>" class="form-control" maxlength="35" placeholder="Ort / Stadt">
				</div>	      
				<div class="form-group">
					<label for="">E-Post-Address</label>
					<input type="text" name="e_post_address" value="<?php echo $post_meta['e_post_address']; ?>" maxlength="50" class="form-control" placeholder="E-Post-Address">
				</div>         							
				<div class="form-group">
					<label for="">Webseite</label>
					<input type="text" name="webseite" value="<?php echo $post_meta['webseite']; ?>" maxlength="150" class="form-control" placeholder="Webseite">
				</div>
				<div class="form-group">
					<label for="">Werktitel</label>
					<input type="text" name="werktitel" value="<?php echo $post_meta['werktitel']; ?>" id="werktitel" maxlength="30" class="form-control" placeholder="Werktitel">
				</div>	                        				
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Werk-Beschreibung</label>
					<textarea id="limit" name="werk_beschreibung" cols="30" rows="10" class="form-control" placeholder="Werk-Beschreibung"><?php echo $post_meta['werk_beschreibung']; ?></textarea><span class="counter"></span>
				</div>
			</div>								
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
					<div id="form_result"></div>
						<?php wp_nonce_field( 'register_action' ); ?>		
						<input type="hidden" name="action" value="register_action">                    	
						<input type="submit" name="submit" value="Update Data" class="btn btn-primary" id="btn">
						<input type="hidden" name="register_type" value="<?php echo hashMe('ccroipr-t', 'e'); ?>">
						<input type="hidden" name="submit_type" value="<?php echo hashMe('update', 'e'); ?>">
						<input type="hidden" name="post_id" value="<?php echo hashMe( get_the_ID(), 'e'); ?>" id="post_id">
						<input type="submit" name="submit" value="Confirm Data" class="btn btn-success float-right" id="confirm_btn" data-nonce="<?php echo wp_create_nonce( 'register_confirm_action' ); ?>" data-register-type="<?php echo $data_type; ?>" >
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
