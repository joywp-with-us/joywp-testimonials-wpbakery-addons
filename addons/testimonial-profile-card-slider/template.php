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
				<button class="joywp-testimonial-profile-card-slider__navigation-button <?php echo esc_attr( $active ); ?>"></button>
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

<script>
	(function() {
		const root = document.querySelector(<?php $addon->output_script_shortcode_id(); ?>);
		if (!root) {
			return;
		}

		const slides = root.querySelectorAll('.joywp-testimonial-profile-card-slider-slider');

		if ( typeof window.joywpTestimonialProfileCardSliderProcessSlides === 'function' ) {
			window.joywpTestimonialProfileCardSliderProcessSlides(slides);
		}
	})();
</script>
