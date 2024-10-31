class Live_Search{
  
  constructor(){
     
     this.searchField = jQuery(".search-term");
      
     this.selectedCategory = jQuery(".selectedCategory");
     this.checkedCategory = jQuery(".checkedCategory");
     this.radioCategory = jQuery(".radioCategory");
     this.isSpinnerVisible = false;
     this.typingTimer;
     this.events();
     this.isOverlayOpen = false;
     this.template_no_posts;
     this.resultsDiv = jQuery("#search-overlay__results");
     this.isSpinnerVisible = false;
     this.previousValue;


    }

 
 
    events(){
           this.selectedCategory.change(this.getResults.bind(this)); 
        this.checkedCategory.click(this.getResults.bind(this)); 
        this.radioCategory.change(this.getResults.bind(this));  
        this.searchField.on("keyup",this.typingLogic.bind(this));



    }
    
 
 


      
      // While typing in customSearchBox typingLogic function is triggered 
     typingLogic(){
       var $this =this;
       
      var customSearchBox =  this.searchField.val();

      if(
       this.previousValue){
        
           clearTimeout(this.typingTimer);
           
           if(!$this.isSpinnerVisible){
                 $this.resultsDiv.html('<div class="loader"></div>')
                $this.isSpinnerVisible = true;
           }


           this.typingTimer = setTimeout(this.getResults.bind(this),1000);


      
      }
      
        this.previousValue = customSearchBox;
       
       var KeyID = event.keyCode;


        
      switch(KeyID)
         {
            case 8:
             this.no_posts = customSearchBox.length;
            

            break; 
            case 46:
             this.no_posts = customSearchBox.length;
            break;
            default:
            break;
         }

     } 



 getResults(){
      var $this =this;
        this.resultsDiv.html('<div class="loader"></div>')
       var Category=""
       var Tag ="";
       var thisValue ="";
       var selected_tag="";
     
    // $this.isSpinnerVisible = false;
       jQuery('article').css("display","none");
      // jQuery('article').html('.searching-results'); 
       jQuery('.article_content').css("display","none");
       jQuery('.post-separator').css("display","none");
    
             var customSearchBox =  this.searchField.val();

   
            if(this.selectedCategory.val()!=""){

              if(this.selectedCategory.val()){
                 this.resultsDiv.html('<div class="loader"></div>')

               Category = this.selectedCategory.val();
              }
             }else{
               Category = "0";
             }
            





var posts_via_searchkeyword;
var posts_via_category;
var posts_via_keword_and_category;

 

 this.template_no_posts =`
              <header class="archive-header has-text-align-center header-footer-group">
                <div class="archive-header-inner section-inner medium">
                <h3 class="archive-title"><span class="color-accent">`+liveSearchData[0].search_results+`:</span></h3>
                <div class="archive-subtitle section-inner thin max-percentage intro-text"><p>`+liveSearchData[0].not_found_data+`</p>
                </div>
               </div>
          </header>`;
  
"use strict";


var template = jQuery.templates("#pageTmpl");

  if(customSearchBox && !Category){
      
      var $this = this;
    
     jQuery(".data-container").html("");


     jQuery.getJSON(liveSearchData[1].root_url+'namespace/v1/search/'+customSearchBox,function(livesearchposts){
    

         let numberofposts = jQuery("#numberofposts").val();


 (function(name) {

    var container = jQuery('#pagination-' + name);
    container.pagination({
       dataSource:livesearchposts.map(item=>posts_via_searchkeyword = {
      
  title: item.post_title,
  slug:item.post_name,
  post_type:item.post_type,
  excerpt:item.post_content,
  custom_date:moment(new Date(item.post_date)).format('MMMM Do YYYY')
}),
      locator: 'items',
      totalNumber: 120,
      pageSize: parseInt(numberofposts),
      ajax: {
        beforeSend: function() {
          container.prev().html('Loading data from flickr.com ...');
        }
      },
      callback: function(response, pagination) {


        jQuery("#search-overlay__results").css("display","none");

      window.scrollTo({ top: 80, behavior: 'smooth' });

        var dataHtml = '<ul>';

        jQuery.each(response, function (index, item) {

         dataHtml += '<li>' + template.render(item)+ '</li>'
          //: "";
        });

        dataHtml += '</ul>';

        container.prev().html(dataHtml);

           
        
      }


    })
  })('demo2');


}).done(function() { console.log('getJSON request succeeded!'); })
.fail(function(jqXHR, textStatus, errorThrown) { 
 jQuery(".paginationjs-pages").css("display","none");
            jQuery(".data-container").html($this.template_no_posts);
            jQuery("#search-overlay__results").css("display","none");
  console.log('getJSON request failed! ' + textStatus); })
.always(function() { console.log('getJSON request ended!'); });

}else if(!customSearchBox && Category){
  var $this = this;
     
     jQuery('.data-container').html("");


     jQuery.getJSON(liveSearchData[1].root_url+'namespacecat/v1/latest-posts/'+Category,function(livesearchposts){
 $this.resultsDiv.html("");
console.log("category "+livesearchposts);
         let numberofposts = jQuery("#numberofposts").val();


 (function(name) {
    var container = jQuery('#pagination-' + name);
    container.pagination({
       dataSource:livesearchposts.map(item=>posts_via_category = {
  title: item.post_title,
  slug:item.post_name,
  post_type:item.post_type,
  excerpt:item.post_content,
  custom_date:moment(new Date(item.post_date)).format('MMMM Do YYYY')
}),
      locator: 'items',
      totalNumber: 120,
      pageSize: parseInt(numberofposts),
      ajax: {
        beforeSend: function() {
          container.prev().html('Loading data from flickr.com ...');
        }
      },
      callback: function(response, pagination) {
      window.scrollTo({ top: 80, behavior: 'smooth' });


        var dataHtml = '<ul>';


        jQuery.each(response, function (index, item) {



         dataHtml += '<li>' + template.render(item)+ '</li>'
          //: "";
        });

        dataHtml += '</ul>';

        container.prev().html(dataHtml);
      }
    })
  })('demo2');


}).done(function() { console.log('getJSON request succeeded!'); })
.fail(function(jqXHR, textStatus, errorThrown) { 
 jQuery(".paginationjs-pages").css("display","none");
            jQuery(".data-container").html($this.template_no_posts);
            jQuery("#search-overlay__results").css("display","none");
  console.log('getJSON request failed! ' + textStatus); })
.always(function() { console.log('getJSON request ended!'); });

}else if(customSearchBox && Category){
      var $this = this;

if(customSearchBox && jQuery(".selectedCategory").val()==""){
    
      var $this = this;

    console.log("category "+jQuery(".selectedCategory").val());
     jQuery(".data-container").html("");


     jQuery.getJSON(liveSearchData[1].root_url+'namespace/v1/search/'+customSearchBox,function(livesearchposts){
    

         let numberofposts = jQuery("#numberofposts").val();


 (function(name) {

    var container = jQuery('#pagination-' + name);
    container.pagination({
       dataSource:livesearchposts.map(item=>posts_via_searchkeyword = {
      
  title: item.post_title,
  slug:item.post_name,
  post_type:item.post_type,
  excerpt:item.post_content,
  custom_date:moment(new Date(item.post_date)).format('MMMM Do YYYY')
}),
      locator: 'items',
      totalNumber: 120,
      pageSize: parseInt(numberofposts),
      ajax: {
        beforeSend: function() {
          container.prev().html('Loading data from flickr.com ...');
        }
      },
      callback: function(response, pagination) {


        jQuery("#search-overlay__results").css("display","none");

      window.scrollTo({ top: 80, behavior: 'smooth' });

        var dataHtml = '<ul>';

        jQuery.each(response, function (index, item) {

         dataHtml += '<li>' + template.render(item)+ '</li>'
          //: "";
        });

        dataHtml += '</ul>';

        container.prev().html(dataHtml);

           
        
      }


    })
  })('demo2');


}).done(function() { console.log('getJSON request succeeded!'); })
.fail(function(jqXHR, textStatus, errorThrown) { 
 jQuery(".paginationjs-pages").css("display","none");
           jQuery(".data-container").html($this.template_no_posts);
            jQuery("#search-overlay__results").css("display","none");
  console.log('getJSON request failed! ' + textStatus); })
.always(function() { console.log('getJSON request ended!'); });
}else if(customSearchBox && jQuery(".selectedCategory").val()!=""){

 var $this =this;
       jQuery('.data-container').html("");

       jQuery.getJSON(liveSearchData[1].root_url+'namespace/v1/search/'+customSearchBox,function(postsCustomSearchBox){
     jQuery.getJSON(liveSearchData[1].root_url+'namespacecat/v1/latest-posts/'+Category,function(postsCategory){
  
      $this.resultsDiv.html("");
 
   var posts_result =  postsCustomSearchBox.filter(item=>item.post_title == postsCategory.map(item=>item.post_title));
 console.log("posts_result "+posts_result.length);


 if (posts_result === undefined || posts_result.length == 0 ) {    
            
            jQuery(".paginationjs-pages").css("display","none");
            

            jQuery(".data-container").html($this.template_no_posts);
           
            jQuery("#search-overlay__results").css("display","none");
           
   }

         let numberofposts = jQuery("#numberofposts").val();


 (function(name) {
    var container = jQuery('#pagination-' + name);
    container.pagination({
       dataSource:posts_result.map(item=>posts_via_keword_and_category = {
       title: item.post_title,
  slug:item.post_name,
  post_type:item.post_type,
  excerpt:item.post_content,
  custom_date:moment(new Date(item.post_date)).format('MMMM Do YYYY')
}),
      locator: 'items',
      totalNumber: 120,
      pageSize: parseInt(numberofposts),
      ajax: {
        beforeSend: function() {
          container.prev().html('Loading data from flickr.com ...');
        }
      },
      callback: function(response, pagination) {
        window.scrollTo({ top: 100, behavior: 'smooth' });

if (posts_result === undefined || posts_result.length == 0) {
       jQuery(".paginationjs-pages").css("display","none");
}
        var dataHtml = '<ul>';


        jQuery.each(response, function (index, item) {

         dataHtml += '<li>' + template.render(item)+ '</li>'
          //: "";
        });

        dataHtml += '</ul>';

        container.prev().html(dataHtml);
      }
    })
  })('demo2');



});
 
 }).done(function() { console.log('getJSON request succeeded!'); })
.fail(function(jqXHR, textStatus, errorThrown) { 
 jQuery(".paginationjs-pages").css("display","none");
            jQuery(".data-container").html($this.template_no_posts);
            jQuery("#search-overlay__results").css("display","none");
  console.log('getJSON request failed! ' + textStatus); })
.always(function() { console.log('getJSON request ended!'); });
}
 }
 }

}



var liveSearch = new Live_Search();