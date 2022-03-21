<?php

namespace WpLaunchChecklist\Launch_Checklist;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WpLaunchChecklist
 * @subpackage WpLaunchChecklist/includes
 * @author     Kanopi Studios <support@kanopistudios.com>
 */
class Activator {

	/**
	 * @var array
	 */
	protected array $checklist_config;

	/**
	 * @var array
	 */
	protected array $accessibility_config;

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {
		// Any needed activation items here.
	}

}
