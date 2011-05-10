<!-- TinyMCE -->
<script type="text/javascript" src="scripts/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="scripts/swampy_browser/sb.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		editor_selector : "mceEditor",
		elements : "|-$element-|",
		theme : "advanced",
		plugins : "|-$plugins-|",
		|-if ($plugins|stristr:"table") ne FALSE-|theme_advanced_buttons3_add : "table",|-/if-|

		language : "es",
		docs_language : "es",

		button_tile_map : true,
		theme_advanced_toolbar_location : "external",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		apply_source_formatting : true,
		button_tile_map : true,
		content_css : "css/stylePublicEditor.css",
		nonbreaking_force_tab : true,
		extended_valid_elements : "td[colspan|rowspan|width|height|align|valign|bgcolor|background|bordercolor|scope|nowrap],textarea[cols|rows|disabled|name|readonly|wrap]",
		file_browser_callback : "openSwampyBrowser"


	});
</script>
<!-- /TinyMCE -->
