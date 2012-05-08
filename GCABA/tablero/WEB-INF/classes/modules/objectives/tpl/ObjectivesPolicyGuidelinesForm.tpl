|-if $policyGuideline ne ''-|
	|-assign var=objective value=$policyGuideline-|
|-/if-| 

  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|

		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar ##objectives,1,Eje de Gestión##</div>
		|-/if-|
    <fieldset title="Formulario de edición de datos de un ##objectives,1,Eje de Gestión##">
     <legend>Ingrese los datos del ##objectives,1,Eje de Gestión##</legend>
      <p>
        <label for="policyGuidelineParams[name]">Nombre</label>
      <input name="policyGuidelineParams[name]" type="text" id="name" size="80" value="|-$objective->getname()-|" title="Nombre del ##objectives,1,Eje de Gestión##" maxlength="255" |-$action|readonly-| /> 
      </p>
    <p> 
      <label for="policyGuidelineParams[description]">Descripción</label>
      <textarea name="policyGuidelineParams[description]" cols="70" rows="6" wrap="VIRTUAL" id="policyGuidelineParams[description]" type="text" title="Descripción del ##objectives,1,Eje de Gestión##" |-$action|readonly-|>|-$objective->getdescription()|escape-|</textarea> 
    </p> 
    |-if $configModule->get("global","applicationName") eq "wb"-|<p>
        <label for="policyGuidelineParams[exchangeRate]">Tasa de cambio del préstamo (ARS$/U$S)</label>
      <input name="policyGuidelineParams[exchangeRate]" title="Tasa de cambio del préstamo (ARS$/U$S)" type="text" id="exchangeRate" size="12" value="|-$objective->getExchangeRate()|system_numeric_format:2-|" maxlength="12" |-$action|readonly-| /> 
      </p>
			<p>
        <label for="policyGuidelineParams[startingYear]">Año inicio</label>
      <input name="policyGuidelineParams[startingYear]" title="Año inicio" type="text" id="startingYear" size="4" value="|-$objective->getStartingYear()-|" maxlength="4" |-$action|readonly-| /> 
      </p>
        <p><label for="policyGuidelineParams[endingYear]">Año finalización</label>
      <input name="policyGuidelineParams[endingYear]" title="Año inicio" type="text" id="endingYear" size="4" value="|-$objective->getEndingYear()-|" maxlength="4" |-$action|readonly-| /> 
      </p>|-/if-|

    <p>|-if $action eq "edit"-|
    <input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$objective->getid()-||-/if-|" /> 
    |-/if-|
    <input type="hidden" name="action" id="action" value="|-$action-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="objectivesPolicyGuidelinesDoEdit" /> 
    |-if $action ne "showLog"-|
    	<input type="submit" id="button_edit_policy" name="button_edit_policy" title="Guardar" value="Guardar" /> 
		<input type="button" id="button_return_policy" name="button_return_policy" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=objectivesPolicyGuidelinesList'" />
    |-/if-|
		</p>
    </fieldset> 
    |-if isset($show)-|
    <input type="hidden" name="show" value="1"  /> 
    |-/if-|
  </form> 