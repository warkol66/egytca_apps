|-include file='FormsEditTinyMceInclude.tpl' element=processedform[processedContent] plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
<h2>Formularios</h2>
<h1>Respuestas de Formularios</h1>
<div id="div_processedform">
	<form name="form_edit_processedform" id="form_edit_processedform" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el processedform</div>
		|-/if-|
		<h3>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Respuesta</h3>
		<p> Ingrese los datos de la Respuesta</p>
		<fieldset title="Formulario de edición de datos de una Respuesta">
		<p>
			<label for="processedform_formId">formId</label>
			<input type="text" id="processedform_formId" name="processedform[formId]" value="|-$processedform->getformId()-|" title="formId" />
		</p>
		<p>
			<label for="processedform_formFillingDate">Fecha</label>
			<input name="processedform[formFillingDate]" type="text" id="processedform_formFillingDate" title="formFillingDate" value="|-$processedform->getformFillingDate()|date_format:"%d-%m-%Y"-|" size="12" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('processedform[formFillingDate]', false, 'ymd', '-');" title="Seleccione la fecha"> </p>
		<p>
			<label for="processedform_ip">ip</label>
			<input type="text" id="processedform_ip" name="processedform[ip]" value="|-$processedform->getip()-|" title="ip" maxlength="255" />
		</p>
		<p>
			<label for="processedform_processedContent">Respuesta</label>
			<textarea id="processedform_processedContent" name="processedform[processedContent]">|-$processedform->getprocessedContent()|htmlentities-|</textarea>
		</p>
		<p> |-if $action eq "edit"-|
			<input type="hidden" name="processedform[id]" id="processedform_id" value="|-$processedform->getid()-|" />
			|-/if-|
			<input type="hidden" name="action" id="action" value="|-$action-|" />
			<input type="hidden" name="do" id="do" value="formsProcessedFormsDoEdit" />
			<input type="submit" id="button_edit_processedform" name="button_edit_processedform" title="Aceptar" value="Aceptar" />
		</p>
		</fieldset>
	</form>
</div>
