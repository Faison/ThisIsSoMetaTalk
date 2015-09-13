<?php
namespace FZ_Talk\Core;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @since 0.1.0
 *
 * @uses add_action()
 *
 * @return void.
 */
function setup() {
	add_action( 'after_setup_theme',  __NAMESPACE__ . '\i18n' );
	add_action( 'wp_head',            __NAMESPACE__ . '\header_meta' );
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts' );
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\styles' );
}

/**
 * Makes WP Theme available for translation.
 *
 * Translations can be added to the /lang directory.
 * If you're building a theme based on WP Theme, use a find and replace
 * to change 'wptheme' to the name of your theme in all template files.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 *
 * @since 0.1.0
 *
 * @return void.
 */
function i18n() {
	load_theme_textdomain( 'fztalk', FZTALK_PATH . '/languages' );
 }

/**
 * Enqueue scripts for front-end.
 *
 * @uses wp_enqueue_script() to load front end scripts.
 *
 * @since 0.1.0
 *
 * @return void.
 */
function scripts( $debug = false ) {
	$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'fztalk',
		FZTALK_URL . "/assets/js/fz-talk{$min}.js",
		array(),
		FZTALK_VERSION,
		true
	);
}

/**
 * Enqueue styles for front-end.
 *
 * @uses wp_enqueue_style() to load front end styles.
 *
 * @since 0.1.0
 *
 * @return void.
 */
function styles( $debug = false ) {
	$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style(
		'parent-style',
		get_template_directory_uri() . '/style.css'
	);

	wp_enqueue_style(
		'fztalk',
		FZTALK_URL . "/assets/css/fz-talk{$min}.css",
		array(),
		FZTALK_VERSION
	);
}

/**
 * Add humans.txt to the <head> element.
 *
 * @uses apply_filters()
 *
 * @since 0.1.0
 *
 * @return void.
 */
function header_meta() {
	$humans = '<link type="text/plain" rel="author" href="' . FZTALK_URL . '/humans.txt" />';

	echo apply_filters( 'fztalk_humans', $humans );
}
