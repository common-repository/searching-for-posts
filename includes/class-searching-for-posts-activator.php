<?php
namespace SearchingForPosts\Includes;

use SearchingForPosts\Admin\MMSDD_Search_Post as MMSDD_Search_Post;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MMSDD_Searching_for_Posts_Activator') ) :
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    DMSFP_Searching_for_Posts
 * @subpackage DMSFP_Searching_for_Posts/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class MMSDD_Searching_for_Posts_Activator {


	/**
	 * Declare searching form of custom post type search_post
	 * Flushes rewrite rules afterwards
	 */
	public static function dmsfp_activate() {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-searching-for-posts.php';
	
		MMSDD_Search_Post::dmsfp_new_form_for_searching();

		flush_rewrite_rules();
	

		
    // 
	} 

}

endif;