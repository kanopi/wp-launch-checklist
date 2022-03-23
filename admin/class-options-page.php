<?php

namespace WpLaunchChecklist\Launch_Checklist;

class Options_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_options_page' ] );
		add_filter( 'wp_redirect', [ $this, 'redirect_to_checklist_group_tab' ] );
		add_action( 'admin_post_refresh_checklist_items', [ $this, 'refresh_checklist_items' ] );
	}

	/**
	 * Add options pages.
	 *
	 * @return void
	 */
	public function add_options_page() {
		add_menu_page( 'Launch Checklist', 'Launch Checklist', 'manage_options', WP_LAUNCH_CHECKLIST_SLUG, [ $this, 'options_page_layout' ] );
		add_submenu_page( WP_LAUNCH_CHECKLIST_SLUG, 'Settings', 'Settings', 'manage_options', WP_LAUNCH_CHECKLIST_SLUG . '_settings', [ $this, 'options_page_settings_layout' ] );
	}

	/**
	 * Load main options page template.
	 *
	 * @return void
	 */
	public function options_page_layout() {
		require_once WP_LAUNCH_CHECKLIST_TEMPLATE_PARTIALS . 'checklist-items/layout.php';
	}

	/**
	 * Load plugin settings page template.
	 *
	 * @return void
	 */
	public function options_page_settings_layout() {
		require_once WP_LAUNCH_CHECKLIST_TEMPLATE_PARTIALS . 'checklist-settings/settings.php';
	}

	/**
	 * Register the settings needed for db storage.
	 *
	 * @return void
	 */
	public function initialize_options() {
		// Checklist Items.
		register_setting( WP_LAUNCH_CHECKLIST_SLUG, WP_LAUNCH_CHECKLIST_SLUG . '_values' );
		$this->setup_checklist_items();

		// Checklist Settings Page.
		register_setting( WP_LAUNCH_CHECKLIST_SLUG . '_settings', WP_LAUNCH_CHECKLIST_SLUG . '_settings' );
		$this->setup_checklist_settings();
	}

	/**
	 * Callback to set up the checklist items
	 * on the main options page.
	 *
	 * @return void
	 */
	protected function setup_checklist_items()  {
		$checklist_items = get_all_checklist_items();

		if ( empty( $checklist_items ) ) {
			return;
		}

		foreach( $checklist_items as $group_slug => $checklist_group ) {
			add_settings_section(
				$group_slug,
				$checklist_group['group_name'],
				'',
				WP_LAUNCH_CHECKLIST_SLUG
			);

			foreach( $checklist_group[ 'tasks' ] as $field ) {
				add_settings_field(
					$field['name'],
					$field['label'],
					[ $this, 'settings_item_callback' ],
					WP_LAUNCH_CHECKLIST_SLUG,
					$group_slug,
					$field,
				);
			}
		}
	}

	/**
	 * Callback to set up the fields
	 * on the plugin settings page.
	 *
	 * @return void
	 */
	protected function setup_checklist_settings() {
		$checklist_settings = get_settings_config_array( 'checklist_settings' );
		$checklist_settings_values = get_option( WP_LAUNCH_CHECKLIST_SLUG . '_settings' );

		if ( empty( $checklist_settings ) ) {
			return;
		}

		add_settings_section(
			'launch-checklist-settings',
			'',
			'',
			WP_LAUNCH_CHECKLIST_SLUG . '_settings'
		);

		foreach( $checklist_settings as $setting ) {
			if ( isset( $checklist_settings_values[ $setting['name'] ] ) ) {
				$setting['value'] = $checklist_settings_values[ $setting['name'] ];
			}
			add_settings_field(
				$setting['name'],
				$setting['title'],
				[ $this, 'settings_field_callback' ],
				WP_LAUNCH_CHECKLIST_SLUG . '_settings',
				'launch-checklist-settings',
				$setting,
			);
		}
	}

	/**
	 * Load the template needed for the checklist items.
	 *
	 * @param array $args The callback args.
	 *
	 * @return void
	 */
	public function settings_item_callback( $args ) {
		if ( file_exists( WP_LAUNCH_CHECKLIST_TEMPLATE_PARTIALS . 'form-fields/checkbox-checklist-items.php' ) ) {
			echo load_template( WP_LAUNCH_CHECKLIST_TEMPLATE_PARTIALS . 'form-fields/checkbox-checklist-items.php', false, $args );
		}
	}

	/**
	 * Dynamically load the template needed for a settings item.
	 *
	 * The $args['type'] determines the form field partial to load
	 * from /admin/partials/form-fields/. More partials can be added
	 * as needed.
	 *
	 * @param array $args The callback args.
	 *
	 * @return void
	 */
	public function settings_field_callback( $args ) {
		$field_type = $args['type'];
		// This array matches the file names without extensions in "admin/partials/form-fields".
		$allowed_types = [
			'checkbox',
			'checkbox-checklist-items',
			'select',
			'text',
		];
		if (in_array($field_type, $allowed_types)) {
			if ( file_exists( WP_LAUNCH_CHECKLIST_TEMPLATE_PARTIALS . "form-fields/{$field_type}.php" ) ) {
				echo load_template( WP_LAUNCH_CHECKLIST_TEMPLATE_PARTIALS . "form-fields/{$field_type}.php", false, $args );
			}
		}
	}

	/**
	 * Prints out all settings sections added to a particular settings page
	 *
	 * Part of the Settings API. Use this in a settings page callback function
	 * to output all the sections and fields that were added to that $page with
	 * add_settings_section() and add_settings_field()
	 *
	 * @global array $wp_settings_sections Storage array of all settings sections added to admin pages.
	 * @global array $wp_settings_fields Storage array of settings fields and info about their pages/sections.
	 * @since 2.7.0
	 *
	 * @param string $page The slug name of the page whose settings sections you want to output.
	 */
	protected function do_checklist_settings_sections( $page ) {
		load_template( WP_LAUNCH_CHECKLIST_TEMPLATE_PARTIALS . 'checklist-items/settings-sections.php', true, [ 'page' => $page, 'options_page' => $this ] );
	}

	/**
	 * Print out the settings fields for a particular settings section.
	 *
	 * Part of the Settings API. Use this in a settings page to output
	 * a specific section. Should normally be called by do_settings_sections()
	 * rather than directly.
	 *
	 * @global array $wp_settings_fields Storage array of settings fields and their pages/sections.
	 *
	 * @since 2.7.0
	 *
	 * @param string $page Slug title of the admin page whose settings fields you want to show.
	 * @param string $section Slug title of the settings section whose fields you want to show.
	 */
	function do_checklist_settings_fields( $page, $section ) {
		global $wp_settings_fields;

		if ( ! isset( $wp_settings_fields[ $page ][ $section ] ) ) {
			return;
		}

		foreach ( (array) $wp_settings_fields[ $page ][ $section ] as $field ) {
			$class = '';

			if ( ! empty( $field['args']['class'] ) ) {
				$class = ' class="' . esc_attr( $field['args']['class'] ) . '"';
			}
			?>

			<div<?php echo $class; ?>>
				<?php call_user_func( $field['callback'], $field['args'] ); ?>
			</div>

			<?php
		}
	}


	/**
	 * Redirect back to the active tab.
	 *
	 * Uses cookies placed in JS.
	 *
	 * @param string $location The redirect location.
	 *
	 * @return string
	 */
	public function redirect_to_checklist_group_tab( $location ) {
		if ( false !== strpos( $location, WP_LAUNCH_CHECKLIST_SLUG . '&settings-updated=true' ) ) {
			$location .= "#{$_COOKIE['wp-checklist-group-tab']}";
		}

		return $location;
	}

	/**
	 * Process the manual refresh of items from the WCAG
	 * accessibility API using the button on the plugin's
	 * settings page.
	 *
	 * @return void
	 */
	public function refresh_checklist_items() {
		if ( ! isset( $_POST['refresh_checklist_items'] ) || ! wp_verify_nonce( $_POST['refresh_checklist_items'], 'refresh_checklist_items' ) ) {
			wp_die( __( 'You should not be doing that!', WP_LAUNCH_CHECKLIST_SLUG ) );
		}

		if ( ! isset( $_POST['action'] ) || 'refresh_checklist_items' !== $_POST['action'] ) {
			return;
		}

		delete_transient( 'wp_launch_checklist_accessibility_config' );

		if ( isset( $_POST['_wp_http_referer'] ) ) {
			wp_safe_redirect( site_url( $_POST[ '_wp_http_referer'] . '&checklist_settings_refreshed=true' . ( isset( $_COOKIE['wp-checklist-group-tab'] ) ? "#{$_COOKIE['wp-checklist-group-tab']}" : '' ) ) );
		}

	}

}
