|-if $strategicObjective ne ''-|
	|-assign var=objective value=$strategicObjective-|
|-/if-| 
 
  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el ##objectives,2,Objetivo Etratégico##</div>
		|-/if-|
    <p><a href="#" onClick="javascript:history.go(-1)">Regresar</a></p> 
    <fieldset title="Formulario de edición de datos de un ##objectives,2,Objetivo Etratégico##">
     <legend>Ingrese los datos del ##objectives,2,Objetivo Etratégico##</legend>
      <p>
        <label for="strategicObjective[policyGuidelineId]">##objectives,1,Eje de Gestión##</label>
				<select name="strategicObjective[policyGuidelineId]" id="strategicObjective[policyGuidelineId]" title="Eje de Gestión" |-$action|disabled-|/> 
				<option value="">Seleccione ##objectives,1,Eje de Gestión##</option>
				|-foreach from=$policyGuidelines item=guideline name=for_guidelines-|
				<option value="|-$guideline->getId()-|"|-if $objective->getPolicyGuidelineId() eq $guideline->getId()-|selected="selected" |-/if-|>|-$guideline->getName()-|</option>
				|-/foreach-|
      </select> </p>
      <p>
        <label for="strategicObjective[name]">Nombre</label>
      <input name="strategicObjective[name]" type="text" id="strategicObjective[name]" size="80" value="|-$objective->getname()-|" title="Nombre del Objetivo" maxlength="255" |-$action|readonly-|/> 
      </p>
     |-if ($loginUser neq "" and $loginUser->isAdmin() && $moduleConfig.useDependencies.value == "YES")-|<p>
      <label for="strategicObjective[dependencyId]">Dependencia</label>
      <select id="strategicObjective[dependencyId]" name="strategicObjective[dependencyId]" title="dependencyId" |-if $accion eq "edit"-|readonly="readonly" |-/if-|> 
                	|-foreach from=$dependencies item=dependency name=for_valores-|
        <option value="|-$dependency->getId()-|" |-if $objective->getAffiliateId() eq $dependency->getId()-|selected="selected" |-/if-|>|-$dependency->getName()|truncate:75:"...":false-|</option> 
                	|-/foreach-|
      </select> </p>
      |-elseif ($loginAffiliateUser neq "" || $useDependencies == "NO")-|
      <input type="hidden" name="strategicObjective[dependencyId]" id="strategicObjective[dependencyId]" value="|-$dependency->getId()-|"/> 
      |-/if-|  
    <p> 
      <label for="strategicObjective[description]">Descripción</label>
      <textarea name="strategicObjective[description]" cols="70" rows="6" wrap="VIRTUAL" id="strategicObjective[description]" type="text" title="Descripción del Objetivo" |-$action|readonly-|>|-$objective->getDescription()|escape-|</textarea> 
    </p> 

    |-if $action eq "edit"-|
    <input type="hidden" name="id" id="id" value="|-$objective->getid()-|" /> 
    |-/if-|
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="action" id="action" value="|-$action-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="objectivesStrategicObjectivesDoEdit" /> 
    |-if $action ne "showLog"-|
    	<input type="submit" id="button_edit_objective" name="button_edit_objective" title="Guardar" value="Guardar" /> 
	<input type="button" id="button_return_objective" name="button_return_objective" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=objectivesStrategicObjectivesList'" />
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