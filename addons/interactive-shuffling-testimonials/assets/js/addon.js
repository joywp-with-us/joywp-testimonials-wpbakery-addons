(function() {
	'use strict';

	function joywpInteractiveShufflingTestimonialsGeneratePositions(count) {
		const positions = [];

		const pattern = [
			[10, 220, 440], // row 1
			[50, 300],      // row 2
			[10, 240, 440]  // row 3
		];

		const rowHeight = 190;

		let i = 0;
		let row = 0;

		while (i < count) {
			const cols = pattern[row % pattern.length];

			for (let c = 0; c < cols.length && i < count; c++) {
				positions.push({
					top: (10 + row * rowHeight) + 'px',
					left: cols[c] + 'px'
				});
				i++;
			}

			row++;
		}

		return positions;
	}

	function joywpInteractiveShufflingTestimonialsRenderTestimonials(root, grid, testimonials) {
		const shuffled = testimonials.slice().sort(function() {
			return Math.random() - 0.5;
		});

		const positions = window.joywpInteractiveShufflingTestimonialsGeneratePositions(shuffled.length);

		shuffled.forEach(function(testimonial, index) {
			const card = document.createElement('div');
			card.className = 'joywp-horizontal-testimonial-card__card joywp-horizontal-testimonial-card__card-' + testimonial.size;
			card.setAttribute('role', 'listitem');
			card.setAttribute('aria-label', 'Testimonial from ' + testimonial.name + ', ' + testimonial.title);
			card.setAttribute('data-item-id', testimonial.id);

			if (positions[index]) {
				if (window.innerWidth > 500) {
					card.style.position = 'absolute';
					let maxLeft = parseInt(positions[index].left, 10);
					let cardWidth = testimonial.size === 'large' ? 300 : (testimonial.size === 'medium' ? 240 : 200);
					if (window.innerWidth <= 700) {
						cardWidth = testimonial.size === 'large' ? 240 : (testimonial.size === 'medium' ? 200 : 160);
					}
					const containerWidth = grid.offsetWidth;
					if (maxLeft + cardWidth > containerWidth) {
						maxLeft = containerWidth - cardWidth - 10;
					}
					card.style.top = positions[index].top;
					card.style.left = Math.max(10, maxLeft) + 'px';
				}
			}

			card.style.animationDelay = (index * 0.1) + 's';

			const clientInfo = document.createElement('div');
			clientInfo.className = 'joywp-horizontal-testimonial-card__client-info';

			const avatar = document.createElement('div');
			avatar.className = 'joywp-horizontal-testimonial-card__client-avatar';
			avatar.style.backgroundImage = 'url(' + testimonial.avatar + ')';
			avatar.setAttribute('role', 'img');
			avatar.setAttribute('aria-label', 'Photo of ' + testimonial.name);
			if (testimonial.avatar_border_color) {
				avatar.style.borderColor = testimonial.avatar_border_color;
				avatar.style.borderWidth = testimonial.avatar_border_width + 'px';
				avatar.style.borderStyle = testimonial.avatar_border_style;
			}

			const clientDetails = document.createElement('div');
			clientDetails.className = 'joywp-horizontal-testimonial-card__client-details';

			const clientName = document.createElement('div');
			clientName.className = 'joywp-horizontal-testimonial-card__client-name';
			clientName.textContent = testimonial.name;

			const clientTitle = document.createElement('div');
			clientTitle.className = 'joywp-horizontal-testimonial-card__client-title';
			clientTitle.textContent = testimonial.title;

			clientDetails.appendChild(clientName);
			clientDetails.appendChild(clientTitle);
			clientInfo.appendChild(avatar);
			clientInfo.appendChild(clientDetails);

			const textDiv = document.createElement('div');
			textDiv.className = 'joywp-horizontal-testimonial-card__text';
			textDiv.textContent = testimonial.text;

			card.appendChild(clientInfo);
			card.appendChild(textDiv);
			if (testimonial.quot_color) {
				const quote = document.createElement('div');
				quote.className = 'joywp-horizontal-testimonial-card__quote';
				quote.textContent = '"';
				quote.style.color = testimonial.quot_color;
				quote.setAttribute('aria-hidden', 'true');
				card.appendChild(quote);
			}

			grid.appendChild(card);
		});
	}

	function joywpInteractiveShufflingTestimonialsAttachMousemove(root) {
		document.addEventListener('mousemove', function(e) {
			const cards = root.querySelectorAll('.joywp-horizontal-testimonial-card__card');

			cards.forEach(function(card) {
				const rect = card.getBoundingClientRect();
				const cardCenterX = rect.left + rect.width / 2;
				const cardCenterY = rect.top + rect.height / 2;

				const distanceX = (e.clientX - cardCenterX) / 30;
				const distanceY = (e.clientY - cardCenterY) / 30;

				const maxTilt = 3;
				const tiltX = Math.max(Math.min(distanceY, maxTilt), -maxTilt);
				const tiltY = Math.max(Math.min(-distanceX, maxTilt), -maxTilt);

				const distance = Math.sqrt(Math.pow(distanceX, 2) + Math.pow(distanceY, 2));

				if (distance < 10) {
					card.style.transform = 'rotateX(' + tiltX + 'deg) rotateY(' + tiltY + 'deg) scale(1.05)';
				} else {
					card.style.transform = '';
				}
			});
		});
	}

	window.joywpInteractiveShufflingTestimonialsGeneratePositions = joywpInteractiveShufflingTestimonialsGeneratePositions;
	window.joywpInteractiveShufflingTestimonialsRenderTestimonials = joywpInteractiveShufflingTestimonialsRenderTestimonials;
	window.joywpInteractiveShufflingTestimonialsAttachMousemove = joywpInteractiveShufflingTestimonialsAttachMousemove;
})();
