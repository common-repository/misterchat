<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://misterchat.nu
 * @since             1.0.0
 * @package           Mister_chat
 *
 * @wordpress-plugin
 * Plugin Name:       MisterChat
 * Plugin URI:        https://www.misterchat.nu/
 * Description:       Deze plugin voegt de bemande livechat van MisterChat toe aan uw website
 * Version:           2.1.1
 * Author:            MisterChat
 * Author URI:        https://misterchat.nu
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mister_chat
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
define( 'MISTER_CHAT_VERSION', '2.0.6' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mister_chat-activator.php
 */
function activate_mister_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mister_chat-activator.php';
	Mister_chat_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mister_chat-deactivator.php
 */
function deactivate_mister_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mister_chat-deactivator.php';
	Mister_chat_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mister_chat' );
register_deactivation_hook( __FILE__, 'deactivate_mister_chat' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mister_chat.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mister_chat() {

	$plugin = new Mister_chat();
	$plugin->run();

}
run_mister_chat();
