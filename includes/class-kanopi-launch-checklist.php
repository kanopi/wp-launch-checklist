<?php

namespace Kanopi\Kanopi_Launch_Checklist;

/**
 * The file that defines the core plugin class
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
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Kanopi_Launch_Checklist
 * @subpackage Kanopi_Launch_Checklist/includes
 * @author     Kanopi Studios <support@kanopistudios.com>
 */
class Kanopi_Launch_Checklist {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @var      Loader $loader Maintains and registers all hooks for the plugin.
	 * @since    1.0.0
	 * @access   protected
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 * @since    1.0.0
	 * @access   protected
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @var      string $version The current version of the plugin.
	 * @since    1.0.0
	 * @access   protected
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'Kanopi_Launch_Checklist_VERSION' ) ) {
			$this->version = Kanopi_Launch_Checklist_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'kanopi-launch-checklist';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Loader. Orchestrates the hooks of the plugin.
	 * - i18n. Defines internationalization functionality.
	 * - Admin. Defines all hooks for the admin area.
	 * - Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		require_once( KANOPI_LAUNCH_CHECKLIST_ROOT . 'vendor/autoload.php' );

		$this->loader = new Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		// Post types.
		$post_types = new Post_Types();
		$this->loader->add_action( 'init', $post_types, 'init' );

		// Admin scripts and styles.
		$plugin_admin = new Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// ACF plugin configuration.
		$config     = kanopi_launch_checklist_get_config_setting( 'acf_field_groups' );
		$acf_config = new ACF_Config( $config );
		$this->loader->add_action( 'admin_init', $acf_config, 'add_field_groups_to_allow_list' );
		$this->loader->add_action( 'acf/init', $acf_config, 'add_options_page' );
		$this->loader->add_action( 'acf/update_field_group', $acf_config, 'update_field_group', 1, 1 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version() {
		return $this->version;
	}

}
