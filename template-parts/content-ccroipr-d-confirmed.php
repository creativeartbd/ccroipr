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

$post_status        = $post->post_status;
$category           = get_the_category();
$category_name      = $category[0]->name;
$data_type          = hashMe( $category_name, 'e' );
$post_meta   	    = get_post_meta( $post_id, 'ccroipr_register_meta', true );
$nonce              = wp_create_nonce();


if( 'publish' != $post_status && 'confirmed' != $post_status  ) {
	echo "<div class='alert alert-warning'><strong>Your account is not confirmed or activated. Please contact administrator.</strong></div>";
} else {
	?>	
    
    <a href="#" data-id="<?php echo hashMe( $post_id, 'e' ); ?>" data-nonce="<?php echo $nonce; ?>" data-submit-type="<?php echo $data_type; ?>" id="download_profile">
        <img src="<?php echo get_template_directory_uri() . '/assets/img/copyrightzeichen.jpg'; ?>" alt="copyright-zeichen" title="copyrights-zeichen">	
    </a>

    <div class="text-center mb-30">
        <h1 class="mt-3"><?php _e('Copyrights-Zeichen-Register', 'ccroipr'); ?></h1>   
        <h2><?php _e('Copyrightzeichen', 'ccroipr'); ?> <?php echo $post_meta['confirm_id']; ?></h2>
    </div>
    
    <div class="row mt-5">		
        <div class="col-md-12">
            <div class="form-group">
                <h3><?php echo $post_meta['werktitel']; ?></h3>
            </div>
        </div>			
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <div class="row mb-3">
                    <?php 
                    $x = 0;
                    foreach( $post_meta['cat_d_image'] as $key => $id ) {
                            if($x!=0 && $x%3==0){  // if not first iteration and iteration divided by 3 has no remainder...
                                echo "</div>\n<div class='row mb-3'>";
                            }
                            $thumb_src = wp_get_attachment_image_src( $id, 'full' )[0];
                            ?>
                            <div class="col-sm-4 full-img">
                                <img src="<?php echo $thumb_src; ?>" alt="" class="img-thumbnail"">
                            </div>
                            <?php
                            ++$x;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for=""><?php _e('SHA256 (Hashwert der Originalabbildung)', 'ccroipr'); ?></label>
                <p><?php echo $post_meta['sha256']; ?></p>
            </div>
            <div class="form-group">
                <label for=""><?php _e('Copyright-Text', 'ccroipr'); ?></label>
                <p><?php echo $post_meta['werk_beschreibung']; ?></p>
            </div>
            <div class="form-group">
                <h2 class="accordion"><?php _e('Copyright-Register-Details', 'ccroipr'); ?> <i class="fa fa-chevron-down" aria-hidden="true"></i></h2>
            </div>
        </div>
        <div class="col-md-12 panel">	
            <table class="table table-bordered">
                <tr>
                    <td><?php _e('Webseite', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['webseite']; ?></td>
                </tr>
                <tr>
                    <td><?php _e('Wiener Klassifikation', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['wiener']; ?></td>
                </tr>
                <tr>
                    <td><?php _e('Locarno Klassifikation', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['locarno']; ?></td>
                </tr>
                <tr>
                    <td><?php _e('Internationale Patentklassifikation', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['internationale']; ?></td>
                </tr>
                <tr>
                    <td><?php _e('Nizzaklassifikation', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['nizzaklassifikation']; ?></td>
                </tr>
                <tr>
                    <td><?php _e('Keword Nr 1', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['keywordnr1']; ?></td>
                </tr>
                <tr>
                    <td><?php _e('Keword Nr 2', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['keywordnr2']; ?></td>
                </tr>
                <tr>
                    <td><?php _e('Keword Nr 3', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['keywordnr3']; ?></td>
                </tr>
                <tr>
                    <td><?php _e('Keword Nr 4', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['keywordnr4']; ?></td>
                </tr>
                <tr>
                    <td><?php _e('Keword Nr 5', 'ccroipr'); ?></td>
                    <td><?php echo $post_meta['keywordnr5']; ?></td>
                </tr>
            </table>
        </div>	
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <td><?php _e('Urheberimpressum', 'ccroipr'); ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><?php _e('Name', 'ccroipr'); ?></td>
                            <td><?php echo $post_meta['surname']; ?></td>
                        </tr>
                        <tr>
                            <td><?php _e('Vorname', 'ccroipr'); ?></td>
                            <td><?php echo $post_meta['vorname']; ?></td>
                        </tr>
                        <tr>
                            <td><?php _e('Straße / Nr', 'ccroipr'); ?></td>
                            <td><?php echo $post_meta['strabe_nr']; ?></td>
                        </tr>
                        <tr>
                            <td><?php _e('Plz', 'ccroipr'); ?></td>
                            <td><?php echo $post_meta['plz']; ?></td>
                        </tr>
                        <tr>
                            <td><?php _e('Ort / Stadt', 'ccroipr'); ?></td>
                            <td><?php echo $post_meta['ort']; ?></td>
                        </tr>
                        <tr>
                            <td><?php _e('E-Post-Address', 'ccroipr'); ?></td>
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
                    <img src="<?php echo $sym_path . '/' . $post_meta['confirm_id'] . '.png'; ?>" alt="<?php _e('Copyright Symbol', 'ccroipr'); ?>" title="<?php _e('Copyright Symbol', 'ccroipr'); ?>">
                    <div class="mb-3"></div>                   
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <p>Der Urheber ist nach §55 RStV & §6 MDStV vollständig für den Inhalt der Darstellung verantwortlich und erklärt, dass er alle Rechte am beschriebenen Werk besitzt. Mit dem Registereintrag wird ausschließlich das Datum der Anmeldung als Prioritätsnachweis bestätigt. Die Urheberangaben sowie Schutzvoraussetzungen werden bei der Eintragung nicht geprüft und müssen im Streitfall vom zuständigen Gericht bestätigt werden. Ein Widerspruch ist an die Anschrift des Urhebers zu richten.</p>
            <p>Ist nach Ablauf der dreimonatigen Widerspruchsfrist (nach §42 MarkenG) kein Widerspruch erhoben worden, wird der Copyright Vermerk zur Langzeitarchivierung  dauerhaft in das Print-Register aufgenommen.</p>
        </div>
    </div>  
<?php } ?>
