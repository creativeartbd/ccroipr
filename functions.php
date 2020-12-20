<?php
/**
 * ccroipr functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ccroipr
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0-'. time() );
}

if ( ! function_exists( 'ccroipr_setup' ) ) :

	function ccroipr_setup() {
		
		load_theme_textdomain( 'ccroipr', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add new image size
		add_image_size( 'ccroipr', 350 );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'ccroipr' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'ccroipr_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'ccroipr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ccroipr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ccroipr_content_width', 640 );
}
add_action( 'after_setup_theme', 'ccroipr_content_width', 0 );

/**
 * Register widget area.
 */
function ccroipr_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ccroipr' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ccroipr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Left footer', 'ccroipr' ),
			'id'            => 'left-footer',
			'description'   => esc_html__( 'Add widgets here.', 'ccroipr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar( 
		array(
			'name'          => esc_html__( 'Middle footer', 'ccroipr' ),
			'id'            => 'middle-footer',
			'description'   => esc_html__( 'Add widgets here.', 'ccroipr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Right footer', 'ccroipr' ),
			'id'            => 'right-footer',
			'description'   => esc_html__( 'Add widgets here.', 'ccroipr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
		)
	);

	register_sidebar( 
		array(
			'name'          => esc_html__( 'Copyright Text', 'ccroipr' ),
			'id'            => 'copyright',
			'description'   => esc_html__( 'Add widgets here.', 'ccroipr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
		)
	);

	register_sidebar( 
		array(
			'name'          => esc_html__( 'Footer info card', 'ccroipr' ),
			'id'            => 'footer-info-card',
			'description'   => esc_html__( 'Add widgets here.', 'ccroipr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
		)
	);

	register_sidebar( 
		array(
			'name'          => esc_html__( 'Bottom footer', 'ccroipr' ),
			'id'            => 'bottom-footer',
			'description'   => esc_html__( 'Add widgets here.', 'ccroipr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
		)
	);
}
add_action( 'widgets_init', 'ccroipr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ccroipr_scripts() {	

	wp_enqueue_style( 'slim', get_template_directory_uri() . '/slim/slim.min.css', null, _S_VERSION );
	wp_enqueue_style( 'font-awesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', null, null, 'all');			
	wp_enqueue_style( 'boostrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, _S_VERSION );		
	wp_enqueue_style( 'ccroipr-style', get_stylesheet_uri(), array(), _S_VERSION );		
	wp_style_add_data( 'ccroipr-style', 'rtl', 'replace' );
	
	wp_enqueue_script( 'slim', get_template_directory_uri() . '/slim/slim.kickstart.min.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'popper-min', '//cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), _S_VERSION, true );	

	wp_enqueue_script( 'ccroipr-js', get_template_directory_uri() . '/assets/js/ccroipr.js', array( 'jquery' ), _S_VERSION, true );
	// set variables for script
    wp_localize_script( 'ccroipr-js', 'settings', array(
    	'ajaxurl'    => admin_url( 'admin-ajax.php' ),        
    ) );

	wp_enqueue_script( 'ccroipr-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'ccroipr-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ccroipr_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Theme Option Panel
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Theme hooks
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Theme extra function
 */
require get_template_directory() . '/inc/extra.php';

/**
 * Register custom post type
 */
require get_template_directory() . '/inc/custom-post.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Bootstrap nav walker
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';