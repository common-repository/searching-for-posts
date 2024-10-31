<?php
namespace SearchingForPosts\Admin;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MMSDD_Searching_for_Posts_Admin') ) :
/**
 * The admin-specific functionality of the plugin.
 *
 *
 * @package    DMSFP_Searching_for_Posts
 * @subpackage DMSFP_Searching_for_Posts/admin
 */

class MMSDD_Searching_for_Posts_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $DMSFP_Searching_for_Posts    The ID of this plugin.
	 */
	private $dmsfp_searching_for_posts;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $DMSFP_Searching_for_Posts       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $dmsfp_searching_for_posts, $version ) {

		$this->dmsfp_searching_for_posts = $dmsfp_searching_for_posts;
		$this->version = $version;


	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function dmsfp_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in DMSFP_Searching_for_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The DMSFP_Searching_for_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function dmsfp_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in DMSFP_Searching_for_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The DMSFP_Searching_for_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


    
    // register the script
   wp_register_script( 'ajax-script', plugin_dir_url( __FILE__ ) . 'js/searching-for-posts-admin.js', array( 'jquery' ), $this->version, true );
   
   //enqueue the script 
   wp_enqueue_script( 'ajax-script' );

   // localize the script
   wp_localize_script( 'ajax-script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
		
	

wp_enqueue_style( 'wp-color-picker');
wp_enqueue_script( 'wp-color-picker');

  wp_enqueue_script( 'color-picker-admin', plugin_dir_url( __FILE__ ) . 'js/color-script-admin.js', array("wp-color-picker"), $this->version, true );

 

		
	}
  }

endif;
