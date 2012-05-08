|-if $action ne "showLog"-||-include file='ValidationJavascriptInclude.tpl'-||-/if-|
<form name="form_edit_project" id="form_edit_project" action="Main.php" method="post">
     |-if $message eq "error"-|
		 <div class="failureMessage">Ha ocurrido un error al intentar guardar el ##projects,4,proyecto##</div>
	 |-/if-|
     |-if $action ne "showLog" && $project->hasErrors()-|
     	<div class="failureMessage">
			<ul>
			|-foreach from=$project->getValidationFailures() item=error-|
				<li>|-$error->getMessage()-|</li>
			|-/foreach-|
			</ul>
		</div>
	 |-/if-|		
	|-if $action ne "showLog"-|
   <p><a href="Main.php?do=projectsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|">Volver atras</a></p> 
    <p>Ingrese los datos del ##projects,4,proyecto##.</p> 
	|-/if-|	
    <fieldset title="Formulario de edición de datos de un Proyecto"> 
     <legend>##projects,1,Proyecto##</legend>
    <p> |-if !empty($loginUser)-||-*if $loginUser neq "" and $loginUser->isAdmin()*-|
      <label for="paramsProject[objectiveId]">##objectives,3,Objetivo##</label> 
      <select id="paramsProject[objectiveId]" name="paramsProject[objectiveId]" title="objectiveId" |-$action|disabled-| |-$project|propelValidatorError:"objectiveId"-|> 
			<option value="">Seleccione ##objectives,3,Objetivo##</option>
				|-foreach from=$objectives item=objective name=for_valores-|
        <option value="|-$objective->getId()-|" |-$project->getobjectiveId()|selected:$objective->getId()-|>|-$objective->getName()|truncate:75:"...":false-|</option> 
				|-/foreach-|
      </select>|-if $action ne "showLog"-|<img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />|-/if-|
      |-/if-| |-if $loginAffiliateUser neq ""-|
      <input type="hidden" name="paramsProject[objectiveId]" value="|-$project->getobjectiveId()-|" /> 
      |-assign var=objective value=$project->getObjective()-| |-/if-| </p> 
     <p> 
      <label for="paramsProject[code]">Código/Expediente</label> 
      <input name="paramsProject[code]" type="text" value="|-$project->getCode()-|" size="40" title="Número de Expediente" |-$action|readonly-| /> 
    </p> 
|-if $configModule->get("projects","useCodeAux")-|    <p> 
      <label for="paramsProject[codeAux]">Código SEPA</label> 
      <input name="paramsProject[codeAux]" type="text" value="|-$project->getCodeAux()-|" size="40" title="Código de referencia del SEPA" |-$action|readonly-| /> 
    </p> |-/if-|
   <p> 
      <label for="name">Nombre</label> 
      <input name="paramsProject[name]" type="text" id="name" title="Nombre del Proyecto" size="80"  value="|-$project->getname()|escape-|" |-$project|propelValidatorError:"name"-| |-$action|readonly-| />|-if $action ne "showLog"-|<img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />|-/if-|</p>  
    <p> 
      <label for="paramsProject[description]">Descripción</label> 
      <textarea name="paramsProject[description]" cols="70" rows="6" wrap="VIRTUAL" title="Descripción del proyecto" |-$action|readonly-|>|-$project->getdescription()|escape-|</textarea> 
    </p> 
     <p>
      <label for="paramsProject[responsibleCode]">Responsable</label> 
      <select id="paramsProject[responsibleCode]" name="paramsProject[responsibleCode]" title="Responsable del Proyecto" |-$project|propelValidatorError:"responsibleCode"-| |-$action|disabled-|> 
	    <option value="">Seleccione Responsable</option>
				|-foreach from=$positions item=position name=for_positions-|
        <option value="|-$position->getCode()-|" |-$project->getResponsibleCode()|selected:$position->getCode()-|>|-$position->getOwnerName()-| &#8212; |-assign var=tenure value=$position->getActiveTenure()-| |-if $tenure->getObject() != NULL-||-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()-| |-$tenureObject->getSurname()-||-/if-|</option> 
				|-/foreach-|
      </select>|-if $action ne "showLog"-|<img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />|-/if-|
    </p> 
    <p> 
      <label for="paramsProject[impact]">Impacto</label> 
      <textarea name="paramsProject[impact]" cols="70" rows="3" wrap="VIRTUAL" title="Impacto del Proyecto" |-$action|readonly-|>|-$project->getimpact()|escape-|</textarea>|-if $action ne "showLog"-|<a class="tooltipWide" href="#"><span>Impacto se define como el resultado esperado de la ejecución exitosa del proyecto.<br />Ejemplo: Mejorar la limpieza de la ciudad.</span><img src="images/icon_info.gif"></a>|-/if-|
    </p> 
    <p> 
      <label for="paramsProject[uniqueGoal]">Meta</label> 
      <textarea name="paramsProject[uniqueGoal]" cols="70" rows="4" wrap="VIRTUAL" title="Meta del proyecto" |-$action|readonly-|>|-$project->getuniqueGoal()|escape-|</textarea>|-if $action ne "showLog"-|<a class="tooltipWide" href="#"><span>Meta se define como la cuantificación material del resultado del proyecto.<br />Ej: Instalación de 5000 cestos de basura.</span><img src="images/icon_info.gif"></a>|-/if-|
    </p> 
    <p> 
      <label for="paramsProject[budget]">Presupuesto</label> 
      <input type="text" id="paramsProject[budget]" name="paramsProject[budget]" class="numericValidation" value="|-$project->getbudget()-|" title="Presupuesto" |-$action|readonly-| |-javascript_onchange_validation_attribute idField="paramsProject[budget]"-| />&nbsp;&nbsp;|-validation_msg_box idField=paramsProject[budget]-|
    </p>
