<h2>Newsletter</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Plantilla Externa</h1>


<!-- TinyMCE -->
<script type="text/javascript" src="scripts/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "newslettertemplateexternal_content",
		theme : "advanced",
		theme : "advanced",
		plugins : "safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking,fullpage",

		language : "es",
		docs_language : "es",
		theme_advanced_buttons4 : "setTemplate",
		button_tile_map : true,
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		apply_source_formatting : false,
		force_p_newlines : false,
		cleanup: false,
		button_tile_map : true,
		theme_advanced_disable : "image,styleselect",
		theme_advanced_buttons3_add : "fullpage",	
		nonbreaking_force_tab : true,
		setup : function(ed) {
				// Add a custom button
				ed.addButton('setTemplate', {
					title : 'Inserta la posicion de la plantilla en la plantilla externa',
					image : 'img/buttons/setTemplateButton.gif',
					onclick : function() {
						// Add you own code to execute something on click
						ed.selection.setContent(' {center} ');
					}
				});
		}

	});
	
</script>
<!-- /TinyMCE -->

				<div id="div_newslettertemplateexternal">
					<form name="form_edit_newslettertemplateexternal" id="form_edit_newslettertemplateexternal" action="Main.php" method="post">
						|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el newsletter external template</span>|-/if-|
						<p>
							Ingrese los datos de la plantilla externa de newsletter.
						</p>
						<fieldset title="Formulario de edición de datos de un newsletter external template">
																																			<p>
								<label for="newslettertemplateexternal_name">Nombre</label>
																																<input type="text" id="newslettertemplateexternal_name" name="newslettertemplateexternal[name]" value="|-$newslettertemplateexternal->getname()-|" title="name" maxlength="255" />
																															</p>
														<p>
								<label for="newslettertemplateexternal_content">Contenido</label>
																								<textarea name="newslettertemplateexternal[content]" cols="80" rows="8" wrap="VIRTUAL" id="newslettertemplateexternal_content">|-$newslettertemplateexternal->getcontent()-|</textarea>
						</p>
														<p>
																|-if $action eq "edit"-|
								<input type="hidden" name="newslettertemplateexternal[id]" id="newslettertemplateexternal_id" value="|-$newslettertemplateexternal->getid()-|" />
								|-/if-|
																<input type="hidden" name="action" id="action" value="|-$action-|" />
								<input type="hidden" name="do" id="do" value="newslettersTemplateExternalsDoEdit" />
								<input type="submit" id="button_edit_newslettertemplateexternal" name="button_edit_newslettertemplateexternal" title="Aceptar" value="Aceptar" />
							</p>
			      </fieldset>
					</form>
				</div>
