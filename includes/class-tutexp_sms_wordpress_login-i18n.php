<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       tutexp.com
 * @since      1.0.0
 *
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tutexp_sms_wordpress_login
 * @subpackage Tutexp_sms_wordpress_login/includes
 * @author     tutexp team <tapos.aa@gmail.com>
 */
class Tutexp_sms_wordpress_login_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tutexp_sms_wordpress_login',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
