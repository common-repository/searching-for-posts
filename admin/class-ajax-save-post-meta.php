<?php
namespace SearchingForPosts\Admin;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MMSDD_Ajax_Save_Post_Meta') ) :

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    DMSFP_Searching_for_Posts
 * @subpackage DMSFP_Searching_for_Posts/admin
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */

class MMSDD_Ajax_Save_Post_Meta{


  
public function __construct(){
    
    add_action( 'wp_ajax_select_form', [$this,'dmsfp_select_form' ]);
    add_action( 'wp_ajax_nopriv_select_form', [$this,'dmsfp_select_form' ]);

}  
	
/**
*  dmsfp_select_form
*
*  This function will change a form of selection that is going to appear 
*  as the searching criteria on front end of website
*
*  @param $post_type (string)
*  @return  (string)
*/
	

public function dmsfp_select_form() { 
   
    $selectformoftaxonomy     = sanitize_text_field($_POST["selectformoftaxonomy"]);
    $selectformofcategory     = sanitize_text_field($_POST["selectformofcategory"]);
    $numberofposts      = sanitize_text_field($_POST["numberofposts"]);
    $selecttotalnumberofposts = sanitize_text_field($_POST["selecttotalnumberofposts"]);
   
    $args = array(
          'order'           => 'ASC',
          'post_type'       => 'search_post'
        
        );
 
  
    $the_query = new \WP_Query( $args );

    // The Loop
    while ( $the_query->have_posts() ) :
        $the_query->the_post();
 


        /* Update post meta in terms of checking what 
           kind of form is selected  */
        
        if($selectformoftaxonomy !=""){
           
             update_post_meta(get_the_ID(), 'formoftaxonomy', esc_attr($selectformoftaxonomy));
        }   
        
      
        if($selectformofcategory !=""){
          
             update_post_meta(get_the_ID(), 'formofcategory', esc_attr($selectformofcategory));
        }   
        

         if($numberofposts !=""){
          
           
             update_post_meta(get_the_ID(), 'numberofposts', esc_attr($numberofposts));
        }

         if($selecttotalnumberofposts !=""){
          
           
             update_post_meta(get_the_ID(), 'totalnumberofposts', esc_attr($selecttotalnumberofposts));
        }    
     endwhile;

    die();
   }
}

endif;


