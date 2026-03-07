<?php
/**
 * The template for displaying interactive-shuffling-testimonials addon output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\AbstractAddon $addon
 */

defined( 'ABSPATH' ) || exit;

$items = $addon->get_collection( 'param-group', 'main' )->get_items( $atts );

$testimonial_list = [];
foreach ( $items as $item ) :
	$testimonial = [
		'name'  => $item['title'] ?? '',
		'title' => $item['subtitle'] ?? '',
		'text'  => $item['testimonial'] ?? '',
		'size'  => $item['size'] ?? 'small',
		'id'    => ( $item['id'] ),
	];
	if ( isset( $item['add_quot'] ) && 'true' === $item['add_quot'] ) {
		$testimonial['quot_color'] = $item['quot_color'];
	}
	if ( isset( $item['avatar_add_image'] ) && 'true' === $item['avatar_add_image'] ) {
		$testimonial['avatar'] = $addon->get_collection( 'image', 'avatar' )->get_image_link( $item );
		if ( isset( $item['avatar_add_border'] ) && 'true' === $item['avatar_add_border'] ) {
			$testimonial['avatar_border_color'] = $item['avatar_border_color'] ?? '';
			$testimonial['avatar_border_width'] = $item['avatar_border_width'] ?? 0;
			$testimonial['avatar_border_style'] = $item['avatar_border_style'] ?? 'solid';
		}
	}
	$testimonial_list[] = $testimonial;
endforeach;
?>

<div class="joywp-horizontal-testimonial-card__root">
	<div class="joywp-horizontal-testimonial-card__container">
		<?php
		if ( $atts['top_heading'] ) :
			?>
			<div class="joywp-horizontal-testimonial-card__header">
				<?php
				echo wp_kses_post( $atts['top_heading'] );
				?>
			</div>
			<?php
		endif;
		?>
		<div class="joywp-horizontal-testimonial-card__grid" role="list" aria-label="<?php echo esc_attr__( 'Testimonials', 'joywp-testimonials-wpbakery-addons' ); ?>"></div>

		<?php
		if ( 'builder' === $atts['select_button'] ) {
			$addon
				->get_collection( 'button', 'shuffle' )
				->render( $atts );
		} elseif ( 'fancy' === $atts['select_button'] ) {
			?>
			<button class="joywp-horizontal-testimonial-card__btn-rotate">
				<?php echo esc_attr( $atts['button_text'] ); ?>
			</button>
			<?php
		}
		?>

		<div class="joywp-horizontal-testimonial-card__particles" aria-hidden="true"></div>
	</div>
</div>

