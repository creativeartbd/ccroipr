<?php
/**
 * Template part for displaying a ccroipr confirm register p data
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */

$post_id = get_the_ID();
$post    = get_post( $post_id );

if( ! $post ) return;

$post_status   = $post->post_status;
$category      = get_the_category();
$category_name = $category[0]->name;

$data_type     = hashMe( $category_name, 'e' );
$post_meta     = get_post_meta( $post_id, 'ccroipr_register_meta', true );

if( 'publish' != $post_status && 'confirmed' != $post_status  ) {
	echo "<div class='alert alert-warning'><strong>Your account is not confirmed or activated. Please contact administrator.</strong></div>";				
} else {
	?>	
	   
	<a href="https://ccroipr.org/wp-content/uploads/2020/12/designschutz.pdf" target="_blank">
        <img src="<?php echo get_template_directory_uri() . '/assets/img/copyrightzeichen.jpg'; ?>" alt="copyright-zeichen" title="copyrights-zeichen">	
    </a>

	<div class="heading text-center">
		<h1><?php _e('Copyright-Vermerk prüfen<br/> Angaben korrigieren & Freigabe erteilen', 'ccroipr'); ?></h1>
		<h2><?php _e('Urheber - Impressum (§55 RStV) & Designschutz Offenbarung nach (EG) Nr. 6/2002', 'ccroipr'); ?></h2>
	</div>

	<form action="" class="form" method="POST" id="ccroipr_ru_form" enctype="multipart/form-data">
		<div class="row mt-5">
			<div class="col-sm-6 col-md-6 col-lg-6">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Surename</label>
							<input type="text" name="surname" value="<?php echo $post_meta['surname']; ?>" maxlength="25" class="form-control" placeholder="Surname">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Vorname</label>
							<input type="text" name="vorname" value="<?php echo $post_meta['vorname']; ?>" maxlength="25" class="form-control" placeholder="Vorname">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Straße / Nr</label>
							<input type="text" name="strabe_nr" value="<?php echo $post_meta['strabe_nr']; ?>" maxlength="55" class="form-control" placeholder="Straße / Nr">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Plz</label>
							<input type="text" name="plz" value="<?php echo $post_meta['plz']; ?>" class="form-control" maxlength="10" placeholder="Plz">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Ort / Stadt</label>
							<input type="text" name="ort" value="<?php echo $post_meta['ort']; ?>" class="form-control" maxlength="35" placeholder="Ort / Stadt">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">E-Post-Address</label>
							<input type="text" name="e_post_address" value="<?php echo $post_meta['e_post_address']; ?>" maxlength="50" class="form-control" placeholder="E-Post-Address">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="">Werktitel</label>
					<input type="text" name="werktitel" value="<?php echo $post_meta['werktitel']; ?>" id="werktitel" maxlength="30" class="form-control" placeholder="Werktitel">
				</div>
				<div class="form-group">
                    <div class="row">
						<?php
						foreach( $post_meta['cat_d_image'] as $key => $id ) {
							if( 0 == $key) {
								$thumb_src = wp_get_attachment_image_src( $id, 'full' )[0];
								?>
								<div class="col-md-12">
									<div class="slim" data-instant-edit="false" data-edit="false" data-min-size="300, 300" data-min-size="500, 500">
										<img src="<?php echo $thumb_src; ?>" alt="" class="img-thumbnail"">		
										<input type="file" name="slims[]" id="file_change" value="<?php echo $id; ?>"/>
									</div>
								</div>
								<?php
							}
						}
                        ?>
                    </div> 							
				</div>
				<div class="form-group">
					<label for="">SHA256 (Hashwert der Originalabbildung)</label>
					<input type="text" id="sha256" name="sha256" value="<?php echo $post_meta['sha256']; ?>" maxlength="64" class="form-control" placeholder="SHA256 (Hashwert der Originalabbildung)" readonly>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<div class="row mb-3">
						<?php
						$x = 0;
						foreach( $post_meta['cat_d_image'] as $key => $id ) {
							if( $key > 0 ) {
								if($x!=0 && $x%2==0){  // if not first iteration and iteration divided by 3 has no remainder...
									echo "</div><div class='row mb-3'>";
								}
								$thumb_src = wp_get_attachment_image_src( $id, 'full' )[0];
								?>
								<div class="col-sm-6 full-img">
									<div class="slim" data-instant-edit="false" data-edit="false" data-min-size="300, 300" data-min-size="500, 500">
										<img src="<?php echo $thumb_src; ?>" alt="" class="img-thumbnail"">		
										<input type="file" name="slims[]" value="<?php echo $id; ?>"/>
									</div>
								</div>
								<?php
								++$x;
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for=""><?php _e('Copyright-Text', 'ccroipr'); ?></label>
					<textarea id="limit" name="werk_beschreibung" cols="30" rows="10" class="form-control" placeholder="Werk-Beschreibung"><?php echo $post_meta['werk_beschreibung']; ?></textarea><span class="counter"></span>
				</div>
			</div>
			<div class="col-md-12">
				<p class="text-center"><?php _e('Der Urheber ist vollständig fur den Inhalt der Darstellung verantworlich und erklärt, dass er alle Rechte am beschriebenen Werk besitzt.', 'ccroipr'); ?></p>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<h2 class="accordion"><?php _e('Copyright-Register-Details', 'ccroipr'); ?> <i class="fa fa-chevron-down" aria-hidden="true"></i></h2>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6 panel">							
				<div class="form-group">
					<label for="">Webseite</label>
					<input type="text" name="webseite" value="<?php echo $post_meta['webseite']; ?>" maxlength="150" class="form-control" placeholder="Webseite">
				</div>				                     
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
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6 panel">
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
		</div>

		<div class="row">			
			<?php if( 'confirmed' != $post_status ) : ?>	
			<div class="col-md-12">
				<p class="text-danger">Diese Angaben zur Registeranmeldung werden nicht veröffentlicht! &nbsp;</p>				
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
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<p>Bittle geben Sie Ihre E-Mail-Addresse ein (Eintragsbestatigung nach Art.246a $ 1 EGBGB)</p>
					<input type="email" class="form-control" value="<?php echo $post_meta['email']; ?>" placeholder="Email address" readonly>
				</div>
				<div class="form-group">
					<label for="">Sie sind Eingeloggt mit der IP-Adresse: USER-IP</label>
					<input type="text" name="ip" value="<?php echo $post_meta['user_ip']; ?>" class="form-control" readonly  style=" width: 25%;">
				</div>   
			</div> 				     
			<?php endif; ?>
			<?php if( 'publish' == $post_status ) : ?> 
				<div class="col-md-12">
					<div id="form_result"></div>			
				</div>
				<div class="col-sm-6">
					<?php wp_nonce_field( 'register_action' ); ?>		
					<input type="hidden" name="action" value="register_action">                    	
					<input type="submit" name="submit" value="Update Data" class="btn btn-primary" id="update_btn">
					<input type="hidden" name="register_type" value="<?php echo hashMe('design', 'e'); ?>">
					<input type="hidden" name="submit_type" value="<?php echo hashMe('update', 'e'); ?>">
					<input type="hidden" name="post_id" value="<?php echo hashMe( get_the_ID(), 'e'); ?>" id="post_id">
					<p><?php _e('Ich habe meine Daten korrigiert.', 'ccroipr'); ?></p>					
				</div>
				<div class="col-md-6 text-right">
					<input type="submit" name="submit" value="Delete" class="btn btn-danger" id="delete_btn" data-nonce="<?php echo wp_create_nonce( 'register_delete_action' ); ?>" data-register-type="<?php echo $data_type; ?>" >
					<p><?php _e('Escape Abbruch', 'ccroipr'); ?></p>
				</div>
				<div class="col-sm-12">
					<p class="help color-red"><?php _e('HINWEIS: Nach der Freigabe können die Angaben nicht mehr geändert werden!', 'ccroipr'); ?></p>
					<input type="submit" name="submit" value="Confirm Data" class="btn btn-success float-right" id="confirm_btn" data-nonce="<?php echo wp_create_nonce( 'register_confirm_action' ); ?>" data-register-type="<?php echo $data_type; ?>" >
					<p><?php _e('Ich habe meine Daten kontrolliert und gebe sie zur Veröffentlichung frei.', 'ccroipr'); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</form>
<?php } ?>
