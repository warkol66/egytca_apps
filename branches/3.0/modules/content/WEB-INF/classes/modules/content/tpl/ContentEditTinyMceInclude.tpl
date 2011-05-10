<!-- TinyMCE -->
<script type="text/javascript" src="scripts/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="scripts/swampy_browser/sb.js"></script>
<script type="text/javascript">

// Creates a new plugin class and a custom listbox
tinymce.create('tinymce.plugins.FormInsertionPlugin', {
    createControl: function(n, cm) {
        switch (n) {

            case 'setFormId':
                var c = cm.createSplitButton('setFormId', {
                    title : 'Agrega un cierto formulario al contenido',
                    image : 'images/buttons/setFormId.gif',
                });

                c.onRenderMenu.add(function(c, m) {
                    m.add({title : 'Seleccione un formulario a insertar', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
						|-foreach from=$forms item=form name=for_form-|
                    m.add({title : '|-$form->getName()-|', onclick : function() {
						tinyMCE.activeEditor.selection.setContent(' {setFormId_|-$form->getId()-|} ');
                    }});
						|-/foreach-|

                });

                return c;
        }

        return null;
    }
});

// Register plugin with a short name
tinymce.PluginManager.add('formInsertionPlugin', tinymce.plugins.FormInsertionPlugin);


	tinyMCE.init({
		// General options
		mode : "exact",
		editor_selector : "mceEditor",
		elements : 	"|-foreach from=$languages item=langItem name=for_lang-|content[|-$langItem.languageCode-|][|-$element-|]|-if not $smarty.foreach.for_lang.last-|, |-/if-||-/foreach-|",
		theme : "advanced",
		plugins : "-formInsertionPlugin,|-$plugins-|",
		|-if ($plugins|stristr:"table") ne FALSE-|theme_advanced_buttons3_add : "table",|-/if-|
		theme_advanced_buttons4: 'setFormId',

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
		
		file_browser_callback : "openSwampyBrowser"


	});
</script>
<!-- /TinyMCE -->
