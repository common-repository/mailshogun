<?php 
header('Access-Control-Allow-Origin: *'); 


/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.mailshogun.com
 * @since             1.0.0
 * @package           Mailshogun
 *
 * @wordpress-plugin
 * Plugin Name:       mailshogun
 * Plugin URI:        www.mailshogun.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Palmergate
 * Author URI:        www.Palmergate.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mailshogun
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'MAILSHOGUN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mailshogun-activator.php
 */
function activate_mailshogun() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mailshogun-activator.php';
	Mailshogun_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mailshogun-deactivator.php
 */
function deactivate_mailshogun() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mailshogun-deactivator.php';
	Mailshogun_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mailshogun' );
register_deactivation_hook( __FILE__, 'deactivate_mailshogun' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mailshogun.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mailshogun() {

	$plugin = new Mailshogun();
	$plugin->run();

}
/** Step 2 (from text above). */
add_action( 'admin_menu', 'mailshogun_plugin_menu' );

/** Step 1. */
function mailshogun_plugin_menu() {
	add_options_page( 'Mailshogun Options', 'Mailshogun', 'manage_options', 'mailshogun-unique-identifier', 'mailshogun_plugin_options' );
}

/** Step 3. */
function mailshogun_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	//echo '<h2>Mailshogun settings</h2>'; 
	echo '</div>';


	add_filter( 'allowed_http_origins', 'add_allowed_origins' );
	function add_allowed_origins( $origins ) {
	    $origins[] = 'http://127.0.0.1:5000';
	    $origins[] = 'https://api.mailshogun.com';
    return $origins;
	}

	
	include('mailshogun_internal.php');

}


run_mailshogun();
