<?php
namespace SearchingForPosts\Includes;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    DMSFP_Searching_for_Posts
 * @subpackage DMSFP_Searching_for_Posts/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class MMSDD_Searching_for_Posts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 */
	public function dmsfp_load_plugin_textdomain() {

		load_plugin_textdomain(
			'searching-for-posts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
