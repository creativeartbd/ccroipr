<?php

/**
 * Template Name: Ccroipr Register
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
			if (have_posts()) {
				while (have_posts()) {
					the_post();
					the_content();
				}
			}
			?>
			<div class="heading text-center">
				<h1><?php _e('Copyrights Sichern <br/> Bildrechte schützen & Prioritätsnachweis erstellen', 'ccroipr'); ?></h1>
				<h2><?php _e('Urheber - Impressum (§55 RStV) für Bildrechte nach §1 URHG', 'ccroipr'); ?></h2>
			</div>			
			
			<form action="" method="POST" enctype="multipart/form-data" id="ccroipr_ru_form">
				<div class="row mt-5">					
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="">Werktitel</label>
							<input type="text" name="werktitel" id="werktitel" maxlength="30" class="form-control" placeholder="Werktitel">
						</div>
						<div class="form-group">
							<div class="slim"  data-instant-edit="false" data-edit="false" data-min-size="300, 300">
								<input type="file" name="slims[]" id="file_change" />
							</div>
						</div>
						<div class="form-group">
							<label for="">SHA256 (Hashwert der Originalabbildung)</label>
							<input type="text" id="sha256" name="sha256" maxlength="64" class="form-control" placeholder="SHA256 (Hashwert der Originalabbildung)" readonly>
						</div>
						<div class="form-group">
							<label for="">Copyright-Text</label>
							<textarea id="limit" name="werk_beschreibung" cols="30" rows="10" class="form-control" placeholder="Werk-Beschreibung"></textarea><span class="counter"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="">Name</label>
							<input type="text" name="surname" class="form-control" placeholder="Surname">
						</div>
						<div class="form-group">
							<label for="">Vorname</label>
							<input type="text" name="vorname" maxlength="25" class="form-control" placeholder="Vorname">
						</div>
						<div class="form-group">
							<label for="">Straße / Nr</label>
							<input type="text" name="strabe_nr" maxlength="55" class="form-control" placeholder="Straße / Nr">
						</div>
						<div class="form-group">
							<label for="">Plz</label>
							<input type="text" name="plz" class="form-control" maxlength="10" placeholder="Plz">
						</div>
						<div class="form-group">
							<label for="">Ort / Stadt</label>
							<input type="text" name="ort" class="form-control" maxlength="35" placeholder="Ort / Stadt">
						</div>
						<div class="form-group">
							<label for="">E-Post-Address</label>
							<input type="text" name="e_post_address" maxlength="50" class="form-control" placeholder="E-Post-Address">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p>Der Urheber ist vollständig fur den Inhalt der Darstellung verantworlich und erklärt, dass er alle Rechte am beschriebenen Werk besitzt.</p>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<h2 class="accordion">Copyright-Register-Details <i class="fa fa-chevron-down" aria-hidden="true"></i></h2>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 panel">
						<div class="form-group">
							<label for="">Webseite</label>
							<input type="text" name="webseite" maxlength="150" class="form-control" placeholder="Webseite">
						</div>
						<div class="form-group">
							<label for="">Wiener Klassifikation</label>
							<input type="text" name="wiener" class="form-control" maxlength="50" value="00.00">
						</div>
						<div class="form-group">
							<label for="">Locarno Klassifikation</label>
							<input type="text" name="locarno" class="form-control" maxlength="50" value="00.00">
						</div>
						<div class="form-group">
							<label for="">Internationale Patentklassifikation</label>
							<input type="text" name="internationale" class="form-control" maxlength="50" value="00.00">
						</div>
						<div class="form-group">
							<label for="">Nizzaklassifikation</label>
							<input type="text" name="nizzaklassifikation" class="form-control" maxlength="50" value="00.00">
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 panel">
						<div class="form-group">
							<label for="">Keword Nr 1 </label>
							<input type="text" name="keywordnr1" maxlength="40" class="form-control keyword1" placeholder="Keword Nr 1" value="Stichwort / Schlagwort">
						</div>
						<div class="form-group">
							<label for="">Keword Nr 2 </label>
							<input type="text" name="keywordnr2" maxlength="40" class="form-control keyword2" placeholder="Keyword Nr 2" value="Stichwort / Schlagwort">
						</div>
						<div class="form-group">
							<label for="">Keword Nr 3 </label>
							<input type="text" name="keywordnr3" maxlength="40" class="form-control keyword3" placeholder="Keword Nr 3" value="Stichwort / Schlagwort">
						</div>
						<div class="form-group">
							<label for="">Keword Nr 4 </label>
							<input type="text" name="keywordnr4" maxlength="40" class="form-control keyword4" placeholder="Keword Nr 4" value="Stichwort / Schlagwort">
						</div>
						<div class="form-group">
							<label for="">Keword Nr 5 </label>
							<input type="text" name="keywordnr5" maxlength="40" class="form-control keyword5" placeholder="Keword Nr 5" value="Stichwort / Schlagwort">
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-12">
						<p class="text-danger">Diese Angaben zur Registeranmeldung werden nicht veröffentlicht! &nbsp;</p>
					</div>
					<div class="col-md-12">
						<div class="checkbox">
							<label><input type="checkbox" required name="inch_habe_die" value="1">Ich habe die Hinweise heruntergeladen, gelesen und meine Daten geprüft.</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" required name="inh_habe_die_agb" value="1">Ich habe die AGB heruntergeladen, gelesen und akzeptiert.</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" required name="ich_habe_die" value="1">Ich habe die Lizenzvereinbarung nach §30 Markengesetz über die Urheber-Kennzeichnug eines Werkes mit der Bezeichnung "CCROIPR" heruntergeladen, gelesen und akzeptiert.</label>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<p>Bittle geben Sie Ihre E-Mail-Addresse ein (Eintragsbestätigung nach Art.246a § 1 EGBGB)</p>
							<input type="email" name="email" class="form-control" value="" placeholder="Email address">
						</div>
						<div class="form-group">
							<label for="">Sie sind Eingeloggt mit der IP-Adresse: USER-IP</label>
							<input type="text" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<div id="form_result"></div>
							<?php wp_nonce_field('register_action'); ?>
							<input type="hidden" name="action" value="register_action">
							<input type="submit" name="submit" value="Register" class="btn btn-primary" id="update_btn">
							<input type="hidden" name="register_type" value="<?php echo hashMe('photo', 'e'); ?>">
							<input type="hidden" name="submit_type" value="<?php echo hashMe('register', 'e'); ?>">
							<p class="help"><?php _e('Ich besitze alle Rechte am beschriebenen Werk und stelle den Antrag auf kostenlose Eintragung und Veröffentlichung 
eines Urheberanspruchs nach dem Prioritätsprinzip.', 'ccroipr'); ?></p>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
get_footer();