<style>
	<?php
	if ( 'fancy' === $atts['select_button'] ) :
		?>
		.joywp-horizontal-testimonial-card__btn-rotate {
			position: relative;
			display: block;
			margin-left: auto;
			margin-right: auto;
			background: linear-gradient(45deg, #6a0572, #ff6b6b);
			color: white;
			border: none;
			padding: 10px 20px;
			border-radius: 30px;
			cursor: pointer;
			font-weight: 600;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
			transition: all 0.3s ease;
			z-index: 20;
			opacity: 0;
			animation: joywp-fadeIn 1s ease 1s forwards;
		}

		.joywp-horizontal-testimonial-card__btn-rotate:hover {
			transform: scale(1.05);
			box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
		}

		.joywp-horizontal-testimonial-card__btn-rotate:focus {
			outline: 2px solid white;
			outline-offset: 2px;
		}
		<?php
	endif;
	if ( $atts['top_heading'] ) :
		$addon->output_style_shortcode_id();
		?>
		.joywp-horizontal-testimonial-card__accent-1 {
			color: #ff6b6b;
		}

		<?php $addon->output_style_shortcode_id(); ?> .joywp-horizontal-testimonial-card__accent-2 {
			color: #4ecdc4;
		}
		<?php $addon->output_style_shortcode_id(); ?> .joywp-horizontal-testimonial-card__header-title {
			font-size: 2.2rem;
			margin-bottom: 10px;
			font-weight: 800;
			background: linear-gradient(45deg, #6a0572, #333);
			-webkit-background-clip: text;
			background-clip: text;
			color: transparent;
		}
		<?php $addon->output_style_shortcode_id(); ?> .joywp-horizontal-testimonial-card__header-description {
			font-size: 1rem;
			color: #333333;
			opacity: 0.8;
			max-width: 80%;
			margin: 0 auto;
		}
		@media (max-width: 700px) {
			<?php $addon->output_style_shortcode_id(); ?> .joywp-horizontal-testimonial-card__header-title {
				font-size: 1.8rem;
			}
			.joywp-horizontal-testimonial-card__header-description {
				font-size: 0.9rem;
			}
		}
		@media (max-width: 500px) {
			<?php $addon->output_style_shortcode_id(); ?> .joywp-horizontal-testimonial-card__header-title {
				font-size: 1.5rem;
			}
		}
		<?php
	endif;
	foreach ( $items as $index => $item ) :
		if ( ! empty( $item['add_top_accent'] ) ) :
			$addon->output_style_shortcode_id();
			?>
				[data-item-id="<?php echo esc_attr( $item['id'] ); ?>"]::before {
					content: '';
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 4px;
					<?php $addon->get_collection( 'background', 'accent' )->render( $item ); ?>
				}
				<?php
			endif;
			$addon->output_style_shortcode_id();
		?>
			[data-item-id="<?php echo esc_attr( $item['id'] ); ?>"] {
					<?php
					$addon->get_collection( 'background', 'item' )->render( $item );
					$addon->get_collection( 'border', 'item' )->render( $item );
					$addon->get_collection( 'box-shadow', 'item' )->render( $item );
					?>
				}
			<?php
			if ( $item['add_item_hover'] ) :
				$addon->output_style_shortcode_id();
				?>
				[data-item-id="<?php echo esc_attr( $item['id'] ); ?>"]:hover {
				<?php
					$addon->get_collection( 'box-shadow', 'item_hover' )->render( $item );
					$addon->get_collection( 'border', 'item_hover' )->render( $item );
				?>
				}
				<?php
			endif;
	endforeach;
	?>
</style>

<script>
	(function() {
		'use strict';

		const addonId = <?php echo wp_json_encode( $addon->id ); ?>;
		const dataAttr = <?php echo wp_json_encode( $addon->get_data_attribute_id() ); ?>;
		const root = document.querySelector('[' + dataAttr + '="' + addonId + '"]');
		if (!root) return;

		const testimonials = <?php echo wp_json_encode( $testimonial_list ); ?>;

		const grid = root.querySelector('.joywp-horizontal-testimonial-card__grid');
		const particlesContainer = root.querySelector('.joywp-horizontal-testimonial-card__particles');
		const rotateBtn = root.querySelector('.joywp-horizontal-testimonial-card__btn-rotate') || root.querySelector('.joywp-horizontal-testimonial-card__container button, .joywp-horizontal-testimonial-card__container a');

		if (!grid || !particlesContainer) return;

		window.joywpInteractiveShufflingTestimonialsRenderTestimonials(root, grid, testimonials);
		window.joywpInteractiveShufflingTestimonialsAttachMousemove(root);
		<?php
		if ( 'true' === $atts['is_animated'] ) :
			?>
			const colors = ['#ff6b6b', '#4ecdc4', '#ffe66d', '#6a0572', '#1a2a6c'];

			for (let i = 0; i < 15; i++) {
				const particle = document.createElement('div');
				particle.className = 'joywp-horizontal-testimonial-card__particle';

				const size = Math.random() * 8 + 3;
				particle.style.width = size + 'px';
				particle.style.height = size + 'px';
				particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
				particle.style.left = Math.random() * 100 + '%';
				particle.style.top = Math.random() * 100 + '%';
				particle.style.animationDelay = Math.random() * 5 + 's';

				particlesContainer.appendChild(particle);
			}
			<?php
		endif;
		if ( 'none' !== $atts['select_button'] ) :
			?>
			rotateBtn.addEventListener('click', function() {
				const cards = grid.querySelectorAll('.joywp-horizontal-testimonial-card__card');
				cards.forEach(function(card, index) {
					setTimeout(function() {
						card.style.opacity = '0';
						card.style.transform = 'translateY(30px) scale(0.95)';
					}, index * 50);
				});

				setTimeout(function() {
					grid.innerHTML = '';
					window.joywpInteractiveShufflingTestimonialsRenderTestimonials(root, grid, testimonials);
					<?php
					if ( 'true' === $atts['is_button_animated'] ) :
						?>
					createParticleBurst();
						<?php
					endif;
					?>
				}, cards.length * 50 + 300);
			});
			<?php
			if ( 'true' === $atts['is_button_animated'] ) :
				?>
				function createParticleBurst() {
					const colors = ['#ff6b6b', '#4ecdc4', '#ffe66d', '#6a0572', '#1a2a6c'];

					for (let i = 0; i < 20; i++) {
						const particle = document.createElement('div');
						particle.className = 'joywp-horizontal-testimonial-card__particle';

						const size = Math.random() * 10 + 5;
						particle.style.width = size + 'px';
						particle.style.height = size + 'px';
						particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
						particle.style.left = '50%';
						particle.style.top = '50%';
						particle.style.animation = 'none';
						particle.style.opacity = '0.8';

						const angle = Math.random() * Math.PI * 2;
						const distance = 100 + Math.random() * 100;
						const duration = 1 + Math.random() * 2;

						particlesContainer.appendChild(particle);

						(function(p, a, d, dur) {
							setTimeout(function() {
								p.style.transition = 'all ' + dur + 's ease-out';
								p.style.transform = 'translate(' + (Math.cos(a) * d) + 'px, ' + (Math.sin(a) * d) + 'px) rotate(' + (Math.random() * 360) + 'deg)';
								p.style.opacity = '0';
							}, 10);

							setTimeout(function() {
								if (p.parentNode) {
									p.parentNode.removeChild(p);
								}
							}, dur * 1000 + 100);
						})(particle, angle, distance, duration);
					}
				}
				<?php
			endif;
		endif;
		?>
	})();
</script>
