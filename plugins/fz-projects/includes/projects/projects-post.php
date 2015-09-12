<?php
/**
 * Projects Post Functions.
 *
 * Mostly handles the registering of the Projects post type.
 */

namespace FZ_Projects\Projects;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the Projects Post Type Name.
 *
 * @return string The Projects Post Type Name.
 */
function get_projects_post_type_name() {
	return 'fz_project';
}

/**
 * Returns the Projects Post Type Slug.
 *
 * @return string The Projects Post Type Slug.
 */
function get_projects_post_type_slug() {
	return 'projects';
}

/**
 * Registers the Projects Post Type.
 */
function register_projects_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Projects', 'fzp' ),
		'singular_name'      => esc_html__( 'Project', 'fzp' ),
		'add_new'            => esc_html__( 'Add New', 'fzp' ),
		'add_new_item'       => esc_html__( 'Add New Project', 'fzp' ),
		'edit_item'          => esc_html__( 'Edit Project', 'fzp' ),
		'new_item'           => esc_html__( 'New Project', 'fzp' ),
		'all_items'          => esc_html__( 'All Projects', 'fzp' ),
		'view_item'          => esc_html__( 'View Project', 'fzp' ),
		'search_items'       => esc_html__( 'Search Projects', 'fzp' ),
		'not_found'          => esc_html__( 'No Project found', 'fzp' ),
		'not_found_in_trash' => esc_html__( 'No Project found in Trash', 'fzp' ),
		'parent_item_colon'  => '',
		'menu_name'          => esc_html__( 'Projects', 'fzp' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'description'        => esc_html__( 'Projects', 'jdrf' ),
		'capability_type'    => 'post',
		'map_meta_cap'       => true,
		'hierarchical'       => false,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-portfolio',
		'show_in_menu'       => true,
		'has_archive'        => false,
		'rewrite'            => array(
			'slug'       => get_projects_post_type_slug(),
			'with_front' => false,
		),
		'supports'           => array(
			'title',
			'thumbnail',
			'editor',
			'author',
		),
	);

	register_post_type( get_projects_post_type_name(), $args);
}

add_action( 'fzp_init', __NAMESPACE__ . '\register_projects_post_type' );
