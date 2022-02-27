<?php

/**
 * Checklist items organized by group.
 */
return [
	[
		'name'        => 'delete_settings',
		'title'       => __( 'Delete all plugin settings when uninstalled?', 'kanopi' ),
		'label'       => __( 'NOTE: this cannot be undone.', 'kanopi' ),
		'description' => '',
		'type'        => 'checkbox',
	],
	// The following are just test fields to let you know how these should be set up.
	// The 'type' key determines the type of partial included from
	// admin/partials/form-fields/
	[
		'name'        => 'test_textfield',
		'title'       => __( 'This is a test text field for setting entry.', 'kanopi' ),
		'label'       => __( 'This is the label.', 'kanopi' ),
		'description' => __( 'This is the description', 'kanopi' ),
		'type'        => 'text',
	],
	[
		'name'        => 'test_select',
		'title'       => __( 'This is a test select field for setting selection.', 'kanopi' ),
		'label'       => __( 'This is the label.', 'kanopi' ),
		'description' => __( 'This is the description', 'kanopi' ),
		'type'        => 'select',
		'options'     => [
			'one'   => __( 'One', 'kanopi' ),
			'two'   => __( 'Two', 'kanopi' ),
			'three' => __( 'Three', 'kanopi' ),
		],
	],
];
