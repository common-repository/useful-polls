<?php
namespace Useful_Polls\Includes;
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('DMUP_Useful_Polls_Shortcode') ) :
/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Useful_Polls
 * @subpackage Useful_Polls/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Useful_Polls
 * @subpackage Useful_Polls/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */



class DMUP_Useful_Polls_Shortcode {

 public function __construct(){
        

  add_shortcode( "useful_poll", [$this,"demo_handler"]);

  add_action( "init", [$this,"get_client_ip"] );
 }

public function get_client_ip()
 {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress =  sanitize_text_field( wp_unslash( getenv('HTTP_CLIENT_IP')));
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = sanitize_text_field( wp_unslash( getenv('HTTP_X_FORWARDED_FOR')));
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress =  sanitize_text_field( wp_unslash( getenv('HTTP_X_FORWARDED')));
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = sanitize_text_field( wp_unslash( getenv('HTTP_FORWARDED_FOR')));
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = sanitize_text_field( wp_unslash( getenv('HTTP_FORWARDED')));
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = sanitize_text_field( wp_unslash( getenv('REMOTE_ADDR')));
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress;
 }




public function demo_handler( $atts ) {

 // Bring global variable $wpdb into local scope
     extract( shortcode_atts( array(
        'id' => '',
    ), $atts, 'useful_poll' ) );
    


 $demolph_output = $this->demoplug_function( $id,$post_id );  
    return $demolph_output;
}

 


public function demoplug_function( $id,$post_id ) { 

/*

*/


if(isset($_POST["show_table"])){

   // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

global $wpdb;


 $colors_of_results = $wpdb->get_results("SELECT * FROM `wp_colors_of_results`");


 $sql= $wpdb->prepare("SELECT * FROM `wp_polls` WHERE `shortcode_id` =%d",$id);
 $results = $wpdb->get_results( $sql );

 foreach ($colors_of_results as $color) {

 
      foreach($results  as $result) {
          
    $max_1 = 1;
    $max_2 = 1;
    $max_3 = 1;
    $max_4 = 1;


    foreach( $results as $tmp ){
        $max_1 = esc_attr(intval($tmp->poll_votes_answer_1)) > $max_1 ? esc_attr(intval($tmp->poll_votes_answer_1)): $max_1;
       $max_2 = esc_attr(intval($tmp->poll_votes_answer_2)) > $max_2 ? esc_attr(intval($tmp->poll_votes_answer_2)): $max_2;

        $max_3 = esc_attr(intval($tmp->poll_votes_answer_3)) > $max_3 ? esc_attr(intval($tmp->poll_votes_answer_3)): $max_3;

         $max_4 = esc_attr(intval($tmp->poll_votes_answer_4)) > $max_4? esc_attr(intval($tmp->poll_votes_answer_4)): $max_4 ;
       }

?>

<?php 



 
  
 ?>
    <div class="table_results_on_front_end">
        <table class="table-bordered" style="background-color:<?php echo esc_attr($color->color_for_background); ?>">

            <tbody style="max-width: 300px; border: 0;">
               <tr>
                  <div style="color:<?php echo  esc_attr($color->color_for_question); ?>;">
                    <?php  echo esc_attr($result->question); ?>
                  </div>
               </tr><br>   
                 

         <?php
            $total_votes = intval($tmp->poll_votes_answer_1) + intval($tmp->poll_votes_answer_2) + intval($tmp->poll_votes_answer_3) +intval($tmp->poll_votes_answer_4);
          
           if($total_votes == 0){
              $total_votes =1;
           }

           ?>
                 <?php if(esc_attr($result->poll_answer_1) !=""){ ?>

                <tr>
                  <?php $percent_1 =esc_attr(intval($tmp->poll_votes_answer_1)); ?>
                    <td>
                       <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                       <?php echo esc_attr($result->poll_answer_1); ?>
                     </div>
                    </td>
                    <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_1 / $total_votes)) ?>%;border: 6px solid <?php echo  esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                    </td>
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr(htmlspecialchars( (intval($tmp->poll_votes_answer_1)))); ?>
                      </div>
                     </td>
                      <td>
                        <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr(round( 100 * $percent_1 / $total_votes)) ?>%
                        </div>                        
                      </td>
                    </tr>
              
                  <?php  } ?>
                  <?php if(esc_attr($result->poll_answer_2!="")){ ?>  
                     <tr>
                      <?php $percent_2 =esc_attr(intval($tmp->poll_votes_answer_2)); ?>
                       <td>
                        <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr($result->poll_answer_2); ?>
                        </div>
                       </td>
                       <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_2 / $total_votes)) ?>%;border: 6px solid <?php echo  esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                      </td>
                      <td>
                       <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr( (intval($tmp->poll_votes_answer_2))); ?>
                      </div>
                      </td>
                      <td>
                        <div style="color:<?php echo esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr(round( 100 * $percent_2 / $total_votes)) ?>%                        
                      </div>
                     </td>
                     </tr>
                   <?php } ?>
                   <?php if(esc_attr($result->poll_answer_3!="")){ ?>
                     <tr>
                     <?php   $percent_3 =esc_attr(intval($tmp->poll_votes_answer_3)); ?>
                     
                      <td>
                        <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                         <?php echo esc_attr($result->poll_answer_3); ?>
                        </div> 
                      </td> 
                      <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_3 / $total_votes)) ?>%;border: 6px solid <?php echo  esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                    </td>
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr( (intval($tmp->poll_votes_answer_3))); ?>
                      </div>
                    </td>   
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                      <?php echo esc_attr(round( 100 * $percent_3 / $total_votes)) ?>% 
                      </div>                       
                    </td>
                    </tr>
                     <?php } ?>
                     <?php if(esc_attr($result->poll_answer_4!="")){ ?>
                     <tr>
                  <?php   $percent_4 =esc_attr((intval($tmp->poll_votes_answer_4))); ?>
                     <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr($result->poll_answer_4); ?>
                      </div>  
                     </td>
                     <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_4 / $total_votes)) ?>%;border: 6px solid <?php echo esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                    </td>
                    <td>
                       
                  <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr( (intval($tmp->poll_votes_answer_4))); ?>
                      </div>
                    </td>
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                      <?php echo esc_attr(round( 100 * $percent_4 / $total_votes)) ?>%       
                      </div>                 
                    </td>
                </tr>
                <?php } ?>
                    <?php if(esc_attr($result->poll_answer_5!="")){ ?>
                     <tr>
                  <?php   $percent_5 =esc_attr(intval($tmp->poll_votes_answer_5)); ?>
                     <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr($result->poll_answer_5); ?>
                      </div>
                     </td>
                     <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_5 / $total_votes)) ?>%;border: 6px solid <?php echo esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                    </td>
                    <td>
                       
                  <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr(htmlspecialchars( (intval($tmp->poll_votes_answer_5)))); ?>
                      </div>
                    </td>
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                      <?php echo esc_attr(round( 100 * $percent_5 / $total_votes)) ?>%  
                      </div>                      
                    </td>
                </tr>
                <?php } ?>
                    <?php if(esc_attr($result->poll_answer_6!="")){ ?>
                     <tr>
                  <?php   $percent_6 =esc_attr(intval($tmp->poll_votes_answer_6)); ?>
                     <td>
                      <div style="color:<?php echo esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr($result->poll_answer_6); ?>
                      </div>  
                     </td>
                     <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_6 / $total_votes)) ?>%;border: 6px solid <?php echo esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                    </td>
                    <td>
                       
                  <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr(htmlspecialchars( (intval($tmp->poll_votes_answer_6)))); ?>
                      </div>
                    </td>
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                      <?php echo esc_attr(round( 100 * $percent_6 / $total_votes)) ?>%
                      </div>                        
                    </td>
                </tr>
                <?php } ?>
                    <?php if(esc_attr($result->poll_answer_7!="")){ ?>
                     <tr>
                  <?php   $percent_7 =esc_attr(intval($tmp->poll_votes_answer_7)); ?>
                     <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr($result->poll_answer_7); ?>
                      </div>
                     </td>
                     <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_7 / $total_votes)) ?>%;border: 6px solid <?php echo esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                    </td>
                    <td>
                       
                  <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr(htmlspecialchars( (intval($tmp->poll_votes_answer_7)))); ?>
                      </div>
                    </td>
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                      <?php echo esc_attr(round( 100 * $percent_7 / $total_votes)) ?>%
                      </div>                        
                    </td>
                </tr>
                <?php } ?>
                    <?php if(esc_attr($result->poll_answer_8!="")){ ?>
                     <tr>
                  <?php   $percent_4 =esc_attr(intval($tmp->poll_votes_answer_8)); ?>
                     <td>
                       <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr($result->poll_answer_8); ?>
                      </div>
                     </td>
                     <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_8 / $total_votes)) ?>%;border: 6px solid <?php echo esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                    </td>
                    <td>
                       
                  <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr(htmlspecialchars( (intval($tmp->poll_votes_answer_8)))); ?>
                      </div>
                    </td>
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                      <?php echo esc_attr(round( 100 * $percent_8 / $total_votes)) ?>%
                      </div>                        
                    </td>
                </tr>
                <?php } ?>
                    <?php if(esc_attr($result->poll_answer_9!="")){ ?>
                     <tr>
                  <?php   $percent_9 =esc_attr(intval($tmp->poll_votes_answer_9)); ?>
                     <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr($result->poll_answer_9); ?>
                      </div>  
                     </td>
                     <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_9 / $total_votes)) ?>%;border: 6px solid <?php echo esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                    </td>
                    <td>
                       
                  <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr(htmlspecialchars( (intval($tmp->poll_votes_answer_9)))); ?>
                      </div>
                    </td>
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                      <?php echo esc_attr(round( 100 * $percent_9 / $total_votes)) ?>%       
                      </div>                 
                    </td>
                </tr>
                <?php } ?>
                    <?php if(esc_attr($result->poll_answer_10!="")){ ?>
                     <tr>
                  <?php   $percent_4 =esc_attr(intval($tmp->poll_votes_answer_10)); ?>
                     <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr($result->poll_answer_10); ?>
                      </div>
                     </td>
                     <td>
                        <div class="outer">
                            <div class="inner" style="width: <?php echo esc_attr(round( 100 * $percent_10 / $total_votes)) ?>%;border: 6px solid <?php echo esc_attr($color->color_for_vote_line); ?>;"></div>
                        </div>
                    </td>
                    <td>
                       
                  <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                        <?php echo esc_attr(htmlspecialchars( (intval($tmp->poll_votes_answer_10)))); ?>
                      </div>
                    </td>
                    <td>
                      <div style="color:<?php echo  esc_attr($color->color_for_answers); ?>;">
                      <?php echo esc_attr(round( 100 * $percent_10 / $total_votes)) ?>%
                      </div>                        
                    </td>
                </tr>
                <?php  } }?>
              


            </tbody>
        </table>
       </div> 
 <?php

  }

