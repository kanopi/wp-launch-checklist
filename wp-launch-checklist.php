<?php

namespace WpLaunchChecklist\Launch_Checklist;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://kanopi.com
 * @since             1.0.0
 * @package           WpLaunchChecklist
 *
 * @wordpress-plugin
 * Plugin Name:       Launch Checklist
 * Plugin URI:        https://github.com/kanopi/wp-launch-checklist
 * Description:       Creates an interactive launch checklist.
 * Version:           1.0.4
 * Author:            Kanopi Studios
 * Author URI:        https://kanopi.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-launch-checklist
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_LAUNCH_CHECKLIST_VERSION', '1.0.4' );

/**
 * Root path to the plugin files.
 */
define( 'WP_LAUNCH_CHECKLIST_ROOT', trailingslashit( plugin_dir_path( __FILE__ ) ) );

/**
 * Root path to the plugin files.
 */
define( 'WP_LAUNCH_CHECKLIST_TEMPLATE_PARTIALS', trailingslashit( WP_LAUNCH_CHECKLIST_ROOT . 'admin/partials' ) );

/**
 * Plugin name.
 */
define( 'WP_LAUNCH_CHECKLIST_NAME', 'WP Launch Checklist' );

/**
 * Plugin options table settings slug.
 */
define( 'WP_LAUNCH_CHECKLIST_SLUG', 'wp_launch_checklist' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-launch-checklist-activator.php
 */
function activate_wp_launch_checklist() {
	require_once WP_LAUNCH_CHECKLIST_ROOT . 'includes/class-activator.php';
	$activator = new Activator;
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-launch-checklist-deactivator.php
 */
function deactivate_wp_launch_checklist() {
	require_once WP_LAUNCH_CHECKLIST_ROOT . 'includes/class-deactivator.php';
	$deactivator = new Deactivator;
	$deactivator->deactivate();
}

/**
 * The code that runs during plugin uninstall (deactivation and deletion).
 * This action is documented in includes/class-wp-launch-checklist-uninstaller.php
 */
function uninstall_wp_launch_checklist() {
	require_once WP_LAUNCH_CHECKLIST_ROOT . 'includes/class-uninstaller.php';
	$uninstaller = new Uninstaller;
	$uninstaller->uninstall();
}

register_activation_hook( __FILE__, 'WpLaunchChecklist\Launch_Checklist\activate_wp_launch_checklist');
register_deactivation_hook( __FILE__, 'WpLaunchChecklist\Launch_Checklist\deactivate_wp_launch_checklist');
register_uninstall_hook( __FILE__, 'WpLaunchChecklist\Launch_Checklist\uninstall_wp_launch_checklist');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require WP_LAUNCH_CHECKLIST_ROOT . 'includes/class-wp-launch-checklist.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_launch_checklist() {
	require_once( WP_LAUNCH_CHECKLIST_ROOT . 'vendor/autoload.php' );

	$requirements = new Plugin_Requirements(
		[
			'plugin_name'         => WP_LAUNCH_CHECKLIST_NAME,
			'php_version'         => '8.0',
			'wp_version'          => '5.5',
			'plugin_file'         => __FILE__,
			'php_server_version'  => phpversion(),
			'wp_server_version'   => get_bloginfo( 'version' ),
			'plugin_dependencies' => [],
		]
	);

	if ( $requirements->plugin_requirements_met() ) {
		$plugin = new Launch_Checklist();
		$plugin->run();
	}
}

/**
 * Let's start this party.
 */
run_wp_launch_checklist();
