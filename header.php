<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ccroipr
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<meta name="description" content="Free registration and publication of a copyright claim according to the priority principle - a free service from ATELIER.KALAI.MEDIA">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ccroipr' ); ?></a>

	<header id="masthead" class="site-header">	
		<div class="container">
			<div class="row bg-white">
				<div class="col-md-12">	
					<a href="<?php echo site_url('/'); ?>">			
						<img src="<?php echo get_template_directory_uri() . '/assets/img/logoline-padp-ccroipr.jpg'; ?>" alt="">
					</a>
				</div>	
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
  				<?php
				wp_nav_menu(
					array(
						'container_class' => 'collapse navbar-collapse header-menu',
						'container_id'    => 'cssmenu',
						'depth'           => 10,
						'theme_location'  => 'menu-1',
						'menu_id'         => 'primary-menu',
						'menu_class'	     => 'navbar-nav',
					)
				);
				?>	    		
  			</div>
		</nav>		
	</header><!-- #masthead -->
	
	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-3 mb-3">
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
			</div>
		</div>
	</div>
	
