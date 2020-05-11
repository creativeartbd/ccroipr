<?php
/**
 * Template part for displaying a ccroipr confirm register p data
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */

$author_id 			= get_the_author_meta( 'ID' );
$author_meta 		= get_user_meta( $author_id, 'register_user_meta_key', true );
$confirm_id         = $author_meta['confirm_id'];
$surname            = $author_meta['surname'];
$vorname            = $author_meta['vorname'];
$strabe_nr          = $author_meta['strabe_nr'];
$plz                = $author_meta['plz'];
$ort                = $author_meta['ort'];
$e_post_address     = $author_meta['e_post_address'];
$kategorie          = $author_meta['kategorie'];
$webseite           = $author_meta['webseite'];
$werktitel          = $author_meta['werktitel'];
$wiener             = $author_meta['wiener'];
$locarno            = $author_meta['locarno'];
$internationale     = $author_meta['internationale'];
$nizzaklassifikation= $author_meta['nizzaklassifikation'];
$sha256             = $author_meta['sha256'];
$werk_beschreibung  = $author_meta['werk_beschreibung'];
$keywordnr1         = $author_meta['keywordnr1']; 
$keywordnr2         = $author_meta['keywordnr2']; 
$keywordnr3         = $author_meta['keywordnr3']; 
$keywordnr4         = $author_meta['keywordnr4']; 
$keywordnr5         = $author_meta['keywordnr5']; 
$inch_habe_die      = $author_meta['inch_habe_die']; 
$inh_habe_die_agb   = $author_meta['inh_habe_die_agb']; 
$ich_habe_die       = $author_meta['ich_habe_die']; 
$ip                 = $author_meta['user_ip']; 
$email              = get_the_author_meta( 'email', $author_id );
?>

<div class="row">
	<div class="col-md-12">
	<h1><?php echo $werktitel; ?></h1>
	<?php 
	if( has_post_thumbnail() ){
		$thumbnail_url = get_the_post_thumbnail_url( '', 'ccroipr');
		echo "<img src='$thumbnail_url' alt='$werktitel' title='$werktitel'>";
		echo '<br/>';
		echo "<span>Copyright Vermerk $confirm_id</span>";
	}
	?>		
	</div>
    <div class="col-sm-12 mt-5 mb-5"><h3>Urheber - Impressum nach $55 RStV</h3></div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>Name</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($surname); ?></p>
    </div>
    <div class="col-sm-2">
        <p><strong>CCROIPR-Kategorie</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($kategorie); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>Vorname</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($vorname); ?></p>
    </div>
    <div class="col-sm-2">
        <p><strong>Wiener Klassifikation</strong></p>
    </div>
    <div class="col-sm-4">
        <p>ccroipr-cfe-<?php echo ($wiener); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>Straße / Nr</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($strabe_nr); ?></p>
    </div>
    <div class="col-sm-2">
        <p><strong>Locarno Klassifikation</strong></p>
    </div>
    <div class="col-sm-4">
        <p>ccroipr-loc-<?php echo ($locarno); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>Plz</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($plz); ?></p>
    </div>
    <div class="col-sm-2">
        <p><strong>Internationale Patentklassifikation</strong></p>
    </div>
    <div class="col-sm-4">
        <p>ccroipr-ipc-<?php echo ($internationale); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>Ort / Stadt</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($ort); ?></p>
    </div>
    <div class="col-sm-2">
        <p><strong>Nizzaklassifikation</strong></p>
    </div>
    <div class="col-sm-4">
        <p>ccroipr-ncl-<?php echo ($nizzaklassifikation); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>E-Post-Address</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($e_post_address); ?></p>
    </div>
    <div class="col-sm-2">
        <p><strong>Webseite</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($webseite); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <p><strong>SHA256 (Hashwert der Originalabbildung)</strong></p>
    </div>
    <div class="col-sm-6">
        <p><?php echo $sha256; ?></p>
    </div>
    <div class="col-sm-6">
         <p><strong>Werktitel</strong></p>
    </div>
    <div class="col-sm-6">
        <p><?php echo ($werktitel); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>Werk-Beschreibung</strong></p>
    </div>
    <div class="col-sm-10">
        <p><?php echo ($werk_beschreibung); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>Keword Nr 1</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($keywordnr1); ?></p>
    </div>
    <div class="col-sm-2">
         <p><strong>Keword Nr 2</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($keywordnr2); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>Keword Nr 3</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($keywordnr3); ?></p>
    </div>
    <div class="col-sm-2">
        <p><strong>Keword Nr 4</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($keywordnr4); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p><strong>Keword Nr 5</strong></p>
    </div>
    <div class="col-sm-4">
        <p><?php echo ($keywordnr5); ?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center copyright">
        <p>Der Urheber ist vollständig für den Inhalt der Darstellung verantworlich und erklärt, dass er alle Rechte am beschriebenen Werk besitzt.</p>
        <p>Public Art & Design Project<br/>© Atelier Kalai 2017</p>
        <p>Kunstverlag Atelier Kalai • Kerstin Winter • Kirchengasse 12 • 91245 Simmelsdorf</p>
        <p>Telefon Ortsvorwahl: 09155 Rufnummer 927 420 eMail: info (at) atelier-kalai (.) de</p>
        <p>Umsatzsteuer-Identifikationsnummer DE 239 876 301</p>
    </div>
</div>