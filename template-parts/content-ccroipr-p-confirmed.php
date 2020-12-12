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
$thumbnail_id       = $post_meta['cat_d_image'][0];
$thumbnail_url      = wp_get_attachment_image_url( $thumbnail_id, 'full' );

if( 'publish' != $post_status && 'confirmed' != $post_status  ) {
	echo "<div class='alert alert-warning'><strong>Your account is not confirmed or activated. Please contact administrator.</strong></div>";				
} else {
	?>	
	
    <img src="http://ccroipr.org/wp-content/uploads/2020/10/copyrights-zeichen.jpg" alt="<?php echo $post_meta['confirm_id']; ?>" data-submit-type="<?php echo $data_type; ?>" id="download_profile" data-id="<?php echo hashMe( $post_id, 'e' ); ?>" data-nonce="<?php echo $nonce; ?>">		    
    <h2 class="mt-3">Copyrights</h2>   
    
    <table class="table table-bordered">
        <tr>
            <td>Copyrightzeichen <?php echo $post_meta['confirm_id'];  ?></td>
        </tr>        
        <tt>
            <td><b>Werktitel</b></td>
        </tt>
        <tr>
            <td><?php echo $post_meta['werktitel']; ?></td>            
        </tr>
        <tr>
            <td><img src="<?php echo $thumbnail_url; ?>" alt="" class="img-thumbnail"></td>
        </tr>
        <tr>
            <td><?php echo $post_meta['werk_beschreibung']; ?></td>
        </tr>
        <tr>
            <td><b>SHA256 (Hashwert der Originalabbildung)</b></td>
        </tr>
        <tr>
            <td><?php echo $post_meta['sha256']; ?></td>
        </tr>                
    </table>

    <table class="table table-bordered">
        <tr>
            <td colspan="2"><b>Anmelder / Urheber-Impressum nach 55RStV</b></td>
        </tr>
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
