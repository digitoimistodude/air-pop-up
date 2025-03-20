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

  if ( empty( $stats ) ) {
    return;
  }

  if ( prefix_meta_key( 'stats' ) === $column ) {
      if ( $stats ) {
        echo esc_html( sprintf( __( '%1$s showings', 'air-pop-up' ), $stats['shows'] ) );
        echo '</br>';
        echo esc_html( sprintf( __( '%1$s link clicks', 'air-pop-up' ), $stats['clicks'] ) );
        echo '</br>';
        echo esc_html( sprintf( __( '%1$s yes answers', 'air-pop-up' ), $stats['yes'] ) );
        echo '</br>';
        echo esc_html( sprintf( __( '%1$s no answers', 'air-pop-up' ), $stats['no'] ) );
      }
  }
} // end list_columns_content

