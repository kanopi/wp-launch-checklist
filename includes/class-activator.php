<?php

namespace Kanopi\Kanopi_Launch_Checklist;

/**
 * Fired during plugin activation
 *
 * @link       https://kanopi.com
 * @since      1.0.0
 *
 * @package    Kanopi_Launch_Checklist
 * @subpackage Kanopi_Launch_Checklist/includes
 */

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
	 * @var false|mixed|void
	 */
	protected $checklist_data;

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {
		$this->checklist_data = $this->get_config( 'checklist_items' );
		$this->maybe_insert_checklist_data();
	}

	/**
	 * When the plugin is activated, check if checklist items are already
	 * in the database. If not, let's insert the initial set so we have
	 * data to work with.
	 */
	protected function maybe_insert_checklist_data() {
		if ( false === get_option( KANOPI_LAUNCH_CHECKLIST_SLUG . '_config' ) ) {
			update_option( KANOPI_LAUNCH_CHECKLIST_SLUG . '_config', $this->checklist_data );
		}
	}

}
