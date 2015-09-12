<?php
/**
 * Theme functions for the FZ Talk Theme.
 */

namespace FZ_Talk_Theme;

/**
 * Enqueues the parent theme style
 */
function fz_talk_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\fz_talk_enqueue_styles' );
