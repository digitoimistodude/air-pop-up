<?php namespace Air_Pop_Up;

defined( 'ABSPATH' ) || exit;

function remove_quick_edit( $actions ) {
  global $post;

  if ( 'air-pop-up' === $post->post_type ) {
    unset( $actions['inline hide-if-no-js'] );
  }

  return $actions;
} // end remove_quick_edit

function list_columns( $columns ) {
  var_dump( $columns );
  return array_merge( $columns, [
    prefix_meta_key( 'stats' )      => __( 'Statistics', 'air-pop-up' ),
  ] );
} // end list_columns

function list_columns_content( $column, $post_id ) {
  $stats = get_pop_up_stats( $post_id );

  if ( empty( $stats ) || ! isset( $stats['shows'] ) || ! isset( $stats['clicks'] ) || ! isset( $stats['yes'] ) || ! isset( $stats['no'] ) ) {
    return;
  }

  $stats_mode = get_post_meta( $post_id, 'use_link_or_yes_no_choice', true );
  $stats_mode = $stats_mode ? $stats_mode : 'link';

  if ( prefix_meta_key( 'stats' ) === $column ) {
    echo esc_html( sprintf( __( '%1$s views', 'air-pop-up' ), $stats['shows'] ) );

    if ( 'link' === $stats_mode && ! empty( get_post_meta( $post_id, 'link', true ) ) ) {
      echo '<br>';
      echo esc_html( sprintf( __( '%1$s link clicks', 'air-pop-up' ), $stats['clicks'] ) );
    }

    if ( 'yes_no_choice' === $stats_mode ) {
      echo '<br>';
      echo esc_html( sprintf( __( '%1$s yes answers', 'air-pop-up' ), $stats['yes'] ) );
      echo '<br>';
      echo esc_html( sprintf( __( '%1$s no answers', 'air-pop-up' ), $stats['no'] ) );
    }
  }
} // end list_columns_content
