<!-- TinyMCE -->
<script type="text/javascript" src="scripts/swampy_browser/sb.js"></script>
<script type="text/javascript" src="scripts/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript">
$(function() {
	$('textarea.tinymce').tinymce({
		script_url : 'scripts/tinymce/tiny_mce.js',

		// General options
		mode : "exact",
		editor_selector : "mceEditor",
		elements : "|-$elements-|",
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
		
		file_browser_callback : "openSwampyBrowser"
	});
	
	$.datepicker.setDefaults(jQuery.datepicker.regional['es']);
	$( ".creation" ).datepicker({
		dateFormat:"dd-mm-yy"
	});
});
</script>
<!-- /TinyMCE -->

<div id="div_newsmedia">
	<form name="form_edit_newsmedia" id="form_edit_newsmedia" action="Main.php" enctype="multipart/form-data" method="post">
		|-if $message eq "error"-|<div class="failureMessage">Ha ocurrido un error al intentar guardar el media</div>|-/if-|
		<h3>|-if !$newsMedia->isNew()-|Editar|-else-|Crear|-/if-| Media</h3>
		<p>
			Ingrese los datos del media.
		</p>
		<fieldset title="Formulario de edición de datos de un media">
			<p>
				<label for="newsmedia_articleId">Artículo</label>
				<select id="params_articleId" name="params[articleId]" title="articleId">
				<option value="">Seleccione un Artículo</option>
					|-foreach from=$articleIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $newsMedia->getarticleId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->gettitle()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="newsmedia_name">Nombre</label>
				<input type="text" id="params_name" name="params[name]" value="|-$newsMedia->getname()-|" title="name" maxlength="255" />
			</p>
			<p>
				<label for="newsmedia_title">Título</label>
				<input type="text" id="params_title" name="params[title]" value="|-$newsMedia->gettitle()-|" title="title" maxlength="255" />
			</p>
			<p>
				<label for="newsmedia_description">Descripción</label>
				<textarea id="params_description" name="params[description]" class="tinymce">|-$newsMedia->getdescription()-|</textarea>
			</p>

			<p>
				<label for="newsmedia_creationDate">Fecha de Creación</label>
				<input name="params[creationDate]" type="date" id="params_creationDate" class="creation" title="creationDate" value="|-$newsMedia->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" />
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="newsmedia_status">Tipo de Media</label>
				<select id="params_mediaType" name="params[mediaType]" title="mediaType">
				<option value="">Seleccione un Tipo de Media</option>
					|-foreach from=$types key=key item=name-|
						<option value="|-$key-|" |-if ($newsMedia->getMediatype()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
					|-/foreach-|
				</select>
			</p>
			<div id="divSWFUploadUI" |-if !$configModule->get('news', useSWFUploader)-|style="display:none;"|-/if-|>
			<p>
				<label for="documentType">Tipo de archivo</label>
				<select name="documentType" id="document_type" onChange="javascript:changeTypeFileManager()">
					|-foreach from=$templateTypes key=key item=value-|
						<option value="|-$key-|">|-$key-|</option>
					|-/foreach-|
				</select>
			</p>
				<div>
					<p>
						<label for="txtFileName">Archivo</label>
						<input type="text" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;" />
						<span id="spanButtonPlaceholder"></span> (|-$maxUploadSize-| MB max)
					</p> 
				</div>
				<div class="flash" id="fsUploadProgress">
					<!-- This is where the file progress gets shown.  SWFUpload doesn't update the UI directly.
					The Handlers (in handlers.js) process the upload events and make the UI updates -->
				</div>
			</div>
			
			<div id="divLoadingContent" class="content" style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px; display: none;">
				SWFUpload is loading. Please wait a moment...
			</div>
			<div id="divLongLoading" class="content" style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px; display: none;">
				SWFUpload is taking a long time to load or the load has failed.  Please make sure that the Flash Plugin is enabled and that a working version of the Adobe Flash Player is installed.
			</div>
			
			<div id="divAlternateContent" |-if $configModule->get('news', useSWFUploader)-|style="display:none;"|-/if-|>
				<p>
					<label for="document_file">Archivo</label>
					<input type="file" id="document_file" name="document_file" title="Seleccione el archivo" size="25"/> (|-$maxUploadSize-| MB max)
				</p>
			</div>
			<p>
				|-if !$newsMedia->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$newsMedia->getid()-|" />
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
