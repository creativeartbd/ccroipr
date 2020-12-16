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
	
	<a href="javascript:void(0);" id="download_profile" data-submit-type="<?php echo $data_type; ?>" class="download" data-id="<?php echo hashMe($post_id, 'e'); ?>" data-nonce="<?php echo $nonce; ?>">
		<img src="http://ccroipr.org/wp-content/uploads/2020/10/copyrights-zeichen.jpg" alt="<?php echo $post_meta['confirm_id']; ?>" >
	</a>

	<div class="confirmed-headline text-center mb-30">
        <h1>Design Copyrights</h1>  	    
        <h2>Copyrightzeichen <?php echo $post_meta['confirm_id']; ?></h2>  
    </div>

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
            <td><img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $post_meta['werktitel']; ?>" title="<?php echo $post_meta['werktitel']; ?>"></td>
        </tr>
        <tr>
            <td><?php echo $post_meta['werk_beschreibung']; ?></td>
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
