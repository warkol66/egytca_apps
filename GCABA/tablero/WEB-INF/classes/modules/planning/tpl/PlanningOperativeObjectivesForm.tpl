|-if $message eq "ok"-|
	<div class="successMessage">Objetivo Operativo guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Objetivo Operativo</div>
|-/if-|
|-if !$show && !$showLog-||-include file="CommonAutocompleterInclude.tpl"-||-/if-|
  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
	
		|-if $operativeObjective->isNew() && $ministryObjective-|<div id="navBar">|-include file="PlanningNavigationInclude.tpl" object=$ministryObjective-|</div>|-else-|<div id="navBar">|-include file="PlanningNavigationInclude.tpl" object=$operativeObjective->getAntecessor()-|</div>|-/if-|

    <fieldset title="Formulario de datos de Objetivo Operativo">
     <legend>Objetivo Operativo|-if $startingYear eq $endingYear-| - |-$startingYear-||-else-| (|-$startingYear-| - |-$endingYear-|)|-/if-|</legend>
		|-if !$fromMinistryObjectiveId-|
		|-if $readonly neq "readonly"-|<div id="MinistryObjective" style="position: relative;z-index:11100;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_ministryObjectiveId" label="Objetivo Ministerial" url="Main.php?do=commonAutocompleteListX&object=MinistryObjective&objectParam=id" hiddenName="params[ministryObjectiveId]" defaultHiddenValue=$operativeObjective->getministryObjectiveId() defaultValue=$operativeObjective->getMinistryObjective()-|
		</div>
		|-else-|
      <p>
        <label for="params_ministryObjectiveId">Objetivo Ministerial</label>
      <input name="params_ministryObjectiveId" type="text" id="params_ministryObjectiveId" size="80" value="|-$operativeObjective->getMinistryObjective()-|" readonly="readonly" />
      </p>
		|-/if-|
		|-else-|
      <p>
        <label for="params_ministryObjectiveId">Objetivo Ministerial</label>
      <input name="params_ministryObjectiveId" type="text" size="80" value="|-$ministryObjective-|" readonly="readonly" />
      <input name="params[ministryObjectiveId]" type="hidden" value="|-$fromMinistryObjectiveId-|" />
      <input name="fromMinistryObjectiveId" type="hidden" value="|-$fromMinistryObjectiveId-|" />
      </p>
		|-/if-|

		|-if !$show && !$showLog-|<div id="responsible" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_responsibleCode" label="Dependencia" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code" hiddenName="params[responsibleCode]" defaultHiddenValue=$operativeObjective->getResponsibleCode() defaultValue=$operativeObjective->getPosition()-|
		</div>
		|-else-|
      <p>
        <label for="params_responsibleCode">Dependencia</label>
      <input name="params_responsibleCode" type="text" id="params_responsibleCode" size="80" value="|-$operativeObjective->getPosition()-|" readonly="readonly" />
      </p>
		|-/if-|
      <p>
        <label for="params_internalCode">Código de Identificación</label>
      <input name="params[internalCode]" type="text" id="params_internalCode" size="5" title="Código de Identificación" value="|-$operativeObjective->getInternalCode()-|" |-$readonly|readonly-|  class="emptyValidation numericValidation"/>
      </p>
		<p>
        <label for="params_name">Objetivo Operativo</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$operativeObjective->getName()-|" title="Nombre del Objetivo Operativo" maxlength="255" class="emptyValidation"  |-$readonly|readonly-|/> |-validation_msg_box idField="params_name"-|
      </p>
    <p> 
      <label for="params_description">Descripción / Resumen Narrativo</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Objetivo Operativo" |-$readonly|readonly-|>|-$operativeObjective->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p> 
		<p>
			<label for="params_productKind">Tipo de producción</label>
			<select id="params_productKind" name="params[productKind]" title="Tipo de producción organizacional" |-$readonly|readonly-| |-if $show || $showLog-|disabled="disabled"|-/if-|>
				<option value="">Seleccione el tipo de producción</option>
				|-foreach from=$productKinds key=key item=name-|
							<option value="|-$key-|" |-$operativeObjective->getProductKind()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="params_objectivePopulationGender">Género de población objetivo</label>
			<select id="params_objectivePopulationGender" name="params[objectivePopulationGender]" title="Género de población objetivo" |-$readonly|readonly-| |-if $show || $showLog-|disabled="disabled"|-/if-|>
				<option value="">Seleccione el género</option>
				|-foreach from=$populationGenders key=key item=name-|
							<option value="|-$key-|" |-$operativeObjective->getObjectivePopulationGender()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
    <p> 
      <label for="params_objectivePopulationAge">Grupos etareos población objetivo</label>
      <input name="params[objectivePopulationAge]" type="text" id="params_objectivePopulationAge" title="Grupos etareos población objetivo" value="|-$operativeObjective->getObjectivePopulationAge()-|" size="50" |-$readonly|readonly-|> 
    </p> 
    <p> 
      <label for="params_objectivePopulationGroup">Población objetivo grupos vulnerables</label>
      <input name="params[objectivePopulationGroup]" type="text" id="params_objectivePopulationGroup" title="Población objetivo grupos vulnerables" value="|-$operativeObjective->getObjectivePopulationGroup()-|" size="50" |-$readonly|readonly-|> 
    </p> 
			|-if isset($loginUser) && $loginUser->isSupervisor() && !$operativeObjective->isNew()-|
				<p>
					<label for="changedBy">|-if $operativeObjective->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label>
				<input type="text" id="changedBy" size="80" value="|-$operativeObjective->updatedBy()-| - |-$operativeObjective->getUpdatedAt()|change_timezone|dateTime_format-|" title="|-if $operativeObjective->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:"  readonly="readonly"/>
					 </p>
			|-/if-|
    |-if !$operativeObjective->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$operativeObjective->getId()-|" /> 
    |-/if-|
		|-if !$show && !$showLog-|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="params[startingYear]" id="params_startingYear" value="|-$startingYear-|" /> 
    <input type="hidden" name="params[endingYear]" id="params_endingYear" value="|-$endingYear-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="planningOperativeObjectivesDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
		|-if $fromMinistryObjectiveId-|	<input type='button' onClick='location.href="Main.php?do=planningOperativeObjectivesEdit&fromMinistryObjectiveId=|-$fromMinistryObjectiveId-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Agregar otro objetivo operativo' title="Agregar otro objetivo operativo al objetivo ministerial"/>|-/if-|
	<input type='button' onClick='location.href="Main.php?do=planningOperativeObjectivesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos Operativos"/>
		</p>|-/if-|
    </fieldset> 
  </form> 