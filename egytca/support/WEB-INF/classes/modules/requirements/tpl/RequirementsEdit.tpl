<h2>Desarrollo</h2> 
|-if !$notValidId || is_object($requirement)-|
<h1>Administración de Requerimientos - |-if !$requirement->isNew()-|Editar|-else-|Crear|-/if-| Requerimientos</h1>
<script language="JavaScript" type="text/javascript">
function requirementsDoAddDevelopment(form) {
	var fields = Form.serialize(form);
	//var pars = 'RequirementsDoAddToDevelopmentX';
	var myAjax = new Ajax.Updater(
				{success: 'developmentsList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('developmentMsgField').innerHTML = '<span class="inProgress">asociando desarrollo...</span>';
	return true;
}
function requirementsDoDeleteDevelopment(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'developmentMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('developmentMsgField').innerHTML = '<span class="inProgress">eliminando usuario de grupo...</span>';
	return true;
}
function requirementsDoAddAffiliate(form){
	var fields = Form.serialize(form);
	//var pars = 'RequirementsDoAddToDevelopmentX';
	var myAjax = new Ajax.Updater(
				{success: 'affiliatesList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('affiliateMsgField').innerHTML = '<span class="inProgress">asociando cliente...</span>';
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
	<fieldset title="Asociar Cliente">
		<legend>Asociar Cliente</legend>
		<div id="affiliateMsgField"> <span id="affiliateMsgField"></span> 
			|-assign var="client" value=$requirement->getClientid()-|
			|-if empty($client)-|
			<form method="post" action="Main.php">
				<p>Seleccione un cliente</p>
				<p>
					<select id="affiliateId" name="affiliateId" title="affiliateId">
						<option value="">Seleccione un cliente</option>
						|-foreach from=$affiliates item=affiliate name=for_affiliate-|
						<option id="affiliateOption|-$affiliate->getId()-|" name="affiliate" value="|-$affiliate->getId()-|">|-$affiliate->getName()-|</option>
						|-/foreach-|
					</select>
				</p>
				<input type="hidden" name="do" id="do" value="requirementsDoAddAffiliateX" />
				<input type="hidden" name="id" id="id" value="|-$requirement->getId()-|" />
				<input type="button" value="Asociar cliente" onClick="javascript:requirementsDoAddAffiliate(this.form)"/> 
			</form>
			|-else-|
			<ul id="affiliatesList" class="iconOptionsList">
				<li id="affiliatesListItem|-$requirement->getClientid()-|">|-$requirement->getAffiliate()-|
					<form  method="post">
						<input type="hidden" name="do" id="do" value="requirementsDoDeleteAffiliateX" />
						<input type="hidden" name="requirementId" id="requirementId" value="|-$requirement->getId()-|" />		
						<input type="button" value="Eliminar" onClick="javascript:requirementsDoDeleteAffiliate(this.form)" class="icon iconDelete" />
					</form>
				</li>
			</ul>
		</div>
		|-/if-|
	</fieldset>
  
	<fieldset title="Asociar Desarrollo">
		<legend>Asociar Desarrollo</legend>
		<div id="developmentMsgField"> <span id="developmentMsgField"></span>
		|-assign var="dev" value=$requirement->getDevelopmentid()-|
		|-if empty($dev)-|
			<form method="post" action="Main.php">	 
				<p>Seleccione un desarrollo para asociar</p>
				<p>
					<select id="developmentId" name="developmentId" title="developmentId">
						<option value="">Seleccione un desarrollo</option>
						|-foreach from=$developments item=development name=for_development-|
						<option id="developmentOption|-$development->getId()-|" name="development" value="|-$development->getId()-|">|-$development->getName()-|</option>
						|-/foreach-|
					</select>
				</p>
				<input type="hidden" name="do" id="do" value="requirementsDoAddToDevelopmentX" />
				<input type="hidden" name="developmentId" id="developmentId" value="|-$development->getId()-|" />
				<input type="hidden" name="id" id="id" value="|-$requirement->getId()-|" />
				<input type="button" value="Asociar desarrollo" onClick="javascript:requirementsDoAddDevelopment(this.form)"/> 
			</form>
		|-else-|
			<ul id="developmentsList" class="iconOptionsList">
				<li id="developmentsListItem|-$requirement->getDevelopmentid()-|">|-$requirement->getDevelopment()-|
					<form  method="post">
						<input type="hidden" name="do" id="do" value="requirementsDoDeleteDevelopmentX" />
						<input type="hidden" name="developmentId"  value="|-$development->getId()-|" />
						<input type="hidden" name="requirementId" id="requirementId" value="|-$requirement->getId()-|" />		
						<input type="button" value="Eliminar" onClick="javascript:requirementsDoDeleteDevelopment(this.form)" class="icon iconDelete" />
					</form>
				</li> 
			</ul>
		|-/if-|
		</div>
	</fieldset>
  
	<!--fieldset title="Asignación de Recursos">
		<form method="post">
			<legend>Asignación de Recursos</legend>
			<div id="attendantsMsgField"> <span id="attendantsMsgField"></span> 
			<p>Seleccione los recursos para el requerimiento</p>
			<p>
				<select id="attendantId" name="attendantId" title="attendantId">
					<option value="">Seleccione un recurso</option>
					|-foreach from=$attendants item=attendant name=for_attendant-|
					<option id="attendantOption|-$attendant->getId()-|" name="attendantId" value="|-$attendant->getId()-|">|-$attendant->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<input type="hidden" name="do" id="do" value="requirementsDoAddAttendantXAction" /> 
			<input type="hidden" name="entityId" id="entityId" value="|-$requirement->getId()-|" />
			<input type="hidden" name="entityType" id="entityType" value="requirement" />
			<input type="button" value="Agregar recurso" onClick="javascript:requirementsDoAddToRequirement(this.form)"/> 
		</form>
		<ul id="groupList" class="iconOptionsList">
		</ul--> 
	</fieldset>
	|-/if-|
</div> 
|-else-|
	<h1>Administración de Objetivos Operativos</h1>
	<div class="errorMessage">El identificador del objetivo ingresado no es válido. Seleccione un objetivo de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=requirementsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos"/>
|-/if-|
