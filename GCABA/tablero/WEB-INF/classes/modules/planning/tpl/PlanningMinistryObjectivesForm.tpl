|-if $message eq "ok"-|
	<div class="successMessage">Objetivo Ministerial guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Objetivo Ministerial</div>
|-/if-|

  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->

    <fieldset title="Formulario de edición de datos de un Objetivo Ministerial">
     <legend>Ingrese los datos del Objetivo Ministerial</legend>
      <p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$ministryObjective->getName()-|" title="Nombre del Objetivo Ministerial" maxlength="255" /> 
      </p>
    <p> 
      <label for="params_description">Descripción</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Objetivo Ministerial" >|-$ministryObjective->getDescription()|escape-|</textarea> 
    </p> 
      <p>
        <label for="params_contextualFactors">Factores contextuales</label>
      <input name="params[contextualFactors]" type="text" id="params_contextualFactors" size="80" value="|-$ministryObjective->getContextualFactors()-|" title="Nombre del Objetivo Ministerial" maxlength="255" /> 
      </p>
    <p>|-if !$ministryObjective->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$ministryObjective->getId()-|" /> 
    |-/if-|
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="planningMinistryObjectivesDoEdit" /> 
		|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=planningMinistryObjectivesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos Ministeriales"/>
		</p>
    </fieldset> 
  </form> 