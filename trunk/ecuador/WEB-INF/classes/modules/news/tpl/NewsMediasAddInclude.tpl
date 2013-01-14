<div id="mediasAdder">
	<fieldset>
	<legend>Agregar Contenido Multimedia</legend>
	<form id="mediasAdderForm" method="post" enctype="multipart/form-data">
		<p><label for="params[title]">Título</label>
		<input type="text" name="params[title]" value="" size="50" id="params_title"></p>
		<p><label for="params[description]">Descripción</label>
		<textarea name="params[description]" cols="45" rows="3" wrap="virtual" id="params_description"></textarea>
		</p>
		<p><label for="params[mediaType]">Tipo de Contenido</label>
		<select name="params[mediaType]" id="params_mediaType" onChange="javascript:changeTypeFileManager()">
				|-foreach from=$newsMediasTypes key=key item=value-|
					<option value="|-$key-|">|-$value-|</option>
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
		<input type="hidden" name="params[articleId]" value="|-$article->getId()-|" id="params_articleId">
		<input type="submit" name="uploadButton" value="Subir Contenido" id="btnSubmit"> <span id="msgBoxUploader"></span>
	</form> 
	</fieldset>
</div>
