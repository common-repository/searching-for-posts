<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 * 
 *  
 * @package           MMSDD_Searching_for_Posts
 *
 * @wordpress-plugin
 * Plugin Name:       Searching for Posts
 * Plugin URI:        https://wordpress.org/plugins/searching-for-posts/
 * Description:       This is the plugin for searching posts,without refreshing a page, by different critiries
 * Version:           1.0.4
 * Author:            Dragan Milunovic
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       searching-for-posts
 * Domain Path:       /languages
 */
 
use SearchingForPosts\Includes\MMSDD_Searching_for_Posts_Activator as MMSDD_Searching_for_Posts_Activator;
use SearchingForPosts\Includes\MMSDD_Searching_for_Posts_Deactivator as MMSDD_Searching_for_Posts_Deactivator;
use  SearchingForPosts\Includes\MMSDD_Searching_for_Posts as MMSDD_Searching_for_Posts;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


//require  'templates/my_custom_template.html';
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MMSDD_Searching_for_Posts_VERSION', '1.0.1' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-searching-for-posts-activator.php
 */
if (!function_exists('dmsfp_activate_MMSDD_Searching_for_Posts')){

  function dmsfp_activate_MMSDD_Searching_for_Posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-searching-for-posts-activator.php';
	MMSDD_Searching_for_Posts_Activator::dmsfp_activate();
   }

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-searching-for-posts-deactivator.php
 */
if (!function_exists('dmsfp_deactivate_MMSDD_Searching_for_Posts')){

  function dmsfp_deactivate_MMSDD_Searching_for_Posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-searching-for-posts-deactivator.php';
	MMSDD_Searching_for_Posts_Deactivator::dmsfp_deactivate();
   }
}

register_activation_hook( __FILE__, 'dmsfp_activate_MMSDD_Searching_for_Posts' );
register_deactivation_hook( __FILE__, 'dmsfp_deactivate_MMSDD_Searching_for_Posts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-searching-for-posts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 */
if (!function_exists('dmsfp_run_MMSDD_Searching_for_Posts')){

	function dmsfp_run_MMSDD_Searching_for_Posts() {

		$plugin = new MMSDD_Searching_for_Posts();
		$plugin->dmsfp_run();

	}
	dmsfp_run_MMSDD_Searching_for_Posts();

}
