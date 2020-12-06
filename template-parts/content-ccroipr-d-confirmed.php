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
$thumbnail_url      = get_the_post_thumbnail_url( $post_id, 'ccroipr' );

print_r( $post_status );

if( 'publish' != $post_status && 'confirmed' != $post_status  ) {
	echo "<div class='alert alert-warning'><strong>Your account is not confirmed or activated. Please contact administrator.</strong></div>";				
} else {
	?>	
	
    <img src="http://ccroipr.org/wp-content/uploads/2020/10/copyrights-zeichen.jpg" alt="<?php echo $post_meta['confirm_id']; ?>" data-submit-type="<?php echo $data_type; ?>" id="download_profile" data-id="<?php echo hashMe( $post_id, 'e' ); ?>" data-nonce="<?php echo $nonce; ?>">		    
    <h2 class="mt-3">Copyrights</h2>   
    
    <div class="row mt-5">					
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Urheber - Impressum nach $55 RStV</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Surename</label>
                        <p><?php echo $post_meta['surname']; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Vorname</label>
                        <p><?php echo $post_meta['vorname']; ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Straße / Nr</label>
                        <p><?php echo $post_meta['strabe_nr']; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Plz</label>
                        <p><?php echo $post_meta['plz']; ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Ort / Stadt</label>
                        <p><?php echo $post_meta['ort']; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">E-Post-Address</label>
                        <p><?php echo $post_meta['e_post_address']; ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Werktitel</label>
                <p><?php echo $post_meta['werktitel']; ?></p>
            </div>
            <div class="form-group">
                <div class="row mb-3">
                    <?php 
                    $thumbnail_url = get_the_post_thumbnail_url( $post_id, 'ccroipr' ); 
                    foreach( $post_meta['cat_d_image'] as $key => $id ) {
                        if( 0 == $key) {
                            $thumb_src = wp_get_attachment_image_src( $id, 'medium' )[0];
                            ?>
                            <div class="col-md-12">
                                <img src="<?php echo $thumb_src; ?>" alt="" class="img-thumbnail"">	
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div> 							
            </div>
            <div class="form-group">
                <label for="">SHA256 (Hashwert der Originalabbildung)</label>
                <p><?php echo $post_meta['sha256']; ?></p>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <div class="row mb-3">
                    <?php 
                    $x = 0;
                    $thumbnail_url = get_the_post_thumbnail_url( $post_id, 'ccroipr' ); 
                    foreach( $post_meta['cat_d_image'] as $key => $id ) {
                        if( 0 !== $key) {
                            if($x!=0 && $x%2==0){  // if not first iteration and iteration divided by 3 has no remainder...
                               echo "</div>\n<div class='row mb-3'>";
                            }
                            $thumb_src = wp_get_attachment_image_src( $id, 'medium' )[0];
                            ?>
                            <div class="col-sm-6">
                                <img src="<?php echo $thumb_src; ?>" alt="" class="img-thumbnail"">
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
                <label for="">Werk-Beschreibung</label>
                <p><?php echo $post_meta['werk_beschreibung']; ?></p>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <p class="accordion">Optionale Bildbeschreibung</p>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">							
            <div class="form-group">
                <label for="">Webseite</label>
                <p><?php echo $post_meta['webseite']; ?></p>
            </div>				                     
            <div class="form-group">
                <label for="">Wiener Klassifikation</label>
                <p><?php echo $post_meta['wiener']; ?></p>
            </div>
            <div class="form-group">
                <label for="">Locarno Klassifikation</label>
                <p><?php echo $post_meta['locarno']; ?></p>
            </div>
            <div class="form-group">
                <label for="">Internationale Patentklassifikation</label>
                <p><?php echo $post_meta['internationale']; ?></p>
            </div>
            <div class="form-group">
                <label for="">Nizzaklassifikation</label>
                <p><?php echo $post_meta['nizzaklassifikation']; ?></p>
            </div>	                        				
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="">Keword Nr 1 </label>
                <p><?php echo $post_meta['keywordnr1']; ?></p>
            </div>
            <div class="form-group">
                <label for="">Keword Nr 2 </label>
                <p><?php echo $post_meta['keywordnr2']; ?></p>
            </div>
            <div class="form-group">
                <label for="">Keword Nr 3 </label>
                <p><?php echo $post_meta['keywordnr3']; ?></p>
            </div>
            <div class="form-group">
                <label for="">Keword Nr 4 </label>
                <p><?php echo $post_meta['keywordnr4']; ?></p>
            </div>
            <div class="form-group">
                <label for="">Keword Nr 5 </label>
                <p><?php echo $post_meta['keywordnr5']; ?></p>
            </div>
        </div>	
    </div>

    <table class="text-center">
        <tr>
            <td>
            Der Urheber ist vollständig für den Inhalt der Darstellung verantwortlich und erklärt, dass er alle Rechte am beschriebenen Werk besitzt.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo get_template_directory_uri() . '/assets/img/ccroipr-circle-logo-red.png' ?>" alt="">
            </td>
        </tr>
    </table>
<?php } ?>
