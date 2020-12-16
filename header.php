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
		<nav class="navbar navbar-inverse">
			<?php
			wp_nav_menu(
				array(
					'container_class' => 'container',
					'container_id'    => '',
					'depth'           => 10,
					'theme_location'  => 'menu-1',
					'menu_id'         => 'primary-menu',
					'menu_class'	  => 'nav navbar-nav',
					'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
					'walker'          => new wp_bootstrap_navwalker()
				)
			);
			?>	  
		</nav>
	</header>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12 mb-3">
				<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
			</div>
		</div>
	</div>
	
