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
$upload        = wp_upload_dir();
$upload_dir    = $upload['baseurl'];
$upload_dir    = $upload_dir . '/ccroipr-t/';  
$thumbnail_url = $upload_dir . $post_meta['thumb_id_t'].'.jpg';

if( 'publish' != $post_status && 'confirmed' != $post_status  ) {
	echo "<div class='alert alert-warning'><strong>Your account is not confirmed or activated. Please contact administrator.</strong></div>";				
} else {
	?>
	
	<a href="#" id="download_profile" data-submit-type="<?php echo $data_type; ?>" class="download" data-id="<?php echo hashMe($post_id, 'e'); ?>" data-nonce="<?php echo $nonce; ?>">
		<img src="http://ccroipr.org/wp-content/uploads/2020/10/copyrights-zeichen.jpg" alt="<?php echo $post_meta['confirm_id']; ?>" >
	</a>

	<div class="confirmed-headline text-center mb-30">
        <h1><?php _e('Copyrights-Zeichen-Register', 'ccroipr');?></h1>  	    
        <h2><?php echo $post_meta['confirm_id']; ?></h2>          
        <div class="mb-30"></div>
        <h4>Unter  Hinweis  auf</h4>
        <ul>
            <li>* §80  UrhG,  §9  UWG  (Österreich) sowie </li>
            <li>* §5  Abs.3 MarkenG (Deutschland) und</li>
            <li>* Art. 2 Abs. 4 URG (Schweiz) </li>            
        </ul>
        <h4>nehme ich Titelschutz in Anspruch für</h4>
    </div>

    <div class="col-md-12">
        <p><?php echo $post_meta['werk_beschreibung']; ?></p>
        <p><?php _e('in allen Darstellungsformen, Wortkombinationen, Schreibweisen, Abwandlungen, Erzeugnissen und Medien oder sonstigen vergleichbaren Werken und Anwendungen.', 'ccroipr'); ?></p>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td><?php echo $post_meta['surname']; ?></td>
                    </tr>                    
                    <tr>
                        <td>Vorname</td>
                        <td><?php echo $post_meta['vorname']; ?></td>
                    </tr>
                    <tr>
                        <td>Straße / Nr</td>
                        <td><?php echo $post_meta['strabe_nr']; ?></td>
                    </tr>
                    <tr>
                        <td>Plz</td>
                        <td><?php echo $post_meta['plz']; ?></td>
                    </tr>
                    <tr>
                        <td>Ort / Stadt</td>
                        <td><?php echo $post_meta['ort']; ?></td>
                    </tr>
                    <tr>
                        <td>E-Post-Address</td>
                        <td><?php echo $post_meta['e_post_address']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 text-center">
                <?php 
                $sym_upload_dir = wp_upload_dir();                   
                $sym_path       = $sym_upload_dir['url']; 
                ?>
                <h2 class="mb-3"><?php _e('Copyright Symbol', 'ccroipr'); ?></h2>
                <img style="width: 300px;" src="<?php echo $sym_path . '/' . $post_meta['confirm_id'] . '.png'; ?>" alt="<?php _e('Copyright Symbol', 'ccroipr'); ?>" title="<?php _e('Copyright Symbol', 'ccroipr'); ?>">
                <div class="mb-3"></div>    
                </div>
        </div>
    </div>

    <div class="col-md-12 text-center">
        <p><?php _e('Der Urheber ist nach §55 RStV & §6 MDStV vollständig für den Inhalt der Darstellung verantwortlich und erklärt, dass er alle Rechte am beschriebenen Werk besitzt. Mit dem Registereintrag wird ausschließlich das Datum der Anmeldung als Prioritätsnachweis bestätigt. Die Urheberangaben sowie Schutzvoraussetzungen werden bei der Eintragung nicht geprüft und müssen im Streitfall vom zuständigen Gericht bestätigt werden. Ein Widerspruch ist an die Anschrift des Urhebers zu richten.', 'ccroipr'); ?></p>

        <p><?php _e('Ist nach Ablauf der dreimonatigen Widerspruchsfrist (nach §42 MarkenG) kein Widerspruch erhoben worden, wird der Copyright 
        Vermerk zur Langzeitarchivierung  dauerhaft in das Print-Register aufgenommen.', 'ccroipr'); ?></p>
    </div>

<?php } ?>
