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
	<div class="successMessage">Obra guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Obra</div>
|-/if-|
|-if !$show && !$showLog-||-include file="CommonAutocompleterInclude.tpl"-||-/if-|
  <form name="form_edit_project" id="form_edit_project" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->

    <fieldset title="Formulario de datos de Obra">
     <legend>Obra|-if $startingYear eq $endingYear-| - |-$startingYear-||-else-| (|-$startingYear-| - |-$endingYear-|)|-/if-|</legend>
		|-if $readonly neq "readonly"-|<div id="planningProject" style="position: relative;z-index:11100;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_planningProjectId" label="Proyecto" url="Main.php?do=commonAutocompleteListX&object=planningProject&objectParam=id" hiddenName="params[planningProjectId]" defaultHiddenValue=$planningConstruction->getplanningProjectId() defaultValue=$planningConstruction->getPlanningProject()-|
		</div>
		|-else-|
      <p>
        <label for="params_planningProjectId">Proyecto</label>
      <input name="params_planningProjectId" type="text" id="params_planningProjectId" size="80" value="|-$planningConstruction->getPlanningProject()-|" readonly="readonly" />
      </p>
		|-/if-|
		|-if !$show && !$showLog-|<div id="responsible" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_responsibleCode" label="Dependencia" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code" hiddenName="params[responsibleCode]" defaultHiddenValue=$planningConstruction->getResponsibleCode() defaultValue=$planningConstruction->getPosition()-|
		</div>
		|-else-|
      <p>
        <label for="params_responsibleCode">Dependencia</label>
      <input name="params_responsibleCode" type="text" id="params_responsibleCode" size="80" value="|-$planningConstruction->getPosition()-|" readonly="readonly" />
      </p>
		|-/if-|
		<p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$planningConstruction->getName()-|" title="Nombre del Obra" maxlength="255" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
      </p>
    <p> 
      <label for="params_description">Breve Descripción</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Obra" class="emptyValidation" |-$readonly|readonly-| >|-$planningConstruction->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p> 

	<p>
		<label for="params_tenderId">Procedimiento de Contratación</label>
		<select id="params_tenderId" name="params[tenderId]" title="Procedimiento de Contratación" |-$readonly|readonly-|>
			<option value="">Seleccione tipo de licitación</option>
			|-foreach from=$tenderTypes key=key item=name-|
						<option value="|-$key-|" |-$planningConstruction->getTenderTypes()|selected:$key-|>|-$name-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
        <label for="params_tenderDescription">Detalles de la licitación</label>
      <input name="params[tenderDescription]" type="text" id="params_tenderDescription" size="80" value="|-$planningConstruction->getTenderDescription()-|" title="Detalles de la licitación" maxlength="255" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
    </p>
	<p>
        <label for="params_surface">Superfice (mts2)</label>
      <input name="params[surface]" type="text" id="params_surface" size="20" value="|-$planningConstruction->getSurface()-|" title="Superficie" maxlength="20" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
    </p>
	<p>
        <label for="params_priority">Prioridad?</label>
      <input name="params[priority]" type="checkbox" id="params_priority" |-$planningConstruction->getPriority()|checked_bool-|  value="|-$planningConstruction->getPriority()-|" title="Prioridad" |-$readonly|readonly-|/>
      <input name="params[priority]" type="hidden" value="0"/>
    </p>
	<p>
        <label for="params_communicable">Comunicable?</label>
      <input name="params[communicable]" type="checkbox" id="params_communicable" |-$planningConstruction->getCommunicable()|checked_bool-|  value="|-$planningConstruction->getCommunicable()-|" title="Comunicable" |-$readonly|readonly-|/>
      <input name="params[communicable]" type="hidden" value="0"/>
    </p>
	<p>
        <label for="params_amount">Presupuesto Total de la Obra</label>
      <input name="params[amount]" type="text" id="params_amount" size="20" value="|-$planningConstruction->getAmount()-|" title="Presupuesto total de la Obra" maxlength="20" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
    </p>
	<p>
        <label for="params_appliedAmount">Presupuesto Solicitado</label>
      <input name="params[appliedAmount]" type="text" id="params_appliedAmount" size="20" value="|-$planningConstruction->getAppliedAmount()-|" title="Presupuesto Solicitado" maxlength="20" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
    </p>
	<p>
        <label for="params_managementAmount">Presupuesto Gestión</label>
      <input name="params[managementAmount]" type="text" id="params_managementAmount" size="20" value="|-$planningConstruction->getManagementAmount()-|" title="Presupuesto Gestion " |-$readonly|readonly-|/>
    </p>
	<p>
        <label for="params_raisedAmount">Presupuesto Elevado</label>
      <input name="params[raisedAmount]" type="text" id="params_raisedAmount" size="20" value="|-$planningConstruction->getRaisedAmount()-|" title="Presupuesto Elevado " |-$readonly|readonly-|/>
    </p>
	<p>
        <label for="params_sanctionAmount">Presupuesto Sanción</label>
      <input name="params[sanctionAmount]" type="text" id="params_sanctionAmount" size="20" value="|-$planningConstruction->getSanctionAmount()-|" title="Presupuesto Sancionado " |-$readonly|readonly-|/>
    </p>
		 <h3>Partida presupuestaria</h3>
		 |-if !$planningConstruction->isNew()-||-include file="PlanningBudgetRelationsInclude.tpl" budgetItems=$planningConstruction->getBudgetItems() readonly="readonly" showLog="true"-||-/if-|

		 |-if !$planningConstruction->isNew()-|<h3>Actividades</h3>|-include file="PlanningActivitiesInclude.tpl" activities=$planningConstruction->getActivities() construction="true" semaphore="true"-||-/if-|
	<p>
        <label for="params_fundingSource">Fuente de Financiamiento</label>
      <input name="params[fundingSource]" type="text" id="params_fundingSource" size="80" value="|-$planningConstruction->getFundingSource()-|" title="Fuente de Financiamiento" |-$readonly|readonly-|/>
    </p>
	<p>
        <label for="params_address">Dirección</label>
      <input name="params[address]" type="text" id="params_address" size="80" value="|-$planningConstruction->getAddress()-|" title="Dirección" |-$readonly|readonly-|/>
    </p>
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
    <input type="hidden" name="do" id="do" value="planningConstructionsDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=planningConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
		</p>|-/if-|
    </fieldset> 
  </form> 
