<!-- TinyMCE -->
<script type="text/javascript" src="scripts/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

<div id="div_calendarMedia">
	<form name="form_edit_calendarMedia" id="form_edit_calendarMedia" action="Main.php" method="post">
		|-if $message eq "error"-|<div class="failureMessage">Ha ocurrido un error al intentar guardar la imagen</div>|-/if-|
		<h3>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Imagen</h3>
		<p>
			Ingrese los datos de la Imagen.
		</p>
		<fieldset title="Formulario de edición de datos de una Imagen">
			<p>
				<label for="calendarMedia_EventId">Evento</label>
				<select id="calendarMedia_EventId" name="calendarMedia[calendarEventId]" title="calendarEventId">
				<option value="">Seleccione un Evento</option>
					|-foreach from=$calendarIdValues item=object-|
					<option value="|-$object->getid()-|"|-if $calendarMedia->getCalendarEventId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->gettitle()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="calendarMedia_name">Nombre</label>
				<input type="text" id="calendarMedia_name" name="calendarMedia[name]" value="|-$calendarMedia->getname()-|" title="name" maxlength="255" />
			</p>
			<p>
				<label for="calendarMedia_title">Título</label>
				<input type="text" id="calendarMedia_title" name="calendarMedia[title]" value="|-$calendarMedia->gettitle()-|" title="title" maxlength="255" />
			</p>
			<p>
				<label for="calendarMedia_description">Descripción</label>
				<textarea id="calendarMedia_description" name="calendarMedia[description]">|-$calendarMedia->getdescription()-|</textarea>
			</p>

			<p>
				<label for="calendarMedia_creationDate">Fecha de Creación</label>
				<input name="calendarMedia[creationDate]" type="text" id="calendarMedia_creationDate" title="creationDate" value="|-$calendarMedia->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('calendarMedia[creationDate]', false, 'ymd', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="calendarMedia_status">Estado</label>
				<input type="text" id="calendarMedia_status" name="calendarMedia[status]" value="|-$calendarMedia->getstatus()-|" title="status" />
			</p>
			<p>
				<label for="calendarMedia_userId">Usuario</label>
																				<select id="calendarMedia_userId" name="calendarMedia[userId]" title="userId">
				<option value="">Seleccione un Usuario</option>
					|-foreach from=$userIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $calendarMedia->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="calendarMedia[id]" id="calendarMedia_id" value="|-$calendarMedia->getid()-|" />
				|-/if-|
				<!--pasaje de parametros de filtros -->
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="calendarMediasDoEdit" />
				<input type="submit" id="button_edit_calendarMedia" name="button_edit_calendarMedia" title="Aceptar" value="Aceptar" />
			</p>
		</fieldset>
	</form>
</div>
