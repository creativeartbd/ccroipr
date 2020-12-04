<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ccroipr
 */

?>
<div class="container-fluid bg-color footer">
	<div class="container">
		<div class="row p-5">
			<div class="col-md-4 col-sm-4">
				<?php
				if(is_active_sidebar('left-footer')) {
					dynamic_sidebar('left-footer');
				}
				?>
				<!-- <h2 class="">Extern</h2>
				<ul>
					<li><a href="https://www.atelier-kalai.de/index.htm" title="Startseite Kunstverlag Atelier Kalai"><b>Startseite Kunstverlag </b></a> </li>
					<li><a href="https://www.atelier-kalai.de/literaturportal.htm" title="PADP Medien und Literaturportal"><b>Medien &amp; Literaturportal</b></a></li>
					<li><a href="https://www.atelier-kalai.de/infoportal.htm" title="Infoportal"><b>Themen- &amp; Infoportal</b></a></li>
					<li><a href="https://www.atelier-kalai.de/bilderportal.htm" title="PADP Gemlde und Bilderportal"><b>Gemlde &amp; Bilderportal </b></a></li>
					<li><a href="https://www.atelier-kalai.de/softwareportal.htm" title="Softwareportal fr freie Software"><b>Softwareportal</b></a></li>
					<li><a href="https://www.atelier-kalai.de/urheberschutz-portal.htm" title="Copyright Register CCROIPR"><b>Copyright Register</b> </a></li> -->
				</ul>
			</div>	
			<div class="col-md-4 col-sm-4">
				<?php
				if(is_active_sidebar('middle-footer')) {
					dynamic_sidebar('middle-footer');
				}
				?>
				<!-- <img src="<?php echo get_template_directory_uri() . '/assets/img/logo-footer.jpg'; ?>" class="mx-auto d-block"> -->
			</div>
			<div class="col-md-4 col-sm-4">
				<?php
				if(is_active_sidebar('right-footer')) {
					dynamic_sidebar('right-footer');
				}
				?>
				<!-- <h2 class="">Intern</h2>
				<ul>
					<li><a href="https://www.atelier-kalai.de/verlagsportal.htm" title="Verlagsportal"><b>Verlagsprogramm </b></a></li>
					<li><a href="https://www.atelier-kalai.de/ideenreise-papeterie.htm" title="Ideenreise Papeterie"><b>Papeterie Ideenreise </b></a></li>
					<li><a href="https://www.atelier-kalai.de/agb.htm" title="AGB"><b>AGB</b></a></li>
					<li><a href="https://www.atelier-kalai.de/datenschutz.htm" title="Datenschutzerklrung"><b>Datenschutzerklrung</b></a></li>
					<li><a href="https://www.atelier-kalai.de/padp.htm" title="PADP das Public Art &amp; Design Project"><b>Public Art &amp; Design Project</b></a></li>
					<li><a href="https://www.atelier-kalai.de/presseportal.htm" title="Presseportal"><b>Pressemeldungen</b></a></li>
				</ul> -->
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
				if(is_active_sidebar('copyright')) {
					dynamic_sidebar('copyright');
				}
				?>
				<!-- <p class="mb-5">Impressum Kunstverlag Atelier Kalai<br/> Fachverlag fr Rasterzeichnung Vorlagen und Malschablonen<<br/> Kunstverlag Atelier Kalai Kerstin Winter Kirchengasse 12 91245 Simmelsdorf Telefon Ortsvorwahl: 09155 Rufnummer 927 420 eMail: info (at) atelier-kalai (.) de Umsatzsteuer-Identifikationsnummer DE 239 876 301</p>
				<p>Plattform der EU-Kommission zur <a href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home.show&lng=DE">Online-Streitbeilegung</a></p>
				<p>Public Art & Design Project © Atelier Kalai 2018</p> -->
			</div>
		</div>
	</div>
</div> <!-- container div close -->
<?php wp_footer(); ?>
</body>
</html>
