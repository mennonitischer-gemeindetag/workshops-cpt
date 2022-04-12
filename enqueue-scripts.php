<?php
/**
 * enqueue scripts
 *
 * @package workshops-cpt
 */

namespace gemeindetag\workshops;

add_action( 'init', __NAMESPACE__ . '\register_block_assets' );

/**
 * register block assets
 */
function register_block_assets() {

	$block_path          = '/build/index.js';
	$script_dependencies = ( include _get_plugin_directory() . '/build/index.asset.php' );
	wp_register_script(
		'gemeindetag-workshops-blocks',
		_get_plugin_url() . $block_path,
		array_merge( $script_dependencies['dependencies'], [] ),
		$script_dependencies['version'],
		false
	);

	$style_path = '/style.css';
	wp_register_style(
		'gemeindetag-workshops-blocks-styles',
		_get_plugin_url() . $style_path,
		[],
		$script_dependencies['version']
	);

	$editor_path = '/editor.css';
	wp_register_style(
		'gemeindetag-workshops-blocks-editor-styles',
		_get_plugin_url() . $editor_path,
		[],
		$script_dependencies['version']
	);

	register_block_type(
		'gemeindetag/workshops',
		[
			'editor_script'   => 'gemeindetag-workshops-blocks',
			'editor_style'    => 'gemeindetag-workshops-blocks-editor-styles',
			'style'           => 'gemeindetag-workshops-blocks-styles',
			'render_callback' => __NAMESPACE__ . '\gemeindetag_workshops_render_callback',
			'attributes'      => [
				'date'     => [
					'type' => 'string',
				],
				'isBefore' => [
					'type'    => 'boolean',
					'default' => true,
				],
			],
		]
	);

}

add_action( 'init', __NAMESPACE__ . '\enqueue_frontend_assets' );

/**
 * enqueue frontend assets
 */
function enqueue_frontend_assets() {

	// If in the backend, bail out.
	if ( is_admin() ) {
		return;
	}

	$frontend_path         = '/build/frontend.js';
	$frontend_dependencies = ( include _get_plugin_directory() . '/build/frontend.asset.php' );
	wp_enqueue_script(
		'gemeindetag-workshops-blocks-frontend',
		_get_plugin_url() . $frontend_path,
		array_merge( $frontend_dependencies['dependencies'], [] ),
		$frontend_dependencies['version'],
		false
	);
}
