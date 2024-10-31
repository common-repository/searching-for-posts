jQuery(document).ready(function () {


     
  // add multiple select / deselect functionality
  jQuery(".selecttaxonomies").click(function () {
      jQuery('.selectsearching').removeAttr('checked', this.checked);
  });

 
  /* if all checkbox are selected, check the selecttaxonomies checkbox
   and viceversa */
  jQuery(".selectsearching").click(function(){

    if(jQuery(".selectsearching:checked").length == 0 || jQuery(".selectsearching:checked").length == 1 ) {
      jQuery(".selecttaxonomies").removeAttr("checked", "checked");
    } else {
      jQuery(".selecttaxonomies").attr("checked");
    }


});


/* these select css inside jQuery classes 
 * are triggering functions select_form
 * by ajax in class DMSFP_Ajax_Save_Post_Meta
*/
jQuery(".selectnumberofposts").bind('keyup mouseup', function () {
      var selectnumberofposts  = jQuery(".selectnumberofposts").val();
        
         jQuery.ajax({
         
           type: "POST",
           url: ajax_object.ajax_url,
           data: {
             action:"select_form", 
             numberofposts:selectnumberofposts
           
           },
        
          success: function(msg){
               //console.log('working');
          },
          error: function(errorThrown){
               //console.log("not working ");
          }
           
          
    });

     
});
         


});


