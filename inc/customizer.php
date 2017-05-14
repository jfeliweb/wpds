<?php

//***********************
//
// Customizer
//
//***********************

define('WPDS_DEFAULT_THEME', 'simple'); 
define('WPDS_DEFAULT_TIMER_SPEED', 3);
define('WPDS_DEFAULT_TRANSITION_SPEED', 'default');
define('WPDS_DEFAULT_TRANSITION_STYLE', 'fade');
define('WPDS_DEFAULT_SHOW_SLIDE_NUMBER', false);
define('WPDS_DEFAULT_AUTOPLAY_STOPPABLE', false);
define('WPDS_DEFAULT_SHOW_NET_STATUS_INFO_BOX', false);
define('WPDS_DEFAULT_WIDTH', 960);
define('WPDS_DEFAULT_MARGIN', 4);
define('WPDS_DEFAULT_TEXT_ALIGN', 'center');
define('WPDS_DEFAULT_VERTICAL_CENTER', false);

define('WPDS_THEME_DIR_REVEAL_JS', 'reveal.js/css/theme');
define('WPDS_THEME_DIR_CUSTOM', 'stylesheets/themes');

/* Uncomment to reset theme settings
function reset_mytheme_options() { 
    remove_theme_mods();
}
add_action( 'after_setup_theme', 'reset_mytheme_options' );
*/

