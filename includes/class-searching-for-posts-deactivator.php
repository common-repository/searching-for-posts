<?php
namespace SearchingForPosts\Includes;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @package    DMSFP_Searching_for_Posts
 * @subpackage DMSFP_Searching_for_Posts/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class MMSDD_Searching_for_Posts_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 */
	public static function dmsfp_deactivate() {
      flush_rewrite_rules();
	}

}
