|-if is_object($planningProject)-|
<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningProjectsShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningProjectsShowDiv"></div>
	</div>
</div>

|-if $message eq "ok"-|
	<div class="successMessage">Proyecto guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Proyecto</div>
|-/if-|
|-if !$show && !$showLog-||-include file="CommonAutocompleterInclude.tpl"-||-/if-|
  <form name="form_edit_project" id="form_edit_project" action="Main.php" method="post">

		|-if $planningProject->isNew() && $operativeObjective-|<div id="navBar">|-include file="PlanningNavigationInclude.tpl" object=$operativeObjective-|</div>|-else-|<div id="navBar">|-include file="PlanningNavigationInclude.tpl" object=$planningProject->getAntecessor()-|</div>|-/if-|

    <fieldset title="Formulario de datos de Proyecto">
     <legend>Proyecto|-if $startingYear eq $endingYear-| - |-$startingYear-||-else-| (|-$startingYear-| - |-$endingYear-|)|-/if-|</legend>
		|-if !$fromOperativeObjectiveId-|
		|-if $readonly neq "readonly"-|<div id="operativeObjective" style="position: relative;z-index:11100;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_operativeObjectiveId" label="Objetivo Operativo" url="Main.php?do=commonAutocompleteListX&object=OperativeObjective&objectParam=id" hiddenName="params[operativeObjectiveId]" defaultHiddenValue=$planningProject->getOperativeObjectiveId() defaultValue=$planningProject->getOperativeObjective()-|
		</div>
		|-else-|
      <p>
        <label for="params_operativeObjectiveId">Objetivo Operativo</label>
      <input name="params_operativeObjectiveId" type="text" id="params_operativeObjectiveId" size="80" value="|-$planningProject->getOperativeObjective()-|" readonly="readonly" />
      </p>
		|-/if-|
		|-else-|
      <p>
        <label for="params_operativeObjectiveId">Objetivo Operativo</label>
      <input name="params_operativeObjectiveId" type="text" size="80" value="|-$operativeObjective-|" readonly="readonly" />
      <input name="params[operativeObjectiveId]" type="hidden" value="|-$fromOperativeObjectiveId-|" />
      <input name="fromOperativeObjectiveId" type="hidden" value="|-$fromOperativeObjectiveId-|" />
      </p>
		|-/if-|

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
        <label for="params_internalCode">Código de Identificación</label>
      <input name="params[internalCode]" type="text" id="params_internalCode" size="5" title="Código de Identificación" value="|-$planningProject->getInternalCode()-|" |-$readonly|readonly-|  class="emptyValidation numericValidation"/>
      </p>
		<p>
        <label for="params_name">Proyecto</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$planningProject->getName()-|" title="Nombre del Proyecto" maxlength="255" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
      </p>
    <p> 
      <label for="params_description">Descripción</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Proyecto" class="emptyValidation" |-$readonly|readonly-| >|-$planningProject->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p> 
	<p>
        <label for="params_goalProduct">Meta Producto</label>
      <input name="params[goalProduct]" type="text" id="params_goalProduct" size="80" value="|-$planningProject->getGoalProduct()-|" title="Meta producto" maxlength="255" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
    </p>
	<p>
        <label for="params_goalQuantification">Meta Cuantificación</label>
      <input name="params[goalQuantification]" type="text" id="params_goalQuantification" size="80" value="|-$planningProject->getGoalQuantification()-|" title="Meta Cuantificacion" maxlength="255" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
    </p>
	<p>
        <label for="params_investment">Proyecto de inversión?</label><input name="params[investment]" type="hidden" value="0"/>
      <input name="params[investment]" type="checkbox" id="params_investment" value="1" |-$planningProject->getInvestment()|checked_bool-|  title="Proyecto de Inversion" |-$readonly|readonly-|/>
    </p>
	<p>
			<label for="params_preexisting">Proyecto preexistente?</label><input name="params[preexisting]" type="hidden" value="0"/>
      <input name="params[preexisting]" type="checkbox" id="params_preexisting" value="1" |-$planningProject->getPreexisting()|checked_bool-| title="Proyecto preexistente" |-$readonly|readonly-|/>
    </p>
	<p>
		<label for="params_preexistingCode ">Código preexistente</label>
		<input name="params[preexistingCode]" type="text" id="params_preexistingCode " size="20" value="|-$planningProject->getPreexistingCode()-|" title="Código Preexistente" maxlength="255" |-$readonly|readonly-|/>
	</p>
		 |-if !$planningProject->isNew()-|
		 <h3>Partida presupuestaria &nbsp; <a href="javascript:void(null)" id="showHideBudgetRelations" onClick="$('budgetItemsTable').toggle(); $('showHideBudgetRelations').toggleClassName('collapseLink');" class="expandLink">&nbsp;<span>Ver/Ocultar</span></a></h3>|-include file="PlanningBudgetRelationsInclude.tpl" budgetItems=$planningProject->getBudgetItems()-||-/if-|
	<p>
		<label for="params_ministryPriority">Prioridad Ministerial</label>
		<select id="params_ministryPriority" name="params[ministryPriority]" title="Prioridad Ministerial" |-$readonly|readonly-| |-if $show || $showLog-|disabled="disabled"|-/if-|>
			<option value="">Seleccione prioridad</option>
			|-foreach from=$ministryPriorities key=key item=name-|
						<option value="|-$key-|" |-$planningProject->getMinistrypriority()|selected:$key-|>|-$name-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
		<label for="params_priority">Prioridad Jefatura</label>
		<select id="params_priority" name="params[priority]" title="Prioridad Jefatura" |-$readonly|readonly-||-if $show || $showLog-|disabled="disabled"|-/if-| >
			<option value="">Seleccione prioridad</option>
			|-foreach from=$priorities key=key item=name-|
						<option value="|-$key-|" |-$planningProject->getPriority()|selected:$key-|>|-$name-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
        <label for="params_communicable">Proyecto comunicable?</label><input name="params[communicable]" type="hidden" value="0"/>
      <input name="params[communicable]" type="checkbox" id="params_communicable" value="1" title="Proyecto comunicable" |-$planningProject->getCommunicable()|checked_bool-| |-$readonly|readonly-|/>
    </p>
	<p>
        <label for="params_appliedAmount">Presupuesto Solicitado</label>
      <input name="params[appliedAmount]" type="text" id="params_appliedAmount" size="20" value="|-$planningProject->getAppliedAmount()|system_numeric_format-|" title="Presupuesto Solicitado" class="right" |-$readonly|readonly-|/>
    </p>
	<p>
        <label for="params_managementAmount">Presupuesto Gestión</label>
      <input name="params[managementAmount]" type="text" id="params_managementAmount" size="20" value="|-$planningProject->getManagementAmount()|system_numeric_format-|" title="Presupuesto Gestion" class="right"|-$readonly|readonly-|/>
    </p>
	<p>
        <label for="params_raisedAmount">Presupuesto Elevado</label>
      <input name="params[raisedAmount]" type="text" id="params_raisedAmount" size="20" value="|-$planningProject->getRaisedAmount()|system_numeric_format-|" title="Presupuesto Elevado" class="right"|-$readonly|readonly-|/>
    </p>
	<p>
        <label for="params_sanctionAmount">Presupuesto Sanción</label>
      <input name="params[sanctionAmount]" type="text" id="params_sanctionAmount" size="20" value="|-$planningProject->getSanctionAmount()|system_numeric_format-|" title="Presupuesto Sancionado" class="right"|-$readonly|readonly-|/>
    </p>
	<p>     
		<label for="params_startingDate">Fecha de Inicio</label>
		<input id="params_startingDate" name="params[startingDate]" type='text' value='|-$planningProject->getStartingDate()|date_format-|' size="12" title="Ingrese la fecha de Inicio"  |-$readonly|readonly-|/>|-if !$show && !$showLog-| <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[startingDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha de inicio">|-/if-|
	</p>
	<p>     
		<label for="params_endingDate">Fecha de Finalización</label>
		<input id="params_endingDate" name="params[endingDate]" type='text' value='|-$planningProject->getEndingDate()|date_format-|' size="12" title="Ingrese la fecha de Finalizacion"  |-$readonly|readonly-|/> |-if !$show && !$showLog-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[endingDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha de finalizacion">|-/if-|
	</p>
	  
	  
		 |-if !$planningProject->isNew()-|<h3>Gantt (Hitos) &nbsp; <a href="javascript:void(null)" id="showHidePlanningActivities" onClick="$('activitiesTable').toggle(); $('showHidePlanningActivities').toggleClassName('collapseLink');" class="expandLink">&nbsp;<span>Ver/Ocultar</span></a> </h3>|-include file="PlanningActivitiesInclude.tpl" activities=$planningProject->getActivities() showGantt="true"-||-/if-|
	  
	  
	  
	  
	  
			|-if isset($loginUser) && $loginUser->isSupervisor() && !$planningProject->isNew()-|
				<p>
					<label for="changedBy">|-if $planningProject->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label>
				<input type="text" id="changedBy" size="80" value="|-$planningProject->updatedBy()-| - |-$planningProject->getUpdatedAt()|change_timezone|dateTime_format-|" title="|-if $planningProject->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:"  readonly="readonly"/>
					 </p>
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
|-if $planningProject->getInvestment()-|
<input type='button' onClick='location.href="Main.php?do=planningConstructionsEdit&fromPlanningProjectId=|-$planningProject->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Agregar Obra' title='Agregar Obra' />|-/if-|
		|-if $fromOperativeObjectiveId-|	<input type='button' onClick='location.href="Main.php?do=planningProjectsEdit&fromOperativeObjectiveId=|-$fromOperativeObjectiveId-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Agregar otro proyecto' title="Agregar otro proyecto al objetivo operativo"/>|-/if-|
		|-if $fromOperativeObjectiveId-|
		<input type='button' onClick='location.href="Main.php?do=planningOperativeObjectivesEdit&id=|-$fromOperativeObjectiveId-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Regresar al Objetivo Operativo' title='Regresar al Objetivo Operativo' />
		|-else-|
	<input type='button' onClick='location.href="Main.php?do=planningProjectsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Proyectos"/>
		|-/if-|</p>
	|-/if-|
    </fieldset> 
  </form>
|-/if-|