if (!absint($_SESSION['token'])) {
    $_SESSION['token'] = rand();
}
   
 if ($_SESSION['token'] == intval($_POST['token'])) {


 $value = absint($_POST["poll_votes_answer_1"]);
$sql_update = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_1`=`poll_votes_answer_1`+%d WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update);


 $value = absint($_POST["poll_votes_answer_2"]);
$sql_update_2 = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_2`=`poll_votes_answer_2`+%d WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update_2);
 

$value = absint($_POST["poll_votes_answer_3"]);
$sql_update_3 = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_3`=`poll_votes_answer_3`+%d WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update_3);

$value = absint($_POST["poll_votes_answer_4"]);
$sql_update_4 = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_4`=`poll_votes_answer_4`+%d WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update_4);

$value = absint($_POST["poll_votes_answer_5"]);
$sql_update_5 = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_5`=`poll_votes_answer_5`+%d WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update_5);


$value = absint($_POST["poll_votes_answer_6"]);
$sql_update_6 = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_6`=`poll_votes_answer_6`+%d WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update_6);
 

$value = absint($_POST["poll_votes_answer_7"]);
$sql_update_7 = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_7`=`poll_votes_answer_7`+%d WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update_7);
 
$value = absint($_POST["poll_votes_answer_8"]);
$sql_update_8 = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_8`=`poll_votes_answer_8`+%s WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update_8);
 
