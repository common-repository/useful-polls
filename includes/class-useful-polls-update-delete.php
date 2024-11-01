<?php
namespace Useful_Polls\Includes;


if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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

if( ! class_exists('DMUP_Useful_Polls_Update_Delete') ) :

class DMUP_Useful_Polls_Update_Delete{

public function __construct(){

  add_action('admin_post_submit-form-update', [$this,'_handle_form_action_update']);
  add_action('admin_post_submit-form-delete', [$this,'_handle_form_action']);


}


public function _handle_form_action_update($post_id){
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


$sql = $wpdb->prepare("INSERT INTO `wp_polls` (`shortcode_id`,`question`, `poll_answer_1`,`poll_votes_answer_1`,`poll_answer_2`,`poll_votes_answer_2`, `poll_answer_3`,`poll_votes_answer_3`,`poll_answer_4`,`poll_votes_answer_4`, `poll_answer_5`,`poll_votes_answer_5`,`poll_answer_6`,`poll_votes_answer_6`, `poll_answer_7`,`poll_votes_answer_7`,`poll_answer_8`,`poll_votes_answer_8`, `poll_answer_9`,`poll_votes_answer_9`,`poll_answer_10`,`poll_votes_answer_10`,`ip_addresses` ) values (%s, %s,%s,%d,%s,%d,%s,%d,%s,%d,%s, %d,%s,%d,%s,%d,%s,%d,%s,%d,%s,%d,%s)",$shortcode_id, $question, $poll_answer_1,$poll_votes_answer_1,$poll_answer_2,$poll_votes_answer_2,$poll_answer_3,$poll_votes_answer_3,$poll_answer_4,$poll_votes_answer_4, $poll_answer_5,$poll_votes_answer_5,$poll_answer_6,$poll_votes_answer_6,$poll_answer_7,$poll_votes_answer_7,$poll_answer_8,$poll_votes_answer_8,$poll_answer_9,$poll_votes_answer_9,$poll_answer_10,$poll_votes_answer_10,$ip_addresses);

 
 $wpdb->query($sql);
   
     // redirect after insert alert
    wp_redirect(admin_url('admin.php?page=useful_poll'));
    die();
    
} 

function _handle_form_action($post_id){
   // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

global $wpdb;
$id= absint($_POST["delete_id"]);
// Run the database query
$delete_row = $wpdb->prepare( "DELETE FROM `wp_polls` WHERE ID = %s",$id );
$wpdb->query($delete_row);
  // redirect after insert alert
    wp_redirect(admin_url('admin.php?page=useful_poll'));
    die();
}      
  
}

endif;