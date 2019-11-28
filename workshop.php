<?php
    $start_date = get_post_meta(get_the_ID(), 'startZeit', true);
    $end_date = get_post_meta(get_the_ID(), 'endZeit', true);
    $leiter = get_post_meta(get_the_ID(), 'leiter', true);
    $beschreibung = get_post_meta(get_the_ID(), 'beschreibung', true);
    $character = get_post_meta(get_the_ID(), 'character', true);
    $nr = get_post_meta(get_the_ID(), 'nr', true);
    $preis = get_post_meta(get_the_ID(), 'preis', true);
    
    $start = new \DateTime($start_date); 
    $end = new \DateTime($end_date); 
?>

<div class="workshop" id="<?php echo("$character$nr"); ?>" >
    <header>
        <span class="workshop-nummer">
            <p><?php echo("$character$nr") ?></p>
        </span>
        <h3 class="workshop-leiter"><?php echo($leiter) ?></h3>
    </header>
    <div class="workshop-content">
        <h2><?php the_title(); ?></h2>
        <p><?php echo ($beschreibung) ?></p>
        <footer class="workshop-footer">
             <span class="zeit"><?php echo( $start->format('H:i') ); echo( " - ". $end->format("H:i") ); ?></span>
            <?php if ( $preis ) { ?>
                <span class="preis"><?php echo( "$preis €" ) ?></span>
            <?php } ?>
        </footer>
    </div>
</div>