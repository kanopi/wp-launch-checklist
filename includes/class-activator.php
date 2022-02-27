<?php

namespace Kanopi\Kanopi_Launch_Checklist;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Kanopi_Launch_Checklist
 * @subpackage Kanopi_Launch_Checklist/includes
 * @author     Kanopi Studios <support@kanopistudios.com>
 */
class Activator {

	use Config;

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
		$this->checklist_config     = $this->get_settings_config_array( 'checklist_items' );
		$this->accessibility_config = $this->get_accessibility_project_checklist_config();
		$this->checklist_config[]   = $this->accessibility_config;
		$this->maybe_insert_checklist_config();
	}

	/**
	 * When the plugin is activated, check if checklist configuration items are
	 * already in the database. If not, let's insert the initial set so we have
	 * checklist items to build the checklist interface with.
	 */
	protected function maybe_insert_checklist_config() {
		if ( false === get_option( KANOPI_LAUNCH_CHECKLIST_SLUG . '_config' ) ) {
			add_option( KANOPI_LAUNCH_CHECKLIST_SLUG . '_config', $this->checklist_config );
		}
	}

}
