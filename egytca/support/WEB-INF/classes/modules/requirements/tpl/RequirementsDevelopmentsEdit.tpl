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
      <label for="params_description">Descripción</label>
      <textarea name="params[description]" cols="74" rows="8" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Desarrollo" |-$readonly|readonly-|>|-$development->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
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