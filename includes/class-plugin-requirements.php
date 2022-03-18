<?php

namespace WpLaunchChecklist\Launch_Checklist;

/**
 * Class Plugin_Requirements
 *
 * Check plugin requirements and either continue with initialization
 * or display admin notice.
 *
 * @package WP Launch Checklist
 */
class Plugin_Requirements {

	/**
	 * Plugin name.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $plugin_name;

	/**
	 * Required WordPress Version
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $wp_version;

	/**
	 * Required PHP version.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $php_version;

	/**
	 * The plugin file.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $plugin_file;

	/**
	 * The installed WP version to compare against.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $wp_server_version;

	/**
	 * The installed PHP version to compare against.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $php_server_version;

	/**
	 * The required plugin dependencies.
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	private array $plugin_dependencies = [];

	/**
	 * The missing plugin dependencies.
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	private array $missing_plugin_dependencies = [];

	/**
	 * Construct -- Set properties, etc.
	 *
	 * @param array $args The properties array.
	 *
	 * @since 1.0.0
	 */
	public function __construct( array $args ) {
		foreach ( $args as $key => $value ) {
			$this->{$key} = $value;
		}
	}

	/**
	 * Check to see if the plugin's version requirements are met.
	 *
	 * @return bool
	 * @since 1.0.0
	 *
	 */
	public function plugin_requirements_met() : bool {
		$plugin_requirements_met = $this->php_requirement_met() && $this->wp_requirement_met() && $this->plugin_dependencies_requirement_met();
		if ( false === $plugin_requirements_met ) {
			add_action( 'admin_notices', [ $this, 'deactivate' ], 99 );
		}

		return $plugin_requirements_met;
	}

	/**
	 * Check to see if PHP version requirement is met.
	 *
	 * @return bool
	 * @since 1.0.0
	 *
	 */
	public function php_requirement_met() : bool {
		if ( $this->version_compare( $this->php_server_version, $this->php_version ) ) {
			return true;
		} else {
			add_action( 'admin_notices', [ $this, 'php_requirement_notice' ] );

			return false;
		}
	}

	/**
	 * Compare versions.
	 *
	 * @param string $running_version  Running PHP version.
	 * @param string $required_version Required PHP version.
	 *
	 * @return bool
	 */
	private function version_compare( $running_version, $required_version ) : bool {
		return version_compare( $running_version, $required_version, '>=' );
	}

	/**
	 * Check if the WP version requirement is met.
	 *
	 * @return bool
	 */
	public function wp_requirement_met() : bool {
		if ( $this->version_compare( $this->wp_server_version, $this->wp_version ) ) {
			return true;
		} else {
			add_action( 'admin_notices', [ $this, 'wp_requirement_notice' ] );

			return false;
		}
	}

	/**
	 * Check if the ACF version requirement is met.
	 *
	 * @return bool
	 */
	public function plugin_dependencies_requirement_met() : bool {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		foreach ( $this->plugin_dependencies as $plugin_name => $plugin_path ) {
			if ( true !== is_plugin_active( $plugin_path ) ) {
				$this->missing_plugin_dependencies[] = $plugin_name;
			}
		}

		if ( ! empty( $this->missing_plugin_dependencies ) ) {
			unset( $_GET['activate'] );
			add_action( 'admin_notices', [ $this, 'plugin_dependencies_requirement_notice' ] );

			return false;
		}

		return true;
	}

	/**
	 * Copy for notice if the ACF check doesn't meet the requirement .
	 *
	 * @return bool
	 */
	public function plugin_dependencies_requirement_notice() {
		new Admin_Notice(
			sprintf(
				__( "The %s plugin requires that the following plugins be installed and activated: %s.", WP_LAUNCH_CHECKLIST_SLUG ),
				esc_html( WP_LAUNCH_CHECKLIST_NAME ),
				implode( ', ', $this->missing_plugin_dependencies )
			)
		);
	}

	/**
	 * Deactivate plugins.
	 *
	 * @since 1.0.0
	 */
	public function deactivate() {
		if ( isset( $this->plugin_file ) ) {
			deactivate_plugins( $this->plugin_file );
		}
	}

	/**
	 * Notice copy for when PHP versions requirement is not met.
	 *
	 * @since 1.0.0
	 */
	public function php_requirement_notice() {
		new Admin_Notice(
			sprintf(
			// translators: Plugin name, Required PHP version, and Current PHP version.
				__( '%1$s requires PHP version %2$s +. You are running version %3$s . Please discuss upgrade options with your hosting provider . WordPress recommends PHP version 7+.', WP_LAUNCH_CHECKLIST_SLUG ),
				$this->plugin_name,
				$this->php_version,
				$this->php_server_version
			)
		);
	}

	/**
	 * Copy for notice if the WP version doesn't meet the requirement .
	 *
	 * @return void
	 */
	public function wp_requirement_notice() {
		new Admin_Notice(
			sprintf(
			// translators: Plugin name, Required WordPress version, and Current WordPress version.
				__( '%1$s requires WP version %2$s+. You are running WordPress version %3$s. Please upgrade and reactivate.', WP_LAUNCH_CHECKLIST_SLUG ),
				$this->plugin_name,
				$this->wp_version,
				$this->wp_server_version
			)
		);
	}

}
