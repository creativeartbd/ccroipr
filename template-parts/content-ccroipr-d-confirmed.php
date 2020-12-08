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


if( 'publish' != $post_status && 'confirmed' != $post_status  ) {
	echo "<div class='alert alert-warning'><strong>Your account is not confirmed or activated. Please contact administrator.</strong></div>";
} else {
	?>	
    
    <a href="javascript:void(0);" data-id="<?php echo hashMe( $post_id, 'e' ); ?>" data-nonce="<?php echo $nonce; ?>" data-submit-type="<?php echo $data_type; ?>" id="download_profile">
        <img src="http://ccroipr.org/wp-content/uploads/2020/10/copyrights-zeichen.jpg" alt="<?php echo $post_meta['confirm_id']; ?>" >	
    </a>

    <div class="text-center mb-30">
        <h1 class="mt-3">Design Copyrights</h1>   
        <h3>Copyrightzeichen <?php echo $post_meta['confirm_id']; ?></h3>
    </div>
    
    <div class="row mt-5">		
        <div class="col-md-12">
            <div class="form-group">
                <h3><?php echo $post_meta['werktitel']; ?></h3>
            </div>
        </div>			
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <div class="row mb-3">
                    <?php 
                    $x = 0;
                    foreach( $post_meta['cat_d_image'] as $key => $id ) {
                        if( 0 == $key) {
                            if($x!=0 && $x%2==0){  // if not first iteration and iteration divided by 3 has no remainder...
                                echo "</div><div class='row mb-3'>";
                            }
                            $thumb_src = wp_get_attachment_image_src( $id, 'medium'  )[0];
                            ?>
                            <div class="col-md-12">
                                <img src="<?php echo $thumb_src; ?>" alt="" class="img-thumbnail" style="width: 100%;">	
                            </div>
                            <?php
                            ++$x;
                        }
                    }
                    ?>
                </div> 							
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <div class="row mb-3">
                    <?php 
                    $x = 0;
                    foreach( $post_meta['cat_d_image'] as $key => $id ) {
                       
                        if($x!=0 && $x%2==0){  // if not first iteration and iteration divided by 3 has no remainder...
                            echo "</div>\n<div class='row mb-3'>";
                        }
                        $thumb_src = wp_get_attachment_image_src( $id, 'medium' )[0];
                        ?>
                        <div class="col-sm-6 full-img">
                            <img src="<?php echo $thumb_src; ?>" alt="" class="img-thumbnail"">
                        </div>
                        <?php
                        
                        ++$x;
                       
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <td colspan="2"><?php echo $post_meta['werk_beschreibung']; ?></td>
                </tr>
                <tr>
                    <td colspan="2">SHA256 (Hashwert der Originalabbildung)</td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo $post_meta['sha256']; ?></td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td colspan="2"><b>Anmelder / Urheber-Impressum nach 55RStV</b></td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
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
    </div>

    <table class="text-center mt-3">
        <tr>
            <td>
                <h4>Der Urheber ist vollständig für den Inhalt der Darstellung verantwortlich und erklärt, dass er alle Rechte am beschriebenen Werk besitzt.</h4>
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
