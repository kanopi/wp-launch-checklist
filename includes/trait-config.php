<?php

namespace Kanopi\Kanopi_Launch_Checklist;

trait Config {

	/**
	 * Get the contents of a config file.
	 *
	 * @param string $filename
	 *
	 * @return false|array
	 */
	public function get_config( string $filename ) {
		$filepath = KANOPI_LAUNCH_CHECKLIST_ROOT . "config/{$filename}.php";

		if ( ! file_exists( $filepath ) ) {
			return false;
		}

		return require_once KANOPI_LAUNCH_CHECKLIST_ROOT . "config/{$filename}.php";
	}
}
