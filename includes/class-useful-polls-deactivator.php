<?php
namespace Useful_Polls\Includes;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('DMUP_Useful_Polls_Deactivator') ) :
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    DMUP_Useful_Polls_Deactivator
 * @subpackage DMUP_Useful_Polls_Deactivator/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */

class DMUP_Useful_Polls_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 */
	public static function deactivate() {
      flush_rewrite_rules();
	}

}

endif;
