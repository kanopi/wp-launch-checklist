<?php

function get_kanopi_launch_checklist_options() {
	return get_option( KANOPI_LAUNCH_CHECKLIST_SLUG . '_values', array() );
}

function get_kanopi_launch_checklist_option( $key ) {
	$options = get_kanopi_launch_checklist_options();

	if ( ! empty( $options ) ) {
		return isset( $options[ $key ] ) ? $options[ $key ] : 0;
	}
}

/**
 * Calculate percentage of checklist items complete, rounding to the nearest integer.
 *
 * @return int
 */
function get_kanopi_launch_checklist_percent_complete() : int {
	$options = get_kanopi_launch_checklist_options();

	if ( ! empty( $options ) ) {
		$total_options = count( $options );
		$options = array_filter( $options, function( $value ) {
			return 1 === intval( $value );
		} );

		return round( count( $options ) / $total_options * 100, 0, PHP_ROUND_HALF_UP );
	}

	return 0;
}

function is_launch_checklist_option_page() {
	global $current_screen;

	return ! empty( $current_screen->id ) && 'toplevel_page_kanopi_launch_checklist' === $current_screen->id;
}

