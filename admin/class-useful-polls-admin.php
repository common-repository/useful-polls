<?php
namespace Useful_Polls\Admin;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    DMUP_Useful_Polls
 
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    DMUP_Useful_Polls
 * @subpackage DMUP_Useful_Polls/admin
 * @author     Your Name <email@example.com>
 */
class DMUP_Useful_Polls_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $useful_polls    The ID of this plugin.
	 */
	private $useful_polls;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $useful_polls       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $useful_polls, $version ) {

		$this->useful_polls = $useful_polls;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.css', array(), "1.0.0", 'all' );
		wp_enqueue_style( 'general_css', plugin_dir_url( __FILE__ ) . 'css/general-admin.css', array(), "1.0.0", 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
  wp_enqueue_style( 'wp-color-picker' );

  wp_enqueue_script( 'color-picker', plugin_dir_url( __FILE__ ) . 'js/color-script-admin.js', array("wp-color-picker"), "1.0", true );

 wp_localize_script( 'color-picker', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );

		
		wp_enqueue_script( 'general_js', plugin_dir_url( __FILE__ ) . 'js/general.js', array( 'jquery' ), '1.0.0', true );

		 wp_localize_script( 'general_js', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );

	}

}
