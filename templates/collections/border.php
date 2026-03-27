<?php
/**
 * Border collection output template
 *
 * @since 1.0
 * @var string $width
 * @var string $style
 * @var string $color
 * @var string $radius
 */

defined( 'ABSPATH' ) || exit;

if ( '' !== $width ) {
	?>
	border-width: <?php echo esc_attr( $width ); ?>px;
	<?php
}
if ( $style ) {
	?>
	border-style: <?php echo esc_attr( $style ); ?>;
	<?php
}
if ( $color ) {
	?>
	border-color: <?php echo esc_attr( $color ); ?>;
	<?php
}
if ( '' !== $radius ) {
	?>
	border-radius: <?php echo esc_attr( $radius ); ?>px;
	<?php
}
