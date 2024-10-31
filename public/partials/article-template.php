<?php

      $posts = get_posts(['post_type' =>"search_post"]);

              
                
              foreach ($posts as $post) {
               
            
             
              $color_of_background = esc_attr(get_post_meta( $post->ID,"color_of_background", true  ));

              $color_of_text = esc_attr(get_post_meta( $post->ID,"color_of_text", true  ));

             }

           

?>


<script id="pageTmpl" type="text/x-jsrender">

<article class="post type-post status-publish format-standard" style="background-color:<?php esc_attr_e( $color_of_background ); ?>">
  <div style="color:<?php esc_attr_e( $color_of_text ); ?>">
    {{if post_type !="search_post"}}
    <header class="entry-header has-text-align-center">

        <div class="entry-header-inner section-inner medium">

      <div class="entry-categories">
        
        <div class="entry-categories-inner"></div>
        
        <span class="cat-links"> 
          

          <span class="screen-reader-text">Categories</span>   
       
          {{for category_loop}}
                <a href="{{:link}}"  rel="category">{{:name}} </a> /
          {{/for}} 
    
        </span>
      
      </div>
            
      <h2 class="entry-title heading-size-1">
        <a href="{{:slug}}">{{:title}}</a>
      </h2>  
            
    </header> 

   <div class="has-text-align-center">   
       <span class="sep">Posted on 
              <span class="dashicons dashicons-calendar-alt my_css_dashicon"></span>
       </span>
          
        <a class="url fn n">
          {{:custom_date}}
        </a>
      
       <time class="entry-date" datetime=""></time>

   </div>
      
              
   <div class="entry-content has-text-align-center">
      {{:excerpt}}<a class="read-more-btn" href="{{:post_type}}/{{:slug}}">[...]</a>
   </div>
  



{{/if}}
</div>
</article>
</script>
