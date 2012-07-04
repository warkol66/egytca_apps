|-if $message eq "ok"-|
	<div class="successMessage">Indicador guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Indicador</div>
|-/if-|
|-if !$show && !$showLog-||-include file="CommonAutocompleterInclude.tpl"-||-/if-|
  <form name="form_edit_project" id="form_edit_project" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->

    <fieldset title="Formulario de datos de Indicador">
     <legend>Indicador</legend>
		<p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$planningIndicator->getName()-|" title="Nombre del Indicador" maxlength="255" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
      </p>
		<p>
			<label for="params_type">Tipo</label>
			<select id="params_type" name="params[type]" title="Tipo de indicador" |-$readonly|readonly-|>
				<option value="">Seleccione el Tipo de indicador</option>
				|-foreach from=$indicatorTypes key=key item=name-|
							<option value="|-$key-|" |-$planningIndicator->getType()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
    <p> 
      <label for="params_description">Descripción</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Indicador" |-$readonly|readonly-| >|-$planningIndicator->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p>

    |-if !$planningIndicator->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$planningIndicator->getId()-|" /> 
    |-/if-|
		|-if !$show && !$showLog-|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="planningIndicatorsDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=planningIndicatorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Indicadores"/>
		</p>|-/if-|
    </fieldset> 
  </form> 