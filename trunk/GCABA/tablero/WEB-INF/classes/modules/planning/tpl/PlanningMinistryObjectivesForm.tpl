<script type="text/javascript" src="scripts/lightbox.js"></script>
|-if !$show && !$showLog -|
<div id="lightbox1" class="leightbox">
	<p align="right">
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a>
	</p>
	|-include file="PlanningIndicatorsEditInclude.tpl"-|
</div>
|-/if-|
<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/chosen.proto.js"></script>
<!--<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>-->
<!--<script language="JavaScript" type="text/javascript" src="scripts/jquery/ajax-chosen.min.js"></script>-->
<script type="text/javascript">
/*document.observe("dom:loaded", function() {
	new Chosen($("params_regions"));
});
*/
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
	<div class="successMessage">Objetivo Ministerial guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Objetivo Ministerial</div>
|-/if-|
|-if !$show && !$showLog-||-include file="CommonAutocompleterInclude.tpl"-||-/if-|
	<form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">

		|-if $ministryObjective->isNew() && $impactObjective-|<div id="navBar">|-include file="PlanningNavigationInclude.tpl" object=$impactObjective-|</div>|-else-|<div id="navBar">|-include file="PlanningNavigationInclude.tpl" object=$ministryObjective->getAntecessor()-|</div>|-/if-|

		<fieldset title="Formulario de datos de Objetivo Ministerial">
		 <legend>Objetivo Ministerial|-if $startingYear eq $endingYear-| - |-$startingYear-||-else-| (|-$startingYear-| - |-$endingYear-|)|-/if-|</legend>
		|-if !$fromImpactObjectiveId-|
		|-if $readonly neq "readonly"-|<div id="ImpactObjective" style="position: relative;z-index:11100;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_impactObjectiveId" label="Objetivo de Impacto" url="Main.php?do=commonAutocompleteListX&object=ImpactObjective&objectParam=id" hiddenName="params[impactObjectiveId]" defaultHiddenValue=$ministryObjective->getimpactObjectiveId() defaultValue=$ministryObjective->getImpactObjective()-|
		</div>
		|-else-|
      <p>
        <label for="params_impactObjectiveId">Objetivo de Impacto</label>
      <input name="params_impactObjectiveId" type="text" id="params_impactObjectiveId" size="80" value="|-$ministryObjective->getImpactObjective()-|" readonly="readonly" />
      </p>
		|-/if-|
		|-else-|
      <p>
        <label for="params_impactObjectiveId">Objetivo de Impacto</label>
      <input name="params_impactObjectiveId" type="text" size="80" value="|-$impactObjective-|" readonly="readonly" />
      <input name="params[impactObjectiveId]" type="hidden" value="|-$fromImpactObjectiveId-|" />
      <input name="fromImpactObjectiveId" type="hidden" value="|-$fromImpactObjectiveId-|" />
      </p>
		|-/if-|
		|-if !$show && !$showLog-|<div id="responsible" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_responsibleCode" label="Dependencia" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code&objectParam=code&filters[filterByDoPlanning]=true" hiddenName="params[responsibleCode]" defaultHiddenValue=$ministryObjective->getResponsibleCode() defaultValue=$ministryObjective->getPosition()-|
		</div>
		|-else-|
			<p>
				<label for="params_responsibleCode">Dependencia</label>
			<input name="params_responsibleCode" type="text" id="params_responsibleCode" size="80" value="|-$ministryObjective->getPosition()-|" readonly="readonly" />
			</p>
		|-/if-|
      <p>
        <label for="params_internalCode">Código de Identificación</label>
      <input name="params[internalCode]" type="text" id="params_internalCode" size="5" title="Código de Identificación" value="|-$ministryObjective->getInternalCode()-|" |-$readonly|readonly-|  class="emptyValidation numericValidation"/>
      </p>
					<p>
				<label for="params_name">Objetivo Ministerial</label>
			<input name="params[name]" type="text" id="params_name" size="80" value="|-$ministryObjective->getName()-|" title="Nombre del Objetivo Ministerial" maxlength="255"  class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
			</p>
		<p>
			<label for="params_description">Resumen Narrativo </label>
			<textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Objetivo Ministerial" class="emptyValidation" |-$readonly|readonly-|>|-$ministryObjective->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
		</p>
		<p>
			<label for="params_regions">Comunas</label>
			<select class="chzn-select wide-chz-select" data-placeholder="Seleccione una o varias comunas..." multiple="multiple" id="params_regions" name="params[regionsIds][]" size="5" title="comunas" |-$readonly|readonly-| |-if $show || $showLog-|disabled="disabled"|-/if-|>
			|-foreach from=$regions item=object-|
				<option value="|-$object->getid()-|" |-$ministryObjective->hasRegion($object)|selected:true-|>|-$object->getname()-|</option>
			|-/foreach-|
			</select>
		</p>
		|-if isset($loginUser) && $loginUser->isSupervisor() && !$ministryObjective->isNew()-|
			<p>
				<label for="changedBy">|-if $ministryObjective->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label>
			<input type="text" id="changedBy" size="80" value="|-$ministryObjective->updatedBy()-| - |-$ministryObjective->getUpdatedAt()|change_timezone|dateTime_format-|" title="|-if $ministryObjective->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:"  readonly="readonly"/>
				 </p>
		|-/if-|
		|-if !$ministryObjective->isNew()-|
		<input type="hidden" name="id" id="id" value="|-$ministryObjective->getId()-|" />
		|-/if-|
		|-if !$show && !$showLog -|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
		<input type="hidden" name="params[startingYear]" id="params_startingYear" value="|-$startingYear-|" />
		<input type="hidden" name="params[endingYear]" id="params_endingYear" value="|-$endingYear-|" />
		<input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" />
		<input type="hidden" name="do" id="do" value="planningMinistryObjectivesDoEdit" />
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=planningMinistryObjectivesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos Ministeriales"/>
		</p>|-/if-|
		</fieldset>
	</form>
