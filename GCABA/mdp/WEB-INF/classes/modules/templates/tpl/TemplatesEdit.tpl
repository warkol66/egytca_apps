<h2>Plantillas</h2>
<h1>|-if !$template->isNew()-|Editar|-else-|Agregar|-/if-| plantillas de reportes</h1>
<p>|-if $template neq ''-|
Ingrese los datos de la plantilla a editar y haga click en "Editar Plantilla".<br>
Puede cambiar los datos que se muestran a contimnuación, si desea modificar el archivo, busque el archivo correspondiente en el campo Archivo y 
súbalo nuevamente.
|-else-|
Ingrese los datos de la plantilla y haga click en "Agregar Plantilla".
|-/if-|
</p>
|-if isset($label)-||-else-||-assign var=label value="documentos"-||-/if-|<div id="documentAdder">
<div id="documentOperationInfo"></div>

<form method="post" action="Main.php?do=documentsDoEdit" enctype="multipart/form-data" name="formSearch" id="documentsAdderForm">
	|-if $template neq ''-|
	<input type="hidden" name="id" value="|-$template->getId()-|">
	|-/if-|
	<fieldset title="Formulario para Agregar Nuevo |-$label-|">
		|-if $template neq ''-|
		<legend>Editar Plantilla</legend>
			<p>Ingrese los datos correspondientes a la plantilla. Seleccione un nuevo archivo si desea reemplazar el actual (<em><strong>"|-$template->getRealFilename()-|"</strong></em>)</p>	
		|-elseif $module eq "Documents" && $entity eq ''-|
		<legend>Formulario de Plantillas</legend>
			<p>Ingrese los datos correspondientes a la plantilla</p>	
		|-else-|
		<legend>Anexar |-$label-|</legend>
			<p>Ingrese los datos correspondientes al |-$label-| que desea anexar.</p>		
		|-/if-|
			<div id="divSWFUploadUI" |-if !$configModule->get('documents', useSWFUploader)-|style="display:none;"|-/if-|>
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
			
			<div id="divAlternateContent" |-if $configModule->get('documents', useSWFUploader)-|style="display:none;"|-/if-|>
				<p>
					<label for="document_file">Archivo</label>
					<input type="file" id="document_file" name="document_file" title="Seleccione el archivo" size="45"/> (|-$maxUploadSize-| MB max)
				</p>
			</div>
			
			<p><label for="date">Fecha</label>
				 <input name="params[date]" type="text" value="|-if !$template->isNew()-||-$template->getDate()|date_format:'%d-%m-%Y'-||-else-||-$smarty.now|date_format:'%d-%m-%Y'-||-/if-|" size="10" title="Fecha del documento (Formato: dd-mm-yyyy)"/>
      <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="name">Nombre</label>
				<textarea name="params[name]" cols="55" rows="2" wrap="virtual" title="Nombre">|-$template->getName()|escape-|</textarea>
			</p>
			<p>
				<label for="description">Descripción</label>
			 	<textarea name="params[description]" cols="55" rows="6" wrap="VIRTUAL" title="Descripción">|-$template->getDescription()|escape-|</textarea>
		</p> 
			 <div id="upload_info"></div>
				<input type="submit" name="uploadButton" value="|-if !$template->isNew()-|Guardar Cambios|-else-|Guardar|-/if-|" id="btnSubmit">
				<input name="return" type="button" value="Regresar" onClick="history.back(-1);"/><span id="msgBoxUploader"></span>
			 </p>
	</fieldset>
</form>
</div>
 