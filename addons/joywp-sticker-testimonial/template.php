<?php
/**
 * The template for displaying joywp_sticker_testimonial addon output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\AbstractAddon $addon
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="joywp-sticker-testimonial" role="figure" aria-label="Testimonial">
	<span class="joywp-sticker-testimonial__quote joywp-sticker-testimonial__quote--open" aria-hidden="true">"</span>
	<div class="joywp-sticker-testimonial__image" aria-hidden="true">
		<div class="joywp-sticker-testimonial__clip"></div>
		<img src="https://placehold.co/100" alt="Testimonial author photo">
	</div>
	<div class="joywp-sticker-testimonial__text">This is some testimonial text for this month's CodePen challenge! This is some testimonial text for this month's CodePen challenge!</div>
	<div class="joywp-sticker-testimonial__source">
		<div class="joywp-sticker-testimonial__source-label">Testimonial Source</div>
	</div>
	<span class="joywp-sticker-testimonial__quote joywp-sticker-testimonial__quote--close" aria-hidden="true">"</span>
</div>
<style>
	.joywp-sticker-testimonial *,
	.joywp-sticker-testimonial *::before,
	.joywp-sticker-testimonial *::after {
		box-sizing: border-box;
		font-family: "Montserrat", sans-serif;
	}

	.joywp-sticker-testimonial {
		width: 500px;
		max-width: 100%;
		background: #ffca52;
		padding: 4em 3em;
		display: flex;
		align-items: flex-end;
		position: relative;
		box-shadow: 0 2px 2px hsl(0deg 0% 0% / 0.075),
			0 3px 3px hsl(0deg 0% 0% / 0.075),
			0 5px 5px hsl(0deg 0% 0% / 0.075),
			0 9px 9px hsl(0deg 0% 0% / 0.075),
			0 17px 17px hsl(0deg 0% 0% / 0.075);
	}

	.joywp-sticker-testimonial::after {
		content: "";
		border: 8px solid navy;
		border-radius: 50px;
		width: 85%;
		height: 120%;
		position: absolute;
		z-index: -1;
		left: 1.5em;
		top: -2em;
	}

	.joywp-sticker-testimonial::before {
		content: "";
		position: absolute;
		bottom: -6.2em;
		left: 5em;
		z-index: 1;
		width: 0;
		height: 0;
		border-style: solid;
		border-width: 70px 100px 0 0;
		border-color: navy transparent transparent transparent;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__quote {
		position: absolute;
		font-size: 3em;
		width: 40px;
		height: 40px;
		background: navy;
		color: #fff;
		text-align: center;
		line-height: 1.25;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__quote--open {
		top: 0;
		left: 0;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__quote--close {
		bottom: 0;
		right: 0;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__text {
		width: 60%;
		display: inline-block;
		font-weight: bold;
		font-size: 1.25em;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__source {
		width: 40%;
		height: 100%;
		position: relative;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__source-label {
		display: inline-block;
		font-weight: bold;
		font-size: 1.15em;
		position: relative;
		margin-left: 1rem;
		text-align: right;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__source-label::before {
		content: "\2014";
		display: inline;
		margin-right: 5px;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__image {
		transform: rotate(-5deg);
		position: absolute;
		top: 0.5em;
		right: 1.5em;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__image img {
		border: 10px solid #fff;
		margin: 0;
		padding: 0;
		display: block;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__clip {
		border: 2px solid #222;
		border-right: none;
		height: 75px;
		width: 20px;
		position: absolute;
		right: 30%;
		top: -15%;
		border-radius: 25px;
		transform: rotate(5deg);
		transform-origin: center top;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__clip::before {
		content: "";
		position: absolute;
		top: -1px;
		right: 0;
		height: 10px;
		width: 16px;
		border: 2px solid #222;
		border-bottom: none;
		border-top-left-radius: 25px;
		border-top-right-radius: 25px;
		z-index: 99;
	}

	.joywp-sticker-testimonial .joywp-sticker-testimonial__clip::after {
		content: "";
		position: absolute;
		bottom: -1px;
		right: 0;
		height: 40px;
		width: 16px;
		border: 2px solid #222;
		border-top: none;
		border-bottom-left-radius: 25px;
		border-bottom-right-radius: 25px;
		z-index: 99;
	}
</style>
