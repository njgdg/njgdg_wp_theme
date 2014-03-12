<?php
/**
 * Radiate functions and definitions
 *
 * @package ThemeGrill
 * @subpackage Radiate
 * @since Radiate 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 768; /* pixels */
}

if ( ! function_exists( 'radiate_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function radiate_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on radiate, use a find and replace
	 * to change 'radiate' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'radiate', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 * Post thumbail is used for pages that are shown in the featured section of Front page.
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'radiate' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'radiate_custom_background_args', array(
		'default-color' => 'EAEAEA',
		'default-image' => '',
	) ) );

	// Adding excerpt option box for pages as well
	add_post_type_support( 'page', 'excerpt' );
}
endif; // radiate_setup
add_action( 'after_setup_theme', 'radiate_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function radiate_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'radiate' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'radiate_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function radiate_scripts() {
	// Load our main stylesheet.
	wp_enqueue_style( 'radiate-style', get_stylesheet_uri() );

	wp_enqueue_style( 'radiate-google-fonts', 'http://fonts.googleapis.com/css?family=Roboto|Merriweather:400,300' ); 

	wp_enqueue_script( 'radiate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'radiate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'radiate-custom-js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), false, true );
	
	$radiate_header_image_link = get_header_image();
	wp_localize_script( 'radiate-custom-js', 'radiateScriptParam', array('radiate_image_link'=> $radiate_header_image_link ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'radiate_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

?>