
jQuery(".edit_form").on("click", function(e){
     e.preventDefault();

    jQuery(this).parent().parent().next().show();
});

jQuery(".close_form").on("click", function(){
 
    jQuery(this).parent().parent().parent().parent().hide();
});

jQuery(document).on('click', '.components-button', function(){ // use jQuery no conflict methods replace $ with "jQuery"

   jQuery("#close_me").show();

});
