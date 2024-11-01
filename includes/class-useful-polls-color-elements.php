<?php
namespace Useful_Polls\Includes;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('DMUP_Useful_Polls_Color_Elements') ) :
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    DMUP_Useful_Polls_Color_Elements
 * @subpackage DMUP_Useful_Polls_Color_Elements/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class DMUP_Useful_Polls_Color_Elements {

	
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
	   add_action( 'wp_ajax_color_of_form_results', [$this,'color_of_form_results'] ); //admin side
       add_action( 'wp_ajax_nopriv_color_of_form_results', [$this,'color_of_form_results'] ); //for frontend
  
    

	}


public function color_of_form_results($post_id){
 // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }   
global $wpdb;
 
$color_for_submit_button = sanitize_hex_color($_POST["color_for_submit_button"]);


$color_for_vote_line =      sanitize_hex_color($_POST["color_for_vote_line"]);

$color_for_question = sanitize_hex_color($_POST["color_for_question"]);
$color_for_answers = sanitize_hex_color($_POST["color_for_answers"]);
$color_for_background = sanitize_hex_color($_POST["color_for_background"]);

 

if($number_of_results==0){
  $sql = $wpdb->prepare("UPDATE `wp_colors_of_results` SET  `color_for_question` = %s, `color_for_answers` = %s, `color_for_background` = %s, `color_for_vote_line` = %s,`color_for_submit_button` = %s",$color_for_question,$color_for_answers,$color_for_background,$color_for_vote_line,$color_for_submit_button);

    $wpdb->query($sql);
   
   die();
  }

}
}
endif;