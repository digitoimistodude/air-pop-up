<?php
/**
 * @package air-pop-up
 *
 * Plugin Name:       Air pop up
 * Plugin URI:
 * Description:       Easy way to create and manage pop ups.
 * Author:            Digitoimisto Dude
 * Author URI:        https://dude.fi
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Version:           1.1.3
 */

namespace Air_Pop_Up;

const PLUGIN_VERSION = '1.1.3';

/**
 * Register CPT.
 */
include plugin_dir_path( __FILE__ ) . '/cpt-settings.php';
add_action( 'init', __NAMESPACE__ . '\register_pop_up_post_type' );

/**
 * ACF
 */
include plugin_dir_path( __FILE__ ) . '/acf/acf.php';
add_action( 'acf/include_fields', __NAMESPACE__ . '\register_acf_field' );
add_action( 'acf/init', __NAMESPACE__ . '\add_pop_up_location' );


include plugin_dir_path( __FILE__ ) . '/helpers.php';
add_action( 'air_pop_up_show_pop_up', __NAMESPACE__ . '\show_pop_up' );

/**
 * Enqueue template style
 */
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_scripts' );

/**
 * Load translations
 */
add_action( 'plugins_loaded', function() {
  $plugin_path = dirname( plugin_basename( __FILE__ ) ) . '/languages';
  load_plugin_textdomain( 'air-pop-up', false, $plugin_path );
} );

/**
 * Stats functionality
 */
include plugin_dir_path( __FILE__ ) . '/inc/stats.php';
add_action( 'wp_ajax_air_pop_up_show', __NAMESPACE__ . '\count_show' );
add_action( 'wp_ajax_nopriv_air_pop_up_show', __NAMESPACE__ . '\count_show' );
add_action( 'wp_ajax_air_pop_up_click', __NAMESPACE__ . '\count_click' );
add_action( 'wp_ajax_nopriv_air_pop_up_click', __NAMESPACE__ . '\count_click' );
add_action( 'wp_ajax_air_pop_up_yes', __NAMESPACE__ . '\count_yes' );
add_action( 'wp_ajax_nopriv_air_pop_up_yes', __NAMESPACE__ . '\count_yes' );
add_action( 'wp_ajax_air_pop_up_no', __NAMESPACE__ . '\count_no' );
add_action( 'wp_ajax_nopriv_air_pop_up_no', __NAMESPACE__ . '\count_no' );

/**
 * Admin
 */
include plugin_dir_path( __FILE__ ) . '/inc/admin.php';
// add_filter( 'post_row_actions', __NAMESPACE__ . '\remove_quick_edit' );
add_filter( 'manage_air-pop-up_posts_columns', __NAMESPACE__ . '\list_columns' );
add_action( 'manage_air-pop-up_posts_custom_column', __NAMESPACE__ . '\list_columns_content', 10, 2 );

/**
 * Enqueue admin styles
 */
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_admin_styles' );
