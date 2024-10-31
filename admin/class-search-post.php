<?php
namespace SearchingForPosts\Admin;
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MMSDD_Search_Post') ) :

/**
 * Class that contains the custom post type that is responsible for
 * making a search form on front end
 *
 *
 * @package    DMSFP_Searching_for_Posts
 * @subpackage DMSFP_Searching_for_Posts/admin
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class MMSDD_Search_Post{

   /**
   * Creates a custom post type by default by activation of a plugin that will be using as * a search form on front end
   * for using for searching of posts
   *
   * @uses  register_post_type()
   */

  public static function dmsfp_new_form_for_searching() {

    $cap_type   = 'post';
    $plural   = 'Searches';
    $single   = 'Search';
    $cpt_name   = 'search_post';

    $opts['can_export']               = TRUE;
    $opts['capability_type']            = $cap_type;
    $opts['description']              = '';
    $opts['exclude_from_search']          = false;
    $opts['has_archive']              = FALSE;
    $opts['hierarchical']             = FALSE;
    $opts['map_meta_cap']             = TRUE;
    $opts['menu_icon']                = 'dashicons-search';
    $opts['menu_position']              = 25;
    $opts['public']                 = TRUE;
    $opts['publicly_querable']            = false;
    $opts['query_var']                = TRUE;
    $opts['register_meta_box_cb']         = '';
    $opts['rewrite']                = FALSE;
    $opts['show_in_admin_bar']            = TRUE;
    $opts['show_in_menu']             = TRUE;
    $opts['show_in_nav_menu']           = TRUE;
    $opts['show_in_rest']           = FALSE;
    $opts['show_ui']                = true;
    $opts['supports']               = array( 'title' );
    $opts['taxonomies']               = array();

    $opts['capabilities']['delete_others_posts']  = "delete_others_{$cap_type}s";
    $opts['capabilities']['delete_post']      = "delete_{$cap_type}";
    $opts['capabilities']['delete_posts']     = "delete_{$cap_type}s";
    $opts['capabilities']['delete_private_posts'] = "delete_private_{$cap_type}s";
    $opts['capabilities']['delete_published_posts'] = "delete_published_{$cap_type}s";
    $opts['capabilities']['edit_others_posts']    = "edit_others_{$cap_type}s";
    $opts['capabilities']['edit_post']        = "edit_{$cap_type}";
    $opts['capabilities']['edit_posts']       = "edit_{$cap_type}s";
    $opts['capabilities']['edit_private_posts']   = "edit_private_{$cap_type}s";
    $opts['capabilities']['edit_published_posts'] = "edit_published_{$cap_type}s";
    $opts['capabilities']['publish_posts']      = "publish_{$cap_type}s";
    $opts['capabilities']['read_post']        = "read_{$cap_type}";
    $opts['capabilities']['read_private_posts']   = "read_private_{$cap_type}s";

    $opts['labels']['add_new']            = esc_html__( "Add Search Form ", 'searching-for-posts' );
    $opts['labels']['add_new_item']         = esc_html__( "Add New {$single}", 'searching-for-posts' );
    $opts['labels']['all_items']          = esc_html__( $plural, 'searching-for-posts' );
    $opts['labels']['edit_item']          = esc_html__( "Edit {$single}" , 'searching-for-posts' );
    $opts['labels']['menu_name']          = esc_html__( $plural, 'searching-for-posts' );
    $opts['labels']['name']             = esc_html__( $plural, 'searching-for-posts' );
    $opts['labels']['name_admin_bar']       = esc_html__( $single, 'searching-for-posts' );
    $opts['labels']['new_item']           = esc_html__( "New {$single}", 'searching-for-posts' );
    $opts['labels']['not_found']          = esc_html__( "No {$plural} Found", 'searching-for-posts' );
    $opts['labels']['not_found_in_trash']     = esc_html__( "No {$plural} Found in Trash", 'searching-for-posts' );
    $opts['labels']['parent_item_colon']      = esc_html__( "Parent {$plural} :", 'searching-for-posts' );
    $opts['labels']['search_items']         = esc_html__( "Search {$plural}", 'searching-for-posts' );
    $opts['labels']['singular_name']        = esc_html__( $single, 'searching-for-posts' );
    $opts['labels']['view_item']          = esc_html__( "View {$single}", 'searching-for-posts' );

    $opts['rewrite']['ep_mask']           = EP_PERMALINK;
    $opts['rewrite']['feeds']           = FALSE;
    $opts['rewrite']['pages']           = TRUE;
    $opts['rewrite']['slug']            = esc_html__( strtolower( $plural ), 'searching-for-posts' );
    $opts['rewrite']['with_front']          = FALSE;

    $opts = apply_filters( 'searching-for-posts-cpt-options', $opts );

    register_post_type( strtolower( $cpt_name ), $opts );
   }

   //custom columns of search form ( custom search post ) in admin area
   public static function dmsfp_edit_search_columns( $columns ) {

        $columns = array(
          'cb' => '&lt;input type="checkbox" />',
          'title' => __( 'Search Form', 'searching-for-posts'),
          'shortcode' => 'Shortcode',
          'date' => __( 'Date','searching-for-posts' )
        );

      return $columns;
   }


  //custom columns of search form ( custom search post ) in admin area
   public static function dmsfp_manage_search_columns($column, $post_id ) {

      switch( $column ) {

           case "shortcode";

          
        
       global $shortcode_tags; 
       

       
       foreach($shortcode_tags as $code => $function)
            {

                if($code=="search_post"){
                echo "[".$code. " id='".$post_id."']";
                }    
             }
        break;
        
  
       }
     
     }

}


endif;