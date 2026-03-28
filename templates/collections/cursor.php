<?php
/**
 * Cursor collection output template
 *
 * @since 1.0
 * @var string $type
 */

defined( 'ABSPATH' ) || exit;

if ( $type ) {
	?>
	cursor: <?php echo esc_attr( $type ); ?>;
	<?php
}
