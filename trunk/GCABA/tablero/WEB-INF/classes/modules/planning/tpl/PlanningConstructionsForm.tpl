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
		<p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$planningConstruction->getName()-|" title="Nombre del Obra" maxlength="255" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
      </p>
    <p> 
      <label for="params_description">Descripción</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Obra" |-$readonly|readonly-| >|-$planningConstruction->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p> 

	  
			|-if isset($loginUser) && $loginUser->isSupervisor() && !$planningConstruction->isNew()-|
				<p>
					<label for="changedBy">|-if $planningConstruction->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label>
					|-$planningConstruction->updatedBy()-| - |-$planningConstruction->getUpdatedAt()|change_timezone|dateTime_format-| </p>
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