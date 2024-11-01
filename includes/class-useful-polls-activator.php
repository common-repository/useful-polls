<?php
namespace Useful_Polls\Includes;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('DMUP_Useful_Polls_Activator') ) :
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    DMUP_Useful_Polls_Activator
 * @subpackage DMUP_Useful_Polls_Activator/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class DMUP_Useful_Polls_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
                  flush_rewrite_rules();

          global $wpdb;
 
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'polls';

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
         question VARCHAR(255) NOT NULL,
        shortcode_id INT(11) NOT NULL,
        poll_answer_1 VARCHAR(255) NOT NULL,
        poll_votes_answer_1 INT(11) NOT NULL,
        poll_answer_2 VARCHAR(255) NOT NULL,
        poll_votes_answer_2 INT(11) NOT NULL,
        poll_answer_3 VARCHAR(255) NOT NULL,
        poll_votes_answer_3 INT(11) NOT NULL,
        poll_answer_4 VARCHAR(255) NOT NULL,
        poll_votes_answer_4 INT(11) NOT NULL,
        poll_answer_5 VARCHAR(255) NOT NULL,
        poll_votes_answer_5 INT(11) NOT NULL,
        poll_answer_6 VARCHAR(255) NOT NULL,
        poll_votes_answer_6 INT(11) NOT NULL,
        poll_answer_7 VARCHAR(255) NOT NULL,
        poll_votes_answer_7 INT(11) NOT NULL,
        poll_answer_8 VARCHAR(255) NOT NULL,
        poll_votes_answer_8 INT(11) NOT NULL,
        poll_answer_9 VARCHAR(255) NOT NULL,
        poll_votes_answer_9 INT(11) NOT NULL,
        poll_answer_10 VARCHAR(255) NOT NULL,
        poll_votes_answer_10 INT(11) NOT NULL,
        ip_addresses VARBINARY(16) NOT NULL,

        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );



     $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'colors_of_results';

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        color_for_submit_button VARCHAR(255) NOT NULL,
        color_for_question VARCHAR(255) NOT NULL,
        color_for_answers VARCHAR(255) NOT NULL,
        color_for_background VARCHAR(255) NOT NULL,
        color_for_vote_line VARCHAR(255) NOT NULL,
      
        


        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );


	}



}

endif;