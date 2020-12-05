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
			<h1><?php _e('Common Copyright Register of Intellectual Property Rights', 'ccroipr'); ?></h1>
		</div>

		<div class="col-md-12 text-center" id="timestamp"></div>

		<div class="col-md-12">
			<div class='selector'>
				<ul>
					<li>
						<input id='c1' type='checkbox'>
						<label for='c1'>T <span class="tooltiptext tooltip-left">Tooltip text</span></label>						
					</li>
					<li>
						<input id='c2' type='checkbox'>
						<label for='c2'>P <span class="tooltiptext">Tooltip text</span></label>
					</li>
					<li>
						<input id='c3' type='checkbox'>
						<label for='c3'>R <span class="tooltiptext">Some kind of info bubble text</span></label>
					</li>
					<li>
						<input id='c4' type='checkbox'>
						<label for='c4'>I <span class="tooltiptext tooltip-left">Tooltip text</span></label>
					</li>
					<li>
						<input id='c5' type='checkbox'>
						<label for='c5'>D <span class="tooltiptext tooltip-left">Tooltip text</span></label>
					</li>					
				</ul>
				<button><img src="<?php echo get_template_directory_uri() . '/assets/img/ccroipr-circle-logo-red.png'; ?>" alt=""></button>
			</div>
		</div>

		<div class="col-md-6 offset-md-3">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search..">
				<div class="input-group-append">
					<button class="btn btn-secondary" type="button">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row text-center mt-3">
		<div class="col-md-4">
			<span>00000</span>
			<p><b><?php _e('Days Online', 'ccroipr'); ?></b></p>
		</div>
		<div class="col-md-4">
			<span>000001</span>
			<p><b><?php _e('Visitors', 'ccroipr'); ?></b></p>
		</div>
		<div class="col-md-4">
			<span>00007</span>
			<p><b><?php _e('Uploads', 'ccroipr'); ?></b></p>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 text-center mb-5 mt-5 bg-color p-5">
			<h2 class="text-light"><a href="https://www.atelier-kalai.de/index.htm#Anker-11"><?php _e('Der Kunstverlag Atelier Kalai Ihr Fachverlag für Rasterzeichnung Vorlagen & Zählmuster', 'ccroipr'); ?></a></h2>
		</div>
	</div>
</div>
<?php 
get_footer();