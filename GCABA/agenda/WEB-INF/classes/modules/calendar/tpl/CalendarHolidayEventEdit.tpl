<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<link type="text/css" href="css/jquery-ui-timepicker-addon.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.timepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.datepicker.setDefaults({
			dateFormat: 'dd-mm-yy',
			numberOfMonths: 3	
		});
		$.timepicker.setDefaults({
			hourGrid: 3,
			minuteGrid: 5,
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false }
		});
		
		$('#params_startDate').datetimepicker();
	});
</script>

<h2>Feriados</h2>
|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del feriado ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=calendarHolidayEventList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Feriados"/>
|-else-|
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Feriado</h1>
<div id="div_bulletin">
	<p>Ingrese los datos del Feriado</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Feriado</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form action="Main.php?do=calendarHolidayEventDoEdit" method="post">
	<fieldset title="Formulario de edición de datos de un Feriado">
		<legend>Formulario de Administración de Feriados</legend>
		<p>
			<label for="params_title">Título</label>
			<input type="text" id="params_title" name="params[title]" size="10" value="|-$entity->getTitle()|escape-|" title="Título" />
		</p>
		<p>     
			<label for="params_startDate">Fecha</label>
			<input id="params_startDate" name="params[startDate]" type="text" size="18" value="|-$entity->getStartDate()|dateTime_format-|" />
		</p>
		<p>
			|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$entity->getId()-|" />
			|-/if-|
			<input type="hidden" name="action" id="action" value="|-$action-|" />
			<input type="submit" title="Guardar" value="Guardar" />
			<input type="button" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=calendarHolidayEventList'"/>
		</p>
	</fieldset>
	</form>
</div>
|-/if-| <!-- $notValidId eq "true" -->
