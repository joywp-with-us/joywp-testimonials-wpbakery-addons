<?php
/**
 * The template for displaying joywp_testimonial_profile_card_slider_wrapper addon output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\AbstractAddon $addon
 */

defined( 'ABSPATH' ) || exit;
$items = $addon->get_collection( 'param-group', 'main' )->get_items( $atts );
?>

<div class="joywp-testimonial-profile-card-slider-wrapper">
	<div class="joywp-testimonial-profile-card-slider-slider">
		<div class="joywp-testimonial-profile-card-slider__cards">

			<?php
			foreach ( $items as $item ) {
				?>
				<div class="joywp-testimonial-profile-card-slider" data-item-id="<?php echo esc_attr( $item['id'] ); ?>">
					<div class="joywp-testimonial-profile-card-slider__content">
						<div class="joywp-testimonial-profile-card-slider__text">
							<?php
							echo wp_kses_post( $item['testimonial'] );
							?>
						</div>
					</div>
					<div class="joywp-testimonial-profile-card-slider__hero">
						<?php
						$addon->get_collection( 'image', 'testimonial' )->render( $item );
						?>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<div class="joywp-testimonial-profile-card-slider__navigation">
		<?php
		foreach ( $items as $index => $item ) {
			$active = 0 === $index ? 'active' : '';
			?>
				<div class="joywp-testimonial-profile-card-slider__navigation-button <?php echo esc_attr( $active ); ?>"></div>
			<?php
		}
		?>
	</div>
</div>

<style>
	<?php
	if ( 'true' === $atts['is_fancy_background'] ) :
		$addon->output_style_shortcode_id();
		?>
		.joywp-testimonial-profile-card-slider-wrapper {
			background-image: radial-gradient(at 40% 20%,
			rgb(255, 184, 122) 0px,
			transparent 50%),
			radial-gradient(at 80% 0%, rgb(31, 221, 255) 0px, transparent 50%),
			radial-gradient(at 0% 50%, rgb(255, 219, 222) 0px, transparent 50%),
			radial-gradient(at 80% 50%, rgb(255, 133, 173) 0px, transparent 50%),
			radial-gradient(at 0% 100%, rgb(255, 181, 138) 0px, transparent 50%),
			radial-gradient(at 80% 100%, rgb(107, 102, 255) 0px, transparent 50%),
			radial-gradient(at 0% 0%, rgb(255, 133, 167) 0px, transparent 50%);
			background-repeat: no-repeat;
		}
		<?php
	endif;
	$addon->output_style_shortcode_id();
	?>
	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider {
		min-height: <?php echo esc_attr( $atts['height'] ); ?>px;
	}
	<?php $addon->output_style_shortcode_id(); ?>.joywp-testimonial-profile-card-slider-wrapper {
		<?php $addon->get_collection( 'box-shadow', 'main' )->render( $atts ); ?>
	}

	<?php $addon->output_style_shortcode_id(); ?>.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__navigation-button {
		width: <?php echo esc_attr( $atts['slider_controls_width'] ); ?>px;
		height: <?php echo esc_attr( $atts['slider_controls_height'] ); ?>px;
		<?php $addon->get_collection( 'border', 'slider_controls' )->render( $atts ); ?>
		<?php $addon->get_collection( 'cursor', 'slider_controls' )->render( $atts ); ?>
		<?php $addon->get_collection( 'background', 'slider_controls' )->render( $atts ); ?>
	}

	<?php $addon->output_style_shortcode_id(); ?>.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__navigation-button.active {
		width: <?php echo esc_attr( $atts['slider_active_control_width'] ); ?>px;
		height: <?php echo esc_attr( $atts['slider_active_control_height'] ); ?>px;
		<?php $addon->get_collection( 'border', 'slider_active_control' )->render( $atts ); ?>
		<?php $addon->get_collection( 'cursor', 'slider_active_control' )->render( $atts ); ?>
		<?php $addon->get_collection( 'background', 'slider_active_control' )->render( $atts ); ?>
	}

	<?php
	foreach ( $items as $index => $item ) :
		$addon->output_style_shortcode_id();
		?>
			[data-item-id="<?php echo esc_attr( $item['id'] ); ?>"] .joywp-testimonial-profile-card-slider__content {
				min-height: <?php echo esc_attr( $item['min_height'] ); ?>px;

				<?php $addon->get_collection( 'border', 'testimonial' )->render( $item ); ?>
				<?php $addon->get_collection( 'background', 'testimonial' )->render( $item ); ?>
				<?php $addon->get_collection( 'box-shadow', 'testimonial' )->render( $item ); ?>
				<?php $addon->get_collection( 'backdrop-filter', 'testimonial' )->render( $item ); ?>
			}
		<?php
		$addon->output_style_shortcode_id();
		?>
			[data-item-id="<?php echo esc_attr( $item['id'] ); ?>"] .joywp-testimonial-profile-card-slider__hero {
				width: <?php echo esc_attr( $item['image_width'] ); ?>%;
			}
		<?php
	endforeach;
	?>
</style>

<style>
	.joywp-testimonial-profile-card-slider-wrapper * {
		padding: 0;
		margin: 0;
		box-sizing: border-box;
	}

	.joywp-testimonial-profile-card-slider-wrapper {
		width: 100%;
		container-type: inline-size;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider-slider {
		width: 100%;
		overflow: hidden;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__cards {
		width: 100%;
		display: flex;
		transition: 0.5s;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider {
		position: relative;
		flex: 0 0 100%;
		width: 100%;
		overflow: hidden;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__hero {
		position: absolute;
		top: 0;
		right: 0;
		height: 100%;

		display: flex;
		align-items: center;
		justify-content: center;

		overflow: hidden;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__hero img {
		height: 100%;
		width: 100%;
		object-fit: cover;
		pointer-events: none;
		user-select: none;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__navigation-button {
		margin: 4px;
		display: inline-block;
		transition: all 0.5s ease-in-out;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__content {
		position: absolute;
		left: 0;
		top: 50%;
		transform: translateY(-50%);
		max-height: 100%;
		padding: 45px;
		z-index: 2;
		overflow-x: hidden;
		overflow-y: auto;
		scrollbar-width: thin;
		scrollbar-color: #999 transparent;
		width: 70%;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__content::-webkit-scrollbar {
		width: 10px;
		height: 10px;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__content::-webkit-scrollbar-track {
		background: transparent;
		border-radius: 8px;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__content::-webkit-scrollbar-thumb {
		background: #999;
		border-radius: 8px;
		transition: 0.3s;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__content::-webkit-scrollbar-thumb:hover {
		background: linear-gradient(180deg, #aaa, #666);
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__author {
		display: flex;
		flex-direction: column;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__name {
		font-size: 1.5rem;
		font-weight: 600;
		margin-top: 35px;
	}

	.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__navigation {
		display: flex;
		justify-content: center;
		margin-top: 4rem;
	}

	@container (max-width: 500px) {
		.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider {
			display: flex;
			flex-direction: column;
		}

		.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__hero {
			position: static;
			width: 100%;
			min-width: 0px;
			flex: 0 0 400px;
			margin-bottom: 300px;
		}

		.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__content {
			top: 300px;
			transform: none;

			width: 100%;
			max-height: 400px;
			padding: 15px;
		}

		.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__text {
			font-size: 0.85em;
		}

		.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__name {
			font-size: 0.9em;
		}

		.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__role {
			font-size: 0.75em;
		}

		.joywp-testimonial-profile-card-slider-wrapper .joywp-testimonial-profile-card-slider__navigation {
			margin-top: 30px;
		}
	}
</style>

<script>
	(function() {
		const root = document.querySelector(<?php $addon->output_script_shortcode_id(); ?>);
		if (!root) {
			return;
		}

		const slides = root.querySelectorAll('.joywp-testimonial-profile-card-slider-slider');

		window.joywpTestimonialProfileCardSliderProcessSlides(slides);
	})();
</script>
