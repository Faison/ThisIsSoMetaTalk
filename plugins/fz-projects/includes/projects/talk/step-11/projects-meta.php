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

	wp_enqueue_script(
		'fz-project-meta-scripts',
		FZP_URL . "/assets/js/fz-project-meta{$min}.js",
		array( 'jquery' ),
		FZP_VERSION,
		true
	);
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_project_styles' );

/**
 * Returns the Project Tagline meta key.
 *
 * @return string The Project Tagline meta key.
 */
function get_project_tagline_meta_key() {
	return 'fz_project_tagline';
}

/**
 * Returns the Project Github meta key.
 *
 * @return string The Project Github meta key.
 */
function get_project_github_meta_key() {
	return 'fz_project_github';
}

/**
 * Returns the Project Github meta key.
 *
 * @return string The Project Github meta key.
 */
function get_project_lead_meta_key() {
	return 'fz_project_lead';
}

/**
 * Returns the Project Team Members meta key.
 *
 * @return string The Project Team Members meta key.
 */
function get_project_team_members_meta_key() {
	return 'fz_project_team_members';
}

/**
 * Registers the Project meta with their sanitization functions
 */
function register_project_meta() {
	register_meta( 'post', get_project_tagline_meta_key(), 'sanitize_text_field', '__return_true' );
	register_meta( 'post', get_project_github_meta_key(),  'esc_url',             '__return_true' );

	register_meta( 'post', get_project_lead_meta_key(),         'FZ_Projects\Team_Members\sanitize_team_member_id', '__return_true' );
	register_meta( 'post', get_project_team_members_meta_key(), 'FZ_Projects\Team_Members\sanitize_team_member_id', '__return_true' );
}

add_action( 'fzp_init', __NAMESPACE__ . '\register_project_meta' );

/**
 * Adds the Project meta boxes.
 */
function add_project_meta_boxes() {
	if ( ! is_admin() ) {
		return;
	}

	add_meta_box(
		'fz_project_meta_box',
		esc_html__( 'Project Details', 'fzp' ),
		__NAMESPACE__ . '\display_project_meta_box',
		get_projects_post_type_name(),
		'normal',
		'default'
	);
}

add_action( 'add_meta_boxes', __NAMESPACE__ . '\add_project_meta_boxes' );

/**
 * Displays the Project Details Meta Box.
 *
 * @param \WP_Post $post The post currently being edited.
 */
function display_project_meta_box( $post ) {
	wp_nonce_field( 'fz_project_meta', 'fz_project_nonce' );

	\FZ_Projects\Core\display_text_meta_field( get_project_tagline_meta_key(), __( 'Project Tagline', 'fzp' ), $post->ID );
	\FZ_Projects\Core\display_text_meta_field( get_project_github_meta_key(),  __( 'Github URL', 'fzp' ),      $post->ID );

	$team_members = get_team_members();

	\FZ_Projects\Core\display_dropdown_meta_field( get_project_lead_meta_key(), __( 'Project Lead', 'fzp' ), $team_members, $post->ID );

	\FZ_Projects\Core\display_dropdown_list_meta_field( get_project_team_members_meta_key(), __( 'Team Members', 'fzp' ), $team_members, $post->ID );
}

/**
 * Returns an array of team member titles, indexed by their post ids.
 *
 * @return array The Team Members, indexed by their post ids.
 */
function get_team_members() {
	$team_member_query = new \WP_Query( array(
		'post_type'              => \FZ_Projects\Team_Members\get_team_members_post_type_name(),
		'orderby'                => 'title',
		'order'                  => 'ASC',
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
		'posts_per_page'         => 50,
	) );

	if ( ! $team_member_query->have_posts() ) {
		return array();
	}

	$team_members = array();

	foreach ( $team_member_query->posts as $post ) {
		$team_members[ $post->ID ] = $post->post_title;
	}

	return $team_members;
}

/**
 * Save the Project Meta Fields
 *
 * @param int $post_id The ID of the post we're saving meta for.
 */
function save_project_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( get_projects_post_type_name() !== get_post_type( $post_id ) ) {
		return;
	}

	if ( ! isset( $_POST['fz_project_nonce' ] ) || ! wp_verify_nonce( $_POST['fz_project_nonce'], 'fz_project_meta' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$meta_keys = array(
		get_project_tagline_meta_key(),
		get_project_github_meta_key(),
		get_project_lead_meta_key(),
	);

	foreach ( $meta_keys as $meta_key ) {
		if ( ! empty( $_POST[ $meta_key ] ) ) {
			update_post_meta( $post_id, $meta_key, $_POST[ $meta_key ] );
		} else {
			delete_post_meta( $post_id, $meta_key );
		}
	}

	$non_unique_meta_keys = array(
		get_project_team_members_meta_key(),
	);

	foreach ( $non_unique_meta_keys as $meta_key ) {
		delete_post_meta( $post_id, $meta_key );

		if ( ! empty( $_POST[ $meta_key ] ) ) {
			foreach ( $_POST[ $meta_key ] as $meta_value ) {
				if ( empty( $meta_value ) ) {
					continue;
				}

				add_post_meta( $post_id, $meta_key, $meta_value, false );
			}
		}
	}
}

add_action( 'save_post', __NAMESPACE__ . '\save_project_meta' );
