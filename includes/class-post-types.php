<?php

namespace Kanopi\Kanopi_Launch_Checklist;

class Post_Types {

	/**
	 * Data Structures object.
	 *
	 * @var \Kanopi\Kanopi_Launch_Checklist\Data_Structures
	 */
	protected $data_structures;

	/**
	 * Post_Types constructor.
	 */
	public function __construct() {
		$this->data_structures = new Data_Structures();
	}

	/**
	 * Setup array dependencies for the utility class
	 * post types and taxonomies registration.
	 */
	public function init() {
		$this->register_post_types();
		$this->register_taxonomies();
		$this->data_structures->register();
	}

	/**
	 * Register Custom Post Types
	 */
	public function register_post_types() {

		// Checklist.
		$this->data_structures->add_post_type(
			'kanopi_checklist',
			array(
				'singular'            => __( 'Launch Checklist Item', 'kanopi-launch-checklist' ),
				'description'         => __( 'Post type for Resource Library', 'kanopi-launch-checklist' ),
				'supports'            =>
					array(
						'title',
						'editor',
					),
				'menu_icon'           => 'dashicons-yes-alt',
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'show_ui'             => true,
				'show_in_nav_menus'   => false,
				'show_in_menu'        => true,
				'archive'             => false,
				'rewrite'             => false,
			)
		);

	}


	/**
	 * Register Taxonomies
	 */
	public function register_taxonomies() {
		$this->data_structures->add_taxonomy(
			'tab_locations',
			array(
				'post_type'         => 'kanopi_checklist',
				'labels'            =>
					array(
						'name'          => __( 'Tab Locations', 'kanopi-launch-checklist' ),
						'singular_name' => __( 'Tab Location', 'kanopi-launch-checklist' ),
					),
				'hierarchical'      => true,
				'show_admin_column' => true,
				'show_ui'           => true,
				'show_in_rest'      => false,
				'query_var'         => true,
				'rewrite'           => false,
				'public'            => true,
			)
		);
	}

}
