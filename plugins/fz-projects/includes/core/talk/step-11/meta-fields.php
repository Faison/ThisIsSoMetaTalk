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

/**
 * Generic function for displaying a DropDown meta field.
 *
 * @param string $meta_key   The meta key.
 * @param string $meta_label The Label for the meta field.
 * @param array  $options    The options for the meta field.
 * @param int    $post_id    The current post id.
 */
function display_dropdown_meta_field( $meta_key, $meta_label, $options, $post_id ) {
	if ( empty( $meta_key ) || empty( $meta_label ) || empty( $options ) || empty( $post_id ) ) {
		return;
	}

	if ( ! is_array( $options ) ) {
		return;
	}

	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( empty( $meta_value ) ) {
		$meta_value = '';
	}

	printf(
		'<div class="fz-meta-field"><label for="%1$s_id">%2$s</label><select id="%1$s_id" name="%1$s">',
		esc_attr( $meta_key ),
		esc_html( $meta_label )
	);

	echo '<option value="">- Select One -</option>';

	foreach ( $options as $val => $label ) {
		printf(
			'<option value="%1$s" %3$s>%2$s</option>',
			esc_attr( $val ),
			esc_html( $label ),
			selected( $meta_value, $val, false )
		);
	}

	echo '</select></div>';
}

/**
 * Generic function for displaying a DropDown List meta field.
 *
 * @todo: add a hidden template select that can be targetted by js for adding.
 *
 * @param string $meta_key   The meta key.
 * @param string $meta_label The Label for the meta field.
 * @param array  $options    The options for the meta field.
 * @param int    $post_id    The current post id.
 */
function display_dropdown_list_meta_field( $meta_key, $meta_label, $options, $post_id ) {
	if ( empty( $meta_key ) || empty( $meta_label ) || empty( $options ) || empty( $post_id ) ) {
		return;
	}

	if ( ! is_array( $options ) ) {
		return;
	}

	$meta_values = get_post_meta( $post_id, $meta_key, false );

	if ( empty( $meta_values ) ) {
		$meta_values = array();
	}

	printf(
		'<div class="fz-meta-field js-fz-meta-field"><label>%1$s</label><ul class="fz-dropdown-list js-fz-dropdown-list">',
		esc_attr( $meta_label )
	);

	foreach ( $meta_values as $meta_value ) {
		printf(
			'<li><select name="%1$s[]">',
			esc_attr( $meta_key )
		);

		echo '<option value="">- Select One -</option>';

		foreach ( $options as $val => $label ) {
			printf(
				'<option value="%1$s" %3$s>%2$s</option>',
				esc_attr( $val ),
				esc_html( $label ),
				selected( $meta_value, $val, false )
			);
		}

		echo '</select><a class="dashicons dashicons-dismiss fz-remove js-fz-remove"></a></li>';
	}

	printf(
		'<li><select name="%1$s[]">',
		esc_attr( $meta_key )
	);

	echo '<option value="">- Select One -</option>';

	foreach ( $options as $val => $label ) {
		printf(
			'<option value="%1$s">%2$s</option>',
			esc_attr( $val ),
			esc_html( $label )
		);
	}

	echo '</select><a class="dashicons dashicons-dismiss fz-remove js-fz-remove"></a></li>';

	echo '</ul><br />';

	echo '<a class="button button-primary button-large fz-dropdown-list-add js-fz-dropdown-list-add">Add</a>';

	echo '</div>';
}
