<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>
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
		
		initializeDatePickers();
		
		$('#calendarEvent_street').change(updateLocateButton);
		$('#calendarEvent_number').change(updateLocateButton);
		$('#calendarEvent_latitude').change(updateLocateButton);
		$('#calendarEvent_longitude').change(updateLocateButton);
	});
	
	function updateLocateButton() {
		
		var text;
		
		if ( $('#calendarEvent_latitude').val() != '' && $('#calendarEvent_street').val() != '' )
			text = 'Ver en mapa';
		else
			text = 'Buscar en mapa';
		
		$('#button_locate').attr('value', text);
		$('#button_locate').attr('title', text);
	}
	
	function initializeDatePickers() {
		$.datepicker.setDefaults({
			dateFormat: 'dd-mm-yy',
			numberOfMonths: 3
//			minDate: 0	
		});
		$('#calendarEvent_startDate').datepicker();
		$('#calendarEvent_endDate').datepicker();
	}
</script>
<h2>Administración de Eventos</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Evento</h1>
|-if $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar el evento</div>
|-/if-|
<div id="div_calendarEvents">
		<form name="form_edit_calendarEvent" id="form_edit_calendarEvent" action="Main.php" method="post">
			<p>Ingrese los datos del evento</p>
			<fieldset title="Formulario de edición de datos de un evento">
			<legend>Formulario de Calendario de Eventos</legend>
				<p>
					<label for="calendarEvent_title">Título</label>
					<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="|-$calendarEvent->getTitle()|escape-|" class="emptyValidation" size="60" maxlength="255" |-js_char_counter object=$calendarEvent columnName="title" fieldName="calendarEvent_title" idRemaining="remaining" sizeRemaining="3" classRemaining="charCount" counterTitle="Cantidad de caracteres restantes" showHide=1 useSpan=0-||-$Counter.pre-| /> |-$Counter.pos-| |-validation_msg_box idField="calendarEvent_title"-|
				</p>
				<p>
					<label for="calendarEvent_body">Texto del Evento</label>
					<textarea name="calendarEvent[body]" cols="60" rows="5" wrap="VIRTUAL"  id="calendarEvent_body">|-$calendarEvent->getbody()|escape-|</textarea>
			</p>
				<p>
				<p style="display: none">
					<label for="calendarEvent_creationDate">Fecha de Creación</label>
					<input name="calendarEvent[creationDate]" type="text" id="calendarEvent_creationDate" title="creationDate" value="|-if $calendarEvent->isNew()-||-$smarty.now|dateTime_format|change_timezone|date_format:"%d-%m-%Y"-||-else-||-$calendarEvent->getcreationDate()|dateTime_format-||-/if-|" size="18" />
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>
				<p>
					<label for="calendarEvent_startDate">Fecha de Inicio </label>
					<input name="calendarEvent[startDate]" type="text" id="calendarEvent_startDate" title="creationDate" value="|-$calendarEvent->getstartDate()|date_format-|" size="18" /> 
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>
				<p>
					<label for="calendarEvent_endDate">Fecha de Fin </label>
					<input name="calendarEvent[endDate]" type="text" id="calendarEvent_endDate" title="endDate" value="|-$calendarEvent->getendDate()|date_format-|" size="18" /> 
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>							
				<p>
					<label for="calendarEvent_holiday">Feriado</label>
					<input name="calendarEvent[holiday]" type="hidden" value="0">
					<input name="calendarEvent[holiday]" type="checkbox" value="1" |-$calendarEvent->getHoliday()|checked_bool-|>			</p>
				<p style="display: none">
					<label for="calendarEvent_allDay">Evento de todo el día</label>
					<input name="calendarEvent[allDay]" type="hidden" value="1">
				</p>
				<p style="display: none">
					<label for="calendarEvent_street">Calle</label>
					<input name="calendarEvent[street]" type="text" id="calendarEvent_street" title="calle" value="|-$calendarEvent->getStreet()-|" size="30" />
				</p>
				<p style="display: none">
					<label for="calendarEvent_number">Número</label>
					<input name="calendarEvent[number]" type="text" id="calendarEvent_number" title="número" value="|-$calendarEvent->getNumber()-|" size="8" />
				</p>
|-include file="CalendarEventsMapInclude.tpl" locateButtonId="button_locate" disableId="button_edit_calendarEvent" streetId="calendarEvent_street" numberId="calendarEvent_number" latitudeId="calendarEvent_latitude" longitudeId="calendarEvent_longitude"-|
				<p style="display: none">
					|-if !($calendarEvent->getLatitude() eq '') && !($calendarEvent->getStreet() eq '')-|
						|-assign var=locateButtonText value="Ver en mapa"-|
					|-else-|
						|-assign var=locateButtonText value="Buscar en mapa"-|
					|-/if-|
					<input type="button" id="button_locate" value="|-$locateButtonText-|" title="|-$locateButtonText-|" />
				</p>
				<p style="display: none">
					<label for="calendarEvent_latitude">Latitud</label>
					<input name="calendarEvent[latitude]" type="text" id="calendarEvent_latitude" title="latitud" value="|-$calendarEvent->getLatitude()-|" size="20" readonly="readonly" />
				</p>
				<p style="display: none">
					<label for="calendarEvent_longitude">Longitud</label>
					<input name="calendarEvent[longitude]" type="text" id="calendarEvent_longitude" title="longitud" value="|-$calendarEvent->getLongitude()-|" size="20" readonly="readonly"/>
				</p>
				<p>
					|-if !$calendarEvent->isNew()-|
					<input type="hidden" name="id" id="calendarEvent_id" value="|-$calendarEvent->getid()-|" />
					|-/if-|
					<!--pasaje de parametros de filtros -->
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					<input type="hidden" name="do" id="doEdit" value="calendarHolidayEventsDoEdit" />
					|-javascript_form_validation_button id="button_edit_calendarEvent" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=calendarHolidayEventsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Eventos"/>
				</p>
			</fieldset>
		</form>
	</div>
