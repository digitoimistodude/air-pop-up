<?php

namespace Air_Pop_Up;

function show_pop_up() {
  $pop_ups = get_pop_ups();

  $template_path = locate_template( 'templates/pop-up-template-default.php' );
  // If no custom template was found, use themes template
  if ( empty( $template_path ) ) {
    $template_path = plugin_dir_path( __FILE__ ) . 'templates/pop-up-template-default.php';
  }

  foreach ( $pop_ups as $pop_up ) {
    include $template_path;
  }
}

function get_pop_ups() {
  if ( is_admin() ) {
    return;
  }

  $current_post_id = get_the_ID();
  $meta_query = [
    [
    'meta_key' => 'stop',
    'value'    => wp_date( 'Y-m-d H:i:s' ),
    'compare'  => '>',
    'type'     => 'DATETIME',
    ],
  ];

  $pop_up_query = new \WP_Query( [
    'post_type'      => 'air-pop-up',
    'posts_per_page' => 100,
    'meta_query'     => [ $meta_query ],
  ] );

  $pop_ups = [];
  if ( $pop_up_query->have_posts() ) {
    while ( $pop_up_query->have_posts() ) {
      $pop_up_query->the_post();

      $start = get_post_meta( get_the_ID(), 'start', true );

      if ( $start > wp_date( 'Y-m-d H:i:s' ) ) {
        continue;
      }

      $show_on_pages = get_post_meta( get_the_ID(), 'show_on', true );
      if ( ! empty( $show_on_pages ) && ! in_array( (string) $current_post_id, $show_on_pages, true ) ) {
        continue;
      }

      $pop_up_temp = [
        'id'             => get_the_ID(),
        'guid'           => crc32( get_the_ID() . get_the_title() . get_post_meta( get_the_ID(), 'content', true ) ),
        'title'          => get_field( 'heading' ),
        'content'        => get_post_meta( get_the_ID(), 'content', true ),
        'start'          => $start,
        'stop'           => get_post_meta( get_the_ID(), 'stop', true ),
        'show_again'     => get_post_meta( get_the_ID(), 'show_again', true ),
        'timed_time'     => absint( get_post_meta( get_the_ID(), 'timed_time', true ) ),
        'delay'          => absint( get_post_meta( get_the_ID(), 'delay', true ) ),
      ];

      // If we have fields from theme, gather meta from them
      $theme_fields = get_theme_fields();
      if ( $theme_fields ) {
        foreach ( $theme_fields as $theme_field ) {
          $pop_up_temp[ $theme_field['name'] ] = get_field( $theme_field['name'] );
        }
      }

      $pop_ups[] = $pop_up_temp;
    }
  }
  wp_reset_postdata();

  return $pop_ups;
} // end get_notifications

function enqueue_scripts() {
  wp_enqueue_script( 'air-pop-up-scripts',
    plugin_dir_url( __FILE__ ) . 'assets/scripts.js',
    [],
    filemtime( plugin_dir_path( __FILE__ ) . 'assets/scripts.js' ),
    true
  );

  if ( ! apply_filters( 'air_pop_up_disable_css', __return_false() ) ) {
    wp_enqueue_style( 'air-pop-up-styles',
      plugin_dir_url( __FILE__ ) . 'assets/styles.css',
      [],
      filemtime( plugin_dir_path( __FILE__ ) . 'assets/styles.css' )
    );
  }

  $pop_ups = get_pop_ups();
  $pop_up_data = [];

  foreach ( $pop_ups as $pop_up ) {
    $pop_up_data[ $pop_up['guid'] ] = $pop_up;
  }

  wp_localize_script( 'air-pop-up-scripts', 'pop_up_data', $pop_up_data );
} // end enqueue_scripts
