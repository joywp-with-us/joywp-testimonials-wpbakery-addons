(function() {
	'use strict';

	function joywpTestimonialProfileCardSliderProcessSlides( slides ) {
		slides.forEach(slider => {
			const sliderCards = slider.querySelector('.joywp-testimonial-profile-card-slider__cards');
			const wrapper = slider.closest('.joywp-testimonial-profile-card-slider-wrapper');
			const navigationButtons = wrapper
				? wrapper.querySelectorAll('.joywp-testimonial-profile-card-slider__navigation-button')
				: [];

			if (!sliderCards || !navigationButtons.length) {
				return;
			}

			let currentIndex = 0;

			function updateSlide() {
				const sliderWidth = slider.getBoundingClientRect().width;
				const translatedDistance = sliderWidth * currentIndex;
				sliderCards.style.transform = `translateX(-${translatedDistance}px)`;

				navigationButtons.forEach((btn, index) => {
					btn.classList.toggle('active', index === currentIndex);
				});
			}

			navigationButtons.forEach((btn, index) => {
				btn.addEventListener('click', () => {
					currentIndex = index;
					updateSlide();
				});
			});

			window.addEventListener('resize', () => {
				updateSlide();
			});
		});
	}

	window.joywpTestimonialProfileCardSliderProcessSlides = joywpTestimonialProfileCardSliderProcessSlides;
})();
