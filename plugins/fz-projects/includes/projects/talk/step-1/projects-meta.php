<?php
/**
 * Meta Functions for the Projects component.
 */

namespace FZ_Projects\Projects;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueues the FZ Project meta styles.
 */
function enqueue_project_styles() {
	$screen = get_current_screen();

	if ( get_projects_post_type_name() !== $screen->post_type ) {
		return;
	}

	if ( 'post' !== $screen->base ) {
		return;
	}

	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.min' : '';

	wp_enqueue_style(
		'fz-project-meta',
		FZP_URL . "/assets/css/fz-project-meta{$min}.css",
		array(),
		FZP_VERSION
	);
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_project_styles' );
