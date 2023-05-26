<?php

namespace WpLaunchChecklist\Launch_Checklist;

/**
 * Get all the checklist items that have values stored.
 *
 * @return string|array
 */
function get_wp_launch_checklist_values() : string|array {
	return get_option( WP_LAUNCH_CHECKLIST_SLUG . '_values', [] );
}

/**
 * Get a specific checklist item value.
 *
 * @param string $key The option key.
 *
 * @return int
 */
function get_wp_launch_checklist_option(string $key ) : int {
	$options = get_wp_launch_checklist_values();
	$value   = 0;

	if ( ! empty( $options ) ) {
		$value = $options[ $key ] ?? 0;
	}

	return intval( $value );
}

/**
 * Calculate percentage of checklist items complete, rounding to the nearest integer.
 *
 * @return int
 */
function get_wp_launch_checklist_percent_complete() : int {
	$options_count = get_options_count();
	$values_count  = get_values_count();

	return round( $values_count / $options_count * 100, 1, PHP_ROUND_HALF_UP );
}

/**
 * Are we on the checklist items option page?
 *
 * @return bool
 */
function is_launch_checklist_option_page() : bool {
	global $current_screen;

	return ! empty( $current_screen->id ) && ( false !== strpos( $current_screen->id, WP_LAUNCH_CHECKLIST_SLUG ) );
}

/**
 * Determine the count of al the checklist items available.
 *
 * @return int
 */
function get_options_count() : int {
	$options = get_all_checklist_items();
	$count   = 0;

	if ( ! empty( $options ) ) {
		$options = wp_list_pluck( $options, 'tasks' );

		foreach ( $options as $option_array ) {
			$count += count( $option_array );
		}
	}

	return absint( $count );
}

/**
 * Determine the count of the items checked.
 *
 * @return int
 */
function get_values_count() : int {
	$values = get_wp_launch_checklist_values();
	$count = 0;

	if ( ! empty( $values ) ) {
		$count = count( array_filter( $values, function( $value ) {
			return 1 === intval( $value );
		} ) );
	}

	return absint( $count );
}

/**
 * Display a % completed statement at the top of the options page.
 *
 * @return string
 */
function launch_checklist_percent_complete_overview() : string {
	return sprintf(
		'Completed: <span class="num-checked">%d</span> of <span class="total-checklist-items">%d</span> (<span class="percent-complete">%d</span>%%)',
		get_values_count(),
		get_options_count(),
		get_wp_launch_checklist_percent_complete()
	);
}

/**
 * Get the contents of a config file.
 *
 * @param string $filename
 *
 * @return false|array
 */
function get_settings_config_array( string $filename ) : array {
	$filepath = WP_LAUNCH_CHECKLIST_ROOT . "config/{$filename}.php";

	if ( ! file_exists( $filepath ) ) {
		return false;
	}

	return include WP_LAUNCH_CHECKLIST_ROOT . "config/{$filename}.php";
}

/**
 * Get all checklist items;
 *
 * Combine those from the plugin config and
 * accessibility items obtained from the WCAG API.
 *
 * @return array
 */
function get_all_checklist_items( $force = false ) : array {
	$wcag = new WCAG();
	$accessibility_checklist_items = $wcag->get_checklist_items( $force );
	$checklist_items = get_settings_config_array( 'checklist_items' );

	if ( isset( $checklist_items['accessibility']['tasks'] ) ) {
		$checklist_items['accessibility']['tasks'] += $accessibility_checklist_items['tasks'];
	} else {
		$checklist_items['accessibility'] = $accessibility_checklist_items;
	}

	return $checklist_items;
}

