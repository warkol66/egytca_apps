<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/chosen.proto.js"></script>
<!--<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>-->
<!--<script language="JavaScript" type="text/javascript" src="scripts/jquery/ajax-chosen.min.js"></script>-->
<script type="text/javascript">
document.observe("dom:loaded", function() {
	new Chosen($("params_regions"));
});

/*	$(document).ready(function() {


		$(".chzn-select").chosen();

$("#autocomplete_responsibleCode").ajaxChosen({
    method: 'GET',
    url: 'Main.php?do=commonAutocompleteJQueryListX&object=position&objectParam=code',
    dataType: 'json'
}, function (data) {
    var terms = {};

    $.each(data, function (i, val) {
        terms[i] = val;
    });

    return terms;
});

	})*/
</script>


|-if $message eq "ok"-|
	<div class="successMessage">Obra guardada correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar la Obra</div>
|-/if-|
|-if !$show && !$showLog-||-include file="CommonAutocompleterInclude.tpl"-||-/if-|
  <form name="form_edit_project" id="form_edit_project" action="Main.php" method="post">

		|-if $planningConstruction->isNew() && $planningProject-|<div id="navBar">|-include file="PlanningNavigationInclude.tpl" object=$planningProject-|</div>|-else-|<div id="navBar">|-include file="PlanningNavigationInclude.tpl" object=$planningConstruction->getAntecessor()-|</div>|-/if-|

    <fieldset title="Formulario de datos de Obra">
     <legend>Obra|-if $startingYear eq $endingYear-| - |-$startingYear-||-else-| (|-$startingYear-| - |-$endingYear-|)|-/if-|</legend>
		|-if !$fromPlanningProjectId-|
		|-if $readonly neq "readonly"-|<div id="planningProject" style="position: relative;z-index:11100;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_planningProjectId" label="Proyecto" url="Main.php?do=commonAutocompleteListX&object=planningProject&objectParam=id&filters[investment]=true" hiddenName="params[planningProjectId]" defaultHiddenValue=$planningConstruction->getplanningProjectId() defaultValue=$planningConstruction->getPlanningProject()-|
		</div>
		|-else-|
      <p>
        <label for="params_planningProjectId">Proyecto</label>
      <input name="params_planningProjectId" type="text" id="params_planningProjectId" size="80" value="|-$planningConstruction->getPlanningProject()-|" readonly="readonly" />
      </p>
		|-/if-|
		|-else-|
      <p>
        <label for="params_planningProjectId">Proyecto</label>
      <input name="params_operativeObjectiveId" type="text" size="80" value="|-$planningProject-|" readonly="readonly" />
      <input name="params[planningProjectId]" type="hidden" value="|-$fromPlanningProjectId-|" />
      <input name="fromPlanningProjectId" type="hidden" value="|-$fromPlanningProjectId-|" />
      </p>
		|-/if-|




		|-if !$show && !$showLog-|<div id="responsible" style="position: relative;z-index:11000;">

		|-if isset($planningProject)-|
			|-assign var=ancestorCode value=$planningProject->getResponsibleCode()-|
		|-else-|
			|-assign var=planningProject value=$planningConstruction->getPlanningProject()-|
			|-if is_object($planningProject)-|
				|-assign var=ancestorCode value=$planningProject->getResponsibleCode()-|
			|-/if-|		
		|-/if-|


			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_responsibleCode" label="Dependencia" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code&filters[filterByGroupCode]=$ancestorCode" hiddenName="params[responsibleCode]" defaultHiddenValue=$planningConstruction->getResponsibleCode() defaultValue=$planningConstruction->getPosition()-|
		</div>
		|-else-|
      <p>
        <label for="params_responsibleCode">Dependencia</label>
      <input name="params_responsibleCode" type="text" id="params_responsibleCode" size="80" value="|-$planningConstruction->getPosition()-|" readonly="readonly" />
      </p>
		|-/if-|
		<p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$planningConstruction->getName()|escape-|" title="Nombre del Obra" maxlength="255" |-$readonly|readonly:"emptyValidation"-| /> |-validation_msg_box idField="params_name"-|
    </p>
    <p> 
      <label for="params_description">Breve Descripción</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Obra"  |-$readonly|readonly:"emptyValidation"-| >|-$planningConstruction->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p> 
  <p>
    <label for="params_constructionType">Tipo de obra</label>|-if $planningConstruction->isNew()-|
    <select id="params_constructionType" name="params[constructionType]" title="Tipo de Obra" |-$readonly|readonly:"emptyValidation"-|>
      <option value="">Seleccione tipo de Obra</option>
      |-foreach from=$constructionTypes key=key item=name-|
					<option value="|-$key-|" |-$planningConstruction->getConstructionType()|selected:$key-|>|-$name-|</option>
      |-/foreach-|
    </select>
		|-else-|
		<input type="text" size="25" readonly="readonly" value="|-$constructionTypes[$planningConstruction->getConstructionType()]-|">
		|-/if-|
  </p>

	<p>
		<label for="params_tenderId">Procedimiento de Contratación</label>
		<select id="params_tenderId" name="params[tenderId]" title="Procedimiento de Contratación"  onChange="checkTender('params_tenderId');" |-$readonly|readonly-|>
			<option value="">Seleccione tipo de Contratación</option>
			|-foreach from=$tenderTypes key=key item=name-|
						<option value="|-$key-|" |-$planningConstruction->getTenderId()|selected:$key-|>|-$name-|</option>
			|-/foreach-|
		</select>
	</p>
  <p id="tenderDescription" style="display: |-if $planningConstruction->getTenderId() eq 3-|block|-else-|none|-/if-|">
        <label for="params_tenderDescription">Detalle de Contratación</label>
      <textarea name="params[tenderDescription]" cols="70" rows="2" wrap="VIRTUAL" id="params_tenderDescription" type="text" title="Detalle de Contratación"  |-$readonly|readonly-| >|-$planningConstruction->getTenderDescription()|escape-|</textarea>
    </p>
	<p>
        <label for="params_surface">Superfice (mts2)</label>
      <input name="params[surface]" type="text" id="params_surface" size="20" value="|-$planningConstruction->getSurface()|system_numeric_format-|" title="Superficie" maxlength="20" |-$readonly|readonly:"emptyValidation right"-| /> |-validation_msg_box idField="params_name"-|
    </p>
	<p>
        <label for="params_priority">¿Prioridad?</label>
      <input name="params[priority]" type="hidden" value="0"/>
      <input name="params[priority]" type="checkbox" id="params_priority" |-$planningConstruction->getPriority()|checked_bool-|  value="1" title="Prioridad"/>
    </p>
	<p>
        <label for="params_communicable">¿Comunicable?</label>
      <input name="params[communicable]" type="hidden" value="0"/>
      <input name="params[communicable]" type="checkbox" id="params_communicable" |-$planningConstruction->getCommunicable()|checked_bool-|  value="1" title="Comunicable"/>
    </p>
	<p>
        <label for="params_amount">Presupuesto Total de la Obra</label>
      <input name="params[amount]" type="text" id="params_amount" size="20" value="|-$planningConstruction->getAmount()|system_numeric_format-|" title="Presupuesto total de la Obra" maxlength="20" class="emptyValidation right" /> |-validation_msg_box idField="params_name"-|
    </p>
	<p>
        <label for="params_appliedAmount">Presupuesto Solicitado</label>
      <input name="params[appliedAmount]" type="text" id="params_appliedAmount" size="20" value="|-$planningConstruction->getAppliedAmount()|system_numeric_format-|" title="Presupuesto Solicitado" maxlength="20" class="emptyValidation right" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
    </p>
	<p>
        <label for="params_managementAmount">Presupuesto Gestión</label>
      <input name="params[managementAmount]" type="text" id="params_managementAmount" size="20" value="|-$planningConstruction->getManagementAmount()|system_numeric_format-|" title="Presupuesto Gestion " class="right" />
    </p>
	<p>
        <label for="params_raisedAmount">Presupuesto Elevado</label>
      <input name="params[raisedAmount]" type="text" id="params_raisedAmount" size="20" value="|-$planningConstruction->getRaisedAmount()|system_numeric_format-|" title="Presupuesto Elevado " class="right" |-$readonly|readonly-|/>
    </p>
	<p>
        <label for="params_sanctionAmount">Presupuesto Sanción</label>
      <input name="params[sanctionAmount]" type="text" id="params_sanctionAmount" size="20" value="|-$planningConstruction->getSanctionAmount()|system_numeric_format-|" title="Presupuesto Sancionado " class="right" |-$readonly|readonly-|/>
    </p>
  <p>
        <label for="params_fundingSource">Fuente de Financiamiento</label>
      <input name="params[fundingSource]" type="text" id="params_fundingSource" size="80" value="|-$planningConstruction->getFundingSource()|escape-|" title="Fuente de Financiamiento" |-$readonly|readonly-|/>
    </p>


  <p>     
    <label for="params_startingDate">Fecha de Inicio</label>
    <input id="params_startingDate" name="params[startingDate]" type='text' value='|-$planningConstruction->getStartingDate()|date_format-|' size="12" title="Ingrese la fecha de Inicio en formato dd-mm-aaaa" class="dateValidation"/>|-if !$show && !$showLog-| <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[startingDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha de inicio">|-/if-|
  </p>
  <p>     
    <label for="params_endingDate">Fecha de Finalización</label>
    <input id="params_endingDate" name="params[endingDate]" type='text' value='|-$planningConstruction->getEndingDate()|date_format-|' size="12" title="Ingrese la fecha de Finalizacion en formato dd-mm-aaaa" class="dateValidation"/> |-if !$show && !$showLog-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[endingDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha de finalizacion">|-/if-|
  </p>
  <p>     
    <label for="params_potentialEndingDate">Fecha Probable de Finalización</label>
    <input id="params_potentialEndingDate" name="params[potentialEndingDate]" type='text' value='|-$planningConstruction->getPotentialEndingDate()|date_format-|' size="12" title="Ingrese la fecha de Finalizacion en formato dd-mm-aaaa" class="dateValidation"/> |-if !$show && !$showLog-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[potentialEndingDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha de finalizacion">|-/if-|
  </p>
      
		 |-if !$planningConstruction->isNew()-|<h3>Partida presupuestaria &nbsp; <a href="javascript:void(null)" id="showHideBudgetRelations" onClick="$('budgetItemsTable').toggle(); $('showHideBudgetRelations').toggleClassName('expandLink');" class="collapseLink">&nbsp;<span>Ver/Ocultar</span></a></h3>|-include file="PlanningBudgetRelationsInclude.tpl" budgetItems=$planningConstruction->getBudgetItems() type="Construction" objId=$planningConstruction->getId()-||-/if-|
		 <h3>Gantt (Hitos) <a href="javascript:void(null)" id="showHidePlanningConstruction" onClick="$('activitiesTable').toggle(); $('showHidePlanningConstruction').toggleClassName('collapseLink');" class="expandLink">&nbsp;<span>Ver/Ocultar</span></a></h3>|-if !$planningConstruction->isNew()-||-include file="PlanningActivitiesInclude.tpl" activities=$planningConstruction->getActivities() construction=$planningConstruction showGantt="true" readonly=false  semaphore="true"-||-else-|
		 |-include file="PlanningConstructionsTemplateInclude.tpl" construction="true" readonly=false-||-/if-|
	<p>
        <label for="params_address">Dirección</label>
      <input name="params[address]" type="text" id="params_address" size="80" value="|-$planningConstruction->getAddress()|escape-|" title="Dirección" |-$readonly|readonly-|/>
    </p>
|-if !$planningConstruction->isNew()-|<h3>Ejecución Físico/Financiera &nbsp; <a href="javascript:void(null)" id="showHideConstructionProgress" onClick="$('progressRecordsTable').toggle(); $('showHideConstructionProgress').toggleClassName('expandLink');" class="collapseLink">&nbsp;<span>Ver/Ocultar</span></a></h3>|-include file="PlanningConstructionProgressInclude.tpl" progressRecords=$planningConstruction->getConstructionProgresss()  readonly=false-||-/if-|
	<p>
		<label for="params_regions">Comunas</label>
		<select class="chzn-select wide-chz-select" data-placeholder="Seleccione una o varias comunas..." multiple="multiple" id="params_regions" name="params[regionsIds][]" size="5" title="comunas" |-$readonly|readonly-|>
		|-foreach from=$regions item=object-|
			<option value="|-$object->getid()-|" |-$planningConstruction->hasRegion($object)|selected:true-|>|-$object->getname()-|</option>
		|-/foreach-|
		</select>
	</p>
			|-if isset($loginUser) && $loginUser->isSupervisor() && !$planningConstruction->isNew()-|
				<p>
					<label for="changedBy">|-if $planningConstruction->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label>
				<input type="text" id="changedBy" size="80" value="|-$planningConstruction->updatedBy()-| - |-$planningConstruction->getUpdatedAt()|change_timezone|dateTime_format-|" title="|-if $planningConstruction->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por"  readonly="readonly"/></p>
			|-/if-|
    |-if !$planningConstruction->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$planningConstruction->getId()-|" /> 
    |-/if-|
		|-if !$show && !$showLog-|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="params[startingYear]" id="params_startingYear" value="|-$startingYear-|" /> 
    <input type="hidden" name="params[endingYear]" id="params_endingYear" value="|-$endingYear-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="panelConstructionsDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
		|-if !$planningConstruction->isNew() && $fromPlanningProjectId-|	<input type='button' onClick='location.href="Main.php?do=panelConstructionsEdit&fromPlanningProjectId=|-$fromPlanningProjectId-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Agregar otra obra al proyecto' title="Agregar otra obra al proyecto"/>|-/if-|
		|-if $fromPlanningProjectId-|
		<input type='button' onClick='location.href="Main.php?do=planningProjectsEdit&id=|-$fromPlanningProjectId-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Regresar al Proyecto' title='Regresar al Proyecto' />
		|-else-|
	<input type='button' onClick='location.href="Main.php?do=panelConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
		|-/if-|		</p>|-/if-|
    </fieldset> 
  </form> 
|-if !$planningConstruction->isNew()-|
<fieldset><legend>Notas de Seguimiento</legend>
<div id="messageAdd"></div>
|-assign var=panelNotes value=$planningConstruction->getPanelNotes()-|
<ul id="panelNotes" class="iconOptionsList">|-foreach from=$panelNotes item=note-|
			<li id="noteListItem|-$note->getId()-|" title="Nota">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="panelNotesDoDeleteX" /> 
							<input type="hidden" name="id" value="|-$note->getId()-|" /> 
							<input type="button" name="submit_go_remove_actor" value="Borrar" title="Eliminar nota" onclick="if (confirm('Seguro que desea eliminar nota?')) removePanelNotes(this.form);" class="icon iconDelete" /> 
						</form> |-$note->getCreatedAt()|change_timezone|dateTime_format-| - |-$note->updatedBy()-| | |-$note->getNote()-|</li>
|-/foreach-|</ul>
<h3>Agregar nota</h3>
<script language="JavaScript" type="text/JavaScript">
	function removePanelNotes(form){
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
					{success: 'panelNotes'},
					'Main.php?do=panelNotesDoDeleteX',
					{
						method: 'post',
						postBody: fields,
						evalScripts: true,
						insertion: Insertion.Bottom
					});
		$('messageAdd').innerHTML = '<span class="inProgress">Eliminando nota...</span>';
		return true;
	}
function addPanelNotes(form) {
			var fields = Form.serialize(form);
			var myAjax = new Ajax.Updater(
				{success: 'panelNotes'},
				'Main.php?do=panelNotesDoAddX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});	
	$('messageAdd').innerHTML = '<span class="inProgress">agregando nota ...</span>';
	return true;
}
</script>

<form method="post" style="display:inline;">
	<input type="hidden" name="do" id="do" value="panelNotesDoAddX" /> 
	<input type="hidden" name="params[objectId]" id="params_objectId" value="|-$planningConstruction->getId()-|" />
	<input type="hidden" name="params[objectType]" id="params_objectType" value="PlanningConstruction" />
	<p><label for="params_note">Texto de la nota</label><textarea name="params[note]" cols="60" rows="5" wrap="VIRTUAL" id="params_note" height="5"></textarea></p>
  <input type="button" id="addNote" name="addNoteSubmit" value="Agregar nota" title="" onClick="javascript:addPanelNotes(this.form)"/> </p>
</form>
</fieldset> 
|-/if-|
<script type="text/javascript">
	function checkTender(elementId) {
			var selectType = document.getElementById(elementId);
			var chosenOption = selectType.options[selectType.selectedIndex];
			switch(chosenOption.value) {
					case '3':
							$('tenderDescription').show();
							enableInputId('params_tenderDescription');
							break;
					default:
							$('tenderDescription').hide();
							disableInputId('params_tenderDescription');
			}
	}
	function disableInputId(elementId) {
		document.getElementById(elementId).disable();
	}
	function enableInputId(elementId) {
		document.getElementById(elementId).enable();
	}
</script>
