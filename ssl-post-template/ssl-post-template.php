<?php

/**
 * The plugin bootstrap file
 *
 * @since             1.0.0
 * @package           ssl-post-template
 *
 * @wordpress-plugin
 * Plugin Name:       Post format plugin template for Academic Labbook Plugin
 * Plugin URI:        https://github.com/Academic-Labbook/post-format-plugin-template
 * Description:       A plugin demonstrating how to add default blocks to post types, intended to be customised.
 * Version:           1.0.0
 * Author:            Sean Leavey
 * Author URI:        https://attackllama.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       ssl-post-template
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'SSL_POST_TEMPLATE_VERSION', '1.0.0' );

/**
 * Academic Labbook Plugin path.
 */
define( 'SSL_POST_TEMPLATE_ALP_PATH', 'ssl-alp/alp.php' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ssl-post-template-activator.php
 */
function activate_ssl_post_template() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ssl-post-template-activator.php';
	Ssl_Post_Template_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ssl-post-template-deactivator.php
 */
function deactivate_ssl_post_template() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ssl-post-template-deactivator.php';
	Ssl_Post_Template_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ssl_post_template' );
register_deactivation_hook( __FILE__, 'deactivate_ssl_post_template' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ssl-post-template.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ssl_post_template() {

	$plugin = new Ssl_Pt();
	$plugin->run();

}
run_ssl_post_template();
