<?php
/**
 * Backdrop filter collection output template
 *
 * @since 1.0
 * @var string $type
 * @var string $value
 * @var string $unit
 */

defined( 'ABSPATH' ) || exit;
?>

backdrop-filter: <?php echo esc_attr( $type ); ?>(<?php echo esc_attr( $value ); ?><?php echo esc_attr( $unit ); ?>);
-webkit-backdrop-filter: <?php echo esc_attr( $type ); ?>(<?php echo esc_attr( $value ); ?><?php echo esc_attr( $unit ); ?>);
