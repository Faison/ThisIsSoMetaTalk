<?php
/**
 * Project Template Tags.
 *
 * These are used for getting meta values to use in templates and other stuff.
 */

namespace FZ_Projects\Projects;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the Project's Tagline.
 *
 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return string|bool The Project's Tagline, and empty string if empty, or false if we don't have a valid post.
 */
function get_project_tagline( $post = 0 ) {
	$post = get_post( $post );

	if ( empty( $post ) ) {
		return false;
	}

	// This check is just a trick to allow some default data throughout the talk, not for production code!
	if ( ! function_exists( __NAMESPACE__ . '\get_project_tagline_meta_key' ) ) {
		return 'Super Cool Stuffs!';
	}

	$tagline = get_post_meta( $post->ID, get_project_tagline_meta_key(), true );

	if ( empty( $tagline ) ) {
		return '';
	}

	return $tagline;
}

/**
 * Returns the Project's Github URL.
 *
 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return string|bool The Project's Github URL, and empty string if empty, or false if we don't have a valid post.
 */
function get_project_github_url( $post = 0 ) {
	$post = get_post( $post );

	if ( empty( $post ) ) {
		return false;
	}

	// This check is just a trick to allow some default data throughout the talk, not for production code!
	if ( ! function_exists( __NAMESPACE__ . '\get_project_github_meta_key' ) ) {
		return '#';
	}

	$github_url = get_post_meta( $post->ID, get_project_github_meta_key(), true );

	if ( empty( $github_url ) ) {
		return '';
	}

	return $github_url;
}

/**
 * Returns the Project's Project Lead.
 *
 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return array|bool The Project's Project Lead, and empty string if empty, or false if we don't have a valid post.
 */
function get_project_lead( $post = 0 ) {
	$post = get_post( $post );

	if ( empty( $post ) ) {
		return false;
	}

	if ( ! function_exists( __NAMESPACE__ . '\get_project_lead_meta_key' ) ) {
		return array(
			'title'        => 'Person 1',
			'permalink'    => '#',
			'image_src'    => 'https://placeholdit.imgix.net/~text?&w=200&h=200',
			'project_lead' => true,
		);
	}

	$project_lead_id   = get_post_meta( $post->ID, get_project_lead_meta_key(), true );

	if ( empty( $project_lead_id ) ) {
		return array();
	}

	$project_lead_post = get_post( $project_lead_id );

	if ( empty( $project_lead_post ) ) {
		return array();
	}

	$project_lead = array(
		'title'        => $project_lead_post->post_title,
		'permalink'    => get_permalink( $project_lead_id ),
		'project_lead' => true,
	);

	if ( has_post_thumbnail( $project_lead_id ) ) {
		$image_id  = get_post_thumbnail_id( $project_lead_id );
		$image_src = wp_get_attachment_image_src( $image_id, 'full' );

		if ( ! empty( $image_src ) ) {
			$project_lead['image_src'] = $image_src[0];
		}
	}

	return $project_lead;
}



/**
 * Returns the Project's Team Members.
 *
 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return array|bool The Project's Team Members, and empty string if empty, or false if we don't have a valid post.
 */
function get_project_team_members( $post = 0 ) {
	$post = get_post( $post );

	if ( empty( $post ) ) {
		return false;
	}

	$team_members = array(
		array(
			'title'        => 'Person 2',
			'permalink'    => '#',
			'image_src'    => 'https://placeholdit.imgix.net/~text?&w=200&h=200',
			'project_lead' => false,
		),
		array(
			'title'        => 'Person 3',
			'permalink'    => '#',
			'image_src'    => 'https://placeholdit.imgix.net/~text?&w=200&h=200',
			'project_lead' => false,
		),
		array(
			'title'        => 'Person 4',
			'permalink'    => '#',
			'image_src'    => 'https://placeholdit.imgix.net/~text?&w=200&h=200',
			'project_lead' => false,
		),
	);

	return $team_members;
}
