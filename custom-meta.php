<?php 

namespace gemeindetag\workshops;

//  Exit if accessed directly.
defined('ABSPATH') || exit;

// nr: Int
// leiter: String
// startZeit: String
// endZeit: String
// beschränkt: Bool
// maxPlätze: Int

$string = array(
    'type' => 'string',
    'single' => true,
    'show_in_rest' => true,
);
$boolean = array(
    'type' => 'boolean',
    'single' => true,
    'show_in_rest' => true,
);
$number = array(
    'type' => 'number',
    'single' => true,
    'show_in_rest' => true,
);
$multiple_numbers = array(
    'type' => 'number',
    'single' => false,
    'show_in_rest' => true,
);

register_post_meta( 'workshops', 'nr', $number );
register_post_meta( 'workshops', 'character', $string );
register_post_meta( 'workshops', 'leiter', $string );
register_post_meta( 'workshops', 'ort', $string );
register_post_meta( 'workshops', 'beschreibung', $string );
register_post_meta( 'workshops', 'startZeit', $string );
register_post_meta( 'workshops', 'endZeit', $string );
register_post_meta( 'workshops', 'beschraenkt', $boolean );
register_post_meta( 'workshops', 'maxPlaetze', $number );
register_post_meta( 'workshops', 'preis', $number );