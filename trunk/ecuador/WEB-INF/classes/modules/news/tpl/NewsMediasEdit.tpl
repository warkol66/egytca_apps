<!-- TinyMCE -->
<script type="text/javascript" src="scripts/tinymce/tiny_mce.js"></script>
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

<div id="div_newsmedia">
	<form name="form_edit_newsmedia" id="form_edit_newsmedia" action="Main.php" method="post">
		|-if $message eq "error"-|<div class="failureMessage">Ha ocurrido un error al intentar guardar el media</div>|-/if-|
		<h3>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Media</h3>
		<p>
			Ingrese los datos del media.
		</p>
		<fieldset title="Formulario de edición de datos de un media">
			<p>
				<label for="newsmedia_articleId">Artículo</label>
				<select id="newsmedia_articleId" name="newsmedia[articleId]" title="articleId">
				<option value="">Seleccione un NewsArticle</option>
					|-foreach from=$articleIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $newsmedia->getarticleId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->gettitle()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="newsmedia_name">Nombre</label>
				<input type="text" id="newsmedia_name" name="newsmedia[name]" value="|-$newsmedia->getname()-|" title="name" maxlength="255" />
			</p>
			<p>
				<label for="newsmedia_title">Título</label>
				<input type="text" id="newsmedia_title" name="newsmedia[title]" value="|-$newsmedia->gettitle()-|" title="title" maxlength="255" />
			</p>
			<p>
				<label for="newsmedia_description">Descripción</label>
				<textarea id="newsmedia_description" name="newsmedia[description]">|-$newsmedia->getdescription()-|</textarea>
			</p>

			<p>
				<label for="newsmedia_creationDate">Fecha de Creación</label>
				<input name="newsmedia[creationDate]" type="text" id="newsmedia_creationDate" title="creationDate" value="|-$newsmedia->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('newsmedia[creationDate]', false, 'ymd', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="newsmedia_status">Estado</label>
				<input type="text" id="newsmedia_status" name="newsmedia[status]" value="|-$newsmedia->getstatus()-|" title="status" />
			</p>
			<p>
				<label for="newsmedia_userId">Usuario</label>
																				<select id="newsmedia_userId" name="newsmedia[userId]" title="userId">
				<option value="">Seleccione un Usuario</option>
					|-foreach from=$userIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $newsmedia->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="newsmedia[id]" id="newsmedia_id" value="|-$newsmedia->getid()-|" />
				|-/if-|
				<!--pasaje de parametros de filtros -->
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="newsMediasDoEdit" />
				<input type="submit" id="button_edit_newsmedia" name="button_edit_newsmedia" title="Aceptar" value="Aceptar" />
			</p>
		</fieldset>
	</form>
</div>
