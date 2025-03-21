<?php

namespace Air_Pop_Up;

/**
 * Register pop up post type
 */
// Register Custom Post Type
function register_pop_up_post_type() {
  $labels = [
		'name'               => __( 'Pop ups', 'air-pop-up' ),
    'singular_name'      => __( 'Pop up', 'air-pop-up' ),
    'add_new'            => __( 'Add new pop up', 'air-pop-up' ),
    'add_new_item'       => __( 'Add new pop up', 'air-pop-up' ),
    'edit_item'          => __( 'Edit pop up', 'air-pop-up' ),
    'new_item'           => __( 'New pop up', 'air-pop-up' ),
    'view_item'          => __( 'View pop up', 'air-pop-up' ),
    'search_items'       => __( 'Search pop ups', 'air-pop-up' ),
    'not_found'          => __( 'Pop up not found', 'air-pop-up' ),
    'not_found_in_trash' => __( 'Pop up not found in trash', 'air-pop-up' ),
    'parent_item_colon'  => __( 'Pop up parent', 'air-pop-up' ),
    'menu_name'          => __( 'Pop ups', 'air-pop-up' ),
  ];

	$args = [
    'labels'              => $labels,
    'hierarchical'        => false,
    'description'         => 'description',
    'taxonomies'          => [],
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-testimonial',
    'show_in_nav_menus'   => false,
    'publicly_queryable'  => true,
    'exclude_from_search' => true,
    'has_archive'         => false,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => true,
    'show_in_rest'        => false,
    'capability_type'     => 'post',
    'supports'            => [
      'title',
      'revisions',
    ],
  ];
	register_post_type( 'air-pop-up', $args );
}