function wpds_theme_customizer( $wp_customize ) {

	require_once( get_template_directory() . '/admin/customizer/alpha-color-picker/alpha-color-picker.php' );

	// Remove existing non-required stuff
	$wp_customize->remove_control('blogdescription');
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_panel('nav_menus');

	//
	// Slider (Digital Signage) section
	//
	$wp_customize->add_section( 'signage', array(
        'title' => __('Slider', 'wpds'),
	) );
	
	// Auto play speed
	$wp_customize->add_setting( 'signage[timer_speed]', array(
	    'default' => WPDS_DEFAULT_TIMER_SPEED,
	) );
	$wp_customize->add_control( 'signage[timer_speed]', array(
		'label' => __('Timer speed (s)', 'wpds'),
		'section' => 'signage',
		'type' => 'number',
	) );
    
	// Autoplay stopable
	$wp_customize->add_setting( 'signage[autoplay_stoppable]', array(
		'default' => WPDS_DEFAULT_AUTOPLAY_STOPPABLE,
	) );
	$wp_customize->add_control( 'signage[autoplay_stoppable]', array(
		'label'   => __('Allow user to stop autoplay', 'wpds'),
		'section' => 'signage',
		'type' => 'checkbox',
	) );

	// Transition style
	$wp_customize->add_setting( 'signage[transition_style]', array(
	    'default' => WPDS_DEFAULT_TRANSITION_STYLE,
	) );
	$wp_customize->add_control( 'signage[transition_style]', array(
		'label' => __('Transition style', 'wpds'),
		'section' => 'signage',
		'type' => 'radio',
		'choices' => array(
			'none' => __('None', 'wpds'),
			'fade' =>  __('Fade', 'wpds'),
			'slide' =>  __('Slide', 'wpds'),
			'convex' =>  __('Convex', 'wpds'),
			'concave' =>  __('Concave', 'wpds'),
			'zoom' =>  __('Zoom', 'wpds'),
		),
	) );

	// Transition speed
	$wp_customize->add_setting( 'signage[transition_speed]', array(
	    'default' => WPDS_DEFAULT_TRANSITION_SPEED,
	) );
	$wp_customize->add_control( 'signage[transition_speed]', array(
		'label' => __('Transition speed', 'wpds'),
		'section' => 'signage',
		'type' => 'radio',
		'choices' => array(
			'default' => __('Default', 'wpds'),
			'fast' =>  __('Fast', 'wpds'),
			'slow' =>  __('Slow', 'wpds'),
		),
	) );

	// Content change check interval
	$wp_customize->add_setting( 'signage[content_change_check_interval]', array(
		'default' => '10',
	) );
	$wp_customize->add_control( 'signage[content_change_check_interval]', array(
		'label' => __('Content change check interval (s)', 'wpds'),
		'section' => 'signage',
		'type' => 'number',
	) );
	
	//
	// Layout section
	//
	$wp_customize->add_section( 'layout', array(
		'title' => __('Layout', 'wpds'),
	) );

	// Themes
	$wp_customize->add_setting( 'signage[theme]', array(
		'default' => WPDS_DEFAULT_THEME,
	) );
	$wp_customize->add_control( 'signage[theme]', array(
		'label' => __('Theme', 'wpds'),
		'section' => 'layout',
		'type' => 'select',
		'choices' => wpds_get_revealjs_themes(),
	) );

	// Text alignment
	$wp_customize->add_setting( 'signage[text_align]', array(
	    'default' => WPDS_DEFAULT_TEXT_ALIGN,
	) );
	$wp_customize->add_control( 'signage[text_align]', array(
		'label' => __('Text align', 'wpds'),
		'section' => 'layout',
		'type' => 'radio',
		'choices' => array(
			'left' => __('Left', 'wpds'),
			'center' =>  __('Center', 'wpds'),
			'right' =>  __('Right', 'wpds'),
		),
	) );
	
	// Center content vertically
	$wp_customize->add_setting( 'signage[vertical_center]', array(
		'default' => WPDS_DEFAULT_VERTICAL_CENTER,
	) );
	$wp_customize->add_control( 'signage[vertical_center]', array(
		'label'   => __('Center content vertically', 'wpds'),
		'section' => 'layout',
		'type' => 'checkbox',
	) );
    
	// Width
	$wp_customize->add_setting( 'layout[width]', array(
	    'default' => WPDS_DEFAULT_WIDTH,
	) );
	$wp_customize->add_control( 'layout[width]', array(
		'label' => __('Custom width (px)', 'wpds'),
		'section' => 'layout',
		'type' => 'number',
	) );
	
	// Margin
	$wp_customize->add_setting( 'layout[margin]', array(
	    'default' => WPDS_DEFAULT_MARGIN,
	) );
	$wp_customize->add_control( 'layout[margin]', array(
		'label' => __('Margin', 'wpds'),
		'section' => 'layout',
		'type' => 'number',
	) );

	// Show slide number
	$wp_customize->add_setting( 'signage[show_slide_number]', array(
		'default' => WPDS_DEFAULT_SHOW_SLIDE_NUMBER,
	) );
	$wp_customize->add_control( 'signage[show_slide_number]', array(
		'label'   => __('Show slide number', 'wpds'),
		'section' => 'layout',
		'type' => 'checkbox',
	) );
	
	// Show dock
	$wp_customize->add_setting( 'layout[show-dock]', array(
    	'default' => true,
	) );
	$wp_customize->add_control( 'layout[show-dock]', array(
		'label'   => __('Show dock', 'wpds'),
		'section' => 'layout',
		'type' => 'checkbox',
	) );

	// Show network status box
	$wp_customize->add_setting( 'layout[show-net-status-infobox]', array(
    	'default' => WPDS_DEFAULT_SHOW_NET_STATUS_INFO_BOX,
	) );
	$wp_customize->add_control( 'layout[show-net-status-infobox]', array(
		'label'   => __('Show network status infobox', 'wpds'),
		'section' => 'layout',
		'type' => 'checkbox',
	) );

	
	//
	// Colors section
	//
	$wp_customize->add_section( 'colors', array(
        'title' => __('Colors', 'wpds'),
	) );

	// Background color
	$wp_customize->add_setting( 'colors[background-color]', array(
    		'default' => '#ffffff',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[background-color]', array(
		'label'   => __('Background Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Headline color
	$wp_customize->add_setting( 'colors[headline-color]', array(
    		'default' => '#000000',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[headline-color]', array(
		'label'   => __('Headline Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Subhead color
	$wp_customize->add_setting( 'colors[subhead-color]', array(
    		'default' => '#000000',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[subhead-color]', array(
		'label'   => __('Sub-headline Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Copy color
	$wp_customize->add_setting( 'colors[copy-color]', array(
    		'default' => '#000000',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[copy-color]', array(
		'label'   => __('Copy Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Dock background color
	$wp_customize->add_setting( 'colors[dock-background-color]', array(
		'default' => 'rgba(79, 75, 75, 0.43)',
	) );
	$wp_customize->add_control( new Customize_Alpha_Color_Control( $wp_customize, 'colors[dock-background-color]', array(
		'label'   => __('Dock Background Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Dock foreground color
	$wp_customize->add_setting( 'colors[dock-foreground-color]', array(
    		'default' => '#ffffff',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[dock-foreground-color]', array(
		'label'   => __('Dock Foreground Color', 'wpds'),
		'section' => 'colors',
	) ) );

	//
	// Settings section
	//
	$wp_customize->add_section( 'settings', array(
        'title' => __('Settings', 'wpds'),
	) );

	// Page reload interval
	$wp_customize->add_setting( 'signage[reload_interval]', array(
		'default' => '0',
	) );
	$wp_customize->add_control( 'signage[reload_interval]', array(
		'label' => __('Reload interval (min)', 'wpds'),
		'section' => 'settings',
		'type' => 'number',
        'description' => __('If the value is greater than 0, the site will auto-reload after this definied time.', 'wpds'),
	) );
    
}
add_action( 'customize_register', 'wpds_theme_customizer', 11 );

function wpds_get_revealjs_themes() {
	$themes = wpds_scan_dir_for_themes(get_template_directory() . '/' . WPDS_THEME_DIR_REVEAL_JS);
	$custom_themes = wpds_scan_dir_for_themes(get_template_directory() . '/' . WPDS_THEME_DIR_CUSTOM);
	$themes = array_merge($themes, $custom_themes);
	asort($themes);
	return $themes;
}

function wpds_scan_dir_for_themes($theme_dir) {
	$themes = array();
	foreach (scandir($theme_dir) as $file) {
		if (is_file($theme_dir . '/' . $file) && preg_match('/(.*).css$/', $file, $m)) {
			$themes[$m[1]] = ucfirst($m[1]);
		}
	}
	return $themes;
}

function wpds_get_layout_width() {
	$opts = get_theme_mod( 'layout', [] );
	return (!empty($opts['width']) && intval($opts['width']) > 0)
			? intval($opts['width']) 
			: WPDS_DEFAULT_WIDTH;
}

function wpds_get_layout_margin() {
	$opts = get_theme_mod( 'layout', [] );
	return ((isset($opts['margin']) && intval($opts['margin']) >= 0)
			? intval($opts['margin'])
			: WPDS_DEFAULT_MARGIN) / 100;
}

function wpds_get_auto_play_speed() {
	$signage_opts = get_theme_mod( 'signage', [] );
	return 1000 * (
		(!empty($signage_opts['timer_speed']) && intval($signage_opts['timer_speed']) > 0)
			? intval($signage_opts['timer_speed']) 
			: WPDS_DEFAULT_TIMER_SPEED
	);
}

function wpds_get_transition_style() {
	$signage_opts = get_theme_mod( 'signage', [] );
	return !empty($signage_opts['transition_style'])
			? $signage_opts['transition_style'] 
			: WPDS_DEFAULT_TRANSITION_STYLE;
}

function wpds_get_transition_speed() {
	$signage_opts = get_theme_mod( 'signage', [] );
	return !empty($signage_opts['transition_speed'])
			? $signage_opts['transition_speed'] 
			: WPDS_DEFAULT_TRANSITION_SPEED;
}

function wpds_show_slide_number() {
	$signage_opts = get_theme_mod( 'signage', [] );
	return isset($signage_opts['show_slide_number']) 
			? $signage_opts['show_slide_number']
			: WPDS_DEFAULT_SHOW_SLIDE_NUMBER;
}

function wpds_autoplay_stoppable() {
	$signage_opts = get_theme_mod( 'signage', [] );
	return isset($signage_opts['autoplay_stoppable']) 
			? $signage_opts['autoplay_stoppable']
			: WPDS_DEFAULT_AUTOPLAY_STOPPABLE;
}

function wpds_center_vertically() {
	$signage_opts = get_theme_mod( 'signage', [] );
	return isset($signage_opts['vertical_center']) 
			? $signage_opts['vertical_center']
			: WPDS_DEFAULT_VERTICAL_CENTER;
}

function wpds_get_theme_css() {
	$signage_opts = get_theme_mod( 'signage', [] );
	$theme = !empty($signage_opts['theme'])
			? $signage_opts['theme'] 
			: WPDS_DEFAULT_THEME;
	$custom_theme_file = WPDS_THEME_DIR_CUSTOM . '/'. $theme . '.css';
	if (is_file(get_template_directory() . '/' . $custom_theme_file)) {
		return $custom_theme_file;
	}
	return WPDS_THEME_DIR_REVEAL_JS . '/'. $theme . '.css';
}

function wpds_get_text_algin() {
	$signage_opts = get_theme_mod( 'signage', [] );
	return !empty($signage_opts['text_align'])
			? $signage_opts['text_align'] 
			: WPDS_DEFAULT_TEXT_ALIGN;
}

function wpds_show_net_status_info_box() {
	$opts = get_theme_mod( 'layout', [] );
	return isset($opts['show-net-status-infobox']) 
			? $opts['show-net-status-infobox']
			: WPDS_DEFAULT_SHOW_NET_STATUS_INFO_BOX;
}
