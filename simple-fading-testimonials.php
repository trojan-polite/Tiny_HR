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
 * @package           Simple-Fading-Testimonials
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Fading Testimonials
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       Easily add revolving and fading testimonials to your site, via widgets.
 * Version:           1.0.0
 * Author:            Stephen Kempin
 * Author URI:        http://www.stephenkempin.co.uk/
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
 * This action is documented in includes/class-sft-activator.php
 */
function activate_Simple_Fading_Testimonials() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sft-activator.php';
	Simple_Fading_TestimonialsActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sft-deactivator.php
 */
function deactivate_Simple_Fading_Testimonials() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sft-deactivator.php';
	Simple_Fading_TestimonialsDeactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Simple_Fading_Testimonials' );
register_deactivation_hook( __FILE__, 'deactivate_Simple_Fading_Testimonials' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sft.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Simple_Fading_Testimonials() {

	$plugin = new Simple_Fading_Testimonials();
	$plugin->run();
  
  	require_once('admin/partials/custom_field.php');
  	require_once('admin/partials/widget.php');

}

run_Simple_Fading_Testimonials();



