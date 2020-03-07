<?php
/**
 * gemeindetag workshop cpt
 *
 * @package gemeindetag-workshop
 */

namespace gemeindetag\workshops;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Create custom post type workshop
 */
function custom_post_type_workshops() {
	$labels = [
		'name'               => __( 'Workshops', 'workshops-cpt' ),
		'singular_name'      => __( 'Workshop', 'workshops-cpt' ),
		'menu_name'          => __( 'Workshops', 'workshops-cpt' ),
		'parent_item_colon'  => __( 'Übergeordneter Workshop', 'workshops-cpt' ),
		'all_items'          => __( 'Alle Workshops', 'workshops-cpt' ),
		'view_item'          => __( 'Workshop Anzeigen', 'workshops-cpt' ),
		'add_new_item'       => __( 'Neuen Workshop hinzufügen', 'workshops-cpt' ),
		'add_new'            => __( 'Neuen hinzufügen', 'workshops-cpt' ),
		'edit_item'          => __( 'Workshop bearbeiten', 'workshops-cpt' ),
		'update_item'        => __( 'Workshop Aktualisieren', 'workshops-cpt' ),
		'search_items'       => __( 'Workshop Suchen', 'workshops-cpt' ),
		'not_found'          => __( 'Nichts gefunden', 'workshops-cpt' ),
		'not_found_in_trash' => __( 'Nichts im Papierkorb gefunden', 'workshops-cpt' ),
	];

	$args = [
		'labels'                => $labels,
		'description'           => __( 'Workshops', 'workshops-cpt' ),
		'menu_icon'             => 'dashicons-clipboard',
		'supports'              => [ 'title', 'editor', 'thumbnail', 'meta', 'custom-fields' ],
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'show_in_admin_bar'     => true,
		'menu_position'         => 20,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'rest_base'             => 'workshops',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'template'              => [
			[ 'gemeindetag/workshop', [] ],
			[ 'gemeindetag/anmeldungen', [] ],
			[ 'gemeindetag/send-email', [] ],
		],
		'template_lock'         => 'all', // or 'insert' to allow moving
	];
	register_post_type( 'workshops', $args );

}
add_action( 'init', __NAMESPACE__ . '\custom_post_type_workshops', 0 );




/**
 * A filter to add custom columns and remove built-in
 * columns from the edit.php screen.
 *
 * @access public
 * @param Array $columns The existing columns
 * @return Array $filtered_columns The filtered columns
 */
function workshops_modify_columns( $columns ) {

	// New columns to add to table
	$new_columns = [
		'workshop_nummer' => 'Nummer',
		'leiter'          => 'Leiter',
		'anmeldungen'     => 'Anmeldungen',
	];

	// Remove unwanted publish date column
	unset( $columns['date'] );

	// rename columns
	$columns['title'] = 'Workshop';

	// Combine existing columns with new columns
	$filtered_columns = array_merge( $columns, $new_columns );

	// Return our filtered array of columns
	return $filtered_columns;
}

// Let WordPress know to use our filter
add_filter( 'manage_workshops_posts_columns', __NAMESPACE__ . '\workshops_modify_columns' );


/**
 * Render custom column content within edit.php
 * table on workshops post types.
 *
 * @access public
 * @param String $column The name of the column being acted upon
 * @return void
 */
function workshops_custom_column_content( $column ) {

	// Get the post object for this row so we can output relevant data
	global $post;

	// Check to see if $column matches our custom column names
	switch ( $column ) {

		case 'workshop_nummer':
			// Retrieve post meta
			$nummer = get_post_meta( $post->ID, 'nr', true );

			// Echo output and then include break statement
			echo ( ! empty( $nummer ) ? esc_attr( $nummer ) : '' );
			break;

		case 'leiter':
			// Retrieve post meta
			$leiter = get_post_meta( $post->ID, 'leiter', true );

			// Echo output and then include break statement
			echo ( ! empty( $leiter ) ? esc_attr( "$leiter" ) : '' );
			break;

		case 'anmeldungen':
			$post_id = $post->ID;
			$query   = new \WP_Query(
				[
					'post_type'      => 'anmeldung',
					'posts_per_page' => -1,
					'meta_query'     => [
						'relation' => 'AND',
						[
							'key'     => 'workshops',
							'value'   => $post_id,
							'compare' => 'LIKE',
						],
						[
							'key'     => 'status',
							'value'   => 'storniert',
							'compare' => '!=',
						],
					],
				]
			);

			echo esc_attr( $query->found_posts );
			break;

	}
}

// Let WordPress know to use our action
add_action( 'manage_workshops_posts_custom_column', __NAMESPACE__ . '\workshops_custom_column_content' );


/**
 * Make custom columns sortable.
 *
 * @access public
 * @param Array $columns The original columns
 * @return Array $columns The filtered columns
 */
function workshops_custom_columns_sortable( $columns ) {

	// Add our columns to $columns array
	$columns['workshop_nummer'] = 'workshop_nummer';
	$columns['leiter']          = 'leiter';

	return $columns;
}

// Let WordPress know to use our filter
add_filter( 'manage_edit-workshops_sortable_columns', __NAMESPACE__ . '\workshops_custom_columns_sortable' );
