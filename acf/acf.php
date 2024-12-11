<?php

namespace Air_Pop_Up;

add_filter( 'air_helper_acf_groups_to_warn_about', function( $groups ) {
  foreach ( $groups as $k => $g ) {
    if ( 'group_6751492873f1f1' !== $g['key'] ) {
      continue;
    }

    unset( $groups[ $k ] );
  }

  return $groups;
} );

function register_acf_field() {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  $field_group = [
    'key' => 'group_6751492873f1f1',
    'title' => __( 'Pop up', 'air-pop-up' ),
    'fields' => [
      [
        'key' => 'field_6751a98d435cf1a',
        'label' => __( 'Timing and visibility', 'air-pop-up' ),
        'name' => '',
        'aria-label' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
          'width' => '',
          'class' => '',
          'id' => '',
        ],
        'placement' => 'top',
        'endpoint' => 0,
        'selected' => 0,
      ],
      [
        'key' => 'field_67514b6121978a',
        'label' => __( 'Start', 'air-pop-up' ),
        'name' => 'start',
        'aria-label' => '',
        'type' => 'date_time_picker',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => [
          'width' => '50',
          'class' => '',
          'id' => '',
        ],
        'display_format' => 'j.n.Y H:i',
        'return_format' => 'd\/m\/Y g:i:a',
        'first_day' => 1,
        'allow_in_bindings' => 0,
      ],
      [
        'key' => 'field_67514be821979',
        'label' => __( 'Stop', 'air-pop-up' ),
        'name' => 'stop',
        'aria-label' => '',
        'type' => 'date_time_picker',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => [
          'width' => '50',
          'class' => '',
          'id' => '',
        ],
        'display_format' => 'j.n.Y H:i',
        'return_format' => 'd\/m\/Y g:i:a',
        'first_day' => 1,
        'allow_in_bindings' => 0,
      ],
      [
        'key' => 'field_67514c6b2197a',
        'label' => __( 'Show on', 'air-pop-up' ),
        'name' => 'show_on',
        'aria-label' => '',
        'type' => 'relationship',
        'instructions' => __( 'Pop up will be shown on pages selected here. If none are selected, pop up will be shown on all pages.', 'air-pop-up' ),
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'post_type' => apply_filters( 'air_pop_up_show_on_locations', [ 'page', 'post' ] ),
        'post_status' => '',
        'taxonomy' => '',
        'filters' => [
            'search',
            'post_type',
        ],
        'return_format' => 'id',
        'min' => '',
        'max' => '',
        'allow_in_bindings' => 0,
        'elements' => '',
        'bidirectional' => 0,
        'bidirectional_target' => [],
      ],
      [
        'key' => 'field_6751524cd58c2',
        'label' => __( 'Show again', 'air-pop-up' ),
        'name' => 'show_again',
        'aria-label' => '',
        'type' => 'button_group',
        'instructions' => __( '<strong>Session</strong> Pop up is shown once per session.<br><strong>Never</strong> Pop up will only show once per user. Pop up will only be shown again if user clears browser storage.<br><strong>Timed</strong> Pop up will be shown again after set period of time.', 'air-pop-up' ),
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
            'width' => '50',
            'class' => '',
            'id' => '',
        ],
        'choices' => [
            'session' => __( 'Session', 'air-pop-up' ),
            'never' => __( 'Never', 'air-pop-up' ),
            'timed' => __( 'Timed', 'air-pop-up' ),
        ],
        'default_value' => '',
        'return_format' => 'value',
        'allow_null' => 0,
        'allow_in_bindings' => 0,
        'layout' => 'horizontal',
      ],
      [
        'key' => 'field_67515530a8498',
        'label' => __( 'Time in seconds after pop up is shown again.', 'air-pop-up' ),
        'name' => 'timed_time',
        'aria-label' => '',
        'type' => 'number',
        'instructions' => __( 'Hour = 3600<br>Day = 86400', 'air-pop-up' ),
        'required' => 0,
        'conditional_logic' => [
            [
                [
                  'field' => 'field_6751524cd58c2',
                  'operator' => '==',
                  'value' => 'timed',
                ],
            ],
        ],
        'wrapper' => [
          'width' => '25',
          'class' => '',
          'id' => '',
        ],
        'default_value' => '',
        'min' => 1,
        'max' => '',
        'allow_in_bindings' => 1,
        'placeholder' => '',
        'step' => '',
        'prepend' => '',
        'append' => '',
      ],
      [
        'key' => 'field_675174f6d23bc',
        'label' => __( 'Delay', 'air-pop-up' ),
        'name' => 'delay',
        'aria-label' => '',
        'type' => 'number',
        'instructions' => __( 'Time in seconds after pop up is shown.', 'air-pop-up' ),
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
            'width' => '25',
            'class' => '',
            'id' => '',
        ],
        'default_value' => '',
        'min' => 0,
        'max' => '',
        'allow_in_bindings' => 0,
        'placeholder' => '',
        'step' => '',
        'prepend' => '',
        'append' => '',
      ],
      [
        'key' => 'field_6751a98d435cf2',
        'label' => __( 'Content', 'air-pop-up' ),
        'name' => '',
        'aria-label' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
          'width' => '',
          'class' => '',
          'id' => '',
        ],
        'placement' => 'top',
        'endpoint' => 0,
        'selected' => 0,
      ],
      [
        'key' => 'field_6756ffb96c0661',
        'label' => __( 'Heading', 'air-pop-up' ),
        'name' => 'heading',
        'aria-label' => '',
        'type' => 'text',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => [
          'width' => '',
          'class' => '',
          'id' => '',
        ],
        'default_value' => '',
        'maxlength' => '',
        'allow_in_bindings' => 0,
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
      ],
      [
        'key' => 'field_67514928ef851',
        'label' => __( 'Content', 'air-pop-up' ),
        'name' => 'content',
        'aria-label' => '',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'default_value' => '',
        'allow_in_bindings' => 1,
        'tabs' => 'all',
        'toolbar' => 'basic',
        'media_upload' => 0,
        'delay' => 0,
      ],
    ],
    'location' => [
        [
            [
              'param' => 'post_type',
              'operator' => '==',
              'value' => 'air-pop-up',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ];

  $theme_fields = get_theme_fields();

  if ( ! empty( $theme_fields ) ) {
    $merged_fields = array_merge( $field_group['fields'], $theme_fields );
    $field_group['fields'] = $merged_fields;
  }

  acf_add_local_field_group( $field_group );
}

function get_theme_fields() {
  // Get all ACF field groups
  $groups = acf_get_field_groups();

  if ( empty( $groups ) ) {
    return;
  }

  // Filter out all other locations except our custom location
  $filtered_groups = array_filter($groups, function( $group ) {
    if ( 'air-pop-up-additional-fields' === $group['location'][0][0]['param'] ) {
      return true;
    }
    return false;
  });

  // If no additional fields from theme, bail
  if ( empty( $filtered_groups ) ) {
    return;
  }

  $all_theme_fields = [];

  foreach ( $filtered_groups as $filtered_group ) {
    $theme_fields = acf_get_fields( $filtered_group['key'] );
    $all_theme_fields = array_merge( $all_theme_fields, $theme_fields );;
  }

  return $all_theme_fields;
} // end get_theme_fields

function add_pop_up_location() {
  if ( ! function_exists( 'acf_register_location_type' ) ) {
    return;
  }

  include_once plugin_dir_path( __FILE__ ) . '/class-pop-up-location.php';

  acf_register_location_type( 'Pop_Up_Location' );
} // end add_pop_up_location
