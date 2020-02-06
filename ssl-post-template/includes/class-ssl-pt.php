<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0.0
 *
 * @package    ssl-post-template
 * @subpackage ssl-post-template/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    ssl-post-template
 * @subpackage ssl-post-template/includes
 * @author     Sean Leavey <wordpress@attackllama.com>
 */
class Ssl_Pt {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ssl_Post_Template_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

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
		$this->version = SSL_POST_TEMPLATE_VERSION;
		$this->plugin_name = 'ssl-post-template';

		$this->load_dependencies();
		$this->register_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ssl_Post_Template_Loader. Orchestrates the hooks of the plugin.
	 * - Ssl_Post_Template_i18n. Defines internationalization functionality.
	 * - Ssl_Post_Template_Admin. Defines all hooks for the admin area.
	 * - Ssl_Post_Template_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ssl-post-template-loader.php';

		/**
		 * Post templates.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ssl-post-template-post-templates.php';

		$this->loader = new Ssl_Post_Template_Loader();
		$this->post_templates = new Ssl_Post_Template_Post_Templates( $this->loader );
	}

	/**
	 * Register all of the hooks related to the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function register_hooks() {
		$this->post_templates->register_hooks();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		if ( ! $this->is_ssl_alp_active() ) {
			// Nothing to do.
			return;
		}

		$this->loader->run();
	}

	/**
	 * Check if the Academic Labbook Plugin is active on this site.
	 * 
	 * @since    1.0.0
	 * @access   private
	 */
	private function is_ssl_alp_active() {
		$blog_plugins = (array) get_option( 'active_plugins', array() );
		$blog_active  = in_array( SSL_POST_TEMPLATE_ALP_PATH, $blog_plugins, true );

		if ( is_multisite() ) {
			$network_plugins = (array) get_site_option( 'active_sitewide_plugins', array() );
			$network_active  = isset( $network_plugins[ SSL_POST_TEMPLATE_ALP_PATH ] );
		} else {
			$network_active = false;
		}

		return $blog_active || $network_active;
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ssl_Post_Template_Loader    Orchestrates the hooks of the plugin.
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
