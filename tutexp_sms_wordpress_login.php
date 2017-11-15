<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              tutexp.com
 * @since             1.0.0
 * @package           Tutexp_sms_wordpress_login
 *
 * @wordpress-plugin
 * Plugin Name:       sms based login system by tutexp
 * Plugin URI:        www.tutexp.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            tutexp team
 * Author URI:        tutexp.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tutexp_sms_wordpress_login
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tutexp_sms_wordpress_login-activator.php
 */
function activate_tutexp_sms_wordpress_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tutexp_sms_wordpress_login-activator.php';
	Tutexp_sms_wordpress_login_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tutexp_sms_wordpress_login-deactivator.php
 */
function deactivate_tutexp_sms_wordpress_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tutexp_sms_wordpress_login-deactivator.php';
	Tutexp_sms_wordpress_login_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tutexp_sms_wordpress_login' );
register_deactivation_hook( __FILE__, 'deactivate_tutexp_sms_wordpress_login' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tutexp_sms_wordpress_login.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */


if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' ) ) {
    echo "hell";
    require_once( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' );
}


function run_tutexp_sms_wordpress_login() {

	$plugin = new Tutexp_sms_wordpress_login();
	$plugin->run();

}
run_tutexp_sms_wordpress_login();
