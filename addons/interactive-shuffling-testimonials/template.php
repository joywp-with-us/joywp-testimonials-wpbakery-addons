<?php
/**
 * The template for displaying interactive-shuffling-testimonials output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\AbstractAddon $addon
 */

defined( 'ABSPATH' ) || exit;
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
		<div class="joywp-horizontal-testimonial-card__grid" id="joywp-testimonialGrid" role="list" aria-label="<?php echo esc_attr__( 'Testimonials', 'joywp-testimonials-wpbakery-addons' ); ?>"></div>

		<button class="joywp-horizontal-testimonial-card__btn-rotate" id="joywp-rotateBtn">Shuffle Testimonials</button>

		<div class="joywp-horizontal-testimonial-card__particles" id="joywp-particles" aria-hidden="true"></div>
	</div>
</div>

<style>
	<?php
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
			color: var(--joywp-dark);
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
	<?php endif; ?>
</style>

<style>
	.joywp-horizontal-testimonial-card__root {
		--joywp-primary: #ff6b6b;
		--joywp-secondary: #4ecdc4;
		--joywp-accent2: #6a0572;
		--joywp-accent3: #1a2a6c;
		--joywp-light: #f7f7f7;
		--joywp-dark: #333;
		box-sizing: border-box;
	}

	.joywp-horizontal-testimonial-card__root * {
		box-sizing: border-box;
	}

	.joywp-horizontal-testimonial-card__root {
		font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
		background-color: var(--joywp-light);
		width: 100%;
		min-height: 700px;
		display: flex;
		justify-content: center;
		align-items: center;
		perspective: 1000px;
	}

	.joywp-horizontal-testimonial-card__container {
		position: relative;
		width: 100%;
		min-height: 700px;
		padding: 20px;
		overflow: hidden;
	}

	.joywp-horizontal-testimonial-card__header {
		text-align: center;
		margin-bottom: 20px;
		opacity: 0;
		transform: translateY(-20px);
		animation: joywp-fadeInDown 0.8s ease forwards;
	}

	.joywp-horizontal-testimonial-card__grid {
		position: relative;
		min-height: 560px;
		width: 100%;
		overflow: hidden;
	}

	.joywp-horizontal-testimonial-card__card {
		background: white;
		border-radius: 12px;
		padding: 20px;
		box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.08);
		transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
		cursor: pointer;
		overflow: hidden;
		opacity: 0;
		transform: translateY(30px) scale(0.95);
		animation: joywp-fadeInUp 0.8s ease forwards;
		border-top: 4px solid transparent;
		background-clip: padding-box;
		position: relative;
	}

	.joywp-horizontal-testimonial-card__card::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 4px;
		background: linear-gradient(to right, var(--joywp-primary), var(--joywp-secondary));
	}

	.joywp-horizontal-testimonial-card__card:hover {
		transform: translateY(-10px) scale(1.02);
		box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.12);
		z-index: 10;
	}

	.joywp-horizontal-testimonial-card__card:hover .joywp-horizontal-testimonial-card__quote {
		opacity: 0.12;
	}

	.joywp-horizontal-testimonial-card__card:focus {
		outline: 2px solid var(--joywp-primary);
		outline-offset: 2px;
	}

	.joywp-horizontal-testimonial-card__card-small {
		width: 200px;
		min-height: 180px;
	}

	.joywp-horizontal-testimonial-card__card-medium {
		width: 240px;
		min-height: 220px;
	}

	.joywp-horizontal-testimonial-card__card-large {
		width: 300px;
		min-height: 260px;
	}

	.joywp-horizontal-testimonial-card__quote {
		position: absolute;
		bottom: 5px;
		right: 10px;
		font-size: 80px;
		line-height: 1;
		font-family: Georgia, serif;
		transition: opacity 0.3s ease;
		pointer-events: none;
		user-select: none;
	}

	.joywp-horizontal-testimonial-card__client-info {
		display: flex;
		align-items: center;
		margin-bottom: 12px;
	}

	.joywp-horizontal-testimonial-card__client-avatar {
		width: 36px;
		height: 36px;
		border-radius: 50%;
		margin-right: 10px;
		background-size: cover;
		background-position: center;
		flex-shrink: 0;
	}

	.joywp-horizontal-testimonial-card__client-details {
		flex: 1;
		min-width: 0;
	}

	.joywp-horizontal-testimonial-card__client-name {
		font-weight: 600;
		font-size: 0.9rem;
		line-height: 1.2;
	}

	.joywp-horizontal-testimonial-card__client-title {
		font-size: 0.7rem;
		opacity: 0.7;
	}

	.joywp-horizontal-testimonial-card__text {
		font-size: 0.9rem;
		line-height: 1.5;
		color: var(--joywp-dark);
	}

	.joywp-horizontal-testimonial-card__card-small .joywp-horizontal-testimonial-card__text {
		font-size: 0.8rem;
		max-height: 85px;
		overflow: hidden;
		white-space: pre-line;
	}

	.joywp-horizontal-testimonial-card__card-medium .joywp-horizontal-testimonial-card__text {
		max-height: 125px;
		overflow: hidden;
		white-space: pre-line;
	}

	.joywp-horizontal-testimonial-card__card-large .joywp-horizontal-testimonial-card__text {
		max-height: 165px;
		overflow: hidden;
		white-space: pre-line;
	}

	.joywp-horizontal-testimonial-card__btn-rotate {
		position: relative;
		margin-top: 30px;
		display: block;
		margin-left: auto;
		margin-right: auto;
		background: linear-gradient(45deg, var(--joywp-accent2), var(--joywp-primary));
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

	.joywp-horizontal-testimonial-card__particles {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		pointer-events: none;
		overflow: hidden;
	}

	.joywp-horizontal-testimonial-card__particle {
		position: absolute;
		border-radius: 50%;
		opacity: 0;
		animation: joywp-float 3s infinite ease-in-out;
	}

	@keyframes joywp-float {
		0%, 100% {
			transform: translateY(0) rotate(0deg);
			opacity: 0;
		}
		50% {
			opacity: 0.7;
		}
		100% {
			transform: translateY(-100px) rotate(360deg);
			opacity: 0;
		}
	}

	@keyframes joywp-fadeInUp {
		from {
			opacity: 0;
			transform: translateY(30px) scale(0.95);
		}
		to {
			opacity: 1;
			transform: translateY(0) scale(1);
		}
	}

	@keyframes joywp-fadeInDown {
		from {
			opacity: 0;
			transform: translateY(-20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	@keyframes joywp-fadeIn {
		from {
			opacity: 0;
		}
		to {
			opacity: 1;
		}
	}

	@media (max-width: 700px) {
		.joywp-horizontal-testimonial-card__card-small {
			width: 160px;
			min-height: 160px;
		}

		.joywp-horizontal-testimonial-card__card-medium {
			width: 200px;
			min-height: 180px;
		}

		.joywp-horizontal-testimonial-card__card-large {
			width: 240px;
			min-height: 200px;
		}

		.joywp-horizontal-testimonial-card__text {
			font-size: 0.8rem;
		}

		.joywp-horizontal-testimonial-card__card {
			max-width: calc(100% - 40px);
		}
	}

	@media (max-width: 500px) {
		.joywp-horizontal-testimonial-card__card-small,
		.joywp-horizontal-testimonial-card__card-medium,
		.joywp-horizontal-testimonial-card__card-large {
			width: 100%;
			min-height: 140px;
			margin-bottom: 15px;
		}

		.joywp-horizontal-testimonial-card__grid {
			display: flex;
			flex-direction: column;
		}
	}
</style>

<script>
	(function() {
		'use strict';

		<?php
		$items = $addon->get_collection( 'param-group' )->get_items( $atts );

		$testimonial_list = [];
		foreach ( $items as $item ) :
			$testimonial = [
				'name'  => $item['title'] ?? '',
				'title' => $item['subtitle'] ?? '',
				'text'  => $item['testimonial'] ?? '',
				'size'  => $item['size'] ?? 'small',
				'color' => $item['quot_color'] ?? '',
			];
			if ( 'true' === $item['add_image'] ) {
				$testimonial['avatar'] = $addon->get_collection( 'image' )->get_image_link( $item );
			}
			if ( 'true' === $item['add_border'] ) {
				$testimonial['avatar_border_color'] = $item['border_color'] ?? '';
				$testimonial['avatar_border_width'] = $item['border_width'] ?? 0;
				$testimonial['avatar_border_style'] = $item['border_style'] ?? 'solid';
			}
			$testimonial_list[] = $testimonial;
			?>
			<?php
		endforeach;
		?>
		var testimonials = <?php echo wp_json_encode( $testimonial_list ); ?>;

		var grid = document.getElementById('joywp-testimonialGrid');
		var particlesContainer = document.getElementById('joywp-particles');
		var rotateBtn = document.getElementById('joywp-rotateBtn');

		if (!grid || !particlesContainer || !rotateBtn) return;

		renderTestimonials();
		<?php
		if ( 'true' === $atts['is_animated'] ) {
			?>
			var colors = ['#ff6b6b', '#4ecdc4'];

			for (var i = 0; i < 15; i++) {
				var particle = document.createElement('div');
				particle.className = 'joywp-horizontal-testimonial-card__particle';

				var size = Math.random() * 8 + 3;
				particle.style.width = size + 'px';
				particle.style.height = size + 'px';
				particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
				particle.style.left = Math.random() * 100 + '%';
				particle.style.top = Math.random() * 100 + '%';
				particle.style.animationDelay = Math.random() * 5 + 's';

				particlesContainer.appendChild(particle);
			}
			<?php
		}
		?>

		rotateBtn.addEventListener('click', function() {
			var cards = grid.querySelectorAll('.joywp-horizontal-testimonial-card__card');
			cards.forEach(function(card, index) {
				setTimeout(function() {
					card.style.opacity = '0';
					card.style.transform = 'translateY(30px) scale(0.95)';
				}, index * 50);
			});

			setTimeout(function() {
				grid.innerHTML = '';
				renderTestimonials();
				createParticleBurst();
			}, cards.length * 50 + 300);
		});

		function renderTestimonials() {
			var shuffled = testimonials.slice().sort(function() {
				return Math.random() - 0.5;
			});

			var positions = [
				{ top: '10px', left: '10px' },
				{ top: '10px', left: '220px' },
				{ top: '10px', left: '440px' },
				{ top: '200px', left: '50px' },
				{ top: '200px', left: '300px' },
				{ top: '380px', left: '10px' },
				{ top: '380px', left: '240px' },
				{ top: '380px', left: '440px' }
			];

			shuffled.forEach(function(testimonial, index) {
				var card = document.createElement('div');
				card.className = 'joywp-horizontal-testimonial-card__card joywp-horizontal-testimonial-card__card-' + testimonial.size;
				card.setAttribute('role', 'listitem');
				card.setAttribute('tabindex', '0');
				card.setAttribute('aria-label', 'Testimonial from ' + testimonial.name + ', ' + testimonial.title);

				if (positions[index]) {
					if (window.innerWidth > 500) {
						card.style.position = 'absolute';
						var maxLeft = parseInt(positions[index].left);
						var cardWidth = testimonial.size === 'large' ? 300 : (testimonial.size === 'medium' ? 240 : 200);
						if (window.innerWidth <= 700) {
							cardWidth = testimonial.size === 'large' ? 240 : (testimonial.size === 'medium' ? 200 : 160);
						}
						var containerWidth = grid.offsetWidth;
						if (maxLeft + cardWidth > containerWidth) {
							maxLeft = containerWidth - cardWidth - 10;
						}
						card.style.top = positions[index].top;
						card.style.left = Math.max(10, maxLeft) + 'px';
					}
				}

				card.style.animationDelay = (index * 0.1) + 's';

				var clientInfo = document.createElement('div');
				clientInfo.className = 'joywp-horizontal-testimonial-card__client-info';

				var avatar = document.createElement('div');
				avatar.className = 'joywp-horizontal-testimonial-card__client-avatar';
				avatar.style.backgroundImage = 'url(' + testimonial.avatar + ')';
				avatar.setAttribute('role', 'img');
				avatar.setAttribute('aria-label', 'Photo of ' + testimonial.name);
				avatar.setAttribute('alt', 'Photo of ' + testimonial.name);
				// set style for avatar border color based on quote color
				if (testimonial.avatar_border_color) {
					avatar.style.borderColor = testimonial.avatar_border_color;
					avatar.style.borderWidth = testimonial.avatar_border_width + 'px';
					avatar.style.borderStyle = testimonial.avatar_border_style;
				}

				var clientDetails = document.createElement('div');
				clientDetails.className = 'joywp-horizontal-testimonial-card__client-details';

				var clientName = document.createElement('div');
				clientName.className = 'joywp-horizontal-testimonial-card__client-name';
				clientName.textContent = testimonial.name;

				var clientTitle = document.createElement('div');
				clientTitle.className = 'joywp-horizontal-testimonial-card__client-title';
				clientTitle.textContent = testimonial.title;

				clientDetails.appendChild(clientName);
				clientDetails.appendChild(clientTitle);
				clientInfo.appendChild(avatar);
				clientInfo.appendChild(clientDetails);

				var textDiv = document.createElement('div');
				textDiv.className = 'joywp-horizontal-testimonial-card__text';
				textDiv.textContent = testimonial.text;

				var quote = document.createElement('div');
				quote.className = 'joywp-horizontal-testimonial-card__quote';
				quote.textContent = '"';
				quote.style.color = testimonial.color;
				quote.setAttribute('aria-hidden', 'true');

				card.appendChild(clientInfo);
				card.appendChild(textDiv);
				card.appendChild(quote);

				grid.appendChild(card);
			});
		}

		function createParticleBurst() {
			var colors = ['#ff6b6b', '#4ecdc4', '#ffe66d', '#6a0572', '#1a2a6c'];

			for (var i = 0; i < 20; i++) {
				var particle = document.createElement('div');
				particle.className = 'joywp-horizontal-testimonial-card__particle';

				var size = Math.random() * 10 + 5;
				particle.style.width = size + 'px';
				particle.style.height = size + 'px';
				particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
				particle.style.left = '50%';
				particle.style.top = '50%';
				particle.style.animation = 'none';
				particle.style.opacity = '0.8';

				var angle = Math.random() * Math.PI * 2;
				var distance = 100 + Math.random() * 100;
				var duration = 1 + Math.random() * 2;

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

		document.addEventListener('mousemove', function(e) {
			var cards = document.querySelectorAll('.joywp-horizontal-testimonial-card__card');

			cards.forEach(function(card) {
				var rect = card.getBoundingClientRect();
				var cardCenterX = rect.left + rect.width / 2;
				var cardCenterY = rect.top + rect.height / 2;

				var distanceX = (e.clientX - cardCenterX) / 30;
				var distanceY = (e.clientY - cardCenterY) / 30;

				var maxTilt = 3;
				var tiltX = Math.max(Math.min(distanceY, maxTilt), -maxTilt);
				var tiltY = Math.max(Math.min(-distanceX, maxTilt), -maxTilt);

				var distance = Math.sqrt(Math.pow(distanceX, 2) + Math.pow(distanceY, 2));

				if (distance < 10) {
					card.style.transform = 'rotateX(' + tiltX + 'deg) rotateY(' + tiltY + 'deg) scale(1.05)';
				} else {
					card.style.transform = '';
				}
			});
		});
	})();
</script>
