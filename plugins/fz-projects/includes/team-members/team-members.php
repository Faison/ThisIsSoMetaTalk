<?php
/**
 * General functions for the Team Members component.
 */

namespace FZ_Projects\Team_Members;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitizes and Validates a Team Member post id.
 *
 * @param int $value The post id to sanitize and validate as a team member.
 *
 * @return int|string The sanitized and valid team member post id, or an empty string if false.
 */
function sanitize_team_member_id( $value ) {
	$value = intval( $value );

	if ( 0 >= $value ) {
		return '';
	}

	if ( get_team_members_post_type_name() !== get_post_type( $value ) ) {
		return '';
	}

	return $value;
}
