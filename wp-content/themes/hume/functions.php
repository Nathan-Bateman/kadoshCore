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
		'menu-2' => esc_html__( 'Social', 'hume'),
		'menu-3' => esc_html__('Contact','hume')
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

    function theme_prefix_setup() {
	
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-width' => true,
		) );
	}
	add_action( 'after_setup_theme', 'theme_prefix_setup' );

	function theme_prefix_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}


    	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
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

//Custom Taxonomy for Sermon
function series_taxonomy() {  
    register_taxonomy(  
        'series',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'sermon',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Series',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'series', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );  
}  
add_action( 'init', 'series_taxonomy');
function speaker_taxonomy() {  
    register_taxonomy(  
        'speaker',   
        'sermon',        
        array(  
            'hierarchical' => true,  
            'label' => 'Speaker',
            'show_ui' => true,  
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'speaker', 
                'with_front' => false 
            )
        )  
    );  
}  
add_action( 'init', 'speaker_taxonomy');

//Sermon Post Type
// Register Custom Post Type sermon
// Post Type Key: sermon
function create_sermon_cpt() {

	$labels = array(
		'name' => __( 'Sermons', 'Post Type General Name', 'textdomain' ),
		'singular_name' => __( 'sermon', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => __( 'Sermons', 'textdomain' ),
		'name_admin_bar' => __( 'sermon', 'textdomain' ),
		'archives' => __( 'sermon Archives', 'textdomain' ),
		'attributes' => __( 'sermon Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent sermon:', 'textdomain' ),
		'all_items' => __( 'All sermons', 'textdomain' ),
		'add_new_item' => __( 'Add New sermon', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New sermon', 'textdomain' ),
		'edit_item' => __( 'Edit sermon', 'textdomain' ),
		'update_item' => __( 'Update sermon', 'textdomain' ),
		'view_item' => __( 'View sermon', 'textdomain' ),
		'view_items' => __( 'View sermons', 'textdomain' ),
		'search_items' => __( 'Search sermon', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into sermon', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this sermon', 'textdomain' ),
		'items_list' => __( 'sermons list', 'textdomain' ),
		'items_list_navigation' => __( 'sermons list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter sermons list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'sermon', 'textdomain' ),
		'description' => __( 'any message given for the edification of the body of Christ', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-megaphone',
		'supports' => array('title', 'editor', 'excerpt', 'revisions', 'author', 'post-formats', 'custom-fields', 'thumbnail' ),
		'taxonomies' => array('series','speaker'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => false,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'sermon', $args );

}
add_action( 'init', 'create_sermon_cpt', 0 );

//Limit number of sermons per archive page here
function sermon_archive_post_limit( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'sermon' ) ) {
        $query->set( 'posts_per_page', 6 );
        return;
    }
}
add_action( 'pre_get_posts', 'sermon_archive_post_limit', 1 );

//Add custom image sizes for featured images
add_image_size( 'sermon-archive-size', 333, 360 );

//remove default taxonomy menu selection for sermons
function remove_speaker_meta() {
	remove_meta_box( 'speakerdiv', 'sermon', 'side' );
        
        // $custom_taxonomy_slug is the slug of your taxonomy, e.g. 'genre' )
        // $custom_post_type is the "slug" of your post type, e.g. 'movies' )
}
add_action( 'admin_menu', 'remove_speaker_meta' );

//include custom fields in search return

//functions for including generic sections

function get_donation_cta() {
	//$page_content = get_post(1974)->post_content;
	$prompt = get_theme_mod('donation_promt');
	$button_label = get_theme_mod('donation_button_label');
	$button_link = get_theme_mod('donation_button_link');

	if (!get_theme_mod('turn-on-or-off-donate') ) {
		return;
	} else {
		echo '<div class="row bg-img-quote">
                <div class="overlay-phs"></div>
                <div class="max-width">
                    <div id="quote" class="col-md-12">
                        <div class="quote-granular">
                          <!--<img height="70px" width="70px" src="images/quotes.png">-->
                            <p>'.$prompt.'</p>
                            <p>
                             <a href="'.$button_link.'"><button type="button">'.$button_label.'</button></a>
                             </p>
                        </div>

                    </div>
                </div>
            </div>';
	}
}
function get_three_main_section() {
	$first_main = get_theme_mod('three_main_one');
	$first_main_link = get_theme_mod('three_main_one_link');
	$second_main = get_theme_mod('three_main_two');
	$second_main_link = get_theme_mod('three_main_two_link');
	$third_main = get_theme_mod('three_main_three');
	$third_main_link = get_theme_mod('three_main_three_link');
	if (!get_theme_mod('turn-on-or-off-three-main') ) {
		return;
	} else {
		echo '<div class="row three-main">
	                <div class="overlay-three"></div>
	                	<div class="wrapper-three-main">
	                		<h2>A Closer Look</h2>
	                		<h4>See more of who we are, where we serve, and what we believe.</h4>
		                    <div class="col-md-4">
		                        <div class="drop-circle-shadow">
		                          <img src="/wp-content/themes/hume/images/earth.svg"> 
		                        </div>
		                        <h3><a href="'.$first_main_link.'">'.$first_main.'</a></h3>
		                    </div>
							<div class="col-md-4">
		                        <div class="drop-circle-shadow">
		                          <img src="/wp-content/themes/hume/images/bible.svg"> 
		                        </div>
		                        <h3><a href="'.$second_main_link.'">'.$second_main.'</a></h3>
		                    </div>
		                    <div class="col-md-4">
		                        <div class="drop-circle-shadow">
		                          <img src="/wp-content/themes/hume/images/ministry.svg"> 
		                        </div>
		                        <h3><a href="'.$third_main_link.'">'.$third_main.'</a></h3>
		                    </div>
	                    </div>
	            </div>';
	    }

}
//Section for all pages above footer
function get_contact_prayer_section() {
	$entity_name = get_theme_mod('entity_name');
	$addres_one = get_theme_mod('addres_one');
	$addres_two = get_theme_mod('addres_two');
	$phone = get_theme_mod('phone');
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	$logo = $image[0];
	if (!get_theme_mod('turn-on-or-off-three-main') ) {
		return;
	} else {
		echo '<div class="row contact-prayer-info">
	                <div class="overlay-three"></div>
	                	<div class="wrapper-contact-prayer-info">
		                    <div class="col-md-6 address">
		                    <h1>'.$entity_name.'</h1> 
		                    <p>'.$addres_one.'</p>
		                    <p>'.$addres_two.'</p>
		                    <a id="menu-num" href="tel:2296380708"><h2>'.$phone.'</h2></a><nav class="contact">';
		      		wp_nav_menu( array( 'theme_location' => 'menu-3', 'menu_id' => 'contact-menu' ) ); 
		echo '<nav class="footer-social">';
					wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_id' => 'social-menu' ) );
		echo '</nav>';           
		echo '</nav></div>
				<div class="col-md-6 contact-prayer">
					<h1>Contact / Prayer Request</h1>'.do_shortcode('[ninja_form id=1]').'  
		                       
		        </div>  
	            </div>
	          </div>';
	    }
	    
}

//Get 4 most recent sermons for sidebar
	function get_recent_sermons() {
		$args = array(
			'post_type' => array('sermon'
        		),
			'posts_per_page' => '4',
		);

		$query = new WP_Query( $args );
		if( $query->have_posts() ):
			echo '<h4>Sermons</h4>';
			echo '<ul>';
			while ( $query->have_posts() ) : $query->the_post();
				echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
			endwhile;
			echo '</ul>';
		endif;
		wp_reset_postdata();
	}
	//Get 4 most recent sermons for sidebar
	function get_recent_series() {
		
		$terms = get_terms( array(
		    'taxonomy' => 'series',
		    'hide_empty' => false,
		) );
		//TODO: limit it to the most recent 4 series
		echo '<h4>Series</h4>';
		echo '<ul>';
		echo '<pre>';
		print_r($terms);
		echo '</pre>';
		foreach ( $terms as $term ) {
			echo '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
		}
		echo '</ul>';
	}

require get_template_directory () . '/inc/icon-functions.php';