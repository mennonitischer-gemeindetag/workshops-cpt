<?php
/**
 * Plugin Name: Workshops Custom Post Type
 * Description: Manage Workshops through a Custom Post Type.
 * Author: Fabian Kägy
 * Author URI: fabian-kaegy.com
 * Version: 1.0.0
 * License: GLPv2
 *
 * @package workshops-cpt
 */

namespace gemeindetag\workshops;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * get plugin directory
 */
function _get_plugin_directory() {
	return __DIR__;
}

/**
 * get plugin url
 */
function _get_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}

require _get_plugin_directory() . '/enqueue-scripts.php';
require _get_plugin_directory() . '/workshops.php';
require _get_plugin_directory() . '/workshops-cpt.php';
require _get_plugin_directory() . '/custom-meta.php';