|-if !$showLog && !$ministryObjective->isNew()-|
<fieldset title="Formulario de indicadores asociados al objetivo ministerial">
	<legend>Indicadores asociados al Objetivo Ministerial</legend>
|-if !$show && !$showLog -|
	<p>Para asociar un indicador al objetivo ministerial, ingrese el nombre en la casilla. Si no está en el sistema puede <a href="#lightbox1" rel="lightbox1" class="lbOn addLink">Crear indicador</a></p>
	<div id="indicatorMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="contractSource" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_indicators" label="Agregar indicador" url="Main.php?do=commonAutocompleteListX&object=planningIndicator&getCandidates=1&impactObjectiveId="|cat:$ministryObjective->getId() hiddenName="indicatorId" disableSubmit="addIndicatorSubmit"-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="planningObjectsDoAddIndicatorX" />
			<input type="hidden" name="planningObjectType" value="MinistryObjective" />
			<input type="hidden" name="planningObjectId" value="|-$ministryObjective->getId()-|" />
		<input type="button" id="addIndicatorSubmit" disabled="disabled" value="Agregar indicator al objetivo ministerial" title="Agregar indicator al objetivo ministerial" onClick="javascript:addIndicatorToPlanningObject(this.form)"/> </p>
	</form>
		|-/if-|
	<div id="ministryObjectivesIndicatorsList">
		<ul id="indicatorList" class="iconOptionsList">
			|-foreach from=$ministryObjective->getPlanningIndicators() item=indicator-|
			<li id="indicatorListItem|-$indicator->getId()-|" title="Indicador asociado al objetivo ministerial">
						|-if !$show && !$showLog -|<form action="Main.php" method="post" style="display:inline;">
							<input type="hidden" name="do" value="planningObjectsDoRemoveIndicatorX" />
							<input type="hidden" name="planningObjectType" value="MinistryObjective" />
							<input type="hidden" name="planningObjectId" value="|-$ministryObjective->getId()-|" />
							<input type="hidden" name="indicatorId" value="|-$indicator->getId()-|" />
							<input type="button" name="submit_go_remove_indicator" value="Borrar" title="Eliminar indicador de objetivo ministerial" onclick="if (confirm('Seguro que desea eliminar el indicator del objetivo ministerial?')) removeIndicatorFromPlanningObject(this.form);" class="icon iconDelete" />
						</form>|-/if-|<input type="button" class="icon iconView" onClick='window.open("Main.php?do=planningIndicatorsViewX&id=|-$indicator->getid()-|","indicator","width=800,height=600");' value="Ver indicador" title="Ver indicador (abre en ventana nueva)" />&nbsp; &nbsp; |-$indicator-|
			</li>
			|-/foreach-|
			</ul>
		</div>
</fieldset>
<script type="text/javascript" language="javascript" charset="utf-8">
	function addIndicatorToPlanningObject(form) {
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
					{success: 'indicatorList'},
					'Main.php?do=planningObjectsDoAddIndicatorX',
					{
						method: 'post',
						postBody: fields,
						evalScripts: true,
						insertion: Insertion.Bottom
					});
			$('indicatorMsgField').innerHTML = '<span class="inProgress">Agregando indicador al objetivo...</span>';
			$('autocomplete_indicators').value = '';
			$('addIndicatorSubmit').disable();
		return true;
	}

	function removeIndicatorFromPlanningObject(form){
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
					{success: 'indicatorMsgField'},
					'Main.php?do=planningObjectsDoRemoveIndicatorX',
					{
						method: 'post',
						postBody: fields,
						evalScripts: true
					});
		$('indicatorMsgField').innerHTML = '<span class="inProgress">Eliminando indicador...</span>';
		return true;
	}
	new Chosen($("params_regions"));
</script>
|-/if-|