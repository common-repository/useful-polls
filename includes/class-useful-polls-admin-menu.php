<?php
namespace Useful_Polls\Includes;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('DMUP_Useful_Polls_Color_Elements') ) :

session_start();



/**
 *
 * @since      1.0.0
 * @package    Useful_Polls_Admin_Menu
 * @subpackage Useful_Polls_Admin_Menu/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class DMUP_Useful_Polls_Admin_Menu {



public function __construct(){
    add_action( "admin_menu", [$this,"useful_poll_add_admin_page"] );

}


public function useful_poll_add_admin_page(){
	
	add_menu_page( "Useful Poll Options", "Poll", "manage_options", "useful_poll", [$this,'useful_poll_create_page'], 'dashicons-editor-alignleft', 110 );
    
    add_submenu_page( "useful_poll", "Useful Poll Options", "Settings", "manage_options", "useful_poll", [$this,'useful_poll_create_page'] );

    add_submenu_page( "useful_poll", "Add Poll Page", "Add Poll", "manage_options", "useful_poll_page", [$this,'useful_polls_settings_page'] );

    add_submenu_page( "useful_poll", "Add Colors Page", "Poll Colors", "manage_options", "useful_poll_page_options", [$this,'useful_poll_settings_page_color_options'] );
      
}


public function useful_poll_create_page(){


global $wpdb;

$results=$wpdb->get_results("SELECT * FROM `wp_polls` WHERE `question` !='' AND `poll_answer_1`!=''AND `poll_answer_2`!='' 
  ||`poll_answer_1`!=''AND `poll_answer_3`!=''
  || `poll_answer_1`!=''AND `poll_answer_4`!='' 
  || `poll_answer_1`!=''AND `poll_answer_5`!='' 
  || `poll_answer_1`!=''AND `poll_answer_6`!='' 
  || `poll_answer_1`!=''AND `poll_answer_7`!='' 
  || `poll_answer_1`!=''AND `poll_answer_8`!=''
  ||`poll_answer_1`!=''AND `poll_answer_9`!='' 
  || `poll_answer_1`!='' AND `poll_answer_10`!=''

  ||`poll_answer_2`!=''AND `poll_answer_3`!=''
  || `poll_answer_2`!=''AND `poll_answer_4`!='' 
  || `poll_answer_2`!=''AND `poll_answer_5`!='' 
  || `poll_answer_2`!=''AND `poll_answer_6`!='' 
  || `poll_answer_2`!=''AND `poll_answer_7`!='' 
  || `poll_answer_2`!=''AND `poll_answer_8`!=''
  ||`poll_answer_2`!=''AND `poll_answer_9`!='' 
  || `poll_answer_2`!='' AND `poll_answer_10`!=''

  || `poll_answer_3`!=''AND `poll_answer_4`!='' 
  || `poll_answer_3`!=''AND `poll_answer_5`!='' 
  || `poll_answer_3`!=''AND `poll_answer_6`!='' 
  || `poll_answer_3`!=''AND `poll_answer_7`!='' 
  || `poll_answer_3`!=''AND `poll_answer_8`!=''
  ||`poll_answer_3`!=''AND `poll_answer_9`!='' 
  || `poll_answer_3`!='' AND `poll_answer_10`!=''

  || `poll_answer_4`!=''AND `poll_answer_5`!='' 
  || `poll_answer_4`!=''AND `poll_answer_6`!='' 
  || `poll_answer_4`!=''AND `poll_answer_7`!='' 
  || `poll_answer_4`!=''AND `poll_answer_8`!=''
  ||`poll_answer_4`!=''AND `poll_answer_9`!='' 
  || `poll_answer_4`!='' AND `poll_answer_10`!=''   

 
  || `poll_answer_5`!=''AND `poll_answer_6`!='' 
  || `poll_answer_5`!=''AND `poll_answer_7`!='' 
  || `poll_answer_5`!=''AND `poll_answer_8`!=''
  ||`poll_answer_5`!=''AND `poll_answer_9`!='' 
  || `poll_answer_5`!='' AND `poll_answer_10`!='' 

    || `poll_answer_6`!=''AND `poll_answer_7`!='' 
  || `poll_answer_6`!=''AND `poll_answer_8`!=''
  ||`poll_answer_6`!=''AND `poll_answer_9`!='' 
  || `poll_answer_6`!='' AND `poll_answer_10`!=''

  || `poll_answer_7`!=''AND `poll_answer_8`!=''
  ||`poll_answer_7`!=''AND `poll_answer_9`!='' 
  || `poll_answer_7`!='' AND `poll_answer_10`!=''

  ||`poll_answer_8`!=''AND `poll_answer_9`!='' 
  || `poll_answer_8`!='' AND `poll_answer_10`!=''

  || `poll_answer_9`!='' AND `poll_answer_10`!=''    
    
  AND 1=1--
   ");
?>

<table id="add_result_table">
 <thead>
     <tr>
        <th><?php echo esc_html__("Shortcode ID","useful-polls"); ?></th>
        <th><?php echo esc_html__("Question","useful-polls") ;?></th>
        

     </tr>

</thead>
 <tbody>
    <?php
       foreach($results  as $result) { 

     ?>
<tr>
 <td>   
  <?php 

   ?> 
 <input type="text" name="shortcode_id" value="<?php echo esc_attr("[useful_poll ID= $result->shortcode_id]"); ?>" readonly>
       

 </td>    
 <td>   
 <?php echo esc_attr($result->question); ?>
 </td>
 
 <td>   
  <button type="submit" class="btn btn-primary edit_form">
          <?php echo esc_html__("Edit data","useful-polls"); ?>
  </button>         
</td>
  <td>
      <form action="<?php echo get_admin_url()."admin-post.php"; ?>" method="post">
      <?php   wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' ); ?>

        <input type="hidden" name="action" value="submit-form-delete" />
        <input type="hidden" name="delete_id" value="<?php echo esc_attr($result->id); ?>">
        <input type="submit" value='<?php echo esc_html__("Delete","useful-polls"); ?>'>

      </form>
     </td>         
</tr>
   
 
 <tr class="form_update" style="min-width: 600px">
   <td>
    <form action="<?php echo get_admin_url()."admin-post.php"; ?>" method="post">
      <?php   wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' ); ?>
      <table id="form_update_table">
        <input type="hidden" name="action" value="submit-form-update" />
          <input type="hidden" name="delete_id" value="<?php echo esc_attr($result->id); ?>">
<?php if(esc_attr($result->question)){ ?>
 <tr>
      <td>
 <label for="question" class="question_label">
               <?php echo esc_html__("Question","useful-polls"); ?>
</label>
     </td>
    <td> 
     
<input type="text" name="question" id="question" value="<?php echo esc_attr($result->question); ?>">
    </td>

 </tr>   
<?php } if(esc_attr($result->poll_answer_1)){ ?>
        <tr>
           <td>
            <label for="poll_answer_1" class="answer_label_1">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
           </td>
           <td> 
        <input type="text" name="poll_answer_1" id="poll_answer_1" value="<?php echo esc_attr($result->poll_answer_1); ?>">
           </td>
           <td>
        <label for="poll_votes_answer_1">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
        </label>
           </td>
           <td>
        <input type="number" id="poll_votes_answer_1"  class="width_of_answers" name="poll_votes_answer_1" min="0" value="<?php echo esc_attr($result->poll_votes_answer_1) ? esc_attr($result->poll_votes_answer_1): ""; ?>">
           </td>
        </tr>
       
      
         
        <?php } if(esc_attr($result->poll_answer_2)){ ?>
          <tr>
            <td>
        <label for="poll_answer_2" class="answer_label_2">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
            </td>
            <td> 
        <input type="text" name="poll_answer_2" id="poll_answer_2" value="<?php echo esc_attr($result->poll_answer_2); ?>">
            </td>
            <td>
       <label for="poll_votes_answer_2">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
       </label>
            </td>
            <td>  
       <input type="number" id="poll_votes_answer_2"  class="width_of_answers" name="poll_votes_answer_2" min="0" value="<?php echo esc_attr($result->poll_votes_answer_2) ? esc_attr($result->poll_votes_answer_2): ""; ?>">
            </td>
          </tr>
          
        
                <?php } if($result->poll_answer_3){ ?>
          <tr>
            <td>
         <label for="poll_answer_3" class="answer_label_3">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
            </td>
            <td> 
        <input type="text" name="poll_answer_3" id="poll_answer_3" value="<?php echo esc_attr($result->poll_answer_3); ?>">
            </td>
            <td>
        <label for="poll_votes_answer_3">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
        </label>
            </td>
            <td>
        <input type="number" id="poll_votes_answer_3"  class="width_of_answers" name="poll_votes_answer_3" min="0" value="<?php echo esc_attr($result->poll_votes_answer_3) ? esc_attr($result->poll_votes_answer_3): ""; ?>">
            </td>
            <td>  
         
   <?php } if(esc_attr($result->poll_answer_4)){ ?>
            <tr>
               <td> 
         <label for="poll_answer_4" class="answer_label_4">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
               </td>
               <td>
        <input type="text" name="poll_answer_4" id="poll_answer_4" value="<?php echo esc_attr($result->poll_answer_4); ?>">
               </td>
               <td>
        <label for="poll_votes_answer_4">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
        </label>
               </td>
               <td>
         <input type="number" id="poll_votes_answer_4"  class="poll_votes_answer_4" name="poll_votes_answer_4" min="0" value="<?php echo esc_attr($result->poll_votes_answer_4) ? esc_attr($result->poll_votes_answer_4): ""; ?>">
               </td> 
             <tr>
 <?php } if(esc_attr($result->poll_answer_5)){ ?>
          <tr>
            <td>
        <label for="poll_answer_5" class="answer_label_5">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
            </td>
            <td> 
        <input type="text" name="poll_answer_5" id="poll_answer_5" value="<?php echo esc_attr($result->poll_answer_5); ?>">
            </td>
            <td>
       <label for="poll_votes_answer_5">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
       </label>
            </td>
            <td>  
       <input type="number" id="poll_votes_answer_5"  class="width_of_answers" name="poll_votes_answer_5" min="0" value="<?php echo esc_attr($result->poll_votes_answer_5) ? esc_attr($result->poll_votes_answer_5): ""; ?>">
            </td>
          </tr>             
 <?php } if(esc_attr($result->poll_answer_6)){ ?>
          <tr>
            <td>
        <label for="poll_answer_6" class="answer_label_6">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
            </td>
            <td> 
        <input type="text" name="poll_answer_6" id="poll_answer_6" value="<?php echo esc_attr($result->poll_answer_6); ?>">
            </td>
            <td>
       <label for="poll_votes_answer_6">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
       </label>
            </td>
            <td>  
       <input type="number" id="poll_votes_answer_6"  class="width_of_answers" name="poll_votes_answer_6" min="0" value="<?php echo esc_attr($result->poll_votes_answer_6) ? esc_attr($result->poll_votes_answer_6): ""; ?>">
            </td>
          </tr>
 <?php } if(esc_attr($result->poll_answer_7)){ ?>
          <tr>
            <td>
        <label for="poll_answer_7" class="answer_label_7">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
            </td>
            <td> 
        <input type="text" name="poll_answer_7" id="poll_answer_7" value="<?php echo esc_attr($result->poll_answer_7); ?>">
            </td>
            <td>
       <label for="poll_votes_answer_7">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
       </label>
            </td>
            <td>  
       <input type="number" id="poll_votes_answer_7"  name="poll_votes_answer_7" min="0" value="<?php echo esc_attr($result->poll_votes_answer_7) ? esc_attr($result->poll_votes_answer_7): ""; ?>">
            </td>
          </tr>

      <?php } if(esc_attr($result->poll_answer_8)){ ?>
          <tr>
            <td>
        <label for="poll_answer_8" class="answer_label_8">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
            </td>
            <td> 
        <input type="text" name="poll_answer_8" id="poll_answer_8" value="<?php echo esc_attr($result->poll_answer_8); ?>">
            </td>
            <td>
       <label for="poll_votes_answer_8">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
       </label>
            </td>
            <td>  
       <input type="number" id="poll_votes_answer_8"  name="poll_votes_answer_8" min="0" value="<?php echo esc_attr($result->poll_votes_answer_8) ? esc_attr($result->poll_votes_answer_8): ""; ?>">
            </td>
          </tr> 

           <?php } if(esc_attr($result->poll_answer_9)){ ?>
          <tr>
            <td>
        <label for="poll_answer_9" class="answer_label_9">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
            </td>
            <td> 
        <input type="text" name="poll_answer_9" id="poll_answer_9" value="<?php echo esc_attr($result->poll_answer_9); ?>">
            </td>
            <td>
       <label for="poll_votes_answer_9">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
       </label>
            </td>
            <td>  
       <input type="number" id="poll_votes_answer_9"  name="poll_votes_answer_9" min="0" value="<?php echo esc_attr($result->poll_votes_answer_9) ? esc_attr($result->poll_votes_answer_9): ""; ?>">
            </td>
          </tr>

          <?php } if(esc_attr($result->poll_answer_10)){ ?>
          <tr>
            <td>
        <label for="poll_answer_10" class="answer_label_10">
               <?php echo esc_html__("Poll Answer","useful-polls"); ?>
             </label>
            </td>
            <td> 
        <input type="text" name="poll_answer_10" id="poll_answer_10" value="<?php echo esc_attr($result->poll_answer_10); ?>">
            </td>
            <td>
       <label for="poll_votes_answer_10">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
       </label>
            </td>
            <td>  
       <input type="number" id="poll_votes_answer_10"    name="poll_votes_answer_10" min="0" value="<?php echo esc_attr($result->poll_votes_answer_10) ? esc_attr($result->poll_votes_answer_10): ""; ?>">
            </td>
          </tr>   
          <?php }  ?>

          <tr>
              <td>
      
           <button type="submit" class="btn btn-primary">
             <?php echo esc_html__("Save data","useful-polls"); ?>
              
           </button>
             </td>
             <td>
                <button class="btn btn-primary close_form">
                 <?php echo esc_html__("Close","useful-polls"); ?>
              </button> 
             </td>

          </tr>
         
        
       
</form>
</table>    



   </td>
  </tr>  

        
<?php
 
}
 ?>
</tbody>
</table>

<?php
}



public function useful_polls_settings_page(){

       ?><h3><?php echo esc_html__( "Please fill in at least a question and two answers.", 'useful-polls' ); ?></h3>   
<div class="data"></div>
  <?php
    // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    global $wpdb;
$wpdb->query( $wpdb->prepare( "DELETE FROM `wp_polls` WHERE question =''" ) );
// Set or increment session number only if button is clicked.
$results=$wpdb->get_results("SELECT * FROM `wp_polls`");


$number_of_results = count($results);


$question =      sanitize_text_field($_POST["question"]);
$shortcode_id = $number_of_results++; 
$poll_answer_1 = sanitize_text_field($_POST["poll_answer_1"]);
$poll_answer_2 = sanitize_text_field($_POST["poll_answer_2"]);
$poll_answer_3 = sanitize_text_field($_POST["poll_answer_3"]);
$poll_answer_4 = sanitize_text_field($_POST["poll_answer_4"]);
$poll_answer_5 = sanitize_text_field($_POST["poll_answer_5"]);
$poll_answer_6 = sanitize_text_field($_POST["poll_answer_6"]);
$poll_answer_7 = sanitize_text_field($_POST["poll_answer_7"]);
$poll_answer_8 = sanitize_text_field($_POST["poll_answer_8"]);
$poll_answer_9 = sanitize_text_field($_POST["poll_answer_9"]);
$poll_answer_10 = sanitize_text_field($_POST["poll_answer_10"]);
$poll_votes_answer_1 = absint($_POST["poll_votes_answer_1"]);
$poll_votes_answer_2 = absint($_POST["poll_votes_answer_2"]);
$poll_votes_answer_3 = absint($_POST["poll_votes_answer_3"]);
$poll_votes_answer_4 = absint($_POST["poll_votes_answer_4"]);
$poll_votes_answer_5 = absint($_POST["poll_votes_answer_5"]);
$poll_votes_answer_6 = absint($_POST["poll_votes_answer_6"]);
$poll_votes_answer_7 = absint($_POST["poll_votes_answer_7"]);
$poll_votes_answer_8 = absint($_POST["poll_votes_answer_8"]);
$poll_votes_answer_9 = absint($_POST["poll_votes_answer_9"]);
$poll_votes_answer_10 = absint($_POST["poll_votes_answer_10"]);
  $ip_addresses = sanitize_text_field($_POST["ip_addresses"]);
  

$sql = $wpdb->prepare("INSERT INTO `wp_polls` (`shortcode_id`,`question`, `poll_answer_1`,`poll_votes_answer_1`,`poll_answer_2`,`poll_votes_answer_2`, `poll_answer_3`,`poll_votes_answer_3`,`poll_answer_4`,`poll_votes_answer_4`, `poll_answer_5`,`poll_votes_answer_5`,`poll_answer_6`,`poll_votes_answer_6`, `poll_answer_7`,`poll_votes_answer_7`,`poll_answer_8`,`poll_votes_answer_8`, `poll_answer_9`,`poll_votes_answer_9`,`poll_answer_10`,`poll_votes_answer_10`,`ip_addresses` ) values (%d, %s,%s,%s,%s,%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",$shortcode_id, $question, $poll_answer_1,$poll_votes_answer_1,$poll_answer_2,$poll_votes_answer_2,$poll_answer_3,$poll_votes_answer_3,$poll_answer_4,$poll_votes_answer_4, $poll_answer_5,$poll_votes_answer_5,$poll_answer_6,$poll_votes_answer_6,$poll_answer_7,$poll_votes_answer_7,$poll_answer_8,$poll_votes_answer_8,$poll_answer_9,$poll_votes_answer_9,$poll_answer_10,$poll_votes_answer_10,"0");

 
 $wpdb->query($sql);

?>
<form action="" class="form" id="form" method="post" >
    <?php
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' ); 

  if($question !=""){ ?>   


<h2><?php echo esc_html__("Add Poll","useful-polls"); ?></h2>
  
 <label for="add_poll_question" class="add_poll_question_label">
    <?php echo esc_html__("Poll Question","useful-polls"); ?>
  </label>


<input type="text" id="add_poll_question" name="question" value="<?php echo esc_attr($question); ?>"><br>

<input type="hidden" id="add_shortcode_id" name="shortcode_id" value="<?php echo esc_attr($number_of_shortcode); ?>"><br>

 <table id="add_poll_table">

 <tbody> 

 
 <?php  if(esc_attr($poll_answer_1) !=""){ ?>

   <tr>
        <td><label for="poll_answer_1" class="answer_label_1">
               <?php echo esc_html__("Poll Answer 1","useful-polls"); ?>
             </label>
         </td>
        
         <td><input type="text" id="poll_answer_1"  class="width_of_answers" name="poll_answer_1" value="<?php echo esc_attr($poll_answer_1); ?>">
         </td>
           <td><label for="poll_answer_1">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
             </label>
         </td>
           <td><input type="number" id="poll_votes_answer_1"  class="poll_votes_answer_1" name="poll_votes_answer_1" value="<?php echo esc_attr($poll_votes_answer_1) ?  esc_attr($poll_votes_answer_1): "" ; ?>">
         </td>

   </tr><br>
<?php } if(esc_attr($poll_answer_2) !=""){ ?>
   <tr>
       <td><label for="poll_answer_2" class="answer_label_2">
                <?php echo esc_html__("Poll Answer 2","useful-polls"); ?>
            </label>
        </td>
   
         <td><input type="text" id="poll_answer_2"  class="width_of_answers" name="poll_answer_2" value="<?php echo esc_attr( $poll_answer_2 ); ?>">
         </td>
         <td><label for="poll_answer_2">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
             </label>
         </td>
           <td><input type="number" id="poll_votes_answer_2"  class="width_of_answers" name="poll_votes_answer_2" value="<?php echo esc_attr($poll_votes_answer_2) ? esc_attr($poll_votes_answer_2): ""; ?>">
         </td>

     </tr><br> 
  <?php } if(esc_attr($poll_answer_3) !=""){ ?>

                        <tr>
                               <td><label for="poll_answer_3" class="answer_label_3">
                                        <?php echo esc_html__("Poll Answer 3","useful-polls"); ?>
                                    </label>
                                </td>
                                 
                                <td><input type="text" id="poll_answer_3"  class="width_of_answers" name="poll_answer_3" value="<?php echo esc_attr( $poll_answer_3 ); ?>">
                                 </td>
                                    <td><label for="poll_answer_3">
                                       <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
                                     </label>
                                 </td>
                                  <td><input type="number" id="poll_answer_1"  class="width_of_answers" name="poll_votes_answer_3" value="<?php echo esc_attr($poll_votes_answer_3) ? esc_attr($poll_votes_answer_3): "" ; ?>">
         </td>

                                 

                               

                                 
                            </tr><br>
  <?php } if(esc_attr($poll_answer_4) !=""){ ?>

        
                        <tr>
                               <td><label for="poll_answer_4" class="answer_label_3">
                                        <?php echo esc_html__("Poll Answer 4","useful-polls"); ?>
                                    </label>
                                </td>
                                 
                                <td><input type="text" id="poll_answer_4"  class="width_of_answers" name="poll_answer_4" value="<?php echo esc_attr( $poll_answer_4 ); ?>">
                                 </td>
                               <td><label for="poll_answer_4">
                                       <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
                                     </label>
                                 </td>     
                          <td><input type="number" id="poll_answer_1"  class="width_of_answers" name="poll_votes_answer_4" value="<?php echo esc_attr($poll_votes_answer_4) ? esc_attr($poll_votes_answer_4): "" ; ?>">
         </td>

                                 

                               

                                 
                            </tr><br>
       <?php } if(esc_attr($poll_answer_5) !=""){ ?>
   <tr>
       <td><label for="poll_answer_5" class="answer_label_5">
                <?php echo esc_html__("Poll Answer 5","useful-polls"); ?>
            </label>
        </td>
   
         <td><input type="text" id="poll_answer_5"  class="width_of_answers" name="poll_answer_5" value="<?php echo esc_attr( $poll_answer_5 ); ?>">
         </td>
         <td><label for="poll_answer_5">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
             </label>
         </td>
           <td><input type="number" id="poll_votes_answer_5"  class="width_of_answers" name="poll_votes_answer_5" value="<?php echo esc_attr($poll_votes_answer_5) ? esc_attr($poll_votes_answer_5): ""; ?>">
         </td>

     </tr><br>
     <?php } if(esc_attr($poll_answer_6) !=""){ ?>
   <tr>
       <td><label for="poll_answer_6" class="answer_label_6">
                <?php echo esc_html__("Poll Answer 6","useful-polls"); ?>
            </label>
        </td>
   
         <td><input type="text" id="poll_answer_6"  class="width_of_answers" name="poll_answer_6" value="<?php echo esc_attr( $poll_answer_6 ); ?>">
         </td>
         <td><label for="poll_answer_6">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
             </label>
         </td>
           <td><input type="number" id="poll_votes_answer_6"  class="width_of_answers" name="poll_votes_answer_6" value="<?php echo esc_attr($poll_votes_answer_6) ? esc_attr($poll_votes_answer_6): ""; ?>">
         </td>

     </tr><br> 
     <?php } if(esc_attr($poll_answer_7) !=""){ ?>
   <tr>
       <td><label for="poll_answer_7" class="answer_label_7">
                <?php echo esc_html__("Poll Answer 7","useful-polls"); ?>
            </label>
        </td>
   
         <td><input type="text" id="poll_answer_7"  class="width_of_answers" name="poll_answer_7" value="<?php echo esc_attr( $poll_answer_7 ); ?>">
         </td>
         <td><label for="poll_answer_7">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
             </label>
         </td>
           <td><input type="number" id="poll_votes_answer_7"  class="width_of_answers" name="poll_votes_answer_7" value="<?php echo esc_attr($poll_votes_answer_7) ? esc_attr($poll_votes_answer_7): ""; ?>">
         </td>

     </tr><br>
     <?php } if(esc_attr($poll_answer_8) !=""){ ?>
   <tr>
       <td><label for="poll_answer_8" class="answer_label_8">
                <?php echo esc_html__("Poll Answer 8","useful-polls"); ?>
            </label>
        </td>
   
         <td><input type="text" id="poll_answer_8"  class="width_of_answers" name="poll_answer_8" value="<?php echo esc_attr( $poll_answer_8 ); ?>">
         </td>
         <td><label for="poll_answer_8">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
             </label>
         </td>
           <td><input type="number" id="poll_votes_answer_8"  class="width_of_answers" name="poll_votes_answer_8" value="<?php echo esc_attr($poll_votes_answer_8) ? esc_attr($poll_votes_answer_8): ""; ?>">
         </td>

     </tr><br>
     <?php } if(esc_attr($poll_answer_9) !=""){ ?>
   <tr>
       <td><label for="poll_answer_9" class="answer_label_9">
                <?php echo esc_html__("Poll Answer 9","useful-polls"); ?>
            </label>
        </td>
   
         <td><input type="text" id="poll_answer_9"  class="width_of_answers" name="poll_answer_9" value="<?php echo esc_attr( $poll_answer_2 ); ?>">
         </td>
         <td><label for="poll_answer_9">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
             </label>
         </td>
           <td><input type="number" id="poll_votes_answer_9"  class="width_of_answers" name="poll_votes_answer_9" value="<?php echo esc_attr($poll_votes_answer_9) ? esc_attr($poll_votes_answer_9): ""; ?>">
         </td>

     </tr><br>
     <?php } if(esc_attr($poll_answer_10) !=""){ ?>
   <tr>
       <td><label for="poll_answer_10" class="answer_label_10">
                <?php echo esc_html__("Poll Answer 10","useful-polls"); ?>
            </label>
        </td>
   
         <td><input type="text" id="poll_answer_10"  class="width_of_answers" name="poll_answer_10" value="<?php echo esc_attr( $poll_answer_10 ); ?>">
         </td>
         <td><label for="poll_answer_10">
               <?php echo esc_html__("No. Of Votes","useful-polls"); ?>
             </label>
         </td>
           <td><input type="number" id="poll_votes_answer_10"  class="width_of_answers" name="poll_votes_answer_10" value="<?php echo esc_attr($poll_votes_answer_10) ? esc_attr($poll_votes_answer_10): ""; ?>">
         </td>

     </tr><br>
      <?php } ?>     
   </tbody>
   </table>

 <button type="submit" class="btn btn-primary" name="next_vote" id="btnsave">
          <?php echo esc_html__("Save data","useful-polls"); ?>
 </button>

</form>
      <?php } ?>  

</script>

<br><br><br><br>
<script type="text/javascript">
 let shortcode_id = jQuery('.auto_num').length+1;
 let  rowIndex = jQuery('.auto_num').length+1;
 let  rowIndexx = jQuery('.auto_num').length+2;
 let  poll_vote_1 = jQuery('.auto_num').length+1;
 let  poll_vote_2 = jQuery('.auto_num').length+2;

  jQuery(".data").after(
'<form action="" class="form" id="form" method="post" >'+
'<h2><?php echo esc_html__("Add Fields","useful-polls"); ?></h2>'+
'<table id="add_question">'+
'<tbody>'+ 
'<tr>'+
'<td>'+
 '<label class="add_field_question_label">'+
    '<?php echo esc_html__("Poll Question","useful-polls"); ?>'+
  '</label>'+
'</td>'+
'<td>'+
'<input type="text" id="add_field_question" name="question" value=""><br>'+
 '</td>'+

 '</tr>'+
 '</tbody>'+
 '</table>'+
'<table id="add_fields">'+
'<tbody>'+ 
   '<tr>'+
        '<td><label for="poll_answer" class="answer_label'+rowIndex+'">'+
               '<?php echo esc_html__("Poll Answer ","useful-polls"); ?>'+
               '<input id="#" name="#" class="auto_num" type="text" value="'+rowIndex+'" />'+
             '</label>'+
         '</td>'+
        
         '<td><input type="text" id="poll_answer'+rowIndex+'"  class="poll_answer" name="poll_answer_'+rowIndex+'" value="">'+
         '</td>'+
          '<td><label for="poll_vote" class="poll_vote_label'+poll_vote_1+'">'+
                '<?php echo esc_html__("No. of votes","useful-polls"); ?>'+
            '</label>'+
        '</td>'+
         '<td><input type="number" id="poll_vote'+poll_vote_1+'"  class="poll_vote" min="0" name="poll_votes_answer_'+poll_vote_1+'" value="">'+
         '</td>'+
         '<td><input type="button" class="removerow" id="removerow'+rowIndex+'" name="removerow'+rowIndex+'" value="Remove"/>'+
         '</td>'+
   '</tr>'+

   '<tr>'+
       '<td><label for="poll_answer" class="answer_label'+rowIndex+'">'+
                '<?php echo esc_html__("Poll Answer ","useful-polls"); ?>'+
             '<input id="#" name="#" class="auto_num" type="text" value="'+rowIndexx+'" />'+
            '</label>'+
        '</td>'+
   
         '<td><input type="text" id="poll_answer'+rowIndex+'"  class="poll_answer" name="poll_answer_'+rowIndexx+'" value="">'+
         '</td>'+
         '<td><label for="poll_vote" class="poll_vote_label'+poll_vote_2+'">'+
                '<?php echo esc_html__("No. of votes ","useful-polls"); ?>'+
            '</label>'+
        '</td>'+
         '<td><input type="number" min="0" id="poll_vote'+poll_vote_1+'"  class="poll_vote" name="poll_votes_answer_'+poll_vote_2+'" value="">'+
         '</td>'+
         '<td><input type="button" class="removerow" id="removerow'+rowIndex+'" name="removerow'+rowIndex+'" value="Remove"/>'+
         '</td>'+
     '</tr>'+ 
   '</tbody>'+ 
   '</table>'+


'<button type="button" class="btn btn-primary" id="addrow">'+
          '<?php echo esc_html__("Add data","useful-polls"); ?>'+
 '</button><br><br><br>'+

 '<button type="submit" class="btn btn-primary" name="next_vote" id="save">'+
          '<?php echo esc_html__("Save data","useful-polls"); ?>'+
 '</button>'+
 '</form>');


  jQuery("#addrow").on('click', function(){ 

                let  rowIndex = jQuery('.auto_num').length+1;
                let  poll_vote_1 = jQuery('.auto_num').length+1;
              
                       var row = '<tr>'+
                                    '<td><label for="poll_answer" class="answer_label'+rowIndex+'">'+
                                           '<?php echo esc_html__("Poll Answer ","useful-polls"); ?>'+
                                           '<input id="#" name="#" class="auto_num" type="text" value="'+rowIndex+'" />'+
                                         '</label>'+
                                     '</td>'+
                                    
                                     '<td><input type="text" id="poll_answer'+rowIndex+'"  class="poll_answer" name="poll_answer_'+rowIndex+'" value="">'+
                                     '</td>'+
                            '<td><label for="poll_vote" class="poll_vote_label'+poll_vote_1+'">'+
                                    '<?php echo esc_html__("No. of votes ","useful-polls"); ?>'+
                                '</label>'+
                            '</td>'+
                          '<td><input type="number" min="0" id="poll_vote'+poll_vote_1+'"  class="poll_vote" name="poll_votes_answer_'+poll_vote_1+'" value="">'+
                                     '</td>'+
                                     '<td><input type="button" class="removerow" id="removerow'+rowIndex+'" name="removerow'+rowIndex+'" value="Remove"/>'+
                                     '</td>'+
                               '</tr>';
            jQuery("#add_fields > tbody:last-child").append(row);  
                
               
                              
            });

  jQuery(document).on('click', '.removerow', function() {
 jQuery(this).parent().parent().remove();

  jQuery(this).remove();

            regenerate_auto_num();
            });
            function regenerate_auto_num(){
                let count  = 1;
                jQuery(".auto_num").each(function(i,v){
                jQuery(this).val(count);
                count++;
              })
            }

</script>


<?php
}
public function useful_poll_settings_page_color_options(){
?><h3><?php echo esc_html__("Options","useful-polls"); ?></h3><?php
  global $wpdb;

?>
<h4><?php echo esc_html__("Please select color:","useful-polls"); ?></h4>
<form action="" method="post" class="form_of_voting">
     <?php    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' ); ?> 
  
       
  <table>
    <tr>
      <td>
        <label for="color_for_submit_button"><?php echo esc_html__("Choose color for submit button","useful-polls"); ?></label>
      </td>
      <td>
           <input type="text" value="#5c80ed" id="color_for_submit_button" name="color_for_submit_button" class="color_for_submit_button" data-default-color="#5c80ed" />
     </td>
    </tr>
     <tr>
      <td>
        <label for="color_for_vote_line"><?php echo esc_html__("Choose color for vote's line","useful-polls"); ?></label>
      </td>
      <td>
           <input type="text" value="#5ecc4f" id="color_for_vote_line" name="color_for_vote_line" class="color_for_vote_line" data-default-color="#5ecc4f" />
     </td>
    </tr>
    <tr>
      <td>
        <label for="color_for_question"><?php echo esc_html__("Choose color for question","useful-polls"); ?></label>
      </td>
      <td>
           <input type="text" value="#dd3333" id="color_for_question" name="color_for_question" class="color_for_question" data-default-color="#dd3333" />
     </td>
    </tr>
    <tr>
      <tr>
      <td>
        <label for="color_for_answers"><?php echo esc_html__("Choose color for answers","useful-polls"); ?></label>
      </td>
      <td>
           <input type="text" value="#000000" id="color_for_answers" name="color_for_answers" class="color_for_answers" data-default-color="#000000" />
     </td>
    </tr>
        <tr>
      <td>
        <label for="color_for_background"><?php echo esc_html__("Choose color for background","useful-polls"); ?></label>
      </td>
      <td>
           <input type="text" value="#ffffff" id="color_for_background" name="color_for_background" class="color_for_background" data-default-color="#ffffff" />
     </td>
    </tr>
    <tr> 
  </table>
<button id="submitcolor" class="btn btn-primary" name="next_color"><?php echo esc_html__("Submit","useful-polls"); ?></button>
  </form>


<?php
} }

endif;