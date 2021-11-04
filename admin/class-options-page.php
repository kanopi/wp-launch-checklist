<?php

namespace Kanopi\Kanopi_Launch_Checklist;

class Options_Page {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_options_page' ] );
	}

	public function add_options_page() {
		add_menu_page( 'Launch Checklist', 'Launch Checklist', 'manage_options', KANOPI_LAUNCH_CHECKLIST_NAME, [ $this, 'options_page_layout' ] );
	}

	public function options_page_layout() {
		require_once KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/layout.php';
	}

	public function initialize_options() {
		register_setting( KANOPI_LAUNCH_CHECKLIST_NAME, KANOPI_LAUNCH_CHECKLIST_NAME . '_values' );

		$checklist_data = get_option( KANOPI_LAUNCH_CHECKLIST_NAME . '_config' );

		if ( empty( $checklist_data ) ) {
			return;
		}

		foreach( $checklist_data as $checklist_group ) {
			add_settings_section(
				$checklist_group['group_slug'],
				$checklist_group['group_name'],
				[ $this, 'settings_section_callback' ],
				KANOPI_LAUNCH_CHECKLIST_NAME
			);

			foreach( $checklist_group[ 'items' ] as $field ) {
				add_settings_field(
					$field['name'],
					$field['title'],
					[ $this, 'settings_field_callback' ],
					KANOPI_LAUNCH_CHECKLIST_NAME,
					$checklist_group['group_slug']
				);
			}
		}


	}


	public function settings_section_callback() {
		require_once KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/settings-section.php';
	}


	public function settings_field_callback() {
		require_once KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/settings-fields.php';
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
	protected function do_settings_sections_fields( $page ) {
		global $wp_settings_sections, $wp_settings_fields;

		if ( ! isset( $wp_settings_sections[ $page ] ) ) {
			return;
		}

		foreach ( (array) $wp_settings_sections[ $page ] as $section ) {
			if ( $section['title'] ) {
				echo "<h2>{$section['title']}</h2>\n";
			}

			if ( $section['callback'] ) {
				call_user_func( $section['callback'], $section );
			}

			if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[ $page ] ) || ! isset( $wp_settings_fields[ $page ][ $section['id'] ] ) ) {
				continue;
			}

			$this->do_settings_fields( $page, $section['id'] );
		}
	}


	protected function do_settings_fields( $page, $section_id ) {
		$checklist_data = get_option( KANOPI_LAUNCH_CHECKLIST_NAME . '_config' );

		if ( empty( $checklist_data ) ) {
			return;
		}

		foreach( $checklist_data as $checklist_group ) {
			foreach( $checklist_group[ 'items' ] as $field ) {
				?>
				<div class="field-group">
					<label for="<?php echo esc_attr( $field['name'] ) ?>">
						<input class="launch-checklist-item" id="<?php echo esc_attr( $field['name'] ) ?>" type="checkbox" name="<?php echo esc_attr( $field['name'] ) ?>" <?php checked( false ); ?> value="1">
						<?php echo esc_html( $field['label'] ); ?>
					</label>
				</div>
				<?php
			}
		}

	}

}
