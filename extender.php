<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              russellbenzing.com
 * @since             1.0.0
 * @package           Extender
 *
 * @wordpress-plugin
 * Plugin Name:       Extender
 * Plugin URI:        http://github.com/rbenzing/WPPluginExtender
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Russell Benzing
 * Author URI:        russellbenzing.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       extender
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-extender-activator.php
 */
function activate_extender() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-extender-activator.php';
	Extender_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-extender-deactivator.php
 */
function deactivate_extender() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-extender-deactivator.php';
	Extender_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_extender' );
register_deactivation_hook( __FILE__, 'deactivate_extender' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-extender.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_extender() {

	$plugin = new Extender();
	$plugin->run();

}
run_extender();
