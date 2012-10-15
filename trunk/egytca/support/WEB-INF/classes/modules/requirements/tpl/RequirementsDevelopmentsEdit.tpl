<h2>Desarrollo</h2> 
|-if !$notValidId || is_object($requirement)-|
<h1>Administración de Desarrollos - |-if !$development->isNew()-|Editar|-else-|Crear|-/if-| Desarrollos</h1>
<p class='paragraphEdit'>A continuación se puede modificar los datos que definen el Desarrollo.</p>
<div id="div_requirement"> 
  |-if $message eq "ok"-|
	<div class="successMessage">Desarrollo guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Desarrollo</div>
|-/if-|
|-include file="CommonAutocompleterInclude.tpl"-|
  <form name="form_edit_requirement" id="form_edit_requirement" action="Main.php" method="post">
	
    <fieldset title="Formulario de datos de Desarrollo">
     <legend>Desarrollo</legend>
			<p>Instrucciones: Compete un formulario por cada tipo de tarea que quiera que realice el sistema</p>
        <label for="params_name">Desarrollo</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$development->getName()-|" title="Nombre del Desarrollo" maxlength="255" class="emptyValidation"  |-$readonly|readonly-|/> |-validation_msg_box idField="params_name"-|
      </p>
    <p>
		<label for="params_input">Input</label>
		<textarea name="params[input]" cols="74" rows="1" id="params_input" type="text" title="Descripción del ingreso de los datos" |-$readonly|readonly-|>|-$development->getInput()|escape-|</textarea>
    </p>
    <p>
		<label for="params_process">Proceso</label>
		<textarea name="params[process]" cols="74" rows="1" id="params_process" type="text" title="Descripción del ingreso de los datos" |-$readonly|readonly-|>|-$development->getProcess()|escape-|</textarea> 
    </p>
    <p>
		<label for="params_output">Output</label>
		<textarea name="params[output]" cols="74" rows="1" id="params_output" type="text" title="Descripción del resultado" |-$readonly|readonly-|>|-$development->getOutput()|escape-|</textarea> 
    </p>
    <p>
		<label for="params_other">Otros</label>
		<textarea name="params[other]" cols="74" rows="1" id="params_other" value="|-$development->getOther()-|" type="text" title="Otra información" |-$readonly|readonly-|>|-$development->getOther()|escape-|</textarea> 
    </p>
    <p> 
      <label for="params_description">Descripción</label>
      <textarea name="params[description]" cols="74" rows="8" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Desarrollo" |-$readonly|readonly-|>|-$development->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p> 
    <p>
		<label for="params_estimatedDelivery">Fecha estimada de entrega</label>
		<input name="params[estimatedDelivery]" id="params_estimatedDelivery" value="|-$development->getEstimatedDelivery()-|" size="10" title="Fecha estimada de entrega"></input>
    </p>
    <p>
		<label for="params_realDelivery">Fecha de entrega</label>
		<input name="params[realDelivery]" id="params_other" value="|-$development->getrealDelivery()-|" size="10" title="Fecha de entrega"></input>
    </p>
    
    <p>
		<label for="params_delivered">Entregado</label>
		<input name="params[delivered]" id="params_delivered" type="checkbox" value="|-$development->getDelivered()-|" title="Entregado"></input>
    </p>
    
    <p>
		<label for="params_estimatedHours">Estimación de horas</label>
		<input name="params[estimatedHours]" id="params_estimatedHours" size="5" value="|-$development->getEstimatedHours()-|" title="Estimación de horas"></input>
    </p>
    <p>
		<label for="params_realHours">Horas Insumidas</label>
		<input name="params[realHours]" id="params_realHours" size="5" value="|-$development->getRealHours()-|" title="Horas insumidas"></input>
    </p>
    <p>
		<label for="params_estimatedCost">Costo estimado</label>
		<input name="params[estimatedCost]" id="params_estimatedCost" value="|-$development->getEstimatedCost()-|" title="Costo estimado"></input>
    </p>
    <p>
		<label for="params_realCost">Costo real</label>
		<input name="params[realCost]" id="params_realCost" value="|-$development->getRealCost()-|" title="Costo real"></input>
    </p>
    <p>
		<label for="params_quotation">Cotización</label>
		<input name="params[quotation]" id="params_delivered" value="|-$development->getQuotation()-|" title="Cotización"></input>
    </p>
    
   |-if !$development->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$development->getId()-|" /> 
    |-/if-|
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="requirementsDevelopmentsDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
			<input type='button' onClick='location.href="Main.php?do=requirementsDevelopmentsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Desarrollos"/>
		</p>
    </fieldset> 
  </form> 
</div> 
|-else-|
	<h1>Administración de Desarrollos</h1>
	<div class="errorMessage">El identificador del desarrollo ingresado no es válido. Seleccione uno de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=requirementsDevelopmentsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Desarrollos"/>
|-/if-|
