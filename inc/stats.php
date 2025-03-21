<?php

namespace Air_Pop_Up;

defined( 'ABSPATH' ) || exit;

function get_pop_up_stats( $post_id ) {
  if ( 'air-pop-up' !== get_post_type( $post_id ) ) {
    return false;
  }

  $show_count = get_post_meta( $post_id, prefix_meta_key( 'stats_show' ), true );
  $click_count = get_post_meta( $post_id, prefix_meta_key( 'stats_click' ), true );
  $yes_count = get_post_meta( $post_id, prefix_meta_key( 'stats_yes' ), true );
  $no_count = get_post_meta( $post_id, prefix_meta_key( 'stats_no' ), true );

  return [
    'shows'   => ( $show_count ) ? $show_count : '0',
    'clicks'  => ( $click_count ) ? $click_count : '0',
    'yes'     => ( $yes_count ) ? $yes_count : '0',
    'no'      => ( $no_count ) ? $no_count : '0',
  ];
} // end get_pop_up_stats

function count_show() {
  update_pop_up_stats( 'show' );
} // end count_show

function count_click() {
  update_pop_up_stats( 'click' );
} // end count_click

function count_yes() {
  update_pop_up_stats( 'yes' );
} // end count_yes

function count_no() {
  update_pop_up_stats( 'no' );
} // end count_no

function update_pop_up_stats( $type ) {
  if ( ! isset( $_POST['id'] ) ) {
    wp_send_json_error();
  }

  if ( ! isset( $_POST['timestamp'] ) ) {
    wp_send_json_error();
  }

  $guid = sanitize_text_field( $_POST['id'] );
  $timestamp = sanitize_text_field( $_POST['timestamp'] );
  check_ajax_referer( prefix_meta_key( $guid ), 'nonce' );

  // Get post ID from timestamp
  $args = array(
    'post_type' => 'air-pop-up',
    'posts_per_page' => 1,
    'meta_query' => [
      [
        'key' => prefix_meta_key( 'timestamp' ),
        'value' => $timestamp,
        'compare' => '=',
      ],
    ],
  );

  $query = new \WP_Query( $args );
  if ( ! $query->have_posts() ) {
    wp_send_json_error();
  }

  $post_id = $query->posts[0]->ID;

  $count = get_post_meta( $post_id, prefix_meta_key( "stats_{$type}" ), true );
  $count = $count ? $count : 0;
  $count++;

  update_post_meta( $post_id, prefix_meta_key( "stats_{$type}" ), $count );
  wp_send_json_success();
} // end update_pop_up_stats
