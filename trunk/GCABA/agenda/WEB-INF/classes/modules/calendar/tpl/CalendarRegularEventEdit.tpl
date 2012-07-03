<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.datepicker.setDefaults({
			dateFormat: 'dd-mm',
			numberOfMonths: 3
		});
		$('#params_date').datepicker();
	});
</script>

<h2>Efemérides</h2>
|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador de la efeméride ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=calendarRegularEventList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Efemérides"/>
|-else-|
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Efeméride</h1>
<div id="div_bulletin">
	<p>Ingrese los datos de la Efeméride</p>
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la Efeméride</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form action="Main.php" method="post">
	<fieldset title="Formulario de edición de datos de una Efeméride">
		<legend>Formulario de Administración de Efemérides</legend>
		<p>
			<label for="params_name">Nombre</label>
			<input type="text" id="params_name" name="params[name]" size="40" value="|-$entity->getName()|escape-|" title="Nombre" class="emptyValidation" />
		</p>
		<p>     
			<label for="params_description">Descripción</label>
			<textarea name="params[description]" cols="45" rows="3" wrap="VIRTUAL" id="params_description" title="Descripción">|-$entity->getDescription()|escape-|</textarea>
		</p>
		<p>     
			<label for="params_date">Fecha</label>
			<input id="params_date" name="params[date]" type="text" readonly="readonly" size="12" class="emptyValidation"  value="|-$entity->getDate()|date_format:'%d-%m'-|" title="Ingrese la fecha en formato dd-mm"/> (dd-mm)
		</p>
				<p>
					<label for="params_holiday">Feriado</label>
					<input name="params[holiday]" type="hidden" value="0">
					<input name="params[holiday]" type="checkbox" value="1" |-$entity->getHoliday()|checked_bool-|>			</p>
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		<p>
			|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$entity->getId()-|" />
			|-/if-|

					<!--pasaje de parametros de filtros -->
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					<input type="hidden" name="do" id="doEdit" value="calendarRegularEventDoEdit" />
					|-javascript_form_validation_button id="button_edit_calendarEvent" value='Guardar' title='Guardar'-|
	<input type='button' onClick='location.href="Main.php?do=calendarRegularEventList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Eventos"/>
			</p>
	</fieldset>
	</form>
</div>
|-/if-| <!-- $notValidId eq "true" -->
