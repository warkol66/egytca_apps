|-if $message eq "ok"-|
	<div class="successMessage">Proyecto guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Proyecto</div>
|-/if-|
|-include file="CommonAutocompleterInclude.tpl"-|
  <form name="form_edit_project" id="form_edit_project" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->

    <fieldset title="Formulario de datos de Proyecto">
     <legend>Proyecto|-if $startingYear eq $endingYear-| - |-$startingYear-||-else-| (|-$startingYear-| - |-$endingYear-|)|-/if-|</legend>
		|-if !$show && !$showLog-|<div id="responsible" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_responsibleCode" label="Dependencia" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code" hiddenName="params[responsibleCode]" defaultHiddenValue=$planningProject->getResponsibleCode() defaultValue=$planningProject->getPosition()-|
		</div>
		|-else-|
      <p>
        <label for="params_responsibleCode">Dependencia</label>
      <input name="params_responsibleCode" type="text" id="params_responsibleCode" size="80" value="|-$planningProject->getPosition()-|" readonly="readonly" />
      </p>
		|-/if-|
		<p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$planningProject->getName()-|" title="Nombre del Proyecto" maxlength="255" class="emptyValidation"  /> |-validation_msg_box idField="params_name"-|
      </p>
    <p> 
      <label for="params_description">Descripción</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Proyecto" >|-$planningProject->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p> 
			|-if isset($loginUser) && $loginUser->isSupervisor() && !$planningProject->isNew()-|
				<p>
					<label for="changedBy">|-if $planningProject->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label>
					|-$planningProject->updatedBy()-| - |-$planningProject->getUpdatedAt()|change_timezone|dateTime_format-| </p>
			|-/if-|
    |-if !$planningProject->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$planningProject->getId()-|" /> 
    |-/if-|
		|-if !$show && !$showLog-|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="params[startingYear]" id="params_startingYear" value="|-$startingYear-|" /> 
    <input type="hidden" name="params[endingYear]" id="params_endingYear" value="|-$endingYear-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="planningProjectsDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=planningProjectsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Proyectos"/>
		</p>|-/if-|
    </fieldset> 
  </form> 