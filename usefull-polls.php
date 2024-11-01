<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              
 * @since             1.0.0
 * @package           Useful Polls
 *
 * @wordpress-plugin
 * Plugin Name:       Useful Polls
 * Plugin URI:        
 * Description:       This plugin is a good catch for voting with many different colors of form and an answering table, so it looks more beautiful.
 * Version:           1.0.0
 * Author:            Milunovic Dragan
 * Author URI:        
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       useful-polls
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

use Useful_Polls\Includes\DMUP_Useful_Polls as DMUP_Useful_Polls;
use Useful_Polls\Includes\DMUP_Useful_Polls_Activator as DMUP_Useful_Polls_Activator;
use Useful_Polls\Includes\DMUP_Useful_Polls_Deactivator as DMUP_Useful_Polls_Deactivator;


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_useful_polls() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-useful-polls-activator.php';
	DMUP_Useful_Polls_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_useful_polls() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-useful-polls-deactivator.php'; 
	DMUP_Useful_Polls_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_useful_polls' );
register_deactivation_hook( __FILE__, 'deactivate_useful_polls' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-useful-polls.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_useful_polls() {

	$plugin = new DMUP_Useful_Polls();
	$plugin->run();

}
run_useful_polls();
