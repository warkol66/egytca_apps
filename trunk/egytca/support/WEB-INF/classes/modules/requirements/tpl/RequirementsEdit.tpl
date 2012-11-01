<h2>Desarrollo</h2> 
|-if !$notValidId || is_object($requirement)-|
<h1>Administración de Requerimientos - |-if !$requirement->isNew()-|Editar|-else-|Crear|-/if-| Requerimientos</h1>
<script language="JavaScript" type="text/javascript">
function requirementsDoAddAttendant(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'asocAttendantsList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('attendantsMsgField').innerHTML = '<span class="inProgress">agregando recurso...</span>';
	return true;
}
function requirementsDoDeleteAttendant(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'attendantsMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('attendantsMsgField').innerHTML = '<span class="inProgress">desasociando recurso...</span>';
	return true;
}
</script>
<p class='paragraphEdit'>A continuación se puede modificar los datos que definen el Requerimiento.</p>
<div id="div_requirement"> 
  |-if $message eq "ok"-|
	<div class="successMessage">Requerimiento guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Requerimiento</div>
|-/if-|
|-include file="CommonAutocompleterInclude.tpl"-|
|-$algo-|
	<form name="form_edit_requirement" id="form_edit_requirement" action="Main.php" method="post">
		
		<fieldset title="Formulario de datos de Requerimiento">
		 <legend>Requerimiento</legend>
				<p>Instrucciones: Compete un formulario por cada tipo de tarea que quiera que realice el sistema</p>
			<label for="params_name">Requerimiento</label>
		  <input name="params[name]" type="text" id="params_name" size="80" value="|-$requirement->getName()-|" title="Nombre del Requerimiento" maxlength="255" class="emptyValidation"  |-$readonly|readonly-|/> |-validation_msg_box idField="params_name"-|
		  </p>
		<p> 
		  <label for="params_description">Que es lo que espera que genere el sistema? (Especificar que acciones espera realizar y que resultado espera obtener)</label>
		  <textarea name="params[description]" cols="74" rows="8" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Requerimiento" |-$readonly|readonly-|>|-$requirement->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
		</p> 
		<p> 
		  <label for="params_input">¿Qué información se ingresa? (en caso se ser una carga de datos, incluir los campos, que variables utiliza, opciones a elegir, campos obligatorios, etc.)</label>
		  <textarea name="params[input]" cols="74" rows="8" wrap="VIRTUAL" id="params_input" type="text" title="Descripción del Requerimiento" |-$readonly|readonly-|>|-$requirement->getInput()|escape-|</textarea> |-validation_msg_box idField="params_input"-|
		</p> 
		 <p> 
		  <label for="params_output">¿Qué información obtiene? (explicar brevemente que visualiza como resultado de la consulta o del ingreso de información)</label>
		  <textarea name="params[output]" cols="74" rows="8" wrap="VIRTUAL" id="params_output" type="text" title="Descripción del Requerimiento" |-$readonly|readonly-|>|-$requirement->getOutput()|escape-|</textarea> |-validation_msg_box idField="params_output"-|
		</p> 
		<p> 
		  <label for="params_process">Defina el proceso de la la información: (Explique brevemente como es el ciclo de vida de un registro, que puede ocurrir, que cambios de estado y quienes estarían autorizados a cambiarlo)</label>
		  <textarea name="params[process]" cols="74" rows="8" wrap="VIRTUAL" id="params_process" type="text" title="Descripción del Requerimiento" |-$readonly|readonly-|>|-$requirement->getProcess()|escape-|</textarea> |-validation_msg_box idField="params_process"-|
		</p> 
		<p> 
		  <label for="params_other">Otras informaciones importantes: (Agregue a continuación otra información que considere importante para el proceso.)</label>
		  <textarea name="params[other]" cols="74" rows="8" wrap="VIRTUAL" id="params_other" type="text" title="Descripción del Requerimiento" |-$readonly|readonly-|>|-$requirement->getOther()|escape-|</textarea> |-validation_msg_box idField="params_other"-|
		</p> 
		
		<p>Seleccione un desarrollo para asociar</p>
		<p>
			<select name='params[developmentId]'>
				<option value="">Seleccione un desarrollo</option>
				|-foreach from=$developments item=development name=for_development-|
				<option value="|-$development->getId()-|" |-if $development->getId() eq $requirement->getDevelopmentid()-| selected="selected"|-/if-|>|-$development->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		|-assign var="dev" value=$requirement->getDevelopment()-|
		|-if empty($dev)-|
		<p>Seleccione un cliente</p>
		<p>
			<select name='params[clientId]'>
				<option value="">Seleccione un cliente</option>
				|-foreach from=$affiliates item=affiliate name=for_affiliate-|
				<option value="|-$affiliate->getId()-|" |-if $affiliate->getId() eq $requirement->getClientid()-| selected="selected"|-/if-|>|-$affiliate->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		|-else-|
		|-assign var="cli" value=$requirement->getAffiliate()-|
		<p>Cliente Asociado: |-$cli-|</p>
		|-/if-|
		
		|-if !$requirement->isNew()-|
		<input type="hidden" name="id" id="id" value="|-$requirement->getId()-|" /> 
		|-/if-|
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
		<input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
		<input type="hidden" name="do" id="do" value="requirementsDoEdit" /> 
			<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
				<input type='button' onClick='location.href="Main.php?do=requirementsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos Operativos"/>
			</p>
		</fieldset> 
	</form> 
	|-if !$requirement->isNew()-|
	<fieldset title="Asignación de Recursos">
		<legend>Asignación de Recursos</legend>
		<form method="post">
			<div id="attendantsMsgField"></div>
			<p>Seleccione los recursos para el requerimiento</p>
			<p>
				<select id="attendantId" name="attendantId" title="attendantId">
					<option value="">Seleccione un recurso</option>
					|-foreach from=$attendants item=attendant name=for_attendant-|
					<option id="attendantOption|-$attendant->getId()-|" name="attendantId" value="|-$attendant->getId()-|">|-$attendant->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<input type="hidden" name="do" id="do" value="requirementsDoAddAttendantX" /> 
			<input type="hidden" name="id" id="id" value="|-$requirement->getId()-|" />
				<input type="hidden" name="entityType" id="entityType" value="requirement" />
			<input type="button" value="Agregar recurso" onClick="javascript:requirementsDoAddAttendant(this.form)"/> 
		</form>
		<br /><br />
		<ul id="asocAttendantsList" class="iconOptionsList">
			|-foreach from=$asocAttendants item=asocAttendant name=for_asocAttendant-|
			|-assign var="resource" value=$asocAttendant->getUser()-|
			<li id="asocAttendantsListItem|-$asocAttendant->getId()-|">
				<form  method="post"> 
					<input type="hidden" name="do" id="do" value="requirementsDoDeleteAttendantX" /> 
					<input type="hidden" name="id" id="id" value="|-$asocAttendant->getId()-|" /> 
					<input type="button" value="Eliminar" onClick="javascript:requirementsDoDeleteAttendant(this.form)" class="icon iconDelete" title="Desasociar el recurso del desarrollo"/> 
				</form> |-$resource->getName()-|
			</li>
			|-/foreach-|
		</ul>  
	</fieldset>
	|-/if-|
</div>
|-else-|
	<h1>Administración de Objetivos Operativos</h1>
	<div class="errorMessage">El identificador del objetivo ingresado no es válido. Seleccione un objetivo de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=requirementsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos"/>
|-/if-|
