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
 * Version:           1.0.0
 */

namespace Air_Pop_Up;

const PLUGIN_VERSION = '1.0.0';

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
