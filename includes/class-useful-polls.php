<?php
namespace Useful_Polls\Includes;

use Useful_Polls\Admin\DMUP_Useful_Polls_Admin as DMUP_Useful_Polls_Admin;

use Useful_Polls\Includes\DMUP_Useful_Polls_Admin_Menu as DMUP_Useful_Polls_Admin_Menu;


use Useful_Polls\Includes\DMUP_Useful_Polls_loader as DMUP_Useful_Polls_loader;

use Useful_Polls\Includes\DMUP_Useful_Polls_Activator as DMUP_Useful_Polls_Activator;

use Useful_Polls\Includes\DMUP_Useful_Polls_Deactivator as DMUP_Useful_Polls_Deactivator;

use Useful_Polls\Includes\DMUP_Useful_Polls_Shortcode as DMUP_Useful_Polls_Shortcode;

use Useful_Polls\Includes\DMUP_Useful_Polls_i18n as DMUP_Useful_Polls_i18n;

use Useful_Polls\Includes\DMUP_Useful_Polls_Update_Delete as DMUP_Useful_Polls_Update_Delete;

use Useful_Polls\Frontend\DMUP_Useful_Polls_Public as DMUP_Useful_Polls_Public;



if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('DMUP_Useful_Polls') ) :
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 * 
 *
 *
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    DMUP_Useful_Polls
 * @subpackage DMUP_Useful_Polls/includes
 * @author     Dragan Milunovic <drmilun9@gmail.com>
 */
class DMUP_Useful_Polls {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      DMUP_Useful_Polls_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $DMUP_Useful_Polls    The string used to uniquely identify this plugin.
	 */
	protected $useful_polls;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

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
		if ( defined( 'DMUP_Useful_Polls_VERSION' ) ) {
			$this->version = DMUP_Useful_Polls_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->useful_polls = 'useful-polls';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - DMUP_Useful_Polls_Loader. Orchestrates the hooks of the plugin.
	 * - DMUP_Useful_Polls_i18n. Defines internationalization functionality.
	 * - DMUP_Useful_Polls_Admin. Defines all hooks for the admin area.
	 * - DMUP_Useful_Polls_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
        

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-useful-polls-admin.php';
		

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-useful-polls-activator.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-useful-polls-admin-menu.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-useful-polls-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-useful-polls-i18n.php';
        
       require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-useful-polls-update-delete.php';

        

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-useful-polls-shortcode.php'; 


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-useful-polls-deactivator.php'; 
        

		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-useful-polls-color-elements.php';
       
      require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-useful-polls-public.php';
       
		
        /**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
	
		$this->loader = new DMUP_Useful_Polls_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the DMUP_Useful_Polls_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new DMUP_Useful_Polls_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
        

	   $plugin_admin = new DMUP_Useful_Polls_Admin( $this->get_useful_polls(), $this->get_version() );

	   new DMUP_Useful_Polls_Admin_Menu($this->get_useful_polls(), $this->get_version());


       new DMUP_Useful_Polls_Shortcode($this->get_useful_polls(), $this->get_version());

       new DMUP_Useful_Polls_Activator($this->get_useful_polls(), $this->get_version());

       new DMUP_Useful_Polls_Color_Elements($this->get_useful_polls(), $this->get_version());
       

       new DMUP_Useful_Polls_Color_Elements($this->get_useful_polls(), $this->get_version());
      
       new DMUP_Useful_Polls_i18n($this->get_useful_polls(), $this->get_version());

       new DMUP_Useful_Polls_Update_Delete($this->get_useful_polls(), $this->get_version());




	   $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );

	   $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new DMUP_Useful_Polls_Public
		($this->get_useful_polls(), $this->get_version());

		
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_useful_polls() {
		return $this->get_useful_poll;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    DMUP_Useful_Polls_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

endif;