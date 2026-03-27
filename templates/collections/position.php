<?php
/**
 * Position collection output template
 *
 * @since 1.0
 * @var string $top
 * @var string $bottom
 * @var string $right
 * @var string $left
 * @var string $unit
 */

defined( 'ABSPATH' ) || exit;

if ( '' !== $top ) {
	?>
	top: <?php echo esc_attr( $top ) . esc_attr( $unit ); ?>;
	<?php
}
if ( '' !== $bottom ) {
	?>
	bottom: <?php echo esc_attr( $bottom ) . esc_attr( $unit ); ?>;
	<?php
}
if ( '' !== $right ) {
	?>
	right: <?php echo esc_attr( $right ) . esc_attr( $unit ); ?>;
	<?php
}
if ( '' !== $left ) {
	?>
	left: <?php echo esc_attr( $left ) . esc_attr( $unit ); ?>;
	<?php
}
