<?php
/**
 * Team Members Post Functions.
 *
 * Mostly handles the registering of the Team Members post type.
 */

namespace FZ_Projects\Team_Members;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the Team Members Post Type Name.
 *
 * @return string The Team Members Post Type Name.
 */
function get_team_members_post_type_name() {
	return 'fz_team_member';
}

/**
 * Returns the Team Members Post Type Slug.
 *
 * @return string The Team Members Post Type Slug.
 */
function get_team_members_post_type_slug() {
	return 'team-members';
}

/**
 * Registers the Team Members Post Type.
 */
function register_team_members_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Team Members', 'fzp' ),
		'singular_name'      => esc_html__( 'Team Member', 'fzp' ),
		'add_new'            => esc_html__( 'Add New', 'fzp' ),
		'add_new_item'       => esc_html__( 'Add New Team Member', 'fzp' ),
		'edit_item'          => esc_html__( 'Edit Team Member', 'fzp' ),
		'new_item'           => esc_html__( 'New Team Member', 'fzp' ),
		'all_items'          => esc_html__( 'All Team Members', 'fzp' ),
		'view_item'          => esc_html__( 'View Team Member', 'fzp' ),
		'search_items'       => esc_html__( 'Search Team Members', 'fzp' ),
		'not_found'          => esc_html__( 'No Team Member found', 'fzp' ),
		'not_found_in_trash' => esc_html__( 'No Team Member found in Trash', 'fzp' ),
		'parent_item_colon'  => '',
		'menu_name'          => esc_html__( 'Team Members', 'fzp' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'description'        => esc_html__( 'Team Member', 'jdrf' ),
		'capability_type'    => 'post',
		'map_meta_cap'       => true,
		'hierarchical'       => false,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-groups',
		'show_in_menu'       => true,
		'has_archive'        => false,
		'rewrite'            => array(
			'slug'       => get_team_members_post_type_slug(),
			'with_front' => false,
		),
		'supports'           => array(
			'title',
			'thumbnail',
			'editor',
			'author',
		),
	);

	register_post_type( get_team_members_post_type_name(), $args);
}

add_action( 'fzp_init', __NAMESPACE__ . '\register_team_members_post_type' );
