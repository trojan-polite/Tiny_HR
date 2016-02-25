<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Fading Testimonials
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Stephen Kempin
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Simple-Fading-Testimonials
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Plugin_Name();
	$plugin->run();

}
run_plugin_name();



// require admin files
require_once 'admin/sft_admin.php';


/* Create Custom Post Type */ 
function testimonials_post_type() {

  // set up labels
  $labels = array(
    'name' => 'Testimonials',
      'singular_name' => 'Testimonials',
      'add_new' => 'Add New Testimonial',
      'add_new_item' => 'Add New Testimonial',
      'edit_item' => 'Edit Testimonial',
      'new_item' => 'New Testimonial',
      'all_items' => 'All Testimonials',
      'view_item' => 'View Testimonial',
      'search_items' => 'Search Testimonials',
      'not_found' =>  'No Testimonials Found',
      'not_found_in_trash' => 'No Testimonials found in Trash',
      'parent_item_colon' => '',
      'menu_name' => 'Testimonials',
    );

  //register post type
  register_post_type( 'Testimonial', array(
    'labels' => $labels,
    'has_archive' => false,
    'public' => false,
    'show_ui' => true,
    'supports' => array( 'title', 'editor', 'page-attributes'),
    'exclude_from_search' => false,
    'capability_type' => 'post',
    'rewrite' => array( 'slug' => 'Testimonials' ),
    'menu_icon'=> 'dashicons-format-quote',
    )
  );

}
add_action( 'init', 'testimonials_post_type' );
//add_action( 'add_meta_boxes', 'add_events_metaboxes' );
// END Create Custom Post Type -----------------------------------------------



/**
 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
 */
add_action( 'wp_enqueue_scripts', 'sft_js_css' );

function sft_js_css() {
    wp_register_style( 'sft-style', plugins_url('/assets/css/style.css', __FILE__) );
    wp_register_script( 'sft-js', plugins_url( '/assets/js/fader.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_style( 'sft-style' );
    wp_enqueue_script( 'sft-js' );
}







function wpb_adding_scripts() {
wp_register_script( 'my-amazing-script', plugins_url( '/assets/js/run.js', __FILE__ ), array( 'jquery' ), true );
wp_enqueue_script('my-amazing-script');
}
add_action( 'wp_footer', 'wpb_adding_scripts' ); 



