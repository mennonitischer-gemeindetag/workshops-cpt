<?php
/**
 * workshop block
 *
 * @package workshops-cpt
 */

namespace gemeindetag\workshops;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * block render callback
 *
 * @param array  $attributes block attributes
 * @param string $content inner blocks markup
 */
function gemeindetag_workshops_render_callback( $attributes, $content ) {
	ob_start();
	?> <div class="wp-block-workshopscpt-workshops">
	<?php

	$date_to_compare = gmdate( 'Y-m-d\TH:m:i', strtotime( $attributes['date'] ) );
	$is_before       = $attributes['isBefore'];

	$args = [
		'post_type'      => 'workshops',
		'posts_per_page' => 99,
		'order'          => 'ASC',
		'meta_key'       => 'startZeit',
		'meta_value'     => $date_to_compare,
		'meta_compare'   => $is_before ? '<=' : '>=',
		'meta_type'      => 'DATETIME',
	];

	$workshops_query = new \WP_Query( $args );
	if ( $workshops_query->have_posts() ) : while ( $workshops_query->have_posts() ) : $workshops_query->the_post();

			include _get_plugin_directory() . '/workshop.php';

	endwhile; else :
		?>
		<p>Keine Workshops</p>
		<?php
	endif;

	wp_reset_postdata();

	?>
	</div>
	<?php

	$data = ob_get_clean();

	return $data;
}
