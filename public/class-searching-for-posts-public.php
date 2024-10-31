<?php
namespace SearchingForPosts\FrontEnd;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MMSDD_Searching_for_Posts_Public') ) :
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    DMSFP_Searching_for_Posts
 * @subpackage DMSFP_Searching_for_Posts/public
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class MMSDD_Searching_for_Posts_Public {

	
	private $searching_for_posts;

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
	 * @param      string    $DMSFP_Searching_for_Posts       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	
	public function __construct( $searching_for_posts, $version ) {

		$this->searching_for_posts = $searching_for_posts;
		$this->version = $version;

	}

	
	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->searching_for_posts, plugin_dir_url( __FILE__ ) . 'css/searching-for-posts-public.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->searching_for_posts, plugin_dir_url( __FILE__ ) . 'css/pagination.css', array(), $this->version, 'all' );

	

   } 
    /**
	 * Register the JavaScript for the public-facing side of the site.
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
    
       wp_enqueue_script( 'jquery');
	//moment is necessery for getting a date
    wp_enqueue_script( 'moment');


    	//necessery for rendering data in html template	
	wp_register_script( 'jsrender',  plugin_dir_url( __FILE__ ) . 'js/jsrender.js', array('jquery'), $this->version, true );
    wp_enqueue_script( 'jsrender');



    wp_enqueue_style( 'dashicons' );      
   
    

  
	  // Localize the script with new data
	  $translation_array = array(
	    'search_results' => __( 'Search Results', 'searching-for-posts' ),
	    'not_found_data' =>  __( 'We could not find any results for your search. You can give it another try with different criteria.', 'searching-for-posts' )
	 );

   wp_register_script( 'ajax-script-public', plugin_dir_url( __FILE__ ) . 'js/searching-for-posts-public.js', array( 'jquery' ), $this->version, true );
    
   wp_enqueue_script( 'ajax-script-public' );

   // Great for getting Rest Api data on the front end
   wp_localize_script( 'ajax-script-public', 'liveSearchData',[$translation_array,
            array( 'root_url' => get_rest_url())]);


wp_register_script( 'script-pagination', plugin_dir_url( __FILE__ ) . 'js/pagination.js', array( 'jquery' ), $this->version, true );
                  
                 wp_enqueue_script( 'script-pagination' );
                   // Great for getting Rest Api data on the front end
   

   wp_register_script( 'for-render', plugin_dir_url( __FILE__ ) . 'js/for-render.js', array( 'jquery' ), $this->version, true );
    
   wp_enqueue_script( 'for-render' );                 

 }

}

endif;