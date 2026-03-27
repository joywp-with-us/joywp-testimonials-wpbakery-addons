<?php
/**
 * The template for displaying joywp-sticker-testimonial addon output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\AbstractAddon $addon
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="joywp-sticker-testimonial-wrapper">
	<div class="joywp-sticker-testimonial" role="figure" aria-label="<?php echo esc_attr__( 'Testimonial', 'joywp-testimonials-wpbakery-addons' ); ?> )?>">
		<?php
		if ( 'true' === $atts['add_quotes'] ) :
			?>
			<span class="joywp-sticker-testimonial__quote joywp-sticker-testimonial__quote--open" aria-hidden="true">"</span>
			<?php
		endif;
		?>
		<div class="joywp-sticker-testimonial__image" aria-hidden="true">
			<?php
			if ( 'true' === $atts['add_clip'] ) :
				?>
				<div class="joywp-sticker-testimonial__clip"></div>
				<?php
			endif;
			$addon->get_collection( 'image', 'main' )->render( $atts );
			?>
		</div>
		<div class="joywp-sticker-testimonial__text">
			<?php
			echo wp_kses_post( $atts['testimonial'] );
			?>
		</div>
		<div class="joywp-sticker-testimonial__source">
			<div class="joywp-sticker-testimonial__source-label">
				<?php
				echo wp_kses_post( $atts['source'] );
				?>
			</div>
		</div>
		<?php
		if ( 'true' === $atts['add_quotes'] ) :
			?>
			<span class="joywp-sticker-testimonial__quote joywp-sticker-testimonial__quote--close" aria-hidden="true">"</span>
			<?php
		endif;
		?>
	</div>
</div>

<style>
	<?php
	$addon->output_style_shortcode_id();
	?>
	.joywp-sticker-testimonial-wrapper {
		--border-overflow: 30px;
		--border-radius: 50px;
		--triangle-height: <?php echo esc_attr( $atts['triangle_size'] ); ?>px;
	}
	<?php
	$addon->output_style_shortcode_id();
	?>
	.joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial {
		<?php $addon->get_collection( 'background', 'main' )->render( $atts ); ?>
		<?php $addon->get_collection( 'box-shadow', 'main' )->render( $atts ); ?>
		<?php $addon->get_collection( 'border', 'main' )->render( $atts ); ?>
	}
	<?php
	if ( 'true' === $atts['add_quotes'] ) :
		$addon->output_style_shortcode_id();
		?>
		.joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__quote {
			<?php $addon->get_collection( 'font-family', 'quotes' )->render( $atts ); ?>
			font-size: <?php echo esc_attr( $atts['quotes_size'] ); ?>px;
			color: <?php echo esc_attr( $atts['quotes_color'] ); ?>;
			width: <?php echo esc_attr( $atts['quote_background_size'] ); ?>px;
			height: <?php echo esc_attr( $atts['quote_background_size'] ); ?>px;
			<?php $addon->get_collection( 'background', 'quotes' )->render( $atts ); ?>
			position: absolute;
			text-align: center;
			line-height: <?php echo esc_attr( $atts['quotes_line_height'] ); ?>;
		}
		<?php
	endif;
	if ( 'true' === $atts['add_clip'] ) :
		$addon->output_style_shortcode_id();
		?>
		.joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__clip {
			<?php $addon->get_collection( 'border', 'clip' )->render( $atts ); ?>
			border-right: none;
			height: 75px;
			width: 20px;
			position: absolute;
			<?php $addon->get_collection( 'position', 'clip' )->with_unit( '%' )->render( $atts ); ?>
			border-radius: 25px;
		}

		<?php $addon->output_style_shortcode_id(); ?> .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__clip::before {
			content: "";
			position: absolute;
			top: -1px;
			right: 0;
			height: 10px;
			width: 16px;
			<?php $addon->get_collection( 'border', 'clip' )->render( $atts ); ?>
			border-bottom: none;
			border-top-left-radius: 25px;
			border-top-right-radius: 25px;
			z-index: 99;
		}

		<?php $addon->output_style_shortcode_id(); ?> .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__clip::after {
			content: "";
			position: absolute;
			bottom: -1px;
			right: 0;
			height: 40px;
			width: 16px;
			<?php $addon->get_collection( 'border', 'clip' )->render( $atts ); ?>
			border-top: none;
			border-bottom-left-radius: 25px;
			border-bottom-right-radius: 25px;
			z-index: 99;
		}

		@container (max-width: 450px) {
			<?php $addon->output_style_shortcode_id(); ?> .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__clip {
				top: -20%;
			}
		}
		<?php
	endif;
	if ( 'true' === $atts['main_add_image'] ) :
		$addon->output_style_shortcode_id();
		?>
		.joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__image {
			transform: rotate(-5deg);
			position: absolute;
			<?php $addon->get_collection( 'position', 'image' )->with_unit( 'em' )->render( $atts ); ?>
		}

		.joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__image img {
			margin: 0;
			padding: 0;
			display: block;
		}
		<?php
	endif;
	if ( 'true' === $atts['add_triangle'] ) :
		$addon->output_style_shortcode_id();
		?>
		.joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial::before {
			content: "";

			position: absolute;
			top: calc(100% + var(--border-overflow));
			left: calc(10% + 50px);


			z-index: 1;
			width: 0;
			height: 0;

			border-style: solid;
			border-width: var(--triangle-height) min(calc(var(--triangle-height) * 3 / 2), 40cqw) 0 0;

			border-color: <?php echo esc_attr( $atts['triangle_color'] ); ?> transparent transparent transparent;
		}
		<?php
	endif;
	if ( 'true' === $atts['add_frame'] ) :
		$addon->output_style_shortcode_id();
		?>
		.joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial::after {
			content: "";

			<?php $addon->get_collection( 'border', 'frame' )->render( $atts ); ?>


			height: calc(100% + var(--border-overflow) * 2);
			width: 90%;

			top: calc(0px - var(--border-overflow));
			left: 5%;

			position: absolute;
			z-index: -1;
		}
		<?php
	endif;
	?>
</style>
