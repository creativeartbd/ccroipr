<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ccroipr
 */

get_header();
?>
<div class="container main-container">
	<div class="row">
		<div class="col-lg">
			<main id="primary" class="site-main">
				<section class="error-404 not-found">
					<header class="page-header text-center">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ccroipr' ); ?></h1>
					</header><!-- .page-header -->
				</section><!-- .error-404 -->
			</main><!-- #main -->
		</div>		
	</div>
</div>
<?php
get_footer();
