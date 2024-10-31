<?php
namespace SearchingForPosts\Admin;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MMSDD_Search_Post_Meta') ) :
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

class MMSDD_Search_Post_Meta{


/**
 * Adds a meta box to the post editing screen
*/
public function __construct(){
    add_action("init",[$this,"dmsfp_register_and_save_meta_boxes"]);
    //add_action( "rest_api_init", [$this,'dmsfp_search_posts'] );
    add_action( "rest_api_init", [$this,'dmsfp_search_categories'] );
    add_action( 'rest_api_init', [$this,'namespace_register_search_route']);


}


public function dmsfp_register_and_save_meta_boxes(){
    add_action( 'save_post', [$this,'dmsfp_save_meta_boxes'] );
    add_action( 'add_meta_boxes', [$this,'dmsfp_add_meta_boxes'] );
}



function dmsfp_search_categories(){
    register_rest_route( 'namespacecat/v1', 'latest-posts/(?P<category_id>\d+)', [
           
            'methods' => \WP_REST_Server::READABLE,
           'callback' => [$this,'namespace_terms_search'],
           'permission_callback' => '__return_true'
        ]);
  }



  function namespace_terms_search($request){
 
    $args = array(
   'public'   => true,
    'show_in_nav_menus' => true
   //'_builtin' => false
);

$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'

              $post_types = get_post_types( $args, $output, $operator );
              $taxonomies = get_taxonomies( $args, $output, $operator );


 global $wpdb;            

                # code...
 $term_id = absint($request['category_id']);                        
foreach ($post_types as $post_type) {
  


$args =array("category"=>$request['category_id']);
$posts = get_posts($args);


 
    return $posts;

  
   
}

  wp_reset_postdata();

  
                     
 }                           
                
                
  
  

/**
*  dmsfp_add_meta_boxes
*
*  Adding meta boxes to custom post type
*  that is using for making a search form
*
*
*  @param $post_type (string)
*  @return  (string)
*/
  

public function dmsfp_add_meta_boxes() {
   // meta boxes for adding different criteria for searching
   add_meta_box( 'prfx_meta_form', __( 'Search Form', 'searching-for-posts' ), [$this,'dmsfp_add_meta_callback_form'], 'search_post', 'normal', 'default'
 );

  
   
}

function namespace_register_search_route() {
    register_rest_route('namespace/v1', '/search/(?P<s>[a-zA-Z0-9-]+)', [
        'methods' => \WP_REST_Server::READABLE,
        'callback' => [$this,'namespace_ajax_search'],
        'permission_callback' => '__return_true',
        'args' => [$this->namespace_get_search_args()]
    ]);
}

/**
 * Define the arguments our endpoint receives.
 */
function namespace_get_search_args() {
    $args = [];
    $args['s'] = [
       'description' => esc_html__( 'The search term.', 'namespace' ),
       'type'        => 'string',
   ];
   return $args;
}

function namespace_ajax_search( $request) {
   
  
   $args = array(
   'public'   => true,
    'show_in_nav_menus' => true
   //'_builtin' => false
);

$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'

              $post_types = get_post_types( $args, $output, $operator );


 global $wpdb;            
foreach ($post_types as $post_type) { 
              

//$posts_meta = esc_attr(get_post_meta( $post->ID, $post_type, true  ));
//$searchposts = esc_attr(get_post_meta($post->ID,'searchposts', true ));
$pageposts =$wpdb->get_results( $wpdb->prepare("SELECT meta_key
    FROM $wpdb->postmeta WHERE meta_value = '1' AND meta_key = '".$post_type."'"));
foreach ($pageposts as $key) {
  # code...

$args =array("post_type"=>[$key->meta_key],'s'=>$request['s']);
$posts = get_posts($args);


  foreach($posts as $post) {
   // setup_postdata($post);
$posts = get_posts($post);
return $posts;

  
   }
  wp_reset_postdata();
}}
}
          
/**
*  prefix_sanitize_input
*
*  Checking if expected value is "yes", if it is then
*  show that searching criteria at the front end
*
*  @type  prefix_sanitize_input
*  @date  28/04/2020
*  @since 5.4.0
*
*/
  

public function dmsfp_prefix_sanitize_input( $input, $expected_value="yes" ) {
    if ( $expected_value == $input ) {
        return $expected_value;
    } else {
        return '';
    }
}


/**
*  get_searching_criteria
*
*  if check in posts then searching will be by posts etc. 
*
*  @type  get_searching_criteria
*  @date  28/04/2020
*  @since 5.4.0
*
*/
 
public function dmsfp_get_searching_criteria() { 
    return array(

            'posts'   => __( 'Search Posts', 'searching-for-posts' ),
            'categories'    => __( 'Search Categories', 'searching-for-posts' )
        );
}


/**
*  add_meta_callback_form
*  
*  By default searching is by dropdown menu 
*
*  if check in checkbox ( for example: taxonomies),
*  then searching will be by taxonomies select form in checkbox menu
*
*  @type  add_meta_callback_form
*  @date  28/04/2020
*  @since 5.4.0
*
*/

public function dmsfp_add_meta_callback_form( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
   
    $prfx_stored_meta = get_post_meta( esc_attr($post->ID) );
 


foreach ( $this->dmsfp_get_searching_criteria() as $option => $text ) :

/* determine what kind of class is checked
*  ( if checked selecttaxonomies then there are unchecked categories and tags)
*  vice versa
*/



$searchoptions =get_post_meta( get_the_ID(), 'search'.$option, true );

$sanitized_checkbox = $searchoptions =="yes"? $this->dmsfp_prefix_sanitize_input($searchoptions, 'yes'): ''; 

?>
<!-- 
checkboxes that control is it checked taxonomies or something else
therefore different type of searching criteria are appearing on the front end 
 -->

     

        <p>
            <input type="checkbox" id="search<?php esc_attr_e( $option ); ?>" name="search<?php echo esc_attr($option); ?>"  value="1" <?php checked(esc_attr($sanitized_checkbox),"yes" ); ?>/>
            <label for="search<?php esc_attr($option); ?>"><?php _e($text,'searching-for-posts' ); ?>
          </label>
        </p>
<?php endforeach;
?>
<p>
<?php
    //Display how many of posts is in a current category
   $display_category_count = esc_attr(get_post_meta( get_the_ID(),"display_category_count", true));
   $sanitized_checkbox_category_count = $display_category_count ==1? $this->dmsfp_prefix_sanitize_input($display_category_count, 1): ''; 
 
 ?> 
</p>


<p>
     
    <label><input type="checkbox" name="display_category_count" value="1"  <?php checked(esc_attr($sanitized_checkbox_category_count), 1 ); ?>/><?php _e("Display a number of posts in category","searching-for-posts"); ?></label>
    <br>
       


 </p>

<br>

<?php  //Number of posts that will be showing during searching
      $numberofposts =  esc_attr(get_post_meta( get_the_ID(), 'numberofposts', true ));
     
?>
 <p>
      <label for="selectnumberofposts"><?php _e('Select number of posts (between 1 and 15) per page: ','searching-for-posts'); ?></label>
      <input type="number" class="selectnumberofposts" name="numberofposts" 
            value="<?php echo esc_attr($numberofposts); ?>" 
           min="1" max="15">
</p>
  <br>
  <br>
  <?php
      $custom = get_post_meta( esc_attr($post->ID) );



    $color_of_background = ( isset( $custom['color_of_background'][0] ) ) ? $custom['color_of_background'][0] : '';
?>
  <label for="color_of_background"><?php _e('Color for background of posts: ','searching-for-posts'); ?></label>

          <input id="color_of_background" class="background_color_of_article" type="text" name="color_of_background" value="<?php esc_attr_e( $color_of_background ); ?>"/>
  <br>
  <br>
   <?php



    $color_of_text = ( isset( $custom['color_of_text'][0] ) ) ? $custom['color_of_text'][0] : '';
?>
  <label for="color_of_text"><?php _e('Color for text in posts: ','searching-for-posts'); ?></label>

          <input id="color_of_text" class="text_color_of_article" type="text" name="color_of_text" value="<?php esc_attr_e( $color_of_text ); ?>"/>
  <br>
  <br>
<?php 

              $args = array(
   'public'   => true,
    'show_in_nav_menus' => true
   //'_builtin' => false
);

$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'

$post_types = get_post_types( $args, $output, $operator );

foreach ( $post_types  as $post_type ) {

      if($post_type == "search_post" || $post_type == "page"){
//        return;
      }else{
      $post_meta =  esc_attr(get_post_meta( get_the_ID(), $post_type, true ));
      
  
?>
 <p>
      <label><input type="checkbox" name="<?php echo $post_type; ?>" value="1"  <?php checked(esc_attr($post_meta), 1 ); ?>/><?php _e("Display ".$post_type."","searching-for-posts"); ?></label>
</p>
 
 
<?php  

     } 
  }    
}


/**
 * Saves the custom meta input
 */
function dmsfp_save_meta_boxes( $post_id ) {
 
    // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    
// Checks for input and saves - save checked as yes and unchecked at no
if(isset($_POST[ 'searchposts' ]) && sanitize_text_field($_POST[ 'searchposts' ]) ){
    update_post_meta( $post_id, 'searchposts', "yes" );
} else {
    update_post_meta( $post_id, 'searchposts', "no" );
}


// Checks for input and saves - save checked as yes and unchecked at no
if(isset($_POST[ 'searchcategories' ]) && sanitize_text_field($_POST[ 'searchcategories' ]) ) {
    update_post_meta( $post_id, 'searchcategories', "yes" );
    
} else {
    update_post_meta( $post_id, 'searchcategories', "no" );
}




// Checks for input and saves - save checked as yes and unchecked at no
if(isset($_POST[ 'numberofposts' ]) && sanitize_text_field($_POST[ 'numberofposts' ])  ) {
    update_post_meta( $post_id, 'numberofposts', $_POST[ 'numberofposts' ] );
} else {
    update_post_meta( $post_id, 'numberofposts', 1 );
} 
$numberofposts = get_post_meta( $post_id, 'numberofposts', true ); 
if( $numberofposts !=""  ) {
    update_post_meta( $post_id, 'numberofposts', esc_attr($numberofposts)  );
}else{
      update_post_meta( $post_id, 'display_pagination', 1  );

}  



    $color_of_text = (isset($_POST['color_of_text']) && $_POST['color_of_text']!='') ? $_POST['color_of_text'] : '';
    update_post_meta($post_id, 'color_of_text', $color_of_text);


        $color_of_background = (isset($_POST['color_of_background']) && $_POST['color_of_background']!='') ? $_POST['color_of_background'] : '';
    update_post_meta($post_id, 'color_of_background', $color_of_background);

$display_category_count = ( isset( $_POST['display_category_count']) && '1' === $_POST['display_category_count'] ) ? 1 : 0;
    update_post_meta($post_id, "display_category_count",   esc_attr($display_category_count ));    
   
 


        $args = array(
   'public'   => true,
    'show_in_nav_menus' => true
   //'_builtin' => false
);

$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'

$post_types = get_post_types( $args, $output, $operator ); 



foreach ( $post_types  as $post_type ) {
    // Checks for input and saves - save checked as yes and unchecked at no
if(isset($_POST[ $post_type ]) && sanitize_text_field($_POST[ $post_type ]) ) {
    update_post_meta( $post_id, $post_type, 1 );
    
} else {
    update_post_meta( $post_id, $post_type, 0 );
}
/*
    $post_type = ( isset( $_POST[$post_type] ) && '1' === $_POST[$post_type] ) ? 1 : 0; // Input var okay.
    update_post_meta( $post_id, $post_type, esc_attr( $_POST[$post_type] ) );

*/
}


 }

}

endif;