<?php
/**
 * The template for displaying plugin deactivation feedback popup.
 *
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div id="joywp-deactivation-popup">
	<div class="joywp-deactivation-popup-overlay"></div>
	<div class="joywp-deactivation-popup-content">
		<div class="joywp-deactivation-popup-header">
			<h2><?php esc_html_e( 'Quick Feedback', 'joywp-testimonials-wpbakery-addons' ); ?></h2>
		</div>
		<div class="joywp-deactivation-popup-body">
			<p><?php esc_html_e( 'If you have a moment, please let us know why you are deactivating this plugin.', 'joywp-testimonials-wpbakery-addons' ); ?></p>
			<form id="joywp-deactivation-form">
				<?php
				wp_nonce_field( '_joywp_deactivate_feedback_action' );
				?>
				<div class="joywp-form-group">
					<label>
						<input type="radio" name="reason_key" value="temporary_deactivation" checked>
						<?php esc_html_e( 'It\'s a temporary deactivation.', 'joywp-testimonials-wpbakery-addons' ); ?>
					</label>
				</div>
				<div class="joywp-form-group">
					<label>
						<input type="radio" name="reason_key" value="plugin_missing_addon">
						<?php esc_html_e( 'The plugin is missing a specific WPBakery addon.', 'joywp-testimonials-wpbakery-addons' ); ?>
					</label>
					<textarea name="plugin_missing_addon_details" placeholder="<?php esc_html_e( 'Please describe the missing addon.', 'joywp-testimonials-wpbakery-addons' ); ?>"></textarea>
				</div>
				<div class="joywp-form-group">
					<label>
						<input type="radio" name="reason_key" value="plugin_not_working_as_expected">
						<?php esc_html_e( "The plugin didn't work as expected.", 'joywp-testimonials-wpbakery-addons' ); ?>
					</label>
					<textarea name="plugin_not_working_as_expected_details" placeholder="<?php esc_html_e( 'What did you expected.', 'joywp-testimonials-wpbakery-addons' ); ?>"></textarea>
				</div>
				<div class="joywp-form-group">
					<label>
						<input type="radio" name="reason_key" value="plugin_missing_feature">
						<?php esc_html_e( 'The plugin is missing a specific feature.', 'joywp-testimonials-wpbakery-addons' ); ?>
					</label>
					<textarea name="plugin_missing_feature_details" placeholder="<?php esc_html_e( 'What feature?', 'joywp-testimonials-wpbakery-addons' ); ?>"></textarea>
				</div>
				<div class="joywp-form-group">
					<label>
						<input type="radio" name="reason_key" value="plugin_not_working">
						<?php esc_html_e( 'The plugin is not working.', 'joywp-testimonials-wpbakery-addons' ); ?>
					</label>
					<textarea name="plugin_not_working_details" placeholder="<?php esc_html_e( "Kindly share what didn't work so we can fix it for future users", 'joywp-testimonials-wpbakery-addons' ); ?>"></textarea>
				</div>
				<div class="joywp-form-group">
					<label>
						<input type="radio" name="reason_key" value="other">
						<?php esc_html_e( 'Other', 'joywp-testimonials-wpbakery-addons' ); ?>
					</label>
					<textarea name="other_details" placeholder="<?php esc_html_e( 'Please specify', 'joywp-testimonials-wpbakery-addons' ); ?>"></textarea>
				</div>
			</form>
		</div>
		<div class="joywp-deactivation-popup-footer">
			<button type="button" class="button button-primary joywp-deactivation-submit"><?php esc_html_e( 'Submit & Deactivate', 'joywp-testimonials-wpbakery-addons' ); ?></button>
			<div class="joywp-button-delimiter"></div>
			<button type="button" class="button button-secondary joywp-deactivation-skip"><?php esc_html_e( 'Skip & Deactivate', 'joywp-testimonials-wpbakery-addons' ); ?></button>
		</div>
	</div>
</div>
