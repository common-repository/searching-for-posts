<?php
namespace SearchingForPosts\FrontEnd;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MMSDD_Shortcode') ) :
/**
 *
 * This class defines is responsible for appering of shortcode of custom post type (search post) that is appearing as form in front end that is made of different searching criteries 
 *
 * @package     DMSFP_Shortcode
 * @subpackage  DMSFP_Shortcode/includes
 * @author      Dragan <drmilun9@gmail.com>
 */
class MMSDD_Shortcode{
    
    public function __construct(){
         
             add_shortcode( "search_post", [$this,"dmsfp_register_custom_shortcode"]);
              add_action( 'wp_head', [$this,'delete_all_terms'] );   

    }

 
function delete_all_terms(){
    $taxonomy_name = 'twentytwentyone';
    $terms = get_terms( array(
        'taxonomy' => $taxonomy_name,
        'hide_empty' => false
    ) );
    
}

       




    function dmsfp_prefix_sanitize_checkbox( $input, $expected_value="yes" ) {
          if ( $expected_value == $input ) {
              return $expected_value;
          } else {
              return '';
          }
    }
    



    function dmsfp_prefix_sanitize_input( $input, $expected_value="yes" ) {
            if ( $expected_value == $input ) {
                return $expected_value;
            } else {
                return '';
            }
    }

    

    

    function dmsfp_get_searching_criteria() { 
          return array(
                  'posts'   => __( 'Search Posts', 'searching-for-posts' ),
                  'categories'    => __( 'Search Categories', 'searching-for-posts' )
              );
    }

     




    function dmsfp_register_custom_shortcode($atts, $taxonomy_2 = 'category',$request){
                  
               $a = shortcode_atts( array(
                      
                      'id' => '',

                  ), $atts);  


               if(!is_admin()){
              $searchposts_form="";
              $searchposts = "";
              $searchcategories="";
              $searchtaxonomies="";
              $pagination_form="";
              $display_category_count="";
              $display_taxonomy_count="";
              $posts_meta ="";

             
             
              $posts = get_posts(['post_type' =>"search_post",$a["id"]]);

              $args = array(
                 'public'   => true,
                  'show_in_nav_menus' => true
                 //'_builtin' => false
              );

              $output = 'names'; // names or objects, note names is the default
              $operator = 'and'; // 'and' or 'or'


              $post_types = get_post_types( $args, $output, $operator );
                
              foreach ($posts as $post) {
               
                   
              $searchposts = esc_attr(get_post_meta($post->ID,'searchposts', true ));

              $searchcategories = esc_attr(get_post_meta( $post->ID, 'searchcategories', true )); 
             
              $display_category_count = esc_attr(get_post_meta( $post->ID,"display_category_count", true  ));
             
              $number_of_posts = esc_attr(get_post_meta( $post->ID,"numberofposts", true  ));

             
             }
 
       


  
            if($searchposts == "yes"){ 
                        
               $searchposts_form = '<input type="text" class="search-term" style="max-width: 150px"  placeholder="'.__("Search...","text-domain") .'"/>
               ';}

          

            $categories_search_form ="";
               // Sanitize and vaidate our incoming data
            
              if($searchcategories == "yes"){ 

                           
               
              
                   
                          
              $categories_search_form .='<select class="selectedCategory">';
                          
                          $categories_search_form .= '<option value="">'.__("Select Category","searching-for-posts").'</option>';


                        foreach ($post_types as $post_type) {
              
              foreach ($posts as $post) {

             $post_meta =  esc_attr(get_post_meta( $post->ID, $post_type, true ));



                 $taxonomy = get_taxonomies(); 

                  if($post_meta == 1){
                      
                  $someposts = get_posts(
                      array(
                          'post_type' => $post_type,
                          'posts_per_page' => -1,
                          'fields' => 'ids', // return an array of ids
                      )
                  );

                  $terms_cat = get_terms(
                      array(
                          'taxonomy' => $taxonomy,
                          'object_ids' => $someposts,
                          'hide_empty' => true,
                      )
                  );

                        
   
                       foreach ($terms_cat as $term) {
                              $categories_search_form .='<option id="term_id" value="'.esc_attr($term->term_id).'">'.($term->parent ? 'podcategory - ' :'').$term->name.' '. ($display_category_count === "1" ? '( '. $term->count .' )': '').'</option>'.($term->parent ? '"'.$term->name.'"' :'');        }
                               
                    }   }
     
            }
            
                $categories_search_form .='</select>';
                } 
                ?>
                <div class="searching-results">

                   <ul class="searching-form">
                    
                     <li>
                      <?php
                     if(!empty($searchposts)){
                        echo $searchposts_form;
                    }
                       ?>
                    </li>
                    
                     <li>
                     <?php 
                       if(!empty($searchcategories)){
                             echo $categories_search_form;
                          }
                     ?>
                     </li> 
                   

                      <div id="container">
                            <div style="clear: both;"></div>

                       <div id="search-overlay__results"></div>
                        
                      </div>
 
                   </ul> 
                  
                  </div>

              <?php


               




                  
               
              $posts = get_posts(['post_type' =>"search_post",$a["id"]]);
              

                
              foreach ($posts as $post) {
                ?>
                <input id="numberofposts" type="hidden" value="<?php echo get_post_meta($post->ID,'numberofposts',true); ?>"/> 
                <?php 
               }
         

               if ( is_active_widget(false, false, 'DMSFP_Searching_for_Posts_Widget', true) ) { // check if search widget is used
                ?>
                    <script type="text/javascript">
                      jQuery(document).ready(function(){
                    jQuery("header").after(
                    '<div class="searching-results">'+
'<div id="wrapper"><section><div class="data-container"></div>'+
'<div style="clear: both;"></div>'+
'<div id="pagination-demo2"></div></section></div></div>');
                      });
                    </script>

                <?php
} else {

            ?>
                <script>

                jQuery(document).ready(function(){
                  
                
                  jQuery("header:first").after(
                    '<div class="searching-results">'+
'<div id="wrapper"><section><div class="data-container"></div>'+
'<div style="clear: both;"></div>'+
'<div id="pagination-demo2"></div></section></div></div>');
                
                });
              </script>

              <?php
                 
}
         


         
   
  }
 }
}
endif;
