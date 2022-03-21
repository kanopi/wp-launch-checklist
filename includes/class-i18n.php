<?php

namespace WpLaunchChecklist\Launch_Checklist;

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://kanopi.com
 * @since      1.0.0
 *
 * @package    WpLaunchChecklist
 * @subpackage WpLaunchChecklist/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    WpLaunchChecklist
 * @subpackage WpLaunchChecklist/includes
 * @author     Kanopi Studios <support@kanopistudios.com>
 */
class i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			WP_LAUNCH_CHECKLIST_SLUG,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
