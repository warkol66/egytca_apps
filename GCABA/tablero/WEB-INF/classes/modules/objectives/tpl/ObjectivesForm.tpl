<form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
    |-if $action eq "showLog"-|
    	 <fieldset title="Formulario de control de cambios">
    |-else-|
    	<fieldset title="Formulario de edición de datos de un ##objectives,3,Objetivo##">
    		<legend>Ingrese los datos del ##objectives,3,Objetivo##</legend>
    |-/if-|
 		|-if $objective->getPolicyGuideline() ne ''-|     
 			<p>
        		<label for="policyGuideline">##objectives,1,Eje de Gestión##</label>
        		<input name="policyGuideline" type="text" id="policyGuideline" value="|-$objective->getPolicyGuideline()|escape-|" size="70" readonly="readonly" class="readOnly" /> 
        		<input name="paramsObjective[policyGuidelineId]" type="hidden" id="paramsObjective[policyGuidelineId]" value="|-$objective->getPolicyGuidelineId()-|" /> 
    		</p>
    	|-/if-|
      	<p>
        	<label for="name">Nombre</label>
      		<input name="paramsObjective[name]" type="text" id="paramsObjective[name]" size="80" value="|-$objective->getname()|escape-|" title="Nombre" maxlength="255" |-$action|readonly-| /> 
      	</p>
     	|-if ($loginUser neq "" and $loginUser->isAdmin() && $moduleConfig.useDependencies.value == "YES")-|
     		<p>
      			<label for="dependencyId">Dependencia</label>
      			<select id="dependencyId" name="paramsObjective[dependencyId]" title="Dependencia" |-if $accion eq "Edición"-|readonly="readonly" |-/if-|> 
				|-foreach from=$dependencies item=dependency name=for_valores-|
        			<option value="|-$dependency->getId()-|" |-if $objective->getAffiliateId() eq $dependency->getId()-|selected="selected" |-/if-|>|-$dependency->getName()|truncate:75:"...":false-|</option> 
				|-/foreach-|
      			</select> 
      		</p>
      	|-elseif ($loginAffiliateUser neq "" || $useDependencies == "NO")-|
      		<input type="hidden" name="dependencyId" value="|-$dependency->getId()-|"/> 
      	|-/if-|  
     	|-if ($strategicObjectives|@count) gt 0 && $action ne "view"-|
     		<p>
      			<label for="strategicObjectiveId">##objectives,2,Objetivo Etratégico##</label>
      			<select id="strategicObjectiveId" name="paramsObjective[strategicObjectiveId]" title="##objectives,2,Objetivo Etratégico##" |-$action|disabled-|> 
					<option value="">Seleccione ##objectives,2,Objetivo Etratégico##</option>
					|-foreach from=$strategicObjectives item=strategicObjective name=for_strategicObjectives-|
        				<option value="|-$strategicObjective->getId()-|" |-if $objective->getStrategicObjectiveId() eq $strategicObjective->getId()-|selected="selected" |-/if-|>|-$strategicObjective->getName()|truncate:75:"...":false-|</option> 
					|-/foreach-|
      			</select> 
      		</p>
		|-else-|
 		|-if $objective->getStrategicObjective() ne ''-|
 			<p>
        		<label for="strategicObjective">##objectives,2,Objetivo Etratégico##</label>
        		<input name="strategicObjective" type="text" id="strategicObjective" value="|-$objective->getstrategicObjective()|escape-|" size="70" readonly="readonly" class="readOnly" /> 
        		<input name="paramsObjective[strategicObjectiveId]" type="hidden" id="paramsObjective[strategicObjectiveId]" value="|-$objective->getStrategicObjectiveId()-|" /> 
    		</p> 
    	|-/if-|
		|-/if-|
      	<p>
      		<label for="description">Descripción</label>
      		<textarea name="paramsObjective[description]" cols="70" rows="6" wrap="VIRTUAL" id="description" type="text" |-$action|readonly-| title="Descripción">|-$objective->getdescription()|escape-|</textarea> 
    	</p> 
    	<p> 
      		<label for="date">Fecha</label> 
      		<input name="paramsObjective[date]" type="text" id="date" value="|-$objective->getdate()|date_format:"%d-%m-%Y"-|" size="12" |-$action|readonly-| title="Fecha de definición del objetivo (Formato: dd-mm-yyyy)"/> 
      		|-if $action ne "showLog"-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('paramsObjective[date]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha"> |-/if-|
      	</p> 
    	<p> 
      		<label for="expirationDate">Vencimiento</label> 
      		<input type="text" id="expirationDate" name="paramsObjective[expirationDate]" value="|-$objective->getexpirationDate()|date_format:"%d-%m-%Y"-|" size="12" |-$action|readonly-| title="Fecha de vencimiento (Formato: dd-mm-yyyy)"/> 
      		|-if $action ne "showLog"-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('paramsObjective[expirationDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha"> |-/if-|
      	</p> 
    	<p>
      		<label for="paramsObjective[responsibleCode]">Responsable</label> 
      		<select id="paramsObjective[responsibleCode]" name="paramsObjective[responsibleCode]" title="Responsable" |-$action|disabled-|> 
				<option value="">Seleccione responsable</option>
				|-assign var=responsiblePosition value=$objective->getPosition()-|
				|-foreach from=$positions item=position name=for_positions-|
       				<option value="|-$position->getCode()-|" |-if is_object($responsiblePosition)-||-$responsiblePosition->getCode()|selected:$position->getCode()-||-/if-|>|-section name=space loop=$position->getLevel()-|&nbsp;|-/section-| |-$position->getName()-| |-if get_class($position->getActiveTenureName()) eq "PositionTenure"-||-assign var=tenure value=$position->getActiveTenureName()-| &#8212; |-assign var=tenure value=$position->getActiveTenure()-| |-if $tenure->getObject() != NULL-||-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()-| |-$tenureObject->getSurname()-||-/if-||-/if-|</option> 
				|-/foreach-|
      		</select> 
     	</p> 
    	<p>
      		<label>Logrado</label>
      		|-if $action eq "showLog"-|
      			<span>|-$objective->getachieved()|yes_no|multilang_get_translation:"common"-|</span>
      		|-else-| 
				<input type="hidden" name="paramsObjective[achieved]" value="0" />	
				<input type="checkbox" name="paramsObjective[achieved]" value="1" |-$objective->getachieved()|checked_bool-| />	
			|-/if-|
		</p> 
      	<p>
        	<label for="notes">Notas</label>
      		<textarea name="paramsObjective[notes]" cols="70" rows="6" wrap="VIRTUAL" id="notes" type="text"  |-$action|readonly-|>|-$objective->getnotes()|escape-|</textarea> 
      	</p>
    	|-if $action eq "edit"-|
			|-if $minorChanges-|
				<p>
					<label for="paramsObjective[minorChange]">Cambio menor</label>
					<input name="paramsObjective[minorChange]" type="checkbox" id="paramsObjective[minorChange]" value="true" title="No genera registro de la operación"/>
				</p>
			|-/if-|
    		<input type="hidden" name="id" id="id" value="|-$objective->getid()-|" /> 
    	|-/if-|
    	<input type="hidden" name="action" id="action" value="|-$action-|" />
    	|-if $action ne "showLog"-|
			|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
			|-if $page gt 1-| <input type="hidden" name="page" id="page" value="|-$page-|" />|-/if-|
    		<input type="hidden" name="do" id="do" value="objectivesDoEdit" /> 
    		<input type="submit" id="button_edit_objective" name="button_edit_objective" title="Aceptar" value="Aceptar" /> 
		<input type="button" id="button_return_objective" name="button_return_objective" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=objectivesList'" />
    	|-/if-|
    </fieldset> 
    |-if isset($show)-|
    	<input type="hidden" name="show" value="1"  /> 
	|-/if-|
</form>
<script language="JavaScript" type="text/javascript">
	infoElement = $("status_info");
	if (infoElement !== null) infoElement.hide();
</script>