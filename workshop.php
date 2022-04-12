<?php
/**
 * template for a single workshop
 *
 * @package workshops-cpt
 */

	$start_date          = get_post_meta( get_the_ID(), 'startZeit', true );
	$end_date            = get_post_meta( get_the_ID(), 'endZeit', true );
	$leiter              = get_post_meta( get_the_ID(), 'leiter', true );
	$beschreibung        = get_post_meta( get_the_ID(), 'beschreibung', true );
	$character           = get_post_meta( get_the_ID(), 'character', true );
	$nr                  = get_post_meta( get_the_ID(), 'nr', true );
	$preis               = get_post_meta( get_the_ID(), 'preis', true );
	$registration_closed = get_post_meta( get_the_ID(), 'registrationClosed', true );

	$start = new \DateTime( $start_date );
	$end   = new \DateTime( $end_date );
?>

<div class="workshop" id="<?php echo esc_attr( "$character$nr" ); ?>" >
	<header>
		<span class="workshop-nummer">
			<p><?php echo esc_attr( "$character$nr" ); ?></p>
		</span>
		<h3 class="workshop-leiter"><?php echo esc_attr( $leiter ); ?></h3>
		<?php if ( $registration_closed ) { ?>
			<p class="registration-closed">Ausgebucht!</p>
		<?php } ?>
	</header>
	<div class="workshop-content">
		<h2><?php the_title(); ?></h2>
		<p><?php echo esc_attr( $beschreibung ); ?></p>
		<footer class="workshop-footer">
			<span class="zeit"><?php echo esc_attr( $start->format( 'H:i' ) ); ?><?php echo esc_attr( ' - ' . $end->format( 'H:i' ) ); ?></span>
			<?php if ( $preis ) { ?>
				<span class="preis"><?php echo esc_attr( "$preis €" ); ?></span>
			<?php } ?>
		</footer>
	</div>
</div>
