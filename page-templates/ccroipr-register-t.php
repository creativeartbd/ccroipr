<?php
/**
 * Template Name: Ccroipr Register T
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
            <form action="" class="form" method="POST" id="ccroipr_ru_form">
            	<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Urheber - Impressum nach $55 RStV</label>
                        </div>
                    </div>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="">Surename</label>
                            <input type="text" name="surname" maxlength="25" class="form-control" placeholder="Surname">
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
                    </div>
                    <div class="col-md-3">                         
                        <div class="form-group">
                            <label for="">Ort / Stadt</label>
                            <input type="text" name="ort" class="form-control" maxlength="35" placeholder="Ort / Stadt">
                        </div>
                        <div class="form-group">
                            <label for="">E-Post-Address</label>
                            <input type="text" name="e_post_address" maxlength="50" class="form-control" placeholder="E-Post-Address">
                        </div>      
                         <div class="form-group">
                            <label for="">Webseite</label>
                            <input type="text" name="webseite" maxlength="150" class="form-control" placeholder="Webseite">
                        </div>   
                        <div class="form-group">
                            <label for="">Haupttitel</label>
                            <input type="text" name="werktitel" id="werktitel2" class="form-control" placeholder="Haupttitel">
                        </div>           
                    </div>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="">Untertitel</label>
                            <textarea id="limit" name="werk_beschreibung" cols="30" rows="10" class="form-control" placeholder="Untertitel"></textarea><span class="counter"></span>
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <p>Der Urheber ist vollständig für den inhalt der Darstellung verantworlich und erklärt, dass er alle Rechte am beschriebenen Werk besitzt.</p>                            
                            <p class="text-danger">Diese Angaben zur Registeranmeldung werden nicht veröffentlicht!</p>
                        </div>  
                        <div class="checkbox">
                        	<label><input type="checkbox" name="inch_habe_die" value="1" required >Ich habe die Hinweise heruntergeladen, gelesen undmeine Daten geprüft.</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="inh_habe_die_agb" value="1" required >Inh habe die AGB heruntergeladen, gelesen und akzeptiert.</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="ich_habe_die" value="1" required >Ich habe die Lizenzvereinbarung nach $30 Markengesetz uber die Urheber-Kennzeichnung eines Werkes mit der Bezeichnung "CCROIPR" heruntergeladen, gelesen un.</label>
                        </div>                        
                        <div class="form-group">
                            <p>Bittle geben Sie Ihre E-Mail-Addresse ein (Eintragsbestatigung nach Art.246a $ 1 EGBGB)</p>
                            <input type="email" name="email" class="form-control">                            
                        </div>
                        <div class="form-group">
                            <label for="">Sie sind Eingeloggt mit der IP-Adresse: USER-IP</label>
                            <input type="text" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" class="form-control" readonly  style=" width: 25%;">
                        </div>        
                        <div class="form-group">                      
	                    	<div id="form_result"></div>
	                    	<?php wp_nonce_field( 'register_action' ); ?>		
							<input type="hidden" name="action" value="register_action">                    	
	                        <input type="submit" name="submit" value="Register" class="btn btn-primary" id="btn">
							<input type="hidden" name="register_type" value="<?php echo hashMe('title', 'e'); ?>">
							<input type="hidden" name="submit_type" value="<?php echo hashMe('register', 'e'); ?>">
                        </div>
                    </div>
                </div>
            </form>	            			
		</div>
	</div>
</div>

<?php 
get_footer();