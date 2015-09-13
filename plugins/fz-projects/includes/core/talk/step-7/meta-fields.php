<?php
/**
 * Core Meta Field Functions.
 */

namespace FZ_Projects\Core;

/**
 * Generic function for displaying a text meta field.
 *
 * @param string $meta_key   The meta key.
 * @param string $meta_label The Label for the meta field.
 * @param int    $post_id    The current post id.
 */
function display_text_meta_field( $meta_key, $meta_label, $post_id ) {
	if ( empty( $meta_key ) || empty( $meta_label ) || empty( $post_id ) ) {
		return;
	}

	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( empty( $meta_value ) ) {
		$meta_value = '';
	}

	printf(
		'<div class="fz-meta-field"><label for="%1$s_id">%2$s</label><input type="text" class="regular-text" id="%1$s_id" name="%1$s" value="%3$s" /></div>',
		esc_attr( $meta_key ),
		esc_html( $meta_label ),
		esc_attr( $meta_value )
	);
}
