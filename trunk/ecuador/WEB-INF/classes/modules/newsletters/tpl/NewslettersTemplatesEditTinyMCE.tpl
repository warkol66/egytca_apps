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
                    image : 'images/setNewsArticleId.png',
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
                    title : 'Inserta las &uacute;ltimas noticias indicadas',
                    image : 'images/setLastNewsArticles.png',
                });

                c.onRenderMenu.add(function(c, m) {
					m.add({title : 'Seleccione la cantidad de &uacute;ltimas noticias a insertar', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
 
					for (var i=1; i < 11; i++) {
							(function (j,m) {
								m.add(
									{
										title : 'Ultimas '+j+' noticias.', 
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
                
            case 'setBlogEntryId':
                var c = cm.createSplitButton('setBlogEntryId', {
                    title : 'Inserta una entrada con un cierto Id',
                    image : 'images/setBlogEntryId.png',
                });

                c.onRenderMenu.add(function(c, m) {
                    m.add({title : 'Seleccione una entrada a insertar', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
						|-foreach from=$entries item=entry name=for_entries-|
                    m.add({title : '|-$entry->getTitle()-|', onclick : function() {
						tinyMCE.activeEditor.selection.setContent(' {setBlogEntryId_|-$entry->getId()-|} ');
                    }});
						|-/foreach-|

                });

                return c;
                
            case 'setLastBlogEntries':
                var c = cm.createSplitButton('setLastBlogEntries', {
                    title : 'Inserta las &uacute;ltimas entradas indicadas',
                    image : 'images/setLastBlogEntries.png',
                });

                c.onRenderMenu.add(function(c, m) {
					m.add({title : 'Seleccione la cantidad de &uacute;ltimas entradas a insertar', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
 
					for (var i=1; i < 11; i++) {
							(function (j,m) {
								m.add(
									{
										title : 'Ultimas '+j+' entradas.', 
										onclick : function() {
											tinyMCE.activeEditor.selection.setContent(' {setLastBlogEntries_'+j+'} ') 
											}
									}
								);
							})(i,m);
					}
               });

                // Return the new splitbutton instance
                return c;
            |-if is_object($challenge)-|
			case 'setChallenge':
                var c = cm.createSplitButton('setChallenge', {
                    title : 'Inserta el desafio vigente',
                    image : 'images/setChallenge.png',
                });

                c.onRenderMenu.add(function(c, m) {
                    m.add({title : 'Seleccione un desafio a insertar', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
						|-foreach from=$challenge item=chall name=for_challenge-|
                    m.add({title : '|-$chall->getTitle()-|', onclick : function() {
						tinyMCE.activeEditor.selection.setContent(' {setChallenge_|-$chall->getId()-|} ');
                    }});
						|-/foreach-|

                });

                return c;
            |-/if-|

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
		theme_advanced_buttons4 : "setUserRegistrationName,setUserRegistrationLastname,setNewsArticleId,setLastNewsArticles,setBlogEntryId,setLastBlogEntries,setChallenge",
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
					image : 'images/setUserRegistrationName.png',
					onclick : function() {
						ed.selection.setContent(' {setUserRegistrationName} ');
					}
				});
				
				// Agregado de Apellido de usuario
				ed.addButton('setUserRegistrationLastname', {
					title : 'Inserta el Apellido del usuario con la que se registro el usuario',
					image : 'images/setUserRegistrationLastname.png',
					onclick : function() {
						ed.selection.setContent(' {setUserRegistrationLastname} ');
					}
				});						
				

		}

	});

</script>

<!-- /TinyMCE -->
