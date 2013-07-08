<!-- TinyMCE -->
<script type="text/javascript" src="scripts/tinymce/tiny_mce.js"></script>
<script type="text/javascript">

// Creates a new plugin class and a custom listbox
tinymce.create('tinymce.plugins.InfocivicaNewsletterTemplatePlugin', {
    createControl: function(n, cm) {
        switch (n) {

            case 'setNewsArticleId':
                var c = cm.createSplitButton('setNewsArticleId', {
                    title : 'Inserta una noticia con un cierto Id',
                    image : 'images/setNewsArticleId.gif',
                });

                c.onRenderMenu.add(function(c, m) {
                    m.add({title : 'Seleccione una noticia a insertar', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
						|-foreach from=$articles item=article name=for_articles-|
                    m.add({title : '|-$article->getTitle()-|', onclick : function() {
						tinyMCE.activeEditor.selection.setContent(' {setNewsArticleId_|-$article->getId()-|} ');
                    }});
						|-/foreach-|

                });

                return c;

            case 'setLastNewsArticles':
                var c = cm.createSplitButton('setLastNewsArticles', {
                    title : 'Inserta las ultima noticias indicadas',
                    image : 'images/setNewsArticleId.gif',
                });

                c.onRenderMenu.add(function(c, m) {
					m.add({title : 'Seleccione la cantidad de ultimas noticias a insertar', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
 
					for (var i=1; i < 11; i++) {
							(function (j,m) {
								m.add(
									{
										title : 'Ultimas '+j+' Noticias.', 
										onclick : function() {
											tinyMCE.activeEditor.selection.setContent(' {setLastNewsArticles_'+j+'} ') 
											}
									}
								);
							})(i,m);
					}
               });

                // Return the new splitbutton instance
                return c;

        }

        return null;
    }
});

// Register plugin with a short name
tinymce.PluginManager.add('newsletterTemplate', tinymce.plugins.InfocivicaNewsletterTemplatePlugin);

	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "-newsletterTemplate,safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking",
		language : "es",
		docs_language : "es",
		theme_advanced_buttons4 : "setUserRegistrationDate,setUserRegistrationIP,setUserRegistrationName,setUserRegistrationLastname,setNewsArticleId,setLastNewsArticles",
		button_tile_map : true,
		theme_advanced_toolbar_location : "external",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		apply_source_formatting : true,
		button_tile_map : true,
		theme_advanced_disable : "image,styleselect",	
		nonbreaking_force_tab : true,
		setup : function(ed) {
				// Agregado de fecha de registro de usuario
				ed.addButton('setUserRegistrationDate', {
					title : 'Inserta la fecha de registracion del usuario al que se le enviara el template',
					image : 'images/setUserRegistrationDate.gif',
					onclick : function() {
						ed.selection.setContent(' {userRegistrationDate} ');
					}
				});
				
				// Agregado de IP de registro de usuario
				ed.addButton('setUserRegistrationIP', {
					title : 'Inserta la ip con la que se registro el usuario',
					image : 'images/setUserRegistrationIP.gif',
					onclick : function() {
						ed.selection.setContent(' {userRegistrationIP} ');
					}
				});				
				
				// Agregado de Nombre de usuario
				ed.addButton('setUserRegistrationName', {
					title : 'Inserta el nombre del usuario con la que se registro el usuario',
					image : 'images/setUserRegistrationName.gif',
					onclick : function() {
						ed.selection.setContent(' {setUserRegistrationName} ');
					}
				});
				
				// Agregado de Apellido de usuario
				ed.addButton('setUserRegistrationLastname', {
					title : 'Inserta el Apellido del usuario con la que se registro el usuario',
					image : 'images/setUserRegistrationLastname.gif',
					onclick : function() {
						ed.selection.setContent(' {setUserRegistrationLastname} ');
					}
				});						
				

		}

	});

</script>

<!-- /TinyMCE -->