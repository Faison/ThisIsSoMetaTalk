<?php
/**
 * Meta Functions for the Team Members component.
 */

namespace FZ_Projects\Team_Members;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueues the team member meta styles.
 */
function enqueue_team_member_styles() {
	$screen = get_current_screen();

	if ( get_team_members_post_type_name() !== $screen->post_type ) {
		return;
	}

	if ( 'post' !== $screen->base ) {
		return;
	}

	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.min' : '';

	wp_enqueue_style(
		'fz-team-member-meta',
		FZP_URL . "/assets/css/team-members-meta{$min}.css",
		array(),
		FZP_VERSION
	);
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_team_member_styles' );
