<div id="documentAdder">
<div id="documentOperationInfo">
|-if $message eq "wrongPasswordComparison"-|
	<div class="failureMessage">Error: Las contraseñas ingresadas no concuerdan</div>
|-elseif $message eq "wrongPassword"-|
	<div class="failureMessage">Error: Se ha ingresado incorectamente la contraseña actual</div>
|-elseif $msg eq "wrongPasswordComparison"-|
	<div class="failureMessage">Error: Las contraseñas ingresadas no concuerdan</div>
	|-elseif $msg eq "wrongCategory"-|
	<div class="failureMessage">Error: Debe seleccionar un tipo de documento</div>
|-/if-|
</div>

<form method="post" action="Main.php?do=documentsDoEdit" enctype="multipart/form-data" name="formSearch" id="documentsAdderForm">
	|-if $document neq ''-|
	<input type="hidden" name="id" value="|-$document->getId()-|">
	|-/if-|
	<fieldset title="Formulario para Agregar Nuevo Documento">
		|-if $document neq ''-|
		<legend>Editar Documento</legend>
			<p>Ingrese los datos correspondientes al documento. Seleccione un nuevo documento si desea reemplazar el documento actual ("|-$document->getRealFilename()-|")</p>	
		|-elseif $module eq "Documents" && $entity eq ''-|
		<legend>Formulario de Documentos</legend>
			<p>Ingrese los datos correspondientes al documento</p>	
		|-else-|
		<legend>Anexar Documentos</legend>
			<p>Ingrese los datos correspondientes al documento que desea anexar.</p>		
		|-/if-|
			<div id="divSWFUploadUI" |-if !$configModule->get('documents', useSWFUploader)-|style="display:none;"|-/if-|>
			<p>
				<label for="documentType">Tipo de Contenido</label>
				<select name="documentType" id="document_type" onChange="javascript:changeTypeFileManager()">
					|-foreach from=$documentTypes key=key item=value-|
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
				 <input name="date" type="text" value="|-if $document neq ''-||-$document->getDocumentDate()|date_format:'%d-%m-%Y'-||-else-||-$smarty.now|date_format:'%d-%m-%Y'-||-/if-|" size="10" title="Fecha del documento (Formato: dd-mm-yyyy)"/>
      <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="title">Título</label>
				<textarea name="title" cols="55" rows="3" wrap="virtual" title="Título">|-if $document neq ''-||-$document->getTitle()|escape-||-/if-|</textarea>
			</p>
			<p>
				<label for="description">Descripción</label>
			 	<textarea name="description" cols="55" rows="6" wrap="VIRTUAL" title="Descripción">|-if $document neq ''-||-$document->getDescription()|escape-||-/if-|</textarea>
  			</p> 
  			|-if $module eq "Documents" && $entity eq ''-|
				<p><label for="category">Categoría</label>
					<select name="category">
						<option value=''>Sin Categoría</option>
					|-include file="DocumentsCategoriesInclude.tpl" categories=$parentCategories user=$user selectedCategoryId=$filters.categoryId count='0'-|
						</select>
				</p>
				<p><label for="extra[author]">Autor(es)</label>
					 <input name="extra[author]" type="text" value="|-if $document neq ''-||-$document->getAuthor()|escape-||-/if-|" size="50" />
				</p>
				<p><label for="extra[keyWords]">Palabras clave<img src="images/icon_search.png" onClick="switch_vis('keyWordSearch','block');" title="Buscar palabaras clave"/></label>
					 <input name="extra[keyWords]" id="keyWords" type="text" value="|-if $document neq ''-||-$document->getKeyWords()|escape-||-/if-|" size="50" />
				<script language="JavaScript" type="text/javascript">
				function sendText(element, text, sep) {
					if (element.value != '')
						element.value += sep + text;
					else
						element.value = text;					
				}
				</script>
				|-include_module module=Documents action=KeyWordList-|</p>
				<p><label for="extra[number]">Número</label>
					 <input name="extra[number]" type="text" value="|-if $document neq ''-||-$document->getNumber()|escape-||-/if-|" size="10" />
				</p>
			|-/if-|
|-if $document neq '' && $document->getPassword() neq ''-|
			<p><label for="old_password">Contraseña actual</label>
			 	<input name="old_password" type="password" size="15" />
			</p>
|-/if-|
|-if ($configModule->get("documents","usePasswords"))-|
			<p><label for="password">Contraseña nueva</label>
			  <input name="password" type="password" size="15" />
			</p>
			<p><label for="password_compare">Repita contraseña</label>
			  <input name="password_compare" type="password" size="15" />
	</p>
|-/if-|
			 <div id="upload_info"></div>
			 <p> 
			 	|-if $entity neq ""-|
				 	<input type="hidden" name="entity" value="|-$entity-|" />
				 	<input type="hidden" name="entityId" value="|-$entityId-|" />
			 	|-/if-|
				<input type="submit" name="uploadButton" value="|-if $document neq ''-|Guardar Cambios|-else-|Agregar Documento|-/if-|" id="btnSubmit">|-if $module eq 'Documents' && $action eq 'edit'-|<input name="return" type="button" value="Regresar" onClick="history.back(-1);"/>|-/if-|<span id="msgBoxUploader"></span>
			 </p>
	</fieldset>
</form>
</div>