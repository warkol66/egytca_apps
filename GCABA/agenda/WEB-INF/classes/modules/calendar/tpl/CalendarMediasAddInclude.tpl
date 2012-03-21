<div id="mediasAdder">
	<fieldset>
	<legend>Agregar Imágenes</legend>
	<form id="mediasAdderForm" method="post" enctype="multipart/form-data">
		<p><label>Título</label>
		<input type="text" name="calendarMedia[title]" value="" size="50" id="calendarMedia_title"></p>
		<p><label>Descripción</label>
		<textarea name="calendarMedia[description]" cols="45" rows="3" wrap="virtual" id="calendarMedia_description"></textarea>
		</p>
		<div>
			<div>
				<p>
					<label>Archivo</label>
					<input type="text" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;" />
					<span id="spanButtonPlaceholder"></span> (10 MB max)
				</p> 
			</div>
			<div class="flash" id="fsUploadProgress">
				<!-- This is where the file progress gets shown.  SWFUpload doesn't update the UI directly.
							The Handlers (in handlers.js) process the upload events and make the UI updates -->
			</div>
			<input type="hidden" name="hidFileID" id="hidFileID" value="" />
			<!-- This is where the file ID is stored after SWFUpload uploads the file and gets the ID back from upload.php -->
		</div>		
		
		<input type="hidden" name="calendarMedia[calendarEventId]" value="|-$calendarEvent->getId()-|" id="calendarMedia_calendarEventId">
		<input type="submit" name="uploadButton" value="Subir Contenido" id="btnSubmit"> <span id="msgBoxUploader"></span>
	</form> 
	</fieldset>
</div>