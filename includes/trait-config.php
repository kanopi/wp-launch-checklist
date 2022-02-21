<?php

namespace Kanopi\Kanopi_Launch_Checklist;

trait Config {

	/**
	 * Endpoint URL for accessibility options
	 *
	 * @var string $endpoint_url
	 */
	protected string $endpoint_url = 'https://raw.githubusercontent.com/a11yproject/a11yproject.com/main/src/_data/checklists.json';


	/**
	 * Get the contents of a config file.
	 *
	 * @param string $filename
	 *
	 * @return false|array
	 */
	public function get_settings_config_array( string $filename ) {
		$filepath = KANOPI_LAUNCH_CHECKLIST_ROOT . "config/{$filename}.php";

		if ( ! file_exists( $filepath ) ) {
			return false;
		}

		return include KANOPI_LAUNCH_CHECKLIST_ROOT . "config/{$filename}.php";
	}

	/**
	 * Get the accessibility config data and store it in a transient for later use.
	 *
	 * Stored for one month.
	 *
	 * @param bool $force
	 *
	 * @return array
	 */
	public function get_accessibility_project_checklist_config( bool $force = false ) : array {
		$transient_name = 'klc_accessibility_config';

		if ( false === ( $data = get_transient( $transient_name ) ) || true === $force ) {

			// Data for transient.
			if ( empty( $this->endpoint_url ) ) {
				return [];
			}

			$data = $this->get_config_data_from_endpoint();

			// Store in transient for next time.
			set_transient( $transient_name, $data, MONTH_IN_SECONDS );

		}

		return $data;
	}

	/**
	 * Query the endpoint for config data.
	 *
	 * @return array
	 */
	protected function get_config_data_from_endpoint() : array {
		$data = [];
		$response = wp_safe_remote_get(
			$this->endpoint_url,
			[
				'method'             => 'GET',
				'timeout'            => 30,
				'user_agent'         => KANOPI_LAUNCH_CHECKLIST_NAME,
				'reject_unsafe_urls' => true,
			]
		);

		if ( is_wp_error( $response ) ) {
			return $data;
		}

		$response_body = wp_remote_retrieve_body( $response );

		if ( empty( $response_body ) ) {
			return $data;
		}

		$endpoint_data = wp_list_pluck( json_decode( $response_body ), 'tasks', 'checkboxId' );

		if ( empty( $endpoint_data ) ) {
			return $data;
		}

		$data['group_name'] = __( 'Accessibility', 'kanopi' );
		$data['group_slug']   = 'accessibility';
		$data['group_desc'] = __( 'Accessibility checklist items', 'kanopi' );


		// format the accessibility config array to the same format
		// as the plugin's checklist_items.php config file so we can
		// combine it with that array for db storage.
		foreach ( $endpoint_data as $key => $items ) {
			foreach ( $items as $index => $obj ) {
				$data['tasks'][] = [
					'name'        => $obj->checkboxId,
					'label'       => $obj->title,
					'description' => sprintf( '<h4>%s</h4><a href="%s">%s</a>', $obj->description, $obj->url, $obj->wcag ),
				];
			}
		}

		return $data;
	}
}
