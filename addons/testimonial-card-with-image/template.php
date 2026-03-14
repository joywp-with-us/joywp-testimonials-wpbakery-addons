<?php
/**
 * The template for displaying testimonial-card-with-image output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\AbstractAddon $addon
 */

defined( 'ABSPATH' ) || exit;
?>

<div>
	<figure class="joywp-testimonial-card-with-image-quote-card">
		<div class="joywp-testimonial-card-with-image-quote-text">
			<?php
			echo wp_kses_post( $atts['testimonial'] );

			if ( 'true' === $atts['add_pointer'] ) :
				?>
				<div class="joywp-testimonial-card-with-image-quote-arrow"></div>
				<?php
			endif;
			?>
		</div>
		<?php
		$addon->get_collection( 'image', 'main' )->render( $atts );
		if ( 'true' === $atts['add_name'] ) :
			?>
			<div class="joywp-testimonial-card-with-image-quote-author joywp-testimonial-card-with-image-name-block-color-bg">
				<div>
					<?php echo wp_kses_post( $atts['name'] ); ?>
				</div>
			</div>
			<?php
		endif;
		?>
	</figure>
</div>

<style>
	<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-card-with-image-quote-card {
		max-width: <?php echo esc_attr( $atts['width'] ); ?>px;

		<?php
		$addon->get_collection( 'border', 'main' )->render( $atts );
		$addon->get_collection( 'box-shadow', 'main' )->render( $atts );
		?>
	}
<?php
if ( 'true' === $atts['add_quotes'] ) :
		$addon->output_style_shortcode_id();
	?>
		.joywp-testimonial-card-with-image-quote-text::before,
		.joywp-testimonial-card-with-image-quote-text::after {
			<?php $addon->get_collection( 'font-family', 'main' )->render( $atts ); ?>
			font-size: <?php echo esc_attr( $atts['quotes_size'] ); ?>px;
			position: absolute;
			pointer-events: none;
		}
		<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-card-with-image-quote-text::before {
			content: "\201C";
			top: 25px;
			left: 20px;
		}
		<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-card-with-image-quote-text::after {
			content: "\201D";
			right: 20px;
			bottom: 0;
		}
		<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-card-with-image-quote-text {
			color: <?php echo esc_attr( $atts['quotes_color'] ); ?>;
		}
		<?php
	endif;

	$addon->output_style_shortcode_id();
?>
	.joywp-testimonial-card-with-image-name-block-color-bg {
		background-color: <?php echo esc_attr( $atts['name_block_background'] ?: '#ffffff' ); ?>;
	}

	<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-card-with-image-quote-text {
		background-color: <?php echo esc_attr( $atts['testimonial_background'] ); ?>;
	}

	<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-card-with-image-quote-arrow {
		border-right: <?php echo esc_attr( $atts['pointer_size'] ); ?>px solid transparent;
		border-top: <?php echo esc_attr( $atts['pointer_size'] ); ?>px solid <?php echo esc_attr( $atts['pointer_color'] ); ?>;
		left: <?php echo esc_attr( $atts['pointer_position'] ); ?>%;
	}
</style>
