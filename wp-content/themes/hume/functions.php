<?php
/**
 * hume_scores functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hume_scores
 */

if ( ! function_exists( 'hume_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hume_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on hume_scores, use a find and replace
	 * to change 'hume' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hume', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Main', 'hume' ),
		'menu-2' => esc_html__( 'Social', 'hume')
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hume_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	//Add theme support for custom logo

    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
}
endif;
add_action( 'after_setup_theme', 'hume_setup' );


/**
 * Register custom fonts.
 */
function hume_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Playfair Display and PT Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$playfair_display = _x( 'on', 'Playfair Display font: on or off', 'hume' );
	$pt_sans = _x( 'on', 'PT Sans font: on or off', 'hume' );
	$font_choices = array($playfair_display, $pt_sans);

	$font_families = array();
	if ( 'off' !== $playfair_display ) {

		$font_families[] = 'Playfair Display:400,700,900';
	}

	if ( 'off' !== $pt_sans ) {

		$font_families[] = 'PT Sans:400,700';
	}

	if ( in_array('on', $font_choices ) ) {

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts. Make it load faster
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function hume_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'hume-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'hume_resource_hints', 10, 2 );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hume_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hume_content_width', 640 );
}
add_action( 'after_setup_theme', 'hume_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*Below function is for widgets but they do not have to be in the sidebar*/
function hume_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hume' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hume_widgets_init' );

/**
 * Enqueue scripts and styles. jquery.slicknav.js
 */
function hume_scripts() {
	// Get fonts: Playfair Display and PT Sans
	wp_enqueue_style('hume-fonts', hume_fonts_url());

	wp_enqueue_style( 'hume-style', get_stylesheet_uri() );
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(),'06192017');
	// wp_enqueue_style('fullcalendarcss', '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css', array(),'061920172');
	// wp_register_script('moment', get_template_directory_uri() . '/js/moment.js', array(), false);
	
	// wp_enqueue_script('fullcalendar', '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js', array('jquery','moment',), false);
	// wp_enqueue_script('gcalendar', get_template_directory_uri() . '/js/gcal.min.js', array('fullcalendar'), false);
	wp_register_script('slicknav', get_template_directory_uri() . '/js/jquery.slicknav.js', array('jquery', 'wp-custom-header'), true);

	wp_enqueue_script( 'hume-navigation', get_template_directory_uri() . '/js/navigation.js', array('slicknav'), '20151215', true );

	wp_register_script( 'bootstrap',  get_template_directory_uri() . '/js/bootstrap.min.js', array('slicknav'), '06082017', true );
	// wp_register_script('moment', get_template_directory_uri() . '/js/moment.js', array(), false);
	// wp_register_script('fullcalendar', get_template_directory_uri() . '/js/fullcalendar.min.js', array('moment'), false);
	

	wp_enqueue_script( 'custom-script',  get_template_directory_uri() . '/js/main.js', array('bootstrap'), '06052017', true );

	wp_enqueue_script( 'hume-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	//wp_enqueue_script( 'custom-script' );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'hume_scripts',5000 );

function my_deregister_scripts(){
 wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

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

//These are custom functions written specifically for the theme

//display markup based on customizer 
//for CTA function - Front Page

function cta_customize_markup () {
	$main = get_theme_mod('front_announcement_main');
	$tag = get_theme_mod('front_announcement_tag');
	$button = get_theme_mod('front_announcement_button_label');
	$url = get_theme_mod('front_announcement_url');
	if ($main !== '') {
		if ($tag === '' && $url === '') {
			return "<div class='cta_customize'><h3>" . 
				$main .
				"</h3></div>";
		} elseif ($tag === '' && $button === '') {
			return "<div class='cta_customize'><h3>" . 
				$main .
				"</h3></div>";
		} elseif ($tag === '') {
			return "<div class='cta_customize'><h3>" . 
				$main .
				"</h3>" . 
				"<a href='". $url ."'>" .
				"<button type='button'>" . 
				$button . 
				"</button>" .
				"</a>" .
				"</div>";
		} elseif ($url === '' || $button === '') {
			return "<div class='cta_customize'><h3>" . 
				$main .
				"</h3>" . 
				"<p>". 
				$tag .
				"</p></div>";
		} else {
			return "<div class='cta_customize'><h3>" . 
				$main .
				"</h3>" . 
				"<p>". 
				$tag .
				"</p>" .
				"<a href='". $url ."'>" .
				"<button type='button'>" . 
				$button . 
				"</button>" .
				"</a>" .
				"</div>";
		}
	} else {
			return '';	
		}
}

function get_hume_custom_header_markup() {
	if ( ! has_custom_header() && ! is_customize_preview() ) {
		return '';
	}

	return sprintf(
		'<div id="wp-custom-header" class="wp-custom-header">%s %s %s</div>',
		get_header_image_tag(),cta_customize_markup(),'<div class="darken-header"></div>'
	);
}

/**
 * Print the markup for a custom header.
 *
 * A container div will always be printed in the Customizer preview.
 *
 * @since 4.7.0
 */
function the_hume_custom_header_markup() {
	$custom_header = get_hume_custom_header_markup();
	if ( empty( $custom_header ) ) {
		return;
	}

	echo $custom_header ;

	if ( is_header_video_active() && ( has_header_video() || is_customize_preview() ) ) {

		wp_enqueue_script( 'wp-custom-header' );

		wp_localize_script( 'wp-custom-header', '_wpCustomHeaderSettings', get_header_video_settings() );

		wp_enqueue_script( 'main-cta',  get_template_directory_uri() . '/js/front_cta.js', array('jquery'), '06062017', false );

		// wp_localize_script( 'main-cta', '_wpCustomCatHeaderSettings', array(
		// 	'main' => 'test',

		// 	) );	
	}
}
// echo '<pre>';
// print_r(get_post_custom_keys(1845));
// print_r(get_post_meta(1845)); 
// echo '</pre>';
