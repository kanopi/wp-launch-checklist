<?php

namespace Kanopi\Kanopi_Launch_Checklist;

class Options_Page {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_options_page' ] );
	}

	public function add_options_page() {
		add_menu_page( 'Launch Checklist', 'Launch Checklist', 'manage_options', KANOPI_LAUNCH_CHECKLIST_SLUG, [ $this, 'options_page_layout' ] );
	}

	public function options_page_layout() {
		require_once KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/layout.php';
	}

	public function initialize_options() {
		register_setting( KANOPI_LAUNCH_CHECKLIST_SLUG, KANOPI_LAUNCH_CHECKLIST_SLUG . '_values' );

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

			foreach( $checklist_group[ 'items' ] as $field ) {
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

}
