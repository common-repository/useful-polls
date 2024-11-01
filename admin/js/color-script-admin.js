

jQuery(document).ready(function($){
     jQuery('.color_for_submit_button').wpColorPicker();

	 jQuery('.color_for_vote_line').wpColorPicker();

    jQuery('.color_for_question').wpColorPicker();
    jQuery('.color_for_answers').wpColorPicker();
    jQuery('.color_for_background').wpColorPicker();

});


jQuery(document).on('click', '#submitcolor', function(event){ // use jQuery no conflict methods replace $ with "jQuery"
      
        event.preventDefault(); // stop post action

      jQuery.ajax({
          type: "POST",
          url: ajax_object.ajax_url,
          data: {
              'action': 'color_of_form_results',
                'number_of_color': jQuery('input[id="number_of_color"]').val(),
               'color_for_submit_button': jQuery('input[id="color_for_submit_button"]').val(),

               'color_for_vote_line': jQuery('input[id="color_for_vote_line"]').val(),

              'color_for_question': jQuery('input[id="color_for_question"]').val(),
              'color_for_answers': jQuery('input[id="color_for_answers"]').val(),
              'color_for_background': jQuery('input[id="color_for_background"]').val(),
 
          }
         
      }); 
  });

