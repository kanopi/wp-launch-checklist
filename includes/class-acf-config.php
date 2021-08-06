<?php

namespace Kanopi\Kanopi_Launch_Checklist;

/**
 * The file that defines the ACF Configuration class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://kanopi.com
 * @since      1.0.0
 *
 * @package    Kanopi_Launch_Checklist
 * @subpackage Kanopi_Launch_Checklist/includes
 */

/**
 * ACF Configuration Class.
 *
 * This is used to define alternate acf-json directory location in this plugin
 * to store all plugin related ACF json file needed by the plugin to function.
 *
 * @since      1.0.0
 * @package    ACF_Config
 * @subpackage Kanopi_Launch_Checklist/includes
 * @author     Kanopi Studios <support@kanopistudios.com>
 */
class ACF_Config {

	/**
	 * ACF Group IDs.
	 *
	 * @var array ACF Groups to include in the plugin's acf-json folder.
	 */
	protected $acf_group_ids = array();

	/**
	 * ACF Groups.
	 *
	 * @var array ACF Groups to include in the plugin's acf-json folder.
	 */
	protected $acf_groups = array();

	/**
	 * ACF Current Group.
	 *
	 * @var string The Current ACF group.
	 */
	protected $current_acf_group;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $acf_group_ids = array() ) {
		$this->acf_group_ids = $acf_group_ids;

		if ( ! empty( $this->acf_group_ids ) ) {
			add_action( 'admin_init', array( $this, 'add_field_groups_to_allow_list' ) );
			add_action( 'acf/update_field_group', array( $this, 'update_field_group' ), 1, 1 );
		}
	}

	/**
	 * These specific field groups should only save with the plugin.
	 */
	public function add_field_groups_to_allow_list() {
		foreach ( $this->acf_group_ids as $group_id ) {
			$this->acf_groups[ $group_id ] = KANOPI_LAUNCH_CHECKLIST_ROOT . 'acf-json';
		}
	}

	/**
	 * Set the current field group to determine save location.
	 *
	 * @param array $group The group.
	 *
	 * @return array
	 */
	public function update_field_group( $group ) {
		if ( ! isset( $this->acf_groups[ $group['key'] ] ) ) {
			return $group;
		}

		$this->current_acf_group = $group['key'];
		add_filter( 'acf/settings/save_json', array( $this, 'alternate_acf_json_location' ) );
		add_filter( 'acf/settings/load_json', array( $this, 'alternate_acf_json_location_dir' ) );

		return $group;
	}

	/**
	 * Save ACF JSON to alternate directory path in plugin
	 * so all functionality is maintained outside the theme.
	 *
	 * @return string
	 */
	public function alternate_acf_json_location() {
		return $this->acf_groups[ $this->current_acf_group ];
	}

	/**
	 * Add an additional acf-json directory to load from.
	 *
	 * @param array $paths The directory paths.
	 *
	 * @return array
	 */
	public function alternate_acf_json_location_dir( $paths ) {
		$paths[] = $this->acf_groups[ $this->current_acf_group ];

		return $paths;
	}

	/**
	 * Add an ACF Options page for the plugin.
	 *
	 * NOTE: Fields for the options page are configured via ACF via the WP admin.
	 */
	public function add_options_page() {
		acf_add_options_sub_page(
			array(
				'page_title'  => __( 'Launch Checklist', 'kanopi-launch-checklist' ),
				'menu_title'  => __( 'Launch Checklist', 'kanopi-launch-checklist' ),
				'menu_slug'   => 'kanopi-launch-checklist',
				'parent_slug' => 'options-general.php',
				'capability'  => 'manage_options',
				'redirect'    => false,
			)
		);
	}

}
