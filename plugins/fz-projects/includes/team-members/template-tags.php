<?php
/**
 * Team Members Template Tags.
 *
 * These are used for getting meta values to use in templates and other stuff.
 */

namespace FZ_Projects\Team_Members;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the Team Member's Title.
 *
 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return string|bool The Team Member's Title, and empty string if empty, or false if we don't have a valid post.
 */
function get_team_member_title( $post = 0 ) {
	$post = get_post( $post );

	if ( empty( $post ) ) {
		return false;
	}

	// This check is just a trick to allow some default data throughout the talk, not for production code!
	if ( ! function_exists( __NAMESPACE__ . '\get_team_member_title_meta_key' ) ) {
		return 'Code Spelunker';
	}

	$title = get_post_meta( $post->ID, get_team_member_title_meta_key(), true );

	if ( empty( $title ) ) {
		return '';
	}

	return $title;
}

/**
 * Returns the Team Member's Twitter URL.
 *
 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return string|bool The Team Member's Twitter URL, and empty string if empty, or false if we don't have a valid post.
 */
function get_team_member_twitter_url( $post = 0 ) {
	$post = get_post( $post );

	if ( empty( $post ) ) {
		return false;
	}

	// This check is just a trick to allow some default data throughout the talk, not for production code!
	if ( ! function_exists( __NAMESPACE__ . '\get_team_member_twitter_meta_key' ) ) {
		return '#';
	}

	$twitter_url = get_post_meta( $post->ID, get_team_member_twitter_meta_key(), true );

	if ( empty( $twitter_url ) ) {
		return '';
	}

	return 'https://twitter.com/' . $twitter_url;
}

/**
 * Returns the Team Member's Github Profile URL.
 *
 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return string|bool The Team Member's Github Profile URL, and empty string if empty, or false if we don't have a valid post.
 */
function get_team_member_github_url( $post = 0 ) {
	$post = get_post( $post );

	if ( empty( $post ) ) {
		return false;
	}

	// This check is just a trick to allow some default data throughout the talk, not for production code!
	if ( ! function_exists( __NAMESPACE__ . '\get_team_member_github_meta_key' ) ) {
		return '#';
	}

	$github_url = get_post_meta( $post->ID, get_team_member_github_meta_key(), true );

	if ( empty( $github_url ) ) {
		return '';
	}

	return $github_url;
}

/**
 * Returns the Team Member's WordPress Profile URL.
 *
 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return string|bool The Team Member's WordPress Profile URL, and empty string if empty, or false if we don't have a valid post.
 */
function get_team_member_wordpress_url( $post = 0 ) {
	$post = get_post( $post );

	if ( empty( $post ) ) {
		return false;
	}

	// This check is just a trick to allow some default data throughout the talk, not for production code!
	if ( ! function_exists( __NAMESPACE__ . '\get_team_member_wordpress_meta_key' ) ) {
		return '#';
	}

	$wordpress_url = get_post_meta( $post->ID, get_team_member_wordpress_meta_key(), true );

	if ( empty( $wordpress_url ) ) {
		return '';
	}

	return $wordpress_url;
}

/**
 * Returns the Team Member's Projects.
 *
 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return array|bool The Team Member's Projects, and empty string if empty, or false if we don't have a valid post.
 */
function get_team_member_projects( $post = 0 ) {
	$post = get_post( $post );

	if ( empty( $post ) ) {
		return false;
	}

	if ( ! function_exists( 'FZ_Projects\Projects\get_project_lead_meta_key' ) || ! function_exists( 'FZ_Projects\Projects\get_project_team_members_meta_key' ) ) {
		return array(
			array(
				'title'        => 'Project 1',
				'permalink'    => '#',
				'image_src'    => FZP_URL . '/assets/images/default.png',
				'project_lead' => true,
			),
			array(
				'title'        => 'Project 2',
				'permalink'    => '#',
				'image_src'    => FZP_URL . '/assets/images/default.png',
				'project_lead' => false,
			),
			array(
				'title'        => 'Project 3',
				'permalink'    => '#',
				'image_src'    => FZP_URL . '/assets/images/default.png',
				'project_lead' => false,
			),
			array(
				'title'        => 'Project 4',
				'permalink'    => '#',
				'image_src'    => FZP_URL . '/assets/images/default.png',
				'project_lead' => false,
			),
		);
	}

	$projects = array();

	$lead_query = new \WP_Query( array(
		'post_type' => \FZ_Projects\Projects\get_projects_post_type_name(),
		'meta_query' => array(
			array(
				'key'     => \FZ_Projects\Projects\get_project_lead_meta_key(),
				'compare' => 'like',
				'value'   => $post->ID,
			)
		)
	) );

	if ( $lead_query->have_posts() ) {
		foreach ( $lead_query->posts as $project_post ) {
			$project = array(
				'title'        => $project_post->post_title,
				'permalink'    => get_permalink( $project_post->ID ),
				'project_lead' => true,
			);

			if ( has_post_thumbnail( $project_post->ID ) ) {
				$image_id  = get_post_thumbnail_id( $project_post->ID );
				$image_src = wp_get_attachment_image_src( $image_id, 'full' );

				if ( ! empty( $image_src ) ) {
					$project['image_src'] = $image_src[0];
				}
			}

			$projects[] = $project;
		}
	}

	$projects_query = new \WP_Query( array(
		'post_type' => \FZ_Projects\Projects\get_projects_post_type_name(),
		'meta_query' => array(
			array(
				'key'     => \FZ_Projects\Projects\get_project_team_members_meta_key(),
				'compare' => '=',
				'type'    => 'NUMERIC',
				'value'   => $post->ID,
			)
		)
	) );

	if ( $projects_query->have_posts() ) {
		foreach ( $projects_query->posts as $project_post ) {
			$project = array(
				'title'        => $project_post->post_title,
				'permalink'    => get_permalink( $project_post->ID ),
				'project_lead' => false,
			);

			if ( has_post_thumbnail( $project_post->ID ) ) {
				$image_id  = get_post_thumbnail_id( $project_post->ID );
				$image_src = wp_get_attachment_image_src( $image_id, 'full' );

				if ( ! empty( $image_src ) ) {
					$project['image_src'] = $image_src[0];
				}
			}

			$projects[] = $project;
		}
	}

	return $projects;
}
