<?php

/**
 * Kanopi Resource Library primary term.
 *
 * @param number $id       which post ID to use.
 * @param string $taxonomy which taxonomy to use.
 *
 * @return \WP_Term
 */
function kanopi_resource_library_primary_term( $id = null, string $taxonomy = 'category' ) {
	if ( yoast_get_primary_term_id( $taxonomy, $id ) ) {
		$term = get_term( yoast_get_primary_term_id( $taxonomy, $id ) );
	} else {
		$terms = get_the_terms( $id, $taxonomy );
		$term  = $terms[0];
	}

	return $term;
}

function kanopi_launch_checklist_get_config_array() {
	return array(
		'acf_field_groups' => array(
			'group_610d5f17e1e8e',
			'group_610d53484e2a8',
		),
	);
}

/**
 * Get a config setting based on the array key.
 *
 * @param string $key The config array key.
 *
 * @return array
 */
function kanopi_launch_checklist_get_config_setting( string $key ) {
	$config = kanopi_launch_checklist_get_config_array();

	return ( isset( $config[ $key ] ) ) ? $config[ $key ] : array();
}
