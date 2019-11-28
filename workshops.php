<?php 

namespace gemeindetag\workshops;

//  Exit if accessed directly.
defined('ABSPATH') || exit;

function gemeindetag_workshops_render_callback( $attributes, $content ) {    
    ob_start();
    ?> <div class="wp-block-workshopscpt-workshops"><?php

    $date_to_compare = date('Y-m-d\TH:m:i',strtotime($attributes['date']));
    $isBefore = $attributes['isBefore'];

    $args = [ 
        'post_type' => 'workshops',
        'posts_per_page' => 99,
        "order" => "ASC",
        'meta_key'     => 'startZeit',
        'meta_value'   => $date_to_compare,
        'meta_compare' => $isBefore ? '<=' : '>=',
        'meta_type'    => 'DATETIME'
    ];
    
    $workshops_query = new \WP_Query($args); 
    if ($workshops_query->have_posts()) : while($workshops_query->have_posts()) : $workshops_query->the_post(); ?> 

        <?php include _get_plugin_directory() . '/workshop.php'; ?>

    <?php endwhile; else : ?>

        <p>Keine Workshops</p>
    
    <?php endif; 
    
    wp_reset_postdata(); 

    ?></div><?php

    $data = ob_get_clean();

    return $data;
}