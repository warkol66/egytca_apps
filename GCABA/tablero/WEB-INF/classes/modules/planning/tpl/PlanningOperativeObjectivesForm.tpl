|-if $message eq "ok"-|
	<div class="successMessage">Objetivo Operativo guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Objetivo Operativo</div>
|-/if-|

  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->

    <fieldset title="Formulario de edición de datos de un Objetivo Operativo">
     <legend>Ingrese los datos del Objetivo Operativo</legend>
      <p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$operativeObjective->getName()-|" title="Nombre del Objetivo Operativo" maxlength="255" class="emptyValidation"  /> |-validation_msg_box idField="params_name"-|
      </p>
    <p> 
      <label for="params_description">Descripción</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Objetivo Operativo" >|-$operativeObjective->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p> 
			<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
    |-if !$operativeObjective->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$operativeObjective->getId()-|" /> 
    |-/if-|
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="params[startingYear]" id="params_startingYear" value="|-$startingYear-|" /> 
    <input type="hidden" name="params[endingYear]" id="params_endingYear" value="|-$endingYear-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="planningOperativeObjectivesDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=planningOperativeObjectivesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos Operativos"/>
		</p>
    </fieldset> 
  </form> 