$value = absint($_POST["poll_votes_answer_9"]);
$sql_update_9 = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_9`=`poll_votes_answer_9`+%s WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update_9);
 
$value = absint($_POST["poll_votes_answer_10"]);
$sql_update_10 = $wpdb->prepare("UPDATE `wp_polls` SET `poll_votes_answer_10`=`poll_votes_answer_10`+%s WHERE `shortcode_id` = %s",array($value,$id));
 $wpdb->query($sql_update_10);



$ip = esc_attr( wp_unslash($this->get_client_ip()));

$sql_update_11 = $wpdb->prepare("UPDATE `wp_polls` SET `ip_addresses`='%s' WHERE `shortcode_id` =%s",[$ip,$id]);
$wpdb->query($sql_update_11);




session_destroy();

 
}


     
}else{

global $wpdb;



$results=$wpdb->get_results("SELECT * FROM `wp_polls` WHERE `shortcode_id` = $id");
 

$colors_of_results = $wpdb->get_results("SELECT * FROM `wp_colors_of_results`");

$number_of_results = count($colors_of_results);


if($number_of_results=="0" ){
$sql = $wpdb->prepare("INSERT INTO `wp_colors_of_results` (`id`, `color_for_question`, `color_for_answers`, `color_for_background`, `color_for_vote_line`, `color_for_submit_button`) VALUES (%s,%s, %s, %s, %s,%s)",NULL, "red","black","white","green","blue");

  $wpdb->query($sql);

    die();
 } 

$ip_address=$wpdb->prepare("SELECT `ip_addresses` FROM `wp_polls` WHERE `shortcode_id` = %s",$id);
$ip_address=$wpdb->get_results($ip_address);     

$ip = esc_attr( wp_unslash($this->get_client_ip()));     

foreach ($ip_address as $key) {
if($key->ip_addresses==$ip){
  return;
}
}

foreach($results  as $result) {

  foreach ($colors_of_results as $color)               
    ?>

<form action="" method="post" class="checkbox_form" id="close_me" style='background-color: <?php echo esc_attr($color->color_for_background); ?>'
>
  <?php  wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' ); ?>

<input type="hidden" name="token" value="<?php echo absint($_SESSION['token']); ?>">
<input type="hidden" name="ip_addresses" value="<?php echo sanitize_text_field($this->get_client_ip()); ?>">

<?php if(esc_attr($result->question !="")){ ?>
 

<label for="question" class="question_class" style="color:<?php echo  esc_attr($color->color_for_question); ?>;"> 
     <h4><?php esc_html_e("Question: ","useful-polls"); ?></h4>

  <?php echo esc_attr($result->question); ?>
    
  </label><br>
<?php }    

 if(esc_attr($result->poll_answer_1) !=""){ ?>

<input type="checkbox" id="poll_votes_answer_1" name="poll_votes_answer_1" value="1">
<label for="poll_answer_1" style="color:<?php echo esc_attr($color->color_for_answers); ?>;"> 
  <?php echo esc_attr($result->poll_answer_1); ?>
</label><br>
<?php } 

if(esc_attr($result->poll_answer_2) !=""){ ?>

<input type="checkbox" id="poll_votes_answer_2" name="poll_votes_answer_2" value="1">
<label for="poll_answer_2" style="color:<?php echo esc_attr($color->color_for_answers); ?>;">  <?php echo esc_attr($result->poll_answer_2); ?></label><br>
<?php } 

if(esc_attr($result->poll_answer_3) !=""){ ?>
<input type="checkbox" id="poll_votes_answer_3" name="poll_votes_answer_3" value="1">
<label for="poll_answer_3" style="color:<?php echo esc_attr($color->color_for_answers); ?>;"> <?php echo esc_attr($result->poll_answer_3); ?></label><br>
<?php } 

if(esc_attr($result->poll_answer_4) !=""){ ?>
<input type="checkbox" id="poll_votes_answer_4" name="poll_votes_answer_4" value="1">

<label for="poll_answer_4" style="color:<?php echo esc_attr($color->color_for_answers); ?>;"> 
 <?php echo esc_attr($result->poll_answer_4); ?>
 </label><br>
<?php } 

if(esc_attr($result->poll_answer_5) !=""){ ?>
<input type="checkbox" id="poll_votes_answer_5" name="poll_votes_answer_5" value="1">
<label for="poll_answer_3" style="color:<?php echo esc_attr($color->color_for_answers); ?>;">  
  <?php echo esc_attr($result->poll_answer_5); ?></label><br>
<?php } 

if(esc_attr($result->poll_answer_6) !=""){ ?>
<input type="checkbox" id="poll_votes_answer_6" name="poll_votes_answer_6" value="1">
<label for="poll_answer_6" style="color:<?php echo esc_attr($color->color_for_answers); ?>;">  
  <?php echo esc_attr($result->poll_answer_6); ?>
  </label><br>
<?php }

if(esc_attr($result->poll_answer_7) !=""){ ?>
<input type="checkbox" id="poll_votes_answer_7" name="poll_votes_answer_7" value="1">

<label for="poll_answer_7" style="color:<?php echo esc_attr($color->color_for_answers); ?>;"> > <?php echo esc_attr($result->poll_answer_7); ?>
</label><br>
<?php } 

if(esc_attr($result->poll_answer_8) !=""){ ?>
<input type="checkbox" id="poll_votes_answer_8" name="poll_votes_answer_8" value="1">
<label for="poll_answer_8" style="color:<?php echo esc_attr($color->color_for_answers); ?>;">  <?php echo esc_attr($result->poll_answer_8); ?>
</label><br>
<?php } 

if(esc_attr($result->poll_answer_9) !=""){ ?>
<input type="checkbox" id="poll_votes_answer_9" name="poll_votes_answer_9" value="1">
<label for="poll_answer_9"style="color:<?php echo esc_attr($color->color_for_answers); ?>;"> 
 <?php echo esc_attr($result->poll_answer_9); ?></label><br>
<?php } 

if(esc_attr($result->poll_answer_10 !="")){ ?>
<input type="checkbox" id="poll_votes_answer_10" name="poll_votes_answer_10" value="1">
<label for="poll_answer_10"style="color:<?php echo esc_attr($color->color_for_answers); ?>;"> 
 <?php echo esc_attr($result->poll_answer_10); ?></label><br>
<?php } ?>



 <input class="close_div" style='background-color: <?php echo esc_attr($color->color_for_submit_button); ?>' type="submit" name="show_table" id="color_for_submit_button" value="Submit" /> 

</form>
 
<?php

}
}
}
}

endif;
