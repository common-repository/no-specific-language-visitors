<?php
function no_specific_language_visitors_register_settings() {
	add_option('no_specific_language_visitors_lang', '');
	add_option('no_specific_language_visitors_notice', '');
	register_setting('no_specific_language_visitors_options', 'no_specific_language_visitors_lang');
	register_setting('no_specific_language_visitors_options', 'no_specific_language_visitors_notice');
}
add_action('admin_init', 'no_specific_language_visitors_register_settings');

function no_specific_language_visitors_register_options_page() {
	add_options_page(__('No Specific Language Visitors Options Page', NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN), __('No Specific Language Visitors', NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN), 'manage_options', NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN.'-options', 'no_specific_language_visitors_options_page');
}
add_action('admin_menu', 'no_specific_language_visitors_register_options_page');

function no_specific_language_visitors_options_page() {
?>
<div class="wrap">
	<h2><?php _e("No Specific Language Visitors Options Page", NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN); ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields('no_specific_language_visitors_options'); ?>
		<h3><?php _e("General Options", NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN); ?></h3>
			<p><?php printf(__('NOTE: You can find all language code %shere%s', LAST_POST_REDIRECT_TEXT_DOMAIN), '<a href="http://www.metamodpro.com/browser-language-codes" target="_blank">', '</a>'); ?></p>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="no_specific_language_visitors_lang"><?php _e("The language you want to disallow: ", LAST_POST_REDIRECT_TEXT_DOMAIN); ?></label></th>
					<td>
						<input type="text" name="no_specific_language_visitors_lang" id="no_specific_language_visitors_lang" value="<?php echo get_option('no_specific_language_visitors_lang'); ?>" />
						<?php printf(__("Use %s to explode each language.", NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN), "<code>|</code>"); ?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="no_specific_language_visitors_notice"><?php _e("Notice For Chinese Simplified Visitor: ", NO_SPECIFIC_LANGUAGE_VISITORS_TEXT_DOMAIN); ?></label></th>
					<td>
						<?php wp_editor(get_option("no_specific_language_visitors_notice"), "no_specific_language_visitors_notice", array('textarea_rows' => 5)); ?>
					</td>
				</tr>
			</table>
		<?php submit_button(); ?>
	</form>
</div>
<?php
}
?>