|-if ($configModule->get("projects","useFinancingSources"))-|
    <p> 
      <label for="paramsProject[primarySource]">Fuente principal</label> 
      <select id="paramsProject[primarySource]" name="paramsProject[primarySource]" title="Fuente principal" |-$action|disabled-|> 
        <option>Seleccione</option> 
				|-foreach from=$sources item=source name=for_sources-|
        <option |-$project->getprimarySource()|selected:$source-|>|-$source-|</option> 
				|-/foreach-|      </select>
		</p>
    <p> 
      <label for="paramsProject[additionalSource]">Fuente adicional</label> 
      <select id="paramsProject[additionalSource]" name="paramsProject[additionalSource]" title="Fuente adicional" |-$action|disabled-|> 
        <option>Seleccione</option> 
				|-foreach from=$sources item=source name=for_sources-|
        <option |-$project->getadditionalSource()|selected:$source-|>|-$source-|</option> 
				|-/foreach-|      </select>
		</p>
|-/if-|
   <p> 
      <label for="paramsProject[plannedStart]">Inicio planificado</label> 
      <input type="text" id="paramsProject[plannedStart]" name="paramsProject[plannedStart]" class="dateValidation" value="|-$project->getplannedStart()|date_format:"%d-%m-%Y"-|" title="Inicio planificado (Formato: dd-mm-yyyy)" |-$action|readonly-| |-javascript_onchange_validation_attribute idField="paramsProject[plannedStart]"-| /> |-if $action ne "showLog"-|
      <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('paramsProject[plannedStart]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">&nbsp;&nbsp;|-validation_msg_box idField="paramsProject[plannedStart]"-||-/if-| |-if ($configModule->get("projects","showActivitiesDates")) && $project->getAllActivitiesPlannedStart() gt 0-|<a class="tooltip" href="#"><span>La fecha Inicio Planificado según las actividades del ##projects,4,proyecto## es: |-$project->getAllActivitiesPlannedStart()|date_format:"%d-%m-%Y"-|</span><img src="images/icon_info.gif"></a>|-/if-|</p> 
    <p> 
      <label for="paramsProject[plannedEnd]">Final planificado</label> 
      <input type="text" id="paramsProject[plannedEnd]" name="paramsProject[plannedEnd]" class="dateValidation" value="|-$project->getplannedEnd()|date_format:"%d-%m-%Y"-|" title="Fin planificado (Formato: dd-mm-yyyy)" |-$action|readonly-| |-javascript_onchange_validation_attribute idField="paramsProject[plannedEnd]"-| /> 
     |-if $action ne "showLog"-| <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('paramsProject[plannedEnd]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">&nbsp;&nbsp;|-validation_msg_box idField="paramsProject[plannedEnd]"-||-/if-| |-if ($configModule->get("projects","showActivitiesDates")) && $project->getAllActivitiesPlannedend() gt 0-|<a class="tooltip" href="#"><span>La fecha Finalización Planificada según las actividades del ##projects,4,proyecto## es: |-$project->getAllActivitiesPlannedend()|date_format:"%d-%m-%Y"-|</span><img src="images/icon_info.gif"></a>|-/if-|</p> 
    <p> 
      <label for="paramsProject[realStart]">Inicio real</label> 
      <input type="text" id="paramsProject[realStart]" name="paramsProject[realStart]" class="dateValidation" value="|-$project->getrealStart()|date_format:"%d-%m-%Y"-|" title="Inicio real (Formato: dd-mm-yyyy)" |-$action|readonly-| |-javascript_onchange_validation_attribute idField="paramsProject[realStart]"-| /> 
     |-if $action ne "showLog"-| <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('paramsProject[realStart]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">&nbsp;&nbsp;|-validation_msg_box idField="paramsProject[realStart]"-||-/if-| |-if ($configModule->get("projects","showActivitiesDates")) && $project->getAllActivitiesRealStart() gt 0-|<a class="tooltip" href="#"><span>La fecha Inicio Real según las actividades del ##projects,4,proyecto## es: |-$project->getAllActivitiesRealStart()|date_format:"%d-%m-%Y"-|</span><img src="images/icon_info.gif"></a>|-/if-|</p> 
    <p> 
      <label for="paramsProject[realEnd]">Final real</label> 
      <input type="text" id="paramsProject[realEnd]" name="paramsProject[realEnd]" class="dateValidation" value="|-$project->getrealEnd()|date_format:"%d-%m-%Y"-|" title="Fin real (Formato: dd-mm-yyyy)" |-$action|readonly-| |-javascript_onchange_validation_attribute idField="paramsProject[realEnd]"-| /> 
      |-if $action ne "showLog"-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('paramsProject[realEnd]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">&nbsp;&nbsp;|-validation_msg_box idField="paramsProject[realEnd]"-||-/if-| |-if ($configModule->get("projects","showActivitiesDates")) && $project->getAllActivitiesRealEnd() gt 0-|<a class="tooltip" href="#"><span>La fecha de Finalización Real según las actividades del ##projects,4,proyecto## es: |-$project->getAllActivitiesRealEnd()|date_format:"%d-%m-%Y"-|</span><img src="images/icon_info.gif"></a>|-/if-|</p> 
    <p> 
      <label for="paramsProject[coordinateNeed]">Necesidad de Coordinación</label> 
      <textarea name="paramsProject[coordinateNeed]" rows="4" cols="70" title="Necesidad de Coordinación" |-$action|readonly-| >|-$project->getcoordinateNeed()-|</textarea> 
    </p> 
    <p> 
      <label for="paramsProject[frequency]">Frecuencia</label> 
      <input name="paramsProject[frequency]" type="text" value="|-$project->getFrequency()-|" size="40" title="Frecuencia de coordinación" |-$action|readonly-| /> 
    </p> 
    <p> 
    <label for="paramsProject[construction]">Obra</label> 
    |-if $action eq "showLog"-|
    	<span>|-$project->getConstruction()|yes_no|multilang_get_translation:"common"-|</span>
    |-else-|    	
    	<input type="hidden" name="paramsProject[construction]" value="0" />
    	<input type="checkbox" name="paramsProject[construction]" value="1"  title="Marque esta opción si es una obra" |-$project->getConstruction()|checked_bool-| /> </p> 
    |-/if-|
    </p> 
    
    <p> 
    <label for="paramsProject[finished]">Terminado</label>
    |-if $action eq "showLog"-|
      	<span>|-$project->getFinished()|yes_no|multilang_get_translation:"common"-|</span>
    |-else-| 	     
	    <input type="hidden" name="paramsProject[finished]" value="0" />
	    <input type="checkbox" name="paramsProject[finished]" value="1" title="Marque esta opción si está finalizado" |-$project->getFinished()|checked_bool-| /> </p> 
    |-/if-|
    </p> 
    <p> 
      <label for="paramsProject[notes]">Notas</label> 
      <textarea name="paramsProject[notes]" cols="70" rows="6" wrap="VIRTUAL" title="Notas" |-$action|readonly-| >|-$project->getNotes()|escape-|</textarea> 
    </p> 
    |-if $configModule->get("projects","useExchangeRate")-|  <p>
        <label for="paramsProject[exchangeRate]">Tasa de cambio del contrato (ARS$/U$S)</label>
      <input name="paramsProject[exchangeRate]" title="Tasa de cambio del contrato (ARS$/U$S)" type="text" id="exchangeRate" size="12" value="|-$project->getExchangeRate()|system_numeric_format:2-|" maxlength="12" |-$action|readonly-| /> 
      </p>|-/if-|
		<p>
			<label for="paramsProject[address]">Dirección</label>
			<input name="paramsProject[address]" type="text" id="paramsProject[address]" title="Dirección" value="|-$project->getAddress()|escape-|" size="60" |-$action|readonly-|/>
		</p>
|-if ($configModule->get("projects","useCoordinates"))-|
		<p>
			<label for="paramsProject[latitude]">Latitud</label>
			<input name="paramsProject[latitude]" type="text" id="paramsProject[latitude]" title="Latitud" value="|-$project->getLatitude()|system_numeric_format:8-|" size="20" |-$action|readonly-| />
		</p>
		<p>
			<label for="paramsProject[longitude]">Longitud</label>
			<input name="paramsProject[longitude]" type="text" id="paramsProject[longitude]" title="Longitud" value="|-$project->getLongitude()|system_numeric_format:8-|" size="20" |-$action|readonly-| />
		</p>
    <p> 
      <label for="paramsProject[postalCode]">Código Postal</label> 
      <input type="text" id="paramsProject[postalCode]" name="paramsProject[postalCode]" title="Código Postal" maxlength="8" value="|-$project->getPostalCode()|escape-|" |-$action|readonly-| /> 
    </p> 
	|-/if-|
     <p> 
      <label for="paramsProject[visibility]">Visibilidad</label> 
      <select id="paramsProject[visibility]" name="paramsProject[visibility]" title="Visibilidad" |-$action|disabled-|> 
				|-section start=0 loop=10 name=for_visibility-|
        <option value="|-$smarty.section.for_visibility.iteration-|" |-$project->getVisibility()|selected:$smarty.section.for_visibility.iteration-|>|-$smarty.section.for_visibility.iteration-|</option> 
				|-/section-|
      </select>|-if $action ne "showLog"-|<a class="tooltipWide" href="#"><span>Visibilidad se define como el grado de percepción que tiene la ciudadanía sobre este proyecto, intentando medir de manera subjetiva el impacto del proyecto.<br />Por ejemplo si el proyecto es muy visible al ciudadano y tiene cobertura en los medios de comunicación, tendrá mas visibilidad que otro que no tiene dicha cobertura.</span><img src="images/icon_info.gif"></a>|-/if-|
			</p>
		<p>
			<label for="paramsProject[priority]">Prioridad</label>
			<select name="paramsProject[priority]" id="paramsProject[priority]" title="Prioridad" |-$action|disabled-| >
			<option value="0">Seleccione prioridad</option>
			|-html_options options=$priorityTypes selected=$project->getPriority()-|
		  </select>
	</p>
		<p> 
      <label for="paramsProject[uniqueGoalNumeric]">Meta Numérica</label> 
      <input type="text" id="paramsProject[uniqueGoalNumeric]" name="paramsProject[uniqueGoalNumeric]" value="|-$project->getuniqueGoalNumeric()-|" title="Meta numérica" |-$action|readonly-| /> 
    </p> 
    <p> 
      <label for="paramsProject[goalProgress">Progreso</label> 
      <input name="paramsProject[goalProgress]" type="text" id="paramsProject[goalProgress]" title="Progreso de la meta" value="|-$project->getgoalProgress()-|" size="5" |-$action|readonly-| /> %
    </p> 
    |-if $action eq 'edit'-|
		 |-if $minorChanges-|
		 <p>
			<label for="paramsProject[minorChange]">Cambio menor</label>
			<input name="paramsProject[minorChange]" type="checkbox" id="paramsProject[minorChange]" value="true" title="No genera registro de la operación"/>
		</p>|-/if-|
      <input type="hidden" name="id" id="id" value="|-$project->getid()-|" /> 
		|-/if-|
		<p>
				<!--pasaje de parametros de filtros -->
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if $page gt 1-| <input type="hidden" name="page" id="page" value="|-$page-|" />|-/if-|
      <input type="hidden" name="action" id="action" value="|-$action-|" /> 
      <input type="hidden" name="do" id="do" value="projectsDoEdit" /> 
	|-if $action ne 'showLog'-|
	  |-javascript_form_validation_button value=Guardar-|
      <!-- <input type="submit" id="button_edit_project" name="button_edit_project" title="Guardar" value="Guardar" /> -->
 				|-if $fromObjectiveId-|
				<input type="submit" id="button_add_more" name="button_add_more" title="Guardar y crear otro" value="Guardar y crear otro" />
				<input type="hidden" name="fromObjectiveId" id="fromObjectiveId" value="|-$fromObjectiveId-|" />
				|-/if-|	
			<input type="button" id="button_return_project" name="button_return_project" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=projectsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
|-else-|
		|-assign var=changedBy value=$project->changedBy()-|
		|-if is_object($changedBy) && !empty($changedBy) && $loginUser->isSupervisor()-|
		Cambiado por: |-$changedBy-|
		|-/if-|
	|-/if-|							
   </p> 
    |-if isset($show)-|
    <input type="hidden" name="show" value="1" /> 
    |-/if-|
   </fieldset> 
  </form>
<script language="JavaScript" type="text/javascript">
	infoElement = $("status_info");
	if (infoElement !== null) infoElement.hide();
</script>