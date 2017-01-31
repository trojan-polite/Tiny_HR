<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://en-gb.wordpress.org/plugins/simple-fading-testimonials-widget/
 * @since      1.0.1
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.1
 * @package    Simple-Fading-Testimonials
 * @subpackage Simple-Fading-Testimonials/admin
 * @author     Stephen Kempin <info@stephenkempin.co.uk>
 */
class Simple_Fading_Testimonials_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'Simple-Fading-Testimonials',
			true,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}