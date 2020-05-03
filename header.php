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
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<?php
				if( has_custom_logo() ) {
					the_custom_logo();	
				} else {
					sprintf("<h1 class='%'><a class='%s' href='%s'>%s</a></h1>", 'site-title', 'navbar-brand', esc_rul( home_url( '/' ) ), get_bloginfo( 'name' ) );
				}
				?>		
			
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    		<span class="navbar-toggler-icon"></span>
		  		</button>
	  			
  				<?php
				wp_nav_menu(
					array(
						'container_class' => 'collapse navbar-collapse header-menu',
						'container_id'    => 'navbarSupportedContent',
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'	=>	'navbar-nav ml-auto',

					)
				);
				?>	    		
  			</div>
		</nav>
	</header><!-- #masthead -->
