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
<footer>
	<div class="container-fluid footer">
		<div class="container info-card">
			<div class="row">
				<div class="col-md-12">
					<?php
					if(is_active_sidebar('footer-info-card')) {
						dynamic_sidebar('footer-info-card');
					}
					?>
				</div>
			</div>
		</div>
		<div class="container footer-nav">
			<div class="row p-5">
				<div class="col-md-4 col-sm-4">
					<?php
					if(is_active_sidebar('left-footer')) {
						dynamic_sidebar('left-footer');
					}
					?>
				</div>	
				<div class="col-md-4 col-sm-4">
					<?php
					if(is_active_sidebar('middle-footer')) {
						dynamic_sidebar('middle-footer');
					}
					?>
				</div>
				<div class="col-md-4 col-sm-4">
					<?php
					if(is_active_sidebar('right-footer')) {
						dynamic_sidebar('right-footer');
					}
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<?php
					if(is_active_sidebar('bottom-footer')) {
						dynamic_sidebar('bottom-footer');
					}
					?>
				</div>
			</div>
		</div>
	</div> <!-- container div close -->
	<div class="container-fluid footer-bottom">
		<div class="container">
			<?php
			if(is_active_sidebar('copyright')) {
				dynamic_sidebar('copyright');
			}
			?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
