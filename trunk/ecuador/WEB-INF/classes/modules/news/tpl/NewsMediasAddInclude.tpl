<div id="mediasAdder">
	<fieldset>
	<legend>Agregar Contenido Multimedia</legend>
	<form id="mediasAdderForm" method="post" enctype="multipart/form-data">
		<p><label for="newsmedia[title]">Título</label>
		<input type="text" name="newsmedia[title]" value="" size="50" id="newsmedia_title"></p>
		<p><label for="newsmedia[description]">Descripción</label>
		<textarea name="newsmedia[description]" cols="45" rows="3" wrap="virtual" id="newsmedia_description"></textarea>
		</p>
		<p><label for="newsmedia[mediaType]">Tipo de Contenido</label>
		<select name="newsmedia[mediaType]" id="newsmedia_mediaType" onChange="javascript:changeTypeFileManager()">
				|-foreach from=$newsMediasTypes key=key item=value-|
					<option value="|-$key-|">|-$value-|</option>
				|-/foreach-|
			</select>
		</p>
		<div>
			<div>
				<p>
					<label>Archivo</label>
					<input type="text" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;" />
					<span id="spanButtonPlaceholder"></span> (15 MB max)
				</p> 
			</div>
			<div class="flash" id="fsUploadProgress">
				<!-- This is where the file progress gets shown.  SWFUpload doesn't update the UI directly.
							The Handlers (in handlers.js) process the upload events and make the UI updates -->
			</div>
			<input type="hidden" name="hidFileID" id="hidFileID" value="" />
			<!-- This is where the file ID is stored after SWFUpload uploads the file and gets the ID back from upload.php -->
		</div>

		<input type="hidden" name="newsmedia[articleId]" value="|-$article->getId()-|" id="newsmedia_articleId">
		<input type="submit" name="uploadButton" value="Subir Contenido" id="btnSubmit"> <span id="msgBoxUploader"></span>
	</form> 
	</fieldset>
</div>