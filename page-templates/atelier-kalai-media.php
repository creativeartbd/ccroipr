<?php
/**
 * Template Name: Atelier Kalai Media
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */
get_header();
?>

<div class="container main-container">
	<div class="row">
		<div class="col-lg-12">					
			<?php 
			if( have_posts() ) {
				while( have_posts() ) {
					the_post();
					the_content();
				}
			}
               ?>	
               
               <?php if( !post_password_required() ) : ?>
			<form action="" class="form" method="POST" id="form" enctype="multipart/form-data">
				<div class="row mt-5">					
					<div class="col-sm-6 col-md-3 col-lg-3">
						<div class="form-group">
                                   <label for=""><?php _e('Urheber - Impressum nach $55 RStV', 'ccroipr'); ?></label>
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Surname', 'ccroipr'); ?></label>
                                   <input type="text" name="surname" class="form-control" placeholder="Surname">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Vorname', 'ccroipr'); ?></label>
                                   <input type="text" name="vorname" maxlength="25" class="form-control" placeholder="Vorname">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Straße / Nr', 'ccroipr'); ?></label>
                                   <input type="text" name="strabe_nr" maxlength="55" class="form-control" placeholder="Straße / Nr">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Plz', 'ccroipr'); ?></label>
                                   <input type="text" name="plz" class="form-control" maxlength="10" placeholder="Plz">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Ort / Stadt', 'ccroipr'); ?></label>
                                   <input type="text" name="ort" class="form-control" maxlength="35" placeholder="Ort / Stadt">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('E-Post-Address', 'ccroipr'); ?></label>
                                   <input type="text" name="e_post_address" maxlength="50" class="form-control" placeholder="E-Post-Address">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Webseite', 'ccroipr'); ?></label>
                                   <input type="text" name="webseite" maxlength="150" class="form-control" placeholder="Webseite">
                              </div>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3">	
					 	<div class="form-group">
                                   <label for=""><?php _e('Werktitel', 'ccroipr'); ?></label>
                                   <input type="text" name="werktitel" id="werktitel" maxlength="30" class="form-control" placeholder="Werktitel">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Wiener Klassifikation', 'ccroipr'); ?></label>
                                   <input type="text" name="wiener" class="form-control" maxlength="50" value="00.00">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Locarno Klassifikation', 'ccroipr'); ?></label>
                                   <input type="text" name="locarno" class="form-control" maxlength="50" value="00.00">
                              </div>
                              <div class="form-group">
                              0    <label for=""><?php _e('Internationale Patentklassifikation', 'ccroipr'); ?></label>
                                   <input type="text" name="internationale" class="form-control" maxlength="50" value="00.00">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Nizzaklassifikation', 'ccroipr'); ?></label>
                                   <input type="text" name="nizzaklassifikation" class="form-control" maxlength="50" value="00.00">
                              </div>					
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3">
						<div class="form-group">
							<input type="file" name="file" id="file">
							<img src="" id="uploaded_img" width="100%" />
	                         </div>
						<div class="form-group">
                                   <label for=""><?php _e('SHA256 (Hashwert der Originalabbildung)', 'ccroipr'); ?></label>
                                   <input type="text" id="sha256" name="sha256" maxlength="64" class="form-control" placeholder="SHA256 (Hashwert der Originalabbildung)" readonly>
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Werk-Beschreibung', 'ccroipr'); ?></label>
                                   <textarea id="limit" name="werk_beschreibung" cols="30" rows="10" class="form-control" placeholder="Werk-Beschreibung"></textarea><span class="counter"></span>
                              </div>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3">
						<div class="form-group">
                                   <label for=""><?php _e('Keword Nr 1', 'ccroipr'); ?> </label>
                                   <input type="text" name="keywordnr1" maxlength="40" class="form-control keyword1" placeholder="Keword Nr 1" value="Stichwort / Schlagwort">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Keword Nr 2', 'ccroipr'); ?></label>
                                   <input type="text" name="keywordnr2" maxlength="40" class="form-control keyword2"  placeholder="Keyword Nr 2" value="Stichwort / Schlagwort">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Keword Nr 3', 'ccroipr'); ?></label>
                                   <input type="text" name="keywordnr3" maxlength="40" class="form-control keyword3"  placeholder="Keword Nr 3"  value="Stichwort / Schlagwort">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Keword Nr 4', 'ccroipr'); ?></label>
                                   <input type="text" name="keywordnr4" maxlength="40" class="form-control keyword4"  placeholder="Keword Nr 4"  value="Stichwort / Schlagwort">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Keword Nr 5 ', 'ccroipr'); ?></label>
                                   <input type="text" name="keywordnr5" maxlength="40" class="form-control keyword5"  placeholder="Keword Nr 5"  value="Stichwort / Schlagwort">
                              </div>
					</div>				
				</div>				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                                   <p><?php _e('Der Urheber ist vollständig fur den Inhalt der Darstellung verantworlich und erklärt, dass er alle Rechte am beschriebenen Werk besitzt.', 'ccroipr'); ?></p>
                                   <p class="text-danger"><?php _e('Diese Angaben zur Registeranmeldung werden nicht veröffentlicht!', 'ccroipr'); ?></p>
                              </div>
                              <div class="checkbox">
                                   <label><input type="checkbox" required name="inch_habe_die" value="1"><?php _e('Ich habe die Hinweise heruntergeladen, gelesen und meine Daten geprüft.', 'ccroipr'); ?></label>
                              </div>
                              <div class="checkbox">
                                   <label><input type="checkbox" required name="inh_habe_die_agb" value="1"><?php _e('Ich habe die AGB heruntergeladen, gelesen und akzeptiert.', 'ccroipr'); ?></label>
                              </div>
                              <div class="checkbox">
                                   <label><input type="checkbox" required name="ich_habe_die" value="1"><?php _e('Ich habe die Lizenzvereinbarung nach §30 Markengesetz über die Urheber-Kennzeichnug eines Werkes mit der Bezeichnung "CCROIPR" heruntergeladen, gelesen und akzeptiert.', 'ccroipr'); ?></label>
                              </div>
                              <div class="form-group">
                                   <p><?php _e('Bittle geben Sie Ihre E-Mail-Addresse ein (Eintragsbestätigung nach Art.246a § 1 EGBGB)', 'ccroipr'); ?></p>
                                   <input type="email" name="email" class="form-control" value="">
                              </div>
                              <div class="form-group">
                                   <label for=""><?php _e('Sie sind Eingeloggt mit der IP-Adresse: USER-IP', 'ccroipr'); ?></label>
                                   <input type="text" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" class="form-control" readonly  style=" width: 25%;">
                              </div>                   
                              <div class="form-group">                      
                                   <div id="form_result"></div>
                                   <?php wp_nonce_field( 'secret_register_action' ); ?>
                                   <input type="submit" name="submit" data-register-type="<?php echo hashMe('secret', 'e'); ?>" id="secret_register_btn" value="Secret Register" class="btn btn-primary">
                              </div>
	                    </div>
				</div>
               </form>			
               <?php endif; ?>
		</div>
	</div>
</div>

<?php 
get_footer();