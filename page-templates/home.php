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
						<label for='c1'><a href="<?php echo site_url('/title/'); ?>">T</a> <span class="tooltiptext tooltip-left">Tooltip text</span></label>						
					</li>
					<li>
						<input id='c2' type='checkbox'>
						<label for='c2'><a href="<?php echo site_url('/photo/'); ?>">P</a> <span class="tooltiptext">Tooltip text</span></label>
					</li>
					<li>
						<input id='c3' type='checkbox'>
						<label for='c3'><a href="<?php echo site_url('/register/'); ?>">R</a> <span class="tooltiptext">Some kind of info bubble text</span></label>
					</li>
					<li>
						<input id='c4' type='checkbox'>
						<label for='c4'><a href="<?php echo site_url('/info/'); ?>">I</a> <span class="tooltiptext tooltip-left">Tooltip text</span></label>
					</li>
					<li>
						<input id='c5' type='checkbox'>
						<label for='c5'><a href="<?php echo site_url('/design/'); ?>">D</a> <span class="tooltiptext tooltip-left">Tooltip text</span></label>
					</li>				
				</ul>
				<button><img src="<?php echo get_template_directory_uri() . '/assets/img/ccroipr-circle-logo-red.png'; ?>" alt=""></button>
			</div>
		</div>

		<div class="col-md-6 col-md-offset-3 display-none">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="Search">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</div>
			</div>
			<div class="row text-center mt-3">
				<div class="col-sm-4">
					<span>00000</span>
					<p><b><?php _e('Days Online', 'ccroipr'); ?></b></p>
				</div>
				<div class="col-sm-4">
					<span>000001</span>
					<p><b><?php _e('Visitors', 'ccroipr'); ?></b></p>
				</div>
				<div class="col-sm-4">
					<span>00007</span>
					<p><b><?php _e('Uploads', 'ccroipr'); ?></b></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();