<?php
/**
 * Template Name: Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ccroipr
 */
get_header();
?>

<div class="container main-container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1>Common Copyright Register <br/> of <br/> Intellectual Property Rights</h1>
		</div>

		<div class="col-md-12">
			<div class='selector'>
				<ul>
					<li>
					<input id='c1' type='checkbox'>
					<label for='c1'>Menu 1</label>
					</li>
					<li>
					<input id='c2' type='checkbox'>
					<label for='c2'>Menu 2</label>
					</li>
					<li>
					<input id='c3' type='checkbox'>
					<label for='c3'>Menu 3</label>
					</li>
					<li>
					<input id='c4' type='checkbox'>
					<label for='c4'>Menu 4</label>
					</li>
					<li>
					<input id='c5' type='checkbox'>
					<label for='c5'>Menu 5</label>
					</li>
					<li>
					<input id='c6' type='checkbox'>
					<label for='c6'>Menu 6</label>
					</li>
					<li>
					<input id='c7' type='checkbox'>
					<label for='c7'>Menu 7</label>
					</li>
					<li>
					<input id='c8' type='checkbox'>
					<label for='c8'>Menu 8</label>
					</li>
				</ul>
				<button><img src="<?php echo get_template_directory_uri() . '/assets/img/ccroipr-circle-logo-red.png'; ?>" alt=""></button>
			</div>
		</div>

		<div class="col-md-6 offset-md-3">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search this blog">
				<div class="input-group-append">
				<button class="btn btn-secondary" type="button">
					<i class="fa fa-search"></i>
				</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row text-center">
		<div class="col-md-4">Register Time</div>
		<div class="col-md-8">2020-04-11 17:16:22</div>
	</div>
	
	<div class="row text-center">
		<div class="col-md-4">
			<span>00000</span>
			<p>Days Online</p>
		</div>
		<div class="col-md-4">
			<span>000001</span>
			<p>Visitors</p>
		</div>
		<div class="col-md-4">
			<span>00007</span>
			<p>Uploads</p>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 text-center mb-5 mt-5 bg-color p-5">
			<h2 class="text-light"><a href="https://www.atelier-kalai.de/index.htm#Anker-11">Der Kunstverlag Atelier Kalai Ihr Fachverlag für Rasterzeichnung Vorlagen & Zählmuster</a></h2>
		</div>
	</div>

	<div class="row bg-color p-5">
		<div class="col-md-4">
			<h2 class="">Extern</h2>
			<ul>
				<li><a href="https://www.atelier-kalai.de/index.htm" title="Startseite Kunstverlag Atelier Kalai"><b>Startseite Kunstverlag </b></a> </li>
				<li><a href="https://www.atelier-kalai.de/literaturportal.htm" title="PADP Medien und Literaturportal"><b>Medien &amp; Literaturportal</b></a></li>
				<li><a href="https://www.atelier-kalai.de/infoportal.htm" title="Infoportal"><b>Themen- &amp; Infoportal</b></a></li>
				<li><a href="https://www.atelier-kalai.de/bilderportal.htm" title="PADP Gemlde und Bilderportal"><b>Gemlde &amp; Bilderportal </b></a></li>
				<li><a href="https://www.atelier-kalai.de/softwareportal.htm" title="Softwareportal fr freie Software"><b>Softwareportal</b></a></li>
				<li><a href="https://www.atelier-kalai.de/urheberschutz-portal.htm" title="Copyright Register CCROIPR"><b>Copyright Register</b> </a></li>
			</ul>
		</div>	
		<div class="col-md-4">
			<img src="<?php echo get_template_directory_uri() . '/assets/img/logo-footer.jpg'; ?>" class="mx-auto d-block">
		</div>
		<div class="col-md-4">
			<h2 class="">Intern</h2>
			<ul>
				<li><a href="https://www.atelier-kalai.de/verlagsportal.htm" title="Verlagsportal"><b>Verlagsprogramm </b></a></li>
				<li><a href="https://www.atelier-kalai.de/ideenreise-papeterie.htm" title="Ideenreise Papeterie"><b>Papeterie Ideenreise </b></a></li>
				<li><a href="https://www.atelier-kalai.de/agb.htm" title="AGB"><b>AGB</b></a></li>
				<li><a href="https://www.atelier-kalai.de/datenschutz.htm" title="Datenschutzerklrung"><b>Datenschutzerklrung</b></a></li>
				<li><a href="https://www.atelier-kalai.de/padp.htm" title="PADP das Public Art &amp; Design Project"><b>Public Art &amp; Design Project</b></a></li>
				<li><a href="https://www.atelier-kalai.de/presseportal.htm" title="Presseportal"><b>Pressemeldungen</b></a></li>
			</ul>
		</div>
		<div class="col-md-8 offset-md-2 mt-5 text-center">
			<p class="mb-5">Impressum Kunstverlag Atelier Kalai<br/> Fachverlag fr Rasterzeichnung Vorlagen und Malschablonen<<br/> Kunstverlag Atelier Kalai Kerstin Winter Kirchengasse 12 91245 Simmelsdorf Telefon Ortsvorwahl: 09155 Rufnummer 927 420 eMail: info (at) atelier-kalai (.) de Umsatzsteuer-Identifikationsnummer DE 239 876 301</p>
			<p>Plattform der EU-Kommission zur <a href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home.show&lng=DE">Online-Streitbeilegung</a></p>
			<p>Public Art & Design Project © Atelier Kalai 2018</p>
		</div>
	</div>
</div> <!-- container div close -->

<?php 
get_footer();