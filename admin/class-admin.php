<?php

namespace WpLaunchChecklist\Launch_Checklist;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://kanopi.com
 * @since      1.0.0
 *
 * @package    WpLaunchChecklist
 * @subpackage WpLaunchChecklist/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WpLaunchChecklist
 * @subpackage WpLaunchChecklist/admin
 * @author     Kanopi Studios <support@kanopistudios.com>
 */
class Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @var      string $plugin_name The ID of this plugin.
	 * @since    1.0.0
	 * @access   private
	 */
	private string $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @var      string $version The current version of this plugin.
	 * @since    1.0.0
	 * @access   private
	 */
	private string $version;


	/**
	 * The checklist configuration array.
	 *
	 * @var      array $checklist_config The checklist configuration array.
	 * @since    1.0.0
	 * @access   private
	 */
	private array $checklist_config;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name      = $plugin_name;
		$this->version          = $version;
		$this->checklist_config = get_settings_config_array( 'checklist_items' );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		global $current_screen;
		if ( is_launch_checklist_option_page() ) {
			wp_enqueue_style(
				$this->plugin_name,
				plugin_dir_url( __FILE__ ) . 'css/wp-launch-checklist-admin.css',
				[],
				$this->version,
				'all'
			);
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/wp-launch-checklist-admin.js',
			[ 'jquery' ],
			$this->version,
			false
		);

	}

}
