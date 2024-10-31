<?php
namespace SearchingForPosts\FrontEnd;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MMSDD_Templates') ) :
/**
 *
 * This class defines all code necessary to run templates of articles during
 * searching as well as pagination 
 * 
 * @package    DMSFP_Searching_for_Posts
 * @subpackage DMSFP_Searching_for_Posts/public
 * @author     Dragan Milunovic  <drmilun9@gmail.com>
*/
 class MMSDD_Templates {
        

	        public function dmsfp_add_head_html() { 
	         	require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/article-template.php';
		     }	     

	  
}

endif;