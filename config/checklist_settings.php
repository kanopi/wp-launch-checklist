<?php

/**
 * Checklist items organized by group.
 */
return [
	[
		'name'        => 'delete_checklist_settings',
		'title'       => __( 'Delete all plugin settings when uninstalled?', WP_LAUNCH_CHECKLIST_SLUG ),
		'label'       => __( '(this cannot be undone)', WP_LAUNCH_CHECKLIST_SLUG ),
		'description' => '',
		'type'        => 'checkbox',
	],

	/*
	 * The following are just test fields to let you know how these should be set up.
	 * The 'type' key determines the type of partial included from admin/partials/form-fields/
	 */
	//[
	//	'name'        => 'test_textfield',
	//	'title'       => __( 'This is a test text field for setting entry.', 'wp_launch_checklist' ),
	//	'label'       => __( 'This is the label.', 'wp_launch_checklist' ),
	//	'description' => __( 'This is the description', 'wp_launch_checklist' ),
	//	'type'        => 'text',
	//],
	//[
	//	'name'        => 'test_select',
	//	'title'       => __( 'This is a test select field for setting selection.', 'wp_launch_checklist' ),
	//	'label'       => __( 'This is the label.', 'wp_launch_checklist' ),
	//	'description' => __( 'This is the description', 'wp_launch_checklist' ),
	//	'type'        => 'select',
	//	'options'     => [
	//		'one'   => __( 'One', 'wp_launch_checklist' ),
	//		'two'   => __( 'Two', 'wp_launch_checklist' ),
	//		'three' => __( 'Three', 'wp_launch_checklist' ),
	//	],
	//],
];
