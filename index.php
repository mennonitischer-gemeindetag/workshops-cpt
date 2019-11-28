<?php
/**
 * Plugin Name: Workshops Custom Post Type
 * Description: WordPress CPT Workshops.
 * Author: Fabian Kägy
 * Author URI: fabian-kaegy.de
 * Version: 1.0.0
 * License: UNLICENSED
 */

namespace gemeindetag\workshops;

//  Exit if accessed directly.
defined('ABSPATH') || exit;

function _get_plugin_directory() {
	return __DIR__;
}

function _get_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}

include _get_plugin_directory() . '/enqueue-scripts.php';
include _get_plugin_directory() . '/workshops.php';
include _get_plugin_directory() . '/workshops-cpt.php';
include _get_plugin_directory() . '/custom-meta.php';