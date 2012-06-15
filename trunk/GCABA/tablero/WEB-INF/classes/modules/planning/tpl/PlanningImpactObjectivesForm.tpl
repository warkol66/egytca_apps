|-if $message eq "ok"-|
	<div class="successMessage">Objetivo de Impacto guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Objetivo de Impacto</div>
|-/if-|

  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->

    <fieldset title="Formulario de edición de datos de un Objetivo de Impacto">
     <legend>Ingrese los datos del Objetivo de Impacto</legend>
      <p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$impactObjective->getName()-|" title="Nombre del Objetivo de Impacto" maxlength="255" |-js_char_counter assign="js_counter" object=$impactObjective columnName="name" fieldName="params[name]" idRemaining="remaining" sizeRemaining="3" classRemaining="charCount" counterTitle="Cantidad de caracteres restantes" showHide="1" useSpan="0"-||-$Counter.pre-| /> |-$Counter.pos-| 
      </p>
    <p> 
      <label for="params_description">Resumen narrativo </label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Resumen narrativo" >|-$impactObjective->getDescription()|escape-|</textarea> 
    </p> 
		<p>
			<label for="params_policyGuideline">Correspondencia con ejes de gestión</label>
			<select id="params_policyGuideline" name="params[policyGuideline]" title="Correspondencia con ejes de gestión">
				<option value="">Seleccione el Eje de gestión</option>
				|-foreach from=$policyGuidelines key=key item=name-|
							<option value="|-$key-|" |-$impactObjective->getPolicyGuideline()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
    <p> 
      <label for="params_indicators">Indicadores</label>
      <input name="params[indicators]" type="text" id="params_indicators" title="Indicadores" value="TO DO" size="7"> 
    </p> 
      <p>
        <label for="params_baseline">Línea de base</label>
      <input name="params[baseline]" type="text" id="params_name" size="15" value="|-$impactObjective->getName()-|" title="Nombre del Objetivo de Impacto" maxlength="10" class="emptyValidation" /> 
      </p>
		<p>
			<label for="params_expectedResult">Resultado esperado</label>
			<select id="params_expectedResult" name="params[expectedResult]" title="Resultado esperado">
				<option value="">Seleccione el resultado esperado</option>
				|-foreach from=$expectedResults key=key item=name-|
							<option value="|-$key-|" |-$impactObjective->getExpectedResult()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
      <p>
        <label for="params_contextualFactors">Factores contextuales</label>
        <textarea name="params[contextualFactors]" cols="80" rows="3" wrap="VIRTUAL" id="params_contextualFactors" title="Factores contextuales">|-$impactObjective->getContextualFactors()-|</textarea> 
      </p>
      <p>
        <label for="params_contextualFactorsEvolution">Evolucion de Factores contextuales</label>
        <textarea name="params[contextualFactorsEvolution]" cols="80" rows="5" wrap="VIRTUAL" id="params_contextualFactorsEvolution" title="Evolucion de Factores contextuales">|-$impactObjective->getContextualFactorsEvolution()-|</textarea> 
      </p>
			<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
    <p>
		|-if !$impactObjective->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$impactObjective->getId()-|" /> 
    |-/if-|
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="params[startingYear]" id="params_startingYear" value="|-$startingYear-|" /> 
    <input type="hidden" name="params[endingYear]" id="params_endingYear" value="|-$endingYear-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="planningImpactObjectivesDoEdit" /> 
		|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=planningImpactObjectivesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos de Impacto"/>
		</p>
    </fieldset> 
  </form> 