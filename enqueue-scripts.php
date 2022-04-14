<?php
/**
 * enqueue scripts
 *
 * @package workshops-cpt
 */

namespace gemeindetag\workshops;

add_action( 'init', __NAMESPACE__ . '\register_blocks' );

/**
 * register block assets
 */
function register_blocks() {

	register_block_type(
		__DIR__ . '/build/blocks/workshops',
		[
			'render_callback' => __NAMESPACE__ . '\gemeindetag_workshops_render_callback',
		]
	);

	register_block_type( __DIR__ . '/build/blocks/workshop' );

}
