<?php

namespace Kanopi\Kanopi_Launch_Checklist;

trait Config {

	public function get_config( $filename ) {
		$config = include KANOPI_LAUNCH_CHECKLIST_ROOT . "config/{$filename}.php";

		return $config;
	}
}
