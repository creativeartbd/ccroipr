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
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title">
						<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>								
						</a>
					</h1>
					<?php
				else :
					?>
					<p class="site-title">
						<a class="navbar-brand"  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</p>
					<?php
				endif;

				$ccroipr_description = get_bloginfo( 'description', 'display' );
				if ( $ccroipr_description || is_customize_preview() ) :
				?>
					<p class="site-description"><?php echo $ccroipr_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
		  		

		  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    		<span class="navbar-toggler-icon"></span>
		  		</button>

	  			<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    			<ul class="navbar-nav mr-auto">
	      				<li class="nav-item active">
	        				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link" href="#">Link</a>
	      				</li>      				
	      				<li class="nav-item">
	        				<a class="nav-link disabled" href="#">Disabled</a>
	      				</li>
	    			</ul>    			
	  			</div>
  			</div>
		</nav>
		

		<div class="site-branding">
			
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ccroipr' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
