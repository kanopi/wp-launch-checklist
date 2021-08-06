<?php

namespace Kanopi\Kanopi_Launch_Checklist;

/**
 * Fired during plugin activation
 *
 * @link       https://kanopi.com
 * @since      1.0.0
 *
 * @package    Kanopi_Launch_Checklist
 * @subpackage Kanopi_Launch_Checklist/includes
 */

/**
 * Utility class for creating post types and related taxonomies.
 *
 * @since      1.0.0
 * @package    Kanopi_Launch_Checklist
 * @subpackage Kanopi_Launch_Checklist/includes
 * @author     Kanopi Studios <support@kanopistudios.com>
 */
class Data_Structures {

	/**
	 * The post types.
	 *
	 * @var array the post types.
	 * @since 1.0.0
	 *
	 */
	private $post_types = array();

	/**
	 * The taxonomies.
	 *
	 * @var array the post types.
	 * @since 1.0.0
	 *
	 */
	private $taxonomies = array();

	/**
	 * The post statuses.
	 *
	 * @var array the post statuses.
	 * @since 1.0.0
	 *
	 */
	private $post_statuses = array();

	/**
	 * Register the post type and its taxonomies.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		foreach ( $this->post_types as $post_type_slug => $args ) {
			$singular = ! empty( $args['singular'] ) ? $args['singular'] : $this->titleize_slug( $post_type_slug );
			$plural   = ! empty( $args['plural'] ) ? $args['plural'] : $singular . 's';
			$supports = ! empty( $args['supports'] ) ? $args['supports'] : [];

			register_post_type(
				$post_type_slug,
				wp_parse_args(
					$args,
					[
						'description'           => __( 'Custom post type.', 'kanopi-launch-checklist' ),
						'public'                => true,
						'exclude_from_search'   => false,
						'publicly_queryable'    => true,
						'show_ui'               => true,
						'show_in_nav_menus'     => true,
						'show_in_menu'          => true,
						'show_in_admin_bar'     => true,
						'show_in_rest'          => false,
						'menu_position'         => 6,
						'menu_icon'             => null,
						'capability_type'       => 'post',
						'capabilities'          => [],
						'map_meta_cap'          => null,
						'hierarchical'          => false,
						'supports'              => $supports,
						'register_meta_box_cb'  => '',
						'taxonomies'            => [],
						'has_archive'           => false,
						'rewrite'               => true,
						'query_var'             => true,
						'can_export'            => true,
						'delete_with_user'      => false,
						'rest_base'             => '',
						'rest_controller_class' => '',
						'labels'                => [
							'name'                   => $plural,
							'singular_name'          => $singular,
							'add_new'                => "Add New $singular",
							'add_new_item'           => "Add New $singular",
							'edit_item'              => "Edit $singular",
							'new_item'               => "New $singular",
							'view_item'              => "View $singular",
							'view_items'             => "View $plural",
							'search_items'           => "Search $plural",
							'not_found'              => "No $plural found",
							'not_found_in_trash'     => "No $plural found in Trash",
							'parent_item_colon'      => null,
							'all_items'              => $plural,
							'archives'               => $singular,
							'attributes'             => $singular,
							'insert_into_item'       => $singular,
							'uploaded_to_this_ item' => $singular,
							'featured_image'         => "$singular's Featured Image",
							'set_featured_image'     => "Add $singular's Featured Image",
							'remove_featured_image'  => "Remove $singular's Featured Image",
							'use_featured_image'     => "Use as $singular's Featured Image",
							'menu_name'              => $plural,
							'filter_items_list'      => null,
							'items_list_navigation'  => null,
							'items_list'             => null,
							'name_admin_bar'         => null,
						],
					]
				)
			);
		}

		foreach ( $this->taxonomies as $taxonomy => $args ) {
			$singular = ( ! empty( $args['singular'] ) ) ? $args['singular'] : $this->titleize_slug( $taxonomy );
			$plural   = ( ! empty( $args['plural'] ) ) ? $args['plural'] : $singular . 's';

			register_taxonomy(
				$taxonomy,
				$args['post_type'],
				wp_parse_args(
					$args,
					[
						'labels' => [
							'name'                       => $plural,
							'singular_name'              => $singular,
							'search_items'               => 'Search ' . $plural,
							'popular_items'              => 'Popular ' . $plural,
							'all_items'                  => 'All ' . $plural,
							'parent_item'                => 'Parent ' . $singular,
							'parent_item_colon'          => "Parent {$singular}:",
							'edit_item'                  => 'Edit ' . $singular,
							'update_item'                => 'Update ' . $singular,
							'add_new_item'               => 'Add New ' . $singular,
							'new_item_name'              => "New {$singular} Name",
							'separate_items_with_commas' => "Separate {$plural} with commas",
							'add_or_remove_items'        => "Add or remove {$plural}",
							'choose_from_most_used'      => "Choose from the most used {$plural}",
							'not_found'                  => "No {$plural} found.",
							'menu_name'                  => $plural,
						],
					]
				)
			);
		}

		foreach ( $this->post_statuses as $post_status => $args ) {

			register_post_status(
				$post_status,
				wp_parse_args(
					$args,
					array(
						'label'                     => '',
						'label_count'               => _n_noop( 'Unread <span class="count">(%s)</span>', 'Unread <span class="count">(%s)</span>' ),
						'exclude_from_search'       => false,
						'_builtin'                  => false,
						'public'                    => false,
						'internal'                  => false,
						'protected'                 => false,
						'private'                   => false,
						'publicly_queryable'        => false,
						'show_in_admin_all_list'    => false,
						'show_in_admin_status_list' => false,
						'date_floating'             => false,
					)
				)
			);
		}
	}

	/**
	 * Add the post type and its args to the array.
	 *
	 * @param string $type the post type type.
	 * @param array  $args array of post type args.
	 *
	 * @since 1.0.0
	 *
	 */
	public function add_post_type( string $type, array $args ) {
		$this->post_types[ $type ] = $args;
	}

	/**
	 * Add the taxonomy to the array.
	 *
	 * @param string $taxonomy the taxonomy type.
	 * @param array  $args     array of taxonomy args.
	 *
	 * @since 1.0.0
	 *
	 */
	public function add_taxonomy( string $taxonomy, array $args ) {
		$this->taxonomies[ $taxonomy ] = $args;
	}

	/**
	 * Add the post status to the array.
	 *
	 * @param string $post_status the taxonomy type.
	 * @param array  $args        array of taxonomy args.
	 * @param array  $post_types  array of post types that this status should apply to.
	 *
	 * @since 1.0.0
	 *
	 */
	public function add_post_status( string $post_status, array $args, array $post_types ) {
		//if ( in_array( 'kanopi_checklist_items', $post_types, true ) ) {
			$this->post_statuses[ $post_status ] = $args;
		//}
	}

	/**
	 * Convert a slug into a title string.
	 *
	 * @param string $slug       The slug.
	 * @param bool   $capitalize Should the titme be capitalized.
	 *
	 * @return string Title created from slug.
	 * @since 1.0.0
	 *
	 */
	private function titleize_slug( string $slug, $capitalize = true ) {
		$title = str_replace( [ '_', '-' ], ' ', $slug );
		if ( $capitalize ) {
			$title = ucfirst( $title );
		}

		return $title;
	}


}
