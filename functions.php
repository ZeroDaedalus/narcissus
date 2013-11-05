<?php
/**
 * Narcissus functions and definitions
 *
 * @package Narcissus
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'narcissus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function narcissus_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Narcissus, use a find and replace
	 * to change 'narcissus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'narcissus', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'narcissus' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
     /**    Removed. Custom backgrounds will be featured in a later release
        add_theme_support( 'custom-background', apply_filters( 'narcissus_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
    */
    }
endif; // narcissus_setup
add_action( 'after_setup_theme', 'narcissus_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function narcissus_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'narcissus' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'narcissus_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function narcissus_scripts() {
     /**
      * Load Base Styles
      */
     wp_enqueue_style( 'narcissus-base-style', get_stylesheet_directory_uri() . '/stylesheets/style.css' );

    /**
     *  Load sidebar layout style
     */
    $option = get_option('narcissus_theme_options');   
    $sidebar = $option['custom_sidebar'];
    switch ($sidebar) {
        case 'left':
            wp_enqueue_style( 'narcissus-left-style', get_stylesheet_directory_uri() . '/stylesheets/layouts/left-sidebar.css' );
            break;
        case 'none':
            wp_enqueue_style( 'narcissus-full-width-style', get_stylesheet_directory_uri() . '/stylesheets/layouts/full-width.css' );
            break;
        default:
            wp_enqueue_style( 'narcissus-right-style', get_stylesheet_directory_uri() . '/stylesheets/layouts/right-sidebar.css' );
            break;
    }

    /**
     *  Load selected color styles
     */

    $background = $option['background_color'];
    switch ( $background ) {
        case 'black':
            wp_enqueue_style( 'narcissus-dark', get_stylesheet_directory_uri() . '/stylesheets/dark.css' );
            wp_enqueue_style( 'narcissus-style-black', get_stylesheet_directory_uri() . '/stylesheets/color/style-black.css' ); 
            break;
        case 'white':
            wp_enqueue_style( 'narcissus-light', get_stylesheet_directory_uri() . '/stylesheets/light.css' );
            wp_enqueue_style( 'narcissus-style-white', get_stylesheet_directory_uri() . '/stylesheets/color/style-white.css' ); 
            break;
        case 'red':
            wp_enqueue_style( 'narcissus-dark', get_stylesheet_directory_uri() . '/stylesheets/dark.css' );
            wp_enqueue_style( 'narcissus-style-red', get_stylesheet_directory_uri() . '/stylesheets/color/style-red.css' ); 
            break;
        case 'blue':
            wp_enqueue_style( 'narcissus-dark', get_stylesheet_directory_uri() . '/stylesheets/dark.css' );
            wp_enqueue_style( 'narcissus-style-blue', get_stylesheet_directory_uri() . '/stylesheets/color/style-blue.css' ); 
            break;
        case 'green':
            wp_enqueue_style( 'narcissus-dark', get_stylesheet_directory_uri() . '/stylesheets/dark.css' );
            wp_enqueue_style( 'narcissus-style-green', get_stylesheet_directory_uri() . '/stylesheets/color/style-green.css' ); 
            break;
        case 'yellow':
            wp_enqueue_style( 'narcissus-light', get_stylesheet_directory_uri() . '/stylesheets/light.css' );
            wp_enqueue_style( 'narcissus-style-yellow', get_stylesheet_directory_uri() . '/stylesheets/color/style-yellow.css' ); 
            break;
        case 'purple':
            wp_enqueue_style( 'narcissus-dark', get_stylesheet_directory_uri() . '/stylesheets/dark.css' );
            wp_enqueue_style( 'narcissus-style-purple', get_stylesheet_directory_uri() . '/stylesheets/color/style-purple.css' ); 
            break;
        case 'orange':
            wp_enqueue_style( 'narcissus-light', get_stylesheet_directory_uri() . '/stylesheets/light.css' );
            wp_enqueue_style( 'narcissus-style-orange', get_stylesheet_directory_uri() . '/stylesheets/color/style-orange.css' ); 
            break;
        default:
            wp_enqueue_style( 'narcissus-light', get_stylesheet_directory_uri() . '/stylesheets/light.css' );
            wp_enqueue_style( 'narcissus-style-default', get_stylesheet_directory_uri() . '/stylesheets/color/style-default.css' );
            break;
    }

	wp_enqueue_script( 'narcissus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'narcissus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'narcissus-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'narcissus_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Theme Options for admins
 */

if(is_admin()) {
    require get_template_directory() . '/inc/options.php';
}
