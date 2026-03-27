<?php
/**
 * Box shadow collection output template
 *
 * @since 1.0
 * @var string $horizontal
 * @var string $vertical
 * @var string $blur
 * @var string $spread
 * @var string $color
 */

defined( 'ABSPATH' ) || exit;

if ( $color ) {
	?>
	box-shadow: <?php echo esc_attr( $horizontal ); ?>px <?php echo esc_attr( $vertical ); ?>px <?php echo esc_attr( $blur ); ?>px <?php echo esc_attr( $spread ); ?>px <?php echo esc_attr( $color ); ?>;
	<?php
}
