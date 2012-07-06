<script type="text/javascript" src="scripts/lightbox.js"></script>
|-if !$show && !$showLog -|
<div id="lightbox1" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	|-include file="PlanningIndicatorsEditInclude.tpl"-|
</div>
|-/if-|
|-if $message eq "ok"-|
	<div class="successMessage">Objetivo de Impacto guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Objetivo de Impacto</div>
|-/if-|
|-if !$show && !$showLog-||-include file="CommonAutocompleterInclude.tpl"-||-/if-|
  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->

    <fieldset title="Formulario de datos de Objetivo de Impacto">
     <legend>Objetivo de Impacto|-if $startingYear eq $endingYear-| - |-$startingYear-||-else-| (|-$startingYear-| - |-$endingYear-|)|-/if-|</legend>

		|-if !$show && !$showLog-|<div id="responsible" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_responsibleCode" label="Dependencia" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code" hiddenName="params[responsibleCode]" defaultHiddenValue=$impactObjective->getResponsibleCode() defaultValue=$impactObjective->getPosition()-|
		</div>
		|-else-|
      <p>
        <label for="params_responsibleCode">Dependencia</label>
      <input name="params_responsibleCode" type="text" id="params_responsibleCode" size="80" value="|-$impactObjective->getPosition()-|" readonly="readonly" />
      </p>
		|-/if-|
      <p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$impactObjective->getName()-|" title="Nombre del Objetivo de Impacto" maxlength="255" class="emptyValidation" |-$readonly|readonly-| |-js_char_counter assign="js_counter" object=$impactObjective columnName="name" fieldName="params[name]" idRemaining="remaining" sizeRemaining="3" classRemaining="charCount" counterTitle="Cantidad de caracteres restantes"  showHide="1" useSpan="0"-||-$Counter.pre-| /> |-$Counter.pos-| |-validation_msg_box idField="params_name"-|
      </p>
    <p> 
      <label for="params_description">Resumen narrativo </label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Resumen narrativo" |-$readonly|readonly-|>|-$impactObjective->getDescription()|escape-|</textarea>  |-validation_msg_box idField="params_description"-|
    </p> 
		<p>
			<label for="params_policyGuideline">Correspondencia con ejes de gestión</label>
			<select id="params_policyGuideline" name="params[policyGuideline]" title="Correspondencia con ejes de gestión" |-$readonly|readonly-| |-if $show || $showLog-|disabled="disabled"|-/if-|>
				<option value="">Seleccione el Eje de gestión</option>
				|-foreach from=$policyGuidelines key=key item=name-|
							<option value="|-$key-|" |-$impactObjective->getPolicyGuideline()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
      <p>
        <label for="params_baseline">Línea de base</label>
      <input name="params[baseline]" type="text" id="params_name" size="15" value="|-$impactObjective->getBaseline()-|" title="Nombre del Objetivo de Impacto" maxlength="10" class="emptyValidation" |-$readonly|readonly-|/> |-validation_msg_box idField="params_baseline"-|
      </p>
		<p>
			<label for="params_expectedResult">Resultado esperado</label>
			<select id="params_expectedResult" name="params[expectedResult]" title="Resultado esperado" |-$readonly|readonly-| |-if $show || $showLog-|disabled="disabled"|-/if-|>
				<option value="">Seleccione el resultado esperado</option>
				|-foreach from=$expectedResults key=key item=name-|
							<option value="|-$key-|" |-$impactObjective->getExpectedResult()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
      <p>
        <label for="params_contextualFactors">Factores contextuales</label>
        <textarea name="params[contextualFactors]" cols="80" rows="3" wrap="VIRTUAL" id="params_contextualFactors" title="Factores contextuales" |-$readonly|readonly-|>|-$impactObjective->getContextualFactors()-|</textarea> |-validation_msg_box idField="params_contextualFactors"-|
      </p>
      <p>
        <label for="params_contextualFactorsEvolution">Evolucion de Factores contextuales</label>
        <textarea name="params[contextualFactorsEvolution]" cols="80" rows="5" wrap="VIRTUAL" id="params_contextualFactorsEvolution" title="Evolucion de Factores contextuales" |-$readonly|readonly-|>|-$impactObjective->getContextualFactorsEvolution()-|</textarea> |-validation_msg_box idField="params_contextualFactorsEvolution"-|
      </p>
			|-if isset($loginUser) && $loginUser->isSupervisor() && !$impactObjective->isNew()-|
				<p>
					<label for="changedBy">|-if $impactObjective->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label>
				<input type="text" id="changedBy" size="80" value="|-$impactObjective->updatedBy()-| - |-$impactObjective->getUpdatedAt()|change_timezone|dateTime_format-|" title="|-if $impactObjective->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:"  readonly="readonly"/>
					 </p>
			|-/if-|

		|-if !$impactObjective->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$impactObjective->getId()-|" /> 
    |-/if-|
		|-if !$show && !$showLog -|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="params[startingYear]" id="params_startingYear" value="|-$startingYear-|" /> 
    <input type="hidden" name="params[endingYear]" id="params_endingYear" value="|-$endingYear-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="planningImpactObjectivesDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=planningImpactObjectivesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos de Impacto"/>
		</p>
    |-/if-|
    </fieldset> 
  </form> 
	


|-if !$showLog && !$impactObjective->isNew()-|
<fieldset title="Formulario de indicadores asociados al objetivo de impacto">
	<legend>Indicadores asociados al Objetivo de Impacto</legend>
|-if !$show && !$showLog -|
	<p>Para asociar un indicador al objetivo de impacto, ingrese el nombre en la casilla. Si no está en el sistema puede <a href="#lightbox1" rel="lightbox1" class="lbOn addLink">Crear indicador</a></p>
	<div id="indicatorMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="contractSource" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_indicators" label="Agregar indicador" url="Main.php?do=commonAutocompleteListX&object=planningIndicator&getCandidates=1&impactObjectiveId="|cat:$impactObjective->getId() hiddenName="indicatorId" disableSubmit="addIndicatorSubmit"-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="planningObjectsDoAddIndicatorX" />
			<input type="hidden" name="planningObjectType" value="ImpactObjective" /> 
			<input type="hidden" name="planningObjectId" value="|-$impactObjective->getId()-|" /> 
    <input type="button" id="addIndicatorSubmit" disabled="disabled" value="Agregar indicator al objetivo de impacto" title="Agregar indicator al objetivo de impacto" onClick="javascript:addIndicatorToPlanningObject(this.form)"/> </p>
	</form>
    |-/if-|
  <div id="impactObjetivesIndicatorsList">
		<ul id="indicatorList" class="iconOptionsList">
			|-foreach from=$impactObjective->getPlanningIndicators() item=indicator-|
			<li id="indicatorListItem|-$indicator->getId()-|" title="Indicador asociado al objetivo de impacto">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="planningObjectsDoRemoveIndicatorX" /> 
							<input type="hidden" name="planningObjectType" value="ImpactObjective" /> 
							<input type="hidden" name="planningObjectId" value="|-$impactObjective->getId()-|" /> 
							<input type="hidden" name="indicatorId" value="|-$indicator->getId()-|" />
							<input type="button" name="submit_go_remove_indicator" value="Borrar" title="Eliminar indicador de objetivo de impacto" onclick="if (confirm('Seguro que desea eliminar el indicator del objetivo de impacto?')) removeIndicatorFromPlanningObject(this.form);" class="icon iconDelete" /> 
						</form> |-$indicator-|
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

</script>
|-/if-|