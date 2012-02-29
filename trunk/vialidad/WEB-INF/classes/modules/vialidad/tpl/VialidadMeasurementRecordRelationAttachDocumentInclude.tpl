<div id="lightbox|-$id-|" class="leightbox">
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p>
	
	<form method="post" action="Main.php?do=vialidadMeasurementRecordRelationsDoAddDocument" enctype="multipart/form-data" id="documentsAdderForm|-$id-|">
	<input type="hidden" name="id" value="|-$id-|" />
	<fieldset title="Formulario para agregar nuevo Documento">
		<legend>Anexar Documento</legend>
		<p>Ingrese los datos correspondientes al Documento que desea anexar.</p>
		<p>
			<label for="document_file">Archivo</label>
			<input type="file" id="document_file|-$id-|" name="document_file" title="Seleccione el archivo" size="45"/>
		</p>
		<p>
			<label for="date">Fecha</label>
			<input name="date" type="text" value="|-$smarty.now|date_format:'%d-%m-%Y'-|" size="10" title="Fecha del documento (Formato: dd-mm-yyyy)"/>
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p>
		<p>
			<label for="title">Título</label>
			<textarea name="title" cols="55" rows="2" wrap="virtual" title="Título"></textarea>
		</p>
		<p>
			<label for="description">Descripción</label>
			<textarea name="description" cols="55" rows="6" wrap="VIRTUAL" title="Descripción"></textarea>
		</p>
		<div id="upload_info|-$id-|"></div>
		<p>
			<input type="submit" name="uploadButton" value="Agregar Documento" ><span id="msgBoxUploader|-$id-|"></span>
		</p>
	</fieldset>
	</form>
</div>