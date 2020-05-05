<?php
/**
 * The template for displaying author pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */

$author = get_queried_object();
$author_meta = get_user_meta( $author->ID, 'register_user_meta_key', true );
$author_status = $author->user_status;

if( 0 == $author_status ){
	wp_redirect( site_url( '/' ) );
	exit();
}
get_header();
?>

<div class="container main-container">
	<div class="row">
		<div class="col-lg">
			<main id="primary" class="site-main">
				<div class="row">
					<div class="col-md-12">
                        <div class="section-title">
                            <h1>Profile                                
                            </h1>                           
                            <p>Antrag auf kostenlose Eintragung und Veroffentlichung eines Urheberanspruchs nach Prioritatsprinzip</p>  
                            <h2>Common Copyright Register of Intellectual Property Rights / CCROIPR-CAT-P</h2>
                        </div>
                    </div>
                </div>
                <form action="" class="form" method="POST" id="register" enctype="multipart/form-data">
					<div class="row mt-5">					
						<div class="col-md-3">
							<div class="form-group">
	                            <label for="">Urheber - Impressum nach $55 RStV</label>
	                        </div>
							<div class="form-group">
								<label for="">Surname</label>
								<input type="text" name="surname" value="<?php echo $author_meta['surname']; ?>" class="form-control" placeholder="Surname">
							</div>
							<div class="form-group">
								<label for="">Vorname</label>
	                        	<input type="text" name="vorname" value="<?php echo $author_meta['vorname']; ?>" maxlength="25" class="form-control" placeholder="Vorname">
							</div>
							 <div class="form-group">
	                            <label for="">Straße / Nr</label>
	                            <input type="text" name="strabe_nr" value="<?php echo $author_meta['strabe_nr']; ?>" maxlength="55" class="form-control" placeholder="Straße / Nr">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Plz</label>
	                            <input type="text" name="plz" value="<?php echo $author_meta['plz']; ?>" class="form-control" maxlength="10" placeholder="Plz">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Ort / Stadt</label>
	                            <input type="text" name="ort" value="<?php echo $author_meta['ort']; ?>" class="form-control" maxlength="35" placeholder="Ort / Stadt">
	                        </div>
	                        <div class="form-group">
	                            <label for="">E-Post-Address</label>
	                            <input type="text" name="e_post_address" value="<?php echo $author_meta['e_post_address']; ?>" maxlength="50" class="form-control" placeholder="E-Post-Address">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Webseite</label>
	                            <input type="text" name="webseite" value="<?php echo $author_meta['webseite']; ?>" maxlength="150" class="form-control" placeholder="Webseite">
	                        </div>
						</div>
						<div class="col-md-3">	
						 	<div class="form-group">
	                            <label for="">Werktitel</label>
	                            <input type="text" name="werktitel" value="<?php echo $author_meta['werktitel']; ?>" id="werktitel" maxlength="30" class="form-control" placeholder="Werktitel">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Wiener Klassifikation</label>
	                            <input type="text" name="wiener" value="<?php echo $author_meta['wiener']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Locarno Klassifikation</label>
	                            <input type="text" name="locarno" value="<?php echo $author_meta['locarno']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Internationale Patentklassifikation</label>
	                            <input type="text" name="internationale" value="<?php echo $author_meta['internationale']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Nizzaklassifikation</label>
	                            <input type="text" name="nizzaklassifikation" value="<?php echo $author_meta['nizzaklassifikation']; ?>" class="form-control" maxlength="50" value="00.00">
	                        </div>					
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="file" name="file" id="file">
								<?php 
								$thumb = wp_get_attachment_image_src( $author_meta['thumb_id'], 'full' ); 
								if( $thumb ) {
									$thumb_src = $thumb[0];
									echo "<img id='uploaded_img' src='$thumb_src'>";	
								}
								?>								
		                    </div>
							<div class="form-group">
	                            <label for="">SHA256 (Hashwert der Originalabbildung)</label>
	                            <input type="text" id="sha256" name="sha256" value="<?php echo $author_meta['sha256']; ?>" maxlength="64" class="form-control" placeholder="SHA256 (Hashwert der Originalabbildung)" readonly>
	                        </div>
	                        <div class="form-group">
	                            <label for="">Werk-Beschreibung</label>
	                            <textarea id="limit" name="werk_beschreibung" cols="30" rows="10" class="form-control" placeholder="Werk-Beschreibung"><?php echo $author_meta['werk_beschreibung']; ?></textarea><span class="counter"></span>
	                        </div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
	                            <label for="">Keword Nr 1 </label>
	                            <input type="text" name="keywordnr1" value="<?php echo $author_meta['keywordnr1']; ?>" maxlength="40" class="form-control keyword1" placeholder="Keword Nr 1" value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Keword Nr 2 </label>
	                            <input type="text" name="keywordnr2" value="<?php echo $author_meta['keywordnr2']; ?>" maxlength="40" class="form-control keyword2"  placeholder="Keyword Nr 2" value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Keword Nr 3 </label>
	                            <input type="text" name="keywordnr3" value="<?php echo $author_meta['keywordnr3']; ?>" maxlength="40" class="form-control keyword3"  placeholder="Keword Nr 3"  value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Keword Nr 4 </label>
	                            <input type="text" name="keywordnr4" value="<?php echo $author_meta['keywordnr4']; ?>" maxlength="40" class="form-control keyword4"  placeholder="Keword Nr 4"  value="Stichwort / Schlagwort">
	                        </div>
	                        <div class="form-group">
	                            <label for="">Keword Nr 5 </label>
	                            <input type="text" name="keywordnr5" value="<?php echo $author_meta['keywordnr5']; ?>" maxlength="40" class="form-control keyword5"  placeholder="Keword Nr 5"  value="Stichwort / Schlagwort">
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
		                        	<input type="checkbox" name="inch_habe_die" <?php if($author_meta['inch_habe_die'] == 1 ) echo 'checked="checked"'; ?> value="1" required >Ich habe die Hinweise heruntergeladen, gelesen undmeine Daten gepruft.
		                        </label>
		                    </div>
		                    <div class="checkbox">
		                        <label>
		                        	<input type="checkbox" name="inh_habe_die_agb" <?php if( $author_meta['inh_habe_die_agb'] == 1 ) echo 'checked="checked"'; ?> value="1" required>Inh habe die AGB heruntergeladen, gelesen und akzeptiert.</label>
		                    </div>
		                    <div class="checkbox">
		                        <label>
		                        	<input type="checkbox" name="ich_habe_die" <?php if( $author_meta['ich_habe_die'] == 1 ) echo 'checked="checked"'; ?> value="1" required>Ich habe die Lizenzvereinbarung nach $30 Markengesetz uber die. Urheber-Kennzeichnug eines Werkes mit der Bezeichnung "CCROIPR" heruntergeladen, gelesen und akzeptiert.</label>
		                    </div>
		                    <div class="form-group">
		                        <p>Bittle geben Sie Ihre E-Mail-Addresse ein (Eintragsbestatigung nach Art.246a $ 1 EGBGB)</p>
		                        <input type="email" name="email" class="form-control" value="">
		                    </div>
		                    <div class="form-group">
		                        <label for="">Sie sind Eingeloggt mit der IP-Adresse: USER-IP</label>
		                        <input type="text" name="ip" value="<?php echo $author_meta['user_ip']; ?>" class="form-control" readonly  style=" width: 25%;">
		                    </div>                   
		                    <div class="form-group">                      
		                    	 <div id="form_result"></div>
		                    	 <?php wp_nonce_field( 'register_action' ); ?>
		                        <input type="submit" name="submit" id="registerButton" value="REGISTERBUTTON" class="btn btn-primary">
		                    </div>
		                </div>
					</div>
				</form>				
			</main><!-- #main -->
		</div>				
	</div>
</div>

<?php
get_footer();
