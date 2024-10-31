<?php
namespace SearchingForPosts\Includes;

use SearchingForPosts\Admin\MMSDD_Ajax_Save_Post_Meta as MMSDD_Ajax_Save_Post_Meta;
use SearchingForPosts\Admin\MMSDD_Search_Post_Meta as MMSDD_Search_Post_Meta;
use SearchingForPosts\Admin\MMSDD_Search_Post as MMSDD_Search_Post;
use SearchingForPosts\Admin\MMSDD_Searching_for_Posts_Admin as MMSDD_Searching_for_Posts_Admin;

use SearchingForPosts\FrontEnd\MMSDD_Searching_for_Posts_Public as MMSDD_Searching_for_Posts_Public;
use SearchingForPosts\FrontEnd\MMSDD_Templates as MMSDD_Templates;
use SearchingForPosts\FrontEnd\MMSDD_Shortcode as MMSDD_Shortcode;
use SearchingForPosts\FrontEnd\MMSDD_Meta as MMSDD_Meta;


if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MMSDD_Searching_for_Posts') ) :
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 * 
 *
 *
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    DMSFP_Searching_for_Posts
 * @subpackage DMSFP_Searching_for_Posts/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class MMSDD_Searching_for_Posts {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      DMSFP_Searching_for_Posts_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $DMSFP_Searching_for_Posts    The string used to uniquely identify this plugin.
	 */
	protected $dmsfp_searching_for_posts;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'MMSDD_Searching_for_Posts_VERSION' ) ) {
			$this->version = MMSDD_Searching_for_Posts_VERSION;
		} else {
			$this->version = '1.0.1';
		}
		$this->dmsfp_searching_for_posts = 'searching-for-posts';

		$this->dmsfp_load_dependencies();
		$this->dmsfp_set_locale();
		$this->dmsfp_define_admin_hooks();
		$this->dmsfp_define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - DMSFP_Searching_for_Posts_Loader. Orchestrates the hooks of the plugin.
	 * - DMSFP_Searching_for_Posts_i18n. Defines internationalization functionality.
	 * - DMSFP_Searching_for_Posts_Admin. Defines all hooks for the admin area.
	 * - DMSFP_Searching_for_Posts_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function dmsfp_load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-searching-for-posts-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-searching-for-posts-i18n.php';
        

        /**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-shortcode.php'; 

         
		 /**
		 * The class responsible for defining internationalization functionality
		 * onew_form_for_searchingf the plugin.
		 */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-search-post-meta.php'; 

		 /**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ajax-save-post-meta.php'; 

		/**
		 * The class responsible for creating custom post type that is going to use
		 *  as a search form of the plugin.
		 */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-search-post.php'; 

				require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-widget.php'; 

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-searching-for-posts-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-searching-for-posts-public.php';
       
       /**
		 * The class responsible for loading templates for pagination 
		 * and searching criteria
	   */
       require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-templates.php';
		
        /**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
	
		$this->loader = new MMSDD_Searching_for_Posts_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the DMSFP_Searching_for_Posts_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function dmsfp_set_locale() {

		$plugin_i18n = new MMSDD_Searching_for_Posts_i18n();

		$this->loader->dmsfp_add_action( 'plugins_loaded', $plugin_i18n, 'dmsfp_load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function dmsfp_define_admin_hooks() {
        

	   $plugin_admin = new MMSDD_Searching_for_Posts_Admin( $this->dmsfp_get_searching_for_posts(), $this->get_version() );

       $plugin_post = new MMSDD_Search_Post($this->dmsfp_get_searching_for_posts(), $this->get_version());
       

       $plugin_meta = new MMSDD_Search_Post_Meta($this->dmsfp_get_searching_for_posts(), $this->get_version());


        new MMSDD_Ajax_Save_Post_Meta($this->dmsfp_get_searching_for_posts(), $this->get_version());


       $plugin_template =  new MMSDD_Templates( $this->dmsfp_get_searching_for_posts(), $this->get_version() );

       new MMSDD_Shortcode($this->dmsfp_get_searching_for_posts(), $this->get_version());

	   $this->loader->dmsfp_add_action( 'admin_enqueue_scripts', $plugin_admin, 'dmsfp_enqueue_styles' );

	   $this->loader->dmsfp_add_action( 'admin_enqueue_scripts', $plugin_admin, 'dmsfp_enqueue_scripts' );

	   $this->loader->dmsfp_add_action( 'init', $plugin_post, 'dmsfp_new_form_for_searching' ); 
	  
	   $this->loader->dmsfp_add_action( 'init', $plugin_meta, 'dmsfp_register_and_save_meta_boxes' ); 
        
	   $this->loader->dmsfp_add_filter( 'manage_edit-search_post_columns', $plugin_post, 'dmsfp_edit_search_columns' ); 

       $this->loader->dmsfp_add_action( 'manage_search_post_posts_custom_column', $plugin_post, 'dmsfp_manage_search_columns',10,2 ); 

       $this->loader->dmsfp_add_action( 'wp_head', $plugin_template, 'dmsfp_add_head_html');
       
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function dmsfp_define_public_hooks() {

		$plugin_public = new MMSDD_Searching_for_Posts_Public
		($this->dmsfp_get_searching_for_posts(), $this->get_version());

		
		$this->loader->dmsfp_add_action( 'wp_enqueue_scripts', $plugin_public, 'dmsfp_enqueue_styles' );
		$this->loader->dmsfp_add_action( 'wp_enqueue_scripts', $plugin_public, 'dmsfp_enqueue_scripts' );

	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function dmsfp_run() {
		$this->loader->dmsfp_run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function dmsfp_get_searching_for_Posts() {
		return $this->dmsfp_searching_for_posts;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    DMSFP_Searching_for_Posts_Loader    Orchestrates the hooks of the plugin.
	 */
	public function dmsfp_get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

endif;