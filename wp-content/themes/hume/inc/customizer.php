<?php
/**
 * hume_scores Theme Customizer
 *
 * @package hume_scores
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hume_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//Custom functionality for customizer

	//for adding custom header and footer colors
		$wp_customize->add_setting( 'theme_bg_color', array(
		  'default' => '#002254',
		  'transport' => 'postMessage', // or postMessage
		  'type' => 'theme_mod', // or 'option'
		  'sanitize_callback' => 'sanitize_hex_color',
		));

		 $wp_customize->add_control( 
			new WP_Customize_Color_Control (
				$wp_customize,
				'theme_bg_color', array(
					'label' => __('Header and Footer Background Color', 'hume'),
					'section' => 'colors',
					'settings' => 'theme_bg_color'
				)
			)
		);
	//for adding custom CTA for background image or video
		$wp_customize->add_section( 'call_to_action', array(
		  'title' => __( 'Front Page Announcement', 'hume' ),
		  'priority' => 90,
		) ); 

		$wp_customize->add_setting( 'front_announcement_main', array(
		  'default' => 'Main Announcement Here',
		  'transport' => 'postMessage', // or postMessage
		  'type' => 'theme_mod', // or 'option'
		  'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control('front_announcement_main', array(
		 'label'   => 'Main Announcement',
		  'section' => 'call_to_action',
		 'type'    => 'text',
		 'active_callback' => 'is_front_page',
		));

		$wp_customize->add_setting( 'front_announcement_tag', array(
		  'default' => 'Tagline to Main Annoucnement Here',
		  'transport' => 'postMessage', // or postMessage
		  'type' => 'theme_mod', // or 'option'
		  'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control('front_announcement_tag', array(
		 'label'   => 'Tagline',
		  'section' => 'call_to_action',
		 'type'    => 'text',
		 'active_callback' => 'is_front_page',
		));

		$wp_customize->add_setting( 'front_announcement_button_label', array(
		  'default' => 'button title here',
		  'transport' => 'postMessage', // or postMessage
		  'type' => 'theme_mod', // or 'option'
		  'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control('front_announcement_button_label', array(
		 'label'   => 'Button Label',
		 'section' => 'call_to_action',
		 'type'    => 'text',
		 'active_callback' => 'is_front_page',
		));

		$wp_customize->add_setting( 'front_announcement_url', array(
		  'default' => 'https://youtu.be/QecyvLgSuN8',
		  'transport' => 'postMessage', // or postMessage
		  'type' => 'theme_mod', // or 'option'
		  'sanitize_callback' => 'esc_url',
		));

		$wp_customize->add_control('front_announcement_url', array(
		 'label'   => 'URL Link for Button - usually something within the site',
		 'section' => 'call_to_action',
		 'type'    => 'url',
		 'active_callback' => 'is_front_page',
		));

}
add_action( 'customize_register', 'hume_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hume_customize_preview_js() {
	wp_enqueue_script( 'hume_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'hume_customize_preview_js' );

//Composes the header styles to populate the header
if ( ! function_exists( 'hume_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see hume_custom_header_setup().
 */
function hume_header_style() {
	$header_text_color = get_header_textcolor();
	$header_background_color = get_theme_mod('theme_bg_color');

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) != $header_text_color  ) {
		
	

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
	if ($header_background_color === '#002254') {	

		return;

	} else { ?>

			<style type='text/css'>
				.site-header, .site-footer { 
					background-color: <?php echo  esc_attr($header_background_color); ?>;

				}
			</style>
		<?php }
}
endif;