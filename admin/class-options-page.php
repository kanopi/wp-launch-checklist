<?php

namespace Kanopi\Kanopi_Launch_Checklist;

class Options_Page {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_options_page' ] );
	}

	public function add_options_page() {
		add_menu_page( 'Launch Checklist', 'Launch Checklist', 'manage_options', KANOPI_LAUNCH_CHECKLIST_SLUG, [ $this, 'options_page_layout' ] );
		add_submenu_page( KANOPI_LAUNCH_CHECKLIST_SLUG, 'Settings', 'Settings', 'manage_options', KANOPI_LAUNCH_CHECKLIST_SLUG . '_settings', [ $this, 'options_page_settings_layout' ] );
	}

	public function options_page_layout() {
		require_once KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/layout.php';
	}

	public function options_page_settings_layout() {
		require_once KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/settings.php';
	}

	public function initialize_options() {
		register_setting( KANOPI_LAUNCH_CHECKLIST_SLUG, KANOPI_LAUNCH_CHECKLIST_SLUG . '_values' );
		register_setting( KANOPI_LAUNCH_CHECKLIST_SLUG, KANOPI_LAUNCH_CHECKLIST_SLUG . '_settings' );

		$checklist_data = get_option( KANOPI_LAUNCH_CHECKLIST_SLUG . '_config', array() );

		if ( empty( $checklist_data ) || ! is_array( $checklist_data ) ) {
			return;
		}

		foreach( $checklist_data as $checklist_group ) {
			add_settings_section(
				$checklist_group['group_slug'],
				$checklist_group['group_name'],
				'',
				KANOPI_LAUNCH_CHECKLIST_SLUG
			);

			foreach( $checklist_group[ 'tasks' ] as $field ) {
				add_settings_field(
					$field['name'],
					$field['title'],
					[ $this, 'settings_field_callback' ],
					KANOPI_LAUNCH_CHECKLIST_SLUG,
					$checklist_group['group_slug'],
					$field,
				);
			}
		}


	}


	public function settings_field_callback( $args ) {
		echo load_template( KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/settings-fields.php', false, $args );
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
		load_template( KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/settings-sections.php', true, [ 'page' => $page, 'options_page' => $this ] );
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

}
